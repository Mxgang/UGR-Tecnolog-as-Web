<?php

require_once "db.php";
require_once "pag_comun.php";


$datos=false;

$accion='';
if (isset($_POST['accion']) && $_POST['accion']=='Añadir Capitulo') {
	$datos['name'] = $_POST["cap_name"];
	$datos['DOI'] = 			isset($_POST['cap_DOI']) 		? $_POST['cap_DOI'] : '';
	$datos['tituloTrabajo'] = 	isset($_POST['cap_tituloTrabajo'])? $_POST['cap_tituloTrabajo'] : '';
	$datos['autores'] = 		isset($_POST['cap_autores']) 	? $_POST['cap_autores'] : '';
	$datos['fechaPub'] = 		isset($_POST['cap_fechaPub'])	? $_POST['cap_fechaPub'] : '';
	$datos['resumen'] = 		isset($_POST['cap_resumen'])	? $_POST['cap_resumen'] : '';
	$datos['tituloLibro'] = 	isset($_POST['cap_tituloLibro'])? $_POST['cap_tituloLibro'] : '';
	$datos['editorial'] = 		isset($_POST['cap_editorial']) 	? $_POST['cap_editorial'] : '';
	$datos['editor'] = 			isset($_POST['cap_editor'])		? $_POST['cap_editor'] : '';
	$datos['ISBN'] = 			isset($_POST['cap_ISBN'])		? $_POST['cap_ISBN'] : '';
	$datos['paginaCapitulo'] =isset($_POST['cap_paginaCapitulo'])? $_POST['cap_paginaCapitulo'] : '';
	$datos['palabrasClave'] = 	isset($_POST['cap_palabrasClave'])? $_POST['cap_palabrasClave'] : '';
	$datos['URL'] = 			isset($_POST['cap_URL'])		? $_POST['cap_URL'] : '';

	if ($datos['DOI']=='' || $datos['tituloTrabajo']=='' || $datos['autores']=='' || $datos['fechaPub']=='' || $datos['resumen'] =='' || $datos['tituloLibro'] =='' || $datos['editorial'] =='' || 
		$datos['editor'] =='' || $datos['ISBN'] =='' || $datos['paginaCapitulo'] =='' || 
		$datos['palabrasClave'] =='' || $datos['URL'] =='')
		$info[]='No puede dejar campos vacíos';
	if (!isset($info))
		$accion='Añadir Capitulo';
}

if ($accion=='Añadir Capitulo') {
	$resultado = "OK";
	$db=DB_conexion();
	if ($db) {
		$res = DB_addCapitulo($db,$datos);
		
		if ($res===true)
			$info[] = 'Se ha añadido el capítulo con éxito<br>';
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
