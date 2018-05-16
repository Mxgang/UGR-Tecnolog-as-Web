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
		$libros = DB_ordenar($db,"libros", "autores");
		HTMLcol_der_publicaciones_libros($libros);
		break;
	case 'fecha';
		$libros = DB_ordenar($db,"libros", "fechaPublicacion");
		HTMLcol_der_publicaciones_libros($libros);
		break;
	case 'clave':
		$libros = DB_ordenar($db,"libros", "palabrasClave");
		HTMLcol_der_publicaciones_libros($libros);
		break;
	default:
		$libros = DB_getLibros($db);
		HTMLcol_der_publicaciones_libros($libros);
}

HTMLfooter();
DB_desconexion();
?>