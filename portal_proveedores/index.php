<?php
session_start();
include("../php/conectar.php");
$link=Conectarse();
	
header("Cache-control: private");
header("Cache-control: no-cache, must-revalidate");
header("Pragma: no-cache");
$aux = 0;
$home = "fr_login.php";

if (isset($_SESSION['usuarioP']) && $_SESSION['usuarioP']!='') {

	$usuario = $_SESSION['usuarioP'];
	
	if (isset($_SESSION['idProveedor'])){
		$idProveedor=$_SESSION['idProveedor'];
	}
	if($_SESSION['modulo']==0){
		$home = "home.php";
		$aux = 1;
	}
	//echo "tipoUsuario:".$_SESSION['tipoUsuario'];
   
} else {
	$home = "fr_login.php";
	$aux = 0;
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>PORTAL PROVEEDORES</title>
	
	<!-- Viewport -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-status-bar-style" content="black" > 
	<meta name="apple-mobile-web-app-capable" content="yes" >

	<link rel="stylesheet" href="../css/css/bootstrap.css" type="text/css" media="all">
	<link href="../vendor/font_awesome/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet">

	</head>

	<style type="text/css">
		*{
			-webkit-tap-highlight-color: rgba(0,0,0,0);
			border-radius: 0px;
		}
		html{
			height:100%;
		}
		body{
			font-weight: 300;
			height:100%;
			margin:0;
			background-color:#22262e;
			-webkit-overflow-scrolling: touch;
		}
		/*#dialog_unidades >  .modal-lg{
			min-width: 1000px;
			max-width: 1000px;
		}*/
		.div_unidades{
			text-align:center;
		}

		.unidad{
			padding:10px;
			background-color:rgba(250,250,250,.9);
			box-shadow: 0 0 1em gray;
		}

		.unidad:hover{
			cursor:pointer;
			box-shadow: inset 0 0 .5em gray;
		}
		.collapsing {
			-webkit-transition: height 0.03s;
			-moz-transition: height 0.03s;
			-ms-transition: height 0.03s;
			-o-transition: height 0.03s;
			transition: height 0.03s;

		}
		input{
			box-shadow: none;
		}
		#sistema_mascara{
			width:100%;
			height:100%;
			position:absolute;
		}
		#sistema_header{
			height:50px;
		}
		#sistema_content{
			height:calc(100% - 50px);
			overflow:hidden;
		}
		#sistema_menu_bar{
			width:250px;
			height:100%;
		}
		#sistema_contenido{
			position:absolute;
			background:rgb(238,238,238);
			transition:all ease-in-out 0.2s;
			overflow:auto;
			
			-webkit-overflow-scrolling: touch;
			z-index:100;
			<?php
				if($aux == 1)
				{
			?>
			width:calc(100% - 250px);
			height:calc(100% - 50px);
			right:0px;
			top:50px;
			padding-top:20px;
			<?php
				}else{
			?>
				width:100%;
				height:100%;
			<?php
				}
			?>
			
		}
		#sistema_header_left{
			float:left;
			width:250px;
			line-height:50px;
		}
		#sistema_header_right{
			float:left;
			width:calc(100% - 250px);
		}
		#sistema_logo{
			width:60px;  /*Se cambio el tamaño del logo porque tapaba el menu*/
			margin-left:70px;
			vertical-align:middle;
		}
		#sistema_menu_button{
			color:#ffffff;
			float:right;
			width:50px;
			height:50px;
			line-height:50px;
			-webkit-font-smoothing: antialiased;
			text-align:center;
			cursor:pointer;
			-webkit-user-select: none;
			-khtml-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			font-size: 16px;
			padding-top:10px;
		}
		#sistema_menu_button:hover{
			background-color:#2d323d;
		}
		.sistema_button_icon{
			font-size:14px;
			height:20px;
			line-height:20px;
		}
		.iconos_menu{
			font-size:20px;
			height:20px;
			line-height:20px;
			padding:10px;
		}
		.sistema_button_title{
			font-size:12px;
			height:20px;
			line-height:24px;
		}
		.sistema_top_menu{
			float:right;
			width:50px;
			height:40px;
			padding: 5px 10px 5px 10px;
			text-align:center;
			color:#9aa3b5;
			cursor:pointer;
			border-left:1px solid #414b5d;
			-webkit-user-select: none;
			-khtml-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			box-sizing: initial;
		}
		.sistema_top_menu:hover{
			color:#FFFFFF;
			background-color:#2d323d;
		}
		#sistema_submenu{
			height:43px;
			text-align:center;
			color:#FFFFFF;
			font-size:18px;
			-webkit-user-select: none;
			-khtml-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}
		#sistema_submenu > div{
			float:left;
			cursor:pointer;
			transition:all ease-in-out 0.2s;
			border-bottom:1px solid #22262e;
			height:42px;
			line-height:42px;
		}
		#sistema_submenu > div:hover{
			border-bottom:1px solid #16a085;
			color:#16a085;
		}
		#sistema_menu{
			width:100%;
		}
		#sistema_navegacion{
			height:calc(100% - 60px);
			overflow:hidden;
		}
		#sistema_subnavegacion{
			width:300%;
			height:100%;
			transition:all ease-in-out 0.28s;
		}
		#sistema_nav_menu{
			float:left;
			width:250px;
			overflow:auto;
			height: 100%;
		}
		.sistema_nav_title{
			background-color: #2d323d;
			color: #4d5669;
			font-size: 16px;
			height:30px;
			line-height:30px;
			padding-left:15px;
		}

		.main_menu{
			background:#16a085;
			color:#FFF;
			height:36px;
			line-height:34px;
			font-size:14px;
			text-align:center;
			border-bottom:1px solid #1f253d;
			cursor:default;
			-webkit-touch-callout: none;
			-webkit-user-select: none;
			-khtml-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			}
		.main_submenu{
			color:#9198b4;
			height:42px;
			line-height:34px;
			font-size:15px;
			border-bottom:1px solid #2d323d;
			padding-right:15px;
			text-overflow:ellipsis;
			white-space: nowrap;
			overflow: hidden;
			transition:all ease-in-out 0.2s;
			padding-left:15px;
			background-repeat: no-repeat;
			background-position: 5px 50%;
			background-size: 24px 24px;
			cursor:pointer;
			text-transform:capitalize;
			
			-webkit-touch-callout: none;
			-webkit-user-select: none;
			-khtml-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}
		.main_submenu:hover{
			background-color:#2d323d;
			color:#ffffff;
		}
		.collapse{
			padding-left:35px;
		}
		/* Responsive Web Design */
		@media only screen and (max-width:768px){
			#sistema_logo {
				margin-left: 0px;
				width: 50px; /*Se cambio el tamaño del logo porque tapaba el menu*/
			}
			#sistema_contenido{
				width:100%;
				<?php if($aux == 0){ ?>
					transform:translate3d(0px,0px,0px);
				<?php }else{ ?>
					transform:translate3d(250px,0px,0px);
				<?php } ?>
			}
			#sistema_header_right{
				display:none;
			}
			#sistema_header_left{
				width:100%;
				text-align:center;
			}

			.div_unidades{
				margin-bottom:20px;
			}
		}
		/*MGFS 11-05-2018 se agrego para se viera bien en el celular Responsive Web Design */
		/*@media only screen and (max-width:640px){*/
		@media only screen and (max-width:670px){
			#sistema_contenido{
				width:100%;
				<?php if($aux == 0){ ?>
				transform:translate3d(0px,0px,0px);
				<?php }else{ ?>
				transform:translate3d(250px,0px,0px);
				<?php } ?>
			}
			#sistema_header_right{
				display:none;
			}
			#sistema_header_left{
				width:100%;
				text-align:left;
			}
			#sistema_logo{
				margin-left:70px;
				width:60px; /*Se cambio el tamaño del logo porque tapaba el menu*/
			}
		}
		/* Animacion Girar Loading */
		@-webkit-keyframes gira {
			0% {-webkit-transform: rotate(0deg);}
			100% {-webkit-transform: rotate(360deg);}
		}
		@-moz-keyframes gira {
			0% {-moz-transform: rotate(0deg);}
			100% {-moz-transform: rotate(360deg);}
		}

		/* SCROLLBAR */
		#sistema_navegacion div::-webkit-scrollbar {
			width: 6px;
		}
		
		#sistema_navegacion div::-webkit-scrollbar-track {
			background-color: #22262e;
		}
		
		#sistema_navegacion div::-webkit-scrollbar-thumb {
			background-color: rgba(255,255,255,0.8);
			border-right:3px solid #22262e;
		}
	</style>

<body>
		<!-- Mascara para contenido principal -->
		<div id="sistema_mascara">
			<!-- Header -->
			<?php
			
				if($aux == 1)
				{
			?>
			<div id="sistema_header">
				<div id="sistema_header_left">
					<img src="" id="sistema_logo">
					<div id="sistema_menu_button" data-pos="0" ><i class="fa fa-bars" aria-hidden="true" style="font-size:30px;"></i></div>
				</div>
				<div id="sistema_header_right">
				    
					<a id="sistema_logout" class="sistema_top_menu" href="php/logout.php">
						<div class="sistema_button_icon"><i class="fa fa-power-off" aria-hidden="true"></i></div>
						<div class="sistema_button_title">SALIR</div>
					</a>
				</div>
			</div>
			<?php
				}
			?>
			<!-- Content -->
			<div id="sistema_content">
				<iframe src="<?php echo $home ?>" id="sistema_contenido" frameBorder="0" allowtransparency="allowtransparency"></iframe>
				<?php
					if($aux == 1)
					{
				?>
				<div id="sistema_menu_bar">
					<div id="sistema_submenu">
						<div id="sistema_menu" class="sistema_sub_select" style="border-bottom:1px solid #9198b4;color:#9198b4;"><i class="fa fa-user-circle-o" aria-hidden="true"></i> <?php echo $_SESSION['usuarioP'] ?></div>
					</div>
					<div id="sistema_navegacion">
						<div id="sistema_subnavegacion">
							<div id="sistema_nav_menu">
							</div>
						</div>
					</div>
				</div>   
				<?php
					}
				?>  
			</div>
		</div>
	</body>

	<div id="dialog_unidades" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="div_unidades">
					
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
			</div>
			</div>
		</div>
	</div>

<script src="../js/jquery3.3.1/jquery-3.3.1.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/js/bootstrap.js"></script>
<script src="js/general.js"></script>

	<script>
		
		var checkSession;
		var idUnidadActual=0;
		$(function(){
			checkSession = setInterval(checkForSession, 90000); //GCM se cambia sesion a menos tiempo
			// checkSession = setInterval(checkForSession, 900000); //-->cada 15 minutos verifica session
			//checkSession = setInterval(checkForSession, 60000);  
			
			if(idUnidadActual != 0)
			{
				//var logo=buscarLogoUnidad(matriz,idUnidadActual);
				$('#sistema_logo').attr('src','../imagenes/logo.png');
			}else{
				$('#sistema_logo').attr('src','../imagenes/logo.png');
			}

			
			/////////////////////

			var des=$("#sistema_contenido");
			$(document).on({
				click:function(){
					//---limpia el menu  y lo vuelve a cargar por si cambarion sus permisos-----
					$("#sistema_nav_menu").empty();
					cargaMenu();
					//---- fin cambio-----	
					var este='';
					 este=$(this);
					if(este.data("pos")==0){
						este.html("<i class='fa fa-bars' aria-hidden='true' style='font-size:30px;'></i>");
						este.data("pos",1);
						des.removeAttr("style");
						des.css({"width":"100%","transform":"none"});
						
					}else{
						este.html("<i class='fa fa-bars' aria-hidden='true' style='font-size:30px;'></i>");
						este.data("pos",0);
						des.removeAttr("style");
						
					}

				}
			},"#sistema_menu_button");

			$(window).resize(function() {
				des.css({"transition":"none"});
			});

			$(document).on({
				click:function(){
					
					$('#sistema_menu_button').trigger('click');
					
					$(".menu_clic").removeAttr("style");

					$(this).css({'background-color':'#2d323d','color':'#ffffff'});
					
					var path=$(this).attr('id');
					$('#sistema_contenido').attr('src', path);
					
				}
			},".menu_clic");

			<?php
				if($aux == 1)
				{
			?>
			//----- se metio a una funcion el cargar menu ----------
			cargaMenu();
			function cargaMenu(){
				
				$("#sistema_nav_menu").empty();

				<?php if($_SESSION['tipoUsuario']==1){?>
					
					$("#sistema_nav_menu").append('<div class="menu_clic main_submenu" id="fr_buscar_proveedor.php" alt="CAMBIAR_PROVEEDOR"><i class="iconos_menu fa fa-key" aria-hidden="true"></i>CAMBIAR_PROVEEDOR</div>');
			
				<?php }?>
				//----- PADRES SIN HIJOS------
				$("#sistema_nav_menu").append('<div class="menu_clic main_submenu" id="fr_proveedores.php" alt="EDITAR_PERFIL"><i class="iconos_menu fa fa-pencil" aria-hidden="true"></i>EDITAR_PERFIL</div>');
				$("#sistema_nav_menu").append('<div class="menu_clic main_submenu" id="fr_cargar_datos.php" alt="MOSTRAR_DATOS"><i class="iconos_menu fa fa-cloud-upload" aria-hidden="true"></i>CARGAR_DATOS</div>');
				$("#sistema_nav_menu").append('<div class="menu_clic main_submenu" id="fr_consultar.php" alt="EDITAR_PERFIL"><i class="iconos_menu fa fa-bar-chart" aria-hidden="true"></i>CONSULTAR</div>');	
				//-----FIN  PADRES SIN HIJOS------
					
				$("#sistema_nav_menu").append('<div class="menu_clic main_submenu" id="php/logout.php"><i class="iconos_menu fa fa-power-off" aria-hidden="true"></i> SALIR</div>');
				//cargarPrimerOpcion();   //descomentar esto 27/03/2018
			
		    }
			<?php
				}
			?>
			
			function cargarPrimerOpcion(){
				var primera=$(".menu_clic:eq(0)").attr("id");
				$('#sistema_contenido').attr('src', primera);		
			}


			///////////////////

		});

		</script>
</html>