<?php 

require "pag_comun.php";
require "db.php";

session_start();

if (isset($_SESSION["usuario"])) { //conectarse como usuario
        // Si la sesión está establecida
        if($_SESSION["usuario"] != "Administrador"){
            header("Refresh: 3; url=index.php");
            HTMLerror();
            exit;
        }
        $datos['name']=$_SESSION["usuario"];
    //  echo "1: '{$datos["name"]}'";
    } 
    else{
        // Si la sesión NO está establecida
        HTMLerror();
        exit;
    }
echo <<< HTML
    <h2><a href="index.php">Ir a la página principal</a></h2>
HTML;

ini_set('upload_max_filesize', '80M'); 
ini_set('post_max_size', '80M'); 
ini_set('memory_limit', '-1'); //evita el error Fatal error: Allowed memory size of X bytes exhausted (tried to allocate Y bytes)... 
ini_set('max_execution_time', 300); // es lo mismo que set_time_limit(300) ; 
ini_set('mysql.connect_timeout', 300); 
ini_set('default_socket_timeout', 300); 
//En MYSQL archivo "my.ini" ==> max_allowed_packet = 22M 
//"SET GLOBAL max_allowed_packet = 22M;" 
//"SET GLOBAL connect_timeout = 20;" 
//"SET GLOBAL net_read_timeout=50;" 
//esto no se si solo es modificable en php.ini 
ini_set('file_uploads','On');  
ini_set('upload_tmp_dir','upload'); 

function run_split_sql($uploadfile, $host, $usuario,$passwd){ 
    $strSQLs = file_get_contents($uploadfile); 
    unlink($uploadfile); 
    //  Elimina lineas vacias o que empiezan por -- #   //   o entre /* y */ 
    // Elimna los espacios en blanco entre ; y \r\n 
    // handle DOS and Mac encoded linebreaks 
                    $strSQLs=preg_replace("/\r\n$/","\n",$strSQLs); 
                    $strSQLs=preg_replace("/\r$/","\n",$strSQLs); 
    $strSQLs = trim(preg_replace('/ {2,}/', ' ', $strSQLs));    // ----- remove multiple spaces -----  
    $strSQLs = str_replace("\r","",$strSQLs);                     //los \r\n los dejamos solo en \n 
    $lines=explode("\n",$strSQLs); 
    $strSQLs = array(); 
    $in_comment = false; 
    foreach ($lines as $key => $line){ 
        $line=trim($line); //preg_replace("#.*/#","",$line) 
        $ignoralinea=(( "#" == $line[0] ) || ("--" == substr($line,0,2)) || (!$line) || ($line=="")); 
        if (!$ignoralinea){ 
            //Eliminar comentarios que empiezan por /* y terminan por */     
            if( preg_match("/^\/\*/", ($line)) )       $in_comment = true; 
            if( !$in_comment )     $strSQLs[] = $line ; 
            if( preg_match("/\*\//", ($line)) )      $in_comment = false; 
        } 
    } 
    unset($lines); 
    // Particionar en sentencias 
    $IncludeDelimiter=false; 
    $delimiter=";"; 
    $delimiterLen= 1; 
    $sql=""; 
    // CONEXION  
    $conexion = new mysqli($host, $usuario, $passwd) or die ("No se puede conectar con el servidor MySQL: %s\n". $conexion->connect_error); 
    $NumLin=0; 
    foreach ($strSQLs as $key => $line){ 
         
        if ("DELIMITER" == substr($line,0,9)){  //empieza por DELIMITER 
            $D=explode(" ",$line); 
            $delimiter= $D[1]; 
            $delimiterLen= strlen($delimiter); 
            $sql=($IncludeDelimiter)? $line ."\n" : ""; 
        }elseif (substr($line,-1*$delimiterLen) == $delimiter) { //hemos alcanzado el  Delimiter 
                if (($NumLinea++ % 100)==0) {// ver con que base de datos estamos para poder reconectar caso de error 
                        $respuesta = $conexion->query("select database() as db"); 
                        $row = $respuesta->fetch_array(MYSQLI_NUM); 
                        $db=$row[0]; 
                } 
                $sql .= ($IncludeDelimiter)? $line : substr($line,0,-1*$delimiterLen); 
                $respuesta = $conexion->query($sql); 
                if ($respuesta) echo "<br>$NumLinea Ejecutado:  ". str_replace("\n"," ",substr($sql,0,130))."..."; 
                    else { 
                        echo "<br><b><u>$NumLinea E R R O R: ".$conexion->errno." :</u></b>". $conexion->error ." ====> ". substr($sql,0,1022)."..."; 
                        if (!$conexion->ping() ){  
                            $conexion = new mysqli($host, $usuario, $passwd) or die ("No se puede RECONECTAR con el servidor MySQL: %s\n". $conexion->connect_error); 
                            $conexion->select_db($db); 
                            $respuesta = $conexion->query($sql); 
                            if ($respuesta) echo "<br>$NumLinea REEJECUTADO:  ". str_replace("\n"," ",substr($sql,0,130))."..."; 
                                else echo "<br><b><u>$NumLinea REPITE-E R R O R: ".$conexion->errno." :</u></b>". $conexion->error ." ====> ". substr($sql,0,1022)."..."; 
                        } 
                    }     
                         
                $sql=""; 
        } else { //no hemos alcanzado el delimitador el delimitador siempre debe estar al final de linea 
                $sql .= $line ."\n"; 
        } 
    } 
    $conexion->close();     
} 

if (isset($_POST['upload'])) { 
    $uploadfile = "./" . basename($_FILES['userfile']['name']); 
    print '<pre>'; 
    switch ($_FILES['userfile']['error']){ 
        case 0:// UPLOAD_ERR_OK 
            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) { 
                    echo "El archivo <b> $uploadfile </b> es válido y fue cargado exitosamente.<br>"; 
                    $host= "localhost";  //valor predeterminado  
                    $usuario=empty($_POST["usuario"])? "root":$_POST["usuario"]; //valor predeterminado 
                    $passwd= $_POST["passwd"]; 
                    run_split_sql($uploadfile, $host, $usuario,$passwd ); 
            } else     echo "<br>¡Posible error en carga de archivos! ¿Tienes permisos de root para mover archivos?"; 
            break; 
        case 1: // UPLOAD_ERR_INI_SIZE 
            echo "<br>El archivo sobrepasa el limite autorizado por el servidor(archivo php.ini) !"; 
            break; 
        case 2: // UPLOAD_ERR_FORM_SIZE 
            echo "<br>El archivo sobrepasa el limite autorizado en el formulario HTML !"; 
            break; 
        case 3: // UPLOAD_ERR_PARTIAL 
            echo "<br>El envio del archivo ha sido suspendido durante la transferencia!"; 
            break; 
        case 4: // UPLOAD_ERR_NO_FILE 
            echo "<br>El archivo que ha enviado tiene un tamaño nulo !"; 
            break; 
        default:  
            echo "<br>ERROR DESCONOCIDO !";  
            break; 
    } 
    print "</pre>"; 
    unset($_POST['upload']); 
    $_POST[]=array(); 
} 
?> 
Restaurar copia de seguridad de MYSQL (elegir fichero .sql) 
<FORM action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data"> 
    <INPUT type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAXFILESIZE?>"> 
    <INPUT type="file" name="userfile"><br /> 
    <b><u>Usuario :</u></b> <INPUT type="text" name="usuario" id ="usuario" value="root"><br /> 
    <u><b>Contraseña :</u></b> <INPUT type="text" name="passwd" id="passwd" value=""><br /> 
    <u><b>CREAR BASE DE DATOS SI NO EXISTE</u></b> (opcional): <INPUT type="text" name="bd" id="bd" value="mydb"> (este dato se usa para copias de seguridad que no tienen el nombre de la base de datos y por tanto se pueden restaurar en cualquier otra.) 
    <br /><INPUT type="submit" name="upload" value="[ Restaurar ]"> 
</FORM> 