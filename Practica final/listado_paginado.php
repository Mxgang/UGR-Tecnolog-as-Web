<?php
require "pag_comun.php";
require "formulario.php";
include "db.php";
require "addUsuario.php";

// ************* Argumentos GET de la página
// primero: Primer item a visualizar
// items : cuantos items incluir (<=0 para ver todos)
	if (!isset($_GET['items']))
		$numitems = 10; // Valor por defecto
	else if (!is_numeric($_GET['items']) || $_GET['items']<1)
		$numitems = 0; // Para mostrar todos los items
	else
		$numitems = $_GET['items'];
	if ($numitems==0)
		$primero=0; // Ver todos los items
	else {
		$primero = isset($_GET['primero']) ? $_GET['primero'] : 0;
		if (!is_numeric($primero) || $primero<0)
			$primero=0;
	}
	// ************* Contenido // Obtener listado de usuarios
	$db=DB_conexion();
	if ($db) {
		$usuarios=DB_getUsuarios1($db,$primero,$numitems);
		$numusuarios=DB_getNumUsuarios($db);
	}

	// Barra de paginación
	if ($numitems>0) {
		$ultima = $numusuarios - ($numusuarios%$numitems);
		$anterior = $numitems>$primero ? 0 : ($primero-$numitems);
		$siguiente = ($primero+$numitems)>$numusuarios ? $ultima : ($primero+$numitems);
		HTMLpaginacion([
			['texto'=>'Primera', 'url'=>"?primero=0&items=$numitems"],
			['texto'=>'Anterior',
			'url'=>"?primero=$anterior&items=$numitems"],
			['texto'=>'Siguiente', 'url'=>"?primero=$siguiente&items=$numitems"],
			['texto'=>'Última', 'url'=>"?primero=$ultima&items=$numitems"]]);
	} 

	if(isset($_POST['accion']) && isset($_POST['nombre'])){
		switch($_POST['accion']){
			case 'Borrar':			//Presentar formulario y pedir confirmacion
				$accion = 'Borrar';
				$nombre = $_POST['nombre'];
				break;
			case 'Editar':			//Presentar formulario y pedir confirmacion
				$accion = 'Editar';
				$nombre = $_POST['nombre'];
				break;
			case 'Confirmar Borrado':	//Borrado confirmado
				$accion = 'BorrarOK';
				$nombre = $_POST['nombre'];
				break;
			case 'Modificar Datos':		//Modificacion confirmada
				$accion = 'Modificar';
				$nombre = $_POST['nombre'];
				break;
			case 'Cancelar': break;
		}
	}




?>
