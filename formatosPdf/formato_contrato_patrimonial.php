<?php 
session_start();
include("conectar.php");
include("../widgets/numerosLetras.php");
$link = Conectarse();

$datosO = $_REQUEST['D'];
$datosD = base64_decode($datosO);
$arreglo = json_decode($datosD, true); //estoy recibiendo un json string, entonces lo tengo que decodificar y

$idRegistro = $arreglo['idRegistro'];

// Informacion de la empresa 
$query = "SELECT
a.folio_contrato,
a.id_cotizacion,
b.razon_social AS rs_cliente,
b.rfc,
b.r_legal,
b.domicilio,
b.no_exterior,
b.no_interior,
b.colonia,
b.codigo_postal,
c.municipio,
d.estado
FROM contratos_cliente a
LEFT JOIN razones_sociales b ON a.id_razon_social=b.id
LEFT JOIN municipios c ON b.id_municipio = c.id
LEFT JOIN estados d ON b.id_estado=d.id
WHERE a.id_contrato=".$idRegistro."
ORDER BY a.id_contrato";

//DATE_ADD(DATE(a.fecha), INTERVAL b.dias_credito DAY)AS fecha_vigencia,

$consulta = mysqli_query($link,$query);
$row = mysqli_fetch_array($consulta);

//---datos almacen encabezado---
$folioContrato = date('Y-m').'-'.$row['folio_contrato'];
$idCotizacion = $row['id_cotizacion'];
$rs_cliente = $row['rs_cliente'];
$rfc = $row['rfc'];
$r_legal= $row['r_legal'];
$domicilio = $row['domicilio'];
$no_exterior = $row['no_exterior'];
$no_interior = $row['no_interior'];

$colonia = $row['colonia'];
$codigo_postal = $row['codigo_postal'];
$municipio = $row['municipio'];
$estado = $row['estado'];  

$precioMensual=0;
$buscaPrecioMensual="SELECT SUM(sub.precio_mensual)AS precio_mensual
FROM(
	SELECT 
	IFNULL(SUM(precio_total),0) AS precio_mensual
	FROM cotizacion_elementos  WHERE id_cotizacion=".$idCotizacion."
	UNION ALL
	SELECT 
	IFNULL(SUM(IF(tipo_pago = 1,precio_total,0)),0) AS precio_mensual
	FROM cotizacion_equipo WHERE id_cotizacion=".$idCotizacion."
	UNION ALL
	SELECT
	IFNULL(SUM(IF(tipo_pago = 1,precio_total,0)),0) AS precio_mensual
	FROM cotizacion_servicios WHERE id_cotizacion=".$idCotizacion."
	UNION ALL
	SELECT 
	IFNULL(SUM(IF(tipo_pago = 1,precio_total,0)),0) AS precio_mensual
	FROM cotizacion_vehiculos WHERE id_cotizacion=".$idCotizacion."
) sub";
      $resultTR = mysqli_query($link,$buscaPrecioMensual) or die(mysqli_error());
      $numTR = mysqli_num_rows($resultTR);
      $rowTR = mysqli_fetch_array($resultTR);

      $precioMensual=$rowTR['precio_mensual'];
        
      
?>
<style>

.texto{
    font-size:18px;
	font-weight:100;
}
.texto td{
    text-align:justify;
    line-height : 23px;
}

</style>
<!-- se usa para poner  marca de agua backimg="../images/logo_marca2.png" backimgy="380"-->
<page backtop="8mm" backright="8mm" backleft="8mm"  backbottom="8mm">

<table border="0" width="660" class="texto">
    <tr>
        <td width="660" align="right"> 
        <br><br>
        <strong>FOLIO: </strong><?php echo $folioContrato;?>
        </td>
    </tr>
    <tr>
        <td width="660">
            <br><br>
            Contrato de prestación de servicios profesionales de vigilancia y protección que celebran por una parte,   <strong style="text-decoration: underline solid black;">“<?php echo $rs_cliente;?>”</strong>, representada en este acto por <strong style="text-decoration: underline solid black;">“<?php echo $r_legal;?>”</strong>, a quien en lo sucesivo se le denominará <strong>“EL CLIENTE”</strong> y por la otra parte “SEGURIDAD PRIVADA GINTHER DE OCCIDENTE, S. DE R.L. DE C.V.” representada en este acto por el LIC. JORGE GINTHER ARZAGA, a quien en lo sucesivo se le denominará “EL PRESTADOR DEL SERVICIO”, los cuales se someten al contenido de las siguientes declaraciones y cláusulas.
        <br><br>
        </td>
    </tr>
    <tr>
        <td align="center">    
            <strong>DECLARACIONES:</strong>
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  

            <strong>I.-</strong> Declara <strong>“EL CLIENTE”</strong>  que su representada es una persona moral, constituida bajo las leyes mexicanas, cuyas instalaciones se ubican en (<strong style="text-decoration: underline solid black;">“<?php echo $domicilio.' No. '. $no_exterior;?>”</strong>), Código Postal <strong style="text-decoration: underline solid black;">“<?php echo $codigo_postal;?>”</strong> de Ciudad <strong style="text-decoration: underline solid black;">“<?php echo $municipio.", ".$estado;?>”</strong>, tributando bajo el número de Registro Federal de Contribuyentes <strong style="text-decoration: underline solid black;">“<?php echo $rfc;?>”</strong>.            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
            <strong>II.-</strong> Manifiesta <strong style="text-decoration: underline solid black;">“<?php echo $r_legal;?>”</strong> en su carácter de representante legal de <strong style="text-decoration: underline solid black;">“<?php echo $rs_cliente;?>”</strong>, bajo protesta de decir verdad, que cuenta con las facultades necesarias para celebrar el presente contrato.
             <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>III.-</strong> Continúa declarando <strong>“EL CLIENTE”</strong> que es su voluntad el contratar los servicios que “EL PRESTADOR DE SERVICIOS” otorga, consistentes en seguridad, prevención, vigilancia y protección en general a las instalaciones de la empresa contratante mediante guardias de seguridad dependientes de la corporación prestadora en los términos y condiciones que en este contrato se establecen. 
            <br><br>
        </td>
    </tr>
    <tr>
        <td align="center">  
        <strong>DECLARA EL PRESTADOR DEL SERVICIO:</strong>
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>IV.-</strong> Que su representada, <strong>“SEGURIDAD PRIVADA GINTHER DE OCCIDENTE, S. DE R.L. DE C.V.”</strong>, es una sociedad legalmente constituida conforme a las Leyes de los Estados Unidos Mexicanos, y autorizada para ejercer el comercio; que tiene como objeto, la prestación de servicios privados de seguridad en sus modalidades de protección y vigilancia a todo tipo de personas físicas o morales, entre otros, según lo acredita con testimonio de la Escritura Pública número 126,240, volumen 951, de fecha 29 de abril de 2009, pasada ante la fe del Lic. Francisco de Asís García Ramos, Notario Público número 09 del Distrito de Morelos, Estado de Chihuahua, debidamente inscrita en el Registro Público de la Propiedad y del Comercio, bajo folio mercantil número 25200*10, en fecha 27 de mayo de 2009.
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>V.-</strong> Que para efectos del presente contrato, <strong>“SEGURIDAD PRIVADA GINTHER DE OCCIDENTE, S.A. DE R.L. DE C.V.”</strong>, está representada por el Licenciado JORGE IVAN GINTHER ARZAGA, quien cuenta con facultades suficientes para celebrar el presente contrato, las cuales a la fecha no le han sido revocadas ni modificadas.
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>VI.-</strong> Que una parte de su objeto social consiste en la prestación de servicios de seguridad privada, protección, vigilancia y custodia a personas físicas y morales, así como a los bienes muebles e inmuebles de éstas; revisión canina a medios de transporte terrestres, así como revisión a empresas, escuelas, centros de diversión, etcétera. 
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>VII.-</strong> Que cuenta con la infraestructura completa y suficiente para satisfacer plenamente las necesidades del servicio que se contrata; así como, con las autorizaciones expedidas por la Secretaria del Trabajo y Previsión Social, Secretaria de Seguridad Pública del Gobierno Federal y la Secretaria de la Defensa Nacional, para prestar servicios en la modalidad de seguridad privada en toda la República Mexicana a través de personal debidamente seleccionado y capacitado para el correcto desempeño de dicho servicio. 
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>VIII.-</strong> Que su representada tiene su domicilio fiscal en Calle Cerrada de Barrocas número 6106, Plaza Barroca, C. P. 31215 en la Ciudad de Chihuahua, Chihuahua y que es voluntad de ésta celebrar el presente Contrato y obligarse en los términos que más adelante se indican.
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
            Las partes en su conjunto reconocen expresamente y declaran:
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>IX.-</strong> Que se reconocen mutuamente la personalidad y capacidad legal con las cuales concurren a la celebración del presente contrato, estando facultados los respectivos representantes para obligar a su mandante en los términos y condiciones que en el mismo se contienen.
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>X.-</strong> Que es su deseo e interés celebrar el presente Contrato en los términos, plazo y condiciones que en este contrato se establecen y anexos que forman parte del mismo.
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>XI.-</strong> En caso de que las partes cambien sus domicilios, se obligan a dar comunicación por escrito a la otra por lo menos 3 (tres) días de anticipación los cuales serán presentadas en las instalaciones de los domicilios anteriormente citados.
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
            De conformidad con las anteriores Declaraciones las partes de mutuo acuerdo convienen en celebrar el presente contrato de conformidad con las siguientes:
                <br><br>
        </td>
    </tr>
    <tr>
        <td align="center">  
        <strong>C L Á U S U L A S:</strong>
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>PRIMERA.– OBJETO DEL CONTRATO.</strong> La operación objeto del presente acuerdo de voluntades consistirá en la prestación de servicios de seguridad, prevención, vigilancia y protección de los bienes, personal, equipo, maquinaria, herramientas e instalaciones en general de la empresa contratante en esta ciudad de  Chihuahua, Chihuahua, mediante guardias de seguridad dependientes de <strong>“EL PRESTADOR”</strong>. 
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>SEGUNDA.-</strong> PERSONAL CONTRATADO. <strong>“EL PRESTADOR”</strong> para el debido cumplimiento del objeto de este contrato, se obliga a mantener en las instalaciones de la empresa contratante, una plantilla de tres (3) elementos de seguridad, cubriendo la vigilancia de lunes a domingo 7am a 7 pm y tres (1) elementos de seguridad de lunes a domingo de 7pm a 7 am, para así cubrir el servicio de vigilancia, a partir del día 15 de octubre de 2019; así mismo se hace mención  que <strong>“EL PRESTADOR”</strong> proporcionará equipo en comodato “AL CLIENTE” durante la vigencia del presente contrato, consistente en -----. 
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>TERCERA.- PAGO:</strong> Las partes establecen como precio o pago que  por los SERVICIOS  que  <strong>“EL PRESTADOR”</strong> se obliga a destinar y asignar a <strong>“EL CLIENTE”</strong>, la cantidad de <strong style="text-decoration: underline solid black;">“<?php echo dos_decimales($precioMensual);?>”</strong> (<strong style="text-decoration: underline solid black;">“<?php echo numtoletras($precioMensual);?>”</strong>) más I.V.A. mensual, misma que será pagada dentro de los primeros 5 días de cada mes a partir de la fecha fijada. Dicha suma solo será modificada únicamente en igual proporción al incremento del salario mínimo general al ser publicado en el Diario Oficial de la Federación.
            Este monto se puede modificar en función de los elementos que se tengan asignados y aceptados por <strong>“EL CLIENTE”</strong>.
            Sin perjuicio de lo anterior <strong>“EL CLIENTE”</strong> pagará las facturas correspondientes que acredite <strong>“EL PRESTADOR”</strong> a los treinta días de su presentación. 
            Las partes acuerdan que el retraso en el pago oportuno causará un interés moratorio del 2% diario por cada día de atraso.
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>CUARTA.– DURACION DEL CONTRATO.</strong> La duración del presente contrato será de un (1) año , obligatorio para ambas partes, contados a partir de la fecha de su firma del presente contrato, concluido dicho plazo el contrato solo se prorrogará mediante acuerdo que por escrito celebren las partes con por lo menos treinta días de anticipación.
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>QUINTA.– REMPLAZO DE PERSONAL.</strong> <strong>“EL PRESTADOR”</strong> se obliga a reemplazar de manera inmediata a aquellos elementos que <strong>“EL CLIENTE”</strong> no quiera por motivos justificados y se lo hará saber al “PRESTADOR” mediante simple notificación por escrito.
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>SEXTA.– INFORMACIÓN OPORTUNA.</strong> <strong>“EL PRESTADOR”</strong> tendrá la obligación de informar a <strong>“EL CLIENTE”</strong> de manera inmediata de cualquier problema, irregularidad o anomalía que se suscite con relación al personal e instalaciones en general de <strong>“EL CLIENTE”</strong> mediante un reporte que se entregará al personal encargado de la contratante.
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>SÉPTIMA.– EXIMENTE DE RESPONSABILIDAD.</strong> <strong>“EL PRESTADOR”</strong> no es responsable de las perdidas, daños o robos de los bienes inmuebles de los subcontratistas o terceras personas relacionadas con <strong>“EL CLIENTE”</strong>, en el cumplimiento de este contrato. 
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>OCTAVA.-  UNIFORMES DEL PERSONAL.</strong> <strong>“EL PRESTADOR”</strong> se obliga a uniformar de manera adecuada a los elementos de seguridad que destine para el cumplimiento del objeto del presente contrato.
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>NOVENA.- SUPERVICIÓN.</strong> <strong>“EL PRESTADOR”</strong> estará encargado de supervisar constantemente y durante la vigencia del presente instrumento a los elementos de seguridad que sean destinados para el cumplimiento del presente contrato. Así como garantizar de manera permanente el número de elementos que se señalan en la Cláusula Segunda del presente instrumento. <strong>“EL PRESTADOR”</strong> es responsable de que siempre se cuente con la plantilla completa. 
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>DÉCIMA.- OBLIGACIÓN PATRONAL.</strong> <strong>“EL PRESTADOR”</strong> será el único responsable de los trabajadores que en su caso empleare para la ejecución de este contrato y asumirá, frente a ellos, todas y cada una de las obligaciones patronales que contemplan las leyes en materia laboral y de seguridad social, por lo que deberá contar con documentos idóneos que acrediten su única y exclusiva relación laboral, tales como contratos laborales, altas de su personal ante el IMSS, AFORE e INFONAVIT y gafetes de la empresa de seguridad, obligándose también a presentar los documentos que así lo demuestren cuando <strong>“EL CLIENTE”</strong> se lo requiera.
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>DÉCIMA PRIMERA.-  REGLAMENTOS.</strong> <strong>“EL PRESTADOR”</strong> se obliga a hacer cumplir a los elementos de seguridad que destine para el cumplimiento del presente contrato con los reglamentos de seguridad, higiene y disciplina vigentes dentro de las instalaciones de <strong>“EL CLIENTE”</strong> y a reemplazar de manera inmediata a aquellos elementos que no cumplan con dichos reglamentos, debiendo el cliente hacer previamente del conocimiento del prestador de aquellas políticas y/o reglamentos de seguridad, higiene y/o disciplina que aplique en su empresa, dichos reglamentos serán entregados a <strong>“EL PRESTADOR”</strong> por parte de <strong>“EL CLIENTE”</strong> antes del inicio del servicio.
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>DÉCIMA SEGUNDA.– DE LA TERMINACION DEL CONTRATO.</strong> El presente contrato no podrá culminar de manera anticipada por voluntad unilateral, en la reserva de que se puede rescindir la relación contractual si alguna de las partes no cumple con lo que se ha obligado en el actual acuerdo de voluntades, sin estar obligados a cumplir con ninguna formalidad para los efectos de una posible rescisión bilateral solamente la cual se realizará por escrito de las partes.
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>DÉCIMA TERCERA.- CUESTIONES PREVENTIVAS.</strong> <strong>“EL PRESTADOR”</strong> entregará a <strong>“EL CLIENTE”</strong> de manera semestral un análisis de riesgo donde se mostrarán los puntos vulnerables que tenga la empresa, así como las mejoras que se soliciten, para lo cual <strong>“EL CLIENTE”</strong> puede, o realizar las mejoras o no realizarlas,  sin embargo si llegase a ocurrir algún percance debido a la omisión de las observaciones presentadas en el análisis de riesgo,  <strong>“EL PRESTADOR”</strong> no se hará responsable de las consecuencias económicas de dicho percance; así mismo cabe mencionar que en caso de generarse alguna cantidad imputable al “PRESTADOR” que tuviese que pagar al <strong>“EL CLIENTE”</strong>, deberá de existir la denuncia correspondiente ante el órgano investigador; dicha cantidad tendrá que ser emitida por perito valuador y una vez emitido el peritaje oficial en cuanto al detrimento patrimonial que el cliente haya sufrido, <strong>“EL PRESTADOR”</strong> cubrirá el pago de la cantidad señalada por el perito oficial, si de la investigación se determinó que fue responsabilidad por acción y/u omisión de alguno de los elementos del <strong>“EL PRESTADOR”</strong>.
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>DÉCIMA CUARTA.- RESPONSABILIDAD LABORAL.</strong> Es aquella que sobreviene a <strong>“EL PRESTADOR”</strong> a virtud de los servicios que le prestan sus trabajadores.
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
            Ambas partes al celebrar este contrato, expresamente manifiestan que es de naturaleza estrictamente civil y por tal circunstancia, los servicios contratados se prestaran con los propios elementos de que dispone <strong>“EL PRESTADOR”</strong>, por lo que si éste, requiriera contratar a su vez trabajadores para el cumplimiento de sus objetivos, la relación laboral será única y exclusivamente entre <strong>“EL PRESTADOR”</strong> y las personas que le presten sus servicios, pues al margen del presente contrato, <strong>“EL PRESTADOR”</strong> acepta contar con elementos propios con los que se desempeñarán los servicios contratados y cuenta además, con los recursos económicos necesarios y suficientes para cumplir con las obligaciones laborales que llegare a asumir con sus empleados, por lo que libera a <strong>“EL CLIENTE”</strong> de cualquier tipo de responsabilidad laboral que <strong>“EL PRESTADOR”</strong> configure con terceras personas.
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
            Además ambas partes manifiestan que por medio del presente contrato no se crea ningún vínculo laboral o de cualquier otro tipo entre <strong>“EL CLIENTE”</strong> y <strong>“EL PRESTADOR”</strong>, ni entre <strong>“EL CLIENTE”</strong> y los empleados actuales o futuros de <strong>“EL PRESTADOR”</strong>, quien es el único patrón del personal que ocupe para brindar el servicio, por lo que toda la responsabilidad laboral es única y exclusivamente de <strong>“EL PRESTADOR”</strong>, haciéndose responsable éste, de todas y cada una de las obligaciones laborales que tenga con sus empleados, incluyéndose obligaciones fiscales y las relacionadas con las cuotas obrero patronales, incluyéndose los pagos del Instituto Mexicano del Seguro Social (IMSS) y del Instituto del Fondo Nacional de la Vivienda para los Trabajadores (INFONAVIT).
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
            <strong>“EL PRESTADOR”</strong> se obliga a sacar a salvo y en paz a <strong>“EL CLIENTE”</strong> en caso de que se presente cualquier tipo de conflicto laboral. 
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
            <strong>“EL PRESTADOR”</strong> será el único responsable de los trabajadores que en su caso empleare para la ejecución de este contrato y asumirá, frente a ellos, todas y cada una de las obligaciones patronales que contemplan los ordenamientos legales en materia laboral y de seguridad social.
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
            Congruente con lo anterior <strong>“EL PRESTADOR”</strong> se obliga a atender las reclamaciones judiciales o extrajudiciales que le llegaren a formular dichos trabajadores en las que involucre a su contraparte, y se compromete a sacar a ésta en paz y a salvo de tales circunstancias.
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
            En consecuencia, <strong>“EL PRESTADOR”</strong> queda en libertad de dedicarse por cuenta propia al ejercicio de su actividad en la forma y términos que convengan a sus intereses y pacte con terceros.
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
            Así mismo <strong>“EL PRESTADOR”</strong> faculta a <strong>“EL CLIENTE”</strong>, para que este último retenga y disponga de los créditos que existan a favor de <strong>“EL PRESTADOR”</strong>, en caso de que éste incumpla con sus obligaciones laborales, como son el pago de salarios, indemnizaciones o cualquier tipo de prestación laboral, así como también en caso de que incumpla con sus obligaciones fiscales ante el IMSS, INFONAVIT, SAT y AFORES. 
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>DÉCIMA QUINTA.– OBLIGACIONES FISCALES.</strong> <strong>“EL PRESTADOR”</strong> se obliga con <strong>“EL CLIENTE”</strong> a dar el exacto y debido cumplimiento a su costa, de todas y cada una de las obligaciones fiscales, administrativas, judiciales que pudieran corresponderle por la ejecución y cumplimiento del presente contrato. El incumplimiento a dicha obligación facultará <strong>“EL CLIENTE”</strong> a rescindir este contrato sin necesidad de declaración judicial al efecto, y a ejercitar las acciones civiles y/o penales que correspondan, así como a exigir de su contraparte el pago de los daños y perjuicios que dicho incumplimiento le cause.
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>DÉCIMA SEXTA.– DE LAS CONFIDENCIALIDAD DE DATOS PERSONALES.</strong> Las partes se obligan en este acto que de manera permanente e indefinida, aún después de terminada la relación profesional, comercial y/o de negocios a guardar en el más absoluto secreto y confidencialidad, de toda la información pactada en el presente acto jurídico, que de cualquier modo se ponga a su disposición o haga de su conocimiento por cualquier medio, cualquiera que sea su naturaleza. 
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>DÉCIMA SÉPTIMA.– DE LAS MODIFICACIONES.</strong> <strong>“EL CLIENTE”</strong> podrá en cualquier tiempo modificar los términos respecto a las condiciones de la prestación del servicio contemplado en el presente contrato, por lo que al mismo tiempo <strong>“EL PRESTADOR”</strong>, actualizara los costos por dichas modificaciones en mención, las cuales se integrarán al presente instrumento y formará parte integral del mismo compromiso contractual. 
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>DÉCIMA OCTAVA.– DE LA FALSEDAD EN DECLARACIONES.</strong> En el caso de incumplimiento de cualquiera de “LAS PARTES” respecto a las presentes obligaciones que se adquieren en este instrumento o que cualesquiera de las declaraciones fuesen falsas o inexactas facultará a la parte diversa parte contractual a elegir entre demandar a su contraparte el cumplimiento forzoso o su rescisión y en ambos casos, a exigirle la reparación y el pago de los daños y perjuicios que le ocasionaré su incumplimiento.
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>DÉCIMA NOVENA.– DE LA TERMINACION DE OBLIGACIONES PREVIAS.</strong> Las partes convienen en que todo acuerdo verbal y/o escrito celebrado con anterioridad a la firma del presente instrumento, relacionado con la operación que en este acto se celebra, se dará por terminado, sin responsabilidad para las partes, ya que el presente instrumento reúne todas y cada una de las condiciones y términos pactados con anticipación, cualquier nuevo acuerdo deberá ser por escrito y firmado por las partes, formará parte del presente contrato.
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>VIGÉSIMA.– DE LA CAPACITACIÓN.</strong> <strong>“EL PRESTADOR”</strong> establecerá los programas específicos de capacitación y adiestramiento de su personal, así como su filosofía interna de la empresa, con respecto al seguimiento de políticas procedimientos para todo su personal, de acuerdo a las necesidades y circunstancias que <strong>“EL CLIENTE”</strong> requiera. 
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
        <strong>VIGÉSIMA PRIMERA.– DE LA JURISDICCIÓN.</strong> Ambas partes se someten expresamente a la Jurisdicción de los Tribunales del fuero común de este Distrito Morelos y a las leyes civiles del estado de Chihuahua para todo lo relativo a las gestiones que se susciten sobre la interpretación y cumplimiento de este contrato.    
            <br><br>
        </td>
    </tr>
    <tr>
        <td>  
            Una vez que ambas partes leyeron el contenido del presente contrato, manifestaron su conformidad con el mismo, firmando para constancia el día quince del mes de octubre de dos mil diecinueve.

            <br><br>
        </td>
    </tr>
    <tr>
        <td align="center">  
            <strong>“EL PRESTADOR DEL SERVICIO”</strong>
            <br><br><br>

            <strong>LIC. JORGE IVAN GINTHER ARZAGA</strong>
            <br><br>
            <strong> Representante legal de </strong>
            <br><br>
            <strong> “SECORP ALARMAS DE JUAREZ” S. DE R.L DE C.V.”</strong>


            <strong>“EL CLIENTE”</strong>
            <br>
            -------------------- 
            <strong><?php echo $r_legal;?><br>Representante legal de </strong>
            <br><br>
            <strong><?php echo $rs_cliente;?></strong>
        </td>
    </tr>
</table>            




</page>
          
<?php 

function fecha($fecha) {
    list($anyo, $mes, $dia) = explode("-", $fecha);
    $fechamod = $dia . "/" . $mes . "/" . $anyo;
    return $fechamod;
}
function dos_decimales($number, $fractional=true) { 
    if ($fractional) { 
        $number = sprintf('%.2f', $number); 
    } 
    while (true) { 
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number); 
        if ($replaced != $number) { 
            $number = $replaced; 
        } else { 
            break; 
        } 
    } 
    return '$'.$number; 
}
?>
