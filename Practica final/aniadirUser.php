<?php
require "pag_comun.php";
require "formulario.php";
require "db.php";
require "addUsuario.php";


$db = DB_conexion();

//Establecer la codificación de los datos almacenados ("collation")
mysqli_set_charset($db,"utf8");
session_start();

HTMLpag_inicio();
	
HTMLcol_izq();

	if (isset($_SESSION["usuario"])) { //conectarse como usuario
		// Si la sesión está establecida
		HTMLbienvenido($_SESSION["usuario"]);
		if($_SESSION["usuario"] == "Administrador"){
			HTML_col_izq_admin();
			HTML_col_izq_usuarios();

			$datos['usuario']=$_SESSION["usuario"];

			FORM_addUsuario('Añadir usuario',$datos,'añadir');
		}
		else{
			HTML_col_izq_usuarios();
			HTMLerror();
		}
	} 
	else{
		// Si la sesión NO está establecida
		HTMLlogin();
		HTMLerror();
	}
	



HTMLfooter();
?>
