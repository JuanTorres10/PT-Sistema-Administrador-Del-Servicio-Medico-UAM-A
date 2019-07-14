<?php 


date_default_timezone_set('America/Mexico_City');

function fechaC()
{
  $mes= array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
  return date('d')." de ".$mes[date('n')]." de ".date('Y');
}

 ?><head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Menu</title>
<link rel="stylesheet" href="../css/estilo.css" type="text/css">
<link href="../css/bootstrap-3.3.7.css" rel="stylesheet" type="text/css">
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery-1.10.2.js"></script>
  <script src="../js/jquery-ui.js"></script>

</head>




<div class="btn-group">
  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">AGREGAR <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li role="presentation" class="dropdown-header">PACIENTE O DOCTOR / USUARIO</li>
    <li role="presentation"><a href="formulariousuario.php">PACIENTE</a></li>
    <?php if ($_SESSION['idrol']!=3) { ?>
    <li role="presentation" class="divider"></li>
    <li role="presentation"><a href="formulariodoctor.php">DOCTOR / USUARIO</a></li>
							  <?php  } ?>
  </ul>
</div>
&nbsp;	
<div class="btn-group">
  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">EDICION <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li role="presentation" class="dropdown-header">PACIENTE O DOCTOR / USUARIO</li>
    <li role="presentation"><a href="editarpaciente.php">PACIENTE</a></li>
    <li role="presentation" class="divider"></li>
    <li role="presentation"><a href="editardoctor.php">DOCTOR / USUARIO</a></li>
  </ul>
</div>
&nbsp;
<div class="btn-group">
  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">HISTORIAL / CONSULTA <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li role="presentation" class="dropdown-header">CONSULTA</li>
    <?php if ($_SESSION['idrol']!=3) { ?>
    <li role="presentation"><a href="historial.php">AGREGAR</a></li>
							   <?php } ?>
	 <li role="presentation" class="dropdown-header">HISTORIAL</li>
    <li role="presentation"><a href="adminhistorial.php">ADMINISTRAR</a></li>
  </ul>
</div>
&nbsp;	
<div class="btn-group">
  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">RECURSOS / MEDICINA <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li role="presentation" class="dropdown-header">RECURSOS</li>
    <li role="presentation"><a href="recursos.php">AGREGAR</a></li>
    <li role="presentation"><a href="adminrecursos.php">ADMINISTRAR</a></li>
	<li role="presentation" class="divider"></li>
	<li role="presentation" class="dropdown-header">MEDICINA</li>
    <li role="presentation"><a href="medicina.php">AGREGAR</a></li>
    <li role="presentation"><a href="adminmedicina.php">ADMINISTRAR</a></li>
  </ul>
</div>
&nbsp;	
<a href="../controller/usuario_c.php?salir= salir "><button type="button" class="btn btn-success" name="salir">SALIR</button></a>

	
<div id="aver2">
<p id="fecha_menu">Fecha: <?php echo fechaC(); ?></p>
<p id="login">Bienvenido: <?php echo $_SESSION['idlogin']; ?></p>
</div>
<div id="aver">
<p id="descripcion">Rol: <?php echo $_SESSION['idrol'].' - '.$_SESSION['descripcion']; ?></p>	
<p id="Hola">Hola:<?php echo $_SESSION['nombre']; ?></p>
</div>
	
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>