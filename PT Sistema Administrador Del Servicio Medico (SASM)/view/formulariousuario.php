<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Agregar Pacientes</title>
<link href="../css/estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
 <?php
session_start();
if(empty($_SESSION['active']))
{
	header('Location:../index.php');

}
if(!empty($_GET['nombre']))
{
	$nombre=$_REQUEST['nombre'];
}
if(!empty($_GET['apellidop']))
{
	$apellidop=$_REQUEST['apellidop'];
}
if(!empty($_GET['apellidom']))
{
	$apellidom=$_REQUEST['apellidom'];
}
if(!empty($_GET['edad']))
{
	$edad=$_REQUEST['edad'];
}
if(!empty($_GET['correo']))
{
	$correo=$_REQUEST['correo'];
}
if(!empty($_GET['sexo']))
{
	$sexo=$_REQUEST['sexo'];
}
?>
<?php require 'cabecera.php'?>	
<div id="medio_llenar_usu">
  <ol class="breadcrumb">
    <li><a href="../index.php">Home</a></li>
    <li class="active">Agregar Pacientes</li>
  </ol>
<?php require 'menu.php'?>
	<form id="form" action="../controller/usuario_c.php" method="post">
	<label for="nombre">NOMBRE:</label>
		<br>
  <input type="text" name="nombre" id="nombre" placeholder="INGRESA TU NOMBRE" autocomplete="on" autofocus="on" value="<?php echo isset($nombre) ? $nombre : ''; ?>">
	<br>
	<br>
	<label for="apellidop">APELLIDO PATERNO:</label>
		<br>
  <input type="text" name="apellidop" id="apellidop" placeholder="INGRESA TU APELLIDO PATERNO" autocomplete="on" value="<?php echo isset($apellidop) ? $apellidop : ''; ?>">
	<br>
	<br>
	<label for="apellidom">APELLIDO MATERNO:</label>
		<br>
  <input type="text" name="apellidom" id="apellidom" placeholder="INGRESA TU APELLIDO MATERNO" autocomplete="on" value="<?php echo isset($apellidom) ? $apellidom : ''; ?>">
	<br>
	<br>
	<label for="edad">EDAD:</label>
		<br>
  <input type="text" name="edad" id="edad" placeholder="INGRESA TU EDAD" autocomplete="on" value="<?php echo isset($edad) ? $edad : ''; ?>">
	<br>
	<br>
	<label for="correo">CORREO:</label>
		<br>
  <input type="email" name="correo" id="correo" placeholder="INGRESA TU CORREO ELECTRONICO" autocomplete="on" value="<?php echo isset($correo) ? $correo : ''; ?>">
		<br>
		<br>
		<label for="sexo">SEXO:</label>
		<br>
		<select name="sexo" id="sexo">
		<?php  echo '<option value="'.$sexo.'" select> '.$sexo.'</option>'; ?>
		<option value="Femenino">Femenino</option>
		<option value="Masculino">Masculino</option>
		</select>
		<br>
		<br>
		<label for="matricula">MATRICULA:</label>
		<br>
  <input type="text" name="matricula" id="matricula" placeholder="INGRESA MATRICULA" autocomplete="on">
		<a href="editarpaciente.php" id="regresar_pac"><input type="button" value="Regresar"></a>
		<input type="submit" id="enviar" align="middle" name="agregar_usuario">
		<?php
		if (!empty($_GET['alerta'])) 
		{
			$alerta=$_GET['alerta'];
		}
	?>
	<div class="alerta"><?php echo isset($alerta) ? $alerta : ''; ?> </div>
	</form>

		
  .
	
</div>
	
<?php require'abajo.php'?>
</body>
</html>