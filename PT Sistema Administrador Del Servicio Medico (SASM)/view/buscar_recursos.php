<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Administrar Recursos</title>
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
    <li class="active">Administrar Recursos</li>
  </ol>

<?php  
$busqueda =strtolower($_REQUEST['busqueda']);
	if (empty($busqueda)) 
	{
		header('Location: adminrecursos.php');
	}
?>
<?php require 'menu.php'?>
<form action="buscar_recursos.php" method="get">
<button value="buscar" type="submit" class="btn btn-info" id="bu">Buscar</button>
<input type="text" name="busqueda" placeholder="Buscar" id="buscar" value="<?php echo $busqueda ?>">
</form>		
<a href="recursos.php"><button type="button" class="btn btn-primary">Agregar </button></a>
<br>
<br>
<table id="recursos">
<tr>
		<th id="cab">ID</th>
		<th id="cab" onclick="sortTable_hist_recu(1)">NOMBRE</th>
		<th id="cab" onclick="sortTable_hist_recu(2)">DESCRIPCION</th>
		<th id="cab" onclick="sortTable_hist_recu(3)">CANTIDAD TOTAL</th>
		<th id="cab" >ACCIONES</th>
</tr>
<?php
	
	$paginador_res=paginador_buscar_recurso($conn,$busqueda) ;
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

	
	$resultado =buscar_recurso($conn,$busqueda,$desde,$num_pag);

	if($resultado > 0)
	{
		$query=buscar_recurso2($conn,$busqueda,$desde,$num_pag);
		while($datos= mysqli_fetch_array($query))
		{ 
			?>
			<tr id="fila">
		<td id="casilla"><?php echo $datos["idrecurso"] ?></td>
		<td id="casilla"><?php echo $datos["nombrerecurso"] ?></td>
		<td id="casilla"><?php echo $datos["descripcionrecurso"] ?></td>
		<td id="casilla"><?php echo $datos["cantidadtotal"] ?></td>
		<td id="casilla">
		<a class="edit" href="editarrecursos.php?id= <?php echo $datos["idrecurso"] ?>">Editar</a> 	
		<a class="elim" href="eliminarrecursos.php?id= <?php echo $datos["idrecurso"] ?>">Eliminar</a> 	
		</td>
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