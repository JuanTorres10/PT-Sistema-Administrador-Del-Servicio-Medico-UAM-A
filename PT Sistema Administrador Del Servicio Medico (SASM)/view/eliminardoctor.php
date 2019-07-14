<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Eliminar Doctor</title>
<link href="../css/estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php 
$eliminar_doc='e';
require '../controller/usuario_c.php'?>
<?php 
if ($_SESSION['idrol'] != 1 && $_SESSION['idrol'] != 2) 
{
	header('Location:../view/Bienvenida.php');
}
include "../controller/conexion.php";
if(empty($_SESSION['active']))
{
	header('Location:../index.php');
}
?>
<?php require 'cabecera.php'?>
	<div id="medio">
  <ol class="breadcrumb">
    <li><a href="../index.php">Home</a></li>
    <li class="active">ELIMINAR Doctor</li>
  </ol>
<?php require 'menu.php'?>
<div id="eliminar">
  <h3 id="pregunta">¿Realmente deseas ELIMINAR este registro?</h3>
  <p id="confirmacion">Nombre: <span><?php echo $nombre; ?></span></p>
<p id="confirmacion">Especialidad: <span><?php echo $especialidad; ?></span></p>
<p id="confirmacion">Cedula Prof.: <span><?php echo $cedprof; ?></span></p>
<p id="confirmacion">Id Login: <span><?php echo $idlogin; ?></span></p>
<p id="confirmacion">Rol: <span><?php echo $descripcion; ?></span></p>
<form method="post" action="../controller/usuario_c.php" id="form">
	<input type="hidden" name="id" value="<?php echo $id ?>">
	<input type="hidden" name="login_id" value="<?php echo $login_id ?>">
	<a href="editardoctor.php" id="cancelar"><input type="button" value="Cancelar"></a>
	<input type="submit" name="eliminar_doc" value="Aceptar">
</form>
	</div>

 
</div>
	
	<?php require'abajo.php'?>
	
</body>
</html>