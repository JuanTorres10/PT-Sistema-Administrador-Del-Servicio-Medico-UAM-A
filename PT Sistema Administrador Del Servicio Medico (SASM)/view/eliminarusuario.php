<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Eliminar Paciente</title>
<link href="../css/estilo.css" rel="stylesheet" type="text/css">

</head>
<body>
<?php $eliminar='e'; ?>
<?php require '../controller/usuario_c.php'?>

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
    <li class="active">ELIMINAR Paciente</li>
  </ol>
<?php require 'menu.php'?>
<div id="eliminar">
  <h3 id="pregunta">¿Realmente deseas ELIMINAR este registro?</h3>
  <p id="confirmacion">Nombre: <span><?php echo $nombre; ?></span></p>
<p id="confirmacion">Correo: <span><?php echo $correo; ?></span></p>
<p id="confirmacion">Matricula: <span><?php echo $matricula; ?></span></p>
<form method="post" action="../controller/usuario_c.php" id="form">
	<input type="hidden" name="id" value="<?php echo $id ?>">
	<a href="editarpaciente.php" id="cancelar"><input type="button" value="Cancelar"></a>
	<input type="submit" name="eliminar_usuario" value="Aceptar">
</form>
	</div>
</div>
<?php require'abajo.php'?>
</body>
</html>