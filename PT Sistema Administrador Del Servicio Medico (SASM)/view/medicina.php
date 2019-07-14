<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Agregar Medicina</title>
<link href="../css/estilo.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php require '../controller/usuario_c.php'?>
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
    <li class="active">Agregar Medicina</li>
  </ol>
<?php require 'menu.php'?>
	<form id="form" action="../controller/usuario_c.php" method="post">
	<label for="nombre">Nombre:</label>
	<br>
  	<input type="text" name="nombre" id="nombre" placeholder="INGRESA NOMBRE DE LA MEDICINA A GUARDAR" autocomplete="on">
	<br>
	<br>
	<label for="descripcion">Presentacion:</label>
	<br>
  	<input type="text" name="presentacion" id="descripcio" placeholder="INGRESA UNA PRESENTACION DE LA MEDICINA" autocomplete="on">
  	<br>
  	<br>
	<label for="cantidad">Cantidad Total</label>
	<br>
  	<input type="number" name="cantidad_med" id="cantidad" placeholder="INGRESA LA CANTIDAD TOTAL DE LA MEDICINA" autocomplete="on" min="1" step="1">
	<a href="adminmedicina.php" id="regresar_med1"><input type="button" value="Regresar"></a>
	<input type="submit" id="enviar" align="middle" name="agregar_medicina">
	<?php
		if (!empty($_GET['alerta'])) 
		{
			$alerta=$_GET['alerta'];
		}
	?>
	<div class="alerta"><?php echo isset($alerta) ? $alerta : ''; ?> </div>
	</form>
<br>		  	 
</div>	
<?php require'abajo.php'?>
</body>
</html>