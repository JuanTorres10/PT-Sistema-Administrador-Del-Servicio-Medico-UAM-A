<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Eliminar Historial</title>
<link href="../css/estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php 
$llenar_eliminar_historial='a';
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
    <li class="active">ELIMINAR Historial</li>
  </ol>
<?php require 'menu.php'?>
<div id="eliminar">
  <h3 id="pregunta">¿Realmente deseas ELIMINAR este registro?</h3>
  <p id="confirmacion">Doctor: <span><?php echo $idlogin.'  '.$nombred.'  '.$apellidopaternod; ?></span></p>
<p id="confirmacion">Paciente: <span><?php echo $matricula.'   '.$nombrep.'   '.$apellidopaternop ?></span></p>
<p id="confirmacion">Fecha: <span><?php echo $fecha; ?></span></p>
<p id="confirmacion">Hora: <span><?php echo $hora; ?></span></p>
<p id="confirmacion">Tratamiento: <span><?php echo $tratamiento; ?></span></p>
<p id="confirmacion">Causa: <span><?php echo $nombrecausa; ?></span></p>
<p id="confirmacion">Causa Descripcion: <span><?php echo $descripcion; ?></span></p>
<form method="post" action="../controller/usuario_c.php" id="form">
	<input type="hidden" name="id" value="<?php echo $id ?>">
	<a href="adminhistorial.php" id="cancelar"><input type="button" value="Cancelar"></a>
	<input type="submit" name="eliminar_historial" value="Aceptar">
</form>
	</div>
</div>
	<?php require'abajo.php'?>
</body>
</html>