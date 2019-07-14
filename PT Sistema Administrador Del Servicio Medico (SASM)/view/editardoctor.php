<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Editar Doctor</title>
<link href="../css/estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php 
session_start();
if(empty($_SESSION['active']))
{
	header('Location:../index.php');
}
?>	
<?php require 'cabecera.php'?>
<?php require '../model/usuario_m.php'?>
	<div id="medio">
  <ol class="breadcrumb">
    <li><a href="../index.php">Home</a></li>
    <li class="active">Editar Doctor</li>
  </ol>
<?php require 'menu.php'?>

<form action="buscar_doctor.php" method="get">
<button value="buscar" type="submit" class="btn btn-info" id="bu">Buscar</button>
<input type="text" name="busqueda" placeholder="Buscar" id="buscar">
</form>

<?php if ($_SESSION['idrol']!=3) { ?>
<a href="formulariodoctor.php"><button type="button" class="btn btn-primary">Crear Doctor</button></a>
							<?php } ?>
<br>
<br>
<table id="doc">

<tr>
		<th id="cab" >ID</th>
		<th id="cab" onclick="sortTable_doc(1)">Idrol</th>
		<th id="cab" onclick="sortTable_doc(2)">Nombre</th>
		<th id="cab" onclick="sortTable_doc(3)">Apellido Paterno</th>
		<th id="cab" onclick="sortTable_doc(4)">Apellido Materno</th>
		<th id="cab" onclick="sortTable_doc(5)">Especialidad</th>
		<th id="cab" onclick="sortTable_doc(6)">Turno</th>
		<th id="cab" onclick="sortTable_doc(7)">Cedula Prof</th>
		<th id="cab" onclick="sortTable_doc(8)">Login</th>
		<th id="cab" onclick="sortTable_doc(9)">Descripcion/Rol</th>
		<?php if ($_SESSION['idrol']!=3) { ?>
		<th id="cab">Acciones</th>
									<?php } ?>
</tr>

<?php
	$paginador_res= paginador_doc($conn);
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
	tabla_doc($conn,$desde,$num_pag)
?>
	
</table>
<script>
function sortTable_doc(n) 
{
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("doc");
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