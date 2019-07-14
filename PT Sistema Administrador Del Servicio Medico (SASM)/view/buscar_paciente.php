<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Editar Paciente</title>
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
    <li class="active">Editar Paciente</li>
  </ol>

<?php  
	$busqueda =strtolower($_REQUEST['busqueda']);
	if (empty($busqueda)) 
	{
		header('Location: editarpaciente.php');
	}
?>
<?php require 'menu.php'?>
<form action="buscar_paciente.php" method="get">
<button value="buscar" type="submit" class="btn btn-info" id="bu">Buscar</button>
<input type="text" name="busqueda" placeholder="Buscar" id="buscar" value="<?php echo $busqueda ?>">
</form>
<?php if ($_SESSION['idrol']!=3) { ?>
<a href="formulariousuario.php"><button type="button" class="btn btn-primary">Crear Paciente</button></a>
							<?php } ?>
<br>
<br>
<table id="paciente">
<tr>
		<th id="cab">ID</th>
		<th id="cab" onclick="sortTable_hist_recu(1)">Nombre</th>
		<th id="cab" onclick="sortTable_hist_recu(2)">Apellido Paterno</th>
		<th id="cab" onclick="sortTable_hist_recu(3)">Apellido Materno</th>
		<th id="cab" onclick="sortTable_hist_recu(4)">Edad</th>
		<th id="cab" onclick="sortTable_hist_recu(5)">Correo</th>
		<th id="cab" onclick="sortTable_hist_recu(6)">Sexo</th>
		<th id="cab" onclick="sortTable_hist_recu(7)">Matricula</th>
		<?php if ($_SESSION['idrol']!=3) { ?>
		<th id="cab">Acciones</th>
									<?php } ?>
</tr>

<?php
	
	$paginador_res=paginador_buscar_paciente($conn,$busqueda) ;
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
	
	
	$resultado =buscar_paciente($conn,$busqueda,$desde,$num_pag);

	if($resultado > 0)
	{
		$query=buscar_paciente2($conn,$busqueda,$desde,$num_pag);
		while($datos= mysqli_fetch_array($query))
		{ 
			?>
			<tr id="fila">
		<td id="casilla"><?php echo $datos["idpacientes"] ?></td>
		<td id="casilla"><?php echo $datos["nombre"] ?></td>
		<td id="casilla"><?php echo $datos["apellidopaterno"] ?></td>
		<td id="casilla"><?php echo $datos["apellidomaterno"] ?></td>
		<td id="casilla"><?php echo $datos["edad"] ?></td>
		<td id="casilla"><?php echo $datos["correo"] ?></td>
		<td id="casilla"><?php echo $datos["sexo"] ?></td>
		<td id="casilla"><?php echo $datos["matricula"] ?></td>
		<?php if ($_SESSION['idrol']!=3) { ?>
		<td id="casilla">
		<a class="edit" href="editarpaciente2.php?id= <?php echo $datos["idpacientes"] ?>">Editar</a> 	
		<a class="elim" href="eliminarusuario.php?id= <?php echo $datos["idpacientes"] ?>">Eliminar</a> 	
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