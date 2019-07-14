<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Bienvenida</title>
<link href="../css/estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
session_start();
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
    <li class="active">Bienvenida</li>
  </ol>
<?php require 'menu.php'?>
<h1>Bienvenido a SASM</h1>
<article id="bienvenida"> Instrucciones: En el menú de arriba se encuentra la barra de herramientas/navegación que permite hacer uso de las funciones del sistema; a la derecha se puede observar tu nombre, tu No. económico, tu rol dentro del sistema; así como también la fecha actual. <br>
  <br>
Para poder hacer uso de este están las siguientes opciones para: <br>
<br>
<em id="color">1.- Administradores y  doctores:</em> Podrán hacer y acceder al uso total del sistema, como poder crear usuarios, médicos o enfermer@s; además de poderlos editar o eliminar (con excepción de los superadministradores; estos solo pueden ser eliminados desde la base de datos ) también podrán crear consultas y generar su historial de los pacientes; ya sea con el uso de recursos o no y podrán administrarlos como editar, eliminar, además de crear las recetas médicas en formato PDF para descargar con nombre del paciente, fecha etc., nombre del doctor, tratamiento etc. <br>
<br>
<em id="color">2.- Enfermer@s</em>: Podrán solo ver los registros de historiales de pacientes, nombres de doctores y usuarios; solo podrán agregar recursos y administrarlos como editarlos y eliminar los registros. <br>
<br>
*Ambos podran hacer uso del buscador de cada tabla de registros para facilitar una busqueda. Cualquier problema favor de reportarlo en el departamento de sistemas. <br>
<br>
Buen día. Saludos cordiales. </article>
</div> 
<?php require'abajo.php'?> 
</body>
</html>