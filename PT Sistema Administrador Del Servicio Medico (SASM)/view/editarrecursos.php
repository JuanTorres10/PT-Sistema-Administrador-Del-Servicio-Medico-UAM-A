<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Editar Recurso</title>
<link href="../css/estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php 
$actualizar_recurso='a';
require '../controller/usuario_c.php'?>
<?php

if(empty($_SESSION['active']))
{
	header('Location:../index.php');
}
?>
<?php require 'cabecera.php'?>
<div id="medio_edit_recu">
  <ol class="breadcrumb">
    <li><a href="../index.php">Home</a></li>
    <li class="active">Editar Recursos</li>
  </ol>
<?php require 'menu.php'?>	
	<form id="form" action="../controller/usuario_c.php" method="post">
	<input type="hidden" name="idrecurso" value="<?php echo $idrecurso; ?>">
	<label for="nombre">Nombre:</label>
	<br>
  	<input type="text" name="nombre" id="nombre" placeholder="INGRESA NOMBRE DEL RECURSO A GUARDAR" autocomplete="on" value="<?php echo $nombrerecurso; ?>">
	<br>
	<br>
	<label for="descripcion">Descripcion:</label>
	<br>
  	<input type="text" name="descripcion" id="descripcio" placeholder="INGRESA UNA DESCRIPCION DEL RECURSO" autocomplete="on" value="<?php echo $descripcionrecurso; ?>">
  	<br>
  	<br>
	<label for="cantidad">Cantidad Total</label>
	<br>
  	<input type="number" name="cantidad" id="cantidad" placeholder="INGRESA LA CANTIDAD TOTAL DEL RECURSO" autocomplete="on" min="1" step="1" value="<?php echo $cantidadtotal; ?>">
	<a href="adminrecursos.php" id="regresar_admin_recu"><input type="button" value="Regresar"></a>
	<input type="submit" id="enviar" align="middle" name="actualizar_recurso">
	<?php
		if (!empty($_GET['alerta'])) 
		{
			$alerta=$_GET['alerta'];
		}
	?>
	<div class="alerta"><?php echo isset($alerta) ? $alerta : ''; ?> </div>
	</form>
</div>	
<?php require'abajo.php'?>
</body>
</html>