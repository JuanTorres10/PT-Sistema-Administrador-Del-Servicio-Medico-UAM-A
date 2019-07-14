<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Eliminar Recurso</title>
<link href="../css/estilo.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php $eliminar_recurso='a';
require '../controller/usuario_c.php'?>
<?php 

if(empty($_SESSION['active']))
{
	header('Location:../index.php');
}
?>
<?php require 'cabecera.php'?>
	<div id="medio">
  <ol class="breadcrumb">
    <li><a href="../index.php">Home</a></li>
    <li class="active">ELIMINAR Recurso</li>
  </ol>
<?php require 'menu.php'?>
<div id="eliminar">
  <h3 id="pregunta">¿Realmente deseas ELIMINAR este registro?</h3>
  <p id="confirmacion">Nombre: <span><?php echo $nombrerecurso; ?></span></p>
<p id="confirmacion">Descripcion del recurso: <span><?php echo $descripcionrecurso; ?></span></p>
<p id="confirmacion">Cantidad: <span><?php echo $cantidadtotal; ?></span></p>
<form method="post" action="../controller/usuario_c.php" id="form">
	<input type="hidden" name="id" value="<?php echo $id ?>">
	<a href="adminrecursos.php" id="cancelar"><input type="button" value="Cancelar"></a>
	<input type="submit" name="eliminar_recurso" value="Aceptar">
</form>
	</div>
</div>
	<?php require'abajo.php'?>
</body>
</html>