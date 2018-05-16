<?php

require_once "db.php";
require_once "pag_comun.php";


$datos=false;

$accion='';
if (isset($_POST['accion']) && $_POST['accion']=='Añadir Libro') {
	$datos['name'] = $_POST["lib_name"];
	$datos['DOI'] = 		isset($_POST['lib_DOI']) 	? $_POST['lib_DOI'] : '';
	$datos['tituloTrabajo'] = 	isset($_POST['lib_tituloTrabajo']) 	? $_POST['lib_tituloTrabajo'] : '';
	$datos['autores'] = 		isset($_POST['lib_autores']) 	? $_POST['lib_autores'] : '';
	$datos['fechaPub'] = 		isset($_POST['lib_fechaPub'])	? $_POST['lib_fechaPub'] : '';
	$datos['resumen'] = 		isset($_POST['lib_resumen'])	? $_POST['lib_resumen'] : '';
	$datos['editorial'] = 		isset($_POST['lib_editorial']) ? $_POST['lib_editorial'] : '';
	$datos['editor'] = 		isset($_POST['lib_editor'])	? $_POST['lib_editor'] : '';
	$datos['ISBN'] = 		isset($_POST['lib_ISBN'])	? $_POST['lib_ISBN'] : '';
	$datos['palabrasClave'] = 		isset($_POST['lib_palabrasClave']) ? $_POST['lib_palabrasClave'] : '';
	$datos['URL'] = 		isset($_POST['lib_URL'])	? $_POST['lib_URL'] : '';
	if ($datos['DOI']=='' || $datos['tituloTrabajo']=='' || $datos['autores']=='' || $datos['fechaPub']=='' || $datos['resumen'] =='' || $datos['editorial'] =='' || $datos['editor'] =='' || $datos['ISBN'] =='' || $datos['palabrasClave'] =='' || $datos['URL'] =='')
		$info[]='No puede dejar campos vacíos';
	if (!isset($info))
		$accion='Añadir Libro';
}

if ($accion=='Añadir Libro') {
	$resultado = "OK";
	$db=DB_conexion();
	if ($db) {
		$res = DB_addLibro($db,$datos);

		if ($res===true)
			$info[] = 'Se ha añadido el libro con éxito<br>';
		else{
			$info[] = $res;
			$resultado = "ERROR";
		}

		$usuario = $datos['name'];

		DB_addLog($db, $accion, $usuario, $resultado);
		DB_desconexion($db);
	}
} 

if (isset($info) && msgCount($info)>0)
	msgError($info);



?>
