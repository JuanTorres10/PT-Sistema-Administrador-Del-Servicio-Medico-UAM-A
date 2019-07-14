<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Generar receta</title>
<link rel="stylesheet" type="text/css" href="../css/estilo.css">
</head>
<body>
<?php 
if(empty($_SESSION['active']))
{
	header('Location:../index.php');
}
if (empty($_GET['id'])) 
{	
	header('Location: ../view/adminhistorial.php');
}
$id= $_GET['id'];

$resul_my=receta_pdf($conn,$id) ;
if ($resul_my == 0) 
{	
	header('Location: ../view/adminhistorial.php');
}
	else
	{	$my=receta_pdf2($conn,$id);
		while ($datos=mysqli_fetch_array($my)) 
		{
			$idhistorial = $datos['idhistorial'];
			$matricula	 = $datos['matricula'];
			$fecha	 = $datos['fecha'];
			$tratamiento = $datos['tratamiento'];
			$nombrecausa = $datos['nombrecausa'];
			$descripcion = $datos['descripcion'];
			$nombre = $datos['nombre'];
			$apellidopaternop = $datos['apellidopaterno'];
			$apellidomaternop = $datos['apellidomaterno'];
			$edad = $datos['edad'];
			$sexo = $datos['sexo'];
			$medicina = $datos['medicina'];
			$recurso = $datos['recurso'];
		}
	}
?>
<div id="medio_receta2">
<img src="../images/receta.png" id="receta"/> 		
<div id="nombrep"><?php echo $nombre.'    '.$apellidopaternop.'      '.$apellidomaternop; ?></div>
<div id="matricula"><?php echo 'Matricula:  '.$matricula.' | Edad: '.$edad.' años | Sexo: '.$sexo ;?></div>
<div id="fecha"><?php echo $fecha; ?></div>
<div id="nombre"><?php echo' DR. '. $_SESSION['idlogin'].' | Nombre: '.$_SESSION['nombre'].' '.$_SESSION['apellidopaterno'].' '.$_SESSION['apellidomaterno'].' | CED. PROF: '.$_SESSION['cedprof']; ?></div>
<div id="causa"><?php echo ' CAUSA: '. $nombrecausa.' | Descripcion: '.$descripcion; ?></div>
<div id="medicina"><?php echo' MEDICINA: '. $medicina?>
<br>
<?php echo' RECURSO: '. $recurso;?>
</div>
<div id="tratamiento"><?php echo ' TRATAMIENTO: '. $tratamiento; ?></div>
</div>
</body>
</html>