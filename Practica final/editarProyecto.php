<?php
require "pag_comun.php";
require "db.php";
require "addProyecto.php";


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
					$proyecto = DB_getProyecto($db,$id);
					$proyecto['editable']=false;
					FORM_editProyecto('Confirme borrado de este proyecto:',$proyecto,'Confirmar Borrado');
					break;
				case 'Confirmar Borrado':
					if (DB_delProyecto($db,$id))
						$info[] = 'El proyecto con código: '.$_POST['pro_codigo'].' ha sido borrado';
					else{
						$info[] = 'No se ha podido borrar el proyecto con código: '.$_POST['pro_codigo'];
						$resultado = "ERROR";
					}

					DB_addLog($db,'Borrar Proyecto', $name, $resultado);

					//header('Refresh  ,  .php');

					break;
				case 'Editar':
					$proyecto = DB_getProyecto($db,$id);
					FORM_editProyecto('Edite el proyecto:',$proyecto,'Modificar');
					break;
				case 'Modificar':
					$msg = DB_actProyecto($db,['id'=>$_POST['id'],'codigo'=>$_POST['pro_codigo'],'titulo'=>$_POST['pro_titulo'],
						'descripcion'=>$_POST['pro_descripcion'],'fechaComienzo'=>$_POST['pro_fechaComienzo'],
						'fechaFinalizacion'=>$_POST['pro_fechaFinalizacion'],'entidadesColaboradoras'=>$_POST['pro_entidadesColaboradoras'],'cuantia'=>$_POST['pro_cuantia'],'investigadorPrincipal'=>$_POST['pro_investigadorPrincipal'],'investigadoresColaboradores'=>$_POST['pro_investigadoresColaboradores'],'URL'=>$_POST['pro_URL']]);
					if ($msg===true)
						$info[] = 'El proyecto con código: '.$_POST['pro_codigo'].' ha sido actualizado';
					else {
						$info[] = 'No se ha podido actualizar el proyecto con código: '.$_POST['pro_codigo'];
						$info[] = $msg;
						$resultado = "ERROR";
					}

					DB_addLog($db,'Modificar Proyecto', $name, $resultado);


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

		$datos = DB_getProyectos($db);

		FORM_listadoProyectosBotones($datos, 'editarProyecto.php');
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