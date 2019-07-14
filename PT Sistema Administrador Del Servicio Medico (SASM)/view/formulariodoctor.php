<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Agregar Doctor</title>
<link href="../css/estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
session_start();
require '../model/usuario_m.php';
if(empty($_SESSION['active']))
{
	header('Location:../index.php');
}
if ($_SESSION['idrol'] != 1 && $_SESSION['idrol'] != 2) 
{
	header('Location:../view/Bienvenida.php');
}
if(!empty($_GET['nombredoc']))
{
	$nombredoc=$_REQUEST['nombredoc'];
}
if(!empty($_GET['apellidopdoc']))
{
	$apellidopdoc=$_REQUEST['apellidopdoc'];
}
if(!empty($_GET['apellidomdoc']))
{
	$apellidomdoc=$_REQUEST['apellidomdoc'];
}
if(!empty($_GET['especialidaddoc']))
{
	$especialidaddoc=$_REQUEST['especialidaddoc'];
}
if(!empty($_GET['turno']))
{
	$turno=$_REQUEST['turno'];
}
if(!empty($_GET['ced']))
{
	$ced=$_REQUEST['ced'];
}
if(!empty($_GET['login']))
{
	$login=$_REQUEST['login'];
}
if(!empty($_GET['rol_1']))
{
	$rol_1=$_REQUEST['rol_1'];
}
?>  
  <?php require 'cabecera.php'?>
<div id="medio_llenar_doc">
  <ol class="breadcrumb">
    <li><a href="../index.php">Home</a></li>
    <li class="active">Agregar Doctor</li>
  </ol>
<?php require 'menu.php'?>
	<form id="form" action="../controller/usuario_c.php" method="post" >
	<label for="nombre">NOMBRE:</label>
		<br>
  <input type="text" name="nombredoc" id="nombre" placeholder="INGRESA NOMBRE" autocomplete="on" autofocus="on" value="<?php echo isset($nombredoc) ? $nombredoc : ''; ?>">
	<br>
	<br>
	<label for="apellidopdoc">APELLIDO PATERNO:</label>
		<br>
  <input type="text" name="apellidopdoc" id="apellidopdoc" placeholder="INGRESA APELLIDO PATERNO" autocomplete="on" value="<?php echo isset($apellidopdoc) ? $apellidopdoc : ''; ?>" >
	<br>
	<br>
	<label for="apellidomdoc">APELLIDO MATERNO:</label>
		<br>
  <input type="text" name="apellidomdoc" id="apellidomdoc" placeholder="INGRESA APELLIDO MATERNO" autocomplete="on" value="<?php echo isset($apellidomdoc) ? $apellidomdoc : ''; ?>" >
	<br>
	<br>
	<label for="especialidaddoc">ESPECIALIDAD:</label>
		<br>
  <input type="text" name="especialidaddoc" id="especialidaddoc" placeholder="INGRESA ESPECIALIDAD" autocomplete="on" value="<?php echo isset($especialidaddoc) ? $especialidaddoc : ''; ?>" >
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
  <input type="text" name="ced" id="ced" placeholder="INGRESA CEDULA PROF." autocomplete="on" value="<?php echo isset($ced) ? $ced : ''; ?>">
		<br>
		<br>
		<label for="economico">NO. ECONOMICO:</label>
		<br>
  <input type="text" name="login" id="economico" placeholder="INGRESA NO. ECONOMICO" autocomplete="on" value="<?php echo isset($login) ? $login : ''; ?>" >
		<br>
		<br>
		<label for="opcion">ELIJA UN ROL </label>
		<br>
	  
	  <?php
	  
	  $resultado_rol= roles($conn);
	  ?>

	  <select id="opcion" name="opcion">
	  	<?php  echo $rol_1 ?>
	  	<?php
		  	if ($resultado_rol > 0) 
		  	{	$rol=roles2($conn);
		  		while ($rol2= mysqli_fetch_array($rol)) 
		   		{
		   			?>	
		   			<option value="<?php echo $rol2["idroles"]; ?>"> <?php echo $rol2["descripcion"] ?></option>
		   		<?php  	  	
		   	  	}
		  	}
	  	 ?>	
	  </select>
	  		<br>
			<br>
		<label for="pass">CONTRASEÑA:</label>
		<br>
  <input type="password" name="pass" id="pass" placeholder="INGRESA LA CONTRASEÑA CON LA QUE INGRESARA">
  <a href="editardoctor.php" id="regresar_doc"><input type="button" value="Regresar"></a>    
  <input type="submit" id="enviar" align="middle" name="agregar_doc">
	<br>
	<br>
	<?php
		if (!empty($_GET['alerta'])) 
		{
			$alerta=$_GET['alerta'];
		}
	?>
	<div class="alerta"><?php echo isset($alerta) ? $alerta : ''; ?></div>	
	</form>
</div>
<?php require'abajo.php'?>
</body>
</html>