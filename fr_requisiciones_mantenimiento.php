<?php session_start(); ?>
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
    #div_principal,
    #div_proveedor{
      position: absolute;
      top:0px;
      left:-101%;
      height: 100%;
      background-color: rgba(250,250,250,0.6);
      
    }
    #div_contenedor{
        background-color: #ffffff;
    }
    #div_t_montos_nomina{
        height:170px;
        overflow:auto;
    }
    #td_descripcion{
        width:30%;
    }
    #td_clave{
        width:10%;
    }

    .izquierda { 
        text-align: right; 
    }

    .tr_totales th{
        border:none;
        background:rgba(231,243,245,0.6);
        font-weight:bold;
        font-size:11px;
        text-align:right;
    }
    .tr_totales th input{
        font-weight:bold;
        font-size:11px;
        text-align:right;
        margin-right:10px;
        padding-right:10px;
    }

    #d_estatus{
       padding-top:7px;
       text-align:center;
       font-weight:bold;
       font-size:15px;
       height:40px;
       vertical-align:middle;
   }

   #dialog_buscar_requisiciones > .modal-lg{
        min-width: 80%;
        max-width: 80%;
    } 

    /* Responsive Web Design */
    @media only screen and (max-width:768px){
        .tablon{
            margin-top:10px;
        }
        #div_t_montos_nomina{
            height:auto;
            overflow:auto;
        }
        #td_descripcion{
            width:100%;
        }
        #td_clave{
            width:100%;
        }
        #dialog_buscar_requisiciones > .modal-lg{
            max-width: 100%;
        }
    }

    .excede > td {
        background : #FFF3CD;
        color:#93751B;
    }
    
</style>

<body>
<div class="container-fluid" id="div_principal">
    <form id="f_requisiciones" name="f_requisiciones">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-offset-1 col-md-10" id="div_contenedor">
            <br>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <div class="titulo_ban">Requisiciones Mantenimiento</div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <button type="button" class="btn btn-primary btn-sm form-control" id="b_buscar"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <button type="button" class="btn btn-dark btn-sm form-control" id="b_nuevo"><i class="fa fa-file-o" aria-hidden="true"></i> Nuevo</button>
                    </div>
                    
                    <div class="col-sm-12 col-md-2">
                        <button type="button" class="btn btn-dark btn-sm form-control" id="b_guardar"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <button type="button" class="btn btn-primary btn-sm form-control" id="b_imprimir"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
                    </div>
                </div>
                <br>
                <div class="row">
            
                    <label for="i_folio_mantenimiento" class="col-sm-2 col-md-2" style="text-align:center;"><strong>Folio Mantenimiento</strong></label>
                    
                    <div class="col-sm-12 col-md-2" >
                        <input type="text" id="i_folio_mantenimiento" name="i_folio_mantenimiento" class="form-control izquierda" readonly autocomplete="off"/>
                    </div>
                    <label for="i_folio" class="col-sm-2 col-md-2" style="text-align:center;"><strong>Folio Requisición</strong></label>
                    
                    <div class="col-sm-12 col-md-2" >
                        <input type="text" id="i_folio" name="i_folio" class="form-control izquierda" readonly autocomplete="off"/>
                    </div>

                    <div class="col-sm-12 col-md-2">
                        <div id="d_estatus" class="alert"></div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <button type="button" class="btn btn-danger btn-sm form-control" id="b_cancelar"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>
                    </div>

                </div>

                <div class="row">

                    <div class="col-sm-12 col-md-3">
                        <label for="s_id_unidad" class="col-sm-2 col-md-12  col-form-label requerido">Unidad de Negocio </label>
                        <div class="col-sm-12 col-md-12">
                            <select id="s_id_unidad" name="s_id_unidad" class="form-control validate[required]" autocomplete="off"></select>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-md-3">
                        <label for="s_id_sucursal" class="col-sm-2 col-md-6 col-form-label requerido">Sucursal </label>
                        <div class="col-sm-12 col-md-12">
                            <select id="s_id_sucursal" name="s_id_sucursal" class="form-control validate[required]" autocomplete="off"></select>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-3">
                        <label for="s_id_area" class="col-sm-2 col-md-2 col-form-label requerido">Área </label>
                        <div class="col-sm-12 col-md-12">
                            <select id="s_id_area" name="s_id_area" class="form-control validate[required]" autocomplete="off"></select>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-3">
                        <label for="s_id_departamento" class="col-sm-2 col-md-2 col-form-label requerido">Departamento </label>
                        <div class="col-sm-12 col-md-12">
                            <select id="s_id_departamento" name="s_id_departamento" class="form-control validate[required]" autocomplete="off"></select>
                        </div>
                    </div>

                </div>

                <div class="row">
                <div class="col-sm-12 col-md-3">
                       
                       <label for="i_no_economico" class="col-2 col-md-2 col-form-label requerido">Vehiculo </label>
                           <div class="row">
                               
                               <div class="input-group col-sm-12 col-md-12">
                                   <input type="text" id="i_no_economico" name="i_no_economico" class="form-control validate[required]" readonly autocomplete="off">
                                   <div class="input-group-btn">
                                       <button class="btn btn-primary" type="button" id="b_buscar_activo" alt="no" style="margin:0px;">
                                           <i class="fa fa-search" aria-hidden="true"></i>
                                       </button>
                                   </div>
                               </div>
                           </div>
                   </div>

                   <div class="col-sm-12 col-md-3">

                        <label for="i_responsable" class="col-sm-2 col-md-2 col-form-label">Responsable </label>
                        <div class="col-sm-12 col-md-12">
                            <input type="text" id="i_responsable" name="i_responsable" class="form-control" autocomplete="off"/>
                        </div>
                    </div>
                    
                    

                    <div class="col-sm-12 col-md-3">

                        <label for="i_kilometraje" class="col-sm-2 col-md-2 col-form-label">Kilometraje </label>
                        <div class="col-sm-12 col-md-12">
                            <input type="text" id="i_kilometraje" name="i_kilometraje" class="form-control validate[number]" autocomplete="off"/>
                        </div>
                    </div>

                    
                    <div class="col-sm-12 col-md-3">
                        <label for="i_fecha_pedido" class="col-sm-2 col-md-12 col-form-label requerido">Fecha de Pedido </label>
                        <div class="col-sm-12 col-md-12">
                            <input type="text" id="i_fecha_pedido" name="i_fecha_pedido" class="form-control fecha validate[required]" readonly disabled autocomplete="off"/>
                        </div>
                    </div>
                    

                   

                </div>

                <div class="row">

                    
                

                    <div class="col-sm-12 col-md-4">
                       
                        <label for="i_proveedor" class="col-2 col-md-2 col-form-label requerido">Proveedor </label>
                            <div class="row">
                                
                                <div class="input-group col-sm-12 col-md-12">
                                    <input type="text" id="i_proveedor" name="i_proveedor" class="form-control validate[required]" readonly autocomplete="off">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary" type="button" id="b_buscar_proveedor" alt="no" style="margin:0px;">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="input-group-btn">
                                        <button class="btn btn-info" type="button" id="b_detalle_proveedor" style="margin:0px;">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    
                    <div class="col-sm-12 col-md-2">
                        <label for="i_capturo" class="col-sm-2 col-md-2 col-form-label">Capturó </label>
                        <div class="col-sm-12 col-md-12">
                            <input type="hidden" id="i_id_usuario" name="i_id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>">
                            <input type="text" id="i_capturo" name="i_capturo" class="form-control" value="<?php echo $_SESSION['usuario']; ?>" readonly autocomplete="off">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">

                        <label for="i_solicito" class="col-sm-2 col-md-2 col-form-label">Solicitó </label>
                        <div class="col-sm-12 col-md-12">
                            <input type="text" id="i_solicito" name="i_solicito" class="form-control" autocomplete="off"/>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-3">
                        <label for="i_orden_compra" class="col-sm-2 col-md-12 col-form-label ">Orden de Compra </label>
                        <div class="col-sm-12 col-md-12">   
                            <input type="text" id="i_orden_compra" name="i_orden_compra" class="form-control" readonly autocomplete="off"/>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-9">
                        <label for="ta_descripcion" class="col-sm-2 col-md-6 col-form-label">Descripción General</label>
                        <textarea class="form-control" name="ta_descripcion" id="ta_descripcion" rows="2" autocomplete="off"></textarea>
                    </div>
                    <!-- NJES Feb/13/2020 add checked para poder solicitar anticipo en la requisición -->
                    <div class="col-sm-12 col-md-3">
                        <br>
                        <div class="row">
                            <div class="col-sm-12 col-md-9" style="text-align:center;">
                                <label for="ch_anticipo" class="col-form-label">Solicitar Anticipo</label>
                                <input type="checkbox" id="ch_anticipo" name="ch_anticipo" value="">
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <button type="button" class="btn btn-info btn-sm" id="b_ver_presupuesto" style="display:none" data-container="body" data-toggle="popover" data-placement="bottom" data-content="">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                    <br>
                    <div class="row">
                        <div class="col-sm-12 col-md-8">
                            <button type="button" class="btn btn-dark btn-sm form-control" id="b_buscar_productos"><i class="fa fa-search" aria-hidden="true"></i> Buscar Productos</button>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <button type="button" class="btn btn-dark btn-sm form-control" id="b_buscar_flete"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Producto Fletes y Logistica</button>
                        </div>
                    </div>

                    
                <div class="card">
                  <h5 class="card-header">Productos</h5>
                  <div class="card-body">
                    <form id="form_producto" name="form_producto">

                        <div class="row">
                            <input type="hidden" id="i_id_producto" name="i_id_producto">
                            <input type="hidden" id="i_tipo_producto" name="i_tipo_producto">
                            <div class="col-sm-12 col-md-4">
                                <div class="col-sm-12 col-md-12">
                                    <input type="text" id="i_familia" name="i_familia" class="form-control" placeholder="Familia" readonly>
                                    <input type="hidden" id="i_id_familia" name="i_id_familia">
                                    <input type="hidden" id="i_id_familia_gasto" name="i_id_familia_gasto"> 
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4">
                                <div class="col-sm-12 col-md-12">
                                    <input type="text" id="i_linea" name="i_linea" class="form-control" placeholder="Línea" readonly>
                                    <input type="hidden" id="i_id_linea" name="i_id_linea">
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4">
                                <div class="col-sm-12 col-md-12">
                                    <input type="text" id="i_concepto" name="i_concepto" class="form-control" placeholder="Concepto" readonly>
                                </div>
                            </div>

                        </div>
                
                        <br>

                        <div class="row">
                            
                            <div class="col-sm-12 col-md-4">
                                <div class="col-sm-12 col-md-12">
                                    <input type="text" id="i_descripcion" name="i_descripcion" class="form-control" placeholder="Descripción" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-2">
                                <div class="col-sm-12 col-md-12">
                                    <input type="text" id="i_cantidad"  name="i_cantidad" class="form-control validate[custom[number],min[0.1]] izquierda" placeholder="Cantidad" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-2">
                                <div class="col-sm-12 col-md-12">
                                    <input type="text" id="i_precio" name="i_precio" placeholder="Precio" class="form-control  validate[min[0.1]] numeroMoneda izquierda" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-2">
                                <div class="col-sm-12 col-md-12">
                                    <input type="text" id="i_descuento" name="i_descuento" placeholder="Descuento" class="form-control  validate[min[0]] numeroMonedaDecimales izquierda" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-2">
                                <div class="col-sm-12 col-md-12">
                                    <input type="text" id="i_iva" name="i_iva" placeholder="IVA" class="form-control izquierda" autocomplete="off" value="16">
                                </div>
                            </div>

                        </div>

                        <br>

                        <div class="row">

                          <div class="col-sm-12 col-md-8">
                                <div class="col-sm-12 col-md-12">
                                    <input type="text" id="i_justificacion" name="i_justificacion" placeholder="Justificación" class="form-control" autocomplete="off">
                                </div>
                            </div> 

                            <div class="col-sm-12 col-md-2">
                                <div class="col-sm-12 col-md-12">
                                    <input type="text" id="i_costo" name="i_costo" placeholder="Costo" class="form-control numeroMoneda izquierda" readonly autocomplete="off">
                                </div>
                            </div> 

                            <div class="col-sm-12 col-md-2">
                                <div class="col-sm-12 col-md-12">
                                    <button type="button" class="btn btn-success btn-sm form-control" id="b_agregar_producto"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>
                                </div>
                            </div>

                        </div>

                    </form>

                  </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-sm-12 col-md-12">

                            <div class="form-group row">
                                <input type="hidden"  id="i_id_requisicion" name="i_id_requisicion">
                                <table width="100%">

                                    <tr>
                                        <td colspan="3">
                                            <div class="col-sm-12 col-md-12">
                                                <table class="tablon"  id="t_partidas">
                                                    <thead>
                                                        <tr class="renglon">
                                                            <th scope="col">Familia</ths>
                                                            <th scope="col">Clasificacion</ths>
                                                            <th scope="col">Línea</th>
                                                            <th scope="col">Concepto</th>
                                                            <th scope="col">Descripción</th>
                                                            <th scope="col">Cant.</th>
                                                            <th scope="col">Costo Unitario</th>
                                                            <th scope="col">Descuento Unitario</th>
                                                            <th scope="col">Descuento Total</th>
                                                            <th scope="col">% IVA</th>
                                                            <th scope="col">Costo Total</th>
                                                            <th scope="col">Justificación</th>
                                                            <th width="4%" scope="col"></th>
                                                            <th width="4%" scope="col"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr class="tr_totales">
                                                            <th colspan="10">
                                                                <label for="i_descuento_total" class="col-sm-2 col-md-2 col-form-label ">Descuento </label>
                                                            </th>
                                                            <th>
                                                                <input type="text" id="i_descuento_total" name="i_descuento_total" value="0" readonly class="validate[custom[number]] izquierda"  autocomplete="off"/>
                                                            </th>
                                                            <th colspan="2"></th>
                                                        </tr>
                                                        <tr class="tr_totales">
                                                            <th colspan="10">
                                                                <label for="i_subtotal" class="col-sm-2 col-md-2 col-form-label ">Subtotal </label>
                                                            </th>
                                                            <th>
                                                                <input type="text" id="i_subtotal" name="i_subtotal" value="0" readonly class="validate[required,custom[number]] izquierda"  autocomplete="off"/>
                                                            </th>
                                                            <th colspan="2"></th>
                                                        </tr>
                                                        <tr class="tr_totales">
                                                            <th colspan="10">
                                                                <label for="i_total_iva" class="col-sm-2 col-md-1 col-form-label ">IVA </label>
                                                            </th>
                                                            <th>
                                                                <input type="text" value="0" id="i_total_iva" name="i_total_iva" class="validate[required,custom[number]] izquierda" readonly autocomplete="off"/>
                                                            </th>
                                                            <th colspan="2"></th>  
                                                        </tr>
                                                        <tr class="tr_totales">
                                                            <th  colspan="10">
                                                                <label for="i_total" class="col-sm-2 col-md-1 col-form-label ">Total </label>
                                                            </th>
                                                            <th>
                                                                <input type="text" id="i_total" value="0" name="i_total" class="validate[required,custom[number]] izquierda" readonly autocomplete="off"/>
                                                            </th>
                                                            <th colspan="2"></th>
                                                        </tr>
                                                    </tfoot>
                                            </table>

                                            </div>
                                        </td>
                                    </tr>

                                </table>

                            </div>

                       

                    </div>

                  

                </div>

            </div> <!--div_contenedor-->
        </div>      
    </form>
</div> <!--div_principal-->

<div class="container-fluid" id="div_proveedor">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-offset-1 col-md-10" id="div_contenedor">
        <br>
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <div class="titulo_ban">Proveedores</div>
                </div>
                <div class="col-sm-12 col-md-7"></div>
                <div class="col-sm-12 col-md-2">
                    <button type="button" class="btn btn-info btn-sm form-control" id="b_regresar"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> regresar</button>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-5"></div>
                <div class="col-sm-12 col-md-2">
                    <button type="button" class="btn btn-dark btn-sm form-control" id="b_nuevo_proveedor"><i class="fa fa-file-o" aria-hidden="true"></i> Nuevo</button>
                </div>
                <div class="col-sm-12 col-md-2">
                    <button type="button" class="btn btn-dark btn-sm form-control" id="b_buscar_proveedores" alt="si"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                </div>
                <div class="col-sm-12 col-md-2">
                    <button type="button" class="btn btn-dark btn-sm form-control" id="b_guardar_proveedor"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                </div>
            </div>
            <br><br>

            <div class="row">
                <div class="col-sm-12 col-md-1"><input id="i_id_sucursal" type="hidden"/></div>
                <div class="col-sm-12 col-md-10">
                    <form id="forma_proveedor" name="forma_proveedor">
                    <div class="col-sm-12 col-md-12 alert alert-warning" role="alert">
                            * Para que aparezca el nuevo proveedor se deberá asignar una unidad de negocio, comunicate con el administrador.
                            </div>
                        <div class="form-group row">
                            <label for="i_id_proveedor" class="col-sm-2 col-md-2 col-form-label requerido">ID </label>
                            <div class="col-sm-12 col-md-3">
                                <input type="text" class="form-control"  id="i_id_proveedor" autocomplete="off" disabled="disabled">
                            </div>
                            <div class="col-sm-12 col-md-1"></div>
                        </div>
                    <div class="form-group row">
                            <label for="i_nombre" class="col-sm-2 col-md-2 col-form-label requerido">Nombre </label>
                            <div class="col-sm-12 col-md-8">
                                <input type="text" class="form-control validate[required]" id="i_nombre">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="i_rfc" class="col-sm-2 col-md-2 col-form-label requerido">RFC</label>
                            <div class="input-group col-sm-12 col-md-4">
                                        <input type="text" id="i_rfc" name="i_rfc" class="form-control validate[required,minSize[12],maxSize[13],custom[onlyLetterNumber]]" size="13" autocomplete="off">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary" type="button" id="b_rfc" style="margin:0px;" title="Asigna un RFC extrangero: XEXX010101000">
                                                <i class="fa fa-globe" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>

                        
                            <div class="col-sm-10 col-md-2">
                            No Factura
                                <input type="checkbox" id="ch_facturar" name="ch_facturar" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="i_domicilio" class="col-2 col-md-2 col-form-label requerido">Domicilio </label><br>
                            <div class="col-sm-12 col-md-4">
                                <input type="text" class="form-control validate[required]" id="i_domicilio">
                            </div>

                            <label for="i_num_ext" class="col-1 col-md-1 col-form-label requerido">Ext </label><br>
                            <div class="col-sm-2 col-md-2">
                                <input type="text" class="form-control validate[required]" id="i_num_ext">
                            </div>

                            <label for="i_num_int" class="col-1 col-md-1 col-form-label requerido">Int </label><br>
                            <div class="col-sm-2 col-md-2">
                                <input type="text" class="form-control validate[required]" id="i_num_int">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="i_cp" class="col-2 col-md-2 col-form-label requerido">Código Postal </label><br>
                            <div class="col-sm-12 col-md-3">
                                <div class="row">
                                    
                                    <div class="input-group col-sm-12 col-md-9">
                                        <input type="text" id="i_cp" name="i_cp" class="form-control validate[required,custom[integer]]" readonly autocomplete="off">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary" type="button" id="b_buscar_cp" style="margin:0px;">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label for="s_pais" class="col-1 col-md-1 col-form-label requerido">País </label><br>
                            <div class="col-sm-12 col-md-3">
                                <select id="s_pais" name="s_pais" class="form-control validate[required]"></select>
                            </div>
                            
                        </div>

                        <div class="form-group row">
                            <label for="i_colonia" class="col-sm-2 col-md-2 col-form-label requerido">Colonia </label>
                            <div class="col-sm-12 col-md-10">
                                <input type="text" class="form-control validate[required]" id="i_colonia" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="i_id_municipio" class="col-2 col-md-2 col-form-label requerido">Municipio </label><br>
                            <div class="col-sm-2 col-md-2">
                                <input type="text" class="form-control validate[required]" id="i_id_municipio" disabled>
                            </div>
                            <div class="col-sm-2 col-md-8">
                                <input type="text" class="form-control validate[required]" id="i_municipio" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="i_id_estado" class="col-2 col-md-2 col-form-label requerido">Estado </label><br>
                            <div class="col-sm-2 col-md-2">
                                <input type="text" class="form-control validate[required]" id="i_id_estado" disabled>
                            </div>
                            <div class="col-sm-2 col-md-8">
                                <input type="text" class="form-control validate[required]" id="i_estado" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="i_id_banco" class="col-2 col-md-2 col-form-label requerido">Banco </label><br>
                            <div class="col-sm-12 col-md-2">
                                <div class="row">
                                    <div class="input-group col-sm-12 col-md-12">
                                        <input type="text" id="i_id_banco" name="i_id_banco" class="form-control validate[required]" readonly autocomplete="off">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary" type="button" id="b_buscar_banco" style="margin:0px;">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2 col-md-8">
                                <input type="text" class="form-control validate[required]" id="i_banco" disabled>
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="i_cuenta" class="col-2 col-md-2 col-form-label requerido">Cuenta </label><br>
                            <div class="col-sm-2 col-md-2">
                                <input type="text" class="form-control validate[required]" id="i_cuenta">
                            </div>
                            <label for="i_clabe" class="col-sm-2 col-md-2 col-form-label requerido">Clabe </label>
                            <div class="col-sm-12 col-md-2">
                                <input type="text" class="form-control validate[required]" id="i_clabe" >
                            </div>
                            <label for="i_dias_credito" class="col-sm-2 col-md-2 col-form-label requerido">Días de Credito </label>
                            <div class="col-sm-12 col-md-2">
                                <input type="text" class="form-control validate[required,custom[integer]]" id="i_dias_credito" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="i_telefono" class="col-sm-2 col-md-2 col-form-label requerido">Teléfono(s) </label>
                            <div class="col-sm-12 col-md-6">
                                <input type="text" class="form-control validate[required]" id="i_telefono" >
                            </div>
                            <label for="i_extension" class="col-sm-2 col-md-2 col-form-label requerido">Extensión </label>
                            <div class="col-sm-12 col-md-2">
                                <input type="text" class="form-control validate[required]" id="i_extension" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="i_web" class="col-sm-2 col-md-2 col-form-label requerido">Web </label>
                            <div class="col-sm-12 col-md-8">
                                <input type="text" class="form-control validate[required]" id="i_web">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="i_contacto" class="col-sm-2 col-md-2 col-form-label requerido">Contacto </label>
                            <div class="col-sm-12 col-md-8">
                                <input type="text" class="form-control validate[required]" id="i_contacto">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="i_condiciones" class="col-sm-2 col-md-2 col-form-label requerido">Condiciones </label>
                            <div class="col-sm-12 col-md-8">
                                <input type="text" class="form-control validate[required]" id="i_condiciones">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ch_inactivo" class="col-sm-2 col-md-2 col-form-label">Inactivo</label>
                            <div class="col-sm-10 col-md-2">
                                <input type="checkbox" id="ch_inactivo" name="ch_inactivo" value="">
                            </div>
                        </div>
                        
                    </form>

                </div>
            </div>

        <br>
        </div> <!--div_contenedor-->
    </div>      
</div> <!--div_proveedor-->  
    
</body>


<!---->


<div id="dialog_buscar_requisiciones" class="modal fade bd-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
               <label for="s_filtro_unidad" class="col-sm-12 col-md-2 col-form-label">Unidad Negocio </label>
                       
                <div class="col-md-6">
                    <div class="form-group row">
                         <div class="col-sm-12 col-md-10">
                            <select id="s_filtro_unidad" name="s_filtro_unidad" class="form-control" autocomplete="off" style="width:100%;"></select>
                        </div>
                    </div>
                </div> 
            </div>    
            <div class="row">
                <div class="col-sm-12 col-md-2">
                    <input type="text" name="i_filtro_requisiciones" id="i_filtro_requisiciones" alt="requisicion-busqueda" class="form-control filtrar_renglones" placeholder="Filtrar" autocomplete="off">
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="form-group row">
                        <div class="input-group col-sm-12 col-md-12">
                            <select id="s_filtro_sucursal" name="s_filtro_sucursal" class="form-control filtros" placeholder="Sucursal" autocomplete="off" style="width:100%;"></select>
                        </div>
                    </div> 
                </div>

               

                <div class="col-sm-12 col-md-6">
                    <div class="row">
                        <div class="col-sm-12 col-md-1">Del: </div>
                        <div class="input-group col-sm-12 col-md-5">
                            <input type="text" name="i_fecha_inicio" id="i_fecha_inicio" class="form-control fecha" autocomplete="off" readonly>
                            <div class="input-group-addon input_group_span">
                                <span class="input-group-text">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-1">Al: </div>
                        <div class="input-group col-sm-12 col-md-5">
                            <input type="text" name="i_fecha_fin" id="i_fecha_fin" class="form-control fecha" autocomplete="off" readonly disabled>
                            <div class="input-group-addon input_group_span">
                                <span class="input-group-text">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <table class="tablon"  id="t_requisiciones_b">
                      <thead>
                        <tr class="renglon">
                            <th scope="col">Folio<br>Mantenimiento</th>
                            <th scope="col">Folio<br> Requisición</th>
                            <th scope="col">Unidad de Negocio</th> 
                            <th scope="col">Sucursal</th>
                            <th scope="col">Área</th>
                            <th scope="col">Depto</th>
                            <th scope="col">Estatus</th>
                            <!--<th scope="col">Depto</th>-->
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


<div id="dialog_proveedores" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Búsqueda de Proveedores</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-10"><input type="text" name="i_filtro_proveedor" id="i_filtro_proveedor" alt="renP" class="filtrar_renglones form-control filtrar_renglones" alt="renglon_razon_social_emisora" placeholder="Filtrar" autocomplete="off"></div>
                </div>    
                <br>
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <table class="tablon"  id="t_proveedores">
                        <thead>
                            <tr class="renglon">
                            <th scope="col">Proveedor</th>
                            <th scope="col">RFC</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                        </table>  
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>

<div id="dialog_proveedores_datos" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Datos Proveedor: <span id="nombre_proveedor"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div id="div_datos_proveedor"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div id="dialog_buscar_productos" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Búsqueda de Productos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> 
            <div class="row">
                <div class="input-group col-sm-12 col-md-4">
                    <input type="text" id="i_familia_filtro" name="i_familia_filtro" class="form-control" placeholder="Filtrar Por Familia" readonly autocomplete="off">
                    <div class="input-group-btn">
                        <button class="btn btn-primary" type="button" id="b_buscar_familia_filtro" style="margin:0px;">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </div> 
                <div class="input-group col-sm-12 col-md-4">
                    <input type="text" id="i_linea_filtro" name="i_linea_filtro" class="form-control" placeholder="Filtrar Por Línea" readonly autocomplete="off">
                    <div class="input-group-btn">
                        <button class="btn btn-primary" type="button" id="b_buscar_lineas_filtro" style="margin:0px;">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>  
                <div class="col-sm-12 col-md-4"><input type="text" name="i_filtro_producto" id="i_filtro_producto" class="form-control filtrar_renglones" alt="producto-partida" placeholder="Filtrar" autocomplete="off"></div>
            </div>    
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <table class="tablon"  id="t_productos">
                      <thead>
                        <tr class="renglon">
                          
                            <th scope="col">Familia</th>
                            <th scope="col">Clasificación</th>
                            <th scope="col">Línea</th>
                            <th scope="col">Concepto</th>
                            <th scope="col">Precio</th>

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

<div id="dialog_buscar_familias" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Búsqueda de Familias</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-sm-12 col-md-6"><input type="text" name="i_filtro_familias" id="i_filtro_familias" class="form-control filtrar_renglones" alt="renglon_familias" placeholder="Filtrar" autocomplete="off"></div>
            </div>    
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <table class="tablon"  id="t_familias">
                      <thead>
                        <tr class="renglon">
                          <th scope="col">ID</th>
                          <th scope="col">Clave</th>
                          <th scope="col">Descripción</th>
                          <th scope="col">Tallas</th>
                          <th scope="col">Tipo</th>
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

<div id="dialog_buscar_lineas" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Búsqueda de Líneas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-sm-12 col-md-6"><input type="text" name="i_filtro_lineas" id="i_filtro_lineas" class="form-control filtrar_renglones" alt="renglon_lineas" placeholder="Filtrar" autocomplete="off"></div>
            </div>    
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <table class="tablon"  id="t_lineas">
                      <thead>
                        <tr class="renglon">
                          <th scope="col">Clave</th>
                          <th scope="col">Descripción</th>
                          <th scope="col">Familia</th>
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

<div id="dialog_agregar_tallas" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar Tallas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
               <div class="col-sm-12 col-md-6">    
                     <label for="i_t_total">Total de Productos</label>
                    <input type="text" text-align="center" id="i_t_total" name="i_t_total" class="form-control izquierda" readonly >
                    <input type="hidden" text-align="center" id="i_t_total_a" name="i_t_total_a" value="0" class="form-control">
                    <input type="hidden" text-align="center" id="i_t_numero_partida" name="i_t_numero_partida" class="form-control"  >                    
                    <datalist id="lista_tallas"></datalist>
                    <label for="i_t_talla">Talla</label>
                    <input type="text" id="i_t_talla" name="lista_tallas"  list="lista_tallas" class="form-control" autocomplete="off">
                    <label for="i_t_cantidad">Cantidad</label>
                    <input type="text" id="i_t_cantidad" name="i_t_cantidad" class="form-control izquierda" autocomplete="off">
                    <button type="button" class="btn btn-success btn-sm form-control" id="b_agregar_talla"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>
                </div>
            </div>    
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <table class="tablon"  id="t_tallas">
                      <thead>
                        <tr class="renglon">
                            <th scope="col">Talla</th> 
                            <th scope="col">Cantidad</th>
                            <th scope="col" width="8%"></th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>  
                    <button type="button" class="btn btn-success btn-sm form-control" id="b_guardar_talla"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div id="dialog_confirm" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">CANCELAR REQUISICIÓN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12">¿Estas seguro de cancelar la requisición con Folio: <label id="l_id_folio" name="l_id_folio"></label> ?</div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4"></div>
                    <div class="col-sm-12 col-md-2">
                        <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal"> NO </button>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <button type="button" id="b_cancelar_requisicion" class="btn btn-danger btn-lg"> SI </button>
                    </div>
                    <div class="col-sm-12 col-md-4"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dialog_buscar_cp" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Búsqueda de Codigos Postales</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <label for="s_estados">Estado</label>
                    <select class="form-control coti" id="s_estados" style="width: 100%;"></select>
                </div>
                <div class="col-sm-12 col-md-4">
                    <label for="s_municipios">Municipio</label>
                    <select class="form-control coti" id="s_municipios" style="width: 100%;"></select>
                </div>
                <div class="col-sm-12 col-md-4"><input type="text" name="i_filtro_cp" id="i_filtro_cp" class="form-control filtrar_renglones" alt="renglon_cp" placeholder="Filtrar" autocomplete="off"></div>
            </div>                               
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <table class="tablon"  id="t_cp">
                      <thead>
                        <tr class="renglon">
                          <th scope="col">Código Postal</th>
                          <th scope="col">Estado</th>
                          <th scope="col">Municipio</th>
                          <th scope="col">Colonia</th>
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

<div id="dialog_buscar_banco" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Búsqueda de Bancos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-sm-12 col-md-6"><input type="text" name="i_filtro_banco" id="i_filtro_banco" class="form-control filtrar_renglones" alt="renglon_banco" placeholder="Filtrar" autocomplete="off"></div>
            </div>    
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <table class="tablon"  id="t_banco">
                      <thead>
                        <tr class="renglon">
                          <th scope="col">ID</th>
                          <th scope="col">Clave</th>
                          <th scope="col">Banco</th>
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

<!-- Modal Buscar Activo -->
<div id="dialog_buscar_activos" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="padding-right: 17px;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Buscar Activos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Contenido Modal -->
        <form id="forma_buscar_activos">
          <!--<div class="row">
            
            <div class="col-auto">
              <label for="s_buscar_tipo" class="col-form-label"> Tipo:</label>
            </div>
            <div class="col-md-4">
              <select id="s_buscar_tipo" name="s_buscar_tipo" class="form-control form-control-sm">
                <option selected="true" disabled="disabled">Seleccione el Tipo:</option>
                <option value="1">Vehículo</option>
                <option value="2">Celular</option>
                <option value="3">Equipo de Computo</option>
                <option value="4">Otro</option>
                <option value="">Todos</option>
              </select>
            </div>

          </div>-->

          <div class="row">
            <div class="col-auto">
              <label class="col-form-label">Filtrar</label>
            </div>
            <div class="col-md-4">
                <input type="text" name="i_filtro_activos" id="i_filtro_activos" alt="activo_renglon" class="form-control filtrar_renglones" placeholder="Filtrar" autocomplete="off"> 
            </div>

            <div class="col-auto">
              <label class="col-form-label">No. Económico:</label>
            </div>
            <div class="col-md-3">
              <input type="text" id="i_busca_no_economico" name="i_busca_no_economico" class="form-control form-control-sm" autocomplete="off">
            </div>

          </div>

          <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-sm-12 col-md-12" style="height:480px; overflow: scroll">
              <table class="tablon">
                <thead>
                  <tr class="renglon">
                    <th scope="col">No. Serie</th>
                    <th scope="col">No. Economico</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Tipo</th>
                  </tr>
                </thead>
                <tbody id="t_buscar_activo">

                </tbody>
              </table>
            </div>
            <div class="col-md-2">
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="dialog_anticipo" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Solicitud anticipo para requisición</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="forma_anticipo">
                <div class="row">
                    <div class="col-sm-12 col-md-2"></div>
                    <label for="i_anticipo" class="col-sm-12 col-md-2">Monto</label>
                    <div class="col-sm-12 col-md-4">
                        <input type="text" id="i_anticipo" name="i_anticipo" class="form-control"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12" id="dato_info_anticipo">
                    </div>
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script src="js/jquery3.3.1/jquery-3.3.1.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/js/bootstrap.js"></script>
<script src="js/jquery.validationEngine.js"></script>
<script src="js/jquery.validationEngine-es.js"></script>
<script src="js/general.js"></script>
<script src="vendor/select2/js/select2.js"></script>
<script src="js/bootstrap-datepicker.min.js"></script>

<script>

    var idUnidadActual = <?php echo $_SESSION['id_unidad_actual']; ?>;
    var idUsuario = <?php echo $_SESSION['id_usuario']; ?>;
    var modulo = 'REQUISICION_MANTENIMIENTO';
    var matriz = <?php echo $_SESSION['sucursales']; ?>;
    var totalPartidas = 0;
    var idRequisicionM = 0;
    var ivaRequi = '';
    var estatusActualR = '';
    $(function()
    {

        $('#i_fecha_pedido').val(hoy);

        $('#id_usuario').val(idUsuario);
        mostrarBotonAyuda(modulo);
        muestraSelectUnidades(matriz, 's_id_unidad', idUnidadActual);
        muestraSucursalesPermiso('s_id_sucursal', idUnidadActual, modulo,idUsuario);
        muestraTallas();
        muestraAreasAcceso('s_id_area');
        verificarPermisos(idUsuario,$('#s_id_sucursal').val(),idUnidadActual);

        $('#b_cancelar').prop('disabled', true);
        $('#b_imprimir').prop('disabled', true);
        $("#div_principal").css({left : "0%"});

        $('.fecha').datepicker({
            format : "yyyy-mm-dd",
            autoclose: true,
            language: "es",
            todayHighlight: true
        });

        $('[data-toggle="popover"]').popover();

       $('#s_id_unidad').change(function()
       {

            var idUnidadNegocio = $('#s_id_unidad').val();
            $('.img-flag').css({'width':'50px','height':'20px'});
            muestraSucursalesPermiso('s_id_sucursal', idUnidadNegocio, modulo,idUsuario);
            muestraAreasAcceso('s_id_area');
            muestraDepartamentoAreaInternos('s_id_departamento', 0, 0);
            limpiaFormaEdicionPartidas();
        
        });

       $('#s_id_sucursal').change(function()
       {

            var idSucursal = $('#s_id_sucursal').val();
            muestraDepartamentoAreaInternos('s_id_departamento', idSucursal, '');
            verificarPermisos(idUsuario,idSucursal,idUnidadActual);
            

        });

       $('#s_id_unidad').change(function()
       {

            var idUnidadNegocio = $('#s_id_unidad').val();

        });

       $('#s_id_area').change(function()
       {

            var idSucursal = $('#s_id_sucursal').val();
            var idArea = $('#s_id_area').val();
            muestraDepartamentoAreaInternos('s_id_departamento', idSucursal, idArea);
            

        });

        $('#b_buscar_productos').click(function()
        {

            $('#i_familia_filtro').attr('alt',0).val('');
            $('#i_linea_filtro').attr('alt',0).val('');
            $('.producto-partida').remove();
            buscarProductos();

        });
          
        function buscarProductos(){
            var idUnidad = $('#s_id_unidad').val();
            var tipoProducto = 2;

            $('#t_productos >tbody tr').remove();
            $.ajax({
                type: 'POST',
                url: 'php/productos_buscar_activos.php',
                dataType:"json", 
                data:{
                    'idUnidad':idUnidad,
                    'idFamilia':$('#i_familia_filtro').attr('alt'),
                    'idLinea' : $('#i_linea_filtro').attr('alt'),
                    'tipo': tipoProducto
                },
                success: function(data)
                {
                    for(var i=0; data.length>i; i++)
                    {

                        var producto = data[i];
                        //---MGFS 23-10-2019 se cambia precio por costo ya que el costo del producto siempre se va actualizar o del catalogo o entrada por cmpra
                        //-->NJES July/29/2020 se cambia para se tome el ultimo precio de compra del producto por unidad
                        var html = "<tr class='producto-partida' alt='" + producto.id + "' alt2='" + producto.concepto+ "' alt3='" + producto.id_familia + "' alt4='" + producto.familia + "' alt5='" + producto.id_linea + "' alt6='" + producto.linea + "' alt7='" + producto.precio + "' alt8='" + producto.verifica_talla + "'   alt9='" + producto.id_familia_gasto + "' id_clas='"+producto.id_clas+"' clasificacion='"+producto.clasificacion+"'>";
                        html += "<td>" + producto.familia + "</td>";
                        html += "<td>" + producto.clasificacion + "</td>";                        
                        html += "<td>" + producto.linea + "</td>";
                        html += "<td>" + producto.concepto + "</td>";
                        html += "<td align='right'>" + formatearNumero(producto.precio) +  "</td>";
                        html += "</tr>";

                        $('#t_productos tbody').append(html);
                    
                    }

                    $('#dialog_buscar_productos').modal('show');
         
                },
                error: function (xhr)
                {
                    mandarMensaje('1');//xhr.responseText
                }
            });
            
           
        }

       

        $("#t_productos").on('click',".producto-partida",function()
        {

            var idProducto = $(this).attr('alt');
            var concepto = $(this).attr('alt2');
            var idFamilia = $(this).attr('alt3');
            var familia = $(this).attr('alt4');
            var idLinea = $(this).attr('alt5');
            var linea = $(this).attr('alt6');
            var precio = $(this).attr('alt7');
            var verificaT = $(this).attr('alt8');
            var idFG = $(this).attr('alt9');
            var id_clas = $(this).attr('id_clas');
            var clasificacion = $(this).attr('clasificacion');

            $('#i_id_producto').val(idProducto);
            $('#i_id_linea').val(idLinea);
            $('#i_linea').val(linea);  
            $('#i_id_familia_gasto').val(idFG);

            $('#i_id_familia').val(idFamilia);

            $('#i_familia').val(familia);
            $('#i_concepto').val(concepto);
            $('#i_precio').val(formatearNumero(precio));
            $('#i_tipo_producto').val(redondear(verificaT));

            $('#dialog_buscar_productos').modal('hide');

            $("#b_agregar_producto").attr({"alt1":id_clas, "alt2": clasificacion});

        });

        function validarProductos()
        {

            var verifica = false;

            if($('#i_descripcion').val() == '' )
                verifica = true

            if($('#i_cantidad').val() == '')
                verifica = true;
            
            if(parseFloat($('#i_cantidad').val()) < 0.01)
                verifica = true;

            if($('#i_precio').val() == '')
                verifica = true;

            if($('#i_costo').val() == '')
                verifica = true;

            if($('#i_iva').val() == '')
                verifica = true;

            if(verifica == true)
                mandarMensaje('Faltan Datos en el Producto');

            return verifica;

        }

        $('#b_agregar_producto').click(function()
        {

            let id_clas = $(this).attr("alt1");
            let clasif = $(this).attr("alt2");

            $('#b_agregar_producto').prop('disabled',true);
            
            //-->NJES November/11/2020 validar que para agegar producto la cantidad sea 1
            if($('#i_id_familia_gasto').val() == 104 && parseFloat($('#i_cantidad').val()) > 1)
            {
                mandarMensaje('Cuando el producto es de Fletes y Logistica solo puede ser 1 en cantidad');
                $('#b_agregar_producto').prop('disabled',false);
            }else{
                if(validarProductos() == false)
                {
                    //-->NJES November/11/2020 validar que el iva del producto de familia gasto fletes y logistica sea 0 o igual a las partidas agregadas
                    //-->NJES December/01/2020 permitir mezclar partidas con porcentaje de IVA del 0% y 16% o del 0% y 8%
                    if(ivaRequi=='' || (parseInt(ivaRequi)==parseInt($('#i_iva').val()) || parseInt($('#i_iva').val()) == 0) || ($('#i_id_familia_gasto').val() == 104 && (parseInt(ivaRequi)==parseInt($('#i_iva').val()) || parseInt($('#i_iva').val()) == 0)))
                    {
                        var idProducto = $('#i_id_producto').val();
                        var idLinea = $('#i_id_linea').val();
                        var linea = $('#i_linea').val();
                        var idFamilia = $('#i_id_familia').val();

                        var idFG = $('#i_id_familia_gasto').val();

                        var familia = $('#i_familia').val();
                        var concepto = $('#i_concepto').val();
                        var descripcion = $('#i_descripcion').val();
                        var cantidad = $('#i_cantidad').val();
                        var precio = $('#i_precio').val();
                        var costo = $('#i_costo').val();
                        var iva = $('#i_iva').val();
                        var justificacion = $('#i_justificacion').val();
                        var verificaT = $('#i_tipo_producto').val();
                        //-->NJES October/28/2020 se agrega descuento por partida, el costo unitario de cada partida ya incluye el descuento
                        //y en base de datos se agregan dos campo en requisiciones_d (descuento_unitario y descuento_total)
                        //si se quiere saber el costo original solo se suma el costo_unitario + descuento_unitario
                        //en el encabezado en requisiciones se guarda el total de descuento de las partidas
                        if($('#i_descuento').val() != '')
                            var descuento = $('#i_descuento').val();
                        else
                            var descuento = 0;

                        //-->NJES November/11/2020 cuando se agrega partida de familia gasto fletes y logistica no actualizar variable del iva
                        //-->NJES December/01/2020 cuando se agrega partida con iva 0 no actualizar variable ivaRequi
                        if($('#i_id_familia_gasto').val() != 104 && parseInt(iva) != 0)
                            ivaRequi=iva;

                        totalPartidas++;

                        var precioAct = parseFloat(quitaComa(precio))-parseFloat(quitaComa(descuento));
                        var descuentoTotal = parseFloat(quitaComa(cantidad))*parseFloat(quitaComa(descuento));

                        var html = "<tr class='partida-requisicion' alt='" + totalPartidas +  "' producto='" + idProducto + "' concepto='" + concepto+ "'  id_familia_gasto='" + idFG + "' id_familia='" + idFamilia + "' familia='" + familia + "' id_linea='" + idLinea + "' linea='" + linea + "' precio='" + quitaComa(precioAct) + "'  descuento='"+quitaComa(descuento)+"' descuento_total='"+descuentoTotal+"' cantidad='" +  cantidad + "' costo='" + quitaComa(costo) + "' descripcion='" + descripcion + "' justificacion='" + justificacion + "' iva='" + iva + "' verifica_talla='" + verificaT + "' id_clas='"+id_clas+"' >";
                        html += "<td>" + familia + "</td>";
                        html += "<td>" + clasif + "</td>";
                        html += "<td>" + linea + "</td>";
                        html += "<td>" + concepto + "</td>";
                        html += "<td>" + descripcion + "</td>";
                        html += "<td align='right'>" + cantidad + "</td>";
                        html += "<td align='right'>" + precioAct + "</td>";
                        html += "<td align='right'>" + descuento + "</td>";
                        html += "<td align='right'>" + descuentoTotal + "</td>";
                        html += "<td align='right'>" + iva + "</td>";
                        html += "<td align='right'>" + costo + "</td>";
                        
                        html += "<td>" + justificacion + "</td>";

                        var botonTalla = '';
                        if(verificaT == 1)
                        {
                            botonTalla = "<button type='button' class='btn btn-primary btn-sm form-control class-" + totalPartidas + "' id='b_talla' alt='" + idProducto + "'  alt2='" + cantidad + "'  alt3='" + totalPartidas + "' ><i class='fa fa-list' aria-hidden='true'></i></button><input  class='tallas-i' type='hidden' id='i_talla" + totalPartidas + "'  name='i_talla" + totalPartidas + "'>";

                        }

                        html += "<td>" + botonTalla + "</td>";

                        html += "<td><button type='button' class='btn btn-danger btn-sm form-control' id='b_eliminar' alt='" + idProducto + "'><i class='fa fa-remove' aria-hidden='true'></i></button></td>";

                        html += "</tr>";

                        $('#t_partidas tbody').append(html);

                        $('#i_id_producto').val('');
                        $('#i_id_linea').val('');
                        $('#i_linea').val('');
                        $('#i_id_familia').val('');

                        $('#i_id_familia_gasto').val('');

                        $('#i_familia').val('');
                        $('#i_concepto').val('');
                        $('#i_descripcion').val('');
                        $('#i_cantidad').val('');
                        $('#i_precio').val('');
                        $('#i_costo').val('');
                        $('#i_iva').val(16);
                        $('#i_justificacion').val('');
                        $('#i_descuento').val('');

                        $("#b_agregar_producto").attr({"alt1":0, "alt2": 0});

                        calcularTotal();

                        $('#b_agregar_producto').prop('disabled',false);
                    }else{
                        if($('#i_id_familia_gasto').val() == 104)
                            mandarMensaje('Cuando el producto es de fletes y logistica es necesario agregar la misma TASA IVA: '+ivaRequi+' ó TASA IVA 0');
                        else
                            mandarMensaje('Debes ingresar productos con la misma TASA IVA: '+ivaRequi+' ó 0');
                        
                        $('#b_agregar_producto').prop('disabled',false);
                    }
                
                }else
                    $('#b_agregar_producto').prop('disabled',false);
            }

        });


        function verificarPresupuesto(){

            var verificaP = false;

            $("#t_partidas tbody tr").each(function()
            { 
                var idFamiliaT = $(this).attr('id_familia');
                let idClas = $(this).attr("id_clas");
                //---- verifico el presupesto para este producto 
                $.ajax({
                        type: 'POST',
                        url: 'php/requisiciones_verifica_presupuesto.php',
                    
                        data:{
                            'idFamilia' : idFamiliaT,
                            'idUnidad' :  $('#s_id_unidad').val(),
                            'idSucursal' : $('#s_id_sucursal').val(),
                            idClas
                            //-->NJES June/16/2020 DEN18-2769 Modificar la validación de presupuesto en el modulo de requisiciones
                            //'idArea' : $('#s_id_area').val(),
                            //'idDepto' : $('#s_id_departamento').val()
                        },
                        async: false,
                        success: function(data)
                        {
                            var costoTotal = 0; 

                            $("#t_partidas tbody tr").each(function()
                            { 
                                var idFamilia = $(this).attr('id_familia');
                                var costo = $(this).attr('costo');

                                if(parseInt(idFamiliaT) == parseInt(idFamilia)){
                                    $(this).removeClass('excede');
                                    $(this).removeAttr('excedePresupuesto');

                                    costoTotal = costoTotal+ parseFloat(costo);
                            
                                }else{
                                    costoTotal = costoTotal+ parseFloat(0);
                                }

                                if(parseFloat(costoTotal)<= parseFloat(data))
                                {
                                    $(this).attr('excedePresupuesto',0);
                                    verificaP = verificaP;
                                }else{
                                    verificaP = true;
                                    $(this).attr('excedePresupuesto',1);
                                    $(this).addClass('excede');
                                }


                            });
                                
                               
                            
                        },
                        error: function (xhr)
                        {
                            console.log('php/verifica_presupuesto_producto.php --->'+ JSON.stringify(xhr));
                            mandarMensaje('* Ocurrio un error al verificar el presupuesto');//xhr.responseText
                        }
                });
               
            });
           
            return verificaP;
                
        }

        $(document).on('click','#modal_alerta2 .b_cancelar',function(){
            mandarMensaje('No se guardo la requisición, </br>modificala para que no exceda el presupuesto ó indica que si deseas continuar y exceda el presupuesto al guardar.');
        });


        $(document).on('click','#b_aceptar_presupuesto',function(){
            guardaRequi(1);
        });


        $('#b_agregar_talla').click(function()
        {

            var talla = $('#i_t_talla').val();
            var cantidad = $('#i_t_cantidad').val();
            var totalA = $('#i_t_total_a').val();

            var verifica = false;
            if(talla == '' || talla == null)
                verifica = true;

            if(cantidad == '' || cantidad == null)
                verifica = true;

            if(verifica == true)
                mandarMensaje('Datos incompletos.');
            else
            {
                
                var html = "<tr alt='" + talla + "' alt2='" + cantidad + "' >";
                html += "<td>" + talla + "</td>";
                html += "<td>" + cantidad + "</td>";
                html += "<td><button type='button' class='btn btn-danger btn-sm form-control' alt='" + talla + "' alt2='" + cantidad + "' id='b_eliminar_talla'><i class='fa fa-remove' aria-hidden='true'></i></button></td>";
                html += "</tr>"

                $('#t_tallas tbody').append(html);
                $('#i_t_total_a').val(parseInt(cantidad) + parseInt(totalA));
                $('#i_t_talla').val('');
                $('#i_t_cantidad').val('');

            }

        });

        //************Solo muestra las familias activas */
        $('#b_buscar_familia_filtro').on('click',function(){
           buscaFamilias();
        });

        $('#b_buscar_lineas').prop('disabled',true);
        $('#b_buscar_lineas_filtro').prop('disabled',true);

        function buscaFamilias(){
            $('#i_filtro_familias').val('');
            $('.renglon_familias').remove();

            $.ajax({

                type: 'POST',
                url: 'php/familias_buscar.php',
                dataType:"json", 
                data:{'estatus':0},

                success: function(data) {
                
                if(data.length != 0){

                        $('.renglon_familias').remove();
                
                        for(var i=0;data.length>i;i++){

                            ///llena la tabla con renglones de registros
                            var inactivo='';
                            
                            if(parseInt(data[i].inactivo) == 1){

                                inactivo='inactivo';
                            }else{
                                inactivo='Activa';
                            }

                            var html='<tr class="renglon_familias" alt="'+data[i].id+'" alt2="'+data[i].descripcion+'">\
                                        <td data-label="ID">' + data[i].id+ '</td>\
                                        <td data-label="Clave">' + data[i].clave+ '</td>\
                                        <td data-label="Descripción">' + data[i].descripcion+ '</td>\
                                        <td data-label="Tallas">' + data[i].tallas+ '</td>\
                                        <td data-label="Tipo">' + data[i].tipo+ '</td>\
                                        <td data-label="Estatus">' + inactivo+ '</td>\
                                    </tr>';
                            ///agrega la tabla creada al div 
                            $('#t_familias tbody').append(html);   
                            $('#dialog_buscar_familias').modal('show');   
                        }
                }else{

                        mandarMensaje('No se encontró información');
                }

                },
                error: function (xhr) {
                    console.log('php/familias_buscar.php-->'+JSON.stringify(xhr));
                    mandarMensaje('Error en el sistema');
                }
            });
        }

        $('#t_familias').on('click', '.renglon_familias', function() {
            
            var  idFamilia = $(this).attr('alt');
            var  familia = $(this).attr('alt2');
         
            $('#i_familia_filtro').attr('alt',idFamilia).val(familia);
            $('#b_buscar_lineas_filtro').prop('disabled',false);
            buscarProductos();
    
            $('#i_linea_filtro').val('');
            
            $('#dialog_buscar_familias').modal('hide');

        });


        //************Solo muestra las familias activas */
        $('#b_buscar_lineas_filtro').on('click',function(){
            buscaLineas();
        });

        function buscaLineas(){

                $('#i_filtro_lineas').val('');
                $('.renglon_lineas').remove();

                $.ajax({

                    type: 'POST',
                    url: 'php/lineas_buscar_idFamilia.php',
                    dataType:"json", 
                    data:{'idFamilia':$('#i_familia_filtro').attr('alt')},

                    success: function(data) {
                  
                    if(data.length != 0){

                            $('.renglon_lineas').remove();
                    
                            for(var i=0;data.length>i;i++){

                                ///llena la tabla con renglones de registros
                                var inactiva='';
                                
                                if(parseInt(data[i].inactiva) == 1){

                                    inactiva='Inactiva';
                                }else{
                                    inactiva='Activa';
                                }

                                var html='<tr class="renglon_lineas" alt="'+data[i].id+'" alt2="' + data[i].descripcion+ '">\
                                            <td data-label="Clave">' + data[i].clave+ '</td>\
                                            <td data-label="Descripción">' + data[i].descripcion+ '</td>\
                                            <td data-label="Familia">' + data[i].familia+ '</td>\
                                            <td data-label="Estatus">' + inactiva+ '</td>\
                                        </tr>';
                                ///agrega la tabla creada al div 
                                $('#t_lineas tbody').append(html);   
                                $('#dialog_buscar_lineas').modal('show');   
                            }
                    }else{

                            mandarMensaje('No se encontró información');
                    }

                    },
                    error: function (xhr) {
                        console.log('php/lineas_buscar.php-->'+JSON.stringify(xhr));
                        mandarMensaje('Error en el sistema');
                    }
                });
            }

            $('#t_lineas').on('click', '.renglon_lineas', function() {
              
                var idLinea = $(this).attr('alt');
                var linea = $(this).attr('alt2');

    
                $('#i_linea_filtro').val(linea).attr('alt',idLinea);
                buscarProductos();

                $('#dialog_buscar_lineas').modal('hide');


            });


        $('#b_nuevo').click(function()
        {
            limpiarForma();
        });

        $('#b_guardar_talla').click(function()
        {

            $('#b_guardar_talla').prop('disabled',false);
            var totalProdutos = $('#i_t_total').val();
            var totalProdutosAgregados = $('#i_t_total_a').val();
            var nPartida = $('#i_t_numero_partida').val();

            if(totalProdutos != totalProdutosAgregados){
                mandarMensaje('No corresponde el total de productos con tallas asignadas con el total de productos de la requisición. Verificar.');
                $('#b_guardar').prop('disabled',false);
            }else
            {

                var tallasA = [];
                var contador = 0;
                $("#t_tallas tbody tr").each(function()
                {

                    var talla = $(this).attr('alt');
                    var cantidad = $(this).attr('alt2');

                    tallasA[contador] = {
                        'talla': talla,
                        'cantidad': cantidad
                    };

                    contador++;
                    
                });

                var jsonTallas = JSON.stringify(tallasA);
                $('#i_talla' + nPartida).val(jsonTallas);

                $('#i_t_total_a').val('');
                $('#i_t_total').val('');
                $('#t_tallas >tbody tr').remove();
                $('#dialog_agregar_tallas').modal('hide');

                var clase = 'class-' + nPartida;
                $('.' + clase).each(function()
                {
                    $(this).removeClass('btn-primary').addClass('btn-success');
                });
                // aqui las tallas

                $('#b_guardar').prop('disabled',false);

            }

        });

        $(document).on('click','#b_eliminar_talla',function()
         {
            $(this).parent().parent().remove();
            var cantidad = $(this).attr('alt2');
            var totalA = $('#i_t_total_a').val();

            $('#i_t_total_a').val(parseInt(totalA) - parseInt(cantidad));

        });

         $(document).on('click','#b_talla',function()
         {
            $('#i_t_total').val(0);
            $('#i_t_total_a').val(0);
            $('#i_t_numero_partida').val('');
            $('#i_t_talla').val('');
            $('#i_t_cantidad').val('');
            $('#t_tallas >tbody tr').remove();

            var idProducto = $(this).attr('alt');
            var cantidad = $(this).attr('alt2');
            var nPartida = $(this).attr('alt3');
            var tallasAgregadas = $('#i_talla' + nPartida).val();

            $('#i_t_numero_partida').val(nPartida);

            if(tallasAgregadas == '')
                $('#i_t_total').val(cantidad);
            else
            {

                $('#i_t_total').val(cantidad);
                $('#i_t_total_a').val(cantidad);
                var tallasArray = JSON.parse(tallasAgregadas);
                for(var i=0; tallasArray.length>i; i++)
                {

                    var tallaActual = tallasArray[i];
                    var html = "<tr alt='" + tallaActual.talla + "' alt2='" + tallaActual.cantidad + "' >";
                    html += "<td>" + tallaActual.talla + "</td>";
                    html += "<td>" + tallaActual.cantidad + "</td>";
                    html += "<td><button type='button' class='btn btn-danger btn-sm form-control' alt='" + tallaActual.talla + "' alt2='" + tallaActual.cantidad + "' id='b_eliminar_talla'><i class='fa fa-remove' aria-hidden='true'></i></button></td>";
                    html += "</tr>"

                    $('#t_tallas tbody').append(html);

                }


            }
            
            $('#dialog_agregar_tallas').modal('show');

        });

         $(document).on('click','#b_eliminar',function()
         {
            //-->NJES November/11/2020 verificar que si solo hay dos registros y uno es de fletes y logistica
            //al momento de eliminar el producto que no es de fletes y logistica se elimine tambien
            if($('#t_partidas .partida-requisicion').length == 2 && existeFletesLogistica() > 0)
                $('#t_partidas tbody').empty();
            else
                $(this).parent().parent().remove();

            //---MGFS SE AGREGA VALIDACION PARA CUANDO SE ELIMINAN TODAS LAS PARTIDAS 
            if($('.partida-requisicion').length==0){
                ivaRequi='';
            }

            calcularTotal();

            var iva0 = 0;
            $('#t_partidas .partida-requisicion').each(function(){
                if(parseInt($(this).attr('iva')) == 0)
                    iva0 ++;
            });

            //-->NJES December/09/2020 si quedan solo partidas con iva 0 permitir agregar nueva iva con 8 ó 16, ó igual seguir con 0
            if(iva0 == $('#t_partidas .partida-requisicion').length)
                ivaRequi='';
        });

        $('#b_guardar').click(function()
        {
            $('#b_guardar').prop('disabled',true);

            if($("#f_requisiciones").validationEngine('validate'))
            {
                //-->NJES November/11/2020 validar que si hay un producto de familia fletes y logistica haya otro de familia diferente
                if($('#t_partidas .partida-requisicion').length == 1 && existeFletesLogistica() > 0)
                {
                    mandarMensaje('Cuando existe un producto de fletes y logistica debe existir por lo menos un producto de diferente familia.');
                    $('#b_guardar').prop('disabled',false);
                }else{
                    var verificaPartidas = validarTallas();
                    if(verificaPartidas == true)
                    {
                        mandarMensaje('Algunas Partidas necesitan especificar las tallas, favor de verificar.')
                        $('#b_guardar').prop('disabled',false);
                    }else
                    {

                        //-->NJES  Feb/13/2020 valida que si solicito anticipo el monto sea diferente de vacio, sea mayor a 0 y no sobrepase el monto total de la requi
                        if($("#ch_anticipo").is(':checked'))
                        {
                            if($('#i_anticipo').val() != '' && parseFloat(quitaComa($('#i_anticipo').val())) > 0 && parseFloat(quitaComa($('#i_anticipo').val())) <= parseFloat(quitaComa($('#i_total').val())))
                            {
                                var yaVerfico=verificarPresupuesto();
                    
                                if( yaVerfico == true){
                                    mandarMensajeConfimacion('Verifica los productos en amarillo, ya que exceden del presupuesto, ¿Deseas continuar?',0,'aceptar_presupuesto');
                                    $('#b_guardar').prop('disabled',false);
                                }else{
                                    guardaRequi(0);
                                }
                            }else{
                                $('#dato_info_anticipo').text('* Verifica que el monto de anticipo sea mayor a 0 y no sobrepase el monto total de la requisición.').css('color','#74C687');
                                $('#dialog_anticipo').modal('show');
                                $('#b_guardar').prop('disabled',false);
                            }
                        }
                        else
                        {

                            var yaVerfico=verificarPresupuesto();
                    
                            if( yaVerfico == true){
                                mandarMensajeConfimacion('Verifica los productos en amarillo, ya que exceden del presupuesto, ¿Deseas continuar?',0,'aceptar_presupuesto');
                                $('#b_guardar').prop('disabled',false);
                            }else{
                                guardaRequi(0);
                            }
                        }

                    }
                }

            }else
                $('#b_guardar').prop('disabled',false);

        });

        function guardaRequi(excedePE)
        {


            var idRequisicion = idRequisicionM;
            var idUnidad = $('#s_id_unidad').val();
            var idSucursal = $('#s_id_sucursal').val();
            var idArea = $('#s_id_area').val();
            var idDepto = $('#s_id_departamento').val();

            var folio = $('#i_folio').val();
            var idProveedor = $('#i_proveedor').attr('alt');
            var fechaPedido = $('#i_fecha_pedido').val();
            var solicito = $('#i_solicito').val();
            var diasEntrega = $('#i_dias').val();
            var idUsuario = $('#i_id_usuario').val();
            var usuario = $('#i_capturo').val();
            var descripcion = $('#ta_descripcion').val();
            var tipoProducto = 2;//-mantenimiento

            var subtotal = quitaComa($('#i_subtotal').val());
            var iva = quitaComa($('#i_total_iva').val());
            var total = quitaComa($('#i_total').val());
            /**MGFS 05-11-2019   SE AGREGAN CAMPOS PARA REQUISICIONES DE MANTENIMIENTO */
            var folioMantenimiento = $('#i_folio_mantenimiento').val();
            var noEconomico = $('#i_no_economico').val();
            var responsable = $('#i_responsable').val();
            var kilometraje = $('#i_kilometraje').val();
            var idActivo = $('#i_no_economico').attr('activo');

            //-->NJES October/28/2020 se agrega descuento por partida, el costo unitario de cada partida ya incluye el descuento
            //y en base de datos se agregan dos campo en requisiciones_d (descuento_unitario y descuento_total)
            //si se quiere saber el costo orif¿ginal solo se suma el costo_unitario + descuento_unitario
            //en el encabezado en requisiciones se guarda el total de descuento de las partidas
            var descuento_total = quitaComa($('#i_descuento_total').val());

            var partidas = obtenerPartidasRequisicion();

            var datos = 
            {
                'mantenimiento' : 1,
                'id': idRequisicion,
                'id_unidad': idUnidad,
                'id_sucursal': idSucursal,
                'id_area': idArea,
                'id_depto': idDepto,
                'folio': folio,
                'id_proveedor': idProveedor,
                'fecha_pedido': fechaPedido,
                'solicito': solicito,
                'dias_entrega': diasEntrega,
                'id_usuario': idUsuario,
                'usuario': usuario,
                'descripcion':descripcion,
                'partidas': partidas,
                'tipo': tipoProducto,
                'subtotal': subtotal,
                'iva': iva,
                'total': total,
                'descuento_total': descuento_total,
                'excedePresupuesto' : excedePE,
                'folioMantenimiento' : folioMantenimiento,
                'noEconomico' : noEconomico,
                'responsable' : responsable,
                'kilometraje' : kilometraje,
                //--> NJES Jan/22/2020 guardar bandera anticipo y monto
                'anticipo' : $("#ch_anticipo").is(':checked') ? 1 : 0,
                'monto_anticipo' : parseFloat(quitaComa($('#i_anticipo').val())),
                'id_activo_fijo' : idActivo,
                'estatusActualR' : estatusActualR
            };

            var url = 'php/requisiciones_guardar.php';
            if(parseInt(idRequisicion) > 0)
                url = 'php/requisiciones_modificar.php';


            $.ajax({
                type: 'POST',
                url: url,
                data:  datos,
                success: function(data) 
                {
                    console.log("Resultado:"+data);
                    if(data>0){
                        mandarMensaje("La requisición con folio " + data +  " se guardo de forma adecuada");
                        limpiarForma();
                        $('#b_guardar').prop('disabled',false);
                    }else{
                        mandarMensaje("Ocurrio un error al durante el guardado");
                        limpiarForma();
                        $('#b_guardar').prop('disabled',false);
                    }
                        
                },
                error: function (xhr)
                {
                    console.log(JSON.stringify(xhr));
                    mandarMensaje(JSON.stringify(xhr));
                    $('#b_guardar').prop('disabled',false);
                }
            });

        }

        function validarTallas()
        {

            var verifica = false;

            $('.tallas-i').each(function(i, obj)
            {

                if($(this).val() == '')
                    verifica = true;
            
            });  

            return verifica;

        }

        $('#i_precio').change(function()
        {
            calcularMontos();
        });

        $('#i_cantidad').change(function()
        {
            calcularMontos();
        });

        $('#i_descuento').change(function()
        {
            calcularMontos();
        });

        function calcularMontos()
        {

            var cantidadProducto = $('#i_cantidad').val();
            var precio = quitaComa($('#i_precio').val());

            //-->NJES October/28/2020 se agrega descuento por partida, el costo unitario de cada partida ya incluye el descuento
            //y en base de datos se agregan dos campo en requisiciones_d (descuento_unitario y descuento_total)
            //si se quiere saber el costo orif¿ginal solo se suma el costo_unitario + descuento_unitario
            //en el encabezado en requisiciones se guarda el total de descuento de las partidas
            if($('#i_descuento').val() != '')
                var descuento = quitaComa($('#i_descuento').val());
            else
                var descuento = 0;
           
            if(cantidadProducto != '' && precio != '')
                $('#i_costo').val(formatearNumero(parseFloat(cantidadProducto) * (parseFloat(precio)-parseFloat(descuento))));

        }

        function obtenerPartidasRequisicion()
        {

            var partidas = [];
            var contador = 0;
            $("#t_partidas tbody tr").each(function()
            {

                var nPartida = $(this).attr('alt');
                var idProducto = $(this).attr('producto');
                var concepto = $(this).attr('concepto');
                var idFamilia = $(this).attr('id_familia');
                var familia = $(this).attr('familia');
                var idLinea = $(this).attr('id_linea');
                var linea = $(this).attr('linea');
                var precio = $(this).attr('precio');
                var cantidad = $(this).attr('cantidad');
                var costo = $(this).attr('costo');
                var descripcion = $(this).attr('descripcion');
                var justificacion = $(this).attr('justificacion');
                var iva = $(this).attr('iva');
                var excedePD = $(this).attr('excedePresupuesto');
                var tallas = $(this).find('.tallas-i').val();

                //-->NJES October/28/2020 se agrega descuento por partida, el costo unitario de cada partida ya incluye el descuento
                //y en base de datos se agregan dos campo en requisiciones_d (descuento_unitario y descuento_total)
                //si se quiere saber el costo orif¿ginal solo se suma el costo_unitario + descuento_unitario
                //en el encabezado en requisiciones se guarda el total de descuento de las partidas
                var descuento = $(this).attr('descuento');
                var descuento_total = $(this).attr('descuento_total');

                if(tallas == undefined)
                    tallas = '';

                partidas[contador] =
                {
                    'n_partida': nPartida,
                    'id_producto': idProducto, 
                    'concepto': concepto,
                    'id_familia': idFamilia,
                    'familia': familia,
                    'id_linea': idLinea,
                    'linea': linea,
                    'precio': precio,
                    'cantidad':cantidad, 
                    'costo': costo,
                    'descripcion': descripcion,
                    'justificacion': justificacion,
                    'iva':iva,
                    'excedePD':excedePD,
                    'tallas': tallas,
                    'descuento':descuento,
                    'descuento_total':descuento_total
                };
                
                contador++;
                
            });

            return partidas;

        }

        function limpiarForma()
        {
            estatusActualR = '';
            idRequisicionM='';
            $('#i_id_requisicion').val('');
            $('#i_id_folio').val('');

            $('#i_folio').val('');

            $('#i_subtotal').val(0);
            $('#i_total_iva').val(0);
            $('#i_total').val(0);
            $('#i_descuento_total').val(0);
            $('#s_id_unidad').val('');
            $('#s_id_sucursal').val('');
            $('#s_id_area').val('');
            $('#s_id_departamento').val('');
            $('#i_orden_compra').val('');

            $('#i_id_proveedor').val('');
            //$('#i_fecha_pedido').val('');
            $('#i_solicito').val('');
            $('#i_dias').val('');
            $('#i_id_usuario').val(<?php echo $_SESSION['id_usuario']; ?>);
            $('#i_capturo').val('<?php echo $_SESSION['usuario']; ?>');
            $('#ta_descripcion').val('');

            $('#i_fecha_pedido').val(hoy);

            $('#i_proveedor').attr('alt', 0);
            $('#i_proveedor').val('');

            $('#i_folio_mantenimiento').val('');
            $('#i_no_economico').val('');
            $('#i_responsable').val('');
            $('#i_kilometraje').val('');

            $('#i_id_producto').val('');
            $('#i_id_linea').val('');
            $('#i_linea').val('');
            $('#i_id_familia').val('');

            $('#i_id_familia_gasto').val('');

            $('#i_familia').val('');
            $('#i_concepto').val('');
            $('#i_descripcion').val('');
            $('#i_cantidad').val('');
            $('#i_precio').val('');
            $('#i_costo').val('');
            $('#i_iva').val(16);
            $('#i_justificacion').val('');
            $('#i_descuento').val('');

            $('#t_partidas >tbody tr').remove();

            limpiarCombos();

            $("#s_id_unidad").prop("disabled", false);
            $("#s_id_sucursal").prop("disabled", false);
            $("#s_id_area").prop("disabled", false);
            $("#s_id_departamento").prop("disabled", false);

            muestraSelectUnidades(matriz, 's_id_unidad', idUnidadActual);
            muestraSucursalesPermiso('s_id_sucursal', idUnidadActual,modulo, idUsuario);
            muestraAreasAcceso('s_id_area');
            

            $('#d_estatus').removeAttr('class');
            $('#d_estatus').text('').removeAttr('class');

            $('#b_cancelar').prop('disabled', true).attr({'estatus':0,'alt':0,'alt2':''});
            $('#b_guardar').prop('disabled', false);
            $('#b_imprimir').prop('disabled', true);

            //-->NJES Feb/13/2020 funcionalidad anticipo requisicion
            $('#ch_anticipo').prop({'checked':false,'disabled':false});
            $('#i_anticipo').val(0);
            $('#b_ver_presupuesto').css('display','none').attr('data-content','');
            $('[data-toggle="popover"]').popover('hide');
            
            //-->NJES March/11/2020 se obtiene el responsable del activo fijo, eliminar popover
            $('#i_no_economico').attr('activo',0);
            //$('#i_no_economico').popover('dispose');

            ivaRequi='';

        }

        $('#b_buscar').click(function()
        {
            muestraSelectUnidades(matriz, 's_filtro_unidad', idUnidadActual);
            muestraSucursalesPermiso('s_filtro_sucursal',idUnidadActual,modulo,idUsuario);
            $('#i_filtro_1').val('');
            $('#i_fecha_inicio').val('');
            $('#i_fecha_fin').val('');
            $('.requisicion-busqueda').remove();
            $('#dialog_buscar_requisiciones').modal('show');
            //-->NJES March/12/2020 se limpia input filtro cada que se abra modal
            $('#i_filtro_requisiciones').val('');
        });

        $(document).on('change','#s_filtro_unidad',function(){
            var idUnidad=$(this).val();
            if(idUnidad!= ''){
                $('.img-flag').css({'width':'50px','height':'20px'});
            }
            muestraSucursalesPermiso('s_filtro_sucursal',idUnidad,modulo,idUsuario);
            $('#i_filtro_requisiciones').val('');
            $('#i_fecha_inicio').val('');
            $('#i_fecha_fin').val('');
            $('.requisicion-busqueda').remove();
            
        });

    

        $(document).on('change', '#s_filtro_sucursal',function(){
            buscarRequisicion();
       });

        $('#i_fecha_inicio').change(function()
        {

            if($('#i_fecha_inicio').val() != '')
            {
                $('#i_fecha_fin').prop('disabled',false);
                if($('#s_filtro_sucursal').val()>0){
                    buscarRequisicion();
                }else{
                    mandarMensaje('Debes selecionar una sucursal, para iniciar la búsqueda');
                }
            }

        });

        $('#i_fecha_fin').change(function(){  

            if($('#s_filtro_sucursal').val()>0){
                
                buscarRequisicion();
            }else{
                mandarMensaje('Debes selecionar una sucursal, para iniciar la búsqueda');
            }
            
        });

        function buscarRequisicion()
        {
            $('.requisicion-busqueda').remove();

            $.ajax({
                type: 'POST',
                url: 'php/requisiciones_buscar_todas.php',
                dataType:"json", 
                data:{
                    'mantenimiento':1,
                    'idUnidadNegocio':$('#s_filtro_unidad').val(),
                    'idSucursal':$('#s_filtro_sucursal').val(),
                    'fecha_de':$('#i_fecha_inicio').val(),
                    'fecha_a':$('#i_fecha_fin').val()
                },
                success: function(data)
                {
                    
                    for(var i=0; data.length>i; i++)
                    {

                        var requisicion = data[i];

                        var estatus = '';  
                        //-- MGFS 15-01-2020 SE MODIFICA EL ESTATUS YA QUE DEBO VERIFICAR SI EL  PRESUPUESTO ESTA AUTORIZADO 
                        //--- si la autorizacion del presupuesto es 0=pendiente 1=Autorizado 2=rechazado
                        if(requisicion.presupuesto_aprobado==1){
                            
                            if(requisicion.estatus == 1)
                                estatus = 'Pendiente';

                            if(requisicion.estatus == 2)
                                estatus = 'Autorizada';

                            if(requisicion.estatus == 3)
                                estatus = 'Rechazada';

                            if(requisicion.estatus == 4)
                                estatus = 'Orden de Compra';

                            if(requisicion.estatus == 5)
                                estatus = 'Por Pagar';

                            if(requisicion.estatus == 6)
                                estatus = 'Pagada';

                            if(requisicion.estatus == 7)
                                estatus = 'Cancelada';

                        }else if(requisicion.presupuesto_aprobado==0){      
                            estatus = 'Pendiente';
                        }else{
                            estatus = 'Rechazada';
                        }

                        var classExcede='';
                        if(parseInt(requisicion.excede_presupuesto)==1){
                            classExcede='excede';
                        }

                        var html = "<tr class='requisicion-busqueda "+classExcede+"' alt='" + requisicion.id + "'>";
                        html += "<td>" + requisicion.folio_mantenimiento + "</td>";
                        html += "<td>" + requisicion.folio + "</td>";
                        html += "<td>" + requisicion.unidad + "</td>";
                        html += "<td>" + requisicion.sucursal + "</td>";
                        html += "<td>" + requisicion.are + "</td>";
                        html += "<td>" + requisicion.depto + "</td>";
                        html += "<td>" + estatus + "</td>";
                        html += "</tr>";

                        $('#t_requisiciones_b tbody').append(html);
                    
                    }
                
         
                },
                error: function (xhr)
                {
                    console.log('php/requisiciones_buscar_todas.php->'+JSON.stringify(xhr));
                    mandarMensaje('* Ocurrio un error al buscar la requisiciones');
                }
            });

        }

       

        
        $("#t_requisiciones_b").on('click',".requisicion-busqueda",function()
        {   
            var idR = $(this).attr('alt');
            idRequisicionM = idR;
            $.ajax({
                type: 'POST',
                url: 'php/requisiciones_buscar_todas.php',
                dataType:"json", 
                data:{
                    'mantenimiento':1,
                    'id': idR
                },
                success: function(data)
                {
            
                    for(var i=0; data.length>i; i++)
                    {

                        var requisicion = data[i];
                        
                   
                        idUnidad = requisicion.id_unidad_negocio;
                        idSucursal = requisicion.id_sucursal;
                        idArea = requisicion.id_area;
                        idDepartamento = requisicion.id_departamento;

                        nombreProveedor = requisicion.nombre_proveedor;

                        $('#i_id_requisicion').val(idR);


                        limpiarCombos();

                        $('#s_id_unidad').val(idUnidad);
                        $("#s_id_unidad").select2({
                            templateResult: setCurrency,
                            templateSelection: setCurrency
                        });
                        $('.img-flag').css({'width':'50px','height':'20px'}); //Cambia el tamaño de la imagen que se mostrara en el selectB

                        optionSurucursal = new Option(requisicion.sucursal, requisicion.id_sucursal, true, true);
                        $('#s_id_sucursal').append(optionSurucursal).trigger('change');

                        optionArea = new Option(requisicion.are, requisicion.id_area, true, true);
                        $('#s_id_area').append(optionArea).trigger('change');

                        optionDepto = new Option(requisicion.depto, requisicion.id_departamento, true, true);
                        $('#s_id_departamento').append(optionDepto).trigger('change');

                        $("#s_id_unidad").prop("disabled", true)
                        $("#s_id_sucursal").prop("disabled", true)
                        $("#s_id_area").prop("disabled", true)
                        $("#s_id_departamento").prop("disabled", true)


                        $('#i_subtotal').val(formatearNumero(requisicion.subtotal));
                        $('#i_total_iva').val(formatearNumero(requisicion.iva));
                        $('#i_total').val(formatearNumero(requisicion.total));

                        $('#i_descuento_total').val(formatearNumero(requisicion.descuento));

                        $('#i_folio').val(requisicion.folio);
                        $('#i_fecha_pedido').val(requisicion.fecha_pedido);
                        $('#i_solicito').val(requisicion.solicito);
                        $('#i_dias').val(requisicion.tiempo_entrega);
                        $('#i_id_usuario').val(requisicion.id_capturo);
                        $('#i_capturo').val(requisicion.capturo);
                        $('#ta_descripcion').val(requisicion.descripcion);
                        $('#i_orden_compra').val(requisicion.folio_orden_compra);

                        $('#i_proveedor').attr('alt', requisicion.id_proveedor).val(requisicion.proveedor);

                        $('#d_estatus').removeAttr('class');
                        $('#d_estatus').text('').removeAttr('class');

                        //-->NJES Feb/13/2020 checked si la requisición solicito anticipo
                        if(requisicion.b_anticipo == 1 && requisicion.tipo != 1)
                        {
                            $('#ch_anticipo').prop({'checked':true,'disabled':true});
                            $('#b_ver_presupuesto').css('display','block').attr('data-content','Monto anticipo: $'+formatearNumero(requisicion.monto_anticipo));
                            $('#i_anticipo').val(requisicion.monto_anticipo); 
                        }else{
                            $('#ch_anticipo').prop({'checked':false,'disabled':true});
                            $('#b_ver_presupuesto').css('display','none').attr('data-content','');
                            $('#i_anticipo').val(0); 
                        }

                        $('[data-toggle="popover"]').popover();

                        $('#b_cancelar').attr('alt',requisicion.id_gasto).attr('alt2',requisicion.referencia_gasto).attr('estatus',requisicion.estatus);
                       
                        $('#b_cancelar').prop('disabled', true);
                        $('#b_guardar').prop('disabled', true);
                        $('#b_imprimir').prop('disabled', true);

                        //-->NJES February/03/2021 si la requisicion es pendiente y se actualiza, 
                        //se debe actualizar la fecha de pedidio con la fecha en que se esta actualizando
                        estatusActualR = requisicion.estatus;

                        //-- MGFS 15-01-2020 SE MODIFICA EL ESTATUS YA QUE DEBO VERIFICAR SI EL  PRESUPUESTO ESTA AUTORIZADO 
                        //--- si la autorizacion del presupuesto es 0=pendiente 1=Autorizado 2=rechazado
                        if(requisicion.presupuesto_aprobado==1){
                         
                            // 1 = Pendiente, 2 = Autorizadar, 3 = NO autorizada, 4 = Orden de compra, 5 = Por Pagar, 6 =  Pagada
                            if(requisicion.estatus == 1)
                            {
                                $('#b_cancelar').prop('disabled', false);
                                $('#d_estatus').addClass('alert alert-sm alert-info').text('PENDIENTE');
                                $('#b_guardar').prop('disabled', false);
                                $('#b_imprimir').prop('disabled', false);
                            }
                        
                            if(requisicion.estatus == 2)
                            {   $('#b_cancelar').prop('disabled', false);
                                $('#b_imprimir').prop('disabled', false);
                                $('#d_estatus').addClass('alert alert-sm alert-success').text('AUTORIZADA');
                            }
                            if(requisicion.estatus == 3)
                            {
                                $('#b_cancelar').prop('disabled', true);
                                $('#b_guardar').prop('disabled', true);
                                $('#b_imprimir').prop('disabled', true);
                                $('#d_estatus').addClass('alert alert-sm alert-danger').text('RECHAZADA');
                            }
                            if(requisicion.estatus == 4)
                            {   $('#b_imprimir').prop('disabled', false);
                                $('#d_estatus').addClass('alert alert-sm alert-info').text('ORDENADA');
                            }
                            if(requisicion.estatus == 5)
                            {    $('#b_imprimir').prop('disabled', false);
                                 $('#d_estatus').addClass('alert alert-sm alert-default').text('POR PAGAR');
                            }
                            if(requisicion.estatus == 6)
                            {    $('#b_imprimir').prop('disabled', false);
                                $('#d_estatus').addClass('alert alert-sm alert-success').text('PAGADA');
                            }

                            if(requisicion.estatus == 7)
                            {
                                $('#b_cancelar').prop('disabled', true);
                                $('#b_guardar').prop('disabled', true);
                                $('#b_imprimir').prop('disabled', true);
                                $('#d_estatus').addClass('alert alert-sm alert-danger').text('CANCELADA');
                            }
                        }else if(requisicion.presupuesto_aprobado==0){ 

                            $('#b_cancelar').prop('disabled', false);
                            $('#d_estatus').addClass('alert alert-sm alert-info').text('PENDIENTE');
                            $('#b_guardar').prop('disabled', false);
                            $('#b_imprimir').prop('disabled', false);
                            $('#ch_anticipo').prop('disabled',false);

                        }else{

                            $('#b_cancelar').prop('disabled', true);
                            $('#b_guardar').prop('disabled', true);
                            $('#b_imprimir').prop('disabled', true);
                            $('#d_estatus').addClass('alert alert-sm alert-danger').text('RECHAZADA');
                        }    

                        
                        $('#i_folio_mantenimiento').val(requisicion.folio_mantenimiento);
                        //$('#i_no_economico').val(requisicion.no_economico);
                        //-->NJES March/11/2020 se obtiene el responsable del activo fijo
                        $('#i_no_economico').val(requisicion.no_economico).attr('activo',requisicion.id_activo_fijo);
                        //$('[data-toggle="popover"]').popover();
                        $('#i_responsable').val(requisicion.responsable).prop('disabled',false);
                        $('#i_kilometraje').val(requisicion.kilometraje);


                        $('#t_partidas >tbody tr').remove();

                        //-->NJES December/02/2020 actualizar variable con el iva mayor capturado para poder vaidar que solo acepte partidas con iva 0 y 8 ó 0 y 16
                        if(requisicion.iva_m != 0)
                            ivaRequi = requisicion.iva_m;

                        $.ajax({
                            type: 'POST',
                            url: 'php/requisiciones_buscar_detalles_modificacion.php',
                            dataType:"json", 
                            data:{
                                'id':requisicion.id
                            },
                            success: function(data)
                            {
                                
                                totalPartidas = 0;
                                //var data = JSON.parse(data);
                                for(var i=0; data.length>i; i++)
                                {

                                    var detalle = data[i];

                                    totalPartidas++;
                                    
                                    var classExcede='';
                                    if(parseInt(detalle.excede_presupuesto)==1){
                                        classExcede='excede';
                                    }

                                    var html = "<tr class='partida-requisicion "+classExcede+"' excedePresupuesto='"+detalle.excede_presupuesto+"' alt='" + totalPartidas +  "' producto='" + detalle.id_producto + "' concepto='" + detalle.concepto+ "' id_familia_gasto='"+detalle.id_familia_gasto+"' id_familia='" + detalle.id_familia + "' familia='" + detalle.familia + "' id_linea='" + detalle.id_linea + "' linea='" + detalle.linea + "' precio='" + detalle.costo_unitario + "' descuento='"+detalle.descuento_unitario+"' descuento_total='"+detalle.descuento_total+"' cantidad='" +  detalle.cantidad + "' costo='" + redondear(parseFloat(detalle.costo_unitario) * parseFloat(detalle.cantidad)) + "' descripcion='" + detalle.descripcion + "' justificacion='" + detalle.justificacion + "' iva='" + detalle.porcentaje_iva + "' id_clas='"+detalle.id_clas+"' >";
                                    html += "<td>" + detalle.familia + "</td>";
                                    html += "<td>"+detalle.clasificacion+"</td>";
                                    html += "<td>" + detalle.linea + "</td>";
                                    html += "<td>" + detalle.concepto + "</td>";
                                    html += "<td>" + detalle.descripcion + "</td>";
                                    html += "<td align='right'>" + detalle.cantidad + "</td>";
                                    html += "<td align='right'>" + formatearNumero(detalle.costo_unitario) + "</td>";
                                    html += "<td align='right'>" + formatearNumero(detalle.descuento_unitario) + "</td>";
                                    html += "<td align='right'>" + formatearNumero(detalle.descuento_total) + "</td>";
                                    html += "<td align='right'>" + detalle.porcentaje_iva + "</td>";
                                    html += "<td align='right'>" + formatearNumero(parseFloat(detalle.costo_unitario) * parseFloat(detalle.cantidad)) + "</td>";
                                    
                                    html += "<td>" + detalle.justificacion + "</td>";

                                    var botonTalla = '';
                                    if(parseInt(detalle.verifica_talla) == 1)
                                    {

                                        botonTalla = "<button type='button' class='btn btn-success btn-sm form-control' id='b_talla' alt='" + detalle.id_producto + "'  alt2='" + detalle.cantidad + "'  alt3='" + totalPartidas + "' ><i class='fa fa-list' aria-hidden='true'></i></button><input  class='tallas-i' type='hidden' id='i_talla" + totalPartidas + "'  name='i_talla" + totalPartidas + "' value='" + detalle.tallas + "'>";

                                    }

                                    html += "<td>" + botonTalla + "</td>";

                                    html += "<td><button type='button' class='btn btn-danger btn-sm form-control' id='b_eliminar' alt='" + detalle.id_producto + "'><i class='fa fa-remove' aria-hidden='true'></i></button></td>";

                                    html += "</tr>";

                                    $('#t_partidas tbody').append(html);

                                    totalPartidas++;
                                
                                }

                     
                            },
                            error: function (xhr)
                            {
                                console.log('php/requisiciones_buscar_detalles_modificacion.php-->'+JSON.stringify(xhr));
                                mandarMensaje(xhr.responseText);
                            }
                        });

                    }              

                    $('#dialog_buscar_requisiciones').modal('hide');
         
                },
                error: function (xhr)
                {
                    mandarMensaje('ERROR');
                }

            });

            
        });

        function limpiarCombos()
        {
            $('#s_id_sucursal').html('');
            $('#s_id_area').html('');
            $('#s_id_departamento').html('');
        }

        $('#b_detalle_proveedor').click(function(){
            if($('#i_proveedor').val() != '')
            {
                var idProveedor = $('#i_proveedor').attr('alt');
              
                $.ajax({
                    type: 'POST',
                    url: 'php/proveedores_buscar_id.php',
                    dataType:"json", 
                    data:{
                        'idProveedor':idProveedor
                    },
                    success: function(data) {
                        if(data.length > 0){
                            if(data[0].num_int != '')
                            {
                                var num_int=' Int.'+data[0].num_int;
                            }else{
                                var num_int='';
                            }

                            $('#nombre_proveedor').text(data[0].nombre);

                            var detalles = '<p>Nombre: '+data[0].nombre+'</p>';
                                detalles += '<p>RFC: '+data[0].rfc+'</p>';
                                detalles += '<p>Domicilio: '+data[0].domicilio+' '+data[0].num_ext+' '+num_int+'. '+data[0].colonia+', '+data[0].municipio+', '+data[0].estado+', '+data[0].pais+'</p>';
                                detalles += '<p>Código Postal: '+data[0].cp+'</p>';
                                detalles += '<p>Telefono: '+data[0].telefono+'</p>';
                                detalles += '<p>Dias Credito: '+data[0].dias_credito+'</p>';
                                detalles += '<p>Web: '+data[0].web+'</p>';
                                detalles += '<p>Contacto: '+data[0].contacto+'</p>';
                                detalles += '<p>Condiciones: '+data[0].condiciones+'</p>';

                            $('#div_datos_proveedor').html(detalles);

                        }

                        $('#dialog_proveedores_datos').modal('show');
                        
                    },
                    error: function (xhr) 
                    {
                        console.log('php/proveedores_buscar_id.php --> '+JSON.stringify(xhr));
                        mandarMensaje('Error en el sistema');
                    }
                });
            }else{
                mandarMensaje('Primero debes selecionar un proveedor');
            }
        });

        $('#b_buscar_proveedor,#b_buscar_proveedores').click(function()
        {   $('#t_proveedores tbody').empty();
            var forma = $(this).attr('alt');
            $('#i_filtro_proveedor').val('');
            if(forma=='si'){
                muestraModalProveedoresUnidades('renglon_proveedor renP','t_proveedores tbody','dialog_proveedores', $('#s_id_unidad').val());
    
            }else{
                muestraModalProveedoresUnidades('renglon_proveedores renP','t_proveedores tbody','dialog_proveedores', $('#s_id_unidad').val());
    
            }
        });

        $('#t_proveedores').on('click', '.renglon_proveedores', function()
        {

            var id = $(this).attr('alt');
            var nombre = $(this).attr('alt2');
            $('#i_proveedor').attr('alt',id).val(nombre);
            $('#dialog_proveedores').modal('hide');

        });


        function limpiaFormaEdicionPartidas(){
            $('#i_id_producto').val('');
            $('#i_id_linea').val('');
            $('#i_linea').val('');
            $('#i_id_familia').val('');

                
            $('#i_id_familia_gasto').val('');


            $('#i_familia').val('');
            $('#i_concepto').val('');
            $('#i_descripcion').val('');
            $('#i_cantidad').val('');
            $('#i_precio').val('');
            $('#i_costo').val('');
            $('#i_iva').val(16);
            $('#i_justificacion').val('');

            $('#t_partidas >tbody tr').remove();
            calcularTotal();
        }

        $("#t_partidas").on('dblclick',".partida-requisicion",function()
        {  

            // seleccionando partida
            $('#i_id_producto').val($(this).attr('producto'));
            $('#i_id_linea').val($(this).attr('id_linea'));
            $('#i_linea').val($(this).attr('linea'));
            $('#i_id_familia').val($(this).attr('id_familia'));

            $('#i_id_familia_gasto').val($(this).attr('id_familia_gasto'));

            $('#i_familia').val($(this).attr('familia'));
            $('#i_concepto').val($(this).attr('concepto'));
            $('#i_descripcion').val($(this).attr('descripcion'));
            $('#i_cantidad').val($(this).attr('cantidad'));
            $('#i_descuento').val($(this).attr('descuento'));
            $('#i_precio').val(formatearNumero(parseFloat($(this).attr('precio'))+parseFloat($(this).attr('descuento'))));
            $('#i_costo').val(formatearNumero($(this).attr('costo')));
            $('#i_iva').val($(this).attr('iva'));
            $('#i_justificacion').val($(this).attr('justificacion'));

            var iva16 = 0;
            var iva8 = 0;
            var iva0 = 0;

            if($('#t_partidas .partida-requisicion').length > 1)
            {
                $('#t_partidas .partida-requisicion').each(function(){
                    if(parseInt($(this).attr('iva')) == 16)
                        iva16 ++;

                    if(parseInt($(this).attr('iva')) == 8)
                        iva8 ++;
                    
                    if(parseInt($(this).attr('iva')) == 0)
                        iva0 ++;
                });

                //-->NJES November/11/2020 no actualizar la variable del iva cuando el producto es de fletes y logistica
                //-->NJES December/01/2020 no actualizar la variable iva cuando el productos es de iva 0
                if($('#i_id_familia_gasto').val() != 104 && parseInt($(this).attr('iva')) != 0)
                {
                    if(((iva16 == 1 || iva8 == 1) && (iva0+iva16 == $('#t_partidas .partida-requisicion').length || iva0+iva8 == $('#t_partidas .partida-requisicion').length)) || (iva0 == $('#t_partidas .partida-requisicion').length)) 
                    {    
                        ivaRequi='';
                    }else{
                        ivaRequi=$(this).attr('iva');
                    }
                }

            }else
                ivaRequi='';

            $(this).remove();
            calcularTotal();
        });

        function calcularTotal()
        {
            var subtotal = 0;
            var tIva = 0;
            var total = 0;
             //-->NJES October/28/2020 se agrega descuento por partida, el costo unitario de cada partida ya incluye el descuento
            //y en base de datos se agregan dos campo en requisiciones_d (descuento_unitario y descuento_total)
            //si se quiere saber el costo orif¿ginal solo se suma el costo_unitario + descuento_unitario
            //en el encabezado en requisiciones se guarda el total de descuento de las partidas
            var descuentoTotal = 0;
            $("#t_partidas tbody tr").each(function()
            {
                var costo = parseFloat($(this).attr('costo'));
                var iva = parseInt($(this).attr('iva'));
                var descuento = parseFloat($(this).attr('descuento_total'));

                console.log("costo del row: ", costo);
                console.log("iva del row: ", iva);
                console.log("descuento del row: ", descuento);

                subtotal += costo;
                console.log("el subtotal va en: ", subtotal);
                tIva += ((costo/100) * iva);
                console.log("el tIva va en: ", tIva);
                console.log("-------------------------------");
                descuentoTotal += descuento;

            });

            $('#i_subtotal').val(formatearNumero(subtotal));
            $('#i_total_iva').val(formatearNumero(tIva));
            $('#i_total').val(formatearNumero(subtotal + tIva));
            $('#i_descuento_total').val(formatearNumero(descuentoTotal));

        }

        (function($) {
              $.fn.inputFilter = function(inputFilter) {
                return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
                  if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                  } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                  }
                });
              };
            }(jQuery));

       /* $("#i_cantidad").inputFilter(function(value)
        {
            return /^\d*$/.test(value);
        });*/

        $("#i_t_cantidad").inputFilter(function(value)
        {
            return /^\d*$/.test(value);
        });

       /* $("#i_precio").inputFilter(function(value)
        {
            return /^-?\d*[.,]?\d{0,2}$/.test(value)
        });*/

        $("#i_iva").inputFilter(function(value)
        {
            return /^\d*$/.test(value) && (value === "" || parseInt(value) == 0 || parseInt(value) == 8 || parseInt(value) == 1 || parseInt(value) == 16);
        });

        $('#b_cancelar').click(function()
        {
            var idGasto = $(this).attr('alt');
            var referenciaGasto  = $(this).attr('alt2');
            var estatusR = $(this).attr('estatus');
            var id = $('#i_id_requisicion').val();

            //-->NJES Feb/13/2020 se agrega el estatus de la requisicion para si se va  a cancelar
            //y esta autorizada y es con anticipo verificar si tiene cxp y si el cxp generado 
            //tiene abonos sin cancelar o ya fue liquidado el cxp inicial, si es asi ya no podra
            //cancelar hasta que en cxp se cancelen los movimientos
            if(parseInt(idGasto)==0){
                if(parseInt(estatusR) == 2 && existeCxpRequisicion(id) > 0)
                {
                    mandarMensaje('No es posible cancelar ya que cuenta con un registro ligado en cxp.');
                }else{
                    $('#l_id_folio').text('');
                    $('#l_id_folio').text($('#i_folio').val());
                    $('#dialog_confirm').modal('show');
                }
            }else{
                mandarMensaje('La requisición con folio: '+$('#i_folio').val()+' <br> No se puede cancelar por que tiene un Gasto relacionado <br> <strong> Referencia: '+referenciaGasto+'</strong> <br> Debes cancelar primero el gasto');
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

        $('#b_cancelar_requisicion').click(function()
        {
            
            var idRequisicion = $('#i_id_requisicion').val();
            //limpiarForma();
            $.ajax({
                type: 'POST',
                url: 'php/requisiciones_cancelar.php',
                data:{
                    'id':idRequisicion
                },
                success: function(data)
                {

                    limpiarForma();
                    $.ajax({
                        type: 'POST',
                        url: 'php/requisiciones_buscar_todas.php',
                        dataType:"json", 
                        data:{
                            'mantenimiento':1,
                            'id': idRequisicion
                        },
                        success: function(data)
                        {
                    
                            for(var i=0; data.length>i; i++)
                            {

                                var requisicion = data[i];
                                id = requisicion.id;
                                idUnidad = requisicion.id_unidad_negocio;
                                idSucursal = requisicion.id_sucursal;
                                idArea = requisicion.id_area;
                                idDepartamento = requisicion.id_departamento;

                                nombreProveedor = requisicion.nombre_proveedor;

                                $('#i_id_requisicion').val(requisicion.id);


                                limpiarCombos();

                                $('#s_id_unidad').val(idUnidad);
                                $("#s_id_unidad").select2({
                                    templateResult: setCurrency,
                                    templateSelection: setCurrency
                                });
                                $('.img-flag').css({'width':'50px','height':'20px'}); //Cambia el tamaño de la imagen que se mostrara en el selectB

                                optionSurucursal = new Option(requisicion.sucursal, requisicion.id_sucursal, true, true);
                                $('#s_id_sucursal').append(optionSurucursal).trigger('change');

                                optionArea = new Option(requisicion.are, requisicion.id_area, true, true);
                                $('#s_id_area').append(optionArea).trigger('change');

                                optionDepto = new Option(requisicion.depto, requisicion.id_departamento, true, true);
                                $('#s_id_departamento').append(optionDepto).trigger('change');

                                $("#s_id_unidad").prop("disabled", true)
                                $("#s_id_sucursal").prop("disabled", true)
                                $("#s_id_area").prop("disabled", true)
                                $("#s_id_departamento").prop("disabled", true)


                                $('#i_subtotal').val(formatearNumero(requisicion.subtotal));
                                $('#i_total_iva').val(formatearNumero(requisicion.iva));
                                $('#i_total').val(formatearNumero(requisicion.total));

                                $('#i_folio').val(requisicion.folio);
                                $('#i_fecha_pedido').val(requisicion.fecha_pedido);
                                $('#i_solicito').val(requisicion.solicito);
                                $('#i_dias').val(requisicion.tiempo_entrega);
                                $('#i_id_usuario').val(requisicion.id_capturo);
                                $('#i_capturo').val(requisicion.capturo);
                                $('#ta_descripcion').val(requisicion.descripcion);

                                $('#i_proveedor').attr('alt', requisicion.id_proveedor).val(requisicion.proveedor);

                                $('#d_estatus').removeAttr('class');
                                $('#d_estatus').text('').removeAttr('class');

                                $('#b_cancelar').prop('disabled', true);
                                $('#b_guardar').prop('disabled', true);
                                    
                                if(requisicion.estatus == 1)
                                {
                                    $('#b_cancelar').prop('disabled', false);
                                    $('#d_estatus').addClass('alert alert-sm alert-info').text('PENDIENTE');
                                    $('#b_guardar').prop('disabled', false);
                                    $('#b_imprimir').prop('disabled', false);
                                }

                                if(requisicion.estatus == 7)
                                {
                                    $('#b_cancelar').prop('disabled', true);
                                    $('#b_guardar').prop('disabled', true);
                                    $('#b_imprimir').prop('disabled', true);
                                    $('#d_estatus').addClass('alert alert-sm alert-danger').text('CANCELADA');
                                }
                                
                                $('#i_folio_mantenimiento').val(requisicion.folio_mantenimiento);
                                //$('#i_no_economico').val(requisicion.no_economico);
                                //-->NJES March/11/2020 se obtiene el responsable del activo fijo
                                $('#i_no_economico').val(requisicion.no_economico).attr('activo',requisicion.id_activo_fijo);
                                //$('[data-toggle="popover"]').popover();
                                $('#i_responsable').val(requisicion.responsable);
                                $('#i_kilometraje').val(requisicion.kilometraje);

                                $('#t_partidas >tbody tr').remove();
                                $.ajax({
                                    type: 'POST',
                                    url: 'php/requisiciones_buscar_detalles_modificacion.php',
                                    dataType:"json", 
                                    data:{
                                        'id':requisicion.id
                                    },
                                    success: function(data)
                                    {
                                        
                                        totalPartidas = 0;
                                        for(var i=0; data.length>i; i++)
                                        {

                                            var detalle = data[i];

                                            totalPartidas++;

                                            var classExcede='';
                                            if(parseInt(detalle.excede_presupuesto)==1){
                                                classExcede='excede';
                                            }

                                            var html = "<tr class='partida-requisicion "+classExcede+"' excedePresupuesto='"+detalle.excede_presupuesto+"' alt='" + totalPartidas +  "' producto='" + detalle.id_producto + "' concepto='" + detalle.concepto+ "' id_familia_gasto='"+detalle.id_familia_gasto+"' id_familia='" + detalle.id_familia + "' familia='" + detalle.familia + "' id_linea='" + detalle.id_linea + "' linea='" + detalle.linea + "' precio='" + detalle.costo_unitario + "' descuento='"+detalle.descuento_unitario+"' descuento_total='"+detalle.descuento_total+"' cantidad='" +  detalle.cantidad + "' costo='" + redondear(parseFloat(detalle.costo_unitario) * parseFloat(detalle.cantidad)) + "' descripcion='" + detalle.descripcion + "' justificacion='" + detalle.justificacion + "' iva='" + detalle.porcentaje_iva + "' id_clas='"+detalle.id_clas+"' >";
                                            html += "<td>" + detalle.familia + "</td>";
                                            html += "<td>"+detalle.clasificacion+"</td>";
                                            html += "<td>" + detalle.linea + "</td>";
                                            html += "<td>" + detalle.concepto + "</td>";
                                            html += "<td>" + detalle.descripcion + "</td>";
                                            html += "<td align='right'>" + detalle.cantidad + "</td>";
                                            html += "<td align='right'>" + formatearNumero(detalle.costo_unitario) + "</td>";
                                            html += "<td align='right'>" + formatearNumero(detalle.descuento_unitario) + "</td>";
                                            html += "<td align='right'>" + formatearNumero(detalle.descuento_total) + "</td>";
                                            html += "<td align='right'>" + detalle.porcentaje_iva + "</td>";
                                            html += "<td align='right'>" + formatearNumero(parseFloat(detalle.costo_unitario) * parseFloat(detalle.cantidad)) + "</td>";
                                            
                                            html += "<td>" + detalle.justificacion + "</td>";

                                            var botonTalla = '';
                                            if(detalle.verifica_talla == 1)
                                            {

                                                botonTalla = "<button type='button' class='btn btn-success btn-sm form-control' id='b_talla' alt='" + detalle.id_producto + "'  alt2='" + detalle.cantidad + "'  alt3='" + totalPartidas + "' ><i class='fa fa-list' aria-hidden='true'></i></button><input  class='tallas-i' type='hidden' id='i_talla" + totalPartidas + "'  name='i_talla" + totalPartidas + "' value='" + detalle.tallas + "'>";

                                            }

                                            html += "<td>" + botonTalla + "</td>";

                                            html += "<td><button type='button' class='btn btn-danger btn-sm form-control' id='b_eliminar' alt='" + detalle.id_producto + "'><i class='fa fa-remove' aria-hidden='true'></i></button></td>";

                                            html += "</tr>";

                                            $('#t_partidas tbody').append(html);

                                            totalPartidas++;
                                        
                                        }

                             
                                    },
                                    error: function (xhr)
                                    {
                                        mandarMensaje(xhr.responseText);
                                    }
                                });

                            }              

                            $('#dialog_confirm').modal('hide');
                            mandarMensaje('La Requisición se cancelo de forma adecuada.')
                 
                        },
                        error: function (xhr)
                        {
                            mandarMensaje('ERROR');
                        }

                    });
         
                },
                error: function (xhr)
                {
                    mandarMensaje('ERROR');
                }
            });


        });

        $('#b_imprimir').click(function()
        {
            var idRequisicion = $('#i_id_requisicion').val();

            var datos = {
                'path':'formato_requisicion_mantenimiento',
                'idRegistro':idRequisicion,
                'nombreArchivo':'requisicion_mantenimiento',
                'tipo':1
            };

            let objJsonStr = JSON.stringify(datos);
            let datosJ = datosUrl(objJsonStr);

            window.open("php/convierte_pdf.php?D="+datosJ,'_new')

        });

         /*********************inicio llena lista tallas*********************/
         function muestraTallas(){
            $('#lista_tallas').empty();
            $.ajax({
                type: 'POST',
                url: 'php/tallas_buscar_lista.php',
                dataType:"json", 
                success: function(data) {
                    $('#lista_clientes').empty();
                    for(var i=0;data.length>i;i++){

                        var html='<option value="'+data[i].talla+'"></option>';
                        
                        $('#lista_tallas').append(html);
                    }
                },
                error: function (xhr) {
                    console.log('tallas_buscar_lista.php --> '+JSON.stringify(xhr));
                    mandarMensaje('No se encontró información al buscar tallas.');
                }
            });
        }

        /***********BOTON REGRESAR ********* */
        $('#b_regresar').on('click',function(){
           
           $("#div_proveedor").animate({left : "-101%"}, 500, 'swing');
           $('#div_principal').animate({left : "0%"}, 600, 'swing');
       });

        /**************************  AGREGAR UN PROVEEDOR ********************************************* */
        $('#b_agregar_proveedor').on('click',function(){
            idProveedor=0;
            proveedorOriginal='';
            tipo_mov=0;
            $('#b_nuevo_proveedor').click();
            $("#div_principal").animate({left : "-101%"}, 500, 'swing');
            $('#div_proveedor').animate({left : "0%"}, 600, 'swing');
            muestraSelectPaises('s_pais');
            $('#dialog_agregar_proveedor').modal('show');
            $('#ch_inactivo').prop('checked',false).prop('disabled',true);
            
        });

        $('#b_rfc').on('click',function(){
            
            $('#i_rfc').val('XEXX010101000');

            if($('#s_pais').val()==141){

                $('#s_pais').val(236).prop('disabled',true);
                $('#s_pais').select2({placeholder: $(this).data('elemento')});
            }
            
        });

        $('#t_proveedores').on('click', '.renglon_proveedor', function() {
           
            tipo_mov = 1;
            $('#b_guardar').prop('disabled',false);
            $('#ch_inactivo').prop('disabled', false);
            idProveedor = $(this).attr('alt');
            $('#dialog_proveedores').modal('hide');
            muestraRegistroProveedor();


        });
        function muestraRegistroProveedor(){ 
          
          $.ajax({
              type: 'POST',
              url: 'php/proveedores_buscar_id.php',
              dataType:"json", 
              data:{
                  'idProveedor':idProveedor
              },
              success: function(data) {
                 
                  idProveedor=data[0].id;
                  proveedorOriginal=data[0].rfc;
                 
                  $('#i_id_proveedor').val(idProveedor);
                  $('#i_nombre').val(data[0].nombre);
                  $('#i_rfc').val(data[0].rfc);
                  $('#i_domicilio').val(data[0].domicilio);
                  $('#i_cp').val(data[0].cp);
                  $('#i_colonia').val(data[0].colonia);
                  $('#i_num_ext').val(data[0].num_ext);
                  $('#i_num_int').val(data[0].num_int);
                  if (data[0].facturable == 0) {
                      $('#ch_facturable').prop('checked', false);
                  } else {
                      $('#ch_facturable').prop('checked', true);
                  }

                  if(data[0].id_pais != 0)
                  {
                      $('#s_pais').val(data[0].id_pais);
                      $('#s_pais').select2({placeholder: $(this).data('elemento')});
                  }else{
                      $('#s_pais').val('');
                      $('#s_pais').select2({placeholder: 'Selecciona'});
                  }
                  $('#i_id_estado').val(data[0].id_estado);
                  $('#i_estado').val(data[0].estado);
                  $('#i_id_municipio').val(data[0].id_municipio);
                  $('#i_municipio').val(data[0].municipio);
                  $('#i_id_banco').val(data[0].id_banco);
                  $('#i_banco').val(data[0].banco);
                  $('#i_cuenta').val(data[0].cuenta);
                  $('#i_clabe').val(data[0].clabe);
                  $('#i_dias_credito').val(data[0].dias_credito);
                  $('#i_telefono').val(data[0].telefono);

                  $('#i_extension').val(data[0].extension);
                  $('#i_web').val(data[0].web);
                  $('#i_contacto').val(data[0].contacto);
                  $('#i_dias_credito').val(data[0].dias_credito);
                  $('#i_condiciones').val(data[0].condiciones);
                  $('#i_grupo').val(data[0].grupo);

                  if (data[0].inactivo == 0) {
                      $('#ch_inactivo').prop('checked', false);
                  } else {
                      $('#ch_inactivo').prop('checked', true);
                  }
                 
              },
              error: function (xhr) {
                  console.log('php/proveedores_buscar_id.php-->'+JSON.stringify(xhr));
                  mandarMensaje(xhr.responseText);
              }
          });
      }

      $('#b_guardar_proveedor').click(function(){
        
         $('#b_guardar_proveedor').prop('disabled',true);

          if ($('#forma_proveedor').validationEngine('validate')){
              if($('#i_rfc').val()!='XEXX010101000'){
                  verificar();
              }else{
                  guardarProveedor();
              }
              

          }else{
             
              $('#b_guardar_proveedor').prop('disabled',false);
          }
      });


      function verificar(){

          $.ajax({
              type: 'POST',
              url: 'php/proveedores_verificar.php',
              dataType:"json", 
              data:  {'rfc':$('#i_rfc').val()},
              success: function(data) 
              {
                  if(data == 1){
                      
                      if (tipo_mov == 1 && proveedorOriginal === $('#i_rfc').val()) {
                        guardarProveedor();
                      } else {

                          mandarMensaje('El RFC : '+ $('#i_rfc').val()+' ya existe intenta con otro');
                          $('#i_rfc').val('');
                          $('#b_guardar_proveedor').prop('disabled',false);
                      }
                  } else {
                    guardarProveedor();
                  }
              },
              error: function (xhr) {
                  mandarMensaje(JSON.stringify(xhr));
                  //mandarMensaje(xhr.responseText);
              }
          });
      }

      
      /* funcion que manda a generar la insecion o actualizacion de un registro */    
      function guardarProveedor(){

       $.ajax({
              type: 'POST',
              url: 'php/proveedores_guardar.php', 
              dataType:"json", 
              data: {
                      'datos':obtenerDatosProveedor()

              },
              //una vez finalizado correctamente
              success: function(data){
                
                  if (data > 0 ) {
                      if (tipo_mov == 0){
                          
                          mandarMensaje('Se guardó el nuevo registro');
                          $('#b_nuevo_proveedor').click();
  
                      }else{
                              
                          mandarMensaje('Se actualizó el registro');
                          $('#b_nuevo_proveedor').click();
                             
                      }
                    

                  }else{
                         
                      mandarMensaje('Error en el guardado');
                      $('#b_guardar_proveedor').prop('disabled',false);
                  }

              },
                  //si ha ocurrido un error
               error: function(xhr){
                 
                  mandarMensaje("Ha ocurrido un error.");
                  $('#b_guardar_proveedor').prop('disabled',false);
              }
          });
         
      }
      /* obtine los datos y los guarda en un arreglo*/
      function obtenerDatosProveedor(){
          var paquete = [];
              paquete[0]= 1;
          var cont = 0;
          var paq = {
                  'tipo_mov' : tipo_mov,
                  'idProveedor' : idProveedor,
                  'nombre' : $('#i_nombre').val(),
                  'rfc' : $('#i_rfc').val(),
                  'domicilio' : $('#i_domicilio').val(),
                  'cp' : $('#i_cp').val(),
                  'idColonia' : $('#i_colonia').val(),
                  'numInt' : $('#i_num_int').val(),
                  'numExt' : $('#i_num_ext').val(),
                  'facturable' : $("#ch_facturable").is(':checked') ? 1 : 0,
                  'idPais' : $('#s_pais').val(),
                  'idEstado' : $('#i_id_estado').val(),
                  'idMunicipio' : $('#i_id_municipio').val(),
                  'idBanco' : $('#i_id_banco').val(),
                  'cuenta' : $('#i_cuenta').val(),
                  'clabe' : $('#i_clabe').val(),
                  'diasCredito' : $('#i_dias_credito').val(),
                  'telefono' : $('#i_telefono').val(),
                  'extension' : $('#i_extension').val(),
                  'web' : $('#i_web').val(),
                  'contacto' : $('#i_contacto').val(),
                  'condiciones' : $('#i_condiciones').val(),
                  'grupo' : $('#i_grupo').val(),
                  'inactivo' : $("#ch_inactivo").is(':checked') ? 1 : 0,
                  'idUsuario' : idUsuario,
                  'modulo' : 'R'
              }

              paquete.push(paq);
            
          return paquete;
      }   
      
      //************Busca los cp por estado y municipio */
      $('#b_buscar_cp').on('click',function(){

          $('#i_filtro_cp').val('');
          $('.renglon_cp').remove();
          muestraSelectEstados('s_estados');
          muestraSelectMunicipios('s_municipios',0);
          $('#dialog_buscar_cp').modal('show'); 

      });

      $(document).on('change','#s_estados,#s_municipios',function(){
          buscarCp();
      });

      function buscarCp(){
         
          $('#i_filtro_cp').val('');
          $('.renglon_cp').remove();

          $.ajax({

              type: 'POST',
              url: 'php/codigo_postal_buscar.php',
              dataType:"json", 
              data:{
                  'idEstado':$('#s_estados').val(),
                  'idMunicipio': $('#s_municipios').val()
              },
              success: function(data) {
              
              if(data.length != 0){

                  $('.renglon_cp').remove();
              
                  for(var i=0;data.length>i;i++){

                      ///llena la tabla con renglones de registros

                      var html='<tr class="renglon_cp" alt="'+data[i].id_colonia+'" alt2="'+data[i].colonia+'" alt3="'+data[i].codigo_postal+'" alt4="'+data[i].estado+'" alt5="'+data[i].id_estado+'"alt6="'+data[i].municipio+'"alt7="'+data[i].id_municipio+'">\
                                  <td data-label="ID">' + data[i].codigo_postal+ '</td>\
                                  <td data-label="Clave">' + data[i].estado+ '</td>\
                                  <td data-label="Descripción">' + data[i].municipio+ '</td>\
                                  <td data-label="Tallas">' + data[i].colonia+ '</td>\
                              </tr>';
                      ///agrega la tabla creada al div 
                      $('#t_cp tbody').append(html);   
                           
                  }
              }else{

                  mandarMensaje('No se encontró información');
              }

              },
              error: function (xhr) {
                  console.log('php/codigo_postal_buscar.php-->'+JSON.stringify(xhr));
                  mandarMensaje('Error en el sistema');
              }
          });
      }

      $('#t_cp').on('click', '.renglon_cp', function() {

          var  idColonia = $(this).attr('alt');
          var  colonia = $(this).attr('alt2');
          var  cp = $(this).attr('alt3');
          var  estado = $(this).attr('alt4');
          var  idEstado = $(this).attr('alt5');
          var  municipio = $(this).attr('alt6');
          var  idMunicipio = $(this).attr('alt7');

          $('#i_cp').val(cp);
          $('#i_colonia').val(colonia).attr('alt',idColonia);
          $('#i_id_estado').val(idEstado);
          $('#i_id_municipio').val(idMunicipio);
          $('#i_estado').val(estado);
          $('#i_municipio').val(municipio);
             
          $('#dialog_buscar_cp').modal('hide');

      });

       
      //************Busca los bancos activos */
      $('#b_buscar_banco').on('click',function(){
          
          $('#i_filtro_banco').val('');
          $('.renglon_banco').remove();

          $.ajax({

              type: 'POST',
              url: 'php/bancos_buscar.php',
              dataType:"json", 
              data:{
                  'estatus':1,

              },
              success: function(data) {
              
              if(data.length != 0){

                      $('.renglon_banco').remove();
              
                      for(var i=0;data.length>i;i++){

                          ///llena la tabla con renglones de registros

                          var html='<tr class="renglon_banco" alt="'+data[i].id+'" alt2="'+data[i].clave+'" alt3="'+data[i].banco+'">\
                                      <td data-label="ID">' + data[i].id+ '</td>\
                                      <td data-label="Clave">' + data[i].clave+ '</td>\
                                      <td data-label="Descripción">' + data[i].banco+ '</td>\
                                  </tr>';
                          ///agrega la tabla creada al div 
                          $('#t_banco tbody').append(html);   
                          $('#dialog_buscar_banco').modal('show');   
                      }
              }else{

                      mandarMensaje('No se encontró información');
              }

              },
              error: function (xhr) {
                  console.log('php/bancos_buscar.php-->'+JSON.stringify(xhr));
                  mandarMensaje('Error en el sistema');
              }
          });
      });

      $('#t_banco').on('click', '.renglon_banco', function() {

          var  id = $(this).attr('alt');
          var  clave = $(this).attr('alt2');
          var  banco = $(this).attr('alt3');

          $('#i_id_banco').val(id);
          $('#i_banco').val(banco);
             
          $('#dialog_buscar_banco').modal('hide');

      });

       
      
     
      

      $(document).on('click','#b_nuevo_proveedor',function(){
          limpiarProveedor();
      });
      /* Limpia el modulo comple al dar click en nuevo o guardad*/
      function limpiarProveedor(){
       
          idProveedor=0;
          proveedorOriginal='';
          tipo_mov=0;
          $('#forma_proveedor input').val('');
          $('#i_familia').attr('alt',0);
          $('#form_proveedor').validationEngine('hide');
          $('#b_guardar_proveedor').prop('disabled',false);
          $('#ch_inactivo').prop('checked',false).prop('disabled',true);
          muestraSelectPaises('s_pais');
          $('#s_pais').prop('disabled',false);
          
      }

       //---BUSCA VEHICULOS NO_ECONOMICO----------  

        $('#b_buscar_activo').click(function(){

            $("#dialog_buscar_activos").modal('show');
            $('#i_filtro_activos').val('');
            $("#i_busca_no_economico").val('');
            buscarActivosFijos();
        });

       //-- Filtros de Historial de Bitacora
        $("#i_busca_no_economico").keyup(function(e){
           buscarActivosFijos();
        });

    
        function buscarActivosFijos(){

            var noEconomico = $("#i_busca_no_economico").val();
            
            $.ajax({
                type: "POST",
                url: "php/activos_buscar_filtro_E01.php",
                data: {'noEconomico':noEconomico,'tipo':1},
                dataType: 'json',
                success: function(data){
                    if(data.length>0){
               
                        salida = "";
                        tipo = "";
                        for (var i = 0; i < data.length; i++) {
                            actual=data[i];
                            
                            if (actual.tipo==1) {tipo="Vehiculo";}
                            else if (actual.tipo=="2") {tipo="Celular";}
                            else if (actual.tipo==3) {tipo="Equipo de Computo";}
                            else {tipo="Otro";}
                        //-->NJES March/11/2020 se obtiene el responsable del activo fijo
                            salida += "<tr class='activo_renglon' alt="+actual.no_economico+" responsable='"+actual.responsable+"' activo='"+actual.id+"'>";
                            salida += "<td>" + actual.no_serie + "</td>";
                            salida += "<td>" + actual.no_economico + "</td>";
                            salida += "<td>" + actual.descripcion + "</td>";
                            salida += "<td>" + tipo + "</td>";
                            salida += "</tr>";
                        }
                        $("#t_buscar_activo").empty();
                        $("#t_buscar_activo").html(salida);
                    }else{
                        mandarMensaje('No se encontraron vehiculos');
                    }
                },
                error: function (data){
                    console.log( "php/activos_buscar_filtro_E01.php -->"+JSON.stringify(data));
                    mandarMensaje("* Error con la Busqueda.");
                }
            });
        }

        $('#t_buscar_activo').on('click', '.activo_renglon', function() {
            var noEconomico = $(this).attr('alt');
            var responsable = $(this).attr('responsable');
            var idActivo = $(this).attr('activo');
            //-->NJES March/11/2020 se obtiene el responsable del activo fijo
            $('#i_no_economico').val(noEconomico).attr('activo',idActivo);
            //$('[data-toggle="popover"]').popover();
            /*if(responsable != '')
                $('#i_responsable').val(responsable).prop('disabled',true);
            else*/
                $('#i_responsable').val(responsable).prop('disabled',false);

            $('#dialog_buscar_activos').modal('hide');
        });

        //-->NJES Feb/13/2020 funcionalidad anticipo
        $('#ch_anticipo').change(function(){
            if($("#ch_anticipo").is(':checked'))
            {    
                $('#dialog_anticipo').modal('show');
                $('#i_anticipo').addClass('validate[required,custom[number],min[1]]');
            }else
            {
                $('#i_anticipo').val('').removeClass('validate[required,custom[number],min[1]]');
                $('#dato_info_anticipo').text('');
            }  
        });

        //-->NJES November/11/2020 buscar producto de flete y logistica
        $('#b_buscar_flete').click(function(){
            if($('#t_partidas .partida-requisicion').length > 0)
            {
                if(existeFletesLogistica() > 0)
                {
                    mandarMensaje('Solo puedes ingresar una producto de fletes y logistica');
                }else{
                    $.ajax({
                        type: 'POST',
                            url: 'php/productos_flete_buscar.php',
                        dataType:"json", 
                        success: function(data)
                        { 
                            console.log(data);
                            if(data.length != 0)
                            {
                                var producto = data[0];
                                                        
                                $('#i_id_producto').val(producto.id).attr({'id_familia_gasto':producto.id_familia_gasto,'familia_gasto':producto.familia_gasto});
                                $('#i_id_linea').val(producto.id_linea);
                                $('#i_linea').val(producto.linea);  
                                $('#i_id_familia').val(producto.id_familia);
                                $('#i_familia').val(producto.familia);
                                $('#i_concepto').val(producto.concepto);
                                $('#i_precio').val(formatearNumero(producto.costo));
                                $('#i_tipo_producto').val(redondear(producto.tipo));
                                $('#i_descripcion').val(producto.descripcion);
                                $('#i_id_familia_gasto').val(producto.id_familia_gasto);

                            }else
                                mandarMensaje('No se encontó información al buscar producto flete');
                            
                        },
                        error: function (xhr)
                        {
                            console.log('php/productos_flete_buscar.php-->'+JSON.stringify(xhr));
                            mandarMensaje('* No se encontró información al buscar producto flete');
                        }
                    });
                }
            }else{
                mandarMensaje('Es necesario tener minimo una partida de un producto para poder ingresar fletes y logistica');
            }
        }); 

        //-->NJES November/11/2020 verifica si existen partidas de fletes y logistica
        function existeFletesLogistica(){
            var cont = 0;

            $("#t_partidas .partida-requisicion").each(function(){
                if($(this).attr('id_familia_gasto') == 104)
                    cont++;
            });

            return cont;
        }   

        $(document).on('keypress','#i_cantidad',function (event){
            if($('#i_id_familia_gasto').val() == 104)
                return valideKeySoloNumerosInt(event);
        });   
        
    });

</script>

</html>