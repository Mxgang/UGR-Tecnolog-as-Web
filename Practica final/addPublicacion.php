<?php

require_once "db.php";
require_once "pag_comun.php";
session_start();
$datos=false;
$accion='';


if (isset($_POST['accion']) && $_POST['accion']=='Añadir Publicacion') {
	$datos['name'] = isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : '';

	if (!isset($_SESSION["usuario"]))
		$info[]='No existe usuario';
	if (!isset($info))
		$accion='Añadir Publicacion';
}

if ($accion=='Añadir Publicacion') {
	$db=DB_conexion();
	if ($db) {
		$res = DB_addPublicacion($db,$datos);
		DB_desconexion($db);
		if ($res===true)
			$info[] = 'Se ha añadido la publicación con éxito<br>	<a href="index.php"><h1>Volver.</h1></a>';
		else
			$info[] = $res;
	}
} 
/*else
	FORM_editCiudad('Indique los datos:',$datos,'Añadir Usuario');*/
if (isset($info) && msgCount($info)>0)
	msgError($info);



?>
