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
      <script> //////////////////////////////////////////////////////////////////////////// autocompletar
  $(function() {
    $( "#matricula" ).autocomplete({
      source: '../controller/usuario_c.php'
    });
  });
  </script>

  <script>/////////////////////////////////////////////////////////////////////////para mostrar checkbox

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



  <script>//////////////////////////////////////////////////////////////////////////////// para copiar de un input a otro
      $(document).ready(function () {
          $("#causa").keyup(function () {
              var value = $(this).val();
              $("#descripcioncausa").val(value);
          });
      });
</script>
</head>
<body>
<?php $editarhistorial='a' ?>
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
$idrecurso=recurso2($conn);
	  $resultado_recurso=recurso($conn);
$idmedicina=medicina($conn);
	  $resultado_medicina=medicina2($conn);
		?>

<!---////////////////////////////////////////////////////////////////////////////////////////////////////////Para crear selects-->
	
<script type="text/javascript">
<?php
/// para blanco aunque esto no se deberia de poner////
if(empty($med1))
{
?>
		var numero=1;
		
<?php
}
?>
	
<?php
/// para uno////
if(!empty($med1))
{
?>
		var numero=1;
		
<?php
}
?>

// para dos////
<?php
if(!empty($med2))
{
?>
		var numero=2;
		
<?php
}
?>
////// para tres
<?php
if(!empty($med3))
{
?>
		var numero=3;
		
<?php
}
?>
////// para cuatro
<?php
if(!empty($med4))
{
?>
		var numero=4;
		
<?php
}
?>
////// para cinco
<?php
if(!empty($med5))
{
?>
		var numero=5;
		
<?php
}
?>

let nuevo = function() 
{
  if(numero>=6)
		{
			numero=5;
		}
	if(numero==5)
		{
			alert("El numero de medicinas supera a 5");
			eliminar(n);
		}
	numero++;
	if(numero==2)
			{
				jQuery('.inputs').append(`<section id="${numero}"><div id="boto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn-danger" onclick="eliminar()"> Limpiar Todo </button> 
					</div></section>`);

			}
  jQuery('.inputs').append(`<section id="${numero}">
<br>
  	<label id="titulo_re" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
  	
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
	<input type="hidden" name="idhistorial" value="<?php echo $idhistorial; ?>">
	<label for="matricula">MATRICULA DEL PACIENTE:</label>
		<br>
  <input type="text" name="matricula" id="matricula" placeholder="INGRESA ID DEL PACIENTE" autocomplete="on" autofocus="on" value="<?php echo $matricula; ?>">
  	<br>
	<br>
	<label for="fechahist">FECHA:</label>
		<br>
  <input type="date" name="fechahist" id="fechahist" readonly="readonly" placeholder="INGRESA FECHA CON FORMATO" value="<?php echo $fecha; ?>" >
	<br>
	<br>
	<label for="horahist">HORA:</label>
		<br>
  <input type="time" name="horahist" id="horahist" readonly="readonly" placeholder="INGRESA HORA" autocomplete="on" value="<?php echo $hora; ?>">
	<br>
	<br>
	<label for="tratamiento">TRATAMIENTO:</label>
		<br>
  <textarea id="tratamiento" placeholder="ESCRIBA EL TRATAMIENTO A SEGUIR" name="tratamiento" autocomplete="on"><?php echo $tratamiento?></textarea>
	<br>
	<br>
	<label for="causa">NOMBRE DEL EVENTO/CAUSA:</label>
		<br>
  <input type="text" name="causa" id="causa" placeholder="INGRESA NOMBRE DEL EVENTO/CAUSA" autocomplete="on" value="<?php echo $nombrecausa; ?>" >
		<br>
		<br>
		<label for="descripcioncausa">DESCRIPCION DEL EVENTO:</label>
		<br>
		<textarea id="descripcioncausa" placeholder="INGRESA UNA DESCRIPCION DEL EVENTO/CAUSA" name="descripcioncausa" autocomplete="on"><?php echo $descripcion ?></textarea>  
		<br>
		<br>

		<?php
$idrecurso=recurso2($conn);
	  $resultado_recurso=recurso($conn);
	  $recurso_che=recurso_che($conn,$id);
	  $hay_recurso_che=recurso_che2($conn,$id);
$idmedicina=medicina($conn);
	  $resultado_medicina=medicina2($conn);
		if(!empty ($hay_recurso_che["medicamentosnombre"]))
		 {
		?>
	  
	    <label id="titulo_re"> CON MEDICINA (*Solo actualizar el NUMERO de medicinas y/o recursos <br>
	      previamente seleccionados):</label>
	    <br>
		  <section>
  <select id="recurso_med" name="medicina1">
		  	<?php 
		 
		  echo '<option value="'.$medicina1.'" select> '.$med1.'</option>';
		  	if ($resultado_medicina > 0) 
		  	{	
				
		  		while ($medicina2= mysqli_fetch_array($idmedicina)) 
		   		{
		   			?>	
		  <option value="<?php echo $medicina2["idmedicamentos"]; ?>"> <?php echo $medicina2["medicamentosnombre"] ?> </option>
		   		
	  
	  <?php
		   	  	}
		  	}
	  	 }?>	
 </select>
			  </section>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
	<?php
	if (!empty($med2))
	{
		$idmedicina=medicina($conn);
	  $resultado_medicina=medicina2($conn);
				$numero=2;
	?>			
	
	<section id="<?php $numero?>">
		<br>
  		
				<select id="recurso_med" name="medicina2">
		
	  	<?php
	  	echo '<option value="'.$medicina2.'" select> '.$med2.'</option>';
		  	 
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
		  </section>
		  
			  <?php
	}
	 ?>
	
<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
	<?php
	if (!empty($med3))
	{
		$idmedicina=medicina($conn);
	  $resultado_medicina=medicina2($conn);
				$numero=3;
	?>			
	
	<section id="<?php echo $numero?>">
		<br>
  			
				<select id="recurso_med" name="medicina3">
		
	  	<?php
	  	echo '<option value="'.$medicina3.'" select> '.$med3.'</option>';
		  	 
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
		  
		  </section>
		  
			  <?php
	}
	 ?>
	
<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
	<?php
	if (!empty($med4))
	{
		$idmedicina=medicina($conn);
	  $resultado_medicina=medicina2($conn);
				$numero=4;
	?>			
	
	<section id="<?php echo $numero?>">
		<br>
  		
				<select id="recurso_med" name="medicina4">
		
	  	<?php
	  	echo '<option value="'.$medicina4.'" select> '.$med4.'</option>';
		  	 
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
		  
		  </section>
		  
			  <?php
	}
	 ?>
	
<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
 <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
	<?php
	if (!empty($med5))
	{
		$idmedicina=medicina($conn);
	  $resultado_medicina=medicina2($conn);
				$numero=5;
	?>			
	
	<section id="<?php echo $numero?>">
		<br>
		
				<select id="recurso_med" name="medicina5">
		
	  	<?php
	  	echo '<option value="'.$medicina5.'" select> '.$med5.'</option>';
		  	 
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
		  
		  </section>
		  
			  <?php
	}
	 ?>
	
<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
		<br>
		<?php if(!empty ($hay_recurso_che["idrecurso"]))
		{
			?>
		<br>
		<br>
		<br>
		<br>
		<label id="titulo_re">CON RECURSO (*Solo actualizar el NUMERO de medicinas y/o recursos <br>
	      previamente seleccionados)</label>
		<br>
			<input type="checkbox" class="con_recurso" checked >
			<br>
			<br>
			<?php
		}
		else
		{
			?>
		<label id="titulo_re">CON RECURSO (*Solo actualizar el NUMERO de medicinas y/o recursos <br>
	      previamente seleccionados)</label>
		<br>
			<input type="checkbox" class="con_recurso" disabled >
			<br>
			<br>
			<?php	
		}
		?>
		<?php if(!empty ($hay_recurso_che["idrecurso"]))
		{
				?>	
				<div class="row2" style="display:block;">
				<?php
		}
		else
		{
				?> 
				<div class="row2" style="display:none;">
				<?php	
		}
		?>
	  	<?php  
			
		  	if ($resultado_recurso > 0) 
		  	{	$j=0;
		  		$i=0;
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
				$i=0;
				/*foreach ($idrecurso as $key => $value) 
				{
					$arr_data1[] = $value;
					
				}*/
				
			
		   				 $id1='';
						 $id2='';
						 $id3='';
						 $id4='';
						 $id5='';

				 	if(!empty($array1[0]))
				 	{
				 		$id1=$array1[0];
						$id_r1=hist_re1a_id($conn,$idhistorial,$id1);
						$id_r1=$id_r1['idhistorial_rec'];
				 	} 
				 	if(!empty($array1[1]))
				 	{
				 		$id2=$array1[1];
				 		$id_r2=hist_re2a_id($conn,$idhistorial,$id2);
				 		$id_r2=$id_r2['idhistorial_rec'];
				 	} 
				 	if(!empty($array1[2]))
				 	{
				 		$id3=$array1[2];
				 		$id_r3=hist_re3a_id($conn,$idhistorial,$id3);
				 		$id_r3=$id_r3['idhistorial_rec'];
				 	} 
				 	if(!empty($array1[3]))
				 	{
				 		$id4=$array1[3];
				 		$id_r4=hist_re4a_id($conn,$idhistorial,$id4);
				 		$id_r4=$id_r4['idhistorial_rec'];
				 	} 
				 	if(!empty($array1[4]))
				 	{
				 		$id5=$array1[4];
				 		$id_r5=hist_re5a_id($conn,$idhistorial,$id5);
				 		$id_r5=$id_r5['idhistorial_rec'];
				 	}
						

						
				  		while ($recurso2= mysqli_fetch_array($idrecurso)) 
				   		{	


				   			if ($recurso2["idrecurso"] ==$id1 || $recurso2["idrecurso"] ==$id2 || $recurso2["idrecurso"] ==$id3 || $recurso2["idrecurso"] ==$id4 || $recurso2["idrecurso"] ==$id5 ) 
								{	
									$checked="checked";
								//echo $array[0].' _ '.$array[1].' _ '.$array[2].' _ '.$array[3].' _ '.$array[4].' _ '.$array[5];	
								}
								else
								{
									$checked="";
								}
								
								
				   			?>
				   			
							<div class="row" id="row">
		                     <input type="checkbox" name="recurso[]" id="recurso_hist" <?php echo $checked?>  value="<?php echo $recurso2["idrecurso"] ?>"><label id="rowl"><?php echo $recurso2["nombrerecurso"]?> </label>  
		                            </div>
				
						  
								
							
				   	<?php 
				   	
				   	$i++;
					} 
		  	
	  	 	} 



?>	
	  	 </div>


<!--//////////////////////////////////////////////////////////////////////////////////////////////////Para comprobar checksbox-->
<?php
$m =$max+1;
?>

<script>
var m = "<?php echo $m; ?>" ;
document.write("");
</script>

		
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
 
		var cantidadMaxima=m;
 
		// Comprovamos si supera la cantidad máxima indicada
		if(contador>cantidadMaxima)
		{
			alert("El numero de recursos supera a los que previamente se habian seleccionado");
 
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
		<input type="submit" id="enviar" align="middle" name="actualizar_historial">
<?php
		if (!empty($_GET['alerta'])) 
		{
			$alerta=$_GET['alerta'];
		}
	?>
	<div class="alerta"><?php echo isset($alerta) ? $alerta : ''; ?> </div>

<input type="hidden" name="id_r5" value="<?php echo $id_r5; ?>">
<input type="hidden" name="id_r4" value="<?php echo $id_r4; ?>">
<input type="hidden" name="id_r3" value="<?php echo $id_r3; ?>">
<input type="hidden" name="id_r2" value="<?php echo $id_r2; ?>">
<input type="hidden" name="id_r1" value="<?php echo $id_r1; ?>">

<input type="hidden" name="id_hm5" value="<?php echo $id_hm5; ?>">
<input type="hidden" name="id_hm4" value="<?php echo $id_hm4; ?>">
<input type="hidden" name="id_hm3" value="<?php echo $id_hm3; ?>">
<input type="hidden" name="id_hm2" value="<?php echo $id_hm2; ?>">
<input type="hidden" name="id_hm1" value="<?php echo $id_hm1; ?>">

	</form>
	</div>
	<?php require'abajo.php'?>
</body>
</html>