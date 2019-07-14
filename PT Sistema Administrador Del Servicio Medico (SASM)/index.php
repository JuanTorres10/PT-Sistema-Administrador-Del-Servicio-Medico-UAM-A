<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SASM</title>
<link rel="stylesheet" type="text/css" href="css/estilo.css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
</head>
<body>
<header>
	<a href="view/bienvenida.php">
		<div id="logo">
			<div id="titulo">
			<p>Sistema Administrador Del Servicio Medico UAM Azcapotzalco</p><br>
			</div>
			<img src="images/A.png" width="20%" height="20%" id="uam"/ >
			<img src="images/sm.png" width="20%" height="20%" id="sm"/ >
		</div>
	</a>
</header>
<?php 
$index='a';
session_start();
if(!empty($_SESSION['active']))
{
	header('Location:view/Bienvenida.php');

} 
?>

<div id="medio" align="center" >
	<div align="left">
		<ol class="breadcrumb">
		  <li class="active">Home </li>
		</ol>
	</div>
	<div id="div3">
	<P id="p">INGRESAR</P>
	<?php
		if (!empty($_GET['alerta'])) 
		{
			$alerta=$_GET['alerta'];
		}
	?>
<form action="controller/usuario_c.php" method="post" id="form1">
    <label id="letras">No. Economico:</label>
    <input name="economico" type="text" autofocus id="economico" placeholder=" Ingresa tu No. Economico" autocomplete="on">
    <label id="letras2">Contraseña:</label>
    <input name="pass" type="password" id="pass" placeholder=" Ingresa tu contraseña">
		<br>
		<br>
				
	<div class="msg_error"><?php echo isset($alerta) ? $alerta: '';?></div>
   <input type="submit" value="Enviar" name="entrar">	
</form>

	</div>.
</div>
<div id="abajo">
Universidad Autónoma Metropolitana, Seccion del Servicio Medico UAM Azcapotzalco, Av.San Pablo No.180, Col. Reynosa Tamaulipas. 
Delegación Azcapotzalco, 02200, México D.F. Tels.: 5318-9280.
<hr id="med">
<img src="images/HTML5-CSS3.png" id="html">
<img src="images/php.png" id="php">
<img src="images/MySQL.png" id="my">
</div>
</body>
</html>