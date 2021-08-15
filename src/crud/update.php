<?php
	include_once 'conexion.php';

	if(isset($_GET['id'])){
		$id=(int) $_GET['id'];

		$buscar_id=$con->prepare('SELECT * FROM usuarios WHERE id=:id LIMIT 1');
		$buscar_id->execute(array(
			':id'=>$id
		));
		$resultado=$buscar_id->fetch();
	}else{
		header('Location: index.php');
	}


	if(isset($_POST['guardar'])){
		$nombre=$_POST['nombre'];
		$usuarios=$_POST['usuario'];
		$pass=$_POST['password'];
		$passHash =password_hash($pass, PASSWORD_BCRYPT);
		$id=(int) $_GET['id'];

		if(!empty($nombre) && !empty($usuarios) && !empty($passHash) ){
			
				$consulta_update=$con->prepare(' UPDATE usuarios SET  
					nombre=:nombre,
					usuario=:usuario,
					password=:password
					WHERE id=:id;'
				);
				$consulta_update->execute(array(
					':nombre' =>$nombre,
					':usuario' =>$usuarios,
					':password' =>$passHash,
					':id' =>$id
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
	<title>Editar Cliente</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<h2>CRUD EN PHP CON MYSQL</h2>
		<form action="" method="post">
			<div class="form-group">
				<input type="text" name="nombre" value="<?php if($resultado) echo $resultado['nombre']; ?>" class="input__text">
				<input type="text" name="usuario" value="<?php if($resultado) echo $resultado['usuario']; ?>" class="input__text">
			</div>
			<div class="form-group">
				<input type="password" name="password" value="<?php if($resultado) echo $resultado['password']; ?>" class="input__text">
			</div>
			
			<div class="btn__group">
				<a href="index.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
</html>
