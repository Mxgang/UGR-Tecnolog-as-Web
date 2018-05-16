<?php

require_once "db.php";
require_once "pag_comun.php";


$datos=false;

$accion='';
if (isset($_POST['accion']) && $_POST['accion']=='Añadir Proyecto') {
	$datos['name'] = $_POST["pro_name"];
	$datos['codigo'] = 		isset($_POST['pro_codigo']) 	? $_POST['pro_codigo'] : '';
	$datos['titulo'] = 	isset($_POST['pro_titulo']) 	? $_POST['pro_titulo'] : '';
	$datos['descripcion'] = 		isset($_POST['pro_descripcion']) 	? $_POST['pro_descripcion'] : '';
	$datos['fechaComienzo'] = 		isset($_POST['pro_fechaComienzo'])	? $_POST['pro_fechaComienzo'] : '';
	$datos['fechaFinalizacion'] = 		isset($_POST['pro_fechaFinalizacion'])	? $_POST['pro_fechaFinalizacion'] : '';
	
	$datos['entidadesColaboradoras'] = 		isset($_POST['pro_entidadesColaboradoras']) ? $_POST['pro_entidadesColaboradoras'] : '';
	
	$datos['cuantia'] = 		isset($_POST['pro_cuantia'])	? $_POST['pro_cuantia'] : '';
	$datos['investigadorPrincipal'] = 		isset($_POST['pro_investigadorPrincipal'])	? $_POST['pro_investigadorPrincipal'] : '';
	
	$datos['investigadoresColaboradores'] = 		isset($_POST['pro_investigadoresColaboradores']) ? $_POST['pro_investigadoresColaboradores'] : '';
	
	$datos['URL'] = 		isset($_POST['pro_URL'])	? $_POST['pro_URL'] : '';

	if ($datos['codigo']=='' || $datos['titulo']=='' || $datos['descripcion']=='' || $datos['fechaComienzo']=='' || $datos['fechaFinalizacion'] =='' || $datos['entidadesColaboradoras'] =='' || $datos['cuantia'] =='' || $datos['investigadorPrincipal'] =='' || $datos['investigadoresColaboradores'] =='' || $datos['URL'] =='')
		$info[]='No puede dejar campos vacíos';
	if (!isset($info))
		$accion='Añadir Proyecto';
}

if ($accion=='Añadir Proyecto') {
	$resultado = "OK";
	$db=DB_conexion();
	if ($db) {
		$res = DB_addProyecto($db,$datos);

		if ($res===true)
			$info[] = 'Se ha añadido el proyecto con éxito<br>';
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
