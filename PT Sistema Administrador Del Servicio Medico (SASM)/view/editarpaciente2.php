<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Editar Paciente</title>
<link href="../css/estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
 
 <?php
 $usuario='a';
include "../controller/conexion.php";
require '../controller/usuario_c.php';
if ($_SESSION['idrol'] != 1 && $_SESSION['idrol'] != 2) 
{
	header('Location:../view/Bienvenida.php');
}
if(empty($_SESSION['active']))
{
	header('Location:../index.php');
}
 ?>
<?php require 'cabecera.php'?>

<div id="medio_editar_paciente">
  <ol class="breadcrumb">
    <li><a href="../index.php">Home</a></li>
    <li class="active">Editar Paciente</li>
  </ol>
<?php require 'menu.php'?>
	<form id="form" action="../controller/usuario_c.php" method="post">

<input type="hidden" name="idpacientes" value="<?php echo $idpacientes; ?>">
	<label for="nombre">NOMBRE:</label>
		<br>
  <input type="text" name="nombre" id="nombre" placeholder="INGRESA TU NOMBRE" value="<?php echo $nombre; ?>">
	<br>
	<br>
	<label for="apellidop">APELLIDO PATERNO:</label>
		<br>
  <input type="text" name="apellidop" id="apellidop" placeholder="INGRESA TU APELLIDO PATERNO" value="<?php echo $apellidopaterno; ?>">
	<br>
	<br>
	<label for="apellidom">APELLIDO MATERNO:</label>
		<br>
  <input type="text" name="apellidom" id="apellidom" placeholder="INGRESA TU APELLIDO MATERNO" value="<?php echo $apellidomaterno; ?>">
	<br>
	<br>
	<label for="edad">EDAD:</label>
		<br>
  <input type="text" name="edad" id="edad" placeholder="INGRESA TU EDAD" value="<?php echo $edad ; ?>">
	<br>
	<br>
	<label for="correo">CORREO:</label>
		<br>
  <input type="email" name="correo" id="correo" placeholder="INGRESA TU CORREO ELECTRONICO" value="<?php echo $correo ; ?>">
		<br>
		<br>
		<label for="sexo">SEXO:</label>
		<br>
  <select name="sexo" id="sexo">
	  <option selected  value="<?php echo $sexo ; ?>"><?php echo $sexo ; ?></option>
	  <option value="Femenino">Femenino</option> 	
	  <option value="Masculino">Masculino</option> 	
  </select>
  		<br>
		<br>
		<label for="matricula">MATRICULA:</label>
		<br>
  <input type="text" name="matricula" id="matricula" placeholder="INGRESA MATRICULA" value="<?php echo $matricula ; ?>">
		<input type="submit" id="enviar" value="Editar" name="actualizar_paciente">
		<a href="editarpaciente.php" id="regresar_pac2"><input type="button" value="Regresar"></a>
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