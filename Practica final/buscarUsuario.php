<?php 
require "pag_comun.php";
require "formulario.php";
include "db.php";
require "addUsuario.php";



$accion='';
// ************* Argumentos POST de la página
if (isset($_POST['accion'])) {
	if (isset($_POST['usu_nombre']) && $_POST['usu_nombre']!='')
		$cadenab['bnombre']=$_POST['usu_nombre'];

	if (isset($_POST['usu_especialidad']) && $_POST['usu_especialidad']!='')
		$cadenab['bespecialidad']=$_POST['usu_especialidad'];

	if (isset($_POST['usu_direccion']) && $_POST['usu_direccion']!='')
		$cadenab['bdireccion']=$_POST['usu_direccion'];

	if (isset($_POST['usu_hobbies']) && $_POST['usu_hobbies']!='')
		$cadenab['bhobbies']=$_POST['usu_hobbies'];

	if (isset($cadenab) && count($cadenab)>0) {
		$accion='Buscar';
		$primero=0;
		$numitems=10;
	} else
		$info[] = 'No ha indicado ningún campo de búsqueda';
} else {
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

	$cadenab = [];

	if (isset($_GET['bnombre']))
		$cadenab['bnombre']=$_GET['bnombre'];

	if (isset($_GET['bespecialidad']))
		$cadenab['bespecialidad']=$_GET['bespecialidad'];

	if (isset($_GET['bdireccion']))
		$cadenab['bdireccion']=$_GET['bdireccion'];

	if (isset($_GET['bhobbies']))
		$cadenab['bhobbies']=$_GET['bhobbies'];

	if (count($cadenab)>0)
		$accion="Buscar";
}

if (isset($cadenab))
	FORM_buscarUsuario('Datos de la búsqueda:',$cadenab);
else
	FORM_buscarUsuario('Datos de la búsqueda:');

if ($accion=='Buscar') {
	$db=DB_conexion();
	if ($db) {
	// Buscar y mostrar resultados
		$busc = DB_array2SQL($cadenab);
		$numusuarios=DB_getNumUsuarios($db,$busc);
		if ($numusuarios>0) {
			$usuarios=DB_getUsuarios($db,$primero,$numitems,$busc);

			// Mostrar listado
			if ($usuarios!==false)
				FORM_listadoUsuariosBotones($usuarios,'editarUser.php');
			else {
				$info[] = 'Ha habido un error en la consulta a la BBDD';
				$info[] = mysqli_error($db);
			}
	
		} else
			$info[] ='No hay resultados de la búsqueda';
		DB_desconexion($db); 
	}
	// Barra de paginación
	if ($numusuarios>0 && $numitems>0) {
		$ultima = $numusuarios - ($numusuarios%$numitems);
		$anterior = $numitems>$primero ? 0 : ($primero-$numitems);
		$siguiente = ($primero+$numitems)>$numusuarios ? $ultima : ($primero+$numitems);
		HTMLpaginacion([
			['texto'=>'Primera',
				'url'=>'?primero=0&items='.urlencode($numitems).'&'.http_build_query($cadenab)],
			['texto'=>'Anterior',
				'url'=>'?primero='.urlencode($anterior).'&items='.urlencode($numitems).'&'
										.http_build_query($cadenab)],
			['texto'=>'Siguiente',
				'url'=>'?primero='.urlencode($siguiente).'&items='.urlencode($numitems).'&'
										.http_build_query($cadenab)],
			['texto'=>'Última',
				'url'=>'?primero='.urlencode($ultima).'&items='.urlencode($numitems).'&'
									.http_build_query($cadenab)]]);
	}
}

if (isset($info) && msgCount($info)>0)
	msgError($info); 
}



?>
