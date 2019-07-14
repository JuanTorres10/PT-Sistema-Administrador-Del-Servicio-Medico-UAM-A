<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar Doctor</title>
<link href="../css/estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php 
$actualizar_doc='a';
require '../controller/usuario_c.php'
?>
<?php
if ($_SESSION['idrol'] != 1 && $_SESSION['idrol'] != 2) 
{
	header('Location:../view/Bienvenida.php');
}
if(empty($_SESSION['active']))
{
	header('Location:../index.php');
}
if ($_GET['id']==1 || $_GET['id']==5 ) 
{
	header('Location: editardoctor.php');
}
?>
<?php require 'cabecera.php'?>
	

<div id="medio_doc">
  <ol class="breadcrumb">
    <li><a href="../index.php">Home</a></li>
    <li class="active">Editar Doctor</li>
  </ol>
<?php require 'menu.php'?>
	<form id="form" action="../controller/usuario_c.php" method="post" >
	<input type="hidden" name="iddoctores" value="<?php echo $iddoctores; ?>">
	<input type="hidden" name="d_idlogin" value="<?php echo $d_idlogin; ?>">

	<label for="nombre">NOMBRE:</label>
		<br>
  <input type="text" name="nombredoc" id="nombre" placeholder="INGRESA NOMBRE" value="<?php echo $nombredoc; ?>">
	<br>
	<br>
	<label for="apellidopdoc">APELLIDO PATERNO:</label>
		<br>
  <input type="text" name="apellidopdoc" id="apellidopdoc" placeholder="INGRESA APELLIDO PATERNO" value="<?php echo $apellidopdoc; ?>" >
	<br>
	<br>
	<label for="apellidomdoc">APELLIDO MATERNO:</label>
		<br>
  <input type="text" name="apellidomdoc" id="apellidomdoc" placeholder="INGRESA APELLIDO MATERNO" value="<?php echo $apellidomdoc; ?>" >
	<br>
	<br>
	<label for="especialidaddoc">ESPECIALIDAD:</label>
		<br>
  <input type="text" name="especialidaddoc" id="especialidaddoc" placeholder="INGRESA ESPECIALIDAD" value="<?php echo $especialidaddoc; ?>" >
	<br>
	<br>
	<label for="sexo">TURNO:</label>
		<br>
		<select name="turno" id="sexo">
		<?php  echo '<option value="'.$turno.'" select> '.$turno.'</option>'; ?>
		<option value="Matutino">Matutino</option>
		<option value="Vespertino">Vespertino</option>
		<option value="Completo">Completo</option>
		</select>
		<br>
		<br>
		<label for="ced">CEDULA PROF.:</label>
		<br>
  <input type="text" name="ced" id="ced" placeholder="INGRESA CEDULA PROF." value="<?php echo $ced; ?>" >
		<br>
		<br>
		<label for="economico">NO. ECONOMICO:</label>
		<br>
  <input type="text" name="login" id="economico" placeholder="INGRESA NO. ECONOMICO" value="<?php echo $login; ?>" >
		<br>
		<br>
		<label for="opcion">ELIJA UN ROL </label>
		<br>
	  <?php
	  	  
	  $resultado_rol=resultado_rol($conn) ;	  
	   ?>
	  <select id="opcion" name="opcion" class="nover">
	  	<?php
	  		echo $opcion;
		  	if ($resultado_rol > 0) 
		  	{	
		  		resultado_rol2($conn);
		  	}
	  	 ?>	
	  </select>
			<br>
			<br>
		<label for="pass">CONTRASEÑA:</label>
		<br>
  <input type="password" name="pass" id="pass" placeholder="INGRESA LA CONTRASEÑA CON LA QUE INGRESARA">

<a href="editardoctor.php" id="regresar_doc2"><input type="button" value="Regresar"></a>
<input type="submit" id="enviar" align="middle" name="actualizar_doc">
	<br>
	<br>
	<?php
		if (!empty($_GET['alerta'])) 
		{
			$alerta=$_GET['alerta'];
		}
	?>
	<div class="alerta"><?php echo isset($alerta) ? $alerta : ''; ?> </div>	
	</form>.
</div>
	<?php require'abajo.php'?>
</body>
</html>