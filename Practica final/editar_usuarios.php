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

HTMLcol_der_editar_usuarios();
HTMLfooter();
?>
