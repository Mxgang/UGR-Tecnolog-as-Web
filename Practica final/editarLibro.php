<?php
require "pag_comun.php";
require "db.php";
require "addLibro.php";


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
					$libro = DB_getLibro($db,$id);
					$libro['editable']=false;
					FORM_editLibro('Confirme borrado de este libro:',$libro,'Confirmar Borrado');
					break;
				case 'Confirmar Borrado':
					if (DB_delLibro($db,$id))
						$info[] = 'El libro con ISBN: '.$_POST['lib_ISBN'].' ha sido borrado';
					else{
						$info[] = 'No se ha podido borrar el libro con ISBN: '.$_POST['lib_ISBN'];
						$resultado = "ERROR";
					}

					DB_addLog($db,'Borrar Libro', $name, $resultado);

					//header('Refresh  ,  .php');

					break;
				case 'Editar':
					$libro = DB_getLibro($db,$id);
					FORM_editLibro('Edite el libro:',$libro,'Modificar');
					break;
				case 'Modificar':
					$msg = DB_actLibro($db,['id'=>$_POST['id'],'DOI'=>$_POST['lib_DOI'],'tituloTrabajo'=>$_POST['lib_tituloTrabajo'],
						'autores'=>$_POST['lib_autores'],'fechaPublicacion'=>$_POST['lib_fechaPub'],
						'resumen'=>$_POST['lib_resumen'],'editorial'=>$_POST['lib_editorial'],'editor'=>$_POST['lib_editor'],'ISBN'=>$_POST['lib_ISBN'],'palabrasClave'=>$_POST['lib_palabrasClave'],'URL'=>$_POST['lib_URL']]);
					if ($msg===true)
						$info[] = 'El libro con ISBN: '.$_POST['lib_ISBN'].' ha sido actualizado';
					else {
						$info[] = 'No se ha podido actualizar el libro con ISBN: '.$_POST['lib_ISBN'];
						$info[] = $msg;
						$resultado = "ERROR";
					}

					DB_addLog($db,'Modificar Libro', $name, $resultado);


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

		$datos = DB_getLibros($db);

		FORM_listadoLibrosBotones($datos, 'editarLibro.php');
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