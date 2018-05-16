<?php

require_once "db.php";
require_once "pag_comun.php";

$datos=false;
$accion='';
if (isset($_POST['accion']) && $_POST['accion']=='Añadir Usuario') {
	$datos['name'] = isset($_POST['usu_nombre']) ? $_POST['usu_nombre'] : '';
	$datos['especialidad'] = isset($_POST['usu_especialidad']) ? $_POST['usu_especialidad'] : '';
	$datos['direccion'] = isset($_POST['usu_direccion']) ? $_POST['usu_direccion'] : '';
	$datos['hobbies'] = isset($_POST['usu_hobbies']) ? $_POST['usu_hobbies'] : '';
	$datos['password'] = isset($_POST['usu_password']) ? $_POST['usu_password'] : '';
	if ($datos['name']=='' || $datos['especialidad']=='' || $datos['direccion']=='' || $datos['password'] =='')
		$info[]='No puede dejar campos vacíos';
	if (!isset($info))
		$accion='Añadir Usuario';
}

if ($accion=='Añadir Usuario') {
	$resultado = "OK";
	$db=DB_conexion();
	if ($db) {
		$res = DB_addUsuario($db,$datos);

		if ($res===true)
			$info[] = 'Se ha añadido el usuario con éxito<br>';
		else{
			$info[] = $res;
			$resultado = "ERROR";
		}

		$usuario = $_POST['usu_usuario'];

		DB_addLog($db, $accion, $usuario, $resultado);
		DB_desconexion($db);

	}
} 
/*else
	FORM_editCiudad('Indique los datos:',$datos,'Añadir Usuario');*/
if (isset($info) && msgCount($info)>0)
	msgError($info);



?>
