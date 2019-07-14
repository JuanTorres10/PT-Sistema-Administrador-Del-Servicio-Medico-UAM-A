<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Administrar Historial</title>
<link href="../css/estilo.css" rel="stylesheet" type="text/css">
</head>
<body> 
<?php 
include "../controller/usuario_c.php";
if(empty($_SESSION['active']))
{
	header('Location:../index.php');
}
?>
<?php require 'cabecera.php'?>
	<div id="medio">
  <ol class="breadcrumb">
    <li><a href="../index.php">Home</a></li>
    <li class="active">Administrar Historial</li>
  </ol>
<?php  
	$busqueda =strtolower($_REQUEST['busqueda']);
	if (empty($busqueda)) 
	{
		header('Location: adminhistorial.php');
	}
?>
<?php require 'menu.php'?>

<form action="buscar_historial.php" method="get" id="busc">
<button value="buscar" type="submit" class="btn btn-info" id="bu">Buscar</button>
<input type="text" name="busqueda" placeholder="Buscar" id="buscar" value="<?php echo $busqueda ?>">
</form>
<?php if ($_SESSION['idrol']!=3) { ?>		
<a href="historial.php"><button type="button" class="btn btn-primary">Agregar </button></a>
							<?php } ?>
<br>
<br>
<table id="historial">
<tr>
		<th id="cab" >ID</th>
		<th id="cab" onclick="sortTable_hist(1)">Doctor</th>
		<th id="cab" onclick="sortTable_hist(2)">Medico</th>
		<th id="cab" onclick="sortTable_hist(3)">Paciente</th>
		<th id="cab" onclick="sortTable_hist(4)">Apellido Paterno</th>
		<th id="cab" onclick="sortTable_hist(5)">Apellido Materno</th>
		<th id="cab" onclick="sortTable_hist(6)">Fecha &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
		<th id="cab" onclick="sortTable_hist(7)">Hora</th>
		<th id="cab" onclick="sortTable_hist(8)">Tratamiento</th>
		<th id="cab" onclick="sortTable_hist(9)">Causa</th>
		<th id="cab" onclick="sortTable_hist(10)">Descripcion</th>
		<th id="cab" onclick="sortTable_hist(11)">Medicina</th>
		<th id="cab" onclick="sortTable_hist(12)">Recurso</th>
		<?php if ($_SESSION['idrol']!=3) { ?>
		<th id="cab">Acciones</th>
									<?php } ?>
</tr>

<?php

	
	
	$paginador_res=paginador_buscar_historial($conn,$busqueda) ;
	$total=$paginador_res['total'];
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
	
	
	$resultado =busqueda_historial($conn,$desde,$num_pag,$busqueda);
	if($resultado > 0)
	{
		$query=busqueda_historial2($conn,$desde,$num_pag,$busqueda);
		while($datos= mysqli_fetch_array($query))
		{ 
			?>
			<tr id="fila">
		<td id="casilla"><?php echo $datos["idhistorial"] ?></td>
		<td id="casilla"><?php echo $datos['No_Eco_Medico'] ?></td>
		<td id="casilla"><?php echo $datos["Nombre_Medico"].' '.$datos["Paterno"] ?></td>
		<td id="casilla"><?php echo $datos["Paciente"] ?></td>
		<td id="casilla"><?php echo $datos["apellidopaterno"] ?></td>
		<td id="casilla"><?php echo $datos["apellidomaterno"] ?></td>
		<td id="casilla"><?php echo $datos["fecha"] ?></td>
		<td id="casilla"><?php echo $datos["hora"] ?></td>
		<td id="casilla"><?php echo $datos["tratamiento"] ?></td>
		<td id="casilla"><?php echo $datos["nombrecausa"] ?></td>
		<td id="casilla"><?php echo $datos["descripcion"] ?></td>
		<td id="casilla"><?php echo $datos["medicina"] ?></td>
		<td id="casilla"><?php echo $datos["recurso"] ?></td>
		<?php if ($_SESSION['idrol']!=3) { ?>
		<td id="casilla">
		<a class="edit" href="editarhistorial.php?id= <?php echo $datos["idhistorial"] ?>">Actualizar</a> 	
		<a class="elim" href="eliminarhistorial.php?id= <?php echo $datos["idhistorial"] ?>">Eliminar</a> 	
		<a class="elim" href="../pdf/receta.php?id= <?php echo $datos["idhistorial"] ?>" target="_blank">Receta</a> 	
		</td>
									<?php } ?>
	</tr>

	<?php 
		}
	}
?>	
</table>
<script>
function sortTable_hist_recu(n) 
{
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("historial");
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
<?php  

if ($total !=0) 
{	
?>
<nav id="nav">
  <!-- Add class .pagination-lg for larger blocks or .pagination-sm for smaller blocks-->
  <ul class="pagination">
	 <?php
	  if($pagina !=1)
	  {
	  ?>
    <li><a href="?pagina=<?php echo 1;?>&busqueda=<?php echo $busqueda; ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
	  <?php
	  }
	  for($i=1;$i<=$paginas_total;$i++)
	  {	  if($i==$pagina)
	  		{	?>	<li class="active"><a href="#"><?php echo $i ;?></a></li>
	  <?php		
		  	}
	   		else
			{
				echo'<li><a href="?pagina='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';
			}
	  }
	  if($pagina!=$paginas_total)
	  {
	  ?>
    <li><a href="?pagina=<?php echo $paginas_total;?>&busqueda=<?php echo $busqueda; ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
<?php } ?>
  </ul>
</nav>
<?php 
} ?>						
.		
</div>
<?php require'abajo.php'?>	
</body>
</html>