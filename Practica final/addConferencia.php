<?php

require_once "db.php";
require_once "pag_comun.php";


$datos=false;

$accion='';
if (isset($_POST['accion']) && $_POST['accion']=='Añadir Conferencia') {
	$datos['name'] = $_POST["con_name"];
	$datos['DOI'] = 		isset($_POST['con_DOI']) 	? $_POST['con_DOI'] : '';
	$datos['tituloTrabajo'] = 	isset($_POST['con_tituloTrabajo']) 	? $_POST['con_tituloTrabajo'] : '';
	$datos['autores'] = 		isset($_POST['con_autores']) 	? $_POST['con_autores'] : '';
	$datos['fechaPub'] = 		isset($_POST['con_fechaPub'])	? $_POST['con_fechaPub'] : '';
	$datos['resumen'] = 		isset($_POST['con_resumen'])	? $_POST['con_resumen'] : '';
	$datos['nombreConf'] = 		isset($_POST['con_nombreConf']) ? $_POST['con_nombreConf'] : '';
	$datos['lugar'] = 		isset($_POST['con_lugar'])	? $_POST['con_lugar'] : '';
	$datos['reseniaPub'] = 		isset($_POST['con_reseniaPub'])	? $_POST['con_reseniaPub'] : '';
	$datos['palabrasClave'] = 		isset($_POST['con_palabrasClave']) ? $_POST['con_palabrasClave'] : '';
	$datos['URL'] = 		isset($_POST['con_URL'])	? $_POST['con_URL'] : '';
	if ($datos['DOI']=='' || $datos['tituloTrabajo']=='' || $datos['autores']=='' || $datos['fechaPub']=='' || $datos['resumen'] =='' || $datos['nombreConf'] =='' || $datos['lugar'] =='' || $datos['reseniaPub'] =='' || $datos['palabrasClave'] =='' || $datos['URL'] =='')
		$info[]='No puede dejar campos vacíos';
	if (!isset($info))
		$accion='Añadir Conferencia';
}

if ($accion=='Añadir Conferencia') {
	$resultado = "OK";
	$db=DB_conexion();
	if ($db) {
		$res = DB_addConferencia($db,$datos);

		if ($res===true)
			$info[] = 'Se ha añadido la conferencia con éxito<br>';
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
