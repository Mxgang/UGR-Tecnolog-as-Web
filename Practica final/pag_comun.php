<?php

error_reporting(0);

function HTMLpag_inicio() {
echo <<< HTML
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="index.css">
		<title>GIRARV</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
		    <script>
		        $(document).ready(function(){			
					$("#llamar_AJAX").on("click", function(e){
						e.preventDefault();
						$("#contenido_php").load("documentacion.html");
					});
				});
		    </script>

		    <script type="text/javascript" src="jquery.js"></script>
		    <script type="text/javascript">
			   $(document).ready(function(){
			     $("#hide").click(function(){
			       $("#element").hide();
			     });
			   });
		    </script>
		</head>
		<body>
			
		<div id="contenido_php"></div>
		<div class="header">
		<header>
			<script>
				function cargarDiv(div,url)
				{
				      $("#col_der").load("editarUser.php");
				}
			</script>

			<a href="index.php"><img src="girarv2.png" alt="girarv" height="100%" width="10%"></a>
			<h1>GIRARV</h1>
			<p>Grupo de Investigación de la Realidad Aumentada y Realidad Virtual</p>
		</div>
HTML;
}	

///////////////////////////////SESIONES////////////////////////

function HTMLlogin(){
	echo <<< HTML
		<div class="botones">
			<form action="session1.php" method="POST">
	            <input type="text" placeholder="usuario" name="usuario"><br/>
	            <input type="password" placeholder="contraseña" name="password"><br/>
	            <input type="submit" value="Iniciar sesión" name="login">
            </form>

		</div>
		</header>
HTML;
}
	
function HTMLbienvenido($usuario) {
echo <<< HTML
	<div class="botones">
		<p>Bienvenido $usuario, sesión establecida</p>
		<form action="session2.php" method="post">
		<input type="submit" name="logout" value="Finalizar sesión">
		</form><br>
	</div>
	</header>

	
HTML;
}

function acabarSesion() {
	// La sesión debe estar iniciada
	if (session_status()==PHP_SESSION_NONE)
		session_start();
	// Borrar variables de sesión
	//$_SESSION = array();
	session_unset();
	// Obtener parámetros de cookie de sesión
	$param = session_get_cookie_params();
	// Borrar cookie de sesión
	setcookie(session_name(), $_COOKIE[session_name()], time()-2592000, 
		$param['path'], $param['domain'], $param['secure'], $param['httponly']);
	// Destruir sesión
	session_destroy();
}

////////////////////////////////////////////////////////////////

// Función para presentar una barra de paginación/navegación
// $items: array con un elemento por cada botón/enlace
// cada elemento es un array ['texto'=>'...', 'url'='...']
function HTMLpaginacion($items) {
	echo '<div class="paginador">';
	foreach ($items as $elem) {
		echo '<span class="paginador_elem">';
		echo "<a href='{$elem['url']}'>{$elem['texto']}</a>";
		echo '</span>';
	}
	echo '</div>';
} 

function HTMLcol_izq(){
echo <<< HTML

	

	<div class="infogeneral">
		<div class="col_izq">
			<nav>
			<div class="algunosenlaces">
				<ul>
					<li><a href="index.php">Página de inicio</a></li>
					<li>____________________</li>
					<li><a href="miembros.php">Miembros</a></li>
					<li>____________________</li>
					<li><a href="proyectos.php">Proyectos</a></li>
					<li>____________________</li>
					<li><a href="publicaciones.php">Publicaciones</a></li>
					<li>____________________</li>
					<li><a href="#" id="llamar_AJAX">Mostrar documentación<br></a></li>
					<li><a href="#" id="hide">Ocultar documentación</a></li>
				</ul>
			</div>

			
		
HTML;
}

function HTML_col_izq_admin(){
echo <<< HTML

		<div class="admin">
			<ul>
				<li><strong>Administrador</strong></li>
				<li><a href="editar_usuarios.php">Editar usuarios</a></li>
				<li><a href="systemLog.php">Ver log del sistema</a></li>
				<li><a href="hacerbackup.php">Hacer backup</a></li>
				<li><a href="restaurar.php">Restaurar backup</a></li>
			</ul>
		</div>

HTML;
}

function HTML_col_izq_usuarios(){
echo <<< HTML

			<div class="usuarios">
				<ul>
					<li><strong>Usuario</strong></li>
					<li><a href="aniadir_publicacion.php">Añadir publicación</a></li>
					<li><a href="editar_publicacion.php">Editar publicación</a></li>
					<li><a href="aniadirProyecto.php">Añadir proyecto</a></li>
					<li><a href="editarProyecto.php">Editar proyecto</a></li>
				</ul>
			</div>

		

HTML;
}

function HTMLerror(){
echo <<< HTML
 </nav>
 </div> 
  <div class="col_der">
   <div class="error">
    <h1>No tienes permisos en esta página, redirigiendo a la página principal... </h1>
HTML;
	header("Refresh: 3, url=index.php");
echo <<< HTML
   </div>
  </div>
HTML;
}

function HTMLcol_der_inicio(){
echo <<< HTML
		</nav>
		</div> 
			<div class="col_der">
				<div class="articulos">
					<div class="introduccion">
						<p>GIRARV es un grupo de investigación dedicado al estudio de la Realidad Aumentada y la Realidad Virtual. Cómo pueden ofrecer al usuario una realidad inmersiva y en qué puede mejorar en nuestra vida cotidiana. Conseguir proyectar hologramas en la máxima resolución posible y en el mayor campo de visión es el objetivo de la Realidad Aumentada y conseguir la inmersión total es el objetivo de la Realidad Virtual. GIRARV puede hacer ese sueño posible.</p>
					</div>
					<div class="realidad_aumentada">
						<h1>Realidad Aumentada</h1>
						<img src="realidadaumentada.png" alt="ra" height="300%" width="30%"/>
						<p>La realidad aumentada (RA) es el término que se usa para definir la visión de un entorno físico del mundo real, a través de un dispositivo tecnológico, es decir, los elementos físicos tangibles se combinan con elementos virtuales, logrando de esta manera crear una realidad aumentada en tiempo real. <a href="https://es.wikipedia.org/wiki/Realidad_aumentada">Fuente(Wikipedia)</a></p>
						<p>Google Glass fue el primer dispositivo dedicado exclusivamente a la Realidad Aumentada, pero el proyecto se canceló. Hay software GPS que permite visualizar gracias a la cámara, el camino a seguir hacia un destino. También hay juegos como Pokémon Go (imagen a la derecha) en el que puedes atrapar a las criaturas en tu entorno gracias a la cámara del dispositivo móvil.</p>
					</div>
					<div class="realidad_virtual">
						<h1>Realidad Virtual</h1>
						<img src="realidadvirtual.jpg" alt="rv" height="300%" width="30%"/>
						<p>La realidad virtual (RV) es un entorno de escenas u objetos de apariencia real. La acepción más común refiere a un entorno generado mediante tecnología informática, que crea en el usuario la sensación de estar inmerso en él. Dicho entorno es contemplado por el usuario a través normalmente de un dispositivo conocido como gafas o casco de realidad virtual. Este puede ir acompañado de otros dispositivos, como guantes o trajes especiales, que permiten una mayor interacción con el entorno así como la percepción de diferentes estímulos que intensifican la sensación de realidad. <a href="https://es.wikipedia.org/wiki/Realidad_virtual">Fuente(Wikipedia)</a></p>
						<p>Los dispositivos más famosos son Oculus Rift, Samsung Gear VR, Playstation VR, Hololens, etc. </p>
					</div>
				</div>	
			</div>


HTML;
}

function HTMLbuscar(){
echo <<< HTML
 </nav>
  </div> 
   <div class="col_der">
   <div class="buscador">
    Elige el orden de búsqueda
    <form action="" method="POST">
              <select name="option">
      <option value ="autor">Autor</option>
      <option value ="fecha">Fecha</option>
      <option value ="clave">Palabras clave</option>
     </select>
              <input type="submit" value="Buscar" name="search">
    </form>
   </div>
   </div>
HTML;
}


function FORM_buscarUsuario($titulo, $datos=false){
	$bnombre = isset($datos['bnombre']) ? " value='{$datos['bnombre']}' " : '';
	$bespecialidad = isset($datos['bespecialidad']) ? " value='{$datos['bespecialidad']}' " : '';
	$bdireccion = isset($datos['bdireccion']) ? " value='{$datos['bdireccion']}' " : '';
	$bhobbies = isset($datos['bhobbies']) ? " value='{$datos['bhobbies']}' " : '';
echo <<< HTML
<div class='frm_usuario'> <form action='' method='POST'> <h3>$titulo</h3>
<div class='frm_usuario_input'> <label for='usu_nombre'>Nombre:</label>
<input type='text' name='usu_nombre' $bnombre/> </div>
<div class='frm_usuario_input'> <label for='usu_especialidad'>Especialidad:</label>
<input type='text' name='usu_especialidad' $bespecialidad/> </div>
<div class='frm_usuario_input'> <label for='usu_direccion'>Direccion:</label>
<input type='text' name='usu_direccion' $bdireccion/> </div>
<div class='frm_usuario_input'> <label for='usu_hobbies'>Hobbies:</label>
<input type='text' name='usu_hobbies' $bhobbies/> </div>
<div class='frm_usuario_input'>
<input type='submit' name='accion' value='Buscar' /> </div> </form> </div>
HTML;
}

function FORM_listadoLog($datos) {
echo <<< HTML
		</nav>
		</div> 
			<div class="col_der">
				<div class='log'> <table> <tr>
				<th>Usuario</th> <th>Acción</th> <th>Resultado</th> <th>Fecha</th></tr>
HTML;
				foreach ($datos as $v) {
				echo '<tr>';
				echo "<td class='log_usuario'>{$v['usuario']}</td>";
				echo "<td class='log_accion'>{$v['accion']}</td>";
				echo "<td class='log_resultado'>{$v['resultado']}</td>";
				echo "<td class='log_fecha'>{$v['fecha']}</td>";
				echo '</tr>';
				}
echo <<< HTML
				</table>
				</div>
			</div>

HTML;
}


function FORM_listadoUsuarios($datos) {
echo <<< HTML
		</nav>
		</div> 
			<div class="col_der">
				<div class='miembros'> <table> <tr>
				<th>Nombre</th> <th>Especialidad</th> <th>Direccion</th> <th>Hobbies</th></tr>
HTML;
				foreach ($datos as $v) {
				echo '<tr>';
				echo "<td class='usu_nombre'>{$v['name']}</td>";
				echo "<td class='usu_especialidad'>{$v['especialidad']}</td>";
				echo "<td class='usu_direccion'>{$v['direccion']}</td>";
				echo "<td class='hobbies'>{$v['hobbies']}</td>";
				echo '</tr>';
				}
echo <<< HTML
				</table>
				</div>
			</div>

HTML;
}

function FORM_listadoUsuariosBotones($datos, $accion) {

echo <<< HTML
		</nav>
		</div> 
			<div class="col_der">
				<div class='listado'> <table> <tr>
				<th>Nombre</th> <th>Especialidad</th> <th>Direccion</th> <th>Hobbies</th> <th>Acción</th></tr>
HTML;
				foreach ($datos as $v) {
					echo "<tr>";
					echo "	<td class='usu_nombre'>{$v['name']}</td>";
					echo "	<td class='usu_especialidad'>{$v['especialidad']}</td>";
					echo "	<td class='usu_direccion'>{$v['direccion']}</td>";
					echo "	<td class='usu_hobbies'>{$v['hobbies']}</td>";
					echo "	<td class='usu_botones'><form action='$accion' method='POST'>
							<input type='hidden' name='id' value='{$v['id']}' />
							<input type='submit' name='accion' value='Editar' />
							<input type='submit' name='accion' value='Borrar' />
						</form></td>";
//					echo "<td> el id es:".$v['id']."</td>";
					echo '</tr>';
				}

				echo "</table></div></div>";
	
	
}

function FORM_listadoArticulosBotones($datos, $accion) {

echo <<< HTML
		</nav>
		</div> 
			<div class="col_der">
				<div class='listado'> <table> <tr>
				<th>DOI</th> <th>Autores</th> <th>Fecha de publicacion</th> <th>Resumen</th> <th>Acción</th></tr>
HTML;
				foreach ($datos as $v) {
					echo "<tr>";
					echo "	<td class='art_DOI'>{$v['DOI']}</td>";
					echo "	<td class='art_autores'>{$v['autores']}</td>";
					echo "	<td class='art_fechaPub'>{$v['fechaPublicacion']}</td>";
					echo "	<td class='art_resumen'>{$v['resumen']}</td>";
					echo "	<td class='art_botones'><form action='$accion' method='POST'>
							<input type='hidden' name='id' value='{$v['idPost']}' />
							<input type='submit' name='accion' value='Editar' />
							<input type='submit' name='accion' value='Borrar' />
						</form></td>";
					echo '</tr>';
				}

				echo "</table></div></div>";
	
	
}

function FORM_listadoLibrosBotones($datos, $accion) {

echo <<< HTML
		</nav>
		</div> 
			<div class="col_der">
				<div class='listado'> <table> <tr>
				<th>ISBN</th> <th>Título</th> <th>Autores</th> <th>Fecha de publicacion</th> <th>Acción</th></tr>
HTML;
				foreach ($datos as $v) {
					echo "<tr>";
					echo "	<td class='lib_ISBN'>{$v['ISBN']}</td>";
					echo "	<td class='lib_tituloTrabajo'>{$v['tituloTrabajo']}</td>";
					echo "	<td class='lib_autores'>{$v['autores']}</td>";
					echo "	<td class='lib_fechaPub'>{$v['fechaPublicacion']}</td>";
					echo "	<td class='lib_botones'><form action='$accion' method='POST'>
							<input type='hidden' name='id' value='{$v['idPost']}' />
							<input type='submit' name='accion' value='Editar' />
							<input type='submit' name='accion' value='Borrar' />
						</form></td>";
					echo '</tr>';
				}

				echo "</table></div></div>";
	
	
}

function FORM_listadoCapitulosBotones($datos, $accion) {

echo <<< HTML
		</nav>
		</div> 
			<div class="col_der">
				<div class='listado'> <table> <tr>
				<th>DOI</th> <th>Título del trabajo</th> <th>Resumen</th> <th>ISBN</th> <th>Acción</th></tr>
HTML;
				foreach ($datos as $v) {
					echo "<tr>";
					echo "	<td class='cap_DOI'>{$v['DOI']}</td>";
					echo "	<td class='cap_tituloTrabajo'>{$v['tituloTrabajo']}</td>";
					echo "	<td class='cap_resumen'>{$v['resumen']}</td>";
					echo "	<td class='cap_ISBN'>{$v['ISBN']}</td>";
					echo "	<td class='cap_botones'><form action='$accion' method='POST'>
							<input type='hidden' name='id' value='{$v['idPost']}' />
							<input type='submit' name='accion' value='Editar' />
							<input type='submit' name='accion' value='Borrar' />
						</form></td>";
					echo '</tr>';
				}

				echo "</table></div></div>";
	
	
}

function FORM_listadoConferenciasBotones($datos, $accion) {

echo <<< HTML
		</nav>
		</div> 
			<div class="col_der">
				<div class='listado'> <table> <tr>
				<th>DOI</th> <th>Nombre de la conferencia</th> <th>Fecha de publicacion</th> <th>Lugar</th> <th>Acción</th></tr>
HTML;
				foreach ($datos as $v) {
					echo "<tr>";
					echo "	<td class='con_DOI'>{$v['DOI']}</td>";
					echo "	<td class='con_nombreConf'>{$v['nombreConf']}</td>";
					echo "	<td class='con_fechaPub'>{$v['fechaPublicacion']}</td>";
					echo "	<td class='con_lugar'>{$v['lugar']}</td>";
					echo "	<td class='con_botones'><form action='$accion' method='POST'>
							<input type='hidden' name='id' value='{$v['idPost']}' />
							<input type='submit' name='accion' value='Editar' />
							<input type='submit' name='accion' value='Borrar' />
						</form></td>";
					echo '</tr>';
				}

				echo "</table></div></div>";
	
	
}

function FORM_listadoProyectosBotones($datos, $accion) {

echo <<< HTML
		</nav>
		</div> 
			<div class="col_der">
				<div class='listado'> <table> <tr>
				<th>Código</th> <th>Título</th> <th>Comienza</th> <th>Finaliza</th> <th>Cuantía</th> <th>Acción</th></tr>
HTML;
				foreach ($datos as $v) {
					echo "<tr>";
					echo "	<td class='pro_codigo'>{$v['codigo']}</td>";
					echo "	<td class='pro_titulo'>{$v['titulo']}</td>";
					echo "	<td class='pro_fechaComienzo'>{$v['fechaComienzo']}</td>";
					echo "	<td class='pro_fechaFinalizacion'>{$v['fechaFinalizacion']}</td>";
					echo "	<td class='pro_cuantia'>{$v['cuantia']}</td>";
					echo "	<td class='pro_botones'><form action='$accion' method='POST'>
							<input type='hidden' name='id' value='{$v['idPost']}' />
							<input type='submit' name='accion' value='Editar' />
							<input type='submit' name='accion' value='Borrar' />
						</form></td>";
					echo '</tr>';
				}

				echo "</table></div></div>";
	
	
}

function FORM_addUsuario($titulo,$datos,$accion) {
echo <<< HTML
	</nav>
	</div> 





<script type="text/javascript">
function valida(f) {
  var ok = true;
  var msg = "No puedes dejar los campos incompletos:\n";
  if(f.elements[0].value == "")
  {
    msg += "- name\n";
    ok = false;
  }

  if(f.elements[1].value == "")
  {
    msg += "- especialidad\n";
    ok = false;
  }

  if(f.elements[2].value == "")
  {
    msg += "- direccion\n";
    ok = false;
  }

  if(f.elements[3].value == "")
  {
    msg += "- hobbies\n";
    ok = false;
  }

  if(f.elements[4].value == "")
  {
    msg += "- password\n";
    ok = false;
  }

  if(ok == false)
    alert(msg);
  return ok;
}
</script>





	<div class="col_der">
		<div class='miembros'>
HTML;


	if (isset($datos['editable']) && $datos['editable']==false)
	$disabled='readonly="readonly"';
	else
	$disabled='';
echo <<< HTML
<form action="" method="POST" onsubmit="return valida(this)">
	<div class='frm_user'>
	<h3>$titulo</h3>

	<input type='hidden' name='usu_usuario' value='{$datos["usuario"]}'/>

	<div class='frm_user_input'><label for='user_nombre'>Nombre:</label>
	<input type='text' name='usu_nombre' value='{$datos["name"]}'' $disabled/></div>

	<div class='frm_user_input'> <label for='user_especialidad'>Especialidad:</label>
	<input type='text' name='usu_especialidad' value='{$datos["especialidad"]}' $disabled/></div>

	<div class='frm_user_input'> <label for='user_direccion'>Direccion:</label>
	<input type='text' name='usu_direccion' value='{$datos["direccion"]}' $disabled/></div>

	<div class='frm_user_input'> <label for='user_hobbies'>Hobbies:</label>
	<input type='text' name='usu_hobbies' value='{$datos["hobbies"]}' $disabled/></div>

	<div class='frm_user_input'> <label for='user_password'>Contraseña:</label>
	<input type='password' name='usu_password' value='{$datos["password"]}' $disabled/></div>

	<div class='frm_user_submit'> <input type='submit' name='accion' value='Añadir Usuario' />
	<input type='submit' name='accion' value='Cancelar' /></div>
	 </div>
</form>
	</div>
	</div>
	
HTML;
}

function FORM_addArticulo($titulo,$datos,$accion) {



echo <<< HTML

	

	</nav>
	</div> 



<script type="text/javascript">
function valida(f) {
  var ok = true;
  var msg = "Campos incompletos:\n";
  if(f.elements[0].value == "")
  {
    msg += "- name\n";
    ok = false;
  }

  if(f.elements[1].value == "")
  {
    msg += "- DOI\n";
    ok = false;
  }

  if(f.elements[2].value == "")
  {
    msg += "- autores\n";
    ok = false;
  }


  if(f.elements[4].value == "")
  {
    msg += "- resumen\n";
    ok = false;
  }

  if(f.elements[5].value == "")
  {
    msg += "- nombreRevista\n";
    ok = false;
  }

  if(f.elements[6].value == "")
  {
    msg += "- volumen\n";
    ok = false;
  }

  if(f.elements[7].value == "")
  {
    msg += "- paginas\n";
    ok = false;
  }

  if(f.elements[8].value == "")
  {
    msg += "- palabrasClave\n";
    ok = false;
  }

  if(f.elements[9].value == "")
  {
    msg += "- URL\n";
    ok = false;
  }



  if(ok == false)
    alert(msg);
  return ok;
}
</script>


	<div class="col_der">
		<div class='miembros'>
HTML;


	if (isset($datos['editable']) && $datos['editable']==false)
	$disabled='readonly="readonly"';
	else
	$disabled='';
echo <<< HTML
<form action="" method="POST" onsubmit="return valida(this)">
	<div class='frm_art'>
	<h3>$titulo</h3>
	<input type='hidden' name='id' value='{$datos["id"]}'/>

	<input type='hidden' name='art_name' value='{$datos["name"]}'/>

	<div class='frm_art_input'><label for='artic_DOI'>DOI:</label>
	<input type='number' name='art_DOI' value='{$datos["DOI"]}'' $disabled/></div>

	<div class='frm_art_input'> <label for='artic_autores'>Autores:</label>
	<input type='text' name='art_autores' value='{$datos["autores"]}' $disabled/></div>

	<div class='frm_art_input'> <label for='artic_fechaPub'>Fecha de publicación:</label>
	<input type='date' name='art_fechaPub' value='{$datos["fechaPublicacion"]}' $disabled/></div>

	<div class='frm_art_input'> <label for='artic_resumen'>Resumen:</label>
	<input type='text' name='art_resumen' value='{$datos["resumen"]}' $disabled/></div>

	<div class='frm_art_input'> <label for='artic_nombreRevista'>Nombre revista:</label>
	<input type='text' name='art_nombreRevista' value='{$datos["nombreRevista"]}' $disabled/></div>

	<div class='frm_art_input'> <label for='artic_volumen'>Volúmen:</label>
	<input type='text' name='art_volumen' value='{$datos["volumen"]}' $disabled/></div>

	<div class='frm_art_input'> <label for='artic_paginas'>Páginas:</label>
	<input type='number' name='art_paginas' value='{$datos["paginas"]}' $disabled/></div>

	<div class='frm_art_input'> <label for='artic_palabrasClave'>Palabras clave:</label>
	<input type='text' name='art_palabrasClave' value='{$datos["palabrasClave"]}' $disabled/></div>

	<div class='frm_art_input'> <label for='artic_URL'>URL:</label>
	<input type='text' name='art_URL' value='{$datos["URL"]}' $disabled/></div>

	<div class='frm_art_submit'> <input type='submit' name='accion' value='Añadir Articulo' />
	<input type='submit' name='accion' value='Cancelar' /></div>
	 </div>
</form>
	</div>
	</div>
	
HTML;
//	echo "<br>2.5:'{$datos["name"]}'";
}

function FORM_addLibro($titulo,$datos,$accion) {



echo <<< HTML

	

	</nav>
	</div> 

	<div class="col_der">
		<div class='miembros'>
HTML;


	if (isset($datos['editable']) && $datos['editable']==false)
	$disabled='readonly="readonly"';
	else
	$disabled='';
echo <<< HTML
<form action="" method="POST" onsubmit="return valida(this)">
	<div class='frm_lib'>
	<h3>$titulo</h3>
	<input type='hidden' name='id' value='{$datos["id"]}'/>

	<input type='hidden' name='lib_name' value='{$datos["name"]}'/>

	<div class='frm_lib_input'><label for='artic_DOI'>DOI:</label>
	<input type='number' name='lib_DOI' value='{$datos["DOI"]}'' $disabled/></div>

	<div class='frm_lib_input'><label for='libro_tituloTrabajo'>Título del trabajo:</label>
	<input type='text' name='lib_tituloTrabajo' value='{$datos["tituloTrabajo"]}'' $disabled/></div>

	<div class='frm_lib_input'> <label for='libro_autores'>Autores:</label>
	<input type='text' name='lib_autores' value='{$datos["autores"]}' $disabled/></div>

	<div class='frm_lib_input'> <label for='libro_fechaPub'>Fecha de publicación:</label>
	<input type='date' name='lib_fechaPub' value='{$datos["fechaPublicacion"]}' $disabled/></div>

	<div class='frm_lib_input'> <label for='libro_resumen'>Resumen:</label>
	<input type='text' name='lib_resumen' value='{$datos["resumen"]}' $disabled/></div>

	<div class='frm_lib_input'> <label for='libro_editorial'>Editorial:</label>
	<input type='text' name='lib_editorial' value='{$datos["editorial"]}' $disabled/></div>

	<div class='frm_lib_input'> <label for='libro_editor'>Editor:</label>
	<input type='text' name='lib_editor' value='{$datos["editor"]}' $disabled/></div>

	<div class='frm_lib_input'> <label for='libro_ISBN'>ISBN:</label>
	<input type='number' name='lib_ISBN' value='{$datos["ISBN"]}' $disabled/></div>

	<div class='frm_lib_input'> <label for='libro_palabrasClave'>Palabras clave:</label>
	<input type='text' name='lib_palabrasClave' value='{$datos["palabrasClave"]}' $disabled/></div>

	<div class='frm_lib_input'> <label for='libro_URL'>URL:</label>
	<input type='text' name='lib_URL' value='{$datos["URL"]}' $disabled/></div>

	<div class='frm_lib_input'> <input type='submit' name='accion' value='Añadir Libro' />
	<input type='submit' name='accion' value='Cancelar' /></div>
	 </div>
</form>
	</div>
	</div>
	
HTML;

}


function FORM_addCapitulo($titulo,$datos,$accion) {



echo <<< HTML

	

	</nav>
	</div> 

	<div class="col_der">
		<div class='miembros'>
HTML;


	if (isset($datos['editable']) && $datos['editable']==false)
	$disabled='readonly="readonly"';
	else
	$disabled='';
echo <<< HTML
<form action="" method="POST" onsubmit="return valida(this)">
	<div class='frm_cap'>
	<h3>$titulo</h3>
	<input type='hidden' name='id' value='{$datos["id"]}'/>

	<input type='hidden' name='cap_name' value='{$datos["name"]}'/>

	<div class='frm_cap_input'><label for='capitulo_DOI'>DOI:</label>
	<input type='number' name='cap_DOI' value='{$datos["DOI"]}'' $disabled/></div>

	<div class='frm_cap_input'><label for='capitulo_tituloTrabajo'>Título del trabajo:</label>
	<input type='text' name='cap_tituloTrabajo' value='{$datos["tituloTrabajo"]}'' $disabled/></div>

	<div class='frm_cap_input'> <label for='capitulo_autores'>Autores:</label>
	<input type='text' name='cap_autores' value='{$datos["autores"]}' $disabled/></div>

	<div class='frm_cap_input'> <label for='capitulo_fechaPub'>Fecha de publicación:</label>
	<input type='date' name='cap_fechaPub' value='{$datos["fechaPublicacion"]}' $disabled/></div>

	<div class='frm_cap_input'> <label for='capitulo_resumen'>Resumen:</label>
	<input type='text' name='cap_resumen' value='{$datos["resumen"]}' $disabled/></div>

	<div class='frm_cap_input'> <label for='capitulo_tituloLibro'>Título del libro:</label>
	<input type='text' name='cap_tituloLibro' value='{$datos["tituloLibro"]}' $disabled/></div>

	<div class='frm_cap_input'> <label for='capitulo_editorial'>Editorial:</label>
	<input type='text' name='cap_editorial' value='{$datos["editorial"]}' $disabled/></div>

	<div class='frm_cap_input'> <label for='capitulo_editor'>Editor:</label>
	<input type='text' name='cap_editor' value='{$datos["editor"]}' $disabled/></div>

	<div class='frm_cap_input'> <label for='capitulo_ISBN'>ISBN:</label>
	<input type='number' name='cap_ISBN' value='{$datos["ISBN"]}' $disabled/></div>

	<div class='frm_cap_input'> <label for='capitulo_paginaCapitulo'>Página del capítulo:</label>
	<input type='number' name='cap_paginaCapitulo' value='{$datos["pagCap"]}' $disabled/></div>

	<div class='frm_cap_input'> <label for='capitulo_palabrasClave'>Palabras clave:</label>
	<input type='text' name='cap_palabrasClave' value='{$datos["palabrasClave"]}' $disabled/></div>

	<div class='frm_cap_input'> <label for='capitulo_URL'>URL:</label>
	<input type='text' name='cap_URL' value='{$datos["URL"]}' $disabled/></div>

	<div class='frm_cap_input'> <input type='submit' name='accion' value='Añadir Capitulo' />
	<input type='submit' name='accion' value='Cancelar' /></div>
	 </div>
</form>
	</div>
	</div>
	
HTML;

}

function FORM_addConferencia($titulo,$datos,$accion) {



echo <<< HTML

	

	</nav>
	</div> 

	<div class="col_der">
		<div class='miembros'>
HTML;


	if (isset($datos['editable']) && $datos['editable']==false)
	$disabled='readonly="readonly"';
	else
	$disabled='';
echo <<< HTML
<form action="" method="POST" onsubmit="return valida(this)">
	<div class='frm_con'>
	<h3>$titulo</h3>
	<input type='hidden' name='id' value='{$datos["id"]}'/>

	<input type='hidden' name='con_name' value='{$datos["name"]}'/>

	<div class='frm_con_input'><label for='confer_DOI'>DOI:</label>
	<input type='number' name='con_DOI' value='{$datos["DOI"]}'' $disabled/></div>

	<div class='frm_con_input'><label for='confer_tituloTrabajo'>Título del trabajo:</label>
	<input type='text' name='con_tituloTrabajo' value='{$datos["tituloTrabajo"]}'' $disabled/></div>

	<div class='frm_con_input'> <label for='confer_autores'>Autores:</label>
	<input type='text' name='con_autores' value='{$datos["autores"]}' $disabled/></div>

	<div class='frm_con_input'> <label for='confer_fechaPub'>Fecha de publicación:</label>
	<input type='date' name='con_fechaPub' value='{$datos["fechaPublicacion"]}' $disabled/></div>

	<div class='frm_con_input'> <label for='confer_resumen'>Resumen:</label>
	<input type='text' name='con_resumen' value='{$datos["resumen"]}' $disabled/></div>

	<div class='frm_con_input'> <label for='confer_nombreConf'>Nombre de la conferencia:</label>
	<input type='text' name='con_nombreConf' value='{$datos["nombreConf"]}' $disabled/></div>

	<div class='frm_con_input'> <label for='confer_lugar'>Lugar de la conferencia:</label>
	<input type='text' name='con_lugar' value='{$datos["lugar"]}' $disabled/></div>

	<div class='frm_con_input'> <label for='confer_reseniaPub'>Reseña de la publicación:</label>
	<input type='text' name='con_reseniaPub' value='{$datos["reseniaPub"]}' $disabled/></div>

	<div class='frm_con_input'> <label for='confer_palabrasClave'>Palabras clave:</label>
	<input type='text' name='con_palabrasClave' value='{$datos["palabrasClave"]}' $disabled/></div>

	<div class='frm_con_input'> <label for='confer_URL'>URL:</label>
	<input type='text' name='con_URL' value='{$datos["URL"]}' $disabled/></div>

	<div class='frm_con_input'> <input type='submit' name='accion' value='Añadir Conferencia' />
	<input type='submit' name='accion' value='Cancelar' /></div>
	 </div>
</form>
	</div>
	</div>
	
HTML;

}

function FORM_addProyecto($titulo,$datos,$accion) {



echo <<< HTML

	

	</nav>
	</div> 

	<div class="col_der">
		<div class='miembros'>
HTML;


	if (isset($datos['editable']) && $datos['editable']==false)
	$disabled='readonly="readonly"';
	else
	$disabled='';
echo <<< HTML
<form action="" method="POST" onsubmit="return valida(this)">
	<div class='frm_pro'>
	<h3>$titulo</h3>
	<input type='hidden' name='id' value='{$datos["id"]}'/>

	<input type='hidden' name='pro_name' value='{$datos["name"]}'/>

	<div class='frm_pro_input'><label for='proyecto_codigo'>Código del proyecto:</label>
	<input type='number' name='pro_codigo' value='{$datos["codigo"]}'' $disabled/></div>

	<div class='frm_pro_input'><label for='proyecto_titulo'>Título del proyecto:</label>
	<input type='text' name='pro_titulo' value='{$datos["titulo"]}'' $disabled/></div>

	<div class='frm_pro_input'> <label for='proyecto_descripcion'>Descripción:</label>
	<input type='text' name='pro_descripcion' value='{$datos["descripcion"]}' $disabled/></div>

	<div class='frm_pro_input'> <label for='proyecto_fechaComienzo'>Fecha de comienzo:</label>
	<input type='date' name='pro_fechaComienzo' value='{$datos["fechaComienzo"]}' $disabled/></div>

	<div class='frm_pro_input'> <label for='proyecto_fechaFinalizacion'>Fecha de finalización:</label>
	<input type='date' name='pro_fechaFinalizacion' value='{$datos["fechaFinalizacion"]}' $disabled/></div>

	<div class='frm_pro_input'> <label for='proyecto_entidadesColaboradoras'>Entidades colaboradoras:</label>
	<input type='text' name='pro_entidadesColaboradoras' value='{$datos["entidadesColaboradoras"]}' $disabled/></div>

	<div class='frm_pro_input'> <label for='proyecto_cuantia'>Cuantía concedida:</label>
	<input type='number' name='pro_cuantia' value='{$datos["cuantia"]}' $disabled/></div>

	<div class='frm_pro_input'> <label for='proyecto_investigadorPrincipal'>Investigador principal:</label>
	<input type='text' name='pro_investigadorPrincipal' value='{$datos["investigadorPrincipal"]}' $disabled/></div>

	<div class='frm_pro_input'> <label for='proyecto_investigadoresColaboradores'>Investigadores colaboradores:</label>
	<input type='text' name='pro_investigadoresColaboradores' value='{$datos["investigadoresColaboradores"]}' $disabled/></div>

	<div class='frm_pro_input'> <label for='proyecto_URL'>URL:</label>
	<input type='text' name='pro_URL' value='{$datos["URL"]}' $disabled/></div>

	<div class='frm_pro_input'> <input type='submit' name='accion' value='Añadir Proyecto' />
	<input type='submit' name='accion' value='Cancelar' /></div>
	 </div>
</form>
	</div>
	</div>
	
HTML;

}


function FORM_addPublicacion($titulo,$datos,$accion) {
echo <<< HTML
	</nav>
	</div> 
	<div class="col_der">
		<div class='miembros'>
HTML;


	if (isset($datos['editable']) && $datos['editable']==false)
	$disabled='readonly="readonly"';
	else
	$disabled='';
echo <<< HTML
<form action="addPublicacion.php" method="POST">
	<div class='frm_user'>
	<h3>$titulo</h3>
	
	<input type='hidden' name='name' value='{$datos["name"]}'/>

	<div class='frm_user_input'><label for='publi_contenido'>Contenido:</label>
	<input type='text' name='pub_contenido' value='{$datos["contenido"]}'' $disabled/></div>

	<div class='frm_user_submit'> <input type='submit' name='accion' value='Añadir Publicacion' />
	<input type='submit' name='accion' value='Cancelar' /></div>
	 </div>
</form>
	</div>
	</div>
	
HTML;
}


function FORM_editUsuario($titulo,$datos,$accion) {
echo <<< HTML
	</nav>
	</div> 
	<div class="col_der">
		<div class='miembros'>

HTML;


	if(isset($datos['editable']) && $datos['editable']==false)
		$disabled='readonly="readonly"';
	else
		$disabled='';
//	echo "NOMBRE ES: ".$datos['name'];
echo <<< HTML


	<form action='{$_SERVER["PHP_SELF"]}' method='POST'>
		<div class='frm_user'>
	<h3>$titulo</h3>

	<input type='hidden' name='id' value='{$datos["id"]}'/>


	<div class='frm_user_input'><label for='user_nombre'>Nombre:</label>
	<input type='text' name='usu_nombre' value='{$datos["name"]}' $disabled/></div>


	<div class='frm_user_input'><label for='user_password'>Contraseña:</label>
	<input type='password' name='usu_password' value='' $disabled/></div>

	<div class='frm_user_input'> <label for='user_especialidad'>Especialidad:</label>
	<input type='text' name='usu_especialidad' value='{$datos["especialidad"]}' $disabled/></div>

	<div class='frm_user_input'> <label for='user_direccion'>Direccion:</label>
	<input type='text' name='usu_direccion' value='{$datos["direccion"]}' $disabled/></div>

	<div class='frm_user_input'> <label for='user_hobbies'>Hobbies:</label>
	<input type='text' name='usu_hobbies' value='{$datos["hobbies"]}' $disabled/></div>

	<div class='frm_user_submit'> 
	<input type='submit' name='accion' value='$accion' />
	<input type='submit' name='accion' value='Cancelar' /></div>
	 </div>
</form>
	</div>
	</div>
	
HTML;
}

function FORM_editArticulo($titulo,$datos,$accion) {
echo <<< HTML
	</nav>
	</div> 
	<div class="col_der">
		<div class='articulos'>

HTML;


	if(isset($datos['editable']) && $datos['editable']==false)
		$disabled='readonly="readonly"';
	else
		$disabled='';
echo <<< HTML


	<form action='{$_SERVER["PHP_SELF"]}' method='POST'>
		<div class='frm_art'>
	<h3>$titulo</h3>

	<input type='hidden' name='id' value='{$datos["id"]}'/>

	<div class='frm_art_input'><label for='artic_DOI'>DOI:</label>
	<input type='number' name='art_DOI' value='{$datos["DOI"]}'' $disabled/></div>

	<div class='frm_art_input'><label for='artic_autores'>Autores:</label>
	<input type='text' name='art_autores' value='{$datos["autores"]}' $disabled/></div>

	<div class='frm_art_input'> <label for='artic_fechaPub'>Fecha de publicación:</label>
	<input type='date' name='art_fechaPub' value='{$datos["fechaPublicacion"]}' $disabled/></div>

	<div class='frm_art_input'> <label for='artic_resumen'>Resumen:</label>
	<input type='text' name='art_resumen' value='{$datos["resumen"]}' $disabled/></div>

	<div class='frm_art_input'> <label for='artic_nombreRevista'>Nombre de la revista:</label>
	<input type='text' name='art_nombreRevista' value='{$datos["nombreRevista"]}' $disabled/></div>

	<div class='frm_art_input'> <label for='artic_volumen'>Volúmen:</label>
	<input type='text' name='art_volumen' value='{$datos["volumen"]}' $disabled/></div>

	<div class='frm_art_input'> <label for='artic_paginas'>Páginas:</label>
	<input type='number' name='art_paginas' value='{$datos["paginas"]}' $disabled/></div>

	<div class='frm_art_input'> <label for='artic_palabrasClave'>Palabras clave:</label>
	<input type='text' name='art_palabrasClave' value='{$datos["palabrasClave"]}' $disabled/></div>

	<div class='frm_art_input'> <label for='artic_URL'>URL:</label>
	<input type='text' name='art_URL' value='{$datos["URL"]}' $disabled/></div>

	<div class='frm_art_submit'> 
	<input type='submit' name='accion' value='$accion' />
	<input type='submit' name='accion' value='Cancelar' /></div>
	 </div>
</form>
	</div>
	</div>
	
HTML;
}

function FORM_editLibro($titulo,$datos,$accion) {
echo <<< HTML
	</nav>
	</div> 
	<div class="col_der">
		<div class='articulos'>

HTML;


	if(isset($datos['editable']) && $datos['editable']==false)
		$disabled='readonly="readonly"';
	else
		$disabled='';
echo <<< HTML


	<form action='{$_SERVER["PHP_SELF"]}' method='POST'>
		<div class='frm_lib'>
	<h3>$titulo</h3>

	<input type='hidden' name='id' value='{$datos["id"]}'/>

	<div class='frm_lib_input'><label for='libro_DOI'>DOI:</label>
	<input type='number' name='art_DOI' value='{$datos["DOI"]}'' $disabled/></div>

	<div class='frm_lib_input'><label for='libro_tituloTrabajo'>Título del trabajo:</label>
	<input type='text' name='lib_tituloTrabajo' value='{$datos["tituloTrabajo"]}' $disabled/></div>

	<div class='frm_lib_input'><label for='libro_autores'>Autores:</label>
	<input type='text' name='lib_autores' value='{$datos["autores"]}' $disabled/></div>

	<div class='frm_lib_input'> <label for='libro_fechaPub'>Fecha de publicación:</label>
	<input type='date' name='lib_fechaPub' value='{$datos["fechaPublicacion"]}' $disabled/></div>

	<div class='frm_lib_input'> <label for='libro_resumen'>Resumen:</label>
	<input type='text' name='lib_resumen' value='{$datos["resumen"]}' $disabled/></div>

	<div class='frm_lib_input'> <label for='libro_editorial'>Editorial:</label>
	<input type='text' name='lib_editorial' value='{$datos["editorial"]}' $disabled/></div>

	<div class='frm_lib_input'> <label for='libro_editor'>Editor:</label>
	<input type='text' name='lib_editor' value='{$datos["editor"]}' $disabled/></div>

	<div class='frm_lib_input'> <label for='libro_ISBN'>ISBN:</label>
	<input type='number' name='lib_ISBN' value='{$datos["ISBN"]}' $disabled/></div>

	<div class='frm_lib_input'> <label for='libro_palabrasClave'>Palabras clave:</label>
	<input type='text' name='lib_palabrasClave' value='{$datos["palabrasClave"]}' $disabled/></div>

	<div class='frm_lib_input'> <label for='libro_URL'>URL:</label>
	<input type='text' name='lib_URL' value='{$datos["URL"]}' $disabled/></div>

	<div class='frm_lib_submit'> 
	<input type='submit' name='accion' value='$accion' />
	<input type='submit' name='accion' value='Cancelar' /></div>
	 </div>
</form>
	</div>
	</div>
	
HTML;
}

function FORM_editCapitulo($titulo,$datos,$accion) {
echo <<< HTML
	</nav>
	</div> 
	<div class="col_der">
		<div class='articulos'>

HTML;


	if(isset($datos['editable']) && $datos['editable']==false)
		$disabled='readonly="readonly"';
	else
		$disabled='';
echo <<< HTML


	<form action='{$_SERVER["PHP_SELF"]}' method='POST'>
		<div class='frm_cap'>
	<h3>$titulo</h3>

	<input type='hidden' name='id' value='{$datos["id"]}'/>

	<div class='frm_cap_input'><label for='capitulo_DOI'>DOI:</label>
	<input type='number' name='cap_DOI' value='{$datos["DOI"]}'' $disabled/></div>

	<div class='frm_cap_input'><label for='capitulo_tituloTrabajo'>Título del trabajo:</label>
	<input type='text' name='cap_tituloTrabajo' value='{$datos["tituloTrabajo"]}' $disabled/></div>

	<div class='frm_cap_input'><label for='capitulo_autores'>Autores:</label>
	<input type='text' name='cap_autores' value='{$datos["autores"]}' $disabled/></div>

	<div class='frm_cap_input'> <label for='capitulo_fechaPub'>Fecha de publicación:</label>
	<input type='date' name='cap_fechaPub' value='{$datos["fechaPublicacion"]}' $disabled/></div>

	<div class='frm_cap_input'> <label for='capitulo_resumen'>Resumen:</label>
	<input type='text' name='cap_resumen' value='{$datos["resumen"]}' $disabled/></div>

	<div class='frm_cap_input'> <label for='capitulo_tituloLibro'>Título del libro:</label>
	<input type='text' name='capitulo_tituloLibro' value='{$datos["tituloLibro"]}' $disabled/></div>

	<div class='frm_cap_input'> <label for='capitulo_editorial'>Editorial:</label>
	<input type='text' name='cap_editorial' value='{$datos["editorial"]}' $disabled/></div>

	<div class='frm_cap_input'> <label for='capitulo_editor'>Editor:</label>
	<input type='text' name='cap_editor' value='{$datos["editor"]}' $disabled/></div>

	<div class='frm_cap_input'> <label for='capitulo_ISBN'>ISBN:</label>
	<input type='text' name='cap_ISBN' value='{$datos["ISBN"]}' $disabled/></div>

	<div class='frm_cap_input'> <label for='capitulo_paginaCapitulo'>Página del capítulo:</label>
	<input type='number' name='cap_paginaCapitulo' value='{$datos["pagCap"]}' $disabled/></div>

	<div class='frm_cap_input'> <label for='capitulo_palabrasClave'>Palabras clave:</label>
	<input type='text' name='cap_palabrasClave' value='{$datos["palabrasClave"]}' $disabled/></div>

	<div class='frm_cap_input'> <label for='capitulo_URL'>URL:</label>
	<input type='text' name='cap_URL' value='{$datos["URL"]}' $disabled/></div>

	<div class='frm_cap_submit'> 
	<input type='submit' name='accion' value='$accion' />
	<input type='submit' name='accion' value='Cancelar' /></div>
	 </div>
</form>
	</div>
	</div>
	
HTML;
}

function FORM_editProyecto($titulo,$datos,$accion) {
echo <<< HTML
	</nav>
	</div> 
	<div class="col_der">
		<div class='articulos'>

HTML;


	if(isset($datos['editable']) && $datos['editable']==false)
		$disabled='readonly="readonly"';
	else
		$disabled='';
echo <<< HTML


	<form action='{$_SERVER["PHP_SELF"]}' method='POST'>
		<div class='frm_pro'>
	<h3>$titulo</h3>

	<input type='hidden' name='id' value='{$datos["id"]}'/>

	<div class='frm_pro_input'><label for='proyecto_codigo'>Código:</label>
	<input type='number' name='pro_codigo' value='{$datos["codigo"]}'' $disabled/></div>

	<div class='frm_pro_input'><label for='proyecto_titulo'>Título:</label>
	<input type='text' name='pro_titulo' value='{$datos["titulo"]}' $disabled/></div>

	<div class='frm_pro_input'> <label for='proyecto_descripcion'>Descripción:</label>
	<input type='text' name='pro_descripcion' value='{$datos["descripcion"]}' $disabled/></div>

	<div class='frm_pro_input'> <label for='proyecto_fechaComienzo'>Fecha comienzo:</label>
	<input type='date' name='pro_fechaComienzo' value='{$datos["fechaComienzo"]}' $disabled/></div>

	<div class='frm_pro_input'> <label for='proyecto_fechaFinalizacion'>Fecha finalización:</label>
	<input type='date' name='pro_fechaFinalizacion' value='{$datos["fechaFinalizacion"]}' $disabled/></div>

	<div class='frm_pro_input'> <label for='proyecto_entidadesColaboradoras'>Entidades colaboradoras:</label>
	<input type='text' name='pro_entidadesColaboradoras' value='{$datos["entidadesColaboradoras"]}' $disabled/></div>

	<div class='frm_pro_input'> <label for='proyecto_cuantia'>Cuantía:</label>
	<input type='number' name='pro_cuantia' value='{$datos["cuantia"]}' $disabled/></div>

	<div class='frm_pro_input'> <label for='proyecto_investigadorPrincipal'>Investigador principal:</label>
	<input type='text' name='pro_investigadorPrincipal' value='{$datos["investigadorPrincipal"]}' $disabled/></div>

	<div class='frm_pro_input'> <label for='proyecto_investigadoresColaboradores'>Investigadores colaboradores:</label>
	<input type='text' name='pro_investigadoresColaboradores' value='{$datos["investigadoresColaboradores"]}' $disabled/></div>

	<div class='frm_pro_input'> <label for='proyecto_URL'>URL:</label>
	<input type='text' name='pro_URL' value='{$datos["URL"]}' $disabled/></div>

	<div class='frm_pro_submit'> 
	<input type='submit' name='accion' value='$accion' />
	<input type='submit' name='accion' value='Cancelar' /></div>
	 </div>
</form>
	</div>
	</div>
	
HTML;
}

function FORM_editConferencia($titulo,$datos,$accion) {
echo <<< HTML
	</nav>
	</div> 
	<div class="col_der">
		<div class='articulos'>

HTML;


	if(isset($datos['editable']) && $datos['editable']==false)
		$disabled='readonly="readonly"';
	else
		$disabled='';
echo <<< HTML


	<form action='{$_SERVER["PHP_SELF"]}' method='POST'>
		<div class='frm_con'>
	<h3>$titulo</h3>

	<input type='hidden' name='id' value='{$datos["id"]}'/>

	<div class='frm_con_input'><label for='confer_DOI'>DOI:</label>
	<input type='number' name='con_DOI' value='{$datos["DOI"]}'' $disabled/></div>

	<div class='frm_con_input'><label for='confer_tituloTrabajo'>Título del trabajo:</label>
	<input type='text' name='con_tituloTrabajo' value='{$datos["tituloTrabajo"]}' $disabled/></div>

	<div class='frm_con_input'><label for='confer_autores'>Autores:</label>
	<input type='text' name='con_autores' value='{$datos["autores"]}' $disabled/></div>

	<div class='frm_con_input'> <label for='confer_fechaPub'>Fecha de publicación:</label>
	<input type='date' name='con_fechaPub' value='{$datos["fechaPublicacion"]}' $disabled/></div>

	<div class='frm_con_input'> <label for='confer_resumen'>Resumen:</label>
	<input type='text' name='con_resumen' value='{$datos["resumen"]}' $disabled/></div>

	<div class='frm_con_input'> <label for='confer_nombreConf'>Nombre de la conferencia:</label>
	<input type='text' name='con_nombreConf' value='{$datos["nombreConf"]}' $disabled/></div>

	<div class='frm_con_input'> <label for='confer_lugar'>Lugar:</label>
	<input type='text' name='con_lugar' value='{$datos["lugar"]}' $disabled/></div>

	<div class='frm_con_input'> <label for='confer_reseniaPub'>Reseña de la publicación:</label>
	<input type='number' name='con_reseniaPub' value='{$datos["reseniaPub"]}' $disabled/></div>

	<div class='frm_con_input'> <label for='confer_palabrasClave'>Palabras clave:</label>
	<input type='text' name='con_palabrasClave' value='{$datos["palabrasClave"]}' $disabled/></div>

	<div class='frm_con_input'> <label for='confer_URL'>URL:</label>
	<input type='text' name='con_URL' value='{$datos["URL"]}' $disabled/></div>

	<div class='frm_con_input'> 
	<input type='submit' name='accion' value='$accion' />
	<input type='submit' name='accion' value='Cancelar' /></div>
	 </div>
</form>
	</div>
	</div>
	
HTML;
}

function HTMLcol_der_publicaciones(){
echo <<< HTML
		</nav>
		</div> 
	<div class="col_der">
		<div class="publicaciones">
			<div class="publicaciones1">
				<ul>
					<li><a href="articulos.php">Ver artículos de revistas</a></li>
				</ul>
			</div>
			<div class="publicaciones2">
				<ul>
					<li><a href="libros.php">Ver libros</a></li>
				</ul>
			</div>
			<div class="publicaciones3">
				<ul>
					<li><a href="capitulos.php">Ver capítulos de libros</a></li>
				</ul>
			</div>
			<div class="publicaciones4">
				<ul>
					<li><a href="conferencias.php">Ver conferencias</a></li>
				</ul>
			</div>
		</div>
	</div>

HTML;
}
function HTMLcol_der_publicaciones_articulos($datos){
echo <<< HTML
		</nav>
		</div> 
	<div class="col_der">
		<div class="articulos">
			<a href="publicaciones.php">Ir atrás</a><br>
HTML;
				foreach ($datos as $v) {
echo<<<HTML
					
			<div class="articulo">
				<ul>
					<li><strong>DOI:  </strong>  {$v['DOI']}</li>
					<li><strong>Autores:  </strong>{$v['autores']}</li>
					<li><strong>Fecha de publicación:  </strong>{$v['fechaPublicacion']}</li>
					<li><strong>Resumen:  </strong>{$v['resumen']}</li>
					<li><strong>Nombre de la revista:  </strong>{$v['nombreRevista']}</li>
					<li><strong>Volúmen:  </strong>{$v['volumen']}</li>
					<li><strong>Páginas:  </strong>{$v['paginas']}</li>
					<li><strong>Palabras Clave:  </strong>{$v['palabrasClave']}</li>
					<li><strong>URL:  </strong>{$v['URL']}</li>
					<li><strong>Usuario:  </strong>{$v['usuario']}</li>
				</ul>
			</div>
HTML;
				}
echo <<< HTML
		</div>
	</div>
HTML;
}

function HTMLcol_der_publicaciones_libros($datos){
echo <<< HTML
		</nav>
		</div> 
	<div class="col_der">
		<div class="libros">
			<a href="publicaciones.php">Ir atrás</a><br>
HTML;
				foreach ($datos as $v) {
echo<<<HTML
			<div class="libro">
				<ul>
					<li><strong>DOI: </strong>{$v['DOI']}</li>
					<li><strong>Título del trabajo: </strong>{$v['tituloTrabajo']}</li>
					<li><strong>Autores: </strong>{$v['autores']}</li>
					<li><strong>Fecha de publicación: </strong>{$v['fechaPublicacion']}</li>
					<li><strong>Resumen: </strong>{$v['resumen']}</li>
					<li><strong>Editorial: </strong>{$v['editorial']}</li>
					<li><strong>Editor: </strong>{$v['editor']}</li>
					<li><strong>ISBN: </strong>{$v['ISBN']}</li>
					<li><strong>Palabras clave: </strong>{$v['palabrasClave']}</li>
					<li><strong>URL: </strong>{$v['URL']}</li>
					<li><strong>Usuario: </strong>{$v['usuario']}</li>
				</ul>
			</div>

HTML;
			}
echo <<< HTML
		</div>
	</div>
HTML;
}

function HTMLcol_der_publicaciones_capitulos($datos){
echo <<< HTML
		</nav>
		</div> 
	<div class="col_der">
		<div class="capitulos">
			<a href="publicaciones.php">Ir atrás</a><br>
HTML;
				foreach ($datos as $v) {
echo<<<HTML
			<div class="capLibro">
				<ul>
					<li><strong>DOI: </strong>{$v['DOI']}</li>
					<li><strong>Título del trabajo: </strong>{$v['tituloTrabajo']}</li>
					<li><strong>Autores: </strong>{$v['autores']}</li>
					<li><strong>Fecha de publicación: </strong>{$v['fechaPublicacion']}</li>
					<li><strong>Resumen: </strong>{$v['resumen']}</li>
					<li><strong>Título del libro: </strong>{$v['tituloLibro']}</li>
					<li><strong>Editorial: </strong>{$v['editorial']}</li>
					<li><strong>Editor: </strong>{$v['editor']}</li>
					<li><strong>ISBN: </strong>{$v['ISBN']}</li>
					<li><strong>Página del capítulo: </strong>{$v['pagCap']}</li>
					<li><strong>Palabras clave: </strong>{$v['palabrasClave']}</li>
					<li><strong>URL: </strong>{$v['URL']}</li>
					<li><strong>Usuario: </strong>{$v['usuario']}</li>
				</ul>
			</div>

HTML;
			}
echo <<< HTML
		</div>
	</div>
HTML;
}

function HTMLcol_der_publicaciones_conferencias($datos){
echo <<< HTML
		</nav>
		</div> 
	<div class="col_der">
		<div class="conferencias">
			<a href="publicaciones.php">Ir atrás</a><br>
HTML;
				foreach ($datos as $v) {
echo<<<HTML
			<div class="conferencia">
				<ul>
					<li><strong>DOI:</strong>{$v['DOI']}</li>
					<li><strong>Título del trabajo:</strong>{$v['tituloTrabajo']}</li>
					<li><strong>Autores:</strong>{$v['autores']}</li>
					<li><strong>Fecha de publicación:</strong>{$v['fechaPublicacion']}</li>
					<li><strong>Resumen:</strong>{$v['resumen']}</li>
					<li><strong>Nombre de la conferencia:</strong>{$v['nombreConf']}</li>
					<li><strong>Lugar:</strong>{$v['lugar']}</li>
					<li><strong>Reseña de la publicación:</strong>{$v['reseniaPub']}</li>
					<li><strong>Palabras clave:</strong>{$v['palabrasClave']}</li>
					<li><strong>URL:</strong>{$v['URL']}</li>
					<li><strong>Usuario:</strong>{$v['usuario']}</li>
				</ul>
			</div>

HTML;
			}
echo <<< HTML
		</div>
	</div>
HTML;
}


function HTMLcol_der_proyectos($datos){
echo <<< HTML
		</nav>
		</div> 
	<div class="col_der">
		<div class="conferencias">
			<a href="publicaciones.php">Ir atrás</a><br>
HTML;
				foreach ($datos as $v) {
echo<<<HTML
			<div class="conferencia">
				<ul>
					<li><strong>Código:</strong>{$v['codigo']}</li>
					<li><strong>Título:</strong>{$v['titulo']}</li>
					<li><strong>Descripción:</strong>{$v['descripcion']}</li>
					<li><strong>Fecha de comienzo:</strong>{$v['fechaComienzo']}</li>
					<li><strong>Fecha de finalización:</strong>{$v['fechaFinalizacion']}</li>
					<li><strong>Entidades colaboradoras:</strong>{$v['entidadesColaboradoras']}</li>
					<li><strong>Cuantía concedida:</strong>{$v['cuantia']}</li>
					<li><strong>Investigador principal:</strong>{$v['investigadorPrincipal']}</li>
					<li><strong>Investigadores colaboradores:</strong>{$v['investigadoresColaboradores']}</li>
					<li><strong>URL:</strong>{$v['URL']}</li>
				</ul>
			</div>

HTML;
			}
echo <<< HTML
		</div>
	</div>
HTML;
}

/*

<li><strong>Código:</strong>{$v['codigo']}</li>
					<li><strong>Título:</strong>{$v['titulo']}</li>
					<li><strong>Descripción:</strong>{$v['descripcion']}</li>
					<li><strong>Fecha de comienzo:</strong>{$v['fechaComienzo']}</li>
					<li><strong>Fecha de finalización:</strong>{$v['fechaFinalizacion']}</li>
					<li><strong>Entidades colaboradoras:</strong>{$v['entidadesColaboradoras']}</li>
					<li><strong>Cuantía concedida:</strong>{$v['cuantia']}</li>
					<li><strong>Investigador principal:</strong>{$v['investigadorPrincipal']}</li>
					<li><strong>Investigadores colaboradores:</strong>{$v['investigadoresColaboradores']}</li>
					<li><strong>URL:</strong>{$v['URL']}</li>

*/

function HTMLcol_der_contacto(){
echo <<< HTML
		</nav>
		</div> 
	<div class="col_der">
		<div class="contacto">
			<div class="contacto1">
				<ul>
					<li><strong>Correo electrónico:</strong> maxigang@correo.ugr.es</li>
					<li><strong>Teléfono de contacto:</strong> XXX-XX-XX-XX</li>
					<li><strong>Dirección del centro:</strong> Calle falsa 123, Granada</li>
				</ul>
			</div>
			<div class="contacto2">
				<ul>
					<li><strong>Correo electrónico:</strong> jacquesmeyns@correo.ugr.es</li>
					<li><strong>Teléfono de contacto:</strong> XXX-XX-XX-XX</li>
					<li><strong>Dirección del centro:</strong> Calle tocino ibérico 123, Granada</li>
				</ul>
			</div>
		</div>
	</div>
HTML;
}

function HTMLcol_der_terminos(){
echo <<< HTML
	</nav>
		</div> 
	<div class="col_der">
		<div class="terminos">
			<ul>
				<p>Esta página web ha sido creada para la asignatura de Tecnologías Web en la Escuela Técnica Superior de Ingeniería Informática y Telecomunicaciones de Granada. El uso de la página y su código es completamente libre siempre y cuando no haya ánimo de lucro de por medio.</p><br/>
					<b>Página web creada por Javier Martín Gómez y Jacques David Meyns Villaldea</b>
			</ul>
		</div>
	</div>
HTML;
}

function HTMLcol_der_editar_usuarios(){
echo <<< HTML
		</nav>
		</div> 



	<div class="col_der">
		<div class="editar_usuarios">
			<div class="añadir">
				<ul>
					<li><a href="aniadirUser.php">Añadir usuario</a></li>
				</ul>
			</div>
			<div class="editar">
				<ul>
					<li><a href="editarUser.php">Editar/Borrar usuario</a></li>
				</ul>
			</div><!--
			<div class="borrar">
				<ul>
					<li><a href="">Borrar usuario</a></li>
				</ul>
			</div>-->
		</div>
	</div>

HTML;
}

function HTMLcol_der_aniadir_publicacion(){
echo <<< HTML
		</nav>
		</div> 
	<div class="col_der">
		<div class="aniadir_publicacion">
			<div class="articulo">
				<ul>
					<li><a href="aniadirArticulo.php">Añadir articulo</a></li>
				</ul>
			</div>
			<div class="libro">
				<ul>
					<li><a href="aniadirLibro.php">Añadir libro</a></li>
				</ul>
			</div>
			<div class="capLibro">
				<ul>
					<li><a href="aniadirCapitulo.php">Añadir capítulo de un libro</a></li>
				</ul>
			</div>
			<div class="conferencia">
				<ul>
					<li><a href="aniadirConferencia.php">Añadir conferencia</a></li>
				</ul>
			</div>
		</div>
	</div>

HTML;
}

function HTMLcol_der_editar_publicaciones(){
echo <<< HTML
		</nav>
		</div> 



	<div class="col_der">
		<div class="editar_usuarios">
			<div class="editar">
				<ul>
					<li><a href="editarArticulo.php">Editar/Borrar artículo</a></li>
				</ul>
			</div>
			<div class="editar">
				<ul>
					<li><a href="editarLibro.php">Editar/Borrar libro</a></li>
				</ul>
			</div>
			<div class="editar">
				<ul>
					<li><a href="editarCapitulo.php">Editar/Borrar capítulo</a></li>
				</ul>
			</div>
			<div class="editar">
				<ul>
					<li><a href="editarConferencia.php">Editar/Borrar conferencia</a></li>
				</ul>
			</div>
		</div>
	</div>

HTML;
}

function HTMLfooter() {
echo <<< HTML
		</div>
			<footer>
				<div class="footer">
					<img src="universidad.png" alt="Universidad" height="15%" width="15%">
					<div class="texto">
						<a href="index.php">Inicio</a>
						<a href="https://www.google.es/maps/place/Av.+del+Hospicio,+Granada/@37.184007,-3.6012919,20z/data=!4m5!3m4!1s0xd71fcc2024260d3:0x7cc96e56cfff1e25!8m2!3d37.1839397!4d-3.6010183">Mapa del sitio</a>
						<a href="terminos.php">Términos de uso</a>
						<a href="contacto.php">Contacto</a><br/>
						<p>© Universidad de Granada. Cuesta del Hospicio S/N 18071. Granada. Spain<br/>
						Página web creada por Javier Martín Gómez y Jacques David Meyns Villaldea</p>
						
					</div>
				</div>

			</footer>
		</body>
	</html>
HTML;
}


	function msgCount($msg){
		if(is_array($msg))
			if(count($msg)==0)
				return 0;
			else
				return msgCount($msg[0])+msgCount(array_slice($msg,1));
		else if(!is_bool($msg))
			return 1;
		else
			return 0;
	}

	function msgError($msg){
		echo '<div class="msgerror">';
		_msgErrorR($msg);
		echo '</div>';
	}

	function _msgErrorR($msg){
		if(is_array($msg))
			foreach($msg as $v)
				_msgErrorR($v);
		else
			echo "<p>$msg</p>";
	}


?>
