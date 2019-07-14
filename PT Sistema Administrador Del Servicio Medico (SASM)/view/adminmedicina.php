<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Administrar Medicina</title>
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
    <li class="active">Administrar Medicina</li>
  </ol>
<?php require 'menu.php'?>
<form action="buscar_medicina.php" method="get">
<button value="buscar" type="submit" class="btn btn-info" id="bu">Buscar</button>
<input type="text" name="busqueda" placeholder="Buscar" id="buscar"> 
</form>		
<a href="medicina.php"><button type="button" class="btn btn-primary">Agregar</button></a>
<br>
<br>
<table id="recursos">
<tr>
		<th id="cab" >ID</th>
		<th id="cab" onclick="sortTable_recu(1)">NOMBRE</th>
		<th id="cab" onclick="sortTable_recu(2)">PRESENTACION</th>
		<th id="cab" onclick="sortTable_recu(3)">CANTIDAD TOTAL</th>
		<th id="cab" >ACCIONES</th>		
</tr>
<?php
	
	
	$paginador_res=paginador_medicina($conn);
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

	
	$resultado =paginador_medicina2($conn,$desde,$num_pag);

	if($resultado > 0)
	{	$query=llenar_tabla_medicina($conn,$desde,$num_pag);
		while($datos= mysqli_fetch_array($query))
		{ 
			?>
			<tr id="fila">
		<td id="casilla"><?php echo $datos["idmedicamentos"] ?></td>
		<td id="casilla"><?php echo $datos["medicamentosnombre"] ?></td>
		<td id="casilla"><?php echo $datos["presentacion"] ?></td>
		<td id="casilla"><?php echo $datos["cantidadtot"] ?></td>
		<td id="casilla">
		<a class="edit" href="editarmedicina.php?id= <?php echo $datos["idmedicamentos"] ?>">Editar</a> 	
		<a class="elim" href="eliminarmedicina.php?id= <?php echo $datos["idmedicamentos"] ?>">Eliminar</a> 	
		</td>
	</tr>
	<?php 
		}
	}
?>	
</table>
<script>
function sortTable_recu(n) 
{
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("recursos");
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
</nav>				
.
</div>
<?php require'abajo.php'?>	
</body>
</html>