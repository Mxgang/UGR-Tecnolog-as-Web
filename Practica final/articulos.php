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
		$articulos = DB_ordenar($db,"articulos", "autores");
		HTMLcol_der_publicaciones_articulos($articulos);
		break;
	case 'fecha';
		$articulos = DB_ordenar($db,"articulos", "fechaPublicacion");
		HTMLcol_der_publicaciones_articulos($articulos);
		break;
	case 'clave':
		$articulos = DB_ordenar($db,"articulos", "palabrasClave");
		HTMLcol_der_publicaciones_articulos($articulos);
		break;
	default:
		$articulos = DB_getArticulos($db);
		HTMLcol_der_publicaciones_articulos($articulos);
}

HTMLfooter();
DB_desconexion();
?>