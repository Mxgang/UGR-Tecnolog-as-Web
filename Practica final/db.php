<?php
	
	require_once('credenciales.php');
	// Conexión a la BBDD
	function DB_conexion() {
	$db = new mysqli(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);
	if (!$db) {
	echo "<p>Error de conexión</p>";
	echo "<p>Código: ".mysqli_connect_errno()."</p>";
	echo "<p>Mensaje: ".mysqli_connect_error()."</p>";
	return false;
	// die("Adiós");
	}
	// Establecer la codificación de los datos almacenados ("collation")
	mysqli_set_charset($db,"utf8");
	return $db;
	}
	// Desconexión de la BBDD
	function DB_desconexion($db) {
		mysqli_close($db);
	}

	function DB_getUsuarios1($db,$primero=0,$numitems=0) {
		if ($numitems<=0) // Listarlos todos
			$rango='';
		else
			$rango = 'LIMIT '.(int)($numitems).' OFFSET '.abs($primero);
		// Consulta a la BBDD
		$res = mysqli_query($db, "SELECT name,especialidad,direccion,hobbies FROM usuarios
									 ORDER BY name $rango");
		if ($res) { // Si no hay error
			if (mysqli_num_rows($res)>0) // Si hay alguna tupla de respuesta
				$tabla = mysqli_fetch_all($res,MYSQLI_ASSOC);
			else // No hay resultados para la consulta
				$tabla = [];
			mysqli_free_result($res); // Liberar memoria de la consulta
		} else // Error en la consulta
			$tabla = false;

		return $tabla;
	}

	function DB_getUsuarios2($db,$primero=0,$numitems=0,$cadenab='') {
		if ($numitems<=0) { // Listarlos todos
			$rango='';
		} else {
			$rango = 'LIMIT '.(int)($numitems).' OFFSET '.abs($primero);
		}

		// Consulta a la BBDD
		if (strlen($cadenab)!=0)
			$cadenab.=' AND ';

		$res = mysqli_query($db, "SELECT name,especialidad,direccion,hobbies FROM usuarios");

		//???
		return $res;
	}

	function DB_getUsuarios3($db) {
		$res = mysqli_query($db, "SELECT id,name,especialidad,direccion,hobbies,password FROM usuarios ORDER BY name");
		if ($res) {
			// Si no hay error
			if (mysqli_num_rows($res)>0) {
			// Si hay alguna tupla de respuesta
				$tabla = mysqli_fetch_all($res,MYSQLI_ASSOC);
			// No hay resultados para la consulta
			} else {
				$tabla = [];
			}
			mysqli_free_result($res);
			// Liberar memoria de la consulta

		} else {
			// Error en la consulta
			$tabla = false;
		}
		return $tabla;
	}

	function DB_getLog($db) {

		$res = mysqli_query($db, "SELECT * FROM log ORDER BY fecha");
		if ($res) {
			// Si no hay error
			if (mysqli_num_rows($res)>0) {
			// Si hay alguna tupla de respuesta
				$tabla = mysqli_fetch_all($res,MYSQLI_ASSOC);
			// No hay resultados para la consulta
			} else {
				$tabla = [];
			}
			mysqli_free_result($res);
			// Liberar memoria de la consulta

		} else {
			// Error en la consulta
			$tabla = false;
		}
		return $tabla;
	}
	// Consulta para obtener el número de registros
	function DB_getNumRegistros($db) {
		$res = mysqli_query($db, "SELECT COUNT(*) FROM log");
		$num = mysqli_fetch_row($res)[0];
		mysqli_free_result($res);
		return $num;
	}
	function DB_getArticulos($db) {
		$res = mysqli_query($db, "SELECT idPost,DOI,autores,fechaPublicacion,resumen,nombreRevista,volumen,paginas,palabrasClave,URL FROM articulos ORDER BY idPOST");
		if ($res) {
			// Si no hay error
			if (mysqli_num_rows($res)>0) {
			// Si hay alguna tupla de respuesta
				$tabla = mysqli_fetch_all($res,MYSQLI_ASSOC);
			// No hay resultados para la consulta
			} else {
				$tabla = [];
			}
			mysqli_free_result($res);
			// Liberar memoria de la consulta

		} else {
			// Error en la consulta
			$tabla = false;
		}
		return $tabla;
	}

	function DB_getLibros($db) {
		$res = mysqli_query($db, "SELECT * FROM libros ORDER BY idPOST");
		if ($res) {
			// Si no hay error
			if (mysqli_num_rows($res)>0) {
			// Si hay alguna tupla de respuesta
				$tabla = mysqli_fetch_all($res,MYSQLI_ASSOC);
			// No hay resultados para la consulta
			} else {
				$tabla = [];
			}
			mysqli_free_result($res);
			// Liberar memoria de la consulta

		} else {
			// Error en la consulta
			$tabla = false;
		}
		return $tabla;
	}

	function DB_getCapitulos($db) {
		$res = mysqli_query($db, "SELECT * FROM capLibros ORDER BY idPOST");
		if ($res) {
			// Si no hay error
			if (mysqli_num_rows($res)>0) {
			// Si hay alguna tupla de respuesta
				$tabla = mysqli_fetch_all($res,MYSQLI_ASSOC);
			// No hay resultados para la consulta
			} else {
				$tabla = [];
			}
			mysqli_free_result($res);
			// Liberar memoria de la consulta

		} else {
			// Error en la consulta
			$tabla = false;
		}
		return $tabla;
	}

	function DB_getConferencias($db) {
		$res = mysqli_query($db, "SELECT * FROM conferencias ORDER BY idPOST");
		if ($res) {
			// Si no hay error
			if (mysqli_num_rows($res)>0) {
			// Si hay alguna tupla de respuesta
				$tabla = mysqli_fetch_all($res,MYSQLI_ASSOC);
			// No hay resultados para la consulta
			} else {
				$tabla = [];
			}
			mysqli_free_result($res);
			// Liberar memoria de la consulta

		} else {
			// Error en la consulta
			$tabla = false;
		}
		return $tabla;
	}

	function DB_getProyectos($db) {
		$res = mysqli_query($db, "SELECT * FROM proyectos ORDER BY idPOST");
		if ($res) {
			// Si no hay error
			if (mysqli_num_rows($res)>0) {
			// Si hay alguna tupla de respuesta
				$tabla = mysqli_fetch_all($res,MYSQLI_ASSOC);
			// No hay resultados para la consulta
			} else {
				$tabla = [];
			}
			mysqli_free_result($res);
			// Liberar memoria de la consulta

		} else {
			// Error en la consulta
			$tabla = false;
		}
		return $tabla;
	}

	function DB_getUsuario($db, $id) {
		$prep = mysqli_prepare($db,"SELECT * FROM usuarios WHERE id=$id");
		
		if (mysqli_stmt_execute($prep)) {
			mysqli_stmt_bind_result($prep,$rid,$rname,$rpassword,$respecialidad,$rdireccion,$rhobbies);
			if (mysqli_stmt_fetch($prep)) {
				echo "USER NAME: " .$rname;
				$usuario['id'] = $rid;
				$usuario['name'] = $rname;
				$usuario['password']  = $rpassword;
				$usuario['especialidad'] = $respecialidad;
				$usuario['direccion'] = $rdireccion;
				$usuario['hobbies'] = $rhobbies;
			} else
				$usuario = false; // No hay resultados
		} else
			$usuario = false; // Error en consulta
		mysqli_stmt_close($prep);

		return $usuario;
	} 

	function DB_getArticulo($db, $id) {
		$prep = mysqli_prepare($db,"SELECT idPost,DOI,autores,fechaPublicacion,resumen,nombreRevista,volumen,paginas,palabrasClave,URL FROM articulos WHERE idPost=$id");
		
		if (mysqli_stmt_execute($prep)) {
			mysqli_stmt_bind_result($prep,$ridPost,$rDOI,$rautores,$rfechaPublicacion,$rresumen,$rnombreRevista,$rvolumen,$rpaginas,$rpalabrasClave,$rURL);
			if (mysqli_stmt_fetch($prep)) {
				$articulo['id'] = $ridPost;
				$articulo['DOI'] = $rDOI;
				$articulo['autores'] = $rautores;
				$articulo['fechaPublicacion'] = $rfechaPublicacion;
				$articulo['resumen'] = $rresumen;
				$articulo['nombreRevista'] = $rnombreRevista;
				$articulo['volumen'] = $rvolumen;
				$articulo['paginas'] = $rpaginas;
				$articulo['palabrasClave'] = $rpalabrasClave;
				$articulo['URL'] = $rURL;
			} else{
				$articulo = false; // No hay resultados
			}
		} else{
			$articulo = false; // Error en consulta
		}
		mysqli_stmt_close($prep);

		return $articulo;
	}

	function DB_getNumUsuarios($db,$cadenab='') {
		if ($cadenab!='')
			$cadenab .= ' AND ';
		$res = mysqli_query($db, "SELECT COUNT(*) FROM usuarios");

	//???
	return $res;
	}


	function DB_delUsuario($db,$id) {
		$prep = mysqli_prepare($db,"DELETE FROM usuarios WHERE id='$id'");
		$val = $id;
		mysqli_stmt_bind_param($prep,'s',$val);
		mysqli_stmt_execute($prep);
		if (mysqli_stmt_affected_rows($prep)==1)
			$ret = true;
		else
			$ret = false;
		mysqli_stmt_close($prep);
		return $ret;
	}

	function DB_delArticulo($db,$id) {
		$prep = mysqli_prepare($db,"DELETE FROM articulos WHERE idPost='$id'");
		$val = $id;
		mysqli_stmt_bind_param($prep,'s',$val);
		mysqli_stmt_execute($prep);
		if (mysqli_stmt_affected_rows($prep)==1)
			$ret = true;
		else
			$ret = false;
		mysqli_stmt_close($prep);
		return $ret;
	}

	function DB_actUsuario($db,$datos) {
		// Comprobar si ya hay un usuario con el mismo nombre
		$res = mysqli_query($db,"SELECT id,name,password FROM usuarios WHERE name='{$datos['nombre']}' AND id='{$datos['id']}'");
		$usuario = mysqli_fetch_assoc($res);
		mysqli_free_result($res);


		if ($usuario['name']==$datos['nombre'] && $usuario['id']!=$datos['id'])
			$info[] = 'Ya hay otro usuario con ese nombre';
		else {
			if($datos['password'] == "")
				$pass = $usuario['password'];
			else
				$pass = hash("sha256", $datos['password']);
			$res = mysqli_query($db, "UPDATE usuarios SET name='{$datos['nombre']}', especialidad='{$datos['especialidad']}',
								direccion='{$datos['direccion']}', hobbies='{$datos['hobbies']}', password='$pass' WHERE id='{$datos['id']}'");
			if (!$res) {
				$info[] = 'Error al actualizar';
				$info[] = mysqli_error($db);
			}
		}
		if (isset($info))
			return $info;
		else
			return true; // OK
	}

	function DB_actArticulo($db,$datos) {
		// Comprobar si ya hay un articulo con el mismo DOI
		$res = mysqli_query($db,"SELECT idPost,DOI FROM articulos WHERE DOI='{$datos['DOI']}' AND id='{$datos['id']}'");
		$articulo = mysqli_fetch_assoc($res);
		mysqli_free_result($res);


		if ($articulo['DOI']==$datos['DOI'] && $articulo['idPost']!=$datos['idPost'])
			$info[] = 'Ya hay otro artículo con ese DOI';
		else {

			echo "act art autores: " .$datos['id']. "<br>";

			
			//Filtrado de entradas
			$autores = trim($datos['autores']);
			$autores = strip_tags($autores);
			$autores = htmlspecialchars($autores);

			$resumen = trim($datos['resumen']);
			$resumen = strip_tags($resumen);
			$resumen = htmlspecialchars($resumen);

			$nombreRevista = trim($datos['nombreRevista']);
			$nombreRevista = strip_tags($nombreRevista);
			$nombreRevista = htmlspecialchars($nombreRevista);

			$volumen = trim($datos['volumen']);
			$volumen = strip_tags($volumen);
			$volumen = htmlspecialchars($volumen);

			$paginas = trim($datos['paginas']);
			$paginas = strip_tags($paginas);
			$paginas = htmlspecialchars($paginas);

			$palabrasClave = trim($datos['palabrasClave']);
			$palabrasClave = strip_tags($palabrasClave);
			$palabrasClave = htmlspecialchars($palabrasClave);

			$URL = trim($datos['URL']);
			$URL = strip_tags($URL);
			$URL = htmlspecialchars($URL);
			
			$res = mysqli_query($db,"UPDATE articulos SET DOI='{$datos['DOI']}', autores='$autores', fechaPublicacion='{$datos['fechaPublicacion']}', resumen='$resumen', nombreRevista='$nombreRevista', volumen='$volumen', paginas='$paginas', palabrasClave='$palabrasClave', URL='$URL' WHERE idPost='{$datos['id']}'");
			if (!$res) {
				$info[] = 'Error al actualizar';
				$info[] = mysqli_error($db);
			}
		}
		if (isset($info))
			return $info;
		else
			return true; // OK
	}


	function DB_addPublicacion($db,$datos){
		$res = mysqli_query($db, "INSERT INTO publicaciones (usuario) VALUES ('{$datos['name']}')");
			if (!$res) {
				$info[] = 'Error en la consulta '.__FUNCTION__;
				$info[] = mysqli_error($db);
			}
		if (isset($info))
			return $info;
		else
			return true; // OK
	}

	function DB_addUsuario($db,$datos) {
		// Comprobar si ya hay un usuario con el mismo nombre
		$res = mysqli_query($db, "SELECT COUNT(*) FROM usuarios
		WHERE name='{$datos['name']}'");
		$num = mysqli_fetch_row($res)[0];
		mysqli_free_result($res);
		if ($num>0)
			$info[] = 'Ya existe un usuario con ese nombre';
		else {

			//Filtrado de entradas
			$username = trim($datos['name']);
			$username = strip_tags($username);
			$username = htmlspecialchars($username);

			$especialidad = trim($datos['especialidad']);
			$especialidad = strip_tags($especialidad);
			$especialidad = htmlspecialchars($especialidad);

			$direccion = trim($datos['direccion']);
			$direccion = strip_tags($direccion);
			$direccion = htmlspecialchars($direccion);

			$hobbies = trim($datos['hobbies']);
			$hobbies = strip_tags($hobbies);
			$hobbies = htmlspecialchars($hobbies);

			$pass = trim($datos['password']);
			$pass = strip_tags($pass);
			$pass = htmlspecialchars($pass);
			
			$pass = hash("sha256", $pass);

			$res = mysqli_query($db, "INSERT INTO usuarios (name,especialidad,direccion,hobbies,password) VALUES ('$username','$especialidad','$direccion','$hobbies','$pass')");
			if (!$res) {
				$info[] = 'Error en la consulta '.__FUNCTION__;
				$info[] = mysqli_error($db);
			}
		}
		if (isset($info))
			return $info;
		else
			return true; // OK
	}

	function DB_addArticulo($db,$datos) {
		

		$resultado = "OK";

		// Comprobar si ya hay un articulo con el mismo DOI
		$res = mysqli_query($db, "SELECT COUNT(*) FROM articulos WHERE DOI='{$datos['DOI']}'");
		$num = mysqli_fetch_row($res)[0];
		mysqli_free_result($res);
		if ($num>0)
			$info[] = 'Ya existe un articulo con ese DOI';
		else {
			
			$name = trim($datos['name']);
			$name = strip_tags($name);
			$name = htmlspecialchars($name);

				$res = mysqli_query($db, "INSERT INTO publicaciones (usuario) VALUES ('{$datos['name']}')");
				if (!$res) {
					$info[] = 'Error en la consulta '.__FUNCTION__;
					$info[] = mysqli_error($db);
				}
				if (isset($info))
					return $info;
				//else OK (sigue)

			//Sacamos el idPost que acabamos de crear
			//echo "ID POST: $idPost <br>";
			$res = mysqli_query($db, "SELECT idPost FROM publicaciones WHERE usuario = Administrador");
			//echo "RES: $res <br>";
			$idPost = mysqli_fetch_row($res)[0];
			mysqli_free_result($res);
			//echo "ID POST: $idPost <br>";
			$idPost = 0;

			//Filtrado de entradas
			$DOI = trim($datos['DOI']);
			$DOI = strip_tags($DOI);
			$DOI = htmlspecialchars($DOI);

			$autores = trim($datos['autores']);
			$autores = strip_tags($autores);
			$autores = htmlspecialchars($autores);

			$resumen = trim($datos['resumen']);
			$resumen = strip_tags($resumen);
			$resumen = htmlspecialchars($resumen);

			$nombreRevista = trim($datos['nombreRevista']);
			$nombreRevista = strip_tags($nombreRevista);
			$nombreRevista = htmlspecialchars($nombreRevista);

			$volumen = trim($datos['volumen']);
			$volumen = strip_tags($volumen);
			$volumen = htmlspecialchars($volumen);

			$paginas = trim($datos['paginas']);
			$paginas = strip_tags($paginas);
			$paginas = htmlspecialchars($paginas);

			$palabrasClave = trim($datos['palabrasClave']);
			$palabrasClave = strip_tags($palabrasClave);
			$palabrasClave = htmlspecialchars($palabrasClave);

			$URL = trim($datos['URL']);
			$URL = strip_tags($URL);
			$URL = htmlspecialchars($URL);

			$fechaPublicacion = ($datos['fechaPub']);

			

			$res = mysqli_query($db, "INSERT INTO articulos (usuario,idPost,DOI,autores,fechaPublicacion,resumen,nombreRevista,volumen,paginas,palabrasClave,URL) VALUES ('$name','$idPost','$DOI','$autores','$fechaPublicacion','$resumen','$nombreRevista','$volumen','$paginas','$palabrasClave','$URL')");
			if (!$res) {
				$info[] = 'Error en la consulta '.__FUNCTION__;
				$info[] = mysqli_error($db);
			}
		}
		
		if (isset($info))
			return $info;
		else
			return true;	//OK;
	}

	function DB_addLibro($db,$datos) {

		$resultado = "OK";

		// Comprobar si ya hay un articulo con el mismo DOI
		$res = mysqli_query($db, "SELECT COUNT(*) FROM libros WHERE ISBN='{$datos['ISBN']}'");
		$num = mysqli_fetch_row($res)[0];
		mysqli_free_result($res);
		if ($num>0)
			$info[] = 'Ya existe un libro con ese ISBN';
		else {
			
			$name = trim($datos['name']);
			$name = strip_tags($name);
			$name = htmlspecialchars($name);

				
			

			//Filtrado de entradas
			$DOI = trim($datos['DOI']);
			$DOI = strip_tags($DOI);
			$DOI = htmlspecialchars($DOI);

			$tituloTrabajo = trim($datos['tituloTrabajo']);
			$tituloTrabajo = strip_tags($tituloTrabajo);
			$tituloTrabajo = htmlspecialchars($tituloTrabajo);

			$autores = trim($datos['autores']);
			$autores = strip_tags($autores);
			$autores = htmlspecialchars($autores);

			$fechaPublicacion = ($datos['fechaPub']);

			$resumen = trim($datos['resumen']);
			$resumen = strip_tags($resumen);
			$resumen = htmlspecialchars($resumen);

			$editorial = trim($datos['editorial']);
			$editorial = strip_tags($editorial);
			$editorial = htmlspecialchars($editorial);

			$editor = trim($datos['editor']);
			$editor = strip_tags($editor);
			$editor = htmlspecialchars($editor);

			$ISBN = trim($datos['ISBN']);
			$ISBN = strip_tags($ISBN);
			$ISBN = htmlspecialchars($ISBN);

			$palabrasClave = trim($datos['palabrasClave']);
			$palabrasClave = strip_tags($palabrasClave);
			$palabrasClave = htmlspecialchars($palabrasClave);

			$URL = trim($datos['URL']);
			$URL = strip_tags($URL);
			$URL = htmlspecialchars($URL);

			

			

			$res = mysqli_query($db, "INSERT INTO libros (usuario,DOI,tituloTrabajo,autores,fechaPublicacion,resumen,editorial,editor,ISBN,palabrasClave,URL) VALUES ('$name','$DOI','$tituloTrabajo','$autores','$fechaPublicacion','$resumen','$editorial','$editor','$ISBN','$palabrasClave','$URL')");
			if (!$res) {
				$info[] = 'Error en la consulta '.__FUNCTION__;
				$info[] = mysqli_error($db);
				$resultado = "Error";
			}
		}

		


		
		if (isset($info))
			return $info;
		else
			return true;	//OK;
	}

	function DB_addCapitulo($db,$datos) {

		$resultado = "OK";

		// Comprobar si ya hay un articulo con el mismo DOI
		$res = mysqli_query($db, "SELECT COUNT(*) FROM capLibros WHERE DOI='{$datos['DOI']}' AND pagCap='{$datos['paginaCapitulo']}'");
		$num = mysqli_fetch_row($res)[0];
		mysqli_free_result($res);
		if ($num>0)
			$info[] = 'Ya existe ese capitulo con ese DOI';
		else {
			
			$name = trim($datos['name']);
			$name = strip_tags($name);
			$name = htmlspecialchars($name);

				
			

			//Filtrado de entradas
			$DOI = trim($datos['DOI']);
			$DOI = strip_tags($DOI);
			$DOI = htmlspecialchars($DOI);

			$tituloTrabajo = trim($datos['tituloTrabajo']);
			$tituloTrabajo = strip_tags($tituloTrabajo);
			$tituloTrabajo = htmlspecialchars($tituloTrabajo);

			$autores = trim($datos['autores']);
			$autores = strip_tags($autores);
			$autores = htmlspecialchars($autores);

			$fechaPublicacion = ($datos['fechaPub']);

			$resumen = trim($datos['resumen']);
			$resumen = strip_tags($resumen);
			$resumen = htmlspecialchars($resumen);

			$tituloLibro = trim($datos['tituloLibro']);
			$tituloLibro = strip_tags($tituloLibro);
			$tituloLibro = htmlspecialchars($tituloLibro);

			$editorial = trim($datos['editorial']);
			$editorial = strip_tags($editorial);
			$editorial = htmlspecialchars($editorial);

			$editor = trim($datos['editor']);
			$editor = strip_tags($editor);
			$editor = htmlspecialchars($editor);

			$ISBN = trim($datos['ISBN']);
			$ISBN = strip_tags($ISBN);
			$ISBN = htmlspecialchars($ISBN);

			$paginaCapitulo = trim($datos['paginaCapitulo']);
			$paginaCapitulo = strip_tags($paginaCapitulo);
			$paginaCapitulo = htmlspecialchars($paginaCapitulo);

			$palabrasClave = trim($datos['palabrasClave']);
			$palabrasClave = strip_tags($palabrasClave);
			$palabrasClave = htmlspecialchars($palabrasClave);

			$URL = trim($datos['URL']);
			$URL = strip_tags($URL);
			$URL = htmlspecialchars($URL);

			

			

			$res = mysqli_query($db, "INSERT INTO capLibros (usuario,DOI,tituloTrabajo,autores,fechaPublicacion,resumen,tituloLibro,editorial,editor,ISBN,pagCap,palabrasClave,URL) VALUES ('$name','$DOI','$tituloTrabajo','$autores','$fechaPublicacion','$resumen','$tituloLibro','$editorial','$editor','$ISBN','$paginaCapitulo','$palabrasClave','$URL')");
			if (!$res) {
				$info[] = 'Error en la consulta '.__FUNCTION__;
				$info[] = mysqli_error($db);
				$resultado = "Error";
			}
		}

		


		if (isset($info))
			return $info;
		else
			return true;	//OK;
		
	}

	function DB_addConferencia($db,$datos) {

		$resultado = "OK";

		// Comprobar si ya hay un articulo con el mismo DOI
		$res = mysqli_query($db, "SELECT COUNT(*) FROM conferencias WHERE DOI='{$datos['DOI']}'");
		$num = mysqli_fetch_row($res)[0];
		mysqli_free_result($res);
		if ($num>0)
			$info[] = 'Ya existe una conferencia con ese DOI';
		else {
			
			$name = trim($datos['name']);
			$name = strip_tags($name);
			$name = htmlspecialchars($name);

				
			

			//Filtrado de entradas
			$DOI = trim($datos['DOI']);
			$DOI = strip_tags($DOI);
			$DOI = htmlspecialchars($DOI);

			$tituloTrabajo = trim($datos['tituloTrabajo']);
			$tituloTrabajo = strip_tags($tituloTrabajo);
			$tituloTrabajo = htmlspecialchars($tituloTrabajo);

			$autores = trim($datos['autores']);
			$autores = strip_tags($autores);
			$autores = htmlspecialchars($autores);

			$fechaPublicacion = ($datos['fechaPub']);

			$resumen = trim($datos['resumen']);
			$resumen = strip_tags($resumen);
			$resumen = htmlspecialchars($resumen);

			$nombreConf = trim($datos['nombreConf']);
			$nombreConf = strip_tags($nombreConf);
			$nombreConf = htmlspecialchars($nombreConf);

			$lugar = trim($datos['lugar']);
			$lugar = strip_tags($lugar);
			$lugar = htmlspecialchars($lugar);

			$reseniaPub = trim($datos['reseniaPub']);
			$reseniaPub = strip_tags($reseniaPub);
			$reseniaPub = htmlspecialchars($reseniaPub);

			$palabrasClave = trim($datos['palabrasClave']);
			$palabrasClave = strip_tags($palabrasClave);
			$palabrasClave = htmlspecialchars($palabrasClave);

			$URL = trim($datos['URL']);
			$URL = strip_tags($URL);
			$URL = htmlspecialchars($URL);

			

			

			$res = mysqli_query($db, "INSERT INTO conferencias (usuario,DOI,tituloTrabajo,autores,fechaPublicacion,resumen,nombreConf,lugar,reseniaPub,palabrasClave,URL) VALUES ('$name','$DOI','$tituloTrabajo','$autores','$fechaPublicacion','$resumen','$nombreConf','$lugar','$reseniaPub','$palabrasClave','$URL')");
			if (!$res) {
				$info[] = 'Error en la consulta '.__FUNCTION__;
				$info[] = mysqli_error($db);
				$resultado = "Error";
			}
		}

		


		
		if (isset($info))
			return $info;
		else
			return true;	//OK;
	}

	function DB_addProyecto($db,$datos) {

		$resultado = "OK";

		// Comprobar si ya hay un articulo con el mismo DOI
		$res = mysqli_query($db, "SELECT COUNT(*) FROM proyectos WHERE codigo='{$datos['codigo']}'");
		$num = mysqli_fetch_row($res)[0];
		mysqli_free_result($res);
		if ($num>0)
			$info[] = 'Ya existe un proyecto con ese código';
		else {
			
			$name = trim($datos['name']);
			$name = strip_tags($name);
			$name = htmlspecialchars($name);

				
			

			//Filtrado de entradas
			$codigo = trim($datos['codigo']);
			$codigo = strip_tags($codigo);
			$codigo = htmlspecialchars($codigo);

			$titulo = trim($datos['titulo']);
			$titulo = strip_tags($titulo);
			$titulo = htmlspecialchars($titulo);

			$descripcion = trim($datos['descripcion']);
			$descripcion = strip_tags($descripcion);
			$descripcion = htmlspecialchars($descripcion);

			$fechaComienzo = ($datos['fechaComienzo']);

			$fechaFinalizacion = ($datos['fechaFinalizacion']);

			$entidadesColaboradoras = trim($datos['entidadesColaboradoras']);
			$entidadesColaboradoras = strip_tags($entidadesColaboradoras);
			$entidadesColaboradoras = htmlspecialchars($entidadesColaboradoras);

			$cuantia = trim($datos['cuantia']);
			$cuantia = strip_tags($cuantia);
			$cuantia = htmlspecialchars($cuantia);

			$investigadorPrincipal = trim($datos['investigadorPrincipal']);
			$investigadorPrincipal = strip_tags($investigadorPrincipal);
			$investigadorPrincipal = htmlspecialchars($investigadorPrincipal);

			$investigadoresColaboradores = trim($datos['investigadoresColaboradores']);
			$investigadoresColaboradores = strip_tags($investigadoresColaboradores);
			$investigadoresColaboradores = htmlspecialchars($investigadoresColaboradores);

			$URL = trim($datos['URL']);
			$URL = strip_tags($URL);
			$URL = htmlspecialchars($URL);

			

			

			$res = mysqli_query($db, "INSERT INTO proyectos (usuario,codigo,titulo,descripcion,fechaComienzo,fechaFinalizacion,entidadesColaboradoras,cuantia,investigadorPrincipal,investigadoresColaboradores,URL) VALUES ('$name','$codigo','$titulo','$descripcion','$fechaComienzo','$fechaFinalizacion','$entidadesColaboradoras','$cuantia','$investigadorPrincipal','$investigadoresColaboradores','$URL')");
			if (!$res) {
				$info[] = 'Error en la consulta '.__FUNCTION__;
				$info[] = mysqli_error($db);
				$resultado = "Error";
			}
		}

		


		
		if (isset($info))
			return $info;
		else
			return true;	//OK;
	}

	function DB_addLog($db, $accion, $usuario, $resultado){
		$res = mysqli_query($db, "INSERT INTO log (usuario,accion,resultado) VALUES ('$usuario','$accion','$resultado')");
		if (!$res) {
			$info[] = 'No se ha podido crear LOG de la acción';
			$info[] = mysqli_error($db);
		}
		if (isset($info))
			return $info;
		else
			return true; // OK
	}
	function DB_ordenar($db,$tabla,$tipo) {

		$res = mysqli_query($db, "SELECT * FROM $tabla ORDER BY $tipo");
		if ($res) {
			// Si no hay error
			if (mysqli_num_rows($res)>0) {
			// Si hay alguna tupla de respuesta
				$tabla = mysqli_fetch_all($res,MYSQLI_ASSOC);
			// No hay resultados para la consulta
			} else {
				$tabla = [];
			}
			mysqli_free_result($res);
			// Liberar memoria de la consulta

		} else {
			// Error en la consulta
			$tabla = false;
		}
		return $tabla;
	}
	function DB_ordenar_articulos_autor($db,$tabla) {

		$res = mysqli_query($db, "SELECT * FROM $tabla ORDER BY autores");
		if ($res) {
			// Si no hay error
			if (mysqli_num_rows($res)>0) {
			// Si hay alguna tupla de respuesta
				$tabla = mysqli_fetch_all($res,MYSQLI_ASSOC);
			// No hay resultados para la consulta
			} else {
				$tabla = [];
			}
			mysqli_free_result($res);
			// Liberar memoria de la consulta

		} else {
			// Error en la consulta
			$tabla = false;
		}
		return $tabla;
	}
	function DB_ordenar_articulos_fecha($db) {

		$res = mysqli_query($db, "SELECT * FROM articulos ORDER BY fechaPublicacion");
		if ($res) {
			// Si no hay error
			if (mysqli_num_rows($res)>0) {
			// Si hay alguna tupla de respuesta
				$tabla = mysqli_fetch_all($res,MYSQLI_ASSOC);
			// No hay resultados para la consulta
			} else {
				$tabla = [];
			}
			mysqli_free_result($res);
			// Liberar memoria de la consulta

		} else {
			// Error en la consulta
			$tabla = false;
		}
		return $tabla;
	}
	function DB_ordenar_articulos_clave($db) {

		$res = mysqli_query($db, "SELECT * FROM articulos ORDER BY fechaPublicacion");
		if ($res) {
			// Si no hay error
			if (mysqli_num_rows($res)>0) {
			// Si hay alguna tupla de respuesta
				$tabla = mysqli_fetch_all($res,MYSQLI_ASSOC);
			// No hay resultados para la consulta
			} else {
				$tabla = [];
			}
			mysqli_free_result($res);
			// Liberar memoria de la consulta

		} else {
			// Error en la consulta
			$tabla = false;
		}
		return $tabla;
	}

?>