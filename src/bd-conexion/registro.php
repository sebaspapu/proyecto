<?php

include('db.php');

$nombre=$_POST['txtNombre'];
$usuario=$_POST['txtUsuario'];
$contraseña=$_POST['txtContraseña'];

$pass_cifrado=password_hash($contraseña, PASSWORD_DEFAULT);

$consulta="INSERT INTO `usuarios` (`nombre`, `usuario`, `contraseña`)
VALUES ('$nombre', '$usuario', '$pass_cifrado');";

$resultado=mysqli_query($conexion,$consulta) or die("error de registro");

echo "registro exitoso";

mysqli_close($conexion);


?>