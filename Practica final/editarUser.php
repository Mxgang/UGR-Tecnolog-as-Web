<?php
require "pag_comun.php";
require "db.php";
require "addUsuario.php";


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
			HTMLerror();
			exit;
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
					$usuario = DB_getUsuario($db,$id);
					$usuario['editable']=false;
					FORM_editUsuario('Confirme borrado de este usuario:',$usuario,'Confirmar Borrado');
					break;
				case 'Confirmar Borrado':
					if (DB_delUsuario($db,$id))
						$info[] = 'El usuario '.$_POST['usu_nombre'].' ha sido borrado';
					else{
						$info[] = 'No se ha podido borrar '.$_POST['usu_nombre'];
						$resultado = "ERROR";
					}

					DB_addLog($db,'Borrar Usuario', $name, $resultado);

					//header('Location:miembros.php');

					break;
				case 'Editar':
					$usuario = DB_getUsuario($db,$id);
					FORM_editUsuario('Edite los datos:',$usuario,'Modificar');
					break;
				case 'Modificar':
					$msg = DB_actUsuario($db,['id'=>$_POST['id'],'nombre'=>$_POST['usu_nombre'],
						'especialidad'=>$_POST['usu_especialidad'],'direccion'=>$_POST['usu_direccion'],
						'hobbies'=>$_POST['usu_hobbies'],'password'=>$_POST['usu_password']]);
					if ($msg===true)
						$info[] = 'El usuario '.$_POST['usu_nombre'].' ha sido actualizado';
					else {
						$info[] = 'No se ha podido actualizar '.$_POST['usu_nombre'];
						$info[] = $msg;
						$resultado = "ERROR";
					}

					DB_addLog($db,'Modificar Usuario', $name, $resultado);


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

		$datos = DB_getUsuarios3($db);
		FORM_listadoUsuariosBotones($datos, 'editarUser.php');
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
