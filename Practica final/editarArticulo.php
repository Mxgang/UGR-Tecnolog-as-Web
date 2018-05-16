<?php
require "pag_comun.php";
require "db.php";
require "addArticulo.php";


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
					$articulo = DB_getArticulo($db,$id);
					$articulo['editable']=false;
					FORM_editArticulo('Confirme borrado de este artículo:',$articulo,'Confirmar Borrado');
					break;
				case 'Confirmar Borrado':
					if (DB_delArticulo($db,$id))
						$info[] = 'El artículo con DOI: '.$_POST['art_DOI'].' ha sido borrado';
					else{
						$info[] = 'No se ha podido borrar el artículo con DOI: '.$_POST['art_DOI'];
						$resultado = "ERROR";
					}

					DB_addLog($db,'Borrar Articulo', $name, $resultado);

					//header('Refresh  ,  .php');

					break;
				case 'Editar':
					$articulo = DB_getArticulo($db,$id);
					FORM_editArticulo('Edite el artículo:',$articulo,'Modificar');
					break;
				case 'Modificar':
					$msg = DB_actArticulo($db,['id'=>$_POST['id'],'DOI'=>$_POST['art_DOI'],
						'autores'=>$_POST['art_autores'],'fechaPublicacion'=>$_POST['art_fechaPub'],
						'resumen'=>$_POST['art_resumen'],'nombreRevista'=>$_POST['art_nombreRevista'],'volumen'=>$_POST['art_volumen'],'paginas'=>$_POST['art_paginas'],'palabrasClave'=>$_POST['art_palabrasClave'],'URL'=>$_POST['art_URL']]);
					if ($msg===true)
						$info[] = 'El artículo con DOI: '.$_POST['art_DOI'].' ha sido actualizado';
					else {
						$info[] = 'No se ha podido actualizar el artículo con DOI: '.$_POST['art_DOI'];
						$info[] = $msg;
						$resultado = "ERROR";
					}

					DB_addLog($db,'Modificar Articulo', $name, $resultado);


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

		$datos = DB_getArticulos($db);

		FORM_listadoArticulosBotones($datos, 'editarArticulo.php');
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