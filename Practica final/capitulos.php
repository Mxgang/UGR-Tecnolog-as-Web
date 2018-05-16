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
		$capitulos = DB_ordenar($db,"capLibros", "autores");
		HTMLcol_der_publicaciones_capitulos($capitulos);
		break;
	case 'fecha';
		$capitulos = DB_ordenar($db,"capLibros", "fechaPublicacion");
		HTMLcol_der_publicaciones_capitulos($capitulos);
		break;
	case 'clave':
		$capitulos = DB_ordenar($db,"capLibros", "palabrasClave");
		HTMLcol_der_publicaciones_capitulos($capitulos);
		break;
	default:
		$capitulos = DB_getCapitulos($db);
		HTMLcol_der_publicaciones_capitulos($capitulos);
}
HTMLfooter();
DB_desconexion();
?>
