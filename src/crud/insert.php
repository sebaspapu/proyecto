<?php 
	include_once 'conexion.php';
	
    if (isset($_POST['guardar'])) {
        $nombre=$_POST['nombre'];
       $usuarios=$_POST['usuario']; 
       $pass=$_POST['password'];
       $passHash =password_hash($pass, PASSWORD_BCRYPT);
        

        if (!empty($nombre) && !empty($usuarios) && !empty($passHash)/**/) { 

            $consulta_insert=$con->prepare('INSERT INTO usuarios(nombre ,usuario,password/**/) VALUES(:nombre,:usuario,:password/**/)');
            $consulta_insert->execute(array(
                    ':nombre' =>$nombre,
                    ':usuario' =>$usuarios,
                    ':password' =>$passHash,
                    
                ));
            header('Location: index.php');
        }else{
			echo "<script> alert('Los campos estan vacios');</script>";
		}
    }
		

	


?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nuevo Cliente</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<h2>CRUD EN PHP CON MYSQL</h2>
		<form action="" method="post">
			<div class="form-group">
				<input type="text" name="nombre" placeholder="Nombre" class="input__text">
				<input type="text" name="usuario" placeholder="Usuario" class="input__text">
                <input type="password" name="password" placeholder="Contraseña" class="input__text">
			</div>
			
			
			<div class="btn__group">
				<a href="index.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
</html>
