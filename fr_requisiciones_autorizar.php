<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GINTHERCORP</title>
    <!-- Hojas de estilo -->
    <link href="css/css/bootstrap.css" rel="stylesheet"  type="text/css" media="all">
    <link href="css/validationEngine.jquery.css" rel="stylesheet" />
    <link href="css/bootstrap-datepicker.standalone.min.css" rel="stylesheet"/>
    <link href="css/general.css" rel="stylesheet"  type="text/css"/>
    <link href="vendor/font_awesome/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet">
    <link href="vendor/select2/css/select2.css" rel="stylesheet"/>
</head>

<style> 
    body{
        background-color:rgb(238,238,238);
    }
    #div_principal{
        padding-top:20px;
    }
    #div_contenedor{
        background-color: #ffffff;
    }
   
    #vistaPrevia_1{
        border: 1px solid rgb(214, 214, 194); 
        background-color: #fff; 
        max-height: 55px; 
        min-height: 55px;
        width:100px;
    }
    .Autorizada{
        color:green;
    }

    
</style>

<body>
    <div class="container-fluid" id="div_principal">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-offset-1 col-md-10" id="div_contenedor">
            <br>
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <div class="titulo_ban">Autorizar Requisiciones</div>
                    </div>
                    <div class="col-sm-12 col-md-2"></div>
                    <div class="col-sm-12 col-md-3">
                        <button type="button" class="btn btn-danger btn-sm form-control" id="b_requis_rechazadas_presupuesto"><i class="fa fa-eye" aria-hidden="true"></i> Rechazadas por Presupuesto</button>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <button type="button" class="btn btn-dark btn-sm form-control" id="b_reactivar"><i class="fa fa-unlock-alt " aria-hidden="true"></i> Reactivar No Aprobadas</button>
                    </div>
                </div>
                <br>
                <div class="row">
                <div class="col-sm-12 col-md-6"></div>
                    <div class="alert alert-info" role="alert">
                       * Por default muestra las Requisiciones hechas en el mes actual.
                    </div>
                </div>    
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <input type="text" name="i_filtro_autorizar" id="i_filtro_autorizar" class="form-control filtrar_renglones" alt="renglon_autorizar" placeholder="Filtrar" autocomplete="off">
                    </div>

                    <div class="col-sm-12 col-md-6">
                       <div class="form-group row">
                            <div class="col-sm-12 col-md-12">
                                <div class="row">
                                    <div class="col-sm-12 col-md-1">Del: </div>
                                    <div class="input-group col-sm-12 col-md-5">
                                        <input type="text" name="i_fecha_inicio" id="i_fecha_inicio" class="form-control form-control-sm fecha" autocomplete="off" readonly>
                                        <div class="input-group-addon input_group_span">
                                            <span class="input-group-text">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-1">Al: </div>
                                    <div class="input-group col-sm-12 col-md-5">
                                        <input type="text" name="i_fecha_fin" id="i_fecha_fin" class="form-control form-control-sm fecha" autocomplete="off" readonly>
                                        <div class="input-group-addon input_group_span">
                                            <span class="input-group-text">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                
                <br>
                <div class="row">
                <div class="col-sm-12 col-md-12">
                    <table class="tablon"  id="t_autorizar">
                      <thead>
                        <tr class="renglon">
                          <th scope="col">Unidad Negocio</th>
                          <th scope="col">Clave Suc</th>
                          <th scope="col">Sucursal</th>
                          <th scope="col">Folio</th>
                          <th scope="col">Capturó</th>
                          <th scope="col">Fecha Creación</th>
                          <th scope="col">Descripción General</th>
                          <th scope="col">Importe Total</th>
                          <th scope="col">Tipo</th>
                          <th scope="col">PDF</th>
                          <th scope="col">Estatus</th>
                          <th scope="col">Autorizar</th>
                          <th scope="col">Rechazar</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>  
                </div>

                </div>
                <br>

            </div> <!--div_contenedor-->
        </div>      

    </div> <!--div_principal-->

<div id="dialog_reactivar" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reactivar Requisición</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <form id="formaReactivar" name="formaReactivar">

                    <div class="form-group row">
                        <label for="i_folio" class="col-sm-3 col-md-3 col-form-label">Requisición </label>
                        <div class="col-sm-12 col-md-5">
                             <input type="text" class="form-control" id="i_folio" disabled="disabled" placeholder="Buscar Requisición" autocomplete="off">
                        </div>
                        <div class="col-sm-1 col-md-1">
                            <button type="button" class="btn btn-info btn-sm" id="b_buscar_requis"><span class="fa fa-search"></span> Buscar</button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="i_solicito" class="col-sm-3 col-md-3 col-form-label">Solicito </label>
                        <div class="col-sm-12 col-md-5">
                            <input type="text" class="form-control validate[required]" id="i_solicito" disabled="disabled" autocomplete="off">
                        </div>
                    </div>
                   
                    <div class="form-group row">
                        <label for="i_departamento" class="col-sm-3 col-md-3 col-form-label">Departamento que Solicitó</label>
                            <div class="col-sm-12 col-md-3">
                                <input type="text" class="form-control validate[required]" id="i_departamento" disabled="disabled" placeholder="Departamento que solicitó" autocomplete="off">
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="i_fecha_pedido" class="col-sm-3 col-md-3 col-form-label">Fecha Pedido</label>
                            <div class="col-sm-12 col-md-3">
                                <input type="text" class="form-control validate[required]" id="i_fecha_pedido" disabled="disabled" placeholder="Fecha Pedido" autocomplete="off">
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="i_descripcion" class="col-sm-3 col-md-3 col-form-label">Descripción</label>
                            <div class="col-sm-12 col-md-8">
                                <input type="text" class="form-control validate[required]" id="i_descripcion" disabled="disabled" placeholder="Decsripción" autocomplete="off">
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="i_costo" class="col-sm-3 col-md-3 col-form-label">Costo</label>
                            <div class="col-sm-12 col-md-3">
                                <input type="text" class="form-control validate[required]" id="i_costo" disabled="disabled" placeholder="Costo" autocomplete="off">
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="i_estatus" class="col-sm-3 col-md-3 col-form-label">Estatus</label>
                            <div class="col-sm-12 col-md-3">
                                <input type="text" class="form-control validate[required]" id="i_estatus" disabled="disabled" placeholder="Estatus" autocomplete="off">
                            </div>
                    </div>

        
                </form>
            </div>

        </div>
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-dark btn-sm" id="b_reactivar_guardar"><i class="fa fa-unlock-alt " aria-hidden="true"></i> Reactivar</button>
                   
        <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div id="dialog_buscar_requis" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Búsqueda de Requisiciones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-sm-12 col-md-6"><input type="text" name="i_filtro_requis" id="i_filtro_requis" class="form-control filtrar_renglones" alt="renglon_requis" placeholder="Filtrar" autocomplete="off"></div>
            </div>    
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <table class="tablon"  id="t_requis">
                      <thead>
                        <tr class="renglon">
                          <th scope="col">Folio</th>
                          <th scope="col">Fecha</th>
                          <th scope="col">Descripción</th>
                          <th scope="col">Costo</th>
                          <th scope="col">Estatus</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>  
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="dialog_archivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Requisición</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			    
			</div>
			<div class="modal-body">
					<div style="width:100%" id="div_archivo"></div>
			</div>
		
		</div>
	</div>
</div>

<div class="modal fade" id="dialog_presupuesto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Requisición Rechazadas por Presupuesto</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			    
			</div>
			<div class="modal-body">
            <div class="row">
                <div class="col-sm-12 col-md-6"><input type="text" name="i_filtro_requis_presupuesto" id="i_filtro_requis_presupuesto" class="form-control filtrar_renglones" alt="renglon_requis_presupuesto" placeholder="Filtrar" autocomplete="off"></div>
            </div>    
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <table class="tablon"  id="t_requis_presupuesto">
                      <thead>
                        <tr class="renglon">
                          <th scope="col">Unidad Negocio</th>
                          <th scope="col">Clave Suc</th>
                          <th scope="col">Sucursal</th>
                          <th scope="col">Folio</th>
                          <th scope="col">Descripción General</th>
                          <th scope="col">Importe Total</th>
                          <th scope="col">Tipo</th>
                          <th scope="col">PDF</th>
                          <th scope="col">Estatus</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>  
                </div>
			</div>
		
		</div>
	</div>
</div>
    
</body>

<script src="js/jquery3.3.1/jquery-3.3.1.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/js/bootstrap.js"></script>
<script src="js/jquery.validationEngine.js"></script>
<script src="js/jquery.validationEngine-es.js"></script>
<script src="js/general.js"></script>
<script src="js/bootstrap-datepicker.min.js"></script>
<script src="vendor/select2/js/select2.js"></script>

<script>

    var modulo='AUTORIZAR_REQUISICIONES';
    var idUnidadActual=<?php echo $_SESSION['id_unidad_actual']?>;
    var idsUnidades=',<?php echo $_SESSION['unidades']?>';//--MGFS SE AGREGA UNA , PARA QUE IDENTIFIQUE LAS UNIDADDES
    var idUsuario=<?php echo $_SESSION['id_usuario']?>;
    $(function(){
   
        mostrarBotonAyuda(modulo);

        $('.fecha').datepicker({
            format : "yyyy-mm-dd",
            autoclose: true,
            language: "es",
            todayHighlight: true,
        });

        $('#i_fecha_inicio').val(primerDiaMes);
        $('#i_fecha_fin').val(ultimoDiaMes).prop('disabled',true);

        $('#i_fecha_inicio').change(function(){
            if($('#i_fecha_inicio').val() != '')
            {
                $('#i_fecha_fin').prop('disabled',false);
                buscarInformacion(muestraSucursalesPermisoListaId(idsUnidades,modulo,idUsuario));
            }
        });

        $('#i_fecha_fin').change(function(){
            buscarInformacion(muestraSucursalesPermisoListaId(idsUnidades,modulo,idUsuario));
        });



        buscarInformacion(muestraSucursalesPermisoListaId(idsUnidades,modulo,idUsuario));

       function buscarInformacion(idsSucursales){
    
            $('#forma').validationEngine('hide');
            $('#i_filtro_autorizar').val('');
            $('.renglon_autorizar').remove();
   
            $.ajax({

                type: 'POST',
                url: 'php/autorizar_buscar.php',
                dataType:"json", 
                data:{'idsUnidades' : idsUnidades,
                      'idUsuario' : idUsuario,
                      'idsSucursales':idsSucursales,
                      'fechaInicio' : $('#i_fecha_inicio').val(),
                      'fechaFin' : $('#i_fecha_fin').val()
                },

                success: function(data) {
                 
                   console.log('Resultado:'+data);
                   if(data.length != 0){

                        $('.renglon_autorizar').remove();
                   
                        for(var i=0;data.length>i;i++){
                            

                            var autorizada=(data[i].estatus=='Autorizada')?'checked':'';
                            
                            var rechazada=(data[i].estatus=='Rechazada')?'checked':'';
                            //--MGFS 20-12-2019 se quita la  restriccion de autorizacion por montos DEN18-2433 AUTORIZAR REQUISICIÓN (3)
                            //-- solo se deja en el modulo de autorizar presupuesto
                            //var editar=(data[i].editar=='no')?'disabled':'';
                            var editar='';

                            var i_autorizar='<input type="checkbox" id="r_estatus_' + data[i].id+'" name="r_estatus_' + data[i].id+'" class="r_estatus" alt="'+data[i].id+'"  alt2="'+data[i].folio+'" value="2" '+autorizada+' '+editar+' estatus="'+data[i].estatus_numero+'">';
                            var i_rechazar='<input type="checkbox" id="r_estatus_' + data[i].id+'" name="r_estatus_' + data[i].id+'" class="r_estatus" alt="'+data[i].id+'" alt2="'+data[i].folio+'" value="3" '+rechazada+' '+editar+' estatus="'+data[i].estatus_numero+'">';
                            var iconoPdf='<button type="button" class="btn btn-success btn-sm form-control" alt="' + data[i].id+'" id="b_pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>';
                            var html='<tr class="renglon_autorizar '+data[i].estatus+'">\
                                       <td data-label="Unidad de Negocio">' + data[i].unidad_negocio+ '</td>\
                                        <td data-label="Clave Sucursal">' + data[i].clave_suc+ '</td>\
                                        <td data-label="Sucursal">' + data[i].sucursal+ '</td>\
                                        <td data-label="Folio">' + data[i].folio+ '</td>\
                                        <td data-label="Folio">' + data[i].usuarioCapturo+ '</td>\
                                        <td data-label="Folio">' + data[i].fechaCreacion+ '</td>\
                                        <td data-label="Descripción General">' + data[i].descripcion+ '</td>\
                                        <td data-label="Importe Total">' + formatearNumero(data[i].total)+ '</td>\
                                        <td data-label="Tipo">' + data[i].tipo+ '</td>\
                                        <td data-label="PDF">' + iconoPdf+ '</td>\
                                        <td data-label="Estatus">' + data[i].estatus+ '</td>\
                                        <td data-label="Autorizar Rechazar">' + i_autorizar+ '</td>\
                                        <td data-label="Nombre">' + i_rechazar+ '</td>\
                                    </tr>';
                            ///agrega la tabla creada al div 
                            $('#t_autorizar tbody').append(html);   
                        }

                   }else{

                        mandarMensaje('No se encontró información');
                   }

                },
                error: function (xhr) {
                    console.log('autorizar_buscar.php --> '+JSON.stringify(xhr));
                    mandarMensaje('* Error en el sistema');
                }
            });
        }
        
        /* funcion que manda a generar la insecion o actualizacion de un registro */    
        $(document).on('click','.r_estatus',function(){
            
            //-->NJES Jan/28/2020 si viene de requisicion autorizada, verificar si el cxp generado 
            //tiene abonos sin cancelar o ya fue liquidado el cxp inicial, si es asi ya no podra
            //poner la requi como pendiente o rechazada hasta que en cxp se cancelen los movimientos
            if($(this).attr('estatus') == 2)
            {
                var id=$(this).attr('alt');
                var folio=$(this).attr('alt2');

                if(existeCxpRequisicion(id) > 0)
                {
                    buscarInformacion(muestraSucursalesPermisoListaId(idsUnidades,modulo,idUsuario));
                    mandarMensaje('No es posible cambiar el estatus de la requisición ya que cuenta con un registro ligado en cxp');
                }else{
                    var estatus=$(this).val();

                    if($(this).is(':checked')==false){
                        estatus = 1;
                    }
                    
                    guardarEstatus(id,folio,estatus,'check');
                }
            }else{
                var id=$(this).attr('alt');
                var folio=$(this).attr('alt2');
                var estatus=$(this).val();

                if($(this).is(':checked')==false){
                    estatus = 1;
                }
                
                guardarEstatus(id,folio,estatus,'check');
            }

        });

        function existeCxpRequisicion(idRequisicion){
            var dato = 0;

            $.ajax({
                type: 'POST',
                url: 'php/autorizar_buscar_cxp_requisicion.php',
                dataType:"json", 
                data:{'idRequisicion' : idRequisicion},
                async: false, //-->quita asincrono para que pueda returnar el valor cuando ya se haya terminado el proceso ajax
                success: function(data) {
                    dato = data;
                },
                error: function (xhr) {
                    console.log('autorizar_buscar_cxp_requisicion.php --> '+JSON.stringify(xhr));
                    mandarMensaje('* No se encontro información al buscar si la requisición registro anticipo en cxp');
                }
            });

            return dato;
        }

        $(document).on('click','#b_reactivar_guardar',function(){
            var id=$('#i_folio').attr('alt');
            var folio=$('#i_folio').val();

            if(id>0){
                guardarEstatus(id,folio,1,'b_reactivar_guardar');
            }else{
                mandarMensaje('Debes seleccionar primero una requisición');
            }
        });

        function guardarEstatus(id,folio,estatus,boton)
        {

          // autorizand
          $.ajax(
          {
              type: 'POST',
              url: 'php/autorizar_guardar.php', 
              data: {
                 'id':  id,
                 'estatus' : estatus 
              },
              //una vez finalizado correctamente
              success: function(data)
              {

                  //console.log('verificando ');                  
                  //console.log(data);
                  if (data > 0 ) 
                  {

                      buscarInformacion(muestraSucursalesPermisoListaId(idsUnidades,modulo,idUsuario));
                      if(boton=='check')
                       {

                          if (estatus == 2)
                              mandarMensaje('La requisición: '+folio+' se Autorizó correctamente');
                          else if(estatus == 3)
                              mandarMensaje('La requisición: '+folio+' se Rechazó correctamente');

                      }
                      else
                      {
                          mandarMensaje('La requisición: '+folio+' se Reactivó correctamente');
                          $('#dialog_reactivar').modal('hide');
                      }

                  }
                  else
                  {
                      mandarMensaje('Error en el guardado');
                      buscarInformacion(muestraSucursalesPermisoListaId(idsUnidades,modulo,idUsuario));
                  }

              },
                  //si ha ocurrido un error
               error: function(xhr){
                  console.log('autorizar_guardar.php --> '+JSON.stringify(xhr));
                  mandarMensaje("* Ha ocurrido un error.");
              }
          });  
                
        }

        $('#b_reactivar').on('click',function(){
            $('#formaReactivar input').val('');
            $('#dialog_reactivar').modal('show');
        });

        $('#b_buscar_requis').on('click',function(){
            $('#i_filtro_requis').val('');
            $('.renglon_requis').remove();
   
            $.ajax({

                type: 'POST',
                url: 'php/autorizar_buscar_requis_reactivar.php',
                dataType:"json", 
                data:{'idsUnidades' : idsUnidades,
                      'idUsuario' : idUsuario,
                      'idsSucursal' : muestraSucursalesPermisoListaId(idsUnidades,modulo,idUsuario)
                },
                success: function(data) {
                 
                   if(data.length != 0){

                        $('.renglon_requis').remove();
                   
                        for(var i=0;data.length>i;i++){
                            
                            var html='<tr class="renglon_requis" alt="'+data[i].id+'" alt2="'+data[i].folio+'">\
                                        <td data-label="usuario">' + data[i].folio+ '</td>\
                                        <td data-label="usuario">' + data[i].fecha_pedido+ '</td>\
                                        <td data-label="Nombre">' + data[i].descripcion+ '</td>\
                                        <td data-label="usuario">' + data[i].total+ '</td>\
                                        <td data-label="Nombre">' + data[i].estatus+ '</td>\
                                    </tr>';
                            ///agrega la tabla creada al div 
                            $('#t_requis tbody').append(html);  
                            $('#dialog_buscar_requis').modal('show'); 
                        }
                   }else{

                        mandarMensaje('No se encontró información');
                   }

                },
                error: function (xhr) {
                    console.log('autorizar_buscar_requis_reactivar.php --> '+JSON.stringify(xhr));
                    mandarMensaje('* Error en el sistema');
                }
            });
            $('#dialog_reactivar').modal('show');
        });

        $('#t_requis').on('click', '.renglon_requis', function() {
            
            var idRequisicion = $(this).attr('alt');
            
            $('#dialog_buscar_requis').modal('hide');
            muestraRegistro(idRequisicion);


        });



        function muestraRegistro(idRequisicion){ 
           
            $.ajax({
                type: 'POST',
                url: 'php/autorizar_buscar_requis_reactivar_id.php',
                dataType:"json", 
                data:{
                    'idRequisicion':idRequisicion
                },
                success: function(data) {
                    
                    $('#i_folio').attr('alt',idRequisicion).val(data[0].folio);
                    $('#i_solicito').val(data[0].solicito);
                    $('#i_departamento').val(data[0].departamento);
                    $('#fecha_pedido').val(data[0].fecha_pedido);
                    $('#i_descripcion').val(data[0].descripcion);
                    $('#i_costo').val(data[0].costo);
                    $('#i_estatus').val(data[0].estatus);
                   
                },
                error: function (xhr) {
                    console.log('autorizar_buscar_requis_reactivar_id.php -->'+JSON.stringify(xhr));
                    mandarMensaje('* '+xhr.responseText);
                }
            });
        }

         /******* Al dar click sobre alguna cotizacion esta manda a buscar los datos de la cotizacion selecionada *********/
         $(document).on('click', '#b_pdf', function() {
          
           var idRequi = $(this).attr('alt');
           var folio = $(this).attr('alt2');
           
           var datos = {
               'path':'formato_requisicion',
               'idRegistro':idRequi,
               'tipo':2,
               'vp':'vp_requi'
           };

            let objJsonStr = JSON.stringify(datos);
            let datosJ = datosUrl(objJsonStr);
           
           $.post('php/convierte_pdf.php',{
               'D':JSON.stringify(datosJ)
               },function(data){
                   setTimeout (mandaGenerarPDF(idRequi), 10000); 
               });

           
          


       });
       /******* Fin de click sobre renglon cotizacion  *********/

    function mandaGenerarPDF(idRequi){
        
        var idRazonSocial=$('#i_id_razon_social_c').val();
        $("#div_archivo").empty(); 
        
        var ruta='formatosPdf/formato_vp_requisicion_'+idRequi+'.pdf';
        
        var fil="<embed width='100%' height='500px' src='"+ruta+"'>";
        $("#div_archivo").append(fil);  

        $('#dialog_archivo').modal('show');
    }


    $('#b_requis_rechazadas_presupuesto').on('click',function(){
        
       
        $('#i_filtro_requis_presupuesto').val('');
        $('.renglon_requis_presupuesto').remove();

        $.ajax({

            type: 'POST',
            url: 'php/autorizar_buscar_rechazadas_presupuesto.php',
            dataType:"json", 
            data:{'idsUnidades' : idsUnidades,
                'idUsuario' : idUsuario,
                'idsSucursales' : muestraSucursalesPermisoListaId(idsUnidades,modulo,idUsuario)
            },

            success: function(data) {
        
            if(data.length != 0){

                    $('.renglon_requis_presupuesto').remove();
            
                    for(var i=0;data.length>i;i++){
                    
                        var iconoPdf='<button type="button" class="btn btn-success btn-sm form-control" alt="' + data[i].id+'" id="b_pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>';
                        var html='<tr class="renglon_requis_presupuesto '+data[i].estatus+'">\
                                <td data-label="usuario">' + data[i].unidad_negocio+ '</td>\
                                    <td data-label="usuario">' + data[i].clave_suc+ '</td>\
                                    <td data-label="Nombre">' + data[i].sucursal+ '</td>\
                                    <td data-label="usuario">' + data[i].folio+ '</td>\
                                    <td data-label="Nombre">' + data[i].descripcion+ '</td>\
                                    <td data-label="usuario">' + data[i].total+ '</td>\
                                    <td data-label="usuario">' + data[i].tipo+ '</td>\
                                    <td data-label="usuario">' + iconoPdf+ '</td>\
                                    <td data-label="Nombre"> Rechazada </td>\
                                </tr>';
                        ///agrega la tabla creada al div 
                        $('#t_requis_presupuesto tbody').append(html); 
                        $('#dialog_presupuesto').modal('show');  
                    }

            }else{

                    mandarMensaje('No se encontró información');
            }

            },
            error: function (xhr) {
                console.log('autorizar_buscar_rechazadas_presupuesto.php --> '+JSON.stringify(xhr));
                mandarMensaje('* Error en el sistema');
            }
        });
    });
    
    });

</script>

</html>