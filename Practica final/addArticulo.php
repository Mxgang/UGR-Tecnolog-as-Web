<?php

require_once "db.php";
require_once "pag_comun.php";


$datos=false;

$accion='';
if (isset($_POST['accion']) && $_POST['accion']=='Añadir Articulo') {
	$datos['name'] = $_POST["art_name"];
	$datos['DOI'] = 		isset($_POST['art_DOI']) 	? $_POST['art_DOI'] : '';
	$datos['autores'] = 		isset($_POST['art_autores']) 	? $_POST['art_autores'] : '';
	$datos['fechaPub'] = 		isset($_POST['art_fechaPub'])	? $_POST['art_fechaPub'] : '';
	$datos['resumen'] = 		isset($_POST['art_resumen'])	? $_POST['art_resumen'] : '';
	$datos['nombreRevista'] = 		isset($_POST['art_nombreRevista']) ? $_POST['art_nombreRevista'] : '';
	$datos['volumen'] = 		isset($_POST['art_volumen'])	? $_POST['art_volumen'] : '';
	$datos['paginas'] = 		isset($_POST['art_paginas'])	? $_POST['art_paginas'] : '';
	$datos['palabrasClave'] = 		isset($_POST['art_palabrasClave']) ? $_POST['art_palabrasClave'] : '';
	$datos['URL'] = 		isset($_POST['art_URL'])	? $_POST['art_URL'] : '';
	if ($datos['DOI']=='' || $datos['autores']=='' || $datos['fechaPub']=='' || $datos['resumen'] =='' || $datos['nombreRevista'] =='' || $datos['volumen'] =='' || $datos['paginas'] =='' || $datos['palabrasClave'] =='' || $datos['URL'] =='')
		$info[]='No puede dejar campos vacíos';
	if (!isset($info))
		$accion='Añadir Articulo';
}

if ($accion=='Añadir Articulo') {
	$resultado = "OK";
	$db=DB_conexion();
	if ($db) {
		$res = DB_addArticulo($db,$datos);

		if ($res===true)
			$info[] = 'Se ha añadido el articulo con éxito<br>';
		else{
			$info[] = $res;
			$resultado = "ERROR";
		}

		$usuario = $datos['name'];

		DB_addLog($db, $accion, $usuario, $resultado);
		DB_desconexion($db);
	}
} 
/*else
	FORM_editCiudad('Indique los datos:',$datos,'Añadir Usuario');*/
if (isset($info) && msgCount($info)>0)
	msgError($info);



?>
