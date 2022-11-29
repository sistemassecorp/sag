<?php
$datosO=$_REQUEST['D'];
$datosD = base64_decode($datosO);
$arreglo = json_decode($datosD, true); //estoy recibiendo un json string, entonces lo tengo que decodificar y

// print_r($arreglo);
// exit();

$path = $arreglo['path'];
$tipo = $arreglo['tipo']; //1=abrir pdf en navegador 2=guardar el archivo en carpeta  3=abrir pdf en navegador   4=descargar archivo
$idRegistro = isset($arreglo['idRegistro']) ? $arreglo['idRegistro'] : 0;
$nombreArchivo = $arreglo['nombreArchivo'];
$idRazonSocial = isset($arreglo['idRazonSocial']) ? $arreglo['idRazonSocial'] : '';

$vp =isset($arreglo['vp']) ? $arreglo['vp'] : '';
$folioFactura = isset($arreglo['folioFactura']) ? $arreglo['folioFactura'] :0;

if($vp=='vp_cotizacion'){
	@unlink('../cotizaciones/cotizacion_vp_'.$idRazonSocial.'.pdf');

}
if($vp=='vp_requi'){
	@unlink('../formatosPdf/formato_vp_requisicion_'.$idRegistro.'.pdf');
}

// include('conectar.php');

ob_start();
include('../formatosPdf/'.$path.'.php');
$content = ob_get_clean();

// convert in PDF
require_once('../vendor/pdf/html2pdf.class.php');
try
{
	if($tipo == 1)
	{
		$html2pdf = new HTML2PDF('P', 'Letter', 'fr');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($nombreArchivo.'.pdf');
	}

	if($tipo == 2)
	{
		$html2pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		if($vp=='pago'){
			$html2pdf->Output('../pagos/archivos/pago_'.$folioFactura.'_'.$idRegistro.'.pdf','f');
		}else if($vp=='vp_cotizacion'){
			$html2pdf->Output('../cotizaciones/cotizacion_vp_'.$idRazonSocial.'.pdf','f');
		}else if($vp=='vp_requi'){
			$html2pdf->Output('../formatosPdf/formato_vp_requisicion_'.$idRegistro.'.pdf','f');	
		}else if($vp == 'factura'){
			$html2pdf->Output('../facturacion/archivos/factura_'.$folioFactura.'_'.$idRegistro.'.pdf','f');
		}else if($vp == 'nota_de_credito'){
			$html2pdf->Output('../facturacion/archivos/nota_de_credito_'.$folioFactura.'_'.$idRegistro.'.pdf','f');
		}else{
			$html2pdf->Output('../cotizaciones/cotizacion_'.$idRegistro.'.pdf','f');
		}
	}	

	if($tipo == 3)
	{
		$html2pdf = new HTML2PDF('l', 'Letter', 'fr');  //l=landscape (horizontal)   P=portrait  (vertical)
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($nombreArchivo.'.pdf');
	}

	if($tipo == 4)
	{
		$html2pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($nombreArchivo.'.pdf','D');
	}

	//GCM - 28/04/2022
	//Se agrega tipo 5 para las cotizaciones en pdf de vision
	if($tipo == 5){

		$link = Conectarse();
		$pdf = '';

		$idCotiz = $arreglo["idCotiz"];
		$enviar = $arreglo["enviar"];

		$rutaCompleta = '../vision/cotizaciones/vision_cotiz_'.$idCotiz.'.pdf';
		
		$html2pdf = new HTML2PDF('P', 'Letter', 'fr');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($rutaCompleta,'f');

		$query = "SELECT 
                    IF(vc.fk_idcliente = 0,
                    (SELECT correo FROM vision_prospectos WHERE fk_cotizacion = vc.id),
                    (SELECT correo_factura FROM vision_clientes WHERE id_cliente = vc.fk_idcliente)) correo
                FROM vision_cotizacion vc
                WHERE id = $idCotiz;";

		$result = $link->query($query);

		if($result){

			$datos=mysqli_fetch_array($result);

			if($enviar == 1){
				if(isset($datos['correo']) && $datos['correo'] != '' && filter_var($datos['correo'], FILTER_VALIDATE_EMAIL)){

					$pdf = $html2pdf->Output('', true);
					
					include("../vendor/lib_mail/class.phpmailer.php");
					include("../vendor/lib_mail/class.smtp.php");
	
					$correo = $datos['correo'];
	
					$mail = new PHPMailer();
					$mail->CharSet = 'UTF-8';
					$mail->IsSMTP();
					$mail->IsHTML(true);	
					$mail->SMTPSecure = "ssl";
					$mail->SMTPAuth = true;
					$mail->Host = "mail.ginthercorp.com";
					$mail->Port = 465;
					$mail->Username = "contacto@visionpublicidad.mx"; 
					$mail->Password = "vision2022.";
	
					$mail->SetFrom("contacto@visionpublicidad.mx","Cotización");
	
					$mail->Subject = "Cotización Visión";
					$mail->MsgHTML("Cotización Visión");
					$mail->AddAddress($correo, "Cliente");	
					
					$mail->addStringAttachment($pdf, 'file.pdf');
	
					if(!$mail->Send()){
						error_log($mail->ErrorInfo);
					}else{
						$html2pdf->Output($rutaCompleta);
					}
				}else{
					error_log("sin correo");
					$html2pdf->Output($rutaCompleta);
				}
			}else{
				$html2pdf->Output($rutaCompleta);
			}
			
		}else{
			error_log("Fallando");
		}
	}

	echo "OK";

}
catch(HTML2PDF_exception $e) {
	echo 'Error al generar el PDF, favor de notificar.';
	print_r($e);
	exit;
}


/*****
 ej. Output(nombre archivo,'f');
 	Destination where to send the document. It can take one of the following values:
	I: send the file inline to the browser (default). The plug-in is used if available. The name given by name is used when one selects the "Save as" option on the link generating the PDF.
	D: send to the browser and force a file download with the name given by name.
	F: save to a local server file with the name given by name.
	S: return the document as a string (name is ignored).
	FI: equivalent to F + I option
	FD: equivalent to F + D option
	E: return the document as base64 mime multi-part email attachment (RFC 2045)
 *****/
?>