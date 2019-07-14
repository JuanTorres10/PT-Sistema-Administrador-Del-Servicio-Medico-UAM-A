<?php
session_start();
require '../model/usuario_m.php';

if(empty($_SESSION['active']))
{
	header('Location:../index.php');
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (!empty($_POST['agregar_usuario'])) 
{
	$alerta = '';
	if(empty($_POST['nombre']) || empty($_POST['apellidop']) || empty($_POST['apellidom']) || empty($_POST['edad']) || empty($_POST['correo'])|| empty($_POST['sexo'])|| empty($_POST['matricula'])   )
	{
		$alerta = '<p class="msg_error">   Debes llenar los campos; son obligatorios </p>';
		header("Location:../view/formulariousuario.php?alerta=$alerta");
		exit();
	}
	else
		{
			$nombre=$_POST['nombre'];
			$apellidop=$_POST['apellidop'];
			$apellidom=$_POST['apellidom'];
			$edad=$_POST['edad'];
			$correo=$_POST['correo'];
			$sexo=$_POST['sexo'];
			$matricula=$_POST['matricula'];
		 
			$resultado=usuario_existe($matricula,$conn);
			if($resultado > 0)
				{
					$alerta = '<p class="msg_error"> La matricula ya existe </p>';
					header("Location:../view/formulariousuario.php?alerta=$alerta&nombre=$nombre&apellidop=$apellidop&apellidom=$apellidom&edad=$edad&correo=$correo&sexo=$sexo");
				}
				else
					{
						
						$inserta=agrega_usuario($nombre,$apellidop,$apellidom,$edad,$correo,$sexo,$matricula,$conn);
						if($inserta>0)
						{
							$alerta = '<p class="msg_save"> Paciente agregado exitosamente  </p>';
							header("Location:../view/formulariousuario.php?alerta=$alerta");
						}
							else
							{
								$alerta = '<p class="msg_error"> Error al crear paciente </p>';
								header("Location:../view/formulariousuario.php?alerta=$alerta");
							}
					}			
		}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if (!empty($_POST['actualizar_paciente'])) 
{
	if ($_SESSION['idrol'] != 1 && $_SESSION['idrol'] != 2) 
	{
		header('Location:../view/Bienvenida.php');
	}
		$alerta = '';
		$idpacientes=$_POST['idpacientes'];
	if(empty($_POST['nombre']) || empty($_POST['apellidop']) || empty($_POST['apellidom']) || empty($_POST['edad']) || empty($_POST['correo'])|| empty($_POST['sexo'])|| empty($_POST['matricula']))
	{
		$alerta = '<p class="msg_error">   Debes llenar los campos; son obligatorios </p>';
		header("Location:../view/editarpaciente2.php?id=$idpacientes&alerta=$alerta");
		exit();
	}
		else
		{
			$idpacientes=$_POST['idpacientes'];
			$nombre=$_POST['nombre'];
			$apellidop=$_POST['apellidop'];
			$apellidom=$_POST['apellidom'];
			$edad=$_POST['edad'];
			$correo=$_POST['correo'];
			$sexo=$_POST['sexo'];
			$matricula=$_POST['matricula'];


			$resultado=id_matricula_existe($conn,$matricula,$idpacientes);
			if($resultado > 0)
				{
					$alerta = '<p class="msg_error"> La matricula ya existe </p>';
					header("Location:../view/editarpaciente2.php?id=$idpacientes&alerta=$alerta");
				}
				else
					{
						$update=actualizar_usuario($conn,$nombre,$apellidop,$apellidom,$edad,$correo,$sexo,$matricula,$idpacientes);

						if($update>0)
						{
							$alerta = '<p class="msg_save"> Paciente actualizado exitosamente  </p>';
							header("Location:../view/editarpaciente2.php?id=$idpacientes&alerta=$alerta");
						}
							else
							{
								$alerta = '<p class="msg_error"> No se realizaron cambios </p>';
								header("Location:../view/editarpaciente2.php?id=$idpacientes&alerta=$alerta");

							}
					}
			
		}	
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($usuario))
{
		if (empty($_GET['id'])) 
		{
			header('Location:../view/editarpaciente.php');	
		}

		$id= $_GET['id'];
		$resul_my=id($conn,$id);
		if ($resul_my == 0) 
		{
			header('Location:../view/editarpaciente.php');
			
		}
			else
			{	$my=id2($conn,$id);
				while ($datos=mysqli_fetch_array($my)) 
				{
					$idpacientes = $datos['idpacientes'];
					$nombre	 = $datos['nombre'];
					$apellidopaterno = $datos['apellidopaterno'];
					$apellidomaterno = $datos['apellidomaterno'];
					$edad = $datos['edad'];
					$correo = $datos['correo'];
					$sexo = $datos['sexo'];
					$matricula = $datos['matricula'];
				}
			}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($eliminar))
{
	if(empty($_REQUEST['id']))
	{
		header("Location:../view/editarpaciente.php");
	}
	else
	{
		 $id=$_REQUEST['id'];
		 $res=id_eliminar($conn, $id);
		 if($res > 0)
		 {	
		 	$query=id_eliminar2($conn,$id);
		 	while ($datos= mysqli_fetch_array($query)) 
		 	{
		 		$nombre = $datos['nombre'];
		 		$correo = $datos['correo'];
		 		$matricula= $datos['matricula'];
		 	}
		 }
		 	else
		 	{
		 		header("Location:../view/editarpaciente.php");
		 	}
	}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (!empty($_POST['eliminar_usuario'])) 
{
	if ($_SESSION['idrol'] != 1 && $_SESSION['idrol'] != 2) 
	{
		header('Location:../view/Bienvenida.php');
	}
	
	$id= $_POST['id'];
	//$query= mysqli_query($conn," DELETE FROM pacientes WHERE idpacientes =$id");
	
	$query=eliminar_usuario($conn,$id);
	if ($query>0) 
	{
		header("Location:../view/editarpaciente.php");		
	}
		else
		{
			echo 'Error al eliminar el paciente';
		}
}
//////////////////////////////////////////////// DOCTORES //////////////////////////////////////////////////////////////////////////


if (!empty($_POST['agregar_doc'])) 
{
	if ($_SESSION['idrol'] != 1 && $_SESSION['idrol'] != 2) 
	{
		header('Location:../view/Bienvenida.php');
	}
	$alerta = '';
	if(empty($_POST['nombredoc']) || empty($_POST['apellidopdoc']) || empty($_POST['apellidomdoc']) || empty($_POST['especialidaddoc']) || empty($_POST['turno'])|| empty($_POST['ced'])|| empty($_POST['login'])|| empty($_POST['opcion'])|| empty($_POST['pass'])   )
	{
		$alerta = '<p class="msg_error">   Debes llenar los campos; son obligatorios </p>';
		header("Location:../view/formulariodoctor.php?alerta=$alerta");
		exit();
	}
		else
		{				
						if ($_POST['opcion']==1) 
						{
							$rol_1= '<option value="1" select>Admin </option>';
							
						}
						else if ($_POST['opcion']==2) 
						{
							$rol_1= '<option value="2" select>Medicos</option>';
							
						}
						else if ($_POST['opcion']==3) 
						{
							$rol_1= '<option value="2" select>Enfermer@s</option>';							
						}
			$nombredoc=$_POST['nombredoc'];
			$apellidopdoc=$_POST['apellidopdoc'];
			$apellidomdoc=$_POST['apellidomdoc'];
			$especialidaddoc=$_POST['especialidaddoc'];
			$turno=$_POST['turno'];
			$ced=$_POST['ced'];
			$login=$_POST['login'];
			$opcion=$_POST['opcion'];
			$pass=md5($_POST['pass']);
	
			$resultado= login_existe($conn,$login);
			if($resultado > 0)
				{
					$alerta = '<p class="msg_error"> El numero economico ya existe </p>';
					header("Location:../view/formulariodoctor.php?alerta=$alerta&nombredoc=$nombredoc&apellidopdoc=$apellidopdoc&apellidomdoc=$apellidomdoc&especialidaddoc=$especialidaddoc&turno=$turno&ced=$ced&login=$login&rol_1=$rol_1");
				}
				else
					{    
					   $inserta=inserta_login($conn,$login,$pass);
					   $ultimo_id = mysqli_insert_id($conn);

						if($inserta>0)
						{							
							$inserta_doc=inserta_doc($conn,$opcion,$nombredoc,$apellidopdoc,$apellidomdoc,$especialidaddoc,$turno,$ced,$ultimo_id);

							if($inserta_doc > 0)
							{
								$alerta = '<p class="msg_save"> Doctor agregado exitosamente  </p>';
								header("Location:../view/formulariodoctor.php?alerta=$alerta");
							}
								
						}
						else
								{
									
									$query=elimina_login($conn,$ultimo_id);
									$alerta = '<p class="msg_error"> Error al crear doctor </p>';
									header("Location:../view/formulariodoctor.php?alerta=$alerta");
								}
					}			
		}	
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (!empty($_POST['actualizar_doc']))
{		 
		if ($_SESSION['idrol'] != 1 && $_SESSION['idrol'] != 2) 
		{
		header('Location:../view/Bienvenida.php');
		}

		$alerta = '';
		$iddoctores=$_POST['iddoctores'];
		if(empty($_POST['nombredoc']) || empty($_POST['apellidopdoc']) || empty($_POST['apellidomdoc']) || empty($_POST['especialidaddoc']) || empty($_POST['turno'])|| empty($_POST['ced'])|| empty($_POST['login'])|| empty($_POST['opcion']))
		{
			$alerta = '<p class="msg_error">   Debes llenar los campos; son obligatorios </p>';
			header("Location:../view/editardoctor2.php?id=$iddoctores&alerta=$alerta");
			exit();
		}
			else
			{
				
				$iddoctores=$_POST['iddoctores'];
				$nombre=$_POST['nombredoc'];
				$apellidop=$_POST['apellidopdoc'];
				$apellidom=$_POST['apellidomdoc'];
				$especialidaddoc=$_POST['especialidaddoc'];
				$turno=$_POST['turno'];
				$ced=$_POST['ced'];
				$login=$_POST['login'];
				$opcion=$_POST['opcion'];
				$pass=md5($_POST['pass']);
				$d_idlogin=$_POST['d_idlogin'];

			 
				
				$resultado=economico_existe($conn,$login,$d_idlogin) ;
				if($resultado > 0)
					{
						$alerta = '<p class="msg_error"> El numero economico ya existe </p>';
						header("Location:../view/editardoctor2.php?id=$iddoctores&alerta=$alerta");
						exit();
					}
					else
						{	
							if (empty($_POST['pass'])) 
							{	
								 $update=actualiza_doc_sin_pass($conn,$login,$d_idlogin,$nombre,$apellidop,$apellidom,$especialidaddoc,$turno,$ced,$opcion,$iddoctores);	
								if($update>0)
										{	
											$alerta = '<p class="msg_save"> Doctor actualizado exitosamente  </p>';
											header("Location:../view/editardoctor2.php?id=$iddoctores&alerta=$alerta");
										}

											else
											{
												$alerta = '<p class="msg_error"> No se realizaron cambios </p>';
												header("Location:../view/editardoctor2.php?id=$iddoctores&alerta=$alerta");

											}
							}

								else
								{
									
									$updatepass=actualizar_contraseña_doc($conn,$pass,$login,$d_idlogin) ;
									if($updatepass) 
									{	
										$update=actualiza_doc_con_pass($conn,$nombre,$apellidop,$apellidom,$especialidaddoc,$turno,$ced,$d_idlogin,$opcion,$iddoctores) ;
										if($update>0 || $updatepass>0)
										{	
											$alerta = '<p class="msg_save"> Doctor actualizado exitosamente  </p>';
											header("Location:../view/editardoctor2.php?id=$iddoctores&alerta=$alerta");
										}
											else
											{
												$alerta = '<p class="msg_error"> No se realizaron cambios </p>';
												header("Location:../view/editardoctor2.php?id=$iddoctores&alerta=$alerta");
											}
									}
									else
									{
										$alerta = '<p class="msg_error"> Error al actualizar contraseña </p>';
										header("Location:../view/editardoctor2.php?id=$iddoctores&alerta=$alerta");	
									}	
								}
						}	
			}	
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($actualizar_doc))
{
			if (empty($_GET['id'])) 
			{
				header('Location:../view/editardoctor.php');
				
			}

			$id= $_GET['id'];
			
			$my=llenar_doc ($conn,$id) ;
			$resul_my= mysqli_num_rows($my);
			if ($resul_my == 0) 
			{
				header('Location:../view/editardoctor.php');
				
			}
				else
				{
					$opcion='';
					while ($datos=mysqli_fetch_array($my)) 
					{
						
						$iddoctores = $datos['iddoctores'];
						$idrol= $datos['idrol'];
						$nombredoc=$datos['nombre'];
						$apellidopdoc=$datos['apellidopaterno'];
						$apellidomdoc=$datos['apellidomaterno'];
						$especialidaddoc=$datos['especialidad'];
						$turno=$datos['turno'];
						$ced=$datos['cedprof'];
						$login=$datos['login'];
						$opcion=$datos['descripcion'];
						$d_idlogin=$datos['idlogin'];

						if ($idrol==1) 
						{
							$opcion= '<option value="'.$idrol.'" select> '.$opcion.'</option>';
							
						}
						else if ($idrol==2) 
						{
							$opcion= '<option value="'.$idrol.'" select> '.$opcion.'</option>';
							
						}

						else if ($idrol==3) 
						{
							$opcion= '<option value="'.$idrol.'" select> '.$opcion.'</option>';
							
						}

					}

				}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($eliminar_doc))
{
	if(empty($_REQUEST['id']) || $_REQUEST['id']==1 || $_REQUEST['id']==5)
	{
		header("Location:../view/editardoctor.php");

	}
		else
		{
			 $id=$_REQUEST['id'];

			 
			 $res=id_doc_eliminar($conn,$id) ;

			 if($res > 0)
			 {
			 	$query=id_doc_eliminar2($conn,$id);
			 	while ($datos= mysqli_fetch_array($query)) 
			 	{
			 		$nombre = $datos['nombre'];
			 		$especialidad = $datos['especialidad'];
			 		$cedprof= $datos['cedprof'];
			 		$idlogin= $datos['login'];
			 		$descripcion= $datos['descripcion'];
			 		$login_id= $datos['id'];		 		
			 	}
			 }
			 	else
			 	{
			 		header("Location:../view/editardoctor.php");
			 	}
		}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (!empty($_POST['eliminar_doc'])) 
{
	if ($_SESSION['idrol'] != 1 && $_SESSION['idrol'] != 2) 
	{
		header('Location:../view/Bienvenida.php');
	}
	if(empty($_SESSION['active']))
	{
		header('Location:../index.php');
	}	
	if ($_POST['id']==1 || $_POST['id']==5 )
	{
		header("Location:../view/editardoctor.php");
		exit;
	}
	$id= $_POST['id'];
	$login_id= $_POST['login_id'];
	$query= eliminar_doc($conn,$id);
	$borrar_login= eliminar_login($conn,$login_id);	
	if ($query > 0 && $borrar_login >0) 
	{
		header("Location:../view/eliminardoctor.php");	
	}
		else
		{
			echo '<p class="msg_error"> Error al eliminar el doctor </p>';
		}
}

///////////////////////////////////////     HISTORIAL         ///////////////////////////////////////////////////////////////////////
if(!empty($_GET['term']))
{
$searchTerm = $_GET['term'];
//obtenemos encontrados datos desde matricula tabla
$query = $conn->query("SELECT matricula FROM pacientes WHERE matricula LIKE '%".$searchTerm."%' AND estatus = 1 ");
while ($row = $query->fetch_assoc()) {
    $data[] = $row['matricula'];
}
//regreso json datos
echo json_encode($data);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if (!empty($_POST['agregar_historial'])) 
{
	if ($_SESSION['idrol'] != 1 && $_SESSION['idrol'] != 2) 
	{
		header('Location:../view/Bienvenida.php');
	}

	$idlogin=$_SESSION['idlogin'];

	if(empty($_SESSION['active']))
	{
		header('Location:../index.php');
	}
	
	$alerta = '';
	if(empty($_POST['matricula']) || empty($_POST['fechahist']) || empty($_POST['horahist']) || empty($_POST['tratamiento']) || empty($_POST['causa'])|| empty($_POST['descripcioncausa']))
	{
		$alerta = '<p class="msg_error">   Debes llenar los campos; son obligatorios </p>';
		header("Location:../view/historial.php?alerta=$alerta");
		exit();
	}
		else
		{			
			$matricula=$_POST['matricula'];
			$fechahist=$_POST['fechahist'];
			$horahist=$_POST['horahist'];
			$tratamiento=$_POST['tratamiento'];
			
			$causa=$_POST['causa'];
			$descripcioncausa=$_POST['descripcioncausa'];
			$medicina1='';
			$medicina2='';
			$medicina3='';
			$medicina4='';
			$medicina5='';
			$recurso1='';
			$recurso2='';
			$recurso3='';
			$recurso4='';
			$recurso5='';
			if(!empty($_POST['medicina5']))
			{
				$medicina5=$_POST['medicina5'];	
			}
			if(!empty($_POST['medicina4']))
			{
				$medicina4=$_POST['medicina4'];	
			}
			if(!empty($_POST['medicina3']))
			{
				$medicina3=$_POST['medicina3'];	
			}
			if(!empty($_POST['medicina2']))
			{
				$medicina2=$_POST['medicina2'];	
			}
			if(!empty($_POST['medicina1']))
			{
				$medicina1=$_POST['medicina1'];	
			}
			
			
			
			if(!empty($_POST['medicina6']))
			{
				$alerta = '<p class="msg_error"> El numero de medicinas excede a 5 </p>';
					header("Location:../view/historial.php?alerta=$alerta&fechahist=$fechahist&horahist=$horahist&tratamiento=$tratamiento&causa=$causa&descripcioncausa=$descripcioncausa");
					exit();
			}
			if(!empty($_POST['recurso']))
			{
				foreach($_POST['recurso'] as $valor[])
				{
					$valor;
				}
				if(!empty($valor[0]))
				{
					$recurso1=$valor[0];
				}
				if(!empty($valor[1]))
				{
					$recurso2=$valor[1];
				}
				if(!empty($valor[2]))
				{
					$recurso3=$valor[2];
				}
				if(!empty($valor[3]))
				{
					$recurso4=$valor[3];
				}
				if(!empty($valor[4]))
				{
					$recurso5=$valor[4];
				}
					
			}
			
			$ultimo_idhistorial='';
			
			$resultado=historial_matricula_existe($conn,$matricula) ;

				if($resultado == 0)
				{	
					$alerta = '<p class="msg_error"> La matricula no existe </p>';
					header("Location:../view/historial.php?alerta=$alerta&fechahist=$fechahist&horahist=$horahist&tratamiento=$tratamiento&causa=$causa&descripcioncausa=$descripcioncausa");
					exit();
				}
				if ($resultado > 0) 
				{
					///////Consultar y pasar a array y tambien puedo ver el valor dentro de el; usando una variable
					////////////////  Para causa
					
					$idcausa=id_causa($conn,$causa,$descripcioncausa);
					$resultado_idcausa=resultado_idcausa($conn,$causa,$descripcioncausa);

					//////////////////  Para medicamento
					
					//$idmedicamentos=id_medicamentos($conn,$nombremedicamento,$presentacion);
					//$resultado_idmedicamentos=resultado_idmedicamentos($conn,$nombremedicamento,$presentacion);
					//////////////////  Para paciente
					
					$idpaciente=id_paciente($conn,$matricula);

					//////////////////  Para doctor
					
					$idl=id_de_login($conn,$idlogin);
					$iddoc=id_doctores($conn,$idl);

					if ($resultado_idcausa >0) /////////////////////////////////////////////// hay idcausa
					{
						
					 $inserta_historial=inserta_historial($conn,$iddoc,$idpaciente,$fechahist,$horahist,$tratamiento,$idcausa);//pasar id doctor y paciente
					 	if($inserta_historial>0) 
						{						
									$ultimo_idhistorial = mysqli_insert_id($conn);
									$alerta = '<p class="msg_save"> Historial agregado exitosamente  </p>';
								header("Location:../view/historial.php?alerta=$alerta");

								if(!empty($medicina5)) 
								{						
									$hist_m5=hist_m5($conn,$ultimo_idhistorial,$medicina5);
									$alerta = '<p class="msg_save"> Historial agregado exitosamente  </p>';
									header("Location:../view/historial.php?alerta=$alerta");				
								}

								if(!empty($medicina4)) 
								{						
									$hist_m4=hist_m4($conn,$ultimo_idhistorial,$medicina4);
									$alerta = '<p class="msg_save"> Historial agregado exitosamente  </p>';
									header("Location:../view/historial.php?alerta=$alerta");				
								}

								if(!empty($medicina3)) 
								{						
									$hist_m3=hist_m3($conn,$ultimo_idhistorial,$medicina3);
									$alerta = '<p class="msg_save"> Historial agregado exitosamente  </p>';
									header("Location:../view/historial.php?alerta=$alerta");				
								}

								if(!empty($medicina2)) 
								{						
									$hist_m2=hist_m2($conn,$ultimo_idhistorial,$medicina2);
									$alerta = '<p class="msg_save"> Historial agregado exitosamente  </p>';
									header("Location:../view/historial.php?alerta=$alerta");				
								}

								if(!empty($medicina1)) 
								{						
									$hist_m1=hist_m1($conn,$ultimo_idhistorial,$medicina1);
									$alerta = '<p class="msg_save"> Historial agregado exitosamente  </p>';
									header("Location:../view/historial.php?alerta=$alerta");				
								}
								/////recursos

								if(!empty($recurso5)) 
								{						
									$hist_r5=hist_re5($conn,$ultimo_idhistorial,$recurso5);
									$alerta = '<p class="msg_save"> Historial agregado exitosamente  </p>';
									header("Location:../view/historial.php?alerta=$alerta");				
								}

								if(!empty($recurso4)) 
								{						
									$hist_r4=hist_re4($conn,$ultimo_idhistorial,$recurso4);
									$alerta = '<p class="msg_save"> Historial agregado exitosamente  </p>';
									header("Location:../view/historial.php?alerta=$alerta");				
								}

								if(!empty($recurso3)) 
								{						
									$hist_r3=hist_re3($conn,$ultimo_idhistorial,$recurso3);
									$alerta = '<p class="msg_save"> Historial agregado exitosamente  </p>';
									header("Location:../view/historial.php?alerta=$alerta");				
								}

								if(!empty($recurso2)) 
								{						
									$hist_r2=hist_re2($conn,$ultimo_idhistorial,$recurso2);
									$alerta = '<p class="msg_save"> Historial agregado exitosamente  </p>';
									header("Location:../view/historial.php?alerta=$alerta");				
								}

								if(!empty($recurso1)) 
								{						
									$hist_r1=hist_re1($conn,$ultimo_idhistorial,$recurso1);
									$alerta = '<p class="msg_save"> Historial agregado exitosamente  </p>';
									header("Location:../view/historial.php?alerta=$alerta");				
								}



						}					
						else
						{
								$alerta = '<p class="msg_error"> Error al crear historial </p>';
								header("Location:../view/historial.php?alerta=$alerta&fechahist=$fechahist&horahist=$horahist&tratamiento=$tratamiento&causa=$causa&descripcioncausa=$descripcioncausa");
						}
					}
						else ////////////////////////////////no hay id causa
						{
							
							$inserta_causa=inserta_causa($conn,$causa,$descripcioncausa) ;

							if ($inserta_causa>0)
							{ 
							$ultimo_id = mysqli_insert_id($conn);  
							
							$inserta_historial=inserta_historial_sin_causa($conn,$iddoc,$idpaciente,$fechahist,$horahist,$tratamiento,$ultimo_id);
								
									$ultimo_idhistorial = mysqli_insert_id($conn);
								if($inserta_historial>0) 
								{
										$ultimo_idhistorial = mysqli_insert_id($conn);	
										$alerta = '<p class="msg_save"> Historial agregado exitosamente  </p>';
									header("Location:../view/historial.php?alerta=$alerta");
									
									if(!empty($medicina5)) 
									{						
										$hist_m5=hist_m5($conn,$ultimo_idhistorial,$medicina5);
										$alerta = '<p class="msg_save"> Historial agregado exitosamente  </p>';
										header("Location:../view/historial.php?alerta=$alerta");				
									}

									if(!empty($medicina4)) 
									{						
										$hist_m4=hist_m4($conn,$ultimo_idhistorial,$medicina4);
										$alerta = '<p class="msg_save"> Historial agregado exitosamente  </p>';
										header("Location:../view/historial.php?alerta=$alerta");				
									}

									if(!empty($medicina3)) 
									{						
										$hist_m3=hist_m3($conn,$ultimo_idhistorial,$medicina3);
										$alerta = '<p class="msg_save"> Historial agregado exitosamente  </p>';
										header("Location:../view/historial.php?alerta=$alerta");				
									}

									if(!empty($medicina2)) 
									{						
										$hist_m2=hist_m2($conn,$ultimo_idhistorial,$medicina2);
										$alerta = '<p class="msg_save"> Historial agregado exitosamente  </p>';
										header("Location:../view/historial.php?alerta=$alerta");				
									}

									if(!empty($medicina1)) 
									{						
										$hist_m1=hist_m1($conn,$ultimo_idhistorial,$medicina1);
										$alerta = '<p class="msg_save"> Historial agregado exitosamente  </p>';
										header("Location:../view/historial.php?alerta=$alerta");				
									}
									/////recursos

									if(!empty($recurso5)) 
									{						
										$hist_r5=hist_re5($conn,$ultimo_idhistorial,$recurso5);
										$alerta = '<p class="msg_save"> Historial agregado exitosamente  </p>';
										header("Location:../view/historial.php?alerta=$alerta");				
									}

									if(!empty($recurso4)) 
									{						
										$hist_r4=hist_re4($conn,$ultimo_idhistorial,$recurso4);
										$alerta = '<p class="msg_save"> Historial agregado exitosamente  </p>';
										header("Location:../view/historial.php?alerta=$alerta");				
									}

									if(!empty($recurso3)) 
									{						
										$hist_r3=hist_re3($conn,$ultimo_idhistorial,$recurso3);
										$alerta = '<p class="msg_save"> Historial agregado exitosamente  </p>';
										header("Location:../view/historial.php?alerta=$alerta");				
									}

									if(!empty($recurso2)) 
									{						
										$hist_r2=hist_re2($conn,$ultimo_idhistorial,$recurso2);
										$alerta = '<p class="msg_save"> Historial agregado exitosamente  </p>';
										header("Location:../view/historial.php?alerta=$alerta");				
									}

									if(!empty($recurso1)) 
									{						
										$hist_r1=hist_re1($conn,$ultimo_idhistorial,$recurso1);
										$alerta = '<p class="msg_save"> Historial agregado exitosamente  </p>';
										header("Location:../view/historial.php?alerta=$alerta");				
									}


								}
								else
								{
									$alerta = '<p class="msg_error"> Error al crear historial </p>';
									header("Location:../view/historial.php?alerta=$alerta&fechahist=$fechahist&horahist=$horahist&tratamiento=$tratamiento&causa=$causa&descripcioncausa=$descripcioncausa");
								}
							}
							
						}
					/*if ($resultado_idmedicamentos>0) //////////////////cuando hay idmedicamentos
					{
					
					 
					 $inserta_historial_medicamento=inserta_historial_medicamento($conn,$ultimo_idhistorial,$idmedicamentos,$descripcion_medicamento) ;
					 	if ($inserta_historial_medicamento>0) 
					 	{	
					 		$alerta = '<p class="msg_save"> Historial agregado exitosamente  </p>';
					 		header("Location:../view/historial.php?alerta=$alerta");
					 	}	
							else
							{
								$alerta = '<p class="msg_error"> Error al crear historial </p>';
								header("Location:../view/historial.php?alerta=$alerta");
							}
					}*/
						/*else ////////////////////////////////// cuando NO hay idmedicamentos
						{	
							
							$inserta_idmedicamento=inserta_idmedicamento($conn,$nombremedicamento,$presentacion) ;
							if ($inserta_idmedicamento>0) 
							{
								$ultimo_idmedicamento = mysqli_insert_id($conn);
								 
								$inserta_historial_medicamento=inserta_historial_sin_medicamento($conn,$ultimo_idhistorial,$ultimo_idmedicamento,$descripcion_medicamento) ; 								
							}
							if($inserta_historial_medicamento>0)
							{   
								$alerta = '<p class="msg_save"> Historial agregado exitosamente  </p>';
								header("Location:../view/historial.php?alerta=$alerta");
							}
							else
							{
								$alerta = '<p class="msg_error"> Error al crear historial </p>';
								header("Location:../view/historial.php?alerta=$alerta");
							}
						}*/	
				}
		}						
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if(!empty($editarhistorial))
{
		if (empty($_GET['id'])) 
		{
			header('Location:../view/historial.php');
		}

		$id= $_GET['id'];
		
		$resul_my=llenar_actualizar_historial($conn,$id) ;
		if ($resul_my == 0) 
		{
			header('Location:../view/adminhistorial.php');
		}
			else
			{	$my=llenar_actualizar_historial2($conn,$id);
				
				foreach ($my as $key => $value) 
				{
					$arr_data[] = $value;
					
				}
				
					$idhistorial = $arr_data[0]['id'];
					$matricula	 = $arr_data[0]['paciente'];
					$fecha = $arr_data[0]['fecha'];
					$hora = $arr_data[0]['hora'];
					$tratamiento = $arr_data[0]['tratamiento'];
					$nombrecausa = $arr_data[0]['nombrecausa'];
					$descripcion = $arr_data[0]['descripcion'];
					
					
					$contador=0;
					
					$i=0;	
					$j=0;

					$array = array();
					$arrayid = array();

				/*	while ( $i<= count($arr_data) )
				{
					
						if(!($arr_data[$i%count($arr_data)]["medicamentosnombre"]==$arr_data[($i+1)%count($arr_data)]["medicamentosnombre"]) )
						{
							
							$idmedicamentos = $arr_data[$i]['idmedicamentos'];
							$medicina1 = $arr_data[$i]['medicamentosnombre'];
							array_push($array, $medicina1);

							$j++;
							echo "while";
							
						}

				 	if($i==(count($arr_data)))
					 {
					 	$idmedicamentos = $arr_data[0]['idmedicamentos'];
								$medicina1 = $arr_data[0]['medicamentosnombre'];
								array_push($array, $medicina1);

								$j++;
								echo "es1";
					 }

					 $i++;
				}

				 */
					
				while ( !($i+1 == count($arr_data)) )
				{

					
						if($arr_data[$i]["medicamentosnombre"]==$arr_data[$i+1]["medicamentosnombre"])
						{
							
						}

						else
						{

							$idmedicamentos = $arr_data[$i]['idmedicamentos'];
							$medicina1 = $arr_data[$i]['medicamentosnombre'];
							
							
							

								//$array = array("", "", "", "","");
										array_push($array, $medicina1);
										array_push($arrayid, $idmedicamentos);

										//$array[$i]=$medicina1;
										
										
						
								

						}
				 	$i++;
				 }

				 if($i==(count($arr_data)-1))
				 {
				 	$idmedicamentos = $arr_data[$i]['idmedicamentos'];
					 $medicina1 = $arr_data[$i]['medicamentosnombre'];

					 array_push($array, $medicina1);
					 array_push($arrayid, $idmedicamentos);
					
				 }		
							
							
						

 						 $med1='';
						 $med2='';
						 $med3='';
						 $med4='';
						 $med5='';

				 	if(!empty($array[0]))
				 	{
				 		$med1=$array[0];
				 	} 
				 	if(!empty($array[1]))
				 	{
				 		$med2=$array[1];
				 	} 
				 	if(!empty($array[2]))
				 	{
				 		$med3=$array[2];
				 	} 
				 	if(!empty($array[3]))
				 	{
				 		$med4=$array[3];
				 	} 
				 	if(!empty($array[4]))
				 	{
				 		$med5=$array[4];
				 	} 

				 		 $medicina1='';
						 $medicina2='';
						 $medicina3='';
						 $medicina4='';
						 $medicina5='';

				 	if(!empty($arrayid[0]))
				 	{
				 		$medicina1=$arrayid[0];
				 		$id_hm1=hist_m1a_id($conn,$idhistorial,$medicina1);
				 		$id_hm1=$id_hm1['idhistorial_med'];

				 	} 
				 	if(!empty($arrayid[1]))
				 	{
				 		$medicina2=$arrayid[1];
				 		$id_hm2=hist_m2a_id($conn,$idhistorial,$medicina2);
				 		$id_hm2=$id_hm2['idhistorial_med'];
				 	} 
				 	if(!empty($arrayid[2]))
				 	{
				 		$medicina3=$arrayid[2];
				 		$id_hm3=hist_m3a_id($conn,$idhistorial,$medicina3);
				 		$id_hm3=$id_hm3['idhistorial_med'];
				 	} 
				 	if(!empty($arrayid[3]))
				 	{
				 		$medicina4=$arrayid[3];
				 		$id_hm4=hist_m4a_id($conn,$idhistorial,$medicina4);	
				 		$id_hm4=$id_hm4['idhistorial_med'];					
				 	} 
				 	if(!empty($arrayid[4]))
				 	{
				 		$medicina5=$arrayid[4];
				 		$id_hm5=hist_m5a_id($conn,$idhistorial,$medicina5);
				 		$id_hm5=$id_hm5['idhistorial_med'];
				 	}
		////////////// recurso
				 	$recurso_che=recurso_che($conn,$id);

				 	foreach ($recurso_che as $key => $value) 
							{
								$arr[] = $value;
								
							}
							$max=count($arr);
							
							$array1 = array();
							$i=0;
				while ( !($i+1 == count($arr)) )
				{
					
						if($arr[$i]["idrecurso"]==$arr[$i+1]["idrecurso"])
						{
							
						}

						else
						{
							$check = $arr[$i]["idrecurso"];
							
										array_push($array1, $check);
						}
				 	$i++;
				 }
				 if($i==(count($arr)-1))
				 {
				 	$check = $arr[$i]['idrecurso'];
					 array_push($array1, $check);
				 }

			}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
if (!empty($_POST['actualizar_historial'])) 
{
		$idlogin=$_SESSION['idlogin'];
	if ($_SESSION['idrol'] != 1 && $_SESSION['idrol'] != 2) 
	{
		header('Location:../view/Bienvenida.php');
	}

	if(empty($_SESSION['active']))
	{
		header('Location:../index.php');
	}	
		$alerta = '';
		$alerta2 = '';
		
		$idhistorial=$_POST['idhistorial'];
		

		$idhistorial=$_POST['idhistorial'];
	
		if(empty($_POST['matricula']) || empty($_POST['fechahist']) || empty($_POST['horahist']) || empty($_POST['tratamiento']) || empty($_POST['causa'])|| empty($_POST['descripcioncausa']))
		{
			$alerta = '<p class="msg_error">   Debes llenar los campos; son obligatorios </p>';
			header("Location:../view/editarhistorial.php?id=$idhistorial&alerta=$alerta");
			exit();
		}
			else
			{

				$idhistorial=$_POST['idhistorial'];
				$matricula=$_POST['matricula'];
				$fechahist=$_POST['fechahist'];
				$horahist=$_POST['horahist'];
				$tratamiento=$_POST['tratamiento'];
				$causa=$_POST['causa'];
				$descripcioncausa=$_POST['descripcioncausa'];
				$id_r1=$_POST['id_r1'];
				$id_r2=$_POST['id_r2'];
				$id_r3=$_POST['id_r3'];
				$id_r4=$_POST['id_r4'];
				$id_r5=$_POST['id_r5'];



				$id_hm5=$_POST['id_hm5'];
				$id_hm4=$_POST['id_hm4'];
				$id_hm3=$_POST['id_hm3'];
				$id_hm2=$_POST['id_hm2'];
				$id_hm1=$_POST['id_hm1'];

				$medicina1='';
				$medicina2='';
				$medicina3='';
				$medicina4='';
				$medicina5='';
				$recurso1='';
				$recurso2='';
				$recurso3='';
				$recurso4='';
				$recurso5='';
				if(!empty($_POST['medicina5']))
				{
					$medicina5=$_POST['medicina5'];	
				}
				if(!empty($_POST['medicina4']))
				{
					$medicina4=$_POST['medicina4'];	
				}
				if(!empty($_POST['medicina3']))
				{
					$medicina3=$_POST['medicina3'];	
				}
				if(!empty($_POST['medicina2']))
				{
					$medicina2=$_POST['medicina2'];	
				}

				if(!empty($_POST['medicina1']))
				{
					$medicina1=$_POST['medicina1'];	
				}
				
				if(!empty($_POST['medicina6']))
				{
					$alerta = '<p class="msg_error"> El numero de medicinas excede a 5 </p>';
						header("Location:../view/historial.php?alerta=$alerta&fechahist=$fechahist&horahist=$horahist&tratamiento=$tratamiento&causa=$causa&descripcioncausa=$descripcioncausa");
						exit();
				}
			if(!empty($_POST['recurso']))
			{
				foreach($_POST['recurso'] as $valor[])
				{
					$valor;
				}
				if(!empty($valor[0]))
				{
					$recurso1=$valor[0];
				}
				if(!empty($valor[1]))
				{
					$recurso2=$valor[1];
				}
				if(!empty($valor[2]))
				{
					$recurso3=$valor[2];
				}
				if(!empty($valor[3]))
				{
					$recurso4=$valor[3];
				}
				if(!empty($valor[4]))
				{
					$recurso5=$valor[4];
				}
					
			}
				$ultimo_idhistorial='';

				
				$resultado= usuario_existe($matricula,$conn);
				if($resultado == 0)
					{
						$alerta = '<p class="msg_error"> La matricula no existe, escriba una correcta </p>';
						header("Location:../view/editarhistorial.php?id=$idhistorial&alerta=$alerta");
						exit();
					}
					if($resultado > 0 )
					{		
							
							
							$res_si_hay_causa= resultado_idcausa($conn,$causa,$descripcioncausa); //////////////////////////// Si se modifica por alguna causa existente o se deja la misma causa
							$idcausa=$res_si_hay_causa["idcausa"];//id
							
							 ////////////////////////////////////////////////////// Si se modifica por algun medicamento existente o se deja el mismo medicamento
							
							
							$resultado_idpaciente=resultado_idpaciente($conn,$matricula);
							$idpaciente=$resultado_idpaciente["idpacientes"];//id

							//////////////////  Para doctor
							
							$resultado_id_de_login=resultado_id_de_login ($conn,$idlogin);
							$idl=$resultado_id_de_login["id"];//id

							
							$resultado_iddoctor=resultado_iddoctor($conn,$idlogin);
							$iddoc=$resultado_iddoctor["iddoctores"];//id



							if ($res_si_hay_causa > 0) //// si hay causa
							{					
								$update_historial=actualizar_historial($conn,$idpaciente,$fechahist,$horahist,$tratamiento,$idcausa,$idhistorial);
										
				
											$ultimo_idhistorial = mysqli_insert_id($conn);
										
										if(!empty($medicina5)) 
										{	
											$hist_m5=hist_m5a($conn,$idhistorial,$medicina5,$id_hm5);
										}

										if(!empty($medicina4)) 
										{				
											$hist_m4=hist_m4a($conn,$idhistorial,$medicina4,$id_hm4);
										}

										if(!empty($medicina3)) 
										{	
											$hist_m3=hist_m3a($conn,$idhistorial,$medicina3,$id_hm3);
										}

										if(!empty($medicina2)) 
										{	
											$hist_m2=hist_m2a($conn,$idhistorial,$medicina2,$id_hm2);
										}

										if(!empty($medicina1)) 
										{	
											

											$hist_m1=hist_m1a($conn,$idhistorial,$medicina1,$id_hm1);
										}
										/////recursos

										if(!empty($recurso5)) 
										{			
											$hist_r5=hist_re5a($conn,$idhistorial,$recurso5,$id_r5);
										}

										if(!empty($recurso4)) 
										{	

											$hist_r4=hist_re4a($conn,$idhistorial,$recurso4,$id_r4);
										}

										if(!empty($recurso3)) 
										{	

											$hist_r3=hist_re3a($conn,$idhistorial,$recurso3,$id_r3);

										}

										if(!empty($recurso2)) 
										{	

											$hist_r2=hist_re2a($conn,$idhistorial,$recurso2,$id_r2);

										}

										if(!empty($recurso1)) 
										{	

											$hist_r1=hist_re1a($conn,$idhistorial,$recurso1,$id_r1);	

										}


								if($update_historial>0 || $hist_r1>0 || $hist_r2>0 || $hist_r3>0 || $hist_r4>0 || $hist_r5>0 || $hist_m1>0 || $hist_m2>0 || $hist_m3>0 || $hist_m4>0 || $hist_m5>0)
								{			
											$alerta = '<p class="msg_save"> Historial actualizado exitosamente  </p>';
											header("Location:../view/editarhistorial.php?id=$idhistorial&alerta=$alerta");
								}

								
								else
								{	

									$alerta = '<p class="msg_error"> No se realizaron cambios </p>';
									header("Location:../view/editarhistorial.php?id=$idhistorial&alerta=$alerta");
								}
							}
							else //// si no hay causa inserta la nueva
							{	
								$inserta_causa= inserta_causa($conn,$causa,$descripcioncausa);

								if ($inserta_causa>0)
								{ 	
									$ultimo_id = mysqli_insert_id($conn);  
									$update_historial=actualizar_historial_sin_causa($conn,$idpaciente,$fechahist,$horahist,$tratamiento,$ultimo_id,$idhistorial); 
										$ultimo_idhistorial = mysqli_insert_id($conn);

										
								}

										

										if(!empty($medicina5)) 
										{	
											$hist_m5=hist_m5a($conn,$idhistorial,$medicina5,$id_hm5);
										}

										if(!empty($medicina4)) 
										{				
											$hist_m4=hist_m4a($conn,$idhistorial,$medicina4,$id_hm4);
										}

										if(!empty($medicina3)) 
										{	
											$hist_m3=hist_m3a($conn,$idhistorial,$medicina3,$id_hm3);
										}

										if(!empty($medicina2)) 
										{	
											$hist_m2=hist_m2a($conn,$idhistorial,$medicina2,$id_hm2);
										}

										if(!empty($medicina1)) 
										{	
											

											$hist_m1=hist_m1a($conn,$idhistorial,$medicina1,$id_hm1);
										}
										/////recursos

										if(!empty($recurso5)) 
										{			
											$hist_r5=hist_re5a($conn,$idhistorial,$recurso5,$id_r5);
										}

										if(!empty($recurso4)) 
										{	

											$hist_r4=hist_re4a($conn,$idhistorial,$recurso4,$id_r4);
										}

										if(!empty($recurso3)) 
										{	

											$hist_r3=hist_re3a($conn,$idhistorial,$recurso3,$id_r3);				
										}

										if(!empty($recurso2)) 
										{	

											$hist_r2=hist_re2a($conn,$idhistorial,$recurso2,$id_r2);
										}

										if(!empty($recurso1)) 
										{						
											$hist_r1=hist_re1a($conn,$idhistorial,$recurso1,$id_r1);				
										}


								if($update_historial>0 || $hist_r1>0 || $hist_r2>0 || $hist_r3>0 || $hist_r4>0 || $hist_r5>0 || $hist_m1>0 || $hist_m2>0 || $hist_m3>0 || $hist_m4>0 || $hist_m5>0)
								{			
											$alerta = '<p class="msg_save"> Historial actualizado exitosamente  </p>';
											header("Location:../view/editarhistorial.php?id=$idhistorial&alerta=$alerta");
								}

								
								else
								{	

									$alerta = '<p class="msg_error"> No se realizaron cambios </p>';
									header("Location:../view/editarhistorial.php?id=$idhistorial&alerta=$alerta");
								}
							}
							/*if ($res_si_hay_medicamento > 0) /// si hay medicamento existente
							{	
								
								$update_historial_medicamentos=actualizar_historial_medicamentos($conn,$idmedicamentos,$descripcion_medicamento,$idhistorial) ;
								if($update_historial_medicamentos>0)
									{   
										$alerta3 = '<p class="msg_save"> Historial/medicamentos actualizado exitosamente  </p>';
										header("Location:../view/editarhistorial.php?id=$idhistorial&alerta=$alerta&alerta2=$alerta2&alerta3=$alerta3");
									}
										else
											{
												$alerta3 = '<p class="msg_error"> No se realizaron cambios en historial/medicamentos </p>';
												header("Location:../view/editarhistorial.php?id=$idhistorial&alerta=$alerta&alerta2=$alerta2&alerta3=$alerta3");
											}
							}*/
								/*else // si no hay medicamento lo inserta
								{	
									
									$inserta_idmedicamento=agrega_idmedicamento ($conn,$nombremedicamento,$presentacion) ;
									if ($inserta_idmedicamento>0) 
									{	
										$ultimo_idmedicamento = mysqli_insert_id($conn);
										 
										$update_historial_medicamentos=actualiza_historial_medicamentos_sin_medicina($conn,$ultimo_idmedicamento,$descripcion_medicamento,$idhistorial) ; 
									
									}
									if($update_historial_medicamentos>0)
									{   
										$alerta3 = '<p class="msg_save"> Historial/medicamentos actualizado exitosamente  </p>';
										header("Location:../view/editarhistorial.php?id=$idhistorial&alerta=$alerta&alerta2=$alerta2&alerta3=$alerta3");
									}
							
										else
											{
												$alerta3 = '<p class="msg_error"> No se realizaron cambios en historial/medicamentos </p>';
												header("Location:../view/editarhistorial.php?id=$idhistorial&alerta=$alerta&alerta2=$alerta2&alerta3=$alerta3");
											}
								}*/						
					}
			}	
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($llenar_eliminar_historial))
{	
	if(empty($_REQUEST['id']) || $_REQUEST['id']==1 || $_REQUEST['id']==5)
	{
		header("Location:../view/adminhistorial.php");
	}
		else
		{
			 $id=$_REQUEST['id'];
			 
			 $query=llenar_eliminar_historial($conn,$id); 
			 $res= mysqli_num_rows($query);

			 if($res > 0)
			 {
			 	while ($datos= mysqli_fetch_array($query)) 
			 	{
			 		$idlogin = $datos['llogin'];
			 		$nombred = $datos['nd'];
			 		$apellidopaternod = $datos['ad'];
			 		$matricula = $datos['matricula'];
			 		$nombrep = $datos['nombre'];
			 		$apellidopaternop = $datos['apellidopaterno'];
			 		$fecha= $datos['fecha'];
			 		$hora= $datos['hora'];
			 		$tratamiento= $datos['tratamiento'];
			 		$nombrecausa= $datos['nombrecausa'];
			 		$descripcion= $datos['descripcion'];
			 	}
			 }
			 	else
			 	{
			 		header("Location:../view/adminhistorial.php");
			 	}
		}
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (!empty($_POST['eliminar_historial'])) 
{
	if ($_SESSION['idrol'] != 1 && $_SESSION['idrol'] != 2) 
	{
		header('Location:../view/Bienvenida.php');
	}

	if(empty($_SESSION['active']))
	{
		header('Location:../index.php');
	}

	$id= $_POST['id'];
	//$query= mysqli_query($conn," DELETE FROM historial WHERE idhistorial =$id");
	
	$query=eliminar_historial($conn,$id);
	if ($query>0) 
	{
		header("Location:../view/adminhistorial.php");		
	}
		else
		{
			echo 'Error al eliminar el historial';
		}
}

/////////////////////////////////////// CON RECURSO ////////////////////////////////////////////////////////////////////////////////////

if (!empty($_POST['agregar_historial_con_recurso'])) 
{
	if ($_SESSION['idrol'] != 1 && $_SESSION['idrol'] != 2) 
	{
		header('Location:../view/Bienvenida.php');
	}

	if(empty($_SESSION['active']))
	{
		header('Location:../index.php');
	}

	$alerta = '';
	if(empty($_POST['matricula']) || empty($_POST['fecha']) || empty($_POST['hora']) || empty($_POST['causa']) )
	{
		$alerta = '<p class="msg_error">   Debes llenar los campos; son obligatorios </p>';
		header("Location:../view/formulariorecurso.php?alerta=$alerta");
		exit();
	}
		else
		{	

			$matricula=$_POST['matricula'];
			$fecha=$_POST['fecha'];
			$hora=$_POST['hora'];
			$causa=$_POST['causa'];
			$recurso=$_POST['recurso'];
			$medicina=$_POST['medicina'];
			$cantidad=$_POST['cantidad'];
			$cantidad_medicina=$_POST['cantidad_medicina'];



			$pon_recurso=recurso_poner($conn,$recurso);
			$pon_recurso2=$pon_recurso["nombrerecurso"];
			
			$pon_med=med_poner($conn,$medicina);
			$pon_med2=$pon_med["medicamentosnombre"];



			
			$resultado_idpaciente=resultado_idpaciente($conn,$matricula);
			$idpaciente=$resultado_idpaciente["idpacientes"];

			
			$resultado=usuario_existe($matricula,$conn);
			if ($resultado>0) 
			{
				
				$resultado_cantidad=resultado_cantidad($conn,$recurso,$cantidad) ;
				$cantidad_actual=cantidad_actual($conn,$recurso,$cantidad) ;
				
				$resultado_cantidad_medicina=resultado_cantidad_medicina($conn,$medicina,$cantidad_medicina) ;
				$cantidad_actual_medicina=cantidad_actual_medicina($conn,$medicina,$cantidad_medicina) ;

				$cantidad_restante_medicina=$cantidad_actual_medicina['cantidadtot']-$cantidad_medicina;
				if (!empty($_POST['recurso']) && !empty($_POST['medicina']))
				{
					if($resultado_cantidad == 0)
					{
						$alerta = '<p class="msg_error"> La cantidad de recursos es superior a la que hay en existencia </p>';
						header("Location:../view/formulariorecurso.php?alerta=$alerta&causa=$causa");
						exit();
					}

					if($resultado_cantidad_medicina == 0)
					{
						$alerta = '<p class="msg_error"> La cantidad de medicina es superior a la que hay en existencia </p>';
						header("Location:../view/formulariorecurso.php?alerta=$alerta&causa=$causa");
						exit();
					}

					else
					{
						$cantidad_restante=$cantidad_actual['cantidadtotal']-$cantidad;
						$update=actualizar_cantidad_restante($conn,$cantidad_restante,$recurso) ;
						$update2=actualizar_cantidad_restante_medicina($conn,$cantidad_restante_medicina,$medicina);
						if($update>0 && $update2>0)
						{
							$inserta=historial_recurso_con2($conn,$idpaciente,$fecha,$hora,$causa,$recurso,$cantidad,$medicina,$cantidad_medicina) ;
								if ($inserta>0) 
								{
									$alerta = '<p class="msg_save"> Historial/recurso y medicina agregado exitosamente  </p>';
									header("Location:../view/formulariorecurso.php?alerta=$alerta");
								}

									else
									{
										$alerta = '<p class="msg_error"> Error al crear historial/recurso y medicina </p>';
										header("Location:../view/formulariorecurso.php?alerta=$alerta");
									}
						}
					}						
				}
				else if (!empty($_POST['recurso']))
				{
					if($resultado_cantidad == 0)
					{
						$alerta = '<p class="msg_error"> La cantidad es superior a la que hay en existencia </p>';
						header("Location:../view/formulariorecurso.php?alerta=$alerta&causa=$causa");
						exit();
					}

					else
					{
						$cantidad_restante=$cantidad_actual['cantidadtotal']-$cantidad;
						
						$update=actualizar_cantidad_restante($conn,$cantidad_restante,$recurso) ;
						if($update>0)
						{	
								
								$inserta=historial_recurso($conn,$idpaciente,$fecha,$hora,$causa,$recurso,$cantidad) ;
								if ($inserta>0) 
								{
									$alerta = '<p class="msg_save"> Historial/recurso agregado exitosamente  </p>';
									header("Location:../view/formulariorecurso.php?alerta=$alerta");
								}

									else
									{
										$alerta = '<p class="msg_error"> Error al crear historial/recurso </p>';
										header("Location:../view/formulariorecurso.php?alerta=$alerta");
									}
						}
					}
				}
				else if (!empty($_POST['medicina']))
				{
					if($resultado_cantidad_medicina == 0)
					{
						$alerta = '<p class="msg_error"> La cantidad es superior a la que hay en existencia </p>';
						header("Location:../view/formulariorecurso.php?alerta=$alerta&causa=$causa");
						exit();
					}

					else
					{
						$update=actualizar_cantidad_restante_medicina($conn,$cantidad_restante_medicina,$medicina);
						if($update>0)
						{	
								
								$inserta=historial_recurso_medicina($conn,$idpaciente,$fecha,$hora,$causa,$medicina,$cantidad_medicina) ;
								if ($inserta>0) 
								{
									$alerta = '<p class="msg_save"> Historial/medicina agregado exitosamente  </p>';
									header("Location:../view/formulariorecurso.php?alerta=$alerta");
								}

									else
									{
										$alerta = '<p class="msg_error"> Error al crear historial/medicina </p>';
										header("Location:../view/formulariorecurso.php?alerta=$alerta");
									}
						}
					}
				}

				if (empty($_POST['medicina']) && empty($_POST['recurso'])) 
				{
					$alerta = '<p class="msg_error">No has seleccionado recurso o medicina </p>';
					header("Location:../view/formulariorecurso.php?alerta=$alerta&causa=$causa");
					exit();	
				}
								
			}
			else
			{
				$alerta = '<p class="msg_error">La matricula no existe</p>';
				header("Location:../view/formulariorecurso.php?alerta=$alerta&causa=$causa&cantidad=$cantidad&cantidad_medicina=$cantidad_medicina&pon_recurso2=$pon_recurso2&recurso=$recurso&pon_med2=$pon_med2&medicina=$medicina");
				exit();
			}
		}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($llenar_historial_con_recurso))
{
			if (empty($_GET['id'])) 
			{
				header('Location:../view/historialrecursos.php');	
			}
			$id= $_GET['id'];
			
			$my=llenar_historial_con_recurso ($conn,$id) ;
			
			$resul_my=llenar_historial_con_recurso2($conn,$id) ;
			if ($resul_my == 0) 
			{
				header('Location:../view/historialrecursos.php');
			}
				else
				{
					while ($datos=mysqli_fetch_array($my)) 
					{
						$idhistorialrecurso = $datos['idhistorialrecurso'];
						$matricula= $datos['matricula'];
						$fecha= $datos['fecha'];
						$hora = $datos['hora'];
						$causa = $datos['causa'];
						$idrecurso = $datos['idrecurso'];
						$nombrerecurso = $datos['nombrerecurso'];
						$cantidadusada = $datos['cantidadusada'];
						$medicina = $datos['idmedicamentos'];
						$nombremedicina = $datos['medicamentosnombre'];
						$cantidadusadamedicina = $datos['cantidadusadamedicina'];
						if ($idrecurso=='') 
						{
							$opcion= '<option value="" select> "-----------"</option>';
						}
						if ($idrecurso==1) 
						{
							$opcion= '<option value="'.$idrecurso.'" select> '.$nombrerecurso.'</option>';
						}
						else if ($idrecurso==2) 
						{
							$opcion= '<option value="'.$idrecurso.'" select> '.$nombrerecurso.'</option>';	
						}
						else if ($idrecurso==3) 
						{
							$opcion= '<option value="'.$idrecurso.'" select> '.$nombrerecurso.'</option>';	
						}
						else if ($idrecurso==4) 
						{
							$opcion= '<option value="'.$idrecurso.'" select> '.$nombrerecurso.'</option>';	
						}
						else if ($idrecurso==5) 
						{
							$opcion= '<option value="'.$idrecurso.'" select> '.$nombrerecurso.'</option>';	
						}
						else if ($idrecurso==6) 
						{
							$opcion= '<option value="'.$idrecurso.'" select> '.$nombrerecurso.'</option>';	
						}
						else if ($idrecurso==7) 
						{
							$opcion= '<option value="'.$idrecurso.'" select> '.$nombrerecurso.'</option>';	
						}
						else if ($idrecurso==8) 
						{
							$opcion= '<option value="'.$idrecurso.'" select> '.$nombrerecurso.'</option>';	
						}
						else if ($idrecurso==9) 
						{
							$opcion= '<option value="'.$idrecurso.'" select> '.$nombrerecurso.'</option>';	
						}
						else if ($idrecurso==10) 
						{
							$opcion= '<option value="'.$idrecurso.'" select> '.$nombrerecurso.'</option>';	
						}
						else if ($idrecurso==11) 
						{
							$opcion= '<option value="'.$idrecurso.'" select> '.$nombrerecurso.'</option>';	
						}
						else if ($idrecurso==12) 
						{
							$opcion= '<option value="'.$idrecurso.'" select> '.$nombrerecurso.'</option>';	
						}
						else if ($idrecurso==13) 
						{
							$opcion= '<option value="'.$idrecurso.'" select> '.$nombrerecurso.'</option>';	
						}
						else if ($idrecurso==14) 
						{
							$opcion= '<option value="'.$idrecurso.'" select> '.$nombrerecurso.'</option>';	
						}
						else if ($idrecurso==15) 
						{
							$opcion= '<option value="'.$idrecurso.'" select> '.$nombrerecurso.'</option>';	
						}
						else if ($idrecurso==16) 
						{
							$opcion= '<option value="'.$idrecurso.'" select> '.$nombrerecurso.'</option>';
						}
						else if ($idrecurso==17) 
						{
							$opcion= '<option value="'.$idrecurso.'" select> '.$nombrerecurso.'</option>';				
						}
						else if ($idrecurso==18) 
						{
							$opcion= '<option value="'.$idrecurso.'" select> '.$nombrerecurso.'</option>';	
						}
						else if ($idrecurso==19) 
						{
							$opcion= '<option value="'.$idrecurso.'" select> '.$nombrerecurso.'</option>';	
						}
						else if ($idrecurso==20) 
						{
							$opcion= '<option value="'.$idrecurso.'" select> '.$nombrerecurso.'</option>';	
						}
						else if ($idrecurso==21) 
						{
							$opcion= '<option value="'.$idrecurso.'" select> '.$nombrerecurso.'</option>';	
						}
						else if ($idrecurso==22) 
						{
							$opcion= '<option value="'.$idrecurso.'" select> '.$nombrerecurso.'</option>';	
						}
						else if ($idrecurso==23) 
						{
							$opcion= '<option value="'.$idrecurso.'" select> '.$nombrerecurso.'</option>';	
						}
						else if ($idrecurso==24) 
						{
							$opcion= '<option value="'.$idrecurso.'" select> '.$nombrerecurso.'</option>';	
						}
						else if ($idrecurso==25) 
						{
							$opcion= '<option value="'.$idrecurso.'" select> '.$nombrerecurso.'</option>';	
						}
				////////////////////////////////////////////////////////////////////////////////////////////
						if ($medicina=='') 
						{
							$opcion2= '<option value="" select> "------------"</option>';
						}
						if ($medicina==1) 
						{
							$opcion2= '<option value="'.$medicina.'" select> '.$nombremedicina.'</option>';
						}
						else if ($medicina==2) 
						{
							$opcion2= '<option value="'.$medicina.'" select> '.$nombremedicina.'</option>';
						}
						else if ($medicina==3) 
						{
							$opcion2= '<option value="'.$medicina.'" select> '.$nombremedicina.'</option>';
						}
						else if ($medicina==4) 
						{
							$opcion2= '<option value="'.$medicina.'" select> '.$nombremedicina.'</option>';
						}
						else if ($medicina==5) 
						{
							$opcion2= '<option value="'.$medicina.'" select> '.$nombremedicina.'</option>';
						}
						else if ($medicina==6) 
						{
							$opcion2= '<option value="'.$medicina.'" select> '.$nombremedicina.'</option>';
						}
						else if ($medicina==7) 
						{
							$opcion2= '<option value="'.$medicina.'" select> '.$nombremedicina.'</option>';
						}
						else if ($medicina==8) 
						{
							$opcion2= '<option value="'.$medicina.'" select> '.$nombremedicina.'</option>';
						}
						else if ($medicina==9) 
						{
							$opcion2= '<option value="'.$medicina.'" select> '.$nombremedicina.'</option>';
						}
						else if ($medicina==10) 
						{
							$opcion2= '<option value="'.$medicina.'" select> '.$nombremedicina.'</option>';
						}
						else if ($medicina==11) 
						{
							$opcion2= '<option value="'.$medicina.'" select> '.$nombremedicina.'</option>';
						}
						else if ($medicina==12) 
						{
							$opcion2= '<option value="'.$medicina.'" select> '.$nombremedicina.'</option>';
						}
						else if ($medicina==13) 
						{
							$opcion2= '<option value="'.$medicina.'" select> '.$nombremedicina.'</option>';
						}
						else if ($medicina==14) 
						{
							$opcion2= '<option value="'.$medicina.'" select> '.$nombremedicina.'</option>';
						}
						else if ($medicina==15) 
						{
							$opcion2= '<option value="'.$medicina.'" select> '.$nombremedicina.'</option>';
						}
						else if ($medicina==16) 
						{
							$opcion2= '<option value="'.$medicina.'" select> '.$nombremedicina.'</option>';
						}
						else if ($medicina==17) 
						{
							$opcion2= '<option value="'.$medicina.'" select> '.$nombremedicina.'</option>';
						}
						else if ($medicina==18) 
						{
							$opcion2= '<option value="'.$medicina.'" select> '.$nombremedicina.'</option>';
						}
						else if ($medicina==19) 
						{
							$opcion2= '<option value="'.$medicina.'" select> '.$nombremedicina.'</option>';
						}
						else if ($medicina==20) 
						{
							$opcion2= '<option value="'.$medicina.'" select> '.$nombremedicina.'</option>';
						}
						else if ($medicina==21) 
						{
							$opcion2= '<option value="'.$medicina.'" select> '.$nombremedicina.'</option>';
						}
						else if ($medicina==22) 
						{
							$opcion2= '<option value="'.$medicina.'" select> '.$nombremedicina.'</option>';
						}
						else if ($medicina==23) 
						{
							$opcion2= '<option value="'.$medicina.'" select> '.$nombremedicina.'</option>';
						}
						else if ($medicina==24) 
						{
							$opcion2= '<option value="'.$medicina.'" select> '.$nombremedicina.'</option>';
						}
						else if ($medicina==25) 
						{
							$opcion2= '<option value="'.$medicina.'" select> '.$nombremedicina.'</option>';
						}	
					}
				}
}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (!empty($_POST['actualizar_historial_con_recurso'])) 
{
	if ($_SESSION['idrol'] != 1 && $_SESSION['idrol'] != 2) 
	{
		header('Location:../view/Bienvenida.php');
	}

	if(empty($_SESSION['active']))
	{
		header('Location:../index.php');
	}

	$alerta = '';
	$idhistorialrecurso=$_POST['idhistorialrecurso'];
	if(empty($_POST['matricula']) || empty($_POST['fecha']) || empty($_POST['hora']) || empty($_POST['causa']))
	{
		$alerta = '<p class="msg_error">   Debes llenar los campos; son obligatorios </p>';
		header("Location:../view/historialrecursos2.php?id=$idhistorialrecurso&alerta=$alerta");
		exit();
	}
		else
		{	/////////////////////////SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS
			$idhistorialrecurso=$_POST['idhistorialrecurso'];
			$matricula=$_POST['matricula'];
			$fecha=$_POST['fecha'];
			$hora=$_POST['hora'];
			$causa=$_POST['causa'];
			$recurso=$_POST['recurso'];
			$cantidad=$_POST['cantidad'];
			$medicina=$_POST['medicina'];
			$cantidad_medicina=$_POST['cantidad_medicina'];

			
			$resultado_idpaciente=resultado_idpaciente($conn,$matricula);
			$idpaciente=$resultado_idpaciente["idpacientes"];
			
			
			$resultado=usuario_existe($matricula,$conn) ;
			if($resultado == 0)
				{
					$alerta = '<p class="msg_error"> La matricula no existe, escriba una correcta </p>';
					header("Location:../view/historialrecursos2.php?id=$idhistorialrecurso&alerta=$alerta");
					exit();
				}
				else
					{	
						////////////////////////////////////////////////////////////////// de regreso

						
						$id_regreso=id_regreso($conn,$idhistorialrecurso) ;
						$id_antes=$id_regreso['idrecurso']; //id del anterior que tenia

						$id_regreso_med=id_regreso_med($conn,$idhistorialrecurso) ;
						$id_antes_med=$id_regreso_med['idmedicamentos']; //id del anterior que tenia

						
						$cant_regreso=cant_regreso($conn,$id_antes,$idhistorialrecurso) ;
						$cantidad_regreso=$cant_regreso['cantidadusada']; //cantidad usada de antes
						
						$cant_regreso_med=cant_regreso_med($conn,$id_antes_med,$idhistorialrecurso) ;
						$cantidad_regreso_med=$cant_regreso_med['cantidadusadamedicina']; //cantidad usada de antes

						 
						$antes_cantidad1= antes_cantidad1($conn,$id_antes); 
						$antes_cantidad=$antes_cantidad1['cantidadtotal'];// cantidad total del de antes

						$antes_cantidad1_med= antes_cantidad1_med($conn,$id_antes_med); 
						$antes_cantidad_med=$antes_cantidad1_med['cantidadtot'];// cantidad total de medicinas del de antes

						$devuelta=$antes_cantidad+$cantidad_regreso; // la suma cantidad total de antes + usada de antes //
						
						$devuelta_med=$antes_cantidad_med+$cantidad_regreso_med; // la suma cantidad total de antes + usada de antes //
						
						///////////////////////////////////////////////////////////

						
						$resultado_cantidad=resultado_cantidad ($conn,$recurso,$cantidad) ;
						
						$resultado_cantidad_med=resultado_cantidad_medicina($conn,$medicina,$cantidad_medicina);
						if (!empty($_POST['recurso']) && !empty($_POST['medicina']))
						{
							if($resultado_cantidad == 0)
							{
								$alerta = '<p class="msg_error"> La cantidad de recursos es superior a la que hay en existencia </p>';
								header("Location:../view/historialrecursos2.php?id=$idhistorialrecurso&alerta=$alerta");
								exit();
							}
							if($resultado_cantidad_med == 0)
							{
								$alerta = '<p class="msg_error"> La cantidad de medicina es superior a la que hay en existencia </p>';
								header("Location:../view/historialrecursos2.php?id=$idhistorialrecurso&alerta=$alerta");
								exit();
							}
							
							else
							{	
								$update2=actualizar_devuelta($conn,$devuelta,$id_antes);
								$update3=actualizar_devuelta_med($conn,$devuelta_med,$id_antes_med);
								
								
								$resultado_cantidad=resultado_cantidad ($conn,$recurso,$cantidad) ;
								$resultado_cantidad_med=resultado_cantidad_medicina($conn,$medicina,$cantidad_medicina) ;
								

								
								$cantidad_actual=cantidad_actual($conn,$recurso,$cantidad) ;
								$cantidad_restante=$cantidad_actual['cantidadtotal']-$cantidad;

								$cantidad_actual_med=cantidad_actual_medicina($conn,$medicina,$cantidad_medicina) ;
								$cantidad_restante_med=$cantidad_actual_med['cantidadtot']-$cantidad_medicina;


								$update=actualizar_cantidad_total($conn,$cantidad_restante,$recurso);
								$update4=actualizar_cantidad_total_med($conn,$cantidad_restante_med,$medicina);
								
									if($update>0 && $update4>0)
									{	
										
										$inserta=inserta_historial_recurso($conn,$idpaciente,$fecha,$hora,$causa,$recurso,$cantidad,$medicina,$cantidad_medicina,$idhistorialrecurso);
										if ($inserta>0) 
										{
											$alerta = '<p class="msg_save"> Historial / recurso y medicina actualizado exitosamente  </p>';
											header("Location:../view/historialrecursos2.php?id=$idhistorialrecurso&alerta=$alerta");
										}

										else
										{
											$alerta = '<p class="msg_error"> No se realizaron cambios en historial / recurso y medicina </p>';
											header("Location:../view/historialrecursos2.php?id=$idhistorialrecurso&alerta=$alerta");
										}
									}

									else
									{
											$alerta = '<p class="msg_error"> No se realizaron cambios en historial / recurso y medicina </p>';
											header("Location:../view/historialrecursos2.php?id=$idhistorialrecurso&alerta=$alerta");
									}
								}
						}
						else if (!empty($_POST['recurso']))
						{
							if($resultado_cantidad == 0)
							{
								$alerta = '<p class="msg_error"> La cantidad de recursos es superior a la que hay en existencia </p>';
								header("Location:../view/historialrecursos2.php?id=$idhistorialrecurso&alerta=$alerta");
								exit();
							}

							$update2=actualizar_devuelta($conn,$devuelta,$id_antes);
							$resultado_cantidad=resultado_cantidad ($conn,$recurso,$cantidad) ;

							$cantidad_actual=cantidad_actual($conn,$recurso,$cantidad) ;
								$cantidad_restante=$cantidad_actual['cantidadtotal']-$cantidad;
								$update=actualizar_cantidad_total($conn,$cantidad_restante,$recurso);
								if($update>0 && $update2>0)
									{	
										
										$inserta=inserta_historial_recurso2($conn,$idpaciente,$fecha,$hora,$causa,$recurso,$cantidad,$idhistorialrecurso);
										if ($inserta>0) 
										{
											$alerta = '<p class="msg_save"> Historial / recurso actualizado exitosamente  </p>';
											header("Location:../view/historialrecursos2.php?id=$idhistorialrecurso&alerta=$alerta");
										}

										else
										{
											$alerta = '<p class="msg_error"> No se realizaron cambios en historial / recurso </p>';
											header("Location:../view/historialrecursos2.php?id=$idhistorialrecurso&alerta=$alerta");
										}
									}
								else
									{
											$alerta = '<p class="msg_error"> No se realizaron cambios en historial / recurso y medicina </p>';
											header("Location:../view/historialrecursos2.php?id=$idhistorialrecurso&alerta=$alerta");
									}
							///////SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS
						}
						else if (!empty($_POST['medicina']))
						{
							
							if($resultado_cantidad_med == 0)
							{
								$alerta = '<p class="msg_error"> La cantidad de medicina es superior a la que hay en existencia </p>';
								header("Location:../view/historialrecursos2.php?id=$idhistorialrecurso&alerta=$alerta");
								exit();
							}

							$update3=actualizar_devuelta_med($conn,$devuelta_med,$id_antes_med);
							$resultado_cantidad_med=resultado_cantidad_medicina($conn,$medicina,$cantidad_medicina) ;

							$cantidad_actual_med=cantidad_actual_medicina($conn,$medicina,$cantidad_medicina) ;	

								$cantidad_restante_med=$cantidad_actual_med['cantidadtot']-$cantidad_medicina;


								$update4=actualizar_cantidad_total_med($conn,$cantidad_restante_med,$medicina);
								
								if($update3>0 && $update4>0)
									{	
										
										
										
										$inserta=inserta_historial_med3($conn,$idpaciente,$fecha,$hora,$causa,$medicina,$cantidad_medicina,$idhistorialrecurso);

										if ($inserta>0) 
										{
											$alerta = '<p class="msg_save"> Historial / medicina actualizado exitosamente  </p>';
											header("Location:../view/historialrecursos2.php?id=$idhistorialrecurso&alerta=$alerta");
										}

										else
										{
											$alerta = '<p class="msg_error"> No se realizaron cambios en historial / medicina </p>';
											header("Location:../view/historialrecursos2.php?id=$idhistorialrecurso&alerta=$alerta");
										}
									}

									else
									{
											$alerta = '<p class="msg_error"> No se realizaron cambios en historial / recurso y medicina </p>';
											header("Location:../view/historialrecursos2.php?id=$idhistorialrecurso&alerta=$alerta");
									}
						}
						if (empty($_POST['medicina']) && empty($_POST['recurso'])) 
						{
							$alerta = '<p class="msg_error">No has seleccionado recurso o medicina </p>';
							header("Location:../view/formulariorecurso.php?alerta=$alerta&causa$causa");
							exit();	
						}							
					}
		}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($eliminar_con_recurso))
{
	if(empty($_REQUEST['id']))
	{
		header("Location:../view/historialrecursos.php");
	}
		else
		{
			 $id=$_REQUEST['id'];
			 
			 $res=llenar_eliminar_historial_con_recurso($conn,$id) ;

			 if($res > 0)
			 {	$query=llenar_eliminar_historial_con_recurso2($conn,$id);
			 	while ($datos= mysqli_fetch_array($query)) 
			 	{
			 		$matricula = $datos['matricula'];
			 		$fecha = $datos['fecha'];
			 		$hora= $datos['hora'];
			 		$causa= $datos['causa'];
			 		$nombrerecurso= $datos['nombrerecurso'];
			 		$cantidadusada= $datos['cantidadusada'];
			 		$nombremedicina= $datos['medicamentosnombre'];
			 		$cantidadusadamedicina= $datos['cantidadusadamedicina'];
			 	}
			 }
			 	else
			 	{
			 		header("Location:../view/historialrecursos.php");
			 	}
		}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (!empty($_POST['eliminar_historial_con_recurso'])) 
{
	if ($_SESSION['idrol'] != 1 && $_SESSION['idrol'] != 2) 
	{
		header('Location:../view/Bienvenida.php');
	}

	if(empty($_SESSION['active']))
	{
		header('Location:../index.php');
	}
	
	$id= $_POST['id'];
	
	$query=eliminar_historial_con_recurso($conn,$id) ;
	if ($query>0) 
	{
		header("Location:../view/historialrecursos.php");		
	}
		else
		{
			echo 'Error al eliminar el historial / recurso';
		}
}
//////////////////////////////////////////////////////           RECURSOS       /////////////////////////////////////////////////////
if (!empty($_POST['agregar_recurso'])) 
{
	if(empty($_SESSION['active']))
	{
		header('Location:../index.php');
	}
	
	$alerta = '';
	if(empty($_POST['nombre']) || empty($_POST['descripcion']) || empty($_POST['cantidad'])    )
	{
		$alerta = '<p class="msg_error">   Debes llenar los campos; son obligatorios </p>';
		header("Location:../view/recursos.php?&alerta=$alerta");
		exit();
	}
		else
		{
			$nombre=$_POST['nombre'];
			$descripcion=$_POST['descripcion'];
			$cantidad=$_POST['cantidad'];
			
			
			$resultado_recurso=id_recurso($conn,$nombre,$descripcion);
			if($resultado_recurso > 0)
				{
					$alerta = '<p class="msg_error">El recurso ya existe</p>';
					header("Location:../view/recursos.php?&alerta=$alerta");
					exit();
				}
				else
					{
						
						$inserta=inserta_recurso ($conn,$nombre,$descripcion,$cantidad) ;
						if($inserta>0)
						{
							$alerta = '<p class="msg_save"> Recurso agregado exitosamente  </p>';
							header("Location:../view/recursos.php?&alerta=$alerta");
						}
							else
							{
								$alerta = '<p class="msg_error"> Error al crear recurso </p>';
								header("Location:../view/recursos.php?&alerta=$alerta");
							}
					}
		}	
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($actualizar_recurso))
{
		if (empty($_GET['id'])) 
		{
			header('Location:../view/adminrecursos.php');
		}

		$id= $_GET['id'];
		
		$resul_my=recursos ($conn,$id);
		if ($resul_my == 0) 
		{
			header('Location:../view/adminrecursos.php');
		}
			else
			{	
				$my=recursos2 ($conn,$id);
				$opcion='';
				while ($datos=mysqli_fetch_array($my)) 
				{
					$idrecurso = $datos['idrecurso'];
					$nombrerecurso= $datos['nombrerecurso'];
					$descripcionrecurso=$datos['descripcionrecurso'];
					$cantidadtotal=$datos['cantidadtotal'];
				}
			}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (!empty($_POST['actualizar_recurso'])) 
{
	if(empty($_SESSION['active']))
	{
		header('Location:../index.php');
	}
	
	$alerta = '';
	$idrecurso = $_POST['idrecurso'];
	if(empty($_POST['nombre']) || empty($_POST['descripcion']) || empty($_POST['cantidad']) )
	{
		$alerta = '<p class="msg_error">   Debes llenar los campos; son obligatorios </p>';
		header("Location:../view/editarrecursos.php?id=$idrecurso&alerta=$alerta");
		exit();
	}
		else
		{
			$idrecurso = $_POST['idrecurso'];
			$nombrerecurso= $_POST['nombre'];
			$descripcionrecurso=$_POST['descripcion'];
			$cantidadtotal=$_POST['cantidad'];

			
			$resultado=existe_recurso ($conn,$nombrerecurso,$idrecurso) ;
			if($resultado > 0)
				{
					$alerta = '<p class="msg_error"> El recurso ya existe </p>';
					header("Location:../view/editarrecursos.php?id=$idrecurso&alerta=$alerta");
					exit();
				}
				else
				{		
					$update=actualizar_recursos ($conn,$nombrerecurso,$descripcionrecurso,$cantidadtotal,$idrecurso) ;
						if($update>0)
						{
							$alerta = '<p class="msg_save"> Recurso actualizado exitosamente  </p>';
							header("Location:../view/editarrecursos.php?id=$idrecurso&alerta=$alerta");
						}
							else
							{
								$alerta = '<p class="msg_error"> No hubo cambios en recurso </p>';
								header("Location:../view/editarrecursos.php?id=$idrecurso&alerta=$alerta");
							}
				}
		}	
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($eliminar_recurso))
{	
	if(empty($_REQUEST['id']))
	{
		header("Location:../view/adminrecursos.php");
	}
		else
		{
			 $id=$_REQUEST['id'];

			 
			 $res=llenar_eliminar_recurso ($conn,$id) ;

			 if($res > 0)
			 {
			 	$query=llenar_eliminar_recurso2 ($conn,$id);
			 	while ($datos= mysqli_fetch_array($query)) 
			 	{
			 		$nombrerecurso = $datos['nombrerecurso'];
			 		$descripcionrecurso = $datos['descripcionrecurso'];
			 		$cantidadtotal= $datos['cantidadtotal'];	
			 	}
			 }
			 	else
			 	{
			 		header("Location:../view/adminrecursos.php");
			 	}
		}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (!empty($_POST['eliminar_recurso'])) 
{
	if(empty($_SESSION['active']))
	{
		header('Location:../index.php');
	}
	
	$id= $_POST['id'];
	
	$query=eliminar_recurso($conn,$id) ;
	if ($query>0) 
	{
		header("Location:../view/adminrecursos.php");		
	}
		else
		{
			echo 'Error al eliminar el recurso';
		}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_REQUEST['salir']))
{
session_start();
session_destroy();

header('Location:../index.php ');
}

/////////////////////////////////////////////////             INDEX         /////////////////////////////////////////////////////////
if(!empty($index))
{

	if(!empty($_SESSION['active']))
	{
		header('Location:../view/Bienvenida.php');
	}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_POST['entrar']))
{	
		$alerta = '';
		if(empty($_POST['economico']) || empty($_POST['pass']))
		{	
			$alerta='<p class="msg_error">ingresa tu No. economico y contraseña</p>';
			header("Location:../index.php?alerta=$alerta");
			exit();
		}
			else
			{	 
				$user= mysqli_real_escape_string($conn,$_POST['economico']);		
				$pass= md5(mysqli_real_escape_string($conn,$_POST['pass']));
                $res=login($user,$pass,$conn);
                if ($res>0) 
                {	
                	header('Location:../view/Bienvenida.php');
                }
					else
					{
					$alerta='<p class="msg_error"> El No. Economico o la Contraseña son Incorrectas</p> ';
					header("Location:../index.php?alerta=$alerta");
					session_destroy();
					}
			}
}
////////////////////////////////////////////////                  RECETA                 ////////////////////////////////////////
require'../pdf/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
if(isset($_POST['pdf']))
{
ob_start();
require_once '../pdf/receta2.php';
$html = ob_get_clean();
$html2pdf = new Html2Pdf('P','letter','es','true','UTF-8');
$html2pdf->writeHTML($html);
$html2pdf->output('Receta.pdf');
}
//////////////////////////////////////////////           RECETA/PASE CON RECURSO           /////////////////////////////////////
if(isset($_POST['pdf2']))
{
ob_start();
require_once '../pdf/receta_recurso2.php';
$html = ob_get_clean();
$html2pdf = new Html2Pdf('P','letter','es','true','UTF-8');
$html2pdf->writeHTML($html);
$html2pdf->output('Receta.pdf');
}
///////////////////////////////////////////////////// MEDICINAS ///////////////////////////////////////////////////////////////
if (!empty($_POST['agregar_medicina'])) 
{
	if(empty($_SESSION['active']))
	{
		header('Location:../index.php');
	}
	
	$alerta = '';
	if(empty($_POST['nombre']) || empty($_POST['presentacion']) || empty($_POST['cantidad_med'])    )
	{
		$alerta = '<p class="msg_error">   Debes llenar los campos; son obligatorios </p>';
		header("Location:../view/medicina.php?&alerta=$alerta");
		exit();
	}
		else
		{
			$nombre=$_POST['nombre'];
			$presentacion=$_POST['presentacion'];
			$cantidad_med=$_POST['cantidad_med'];
			
			$resultado_medicina=id_medicina($conn,$nombre,$presentacion);
			if($resultado_medicina > 0)
				{
					$alerta = '<p class="msg_error">La medicina ya existe</p>';
					header("Location:../view/medicina.php?&alerta=$alerta");
					exit();
				}
				else
					{						
						$inserta=inserta_medicina($conn,$nombre,$presentacion,$cantidad_med);
						if($inserta>0)
						{
							$alerta = '<p class="msg_save"> Medicina agregada exitosamente  </p>';
							header("Location:../view/medicina.php?&alerta=$alerta");
						}
							else
							{
								$alerta = '<p class="msg_error"> Error al crear Medicina </p>';
								header("Location:../view/medicina.php?&alerta=$alerta");
							}
					}
		}	
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($actualizar_medicina))
{
		if (empty($_GET['id'])) 
		{
			header('Location:../view/adminmedicina.php');
		}

		$id= $_GET['id'];
		
		$resul_my=medicina3($conn,$id);
		if ($resul_my == 0) 
		{
			header('Location:../view/adminmedicina.php');
		}
			else
			{	
				$my=medicina4($conn,$id);
				$opcion='';
				while ($datos=mysqli_fetch_array($my)) 
				{
					$idmedicamentos=$datos['idmedicamentos'];
					$medicamentosnombre= $datos['medicamentosnombre'];
					$presentacion=$datos['presentacion'];
					$cantidadtot=$datos['cantidadtot'];
				}
			}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (!empty($_POST['actualizar_medicina'])) 
{
	if(empty($_SESSION['active']))
	{
		header('Location:../index.php');
	}
	
	$alerta = '';
	$idmedicamentos = $_POST['idmedicamentos'];
	if(empty($_POST['nombre']) || empty($_POST['descripcion']) || empty($_POST['cantidad']) )
	{
		$alerta = '<p class="msg_error">   Debes llenar los campos; son obligatorios </p>';
		header("Location:../view/editarmedicina.php?id=$idmedicamentos&alerta=$alerta");
		exit();
	}
		else
		{
			$idmedicamentos=$_POST['idmedicamentos'];
			$medicamentosnombre= $_POST['nombre'];
			$presentacion=$_POST['descripcion'];
			$cantidadtot=$_POST['cantidad'];

			
			$resultado=existe_medicina($conn,$medicamentosnombre,$idmedicamentos);
			if($resultado > 0)
				{
					$alerta = '<p class="msg_error"> La medicina ya existe </p>';
					header("Location:../view/editarmedicina.php?id=$idmedicamentos&alerta=$alerta");
					exit();
				}
				else
				{		
					$update=actualizar_medicina($conn,$medicamentosnombre,$presentacion,$cantidadtot,$idmedicamentos);
						if($update>0)
						{
							$alerta = '<p class="msg_save"> Medicina actualizada exitosamente  </p>';
							header("Location:../view/editarmedicina.php?id=$idmedicamentos&alerta=$alerta");
						}
							else
							{
								$alerta = '<p class="msg_error"> No hubo cambios en medicina </p>';
								header("Location:../view/editarmedicina.php?id=$idmedicamentos&alerta=$alerta");
							}
				}
		}	
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($eliminar_medicina))
{	
	if(empty($_REQUEST['id']))
	{
		header("Location:../view/adminmedicina.php");
	}
		else
		{
			 $id=$_REQUEST['id'];

			 
			 $res=llenar_eliminar_medicina($conn,$id);

			 if($res > 0)
			 {
			 	$query=llenar_eliminar_medicina2($conn,$id);
			 	while ($datos= mysqli_fetch_array($query)) 
			 	{
			 		$medicamentosnombre = $datos['medicamentosnombre'];
			 		$presentacion = $datos['presentacion'];
			 		$cantidadtot= $datos['cantidadtot'];	
			 	}
			 }
			 	else
			 	{
			 		header("Location:../view/adminmedicina.php");
			 	}
		}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (!empty($_POST['eliminar_medicina'])) 
{
	if(empty($_SESSION['active']))
	{
		header('Location:../index.php');
	}
	
	$id= $_POST['id'];
	
	$query=eliminar_medicina($conn,$id);
	if ($query>0) 
	{
		header("Location:../view/adminmedicina.php");		
	}
		else
		{
			echo 'Error al eliminar la medicina';
		}
}

?>