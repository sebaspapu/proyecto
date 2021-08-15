<?php
$usuario=$_POST['usuario'];
$contraseña=$_POST['contraseña'];
session_start();
$_SESSION['usuario']=$usuario;

$conexion=mysqli_connect("localhost","root","","nube_bd");

$consulta="SELECT*FROM usuarios where usuario='$usuario' and contraseña='$contraseña'";
$resultado=mysqli_query($conexion,$consulta);

$filas=mysqli_fetch_array($resultado);

if($filas['id']==1){ //administrador
    header("location:admin.php");

}else
if($filas['id']!=1){ //cliente
header("location:cliente.php");
}
else{
    ?>
    <?php
    include("/xampp/htdocs/proyecto/index.html");
    ?>
    <h1 class="bad">ERROR EN LA AUTENTIFICACION</h1>
    <?php    
}
mysqli_free_result($resultado);
mysqli_close($conexion);

