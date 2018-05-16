<?php
require "pag_comun.php";
require "db.php";
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
		else
			HTML_col_izq_usuarios();
	} 
	else{
		// Si la sesión NO está establecida
		HTMLlogin();
	}
	
$db = DB_conexion();

HTMLbuscar();

switch($_POST["option"]){
	case 'autor':
		$conferencias = DB_ordenar($db,"conferencias", "autores");
		HTMLcol_der_publicaciones_conferencias($conferencias);
		break;
	case 'fecha';
		$conferencias = DB_ordenar($db,"conferencias", "fechaPublicacion");
		HTMLcol_der_publicaciones_conferencias($conferencias);
		break;
	case 'clave':
		$conferencias = DB_ordenar($db,"conferencias", "palabrasClave");
		HTMLcol_der_publicaciones_conferencias($conferencias);
		break;
	default:
		$conferencias = DB_getConferencias($db);
		HTMLcol_der_publicaciones_conferencias($conferencias);
}

HTMLfooter();
DB_desconexion();
?>
