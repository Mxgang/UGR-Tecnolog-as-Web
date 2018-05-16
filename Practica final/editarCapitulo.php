<?php
require "pag_comun.php";
require "db.php";
require "addCapitulo.php";


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
					$capitulo = DB_getCapitulo($db,$id);
					$capitulo['editable']=false;
					FORM_editCapitulo('Confirme borrado de este capítulo:',$capitulo,'Confirmar Borrado');
					break;
				case 'Confirmar Borrado':
					if (DB_delCapitulo($db,$id))
						$info[] = 'El capítulo ha sido borrado';
					else{
						$info[] = 'No se ha podido borrar el capítulo';
						$resultado = "ERROR";
					}

					DB_addLog($db,'Borrar Capitulo', $name, $resultado);

					//header('Refresh  ,  .php');

					break;
				case 'Editar':
					$capitulo = DB_getCapitulo($db,$id);
					FORM_editCapitulo('Edite el capítulo:',$capitulo,'Modificar');
					break;
				case 'Modificar':
					$msg = DB_actCapitulo($db,['id'=>$_POST['id'],'DOI'=>$_POST['cap_DOI'],'tituloTrabajo'=>$_POST['cap_tituloTrabajo'],'autores'=>$_POST['cap_autores'],'fechaPublicacion'=>$_POST['cap_fechaPub'],'resumen'=>$_POST['cap_resumen'],'tituloLibro'=>$_POST['cap_tituloLibro'],'editorial'=>$_POST['cap_editorial'],'editor'=>$_POST['cap_editor'],'ISBN'=>$_POST['cap_ISBN'],'pagCap'=>$_POST['cap_paginaCapitulo'],'palabrasClave'=>$_POST['cap_palabrasClave'],'URL'=>$_POST['cap_URL']]);
					if ($msg===true)
						$info[] = 'El capítulo ha sido actualizado';
					else {
						$info[] = 'No se ha podido actualizar el capítulo';
						$info[] = $msg;
						$resultado = "ERROR";
					}

					DB_addLog($db,'Modificar Capitulo', $name, $resultado);


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

		$datos = DB_getCapitulos($db);

		FORM_listadoCapitulosBotones($datos, 'editarCapitulo.php');
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