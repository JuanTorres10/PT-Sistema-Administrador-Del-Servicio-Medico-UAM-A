<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Editar Paciente</title>
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
require '../model/usuario_m.php';
?>

<?php require 'cabecera.php'?>
	<div id="medio">
  <ol class="breadcrumb">
    <li><a href="../index.php">Home</a></li>
    <li class="active">Editar Paciente</li>
  </ol>
<?php require 'menu.php'?>
<form action="buscar_paciente.php" method="get">
    <button value="buscar" type="submit" class="btn btn-info" id="bu">Buscar</button>
<input type="text" name="busqueda" placeholder="Buscar" id="buscar">
</form>
<?php if ($_SESSION['idrol']!=3) { ?>
<a href="formulariousuario.php"><button type="button" class="btn btn-primary">Crear Paciente</button></a>
							<?php } ?>
<br>
<br>
<table id="paciente">

<tr>
		<th id="cab" >ID</th>
		<th id="cab" onclick="sortTable_usuario(1)">Nombre</th>
		<th id="cab" onclick="sortTable_usuario(2)">Apellido Paterno</th>
		<th id="cab" onclick="sortTable_usuario(3)">Apellido Materno</th>
		<th id="cab" onclick="sortTable_usuario(4)">Edad</th>
		<th id="cab" onclick="sortTable_usuario(5)">Correo</th>
		<th id="cab" onclick="sortTable_usuario(6)">Sexo</th>
		<th id="cab" onclick="sortTable_usuario(7)">Matricula</th>
		<?php if ($_SESSION['idrol']!=3) { ?>
		<th id="cab">Acciones</th>
									<?php } ?>
</tr>
<?php
	$total=paginador($conn);
	$num_pag=10;
	
	if(empty($_GET['pagina']))
	{
		$pagina=1;
	}
		else
		{
			$pagina=$_GET['pagina'];
		}
	$desde=($pagina-1)*$num_pag;
	$paginas_total= ceil($total/$num_pag);
	
	$resultado=paginas($conn,$desde,$num_pag);

	if($resultado > 0)
	{
		llenar_tabla($conn,$desde,$num_pag);
	}
?>
</table>

<script>
function sortTable_usuario(n) 
{
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("paciente");
  switching = true;
  dir = "asc"; 
  while (switching) 
  {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) 
    {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      if (dir == "asc") 
      {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) 
        {
          shouldSwitch= true;
          break;
        }
      } 
      else if (dir == "desc") 
      {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) 
        {
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) 
    {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount ++;      
    } 
    else 
    {
      if (switchcount == 0 && dir == "asc") 
      {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>
<nav id="nav">
  <!-- Add class .pagination-lg for larger blocks or .pagination-sm for smaller blocks-->
  <ul class="pagination">
	 <?php
	  if($pagina !=1)
	  {
	  ?>
    <li><a href="?pagina=<?php echo 1;?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
	  <?php
	  }
	  for($i=1;$i<=$paginas_total;$i++)
	  {	  if($i==$pagina)
	  		{	?>	<li class="active"><a href="#"><?php echo $i ;?></a></li>
	  <?php
		  		
		  	}
	   		else
			{
				echo'<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
			}
	  }
	  if($pagina!=$paginas_total)
	  {
	  ?>
    <li><a href="?pagina=<?php echo $paginas_total;?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
<?php } ?>
  </ul>
</nav>.
    </div>
	<?php require'abajo.php'?>
</body>
</html>