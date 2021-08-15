
<html lang="en">
<head>
  <title>Perfil cliente</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="cliente.php">Hola cliente</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="cliente.php">Home</a></li>
      </li>
      <li><a href="#">Informes de archivos</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="cierre.php"><span class="glyphicon glyphicon-log-in"></span> Cerrar sesion</a></li>
    </ul>
  </div>
</nav>
  
<div class="container">
  <h3>Subir Archivos</h3>
  <?php
    include '/xampp/htdocs/proyecto/src/bd-conexion/db.php';
    if (isset($_POST['submit'])) {   
     if(is_uploaded_file($_FILES['fichero']['tmp_name'])) { 
     
     
      // creamos las variables para subir a la db
        $ruta = "/xampp/htdocs/proyecto/src/upload/"; 
        $nombrefinal= trim ($_FILES['fichero']['name']); //Eliminamos los espacios en blanco
        $nombrefinal= preg_replace ("/\r/", "", $nombrefinal);//Sustituye una expresión regular
        $upload= $ruta . $nombrefinal;  

        if(move_uploaded_file($_FILES['fichero']['tmp_name'], $upload)) { //movemos el archivo a su ubicacion 
                    
                    echo "<b>Upload exitoso!. Datos:</b><br>";  
                    echo "Nombre: <i><a href=\"".$ruta . $nombrefinal."\">".$_FILES['fichero']['name']."</a></i><br>";  
                    echo "Tipo MIME: <i>".$_FILES['fichero']['type']."</i><br>";  
                    echo "Peso: <i>".$_FILES['fichero']['size']." bytes</i><br>";  
                    echo "<br><hr><br>";  
                         


                   $nombre  = $_POST["nombre"]; 
                   $description  = $_POST["description"]; 


                   $query = "INSERT INTO archivos (name,description,ruta,tipo,size) 
                   VALUES ('$nombre','$description','".$nombrefinal."','".$_FILES['fichero']['type']."','".$_FILES['fichero']['size']."')"; 

    //mysqli_query($conexion,$query) or die(mysqli_error("Error de conexion")); 
    echo "El archivo '".$nombre."' se ha subido con éxito <br>";  
    mysqli_close($conexion);       
        }  
    }  
 } 
?> 

<body> 
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
<br>
    Seleccione archivo: <input name="fichero" type="file" size="150" maxlength="150">
    <br><br> Nombre: <input name="nombre" type="text" size="70" maxlength="70"> 
    <br><br> Descripcion: <input name="description" type="text" size="100" maxlength="250"> 
    <br><br> 
  <input name="submit" type="submit" value="SUBIR ARCHIVO">   
</form>  
</body>
</div>

</body>
</html>
