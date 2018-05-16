<?php
require "pag_comun.php";
require "db.php";
require "addLibro.php";


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
		}
		else{
			HTML_col_izq_usuarios();
		}


	//	vvvv COMENTADO PERO ES IMPORTANTE GUARDAR EL NOMBRE BIEN PARA EL LOG vvvv
		$datos['name']=$_SESSION["usuario"];
	//	echo "1: '{$datos["name"]}'";

		FORM_addLibro('Añadir libro',$datos,'añadir');
	} 
	else{
		// Si la sesión NO está establecida
		HTMLlogin();
		HTMLerror();
	}
	
//DB_addPublicacion();


HTMLfooter();
?>
