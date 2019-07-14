<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Historial</title>
<link href="../css/estilo.css" rel="stylesheet" type="text/css">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
  <script src="../js/jquery-1.10.2.js"></script>
  
  <script src="../js/jquery-ui.js"></script>

  <link rel="stylesheet" href="../js/jquery-ui.css">         
      <script> // autocompletar
  $(function() {
    $( "#matricula" ).autocomplete({
      source: '../controller/usuario_c.php'
    });
  });
  </script>

  <script>//para mostrar checkbox

$(document).ready(function(){
  $('.con_recurso').on('change',function(){
    if (this.checked) {
     $(".row2").show();
    } else {
     $(".row2").hide();
    }  
  })
});
  </script>



  <script>// para copiar de un input a otro
      $(document).ready(function () {
          $("#causa").keyup(function () {
              var value = $(this).val();
              $("#descripcioncausa").val(value);
          });
      });
</script>
</head>
<body>
 <?php
include "../controller/usuario_c.php";
if ($_SESSION['idrol'] != 1 && $_SESSION['idrol'] != 2) 
{
	header('Location:../view/Bienvenida.php');
}


$idlogin=$_SESSION['idlogin'];

if(empty($_SESSION['active']))
{
	header('Location:../index.php');

}
?>
  
  <?php require 'cabecera.php'?>
	

<div id="medio_hist">
  <ol class="breadcrumb">
    <li><a href="../index.php">Home</a></li>
    <li class="active">Agregar Historial</li>
  </ol>
<?php require 'menu.php'?>
<?php 
if(!empty($_GET['fechahist']))
{
	$fechahist=$_REQUEST['fechahist'];
}
if(!empty($_GET['horahist']))
{
	$horahist=$_REQUEST['horahist'];			
}
if(!empty($_GET['tratamiento']))
{
	$tratamiento=$_REQUEST['tratamiento'];			
}
if(!empty($_GET['nombremedicamento']))
{
	$nombremedicamento=$_REQUEST['nombremedicamento'];		
}
if(!empty($_GET['presentacion']))
{
	$presentacion=$_REQUEST['presentacion'];			
}
if(!empty($_GET['descripcion_medicamento']))
{
	$descripcion_medicamento=$_REQUEST['descripcion_medicamento'];			
}				
if(!empty($_GET['causa']))
{
	$causa=$_REQUEST['causa'];		
}				
if(!empty($_GET['descripcioncausa']))
{
	$descripcioncausa=$_REQUEST['descripcioncausa'];		
}				
				
if(!empty($_GET['pon_med2']))
{
	$pon_med2=$_REQUEST['pon_med2'];
}
if(!empty($_GET['medicina']))
{
	$medicina=$_REQUEST['medicina'];
}				
				
				
 ?>
 <?php
$idrecurso=recurso2($conn);
	  $resultado_recurso=recurso($conn);
$idmedicina=medicina($conn);
	  $resultado_medicina=medicina2($conn);
		?>
<!---Para crear selects-->
<script type="text/javascript">
let numero = 1;
let nuevo = function() {
  if(numero>=7)
		{
			numero=6;
		}
	if(numero>=5)
		{
			alert("El numero de medicinas supera a 5");
			eliminar(n);
		}
	numero++;
  if(numero==2)
			{
				jQuery('.inputs').append(`<section id="${numero}"><div id="boto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn-danger" onclick="eliminar()"> Limpiar Todo </button> 
					</div></section>`);

			}
  jQuery('.inputs').append(`<section id="${numero}">
<br>
  	
  	<select id="recurso_med" name="medicina${numero}">
		
		
	  	<?php

	  	$medicina='';
  	$pon_med2='';

	  	echo '<option value="'.$medicina.'" select> '.$pon_med2.'</option>';

		  	if ($resultado_medicina > 0) 
		  	{	
				
		  		while ($medicina2= mysqli_fetch_array($idmedicina)) 
		   		{
		   			?>	
		   			<option value="<?php echo $medicina2["idmedicamentos"]; ?>"> <?php echo $medicina2["medicamentosnombre"] ?> </option>
		   		<?php
		   	  	}
		  	}
	  	 ?>	
	  </select>

   </section>`);
}
let eliminar = function(n) {
  jQuery("section").remove(`#2`);
  jQuery("section").remove(`#3`);
  jQuery("section").remove(`#4`);
  jQuery("section").remove(`#5`);
	numero=1;
}
/*let eliminar = function(n) {
  jQuery("section").remove(`#${n}`);
	numero=numero-1;
}*/
</script>
	<form id="form" action="../controller/usuario_c.php" method="post">

	<label for="matricula">MATRICULA DEL PACIENTE:</label>
		<br>
  <input type="text" name="matricula" id="matricula" placeholder="INGRESA ID DEL PACIENTE" autocomplete="on" autofocus="on">
  	<br>
	<br>
	<label for="fechahist">FECHA:</label>
		<br>
  <input type="date" name="fechahist" id="fechahist" readonly="readonly" placeholder="INGRESA FECHA CON FORMATO" value="<?php echo date("Y-m-d");?>" >
	<br>
	<br>
	<label for="horahist">HORA:</label>
		<br>
  <input type="time" name="horahist" id="horahist" readonly="readonly" placeholder="INGRESA HORA" autocomplete="on" value="<?php echo date("H:i");?>">
	<br>
	<br>
	<label for="tratamiento">TRATAMIENTO:</label>
		<br>
  <textarea id="tratamiento" placeholder="ESCRIBA EL TRATAMIENTO A SEGUIR" name="tratamiento" autocomplete="on"><?php echo isset($tratamiento) ? $tratamiento : '';?></textarea>
	<br>
	<br>
	<label for="causa">NOMBRE DEL EVENTO/CAUSA:</label>
		<br>
  <input type="text" name="causa" id="causa" placeholder="INGRESA NOMBRE DEL EVENTO/CAUSA" autocomplete="on" value="<?php echo isset($causa) ? $causa : ''; ?>" >
		<br>
		<br>
		<label for="descripcioncausa">DESCRIPCION DEL EVENTO:</label>
		<br>
		<textarea id="descripcioncausa" placeholder="INGRESA UNA DESCRIPCION DEL EVENTO/CAUSA" name="descripcioncausa" autocomplete="on"><?php echo isset($descripcioncausa) ? $descripcioncausa : ''; ?></textarea>  
		<br>
		<br>
		<?php
$idrecurso=recurso2($conn);
	  $resultado_recurso=recurso($conn);
$idmedicina=medicina($conn);
	  $resultado_medicina=medicina2($conn);
		?>
   <div class="inputs">
	  <label id="titulo_re" > CON MEDICINA (*Hasta 5)</label>
	  <br>
	  <select id="recurso_med" name="medicina1">
		
	  	<?php
	  	echo '<option value="'.$medicina.'" select> '.$pon_med2.'</option>';

		  	if ($resultado_medicina > 0) 
		  	{	
				
		  		while ($medicina2= mysqli_fetch_array($idmedicina)) 
		   		{
		   			?>	
		   			<option value="<?php echo $medicina2["idmedicamentos"]; ?>"> <?php echo $medicina2["medicamentosnombre"] ?> </option>
		   		<?php
		   	  	}
		  	}
	  	 ?>	
	  </select>
    <div id="boto">
		<button type="button" onclick="nuevo();">Agregar</button>
		  
	</div>
  </div>
		<br>
		<input type="checkbox" class="con_recurso" ><label > CON RECURSO (*Hasta 5)</label>
		<br>
		<br>
		<div class="row2" style="display: none;">
	  	<?php  
		  	if ($resultado_recurso > 0) 
		  	{	
				$i=0;
		  		while ($recurso2= mysqli_fetch_array($idrecurso)) 
		   		{
		   			
		   			
		   			?>
		   			
					<div class="row" id="row">
                     <input type="checkbox" name="recurso[]" id="recurso_hist" value="<?php echo $recurso2["idrecurso"]; ?>"><label id="rowl"><?php echo $recurso2["nombrerecurso"]?> </label>  
                            </div>
		
					  
						
					
		   		<?php
		   		$i++;
		   	  	}
		  	}
	  	 ?>	
	  	 </div>
		<script>
	$(document).ready(function()
{
 
	// Evento que se ejecuta al pulsar en un checkbox
	$("input[type=checkbox]").change(function()
	{
 
		// Cogemos el elemento actual
		var elemento=this;
		var contador=0;
 
		// Recorremos todos los checkbox para contar los que estan seleccionados
		$("input[type=checkbox]").each(function()
	{
			if($(this).is(":checked"))
				contador++;
	});
 
		var cantidadMaxima=6;
 
		// Comprovamos si supera la cantidad máxima indicada
		if(contador>cantidadMaxima)
		{
			alert("El numero de recursos supera a 5");
 
			// Desmarcamos el ultimo elemento
			$(elemento).prop('checked', false);
			contador--;
		}
	});
});
</script>
		<br>
		<br>
		<br>
		<br>&nbsp;
		<br>&nbsp;
		<br>&nbsp;
		<br>&nbsp;
		<br>&nbsp;
		
		<a href="adminhistorial.php" id="regresar_hist1"><input type="button" value="Regresar"></a>
		<input type="submit" id="enviar" align="middle" name="agregar_historial">
<?php
		if (!empty($_GET['alerta'])) 
		{
			$alerta=$_GET['alerta'];
		}
	?>
	<div class="alerta"><?php echo isset($alerta) ? $alerta : ''; ?> </div>


	</form>
	.</div>
	<?php require'abajo.php'?>
</body>
</html>