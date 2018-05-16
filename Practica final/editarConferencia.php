<?php
require "pag_comun.php";
require "db.php";
require "addConferencia.php";


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
		}
	} 
	else{
		// Si la sesión NO está establecida
		HTMLlogin();
		HTMLerror();
		exit;
	}






	$db=DB_conexion();
	if(isset($_POST['id']) && $id!=null);
		$id =$_POST['id'];

	if(isset($_POST['accion']) && $accion != null);
		$accion = $_POST['accion'];

	if (isset($id)) {

		//Establecer la codificación de los datos almacenados ("collation")
		mysqli_set_charset($db,"utf8");
		$resultado = "OK";
		$name = $_SESSION["usuario"];

		if ($db) {
			switch ($accion) {
				case 'Borrar': 
					$conferencia = DB_getConferencia($db,$id);
					$conferencia['editable']=false;
					FORM_editConferencia('Confirme borrado de esta conferencia:',$conferencia,'Confirmar Borrado');
					break;
				case 'Confirmar Borrado':

					if (DB_delConferencia($db,$id))
						$info[] = 'La conferencia con DOI: '.$_POST['con_DOI'].' ha sido borrado';
					else{
						$info[] = 'No se ha podido borrar la conferencia con DOI: '.$_POST['con_DOI'];
						$resultado = "ERROR";
					}



					DB_addLog($db,'Borrar Conferencia', $name, $resultado);

					//header('Refresh  ,  .php');

					break;
				case 'Editar':
					$conferencia = DB_getConferencia($db,$id);
					FORM_editConferencia('Edite la conferencia:',$conferencia,'Modificar');
					break;
				case 'Modificar':
					$msg = DB_actConferencia($db,['id'=>$_POST['id'],'DOI'=>$_POST['con_DOI'],'tituloTrabajo'=>$_POST['con_tituloTrabajo'],'autores'=>$_POST['con_autores'],'fechaPublicacion'=>$_POST['con_fechaPub'],'resumen'=>$_POST['con_resumen'],'nombreConf'=>$_POST['con_nombreConf'],'lugar'=>$_POST['con_lugar'],'reseniaPub'=>$_POST['con_reseniaPub'],'palabrasClave'=>$_POST['con_palabrasClave'],'URL'=>$_POST['con_URL']]);
					if ($msg===true)
						$info[] = 'La conferencia con DOI: '.$_POST['con_DOI'].' ha sido actualizada';
					else {
						$info[] = 'No se ha podido actualizar la conferencia con DOI: '.$_POST['con_DOI'];
						$info[] = $msg;
						$resultado = "ERROR";
					}

					DB_addLog($db,'Modificar Conferencia', $name, $resultado);


					//header('Location:miembros.php');
					break;
				case 'BorradoOK':	//Borrado confirmado
					$accion = 'BorrarOK';
					$id = $_POST['id'];
					break;

				case 'Cancelar': 
					break;
			}


			DB_desconexion($db);
		}
	} else { // Si los parámetros no son correctos: volver al listado
			//header('Location: editar_usuarios.php');

		$datos = DB_getConferencias($db);

		FORM_listadoConferenciasBotones($datos, 'editarConferencia.php');
	}


echo <<< HTML

	

	</nav>
	</div> 

	<div class="col_der"><h1>
HTML;

if (isset($info) && msgCount($info)>0)
	msgError($info);

echo <<< HTML

		</h1>
	</div>
	
HTML;

HTMLfooter();


?>