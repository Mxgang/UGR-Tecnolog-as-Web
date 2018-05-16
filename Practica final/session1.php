<?php
require_once "db.php";
require_once "pag_comun.php";

session_start();

$db = DB_conexion();

if(!$db)
	echo "La conexion falló";

$username = $_POST["usuario"];
$password = $_POST["password"];

	//Filtrado de entradas
	$username = trim($_POST['usuario']);
	$username = strip_tags($username);
	$username = htmlspecialchars($username);

	$password = trim($_POST['password']);
	$password = strip_tags($password);
	$password = htmlspecialchars($password);

$password = hash("sha256",$password);
$sql = "SELECT * FROM usuarios WHERE name='$username' && password='$password'";

$result = $db->query($sql);

if(!$row = mysqli_fetch_assoc($result)){
	echo '<p><h1>Username o Password incorrectos.</h1></p>';
	echo '<a href="index.php"><h1>Ir a la página principal</h1></a>';

}else{
	$_SESSION['logedin']=true;
	$_SESSION['usuario']=$username;
	$_SESSION['start']=time();
	header("Refresh: 3; url=index.php");
	echo '<p><h1>Bienvenido, has iniciado sesión</h1></p><br>';
	echo "<h1>Redirigiendo a página principal...</h1>";
	//echo '<a href="index.php"><h1>Ir a la página principal</h1></a>';
}
DB_desconexion($db);

?>
