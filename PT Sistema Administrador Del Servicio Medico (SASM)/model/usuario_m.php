<?php
require_once '../controller/conexion.php';
function login ($user,$pass,$conn)
{
				$query= mysqli_query($conn,"SELECT * FROM login WHERE idlogin='$user' AND pass='$pass' ");
				$res= mysqli_num_rows($query);

				if($res > 0)
				{
					$id_de_login= mysqli_query($conn,"SELECT id FROM login WHERE idlogin='$user' ");
					$resultado_id_de_login=mysqli_fetch_array($id_de_login);
					$idl=$resultado_id_de_login["id"];

					$doctor=mysqli_query($conn, "SELECT d.iddoctores,d.idrol,d.nombre,d.apellidopaterno,d.apellidomaterno,d.especialidad,d.turno,d.cedprof,d.idlogin, r.descripcion FROM doctores d INNER JOIN roles r ON d.idrol = r.idroles AND idlogin=$idl order by iddoctores");
					$resultado_doc=mysqli_num_rows($doctor);

					$datos= mysqli_fetch_array($query);
					$_SESSION['active']=true;
					$_SESSION['idlogin']=$datos['idlogin'];
						
					$datos_doc= mysqli_fetch_array($doctor);
					$_SESSION['nombre']=$datos_doc['nombre'];
					$_SESSION['apellidopaterno']=$datos_doc['apellidopaterno'];
					$_SESSION['apellidomaterno']=$datos_doc['apellidomaterno'];
					$_SESSION['descripcion']=$datos_doc['descripcion'];
					$_SESSION['idrol']=$datos_doc['idrol'];
					$_SESSION['cedprof']=$datos_doc['cedprof'];
				}
				return $res;				
}

function usuario_existe($matricula,$conn)
{
	$query= mysqli_query($conn,"SELECT * FROM pacientes WHERE matricula ='$matricula' AND estatus=1");
	$resultado= mysqli_fetch_array($query);
	return $resultado;
}

function agrega_usuario($nombre,$apellidop,$apellidom,$edad,$correo,$sexo,$matricula,$conn)
{
	$query= mysqli_query($conn,"INSERT INTO pacientes(nombre,apellidopaterno,apellidomaterno,edad,correo,sexo,matricula) VALUES('$nombre','$apellidop','$apellidom','$edad','$correo','$sexo','$matricula')");
	$inserta=mysqli_affected_rows($conn);
	return $inserta;
}

function paginador($conn)
{
	$paginador=mysqli_query($conn, "SELECT COUNT(*) as total FROM pacientes WHERE estatus = 1");
	$paginador_res= mysqli_fetch_array($paginador);
	$total=$paginador_res['total'];
	return $total;	
}

function paginas($conn,$desde,$num_pag)
{
	$query=mysqli_query($conn, "SELECT * FROM `pacientes` WHERE estatus = 1 LIMIT $desde,$num_pag");
	$resultado =mysqli_num_rows($query);
	return $resultado;
}

function llenar_tabla($conn,$desde,$num_pag)
{
	$query=mysqli_query($conn, "SELECT * FROM `pacientes` WHERE estatus = 1 LIMIT $desde,$num_pag");
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

function id_matricula_existe($conn,$matricula,$idpacientes)
{
	$query= mysqli_query($conn,"SELECT * FROM pacientes WHERE matricula ='$matricula' AND idpacientes != '$idpacientes'");
	$resultado= mysqli_fetch_array($query);
	return $resultado;

}

function actualizar_usuario($conn,$nombre,$apellidop,$apellidom,$edad,$correo,$sexo,$matricula,$idpacientes)
{
	$update= mysqli_query($conn,"UPDATE pacientes SET nombre='$nombre',apellidopaterno='$apellidop',apellidomaterno='$apellidom',edad='$edad',correo='$correo',sexo='$sexo',matricula='$matricula' WHERE idpacientes = '$idpacientes' ");
	$update=mysqli_affected_rows($conn);
	return $update;
}

function id($conn,$id)
{
	$my= mysqli_query($conn,"SELECT * FROM pacientes WHERE idpacientes = $id");
		$resul_my= mysqli_num_rows($my);
		return $resul_my;
}


function id2($conn,$id)
{
	$my= mysqli_query($conn,"SELECT * FROM pacientes WHERE idpacientes = $id");
		return $my;
}

function id_eliminar($conn, $id)
{
	$query= mysqli_query($conn,"SELECT nombre,correo,matricula FROM pacientes WHERE idpacientes=$id");
	$res= mysqli_num_rows($query);
	return $res;
}

function id_eliminar2($conn,$id)
{
	$query= mysqli_query($conn,"SELECT nombre,correo,matricula FROM pacientes WHERE idpacientes=$id");
	return $query;
}

function eliminar_usuario($conn,$id)
{
	$query= mysqli_query($conn," UPDATE pacientes SET estatus = 0  WHERE idpacientes =$id");
	$delete=mysqli_affected_rows($conn);
	return $delete;
}
/////////////////////////////////////////////////////             DOCTORES               /////////////////////////////////////////////////

function roles($conn)
{
	$rol= mysqli_query($conn,"SELECT * FROM roles");
	  $resultado_rol= mysqli_num_rows($rol);
	  return $resultado_rol;
}

function roles2($conn)
{
	$rol= mysqli_query($conn,"SELECT * FROM roles");
	  return $rol;
}

function login_existe($conn,$login)
{
	$query= mysqli_query($conn,"SELECT * FROM `login` WHERE idlogin ='$login' ");
	$resultado= mysqli_fetch_array($query);
	return $resultado;
}

function inserta_login($conn,$login,$pass)
{
	$inserta= mysqli_query($conn,"INSERT INTO login(idlogin,pass) VALUES('$login','$pass')");
	$inserta_login=mysqli_affected_rows($conn);
	return $inserta_login;
}

function inserta_doc($conn,$opcion,$nombredoc,$apellidopdoc,$apellidomdoc,$especialidaddoc,$turno,$ced,$ultimo_id)
{
	$inserta= mysqli_query($conn,"INSERT INTO doctores(idrol,nombre,apellidopaterno,apellidomaterno,especialidad,turno,cedprof,idlogin) VALUES('$opcion','$nombredoc','$apellidopdoc','$apellidomdoc','$especialidaddoc','$turno','$ced','$ultimo_id')");
	$inserta_doc=mysqli_affected_rows($conn);
	return $inserta_doc;
}

function elimina_login($conn,$ultimo_id)
{
	$query= mysqli_query($conn," DELETE FROM `login` WHERE id =$ultimo_id");
	return $query;

}

function paginador_doc($conn)
{
	$paginador=mysqli_query($conn, "SELECT COUNT(*) as total FROM doctores");
	$paginador_res= mysqli_fetch_array($paginador);
	return $paginador_res;
}

function tabla_doc($conn,$desde,$num_pag)
{
	$query=mysqli_query($conn, "SELECT 
    d.iddoctores,
    d.idrol,
    d.nombre,
    d.apellidopaterno,
    d.apellidomaterno,
    d.especialidad,
    d.turno,
    d.cedprof,
    l.idlogin as login,
    r.descripcion,
    d.idlogin
FROM
    doctores d
        INNER JOIN
    roles r ON d.idrol = r.idroles
    INNER JOIN login l ON id=d.idlogin
ORDER BY iddoctores
LIMIT $desde , $num_pag");
	$resultado =mysqli_num_rows($query);

	if($resultado > 0)
	{
		while($datos= mysqli_fetch_array($query))
		{ 
			?>


			<tr id="fila">
		<td id="casilla"><?php echo $datos["iddoctores"] ?></td>
		<td id="casilla"><?php echo $datos["idrol"] ?></td>
		<td id="casilla"><?php echo $datos["nombre"] ?></td>
		<td id="casilla"><?php echo $datos["apellidopaterno"] ?></td>
		<td id="casilla"><?php echo $datos["apellidomaterno"] ?></td>
		<td id="casilla"><?php echo $datos["especialidad"] ?></td>
		<td id="casilla"><?php echo $datos["turno"] ?></td>
		<td id="casilla"><?php echo $datos["cedprof"] ?></td>
		<td id="casilla"><?php echo $datos["login"] ?></td>
		<td id="casilla"><?php echo $datos["descripcion"] ?></td>
		<?php if ($_SESSION['idrol']!=3) { ?>
		<td id="casilla">
		
		
		<?php if ($datos["iddoctores"] !=1 && $datos["iddoctores"] !=5)
			  {

			?>
		<a class="edit" href="editardoctor2.php?id= <?php echo $datos["iddoctores"] ?>">Editar</a> 	
 		 <?php }   ?>
		<?php if ($datos["iddoctores"] !=1 && $datos["iddoctores"] !=5) 
				{

			?>
		<a class="elim" href="eliminardoctor.php?id= <?php echo $datos["iddoctores"] ?>">Eliminar</a> 
  		<?php 	}   ?>	
  									<?php } ?>
		</td>
	</tr>

	<?php 

		}
	}
}

function resultado_rol($conn)
{
	$rol= mysqli_query($conn,"SELECT * FROM roles");
	  $resultado_rol= mysqli_num_rows($rol);
	  return $resultado_rol;
}

function resultado_rol2($conn)
{
	$rol= mysqli_query($conn,"SELECT * FROM roles");
	
	while ($rol2= mysqli_fetch_array($rol)) 
		   		{
		   			?>	
		   			<option value="<?php echo $rol2["idroles"]; ?>"> <?php echo $rol2["descripcion"] ?></option>
		   		<?php 	
		   	  	}
	  
}

function economico_existe($conn,$login,$d_idlogin)
{
	$query= mysqli_query($conn,"SELECT id,idlogin FROM `login` WHERE idlogin='$login'AND id!='$d_idlogin'");
	$resultado= mysqli_fetch_array($query);
	return $resultado;
}

function llenar_doc ($conn,$id)
{
	$my= mysqli_query($conn,"SELECT 
			    d.iddoctores,
			    d.idrol,
			    d.nombre,
			    d.apellidopaterno,
			    d.apellidomaterno,
			    d.especialidad,
			    d.turno,
			    d.cedprof,
			    l.idlogin as login,
			    r.descripcion,
			    d.idlogin
			FROM
			    doctores d
			        INNER JOIN
			    roles r ON d.idrol = r.idroles and iddoctores = $id
			    INNER JOIN login l ON id=d.idlogin
			    ORDER BY iddoctores");
	return $my;
}

function actualiza_doc_sin_pass($conn,$login,$d_idlogin,$nombre,$apellidop,$apellidom,$especialidaddoc,$turno,$ced,$opcion,$iddoctores)
{
	$update_login= mysqli_query($conn,"UPDATE login SET idlogin='$login' WHERE id='$d_idlogin'");
	$update= mysqli_query($conn,"UPDATE doctores SET nombre='$nombre',apellidopaterno='$apellidop',apellidomaterno='$apellidom',especialidad='$especialidaddoc',turno='$turno',cedprof='$ced',idlogin='$d_idlogin',idrol='$opcion' WHERE iddoctores='$iddoctores' ");
	$update_doc2=mysqli_affected_rows($conn);
	if($update_login && $update)
	{
		$update_doc=$update_doc2;
	}
	return $update_doc;
}

function actualizar_contraseña_doc($conn,$pass,$login,$d_idlogin)
{
	$updatepass= mysqli_query($conn,"UPDATE login SET  pass='$pass',idlogin='$login' WHERE id='$d_idlogin' ");
	$updatepass2=mysqli_affected_rows($conn);
	return $updatepass2;
}
function actualiza_doc_con_pass($conn,$nombre,$apellidop,$apellidom,$especialidaddoc,$turno,$ced,$d_idlogin,$opcion,$iddoctores)
{
	$update= mysqli_query($conn,"UPDATE doctores SET nombre='$nombre',apellidopaterno='$apellidop',apellidomaterno='$apellidom',especialidad='$especialidaddoc',turno='$turno',cedprof='$ced',idlogin='$d_idlogin',idrol='$opcion' WHERE iddoctores='$iddoctores' ");
	$update_doc2=mysqli_affected_rows($conn);
	if($update)
	{
		$update_doc=$update_doc2;
	}
	return $update_doc;
}

function id_doc_eliminar($conn,$id)
{
	$query= mysqli_query($conn,"SELECT 
	    d.nombre,
	    d.especialidad,
	    d.cedprof,
	    d.idlogin,
	    r.descripcion,
	    l.id,
	    l.idlogin as login
	FROM
	    doctores d
	        INNER JOIN
	    roles r ON iddoctores = $id AND idroles = idrol
	        INNER JOIN
	    login l ON l.id = d.idlogin");
			 $res= mysqli_num_rows($query);
			 return $res;
}

function id_doc_eliminar2($conn,$id)
{
	$query= mysqli_query($conn,"SELECT 
	    d.nombre,
	    d.especialidad,
	    d.cedprof,
	    d.idlogin,
	    r.descripcion,
	    l.id,
	    l.idlogin as login
	FROM
	    doctores d
	        INNER JOIN
	    roles r ON iddoctores = $id AND idroles = idrol
	        INNER JOIN
	    login l ON l.id = d.idlogin");
			 return $query;
}

function eliminar_doc($conn,$id)
{
	$eliminar_doc=mysqli_query($conn," DELETE FROM doctores WHERE iddoctores =$id");
	$delete_doc=mysqli_affected_rows($conn);
	return $delete_doc;
}

function eliminar_login($conn,$login_id)
{
	$eliminar_login=mysqli_query($conn," DELETE FROM login WHERE id =$login_id");
	$delete_login=mysqli_affected_rows($conn);
	return $delete_login;
}

//////////////////////////////////////////// HISTORIAL ////////////////////////////////////////////////////////////////////////////

function historial_matricula_existe($conn,$matricula)
{
	$query= mysqli_query($conn,"SELECT * FROM pacientes  WHERE matricula ='$matricula' AND estatus=1 ");
			$resultado= mysqli_fetch_array($query);
			return $resultado;
}

function id_causa($conn,$causa,$descripcioncausa)
{
	$query_idcausa= mysqli_query($conn,"SELECT idcausa FROM causa WHERE nombrecausa='$causa' AND descripcion='$descripcioncausa';");
					$resultado_idcausa=mysqli_fetch_array($query_idcausa);
					$idcausa=$resultado_idcausa["idcausa"];
					return $idcausa;
}

function id_medicamentos($conn,$nombremedicamento,$presentacion)
{
	$query_medicamento= mysqli_query($conn,"SELECT idmedicamentos FROM medicamentos WHERE medicamentosnombre ='$nombremedicamento' AND presentacion='$presentacion'");
					$resultado_idmedicamentos=mysqli_fetch_array($query_medicamento);
					$idmedicamentos=$resultado_idmedicamentos["idmedicamentos"];
					return $idmedicamentos;

}

function id_paciente($conn,$matricula)
{
	$query_idpaciente= mysqli_query($conn,"SELECT idpacientes FROM pacientes WHERE matricula ='$matricula' AND estatus=1 ");
					$resultado_idpaciente=mysqli_fetch_array($query_idpaciente);
					$idpaciente=$resultado_idpaciente["idpacientes"];
					return $idpaciente;
}

function id_de_login($conn,$idlogin)
{
	$id_de_login= mysqli_query($conn,"SELECT id FROM login WHERE idlogin='$idlogin' ");
					$resultado_id_de_login=mysqli_fetch_array($id_de_login);
					$idl=$resultado_id_de_login["id"];
					return $idl;
}

function id_doctores($conn,$idl)
{
	$query_iddoctor= mysqli_query($conn,"SELECT iddoctores FROM doctores WHERE idlogin='$idl' ");
					$resultado_iddoctor=mysqli_fetch_array($query_iddoctor);
					$iddoc=$resultado_iddoctor["iddoctores"];
					return $iddoc;
}

function resultado_idcausa($conn,$causa,$descripcioncausa)
{
	$query_idcausa= mysqli_query($conn,"SELECT idcausa FROM causa WHERE nombrecausa='$causa' AND descripcion='$descripcioncausa';");
					$resultado_idcausa=mysqli_fetch_array($query_idcausa);
					return $resultado_idcausa;
}

function inserta_historial($conn,$iddoc,$idpaciente,$fechahist,$horahist,$tratamiento,$idcausa)
{
	$inserta_historial= mysqli_query($conn,"INSERT INTO historial(iddoc,idpaciente,fecha,hora,tratamiento,idcausa) VALUES('$iddoc','$idpaciente','$fechahist','$horahist','$tratamiento','$idcausa')");//pasar id doctor y paciente
		$agregar_historial=mysqli_affected_rows($conn);
	return $agregar_historial;
}

function hist_m5($conn,$ultimo_idhistorial,$medicina5)
{
	$hist_m5= mysqli_query($conn,"INSERT INTO historial_med(idhistorial,idmedicamentos) VALUES('$ultimo_idhistorial','$medicina5')");
		$agregar_historial=mysqli_affected_rows($conn);
	return $agregar_historial;
}

function hist_m5a($conn,$idhistorial,$medicina5,$id_hm5)
{
	$hist_m5= mysqli_query($conn," UPDATE historial_med SET idhistorial='$idhistorial',idmedicamentos='$medicina5' WHERE idhistorial = '$idhistorial' AND idhistorial_med='$id_hm5' ");
		$agregar_historial=mysqli_affected_rows($conn);
	return $agregar_historial;
}

function hist_m5a_id($conn,$idhistorial,$medicina5)
{
	$idhistorial_med= mysqli_query($conn," SELECT idhistorial_med from historial_med where idhistorial='$idhistorial' and idmedicamentos='$medicina5' ");
	$idhistorial_med=mysqli_fetch_array($idhistorial_med);
	return $idhistorial_med;
}

function hist_m4a_id($conn,$idhistorial,$medicina4)
{
	$idhistorial_med= mysqli_query($conn," SELECT idhistorial_med from historial_med where idhistorial='$idhistorial' and idmedicamentos='$medicina4' ");
	$idhistorial_med=mysqli_fetch_array($idhistorial_med);
	return $idhistorial_med;
}

function hist_m3a_id($conn,$idhistorial,$medicina3)
{
	$idhistorial_med= mysqli_query($conn," SELECT idhistorial_med from historial_med where idhistorial='$idhistorial' and idmedicamentos='$medicina3' ");
	$idhistorial_med=mysqli_fetch_array($idhistorial_med);
	return $idhistorial_med;
}

function hist_m2a_id($conn,$idhistorial,$medicina2)
{
	$idhistorial_med= mysqli_query($conn," SELECT idhistorial_med from historial_med where idhistorial='$idhistorial' and idmedicamentos='$medicina2' ");
	$idhistorial_med=mysqli_fetch_array($idhistorial_med);
	return $idhistorial_med;
}

function hist_m1a_id($conn,$idhistorial,$medicina1)
{
	$idhistorial_med= mysqli_query($conn," SELECT idhistorial_med from historial_med where idhistorial='$idhistorial' and idmedicamentos='$medicina1' ");
	$idhistorial_med=mysqli_fetch_array($idhistorial_med);
	return $idhistorial_med;
}

function hist_m4($conn,$ultimo_idhistorial,$medicina4)
{
	$hist_m4= mysqli_query($conn,"INSERT INTO historial_med(idhistorial,idmedicamentos) VALUES('$ultimo_idhistorial','$medicina4')");
		$agregar_historial=mysqli_affected_rows($conn);
	return $agregar_historial;
}

function hist_m4a($conn,$idhistorial,$medicina4,$id_hm4)
{
	$hist_m4= mysqli_query($conn,"UPDATE historial_med SET idhistorial='$idhistorial',idmedicamentos='$medicina4' WHERE idhistorial = '$idhistorial' AND idhistorial_med='$id_hm4' ");
		$agregar_historial=mysqli_affected_rows($conn);
	return $agregar_historial;
}

function hist_m3($conn,$ultimo_idhistorial,$medicina3)
{
	$hist_m3= mysqli_query($conn,"INSERT INTO historial_med(idhistorial,idmedicamentos) VALUES('$ultimo_idhistorial','$medicina3')");
		$agregar_historial=mysqli_affected_rows($conn);
	return $agregar_historial;
}

function hist_m3a($conn,$idhistorial,$medicina3,$id_hm3)
{
	$hist_m3= mysqli_query($conn,"UPDATE historial_med SET idhistorial='$idhistorial',idmedicamentos='$medicina3' WHERE idhistorial = '$idhistorial' AND idhistorial_med='$id_hm3' ");
		$agregar_historial=mysqli_affected_rows($conn);
	return $agregar_historial;
}

function hist_m2($conn,$ultimo_idhistorial,$medicina2)
{
	$hist_m2= mysqli_query($conn,"INSERT INTO historial_med(idhistorial,idmedicamentos) VALUES('$ultimo_idhistorial','$medicina2')");
		$agregar_historial=mysqli_affected_rows($conn);
	return $agregar_historial;
}

function hist_m2a($conn,$idhistorial,$medicina2,$id_hm2)
{
	$hist_m2= mysqli_query($conn,"UPDATE historial_med SET idhistorial='$idhistorial',idmedicamentos='$medicina2' WHERE idhistorial = '$idhistorial' AND idhistorial_med='$id_hm2' ");
		$agregar_historial=mysqli_affected_rows($conn);
	return $agregar_historial;
}

function hist_m1($conn,$ultimo_idhistorial,$medicina1)
{
	$hist_m1= mysqli_query($conn,"INSERT INTO historial_med(idhistorial,idmedicamentos) VALUES('$ultimo_idhistorial','$medicina1')");
		$agregar_historial=mysqli_affected_rows($conn);
	return $agregar_historial;
}

function hist_m1a($conn,$idhistorial,$medicina1,$id_hm1)
{
	$hist_m1= mysqli_query($conn,"UPDATE historial_med SET idhistorial='$idhistorial',idmedicamentos='$medicina1' WHERE idhistorial = '$idhistorial' AND idhistorial_med='$id_hm1' ");
		$agregar_historial=mysqli_affected_rows($conn);
	return $agregar_historial;
}

function hist_re5($conn,$ultimo_idhistorial,$recurso5)
{
	$hist_re5= mysqli_query($conn,"INSERT INTO historial_rec(idhistorial,idrecurso) VALUES('$ultimo_idhistorial','$recurso5')");
		$agregar_historial=mysqli_affected_rows($conn);
	return $agregar_historial;
}

function hist_re5a($conn,$idhistorial,$recurso5,$id_r5)
{
	$hist_re5= mysqli_query($conn," UPDATE historial_rec SET idhistorial='$idhistorial',idrecurso='$recurso5' WHERE idhistorial = '$idhistorial' AND idhistorial_rec='$id_r5' ");
		$agregar_historial=mysqli_affected_rows($conn);
	return $agregar_historial;
}

function hist_re5a_id($conn,$idhistorial,$id5)
{
	$id_re5= mysqli_query($conn," SELECT idhistorial_rec from historial_rec where idhistorial='$idhistorial' and idrecurso='$id5' ");
	$id_re5=mysqli_fetch_array($id_re5);
	return $id_re5;
}

function hist_re4a_id($conn,$idhistorial,$id4)
{
	$id_re5= mysqli_query($conn," SELECT idhistorial_rec from historial_rec where idhistorial='$idhistorial' and idrecurso='$id4' ");
	$id_re5=mysqli_fetch_array($id_re5);
	return $id_re5;
}

function hist_re3a_id($conn,$idhistorial,$id3)
{
	$id_re5= mysqli_query($conn," SELECT idhistorial_rec from historial_rec where idhistorial='$idhistorial' and idrecurso='$id3' ");
	$id_re5=mysqli_fetch_array($id_re5);
	return $id_re5;
}

function hist_re2a_id($conn,$idhistorial,$id2)
{
	$id_re5= mysqli_query($conn," SELECT idhistorial_rec from historial_rec where idhistorial='$idhistorial' and idrecurso='$id2' ");
	$id_re5=mysqli_fetch_array($id_re5);
	return $id_re5;
}

function hist_re1a_id($conn,$idhistorial,$id1)
{
	$id_re5= mysqli_query($conn," SELECT idhistorial_rec from historial_rec where idhistorial='$idhistorial' and idrecurso='$id1' ");
	$id_re5=mysqli_fetch_array($id_re5);
	return $id_re5;
}

function hist_re4($conn,$ultimo_idhistorial,$recurso4)
{
	$hist_re4= mysqli_query($conn,"INSERT INTO historial_rec(idhistorial,idrecurso) VALUES('$ultimo_idhistorial','$recurso4')");
		$agregar_historial=mysqli_affected_rows($conn);
	return $agregar_historial;
}

function hist_re4a($conn,$idhistorial,$recurso4,$id_r4)
{
	$hist_re4= mysqli_query($conn," UPDATE historial_rec SET idhistorial='$idhistorial',idrecurso='$recurso4' WHERE idhistorial = '$idhistorial' AND idhistorial_rec='$id_r4' ");
		$agregar_historial=mysqli_affected_rows($conn);
	return $agregar_historial;
}

function hist_re3($conn,$ultimo_idhistorial,$recurso3)
{
	$hist_re3= mysqli_query($conn,"INSERT INTO historial_rec(idhistorial,idrecurso) VALUES('$ultimo_idhistorial','$recurso3')");
		$agregar_historial=mysqli_affected_rows($conn);
	return $agregar_historial;
}

function hist_re3a($conn,$idhistorial,$recurso3,$id_r3)
{
	$hist_re3= mysqli_query($conn," UPDATE historial_rec SET idhistorial='$idhistorial',idrecurso='$recurso3' WHERE idhistorial = '$idhistorial' AND idhistorial_rec='$id_r3' ");

		$agregar_historial=mysqli_affected_rows($conn);
	return $agregar_historial;
}

function hist_re2($conn,$ultimo_idhistorial,$recurso2)
{	
	$hist_re2= mysqli_query($conn,"INSERT INTO historial_rec(idhistorial,idrecurso) VALUES('$ultimo_idhistorial','$recurso2')");
		$agregar_historial=mysqli_affected_rows($conn);
	return $agregar_historial;
}

function hist_re2a($conn,$idhistorial,$recurso2,$id_r2)
{

	$hist_re2= mysqli_query($conn," UPDATE historial_rec SET idhistorial='$idhistorial',idrecurso='$recurso2' WHERE idhistorial = '$idhistorial' AND idhistorial_rec='$id_r2' ");
		$agregar_historial=mysqli_affected_rows($conn);
	return $agregar_historial;
}

function hist_re1($conn,$ultimo_idhistorial,$recurso1)
{
	$hist_re1= mysqli_query($conn,"INSERT INTO historial_rec(idhistorial,idrecurso) VALUES('$ultimo_idhistorial','$recurso1')");
		$agregar_historial=mysqli_affected_rows($conn);
	return $agregar_historial;
}

function hist_re1a($conn,$idhistorial,$recurso1,$id_r1)
{
	$hist_re1= mysqli_query($conn," UPDATE historial_rec SET idhistorial='$idhistorial',idrecurso='$recurso1' WHERE idhistorial = '$idhistorial' AND idhistorial_rec='$id_r1' ");
		$agregar_historial=mysqli_affected_rows($conn);
	return $agregar_historial;
}


function inserta_causa($conn,$causa,$descripcioncausa)
{
	$inserta_causa= mysqli_query($conn,"INSERT INTO causa(nombrecausa,descripcion) VALUES('$causa','$descripcioncausa')");

	$agregar_causa=mysqli_affected_rows($conn);
	return $agregar_causa;
}

function inserta_historial_sin_causa($conn,$iddoc,$idpaciente,$fechahist,$horahist,$tratamiento,$ultimo_id)
{
	$inserta_historial= mysqli_query($conn,"INSERT INTO historial(iddoc,idpaciente,fecha,hora,tratamiento,idcausa) VALUES('$iddoc','$idpaciente','$fechahist','$horahist','$tratamiento','$ultimo_id')");
	$inserta_historial_sin_causa=mysqli_affected_rows($conn);
	return $inserta_historial_sin_causa;
}

function resultado_idmedicamentos($conn,$nombremedicamento,$presentacion)
{
	$query_medicamento= mysqli_query($conn,"SELECT idmedicamentos FROM medicamentos WHERE medicamentosnombre ='$nombremedicamento' AND presentacion='$presentacion'");
					$resultado_idmedicamentos=mysqli_fetch_array($query_medicamento);
					return $resultado_idmedicamentos;
}

function inserta_historial_medicamento($conn,$ultimo_idhistorial,$idmedicamentos,$descripcion_medicamento)
{
	$inserta_historial_medicamento= mysqli_query($conn,"INSERT INTO `historial/medicamentos`(idhistorial,idmedicamentos,descripcionhm) VALUES('$ultimo_idhistorial','$idmedicamentos','$descripcion_medicamento')");
	$agrega_historial_medicamento=mysqli_affected_rows($conn);
	return $agrega_historial_medicamento;
}

function inserta_idmedicamento($conn,$nombremedicamento,$presentacion)
{
	$inserta_idmedicamento= mysqli_query($conn,"INSERT INTO medicamentos(medicamentosnombre,presentacion) VALUES('$nombremedicamento','$presentacion')");
	$agrega_idmedicamento=mysqli_affected_rows($conn);
	return $agrega_idmedicamento;
}
function inserta_historial_sin_medicamento($conn,$ultimo_idhistorial,$ultimo_idmedicamento,$descripcion_medicamento)
{
	$inserta_historial_medicamento= mysqli_query($conn,"INSERT INTO `historial/medicamentos`(idhistorial,idmedicamentos,descripcionhm) VALUES('$ultimo_idhistorial','$ultimo_idmedicamento','$descripcion_medicamento')");
	$agrega_historial_sin_medicamento=mysqli_affected_rows($conn);
	return $agrega_historial_sin_medicamento;
}

function pagindor_historial($conn)
{
	$paginador=mysqli_query($conn, "SELECT COUNT(*) as total FROM historial WHERE estatus = 1");
	$paginador_res= mysqli_fetch_array($paginador);
	return $paginador_res;
}

function llenar_tabla_historial ($conn,$desde,$num_pag)
{
	$query=mysqli_query($conn, "SELECT 
    h.idhistorial,
    l.idlogin as No_Eco_Medico,
    d.nombre as Nombre_Medico,
    d.apellidopaterno as Paterno, 
    p.nombre as Paciente,
    p.apellidopaterno,
    p.apellidomaterno,
    h.fecha,
    h.hora,
    h.tratamiento,
    c.nombrecausa,
    c.descripcion,
    m.idmedicamentos,
    GROUP_CONCAT(DISTINCT m.medicamentosnombre) AS medicina,
    r.idrecurso,
    GROUP_CONCAT(DISTINCT r.nombrerecurso) AS recurso    
FROM
    historial h
	left JOIN
    historial_med hm on h.idhistorial=hm.idhistorial
    left join
    medicamentos m ON m.idmedicamentos = hm.idmedicamentos
    inner join
    pacientes p on p.idpacientes=h.idpaciente
    inner  join 
    doctores d on d.iddoctores=h.iddoc
    inner  join 
    login l on l.id=d.idlogin
    inner  join 
    causa c on c.idcausa=h.idcausa 
    AND h.estatus = 1
    left  join 
    historial_rec hr on hr.idhistorial=h.idhistorial
    left  join 
    recursos r on r.idrecurso=hr.idrecurso
    
	GROUP BY 1
     ORDER BY h.idhistorial
     LIMIT $desde,$num_pag");
	$resultado =mysqli_num_rows($query);
	return $resultado;
}

function llenar_tabla_historial2 ($conn,$desde,$num_pag)
{
	$query=mysqli_query($conn, "SELECT 
    h.idhistorial,
    l.idlogin as No_Eco_Medico,
    d.nombre as Nombre_Medico,
    d.apellidopaterno as Paterno, 
    p.nombre as Paciente,
    p.apellidopaterno,
    p.apellidomaterno,
    h.fecha,
    h.hora,
    h.tratamiento,
    c.nombrecausa,
    c.descripcion,
    m.idmedicamentos,
    GROUP_CONCAT(DISTINCT m.medicamentosnombre) AS medicina,
    r.idrecurso,
    GROUP_CONCAT(DISTINCT r.nombrerecurso) AS recurso    
FROM
    historial h
	left JOIN
    historial_med hm on h.idhistorial=hm.idhistorial
    left join
    medicamentos m ON m.idmedicamentos = hm.idmedicamentos
    inner join
    pacientes p on p.idpacientes=h.idpaciente
    inner  join 
    doctores d on d.iddoctores=h.iddoc
    inner  join 
    login l on l.id=d.idlogin
    inner  join 
    causa c on c.idcausa=h.idcausa 
    AND h.estatus = 1
    left  join 
    historial_rec hr on hr.idhistorial=h.idhistorial
    left  join 
    recursos r on r.idrecurso=hr.idrecurso
    
	GROUP BY 1
     ORDER BY h.idhistorial LIMIT $desde,$num_pag");
	return $query;
}

function llenar_actualizar_historial($conn,$id)
{
	$my= mysqli_query($conn,"SELECT    
	h.idhistorial as id,
   p.matricula as paciente,
   p.nombre,
   p.apellidopaterno,
   p.apellidomaterno,
    h.fecha,
    h.hora,
    h.tratamiento,
    c.nombrecausa,
    c.descripcion,
    d.nombre as medico,
    d.apellidopaterno,
    l.idlogin as llogin,
    hm.idmedicamentos,
    m.medicamentosnombre,
    hr.idrecurso,
    r.nombrerecurso
from historial h
		INNER join
    causa c ON c.idcausa = h.idcausa 
        INNER JOIN
    pacientes p ON idpacientes = h.idpaciente 
		INNER JOIN doctores d ON d.iddoctores=h.iddoc 
        INNER JOIN login l ON l.id=d.idlogin and h.idhistorial=$id
		left join
     historial_med hm on h.idhistorial=hm.idhistorial
        left JOIN
        medicamentos m ON m.idmedicamentos=hm.idmedicamentos
        left JOIN historial_rec hr ON hr.idhistorial=h.idhistorial
        left JOIN recursos r ON r.idrecurso=hr.idrecurso
        AND h.estatus = 1
ORDER BY h.idhistorial");
		$resul_my= mysqli_num_rows($my);



		return $resul_my;
}

function llenar_actualizar_historial2($conn,$id)
{
	$my= mysqli_query($conn,"SELECT    
	h.idhistorial as id,
   p.matricula as paciente,
   p.nombre,
   p.apellidopaterno,
   p.apellidomaterno,
    h.fecha,
    h.hora,
    h.tratamiento,
    c.nombrecausa,
    c.descripcion,
    d.nombre as medico,
    d.apellidopaterno,
    l.idlogin as llogin,
    hm.idmedicamentos,
    m.medicamentosnombre,
    hr.idrecurso,
    r.nombrerecurso
from historial h
		INNER join
    causa c ON c.idcausa = h.idcausa 
        INNER JOIN
    pacientes p ON idpacientes = h.idpaciente 
		INNER JOIN doctores d ON d.iddoctores=h.iddoc 
        INNER JOIN login l ON l.id=d.idlogin and h.idhistorial=$id
		left join
     historial_med hm on h.idhistorial=hm.idhistorial
        left JOIN
        medicamentos m ON m.idmedicamentos=hm.idmedicamentos
        left JOIN historial_rec hr ON hr.idhistorial=h.idhistorial
        left JOIN recursos r ON r.idrecurso=hr.idrecurso
        AND h.estatus = 1
ORDER BY h.idhistorial");
		
////////////////////////////////////////////////////
	// while($row = $my->fetch_array(MYSQLI_ASSOC)) {
     //       $myArray[] = $row;
    // }
     //echo json_encode($myArray);
    


		return $my;
}

function resultado_idpaciente($conn,$matricula)
{
	$query_idpaciente= mysqli_query($conn,"SELECT idpacientes FROM pacientes WHERE matricula ='$matricula' AND estatus=1 ");
							$resultado_idpaciente=mysqli_fetch_array($query_idpaciente);
							return $resultado_idpaciente;
}

function resultado_id_de_login ($conn,$idlogin)
{
	$id_de_login= mysqli_query($conn,"SELECT id FROM login WHERE idlogin='$idlogin' ");
							$resultado_id_de_login=mysqli_fetch_array($id_de_login);
							return $resultado_id_de_login;
}

function resultado_iddoctor($conn,$idlogin)
{
	$query_iddoctor= mysqli_query($conn,"SELECT iddoctores FROM doctores WHERE idlogin='$idlogin' ");
							$resultado_iddoctor=mysqli_fetch_array($query_iddoctor);
							return $resultado_iddoctor;
}

function actualizar_historial($conn,$idpaciente,$fechahist,$horahist,$tratamiento,$idcausa,$idhistorial)
{
	$update_historial= mysqli_query($conn,"UPDATE historial SET idpaciente='$idpaciente',fecha='$fechahist',hora='$horahist',tratamiento='$tratamiento',idcausa='$idcausa' WHERE idhistorial = '$idhistorial' ");

	$update_historial2=mysqli_affected_rows($conn);
	return $update_historial2;
}

function actualizar_historial_sin_causa($conn,$idpaciente,$fechahist,$horahist,$tratamiento,$ultimo_id,$idhistorial)
{
	$update_historial=mysqli_query($conn,"UPDATE historial SET idpaciente='$idpaciente',fecha='$fechahist',hora='$horahist',tratamiento='$tratamiento',idcausa='$ultimo_id' WHERE idhistorial = '$idhistorial' ");
	$update_historial=mysqli_affected_rows($conn);
	return $update_historial;
}

function actualizar_historial_medicamentos($conn,$idmedicamentos,$descripcion_medicamento,$idhistorial)
{
	$update_historial_medicamentos= mysqli_query($conn,"UPDATE `historial/medicamentos` SET idmedicamentos='$idmedicamentos',descripcionhm='$descripcion_medicamento' WHERE idhistorial = '$idhistorial'");
	$actualizar_historial_medicamentos=mysqli_affected_rows($conn);
	return $actualizar_historial_medicamentos;
}

function agrega_idmedicamento ($conn,$nombremedicamento,$presentacion)
{
	$inserta_idmedicamento= mysqli_query($conn,"INSERT INTO medicamentos(medicamentosnombre,presentacion) VALUES('$nombremedicamento','$presentacion')");
	$inserta_idmedicamento=mysqli_affected_rows($conn);
	return $inserta_idmedicamento;
}

function actualiza_historial_medicamentos_sin_medicina($conn,$ultimo_idmedicamento,$descripcion_medicamento,$idhistorial)
{
	$update_historial_medicamentos= mysqli_query($conn,"UPDATE `historial/medicamentos` SET idmedicamentos='$ultimo_idmedicamento',descripcionhm='$descripcion_medicamento' WHERE idhistorial = '$idhistorial'");
	$actualiza_historial_medicamentos=mysqli_affected_rows($conn);
	return $actualiza_historial_medicamentos;
}

function llenar_eliminar_historial($conn,$id)
{
	$query= mysqli_query($conn,"SELECT 
	    h.idhistorial,
	    l.idlogin as llogin,
	    d.idlogin,
	    d.nombre as nd,
	    d.apellidopaterno as ad,
	    p.matricula,
	    p.nombre,
	    p.apellidopaterno,
	    h.fecha,
	    h.hora,
	    h.tratamiento,
	    c.nombrecausa,
	    c.descripcion
	FROM
	    historial h
	        INNER JOIN
	    causa c ON h.idcausa = c.idcausa
	        AND idhistorial = $id
	        INNER JOIN
	    pacientes p ON p.idpacientes=h.idpaciente
	    	INNER JOIN
	    doctores d ON d.iddoctores=h.iddoc
	    	INNER JOIN
		login l ON l.id=d.idlogin    		 
	        AND h.estatus = 1");
	return $query;
}

function eliminar_historial($conn,$id)
{
	$query= mysqli_query($conn," UPDATE historial SET estatus = 0  WHERE idhistorial =$id");
	$delete_historial=mysqli_affected_rows($conn);
	return $delete_historial;
}
////////////////////////////////////////////// HISTORIAL CON RECURSOS /////////////////////////////////////////////////////////////////
function recurso($conn)
{
	$recurso= mysqli_query($conn,"SELECT * FROM recursos");
	  $resultado_recurso= mysqli_num_rows($recurso);
	  return $resultado_recurso;
}
function recurso_poner($conn,$recurso)
{
	$recurso= mysqli_query($conn,"SELECT nombrerecurso FROM recursos WHERE idrecurso=$recurso");
	  $resultado_recurso= mysqli_fetch_array($recurso);
	  return $resultado_recurso;
}
function med_poner($conn,$medicina)
{
	$med= mysqli_query($conn,"SELECT medicamentosnombre FROM medicamentos WHERE idmedicamentos=$medicina");
	  $resultado_med= mysqli_fetch_array($med);
	  return $resultado_med;
}

function medicina2($conn)
{
	$medicina= mysqli_query($conn,"SELECT * FROM medicamentos");
	  $resultado_medicina= mysqli_num_rows($medicina);
	  return $resultado_medicina;
}

function recurso2($conn)
{
	$recurso= mysqli_query($conn,"SELECT * FROM recursos");
	return $recurso;
}
function recurso_che($conn,$id)
{
	$recurso= mysqli_query($conn,"SELECT
    hr.idrecurso
FROM
    historial h
        INNER JOIN
    doctores d ON d.iddoctores = h.iddoc
        AND h.idhistorial = $id
        LEFT JOIN
    historial_rec hr ON hr.idhistorial = h.idhistorial
        LEFT JOIN
    recursos r ON r.idrecurso = hr.idrecurso
        AND h.estatus = 1
        ORDER BY h.idhistorial");
	return $recurso;
}
function recurso_che2($conn,$id)
{
	$recurso= mysqli_query($conn,"SELECT    
	h.idhistorial as id,
   p.matricula as paciente,
   p.nombre,
   p.apellidopaterno,
   p.apellidomaterno,
    h.fecha,
    h.hora,
    h.tratamiento,
    c.nombrecausa,
    c.descripcion,
    d.nombre as medico,
    d.apellidopaterno,
    l.idlogin as llogin,
    hm.idmedicamentos,
    m.medicamentosnombre,
    hr.idrecurso,
     r.nombrerecurso
from historial h
		INNER join
    causa c ON c.idcausa = h.idcausa 
        INNER JOIN
    pacientes p ON idpacientes = h.idpaciente 
		INNER JOIN doctores d ON d.iddoctores=h.iddoc 
        INNER JOIN login l ON l.id=d.idlogin and h.idhistorial=$id
		left join
     historial_med hm on h.idhistorial=hm.idhistorial
        left JOIN
        medicamentos m ON m.idmedicamentos=hm.idmedicamentos
        left JOIN historial_rec hr ON hr.idhistorial=h.idhistorial
        left JOIN recursos r ON r.idrecurso=hr.idrecurso
        AND h.estatus = 1
ORDER BY h.idhistorial");
	$hay_recurso_che=mysqli_fetch_array($recurso);
	return $hay_recurso_che;
}

function medicina($conn)
{
	$medicina= mysqli_query($conn,"SELECT * FROM medicamentos");
	return $medicina;
}

function resultado_cantidad($conn,$recurso,$cantidad)
{
	$query= mysqli_query($conn,"SELECT cantidadtotal FROM recursos WHERE  idrecurso='$recurso' AND  cantidadtotal >='$cantidad' ");
				$resultado_cantidad= mysqli_num_rows($query);
				return $resultado_cantidad;
}

function resultado_cantidad_medicina($conn,$medicina,$cantidad_medicina)
{
	$query= mysqli_query($conn,"SELECT cantidadtot FROM medicamentos WHERE  idmedicamentos='$medicina' AND  cantidadtot >='$cantidad_medicina' ");
				$resultado_cantidad= mysqli_num_rows($query);
				return $resultado_cantidad;
}

function cantidad_actual($conn,$recurso,$cantidad)
{
	$query= mysqli_query($conn,"SELECT cantidadtotal FROM recursos WHERE  idrecurso='$recurso' AND  cantidadtotal >='$cantidad' ");
				$cantidad_actual= mysqli_fetch_array($query);
				return $cantidad_actual;
}

function cantidad_actual_medicina($conn,$medicina,$cantidad_medicina)
{
	$query= mysqli_query($conn,"SELECT cantidadtot FROM medicamentos WHERE  idmedicamentos='$medicina' AND  cantidadtot >='$cantidad_medicina' ");
				$cantidad_actual_medicina= mysqli_fetch_array($query);
				return $cantidad_actual_medicina;
}

function actualizar_cantidad_restante($conn,$cantidad_restante,$recurso)
{
	$update= mysqli_query($conn,"UPDATE recursos SET cantidadtotal='$cantidad_restante' WHERE idrecurso = '$recurso' ");
	$update=mysqli_affected_rows($conn);
	return $update;
}
function actualizar_cantidad_restante_medicina($conn,$cantidad_restante_medicina,$medicina)
{
	$update= mysqli_query($conn,"UPDATE medicamentos SET cantidadtot='$cantidad_restante_medicina' WHERE idmedicamentos = '$medicina' ");
	$update=mysqli_affected_rows($conn);
	return $update;
}

function historial_recurso($conn,$idpaciente,$fecha,$hora,$causa,$recurso,$cantidad)
{
	$inserta= mysqli_query($conn,"INSERT INTO `historial/recurso`(idpaciente,fecha,hora,causa,idrecurso,cantidadusada) VALUES('$idpaciente','$fecha','$hora','$causa','$recurso','$cantidad')");
	$inserta=mysqli_affected_rows($conn);
	return $inserta;
}

function historial_recurso_medicina($conn,$idpaciente,$fecha,$hora,$causa,$medicina,$cantidad_medicina)
{
	$inserta= mysqli_query($conn,"INSERT INTO `historial/recurso`(idpaciente,fecha,hora,causa,idmedicamentos,cantidadusadamedicina) VALUES('$idpaciente','$fecha','$hora','$causa','$medicina','$cantidad_medicina')");
	$inserta=mysqli_affected_rows($conn);
	return $inserta;
}

function historial_recurso_con2($conn,$idpaciente,$fecha,$hora,$causa,$recurso,$cantidad,$medicina,$cantidad_medicina)
{
	$inserta= mysqli_query($conn,"INSERT INTO `historial/recurso`(idpaciente,fecha,hora,causa,idrecurso,cantidadusada,idmedicamentos,cantidadusadamedicina) VALUES('$idpaciente','$fecha','$hora','$causa','$recurso','$cantidad','$medicina','$cantidad_medicina')");
	$inserta=mysqli_affected_rows($conn);
	return $inserta;
}

function tabla_historial_con_recurso($conn,$desde,$num_pag)
{
	
	
	
	$query=mysqli_query($conn, "SELECT 
    hr.idhistorialrecurso,
    hr.idpaciente,
    hr.fecha,
    hr.hora,
    hr.causa,
    r.nombrerecurso,
    hr.cantidadusada,
    m.medicamentosnombre,
    hr.cantidadusadamedicina,
    p.matricula
FROM
    `historial/recurso` hr
        LEFT JOIN
    recursos r ON hr.idrecurso = r.idrecurso
        LEFT JOIN
    medicamentos m ON hr.idmedicamentos= m.idmedicamentos
    	LEFT JOIN
    pacientes p ON idpacientes = hr.idpaciente ORDER BY hr.idhistorialrecurso LIMIT $desde,$num_pag");
	$resultado =mysqli_num_rows($query);

	if($resultado > 0)
	{
		while($datos= mysqli_fetch_array($query))
		{ 
			?>
		<tr id="fila">
		<td id="casilla"><?php echo $datos["idhistorialrecurso"] ?></td>
		<td id="casilla"><?php echo $datos["matricula"] ?></td>
		<td id="casilla"><?php echo $datos["fecha"] ?></td>
		<td id="casilla"><?php echo $datos["hora"] ?></td>
		<td id="casilla"><?php echo $datos["causa"] ?></td>
		<td id="casilla"><?php echo $datos["cantidadusada"] ?></td>
		<td id="casilla"><?php echo $datos["nombrerecurso"] ?></td>
		<td id="casilla"><?php echo $datos["cantidadusadamedicina"] ?></td>
		<td id="casilla"><?php echo $datos["medicamentosnombre"] ?></td>
		<?php if ($_SESSION['idrol']!=3) { ?>
		<td id="casilla">
		<a class="edit" href="historialrecursos2.php?id= <?php echo $datos["idhistorialrecurso"] ?>">Editar</a> 	
		<a class="elim" href="historialrecursos3.php?id= <?php echo $datos["idhistorialrecurso"] ?>">Eliminar</a>
		<a class="elim" href="../pdf/receta_recurso.php?id= <?php echo $datos["idhistorialrecurso"] ?>" target="_blank">Receta</a> 	
		</td>
									<?php } ?>
	</tr>
	<?php 
		}
	}
}


function paginador_historial_con_recurso($conn)
{
	$paginador=mysqli_query($conn, "SELECT COUNT(*) as total FROM `historial/recurso` ");
	$paginador_res= mysqli_fetch_array($paginador);
	return $paginador_res;
}

function resultado_recurso($conn)
{
	$recurso= mysqli_query($conn,"SELECT * FROM recursos");
	  $resultado_recurso= mysqli_num_rows($recurso);
	  return $resultado_recurso;
}

function resultado_recurso2($conn)
{
	$recurso= mysqli_query($conn,"SELECT * FROM recursos");
	  return $recurso;
}

function llenar_historial_con_recurso ($conn,$id)
{
	$my= mysqli_query($conn,"SELECT 
    hr.idhistorialrecurso,
    hr.idpaciente,
    hr.fecha,
    hr.hora,
    hr.causa,
    hr.idrecurso,
    hr.cantidadusada,
    hr.idmedicamentos,
    hr.cantidadusadamedicina,
    p.matricula,
    m.medicamentosnombre,
    r.nombrerecurso
FROM
    `historial/recurso` hr
    	inner JOIN
    pacientes p ON idpacientes = hr.idpaciente AND idhistorialrecurso =$id
    left join
    medicamentos m ON m.idmedicamentos=hr.idmedicamentos AND idhistorialrecurso =$id
    left join
    recursos r ON r.idrecurso=hr.idrecurso AND idhistorialrecurso =$id");
	return $my;

}

function llenar_historial_con_recurso2($conn,$id)
{
	$my= mysqli_query($conn,"SELECT 
    hr.idhistorialrecurso,
    hr.idpaciente,
    hr.fecha,
    hr.hora,
    hr.causa,
    hr.idrecurso,
    hr.cantidadusada,
    hr.idmedicamentos,
    hr.cantidadusadamedicina,
    p.matricula,
    m.medicamentosnombre,
    r.nombrerecurso
FROM
    `historial/recurso` hr
    	inner JOIN
    pacientes p ON idpacientes = hr.idpaciente AND idhistorialrecurso =$id
    left join
    medicamentos m ON m.idmedicamentos=hr.idmedicamentos AND idhistorialrecurso =$id
    left join
    recursos r ON r.idrecurso=hr.idrecurso AND idhistorialrecurso =$id");
	$resul_my= mysqli_num_rows($my);
	return $resul_my;
}

function id_regreso($conn,$idhistorialrecurso)
{
	$idantes= mysqli_query($conn,"SELECT idrecurso FROM `historial/recurso` WHERE idhistorialrecurso='$idhistorialrecurso' ");
						$id_regreso= mysqli_fetch_array($idantes);
						return $id_regreso;
}

function id_regreso_med($conn,$idhistorialrecurso)
{
	$idantes= mysqli_query($conn,"SELECT idmedicamentos FROM `historial/recurso` WHERE idhistorialrecurso='$idhistorialrecurso' ");
						$id_regreso= mysqli_fetch_array($idantes);
						return $id_regreso;
}

function cant_regreso($conn,$id_antes,$idhistorialrecurso)
{
	$regreso= mysqli_query($conn,"SELECT cantidadusada FROM `historial/recurso` WHERE  idrecurso='$id_antes'  AND idhistorialrecurso='$idhistorialrecurso' ");
	$cant_regreso= mysqli_fetch_array($regreso);
	return $cant_regreso;
}
function cant_regreso_med($conn,$id_antes_med,$idhistorialrecurso)
{
	$regreso= mysqli_query($conn,"SELECT cantidadusadamedicina FROM `historial/recurso` WHERE  idmedicamentos='$id_antes_med'  AND idhistorialrecurso='$idhistorialrecurso' ");
	$cant_regreso= mysqli_fetch_array($regreso);
	return $cant_regreso;
}

function antes_cantidad1($conn,$id_antes)
{
	$res_total= mysqli_query($conn,"SELECT cantidadtotal FROM recursos WHERE  idrecurso='$id_antes' ");
						$antes_cantidad1= mysqli_fetch_array($res_total);
						return $antes_cantidad1;
}

function antes_cantidad1_med($conn,$id_antes_med)
{
	$res_total= mysqli_query($conn,"SELECT cantidadtot FROM medicamentos WHERE  idmedicamentos='$id_antes_med' ");
						$antes_cantidad1= mysqli_fetch_array($res_total);
						return $antes_cantidad1;
}

function actualizar_devuelta($conn,$devuelta,$id_antes) 
{
	$update2= mysqli_query($conn,"UPDATE recursos SET cantidadtotal='$devuelta' WHERE idrecurso ='$id_antes' ");
	$update=mysqli_affected_rows($conn);
	return $update;
}

function actualizar_devuelta_med($conn,$devuelta_med,$id_antes_med)
{
	$update2= mysqli_query($conn,"UPDATE medicamentos SET cantidadtot ='$devuelta_med' WHERE idmedicamentos = '$id_antes_med' ");
	$update=mysqli_affected_rows($conn);
	return $update;
}

function actualizar_cantidad_total($conn,$cantidad_restante,$recurso)
{
	$update= mysqli_query($conn,"UPDATE recursos SET cantidadtotal='$cantidad_restante' WHERE idrecurso = '$recurso' ");

	$update=mysqli_affected_rows($conn);
	return $update;
}
function actualizar_cantidad_total_med($conn,$cantidad_restante_med,$medicina)
{
	$update= mysqli_query($conn,"UPDATE medicamentos SET cantidadtot='$cantidad_restante_med' WHERE idmedicamentos = '$medicina' ");

	$update=mysqli_affected_rows($conn);
	return $update;
}

function inserta_historial_recurso($conn,$idpaciente,$fecha,$hora,$causa,$recurso,$cantidad,$medicina,$cantidad_medicina,$idhistorialrecurso)
{
	$inserta= mysqli_query($conn,"UPDATE `historial/recurso` SET idpaciente='$idpaciente',fecha='$fecha',hora='$hora',causa='$causa',idrecurso='$recurso',cantidadusada='$cantidad',idmedicamentos='$medicina',cantidadusadamedicina='$cantidad_medicina' WHERE idhistorialrecurso = '$idhistorialrecurso' ");
	$inserta=mysqli_affected_rows($conn);
	return $inserta;	
}
function inserta_historial_recurso2($conn,$idpaciente,$fecha,$hora,$causa,$recurso,$cantidad,$idhistorialrecurso)
{
	$inserta= mysqli_query($conn,"UPDATE `historial/recurso` SET idpaciente='$idpaciente',fecha='$fecha',hora='$hora',causa='$causa',idrecurso='$recurso',cantidadusada='$cantidad' WHERE idhistorialrecurso = '$idhistorialrecurso' ");
	$inserta=mysqli_affected_rows($conn);
	return $inserta;	
}

function inserta_historial_med3($conn,$idpaciente,$fecha,$hora,$causa,$medicina,$cantidad_medicina,$idhistorialrecurso)
{
	$inserta= mysqli_query($conn,"UPDATE `historial/recurso` SET idpaciente='$idpaciente',fecha='$fecha',hora='$hora',causa='$causa',idmedicamentos='$medicina',cantidadusadamedicina='$cantidad_medicina' WHERE idhistorialrecurso = '$idhistorialrecurso' ");
	$inserta=mysqli_affected_rows($conn);
	return $inserta;	
}

function llenar_eliminar_historial_con_recurso($conn,$id)
{
	$my= mysqli_query($conn,"SELECT 
    hr.idhistorialrecurso,
    hr.idpaciente,
    hr.fecha,
    hr.hora,
    hr.causa,
    hr.idrecurso,
    hr.cantidadusada,
    hr.idmedicamentos,
    hr.cantidadusadamedicina,
    p.matricula,
    m.medicamentosnombre,
    r.nombrerecurso
FROM
    `historial/recurso` hr
    	inner JOIN
    pacientes p ON idpacientes = hr.idpaciente AND idhistorialrecurso =$id
    left join
    medicamentos m ON m.idmedicamentos=hr.idmedicamentos AND idhistorialrecurso =$id
    left join
    recursos r ON r.idrecurso=hr.idrecurso AND idhistorialrecurso =$id");
			 $res= mysqli_num_rows($my);
			 return $res;
}

function llenar_eliminar_historial_con_recurso2($conn,$id)
{
	$query= mysqli_query($conn,"SELECT 
    hr.idhistorialrecurso,
    hr.idpaciente,
    hr.fecha,
    hr.hora,
    hr.causa,
    hr.idrecurso,
    hr.cantidadusada,
    hr.idmedicamentos,
    hr.cantidadusadamedicina,
    p.matricula,
    m.medicamentosnombre,
    r.nombrerecurso
FROM
    `historial/recurso` hr
    	inner JOIN
    pacientes p ON idpacientes = hr.idpaciente AND idhistorialrecurso =$id
    left join
    medicamentos m ON m.idmedicamentos=hr.idmedicamentos AND idhistorialrecurso =$id
    left join
    recursos r ON r.idrecurso=hr.idrecurso AND idhistorialrecurso =$id");
			 
			 return $query;
}

function eliminar_historial_con_recurso($conn,$id)
{
	$query= mysqli_query($conn," DELETE FROM `historial/recurso` WHERE idhistorialrecurso =$id");
	$query=mysqli_affected_rows($conn);
	return $query;

}

function id_recurso($conn,$nombre,$descripcion)
{
	$query_recurso= mysqli_query($conn,"SELECT idrecurso FROM recursos WHERE nombrerecurso='$nombre' AND descripcionrecurso='$descripcion';");
			$resultado_recurso=mysqli_fetch_array($query_recurso);
			return $resultado_recurso;
}
function id_medicina($conn,$nombre,$presentacion)
{
	$query_medicina= mysqli_query($conn,"SELECT idmedicamentos FROM medicamentos WHERE medicamentosnombre='$nombre' AND presentacion='$presentacion';");
			$resultado_medicina=mysqli_fetch_array($query_medicina);
			return $resultado_medicina;
}

function inserta_recurso ($conn,$nombre,$descripcion,$cantidad)
{
	$inserta= mysqli_query($conn,"INSERT INTO recursos(nombrerecurso,descripcionrecurso,cantidadtotal) VALUES('$nombre','$descripcion','$cantidad')");
	$inserta=mysqli_affected_rows($conn);
	return $inserta;
}

function inserta_medicina($conn,$nombre,$presentacion,$cantidad_med)
{
	$inserta= mysqli_query($conn,"INSERT INTO medicamentos(medicamentosnombre,presentacion,cantidadtot) VALUES('$nombre','$presentacion','$cantidad_med')");
	$inserta=mysqli_affected_rows($conn);
	return $inserta;
}

function paginador_recurso ($conn)
{
	$paginador=mysqli_query($conn, "SELECT COUNT(*) as total FROM recursos");
	$paginador_res= mysqli_fetch_array($paginador);
	return $paginador_res;
}

function paginador_medicina($conn)
{
	$paginador=mysqli_query($conn, "SELECT COUNT(*) as total FROM medicamentos");
	$paginador_res= mysqli_fetch_array($paginador);
	return $paginador_res;
}

function paginador_recurso2($conn,$desde,$num_pag)
{
	$query=mysqli_query($conn, "SELECT * FROM recursos ORDER BY idrecurso LIMIT $desde,$num_pag");
	$resultado =mysqli_num_rows($query);
	return $resultado;
}

function paginador_medicina2($conn,$desde,$num_pag)
{
	$query=mysqli_query($conn, "SELECT * FROM medicamentos ORDER BY idmedicamentos LIMIT $desde,$num_pag");
	$resultado =mysqli_num_rows($query);
	return $resultado;
}

function llenar_tabla_recurso($conn,$desde,$num_pag)
{
	$query=mysqli_query($conn, "SELECT * FROM recursos ORDER BY idrecurso LIMIT $desde,$num_pag");
	return $query;
}

function llenar_tabla_medicina($conn,$desde,$num_pag)
{
	$query=mysqli_query($conn, "SELECT * FROM medicamentos ORDER BY idmedicamentos LIMIT $desde,$num_pag");
	return $query;
}

function recursos ($conn,$id)
{
	$my= mysqli_query($conn,"SELECT * FROM recursos WHERE idrecurso=$id ORDER BY idrecurso");
		$resul_my= mysqli_num_rows($my);
		return $resul_my;
}

function medicina3($conn,$id)
{
	$my= mysqli_query($conn,"SELECT * FROM medicamentos WHERE idmedicamentos=$id ORDER BY idmedicamentos");
		$resul_my= mysqli_num_rows($my);
		return $resul_my;
}

function recursos2 ($conn,$id)
{
	$my= mysqli_query($conn,"SELECT * FROM recursos WHERE idrecurso=$id ORDER BY idrecurso");
		return $my;
}

function medicina4($conn,$id)
{
	$my= mysqli_query($conn,"SELECT * FROM medicamentos WHERE idmedicamentos=$id ORDER BY idmedicamentos");
		return $my;
}

function existe_recurso ($conn,$nombrerecurso,$idrecurso)
{
	$query= mysqli_query($conn,"SELECT * FROM recursos WHERE nombrerecurso ='$nombrerecurso' AND idrecurso != '$idrecurso'");
			$resultado= mysqli_fetch_array($query);
			return $resultado;
}
function existe_medicina($conn,$medicamentosnombre,$idmedicamentos)
{
	$query= mysqli_query($conn,"SELECT * FROM medicamentos WHERE medicamentosnombre ='$medicamentosnombre' AND idmedicamentos != '$idmedicamentos'");
			$resultado= mysqli_fetch_array($query);
			return $resultado;
}

function actualizar_recursos ($conn,$nombrerecurso,$descripcionrecurso,$cantidadtotal,$idrecurso)
{
	$update= mysqli_query($conn,"UPDATE recursos SET nombrerecurso='$nombrerecurso',descripcionrecurso='$descripcionrecurso',cantidadtotal='$cantidadtotal' WHERE idrecurso = '$idrecurso' ");
	$update=mysqli_affected_rows($conn);
	return $update;
}

function actualizar_medicina($conn,$medicamentosnombre,$presentacion,$cantidadtot,$idmedicamentos)
{
	$update= mysqli_query($conn,"UPDATE medicamentos SET medicamentosnombre='$medicamentosnombre',presentacion='$presentacion',cantidadtot='$cantidadtot' WHERE idmedicamentos = '$idmedicamentos' ");
	$update=mysqli_affected_rows($conn);
	return $update;
}

function llenar_eliminar_recurso ($conn,$id)
{
	$query= mysqli_query($conn,"SELECT * FROM recursos WHERE idrecurso=$id");
			 $res= mysqli_num_rows($query);
			 return $res;
}

function llenar_eliminar_medicina($conn,$id)
{
	$query= mysqli_query($conn,"SELECT * FROM medicamentos WHERE idmedicamentos=$id");
			 $res= mysqli_num_rows($query);
			 return $res;
}

function llenar_eliminar_recurso2 ($conn,$id)
{
	$query= mysqli_query($conn,"SELECT * FROM recursos WHERE idrecurso=$id");
			 return $query;
}

function llenar_eliminar_medicina2($conn,$id)
{
	$query= mysqli_query($conn,"SELECT * FROM medicamentos WHERE idmedicamentos=$id");
			 return $query;
}

function eliminar_recurso($conn,$id)
{
	$query= mysqli_query($conn," DELETE FROM `recursos` WHERE idrecurso =$id");
	$query=mysqli_affected_rows($conn);
	return $query;
}

function eliminar_medicina($conn,$id)
{
	$query= mysqli_query($conn," DELETE FROM `medicamentos` WHERE idmedicamentos =$id");
	$query=mysqli_affected_rows($conn);
	return $query;
}

function buscar_doc ($conn,$busqueda)
{
	$rol='';
	if ($busqueda == 'admin') 
	{
		$rol="OR idrol LIKE '%1%' ";
	}
	elseif ($busqueda == 'medicos') 
	{
		$rol="OR idrol LIKE '%2%' ";
	}
	elseif ($busqueda == 'enfermer@s') 
	{
		$rol="OR idrol LIKE '%3%' ";
	}


	$paginador=mysqli_query($conn, "SELECT
COUNT(*) AS total
FROM doctores d INNER JOIN
     login l ON l.id=d.idlogin
WHERE
(
iddoctores LIKE '%$busqueda%' OR
nombre LIKE '%$busqueda%' OR
apellidopaterno LIKE '%$busqueda%' OR
apellidomaterno LIKE '%$busqueda%' OR
especialidad LIKE '%$busqueda%' OR
turno LIKE '%$busqueda%' OR
cedprof LIKE '%$busqueda%' OR
l.idlogin LIKE '%$busqueda%' OR
d.idlogin LIKE '%$busqueda%'
$rol
) ");
	$paginador_res= mysqli_fetch_array($paginador);
	return $paginador_res;

}

function buscar_doc2($conn,$busqueda,$desde,$num_pag)
{
	$query=mysqli_query($conn, "SELECT d.iddoctores,d.idrol,d.nombre,d.apellidopaterno,d.apellidomaterno,d.especialidad,d.turno,d.cedprof,d.idlogin, r.descripcion,l.idlogin FROM doctores d INNER JOIN roles r ON d.idrol = r.idroles INNER JOIN login l ON  id=d.idlogin  WHERE (
d.iddoctores LIKE '%$busqueda%' OR
d.idrol LIKE '%$busqueda%' OR
d.nombre LIKE '%$busqueda%' OR
d.apellidopaterno LIKE '%$busqueda%' OR
d.apellidomaterno LIKE '%$busqueda%' OR
d.especialidad LIKE '%$busqueda%' OR
d.turno LIKE '%$busqueda%' OR
d.cedprof LIKE '%$busqueda%' OR
l.idlogin LIKE '%$busqueda%' OR
r.descripcion LIKE '%$busqueda%'
) order by iddoctores LIMIT $desde,$num_pag");
	$resultado =mysqli_num_rows($query);
	return $resultado;
}

function buscar_doc3($conn,$busqueda,$desde,$num_pag)
{
	$query=mysqli_query($conn, "SELECT d.iddoctores,d.idrol,d.nombre,d.apellidopaterno,d.apellidomaterno,d.especialidad,d.turno,d.cedprof,d.idlogin, r.descripcion,l.idlogin FROM doctores d INNER JOIN roles r ON d.idrol = r.idroles INNER JOIN login l ON  id=d.idlogin  WHERE (
d.iddoctores LIKE '%$busqueda%' OR
d.idrol LIKE '%$busqueda%' OR
d.nombre LIKE '%$busqueda%' OR
d.apellidopaterno LIKE '%$busqueda%' OR
d.apellidomaterno LIKE '%$busqueda%' OR
d.especialidad LIKE '%$busqueda%' OR
d.turno LIKE '%$busqueda%' OR
d.cedprof LIKE '%$busqueda%' OR
l.idlogin LIKE '%$busqueda%' OR
r.descripcion LIKE '%$busqueda%'
) order by iddoctores LIMIT $desde,$num_pag");
	return $query;
}

function paginador_buscar_historial($conn,$busqueda)
{
	$rol='';
	if ($busqueda == 'Gripa') 
	{
		$rol="OR idcausa LIKE '%1%' ";
	}
	elseif ($busqueda == 'Gripa') 
	{
		$rol="OR idcausa LIKE '%2%' ";
	}
	elseif ($busqueda == 'Migrana') 
	{
		$rol="OR idcausa LIKE '%3%' ";
	}
	elseif ($busqueda == 'Ansiedad') 
	{
		$rol="OR idcausa LIKE '%4%' ";
	}
	elseif ($busqueda == 'Resfriado') 
	{
		$rol="OR idcausa LIKE '%5%' ";
	}
	elseif ($busqueda == 'Infeccion de la garganta') 
	{
		$rol="OR idcausa LIKE '%6%' ";
	}
	elseif ($busqueda == 'Depresion') 
	{
		$rol="OR idcausa LIKE '%9%' ";
	}
	elseif ($busqueda == 'Obsesivo,compulsivo') 
	{
		$rol="OR idcausa LIKE '%12%' ";
	}
	elseif ($busqueda == 'Fiebre') 
	{
		$rol="OR idcausa LIKE '%13%' ";
	}
	elseif ($busqueda == 'Fiebre') 
	{
		$rol="OR idcausa LIKE '14%' ";
	}
	elseif ($busqueda == 'Dolor de cabeza') 
	{
		$rol="OR idcausa LIKE '%15%' ";
	}
	elseif ($busqueda == 'Dolor de muela') 
	{
		$rol="OR idcausa LIKE '%16%' ";
	}
	elseif ($busqueda == 'Dolor de Panza') 
	{
		$rol="OR idcausa LIKE '%23%' ";
	}
	elseif ($busqueda == 'Diarrea') 
	{
		$rol="OR idcausa LIKE '%24%' ";
	}
	elseif ($busqueda == 'Dolor de Panza') 
	{
		$rol="OR idcausa LIKE '%25%' ";
	}
	elseif ($busqueda == 'Tos') 
	{
		$rol="OR idcausa LIKE '%26%' ";
	}
	elseif ($busqueda == 'Tos con flemas') 
	{
		$rol="OR idcausa LIKE '%27%' ";
	}
	elseif ($busqueda == 'Tos') 
	{
		$rol="OR idcausa LIKE '%28%' ";
	}
	elseif ($busqueda == 'Mareo') 
	{
		$rol="OR idcausa LIKE '%30%' ";
	}
	elseif ($busqueda == 'Nauseas') 
	{
		$rol="OR idcausa LIKE '%31%' ";
	}
	elseif ($busqueda == 'febrÃ­cula') 
	{
		$rol="OR idcausa LIKE '%32%' ";
	}
	elseif ($busqueda == 'Colitis') 
	{
		$rol="OR idcausa LIKE '%34%' ";
	}
	elseif ($busqueda == 'Colitis') 
	{
		$rol="OR idcausa LIKE '%35%' ";
	}
	elseif ($busqueda == 'Gastritis') 
	{
		$rol="OR idcausa LIKE '%36%' ";
	}

	$paginador=mysqli_query($conn, "
SELECT
COUNT(*) AS total
FROM    
    historial h
    left  join
    historial_rec hr on hr.idhistorial_rec=h.idhistorial
    left  join
    historial_med hm on hm.idhistorial_med=h.idhistorial
    left join
    recursos r on r.idrecurso=hr.idrecurso 
    left join
    medicamentos m on m.idmedicamentos=hm.idmedicamentos
    inner join
    pacientes p on p.idpacientes=h.idpaciente
    inner  join 
    doctores d on d.iddoctores=h.iddoc
    inner  join 
    login l on l.id=d.idlogin
    inner  join 
    causa c on c.idcausa=h.idcausa WHERE
(
h.tratamiento LIKE '%$busqueda%' OR
    l.idlogin LIKE '%$busqueda%' OR
    d.nombre LIKE '%$busqueda%' OR
    d.apellidopaterno LIKE '%$busqueda%' OR
    p.nombre LIKE '%$busqueda%' OR
    p.apellidopaterno LIKE '%$busqueda%' OR
    p.apellidomaterno LIKE '%$busqueda%' OR
    h.fecha LIKE '%$busqueda%' OR
    h.hora LIKE '%$busqueda%' OR
    h.tratamiento LIKE '%$busqueda%' OR
    c.nombrecausa LIKE '%$busqueda%' OR
    c.descripcion LIKE '%$busqueda%' OR
    m.medicamentosnombre LIKE '%$busqueda%' OR
    r.nombrerecurso LIKE '%$busqueda%'$rol) 
AND h.estatus = 1
ORDER BY h.idhistorial");
	$paginador_res= mysqli_fetch_array($paginador);
	return $paginador_res;
}

function busqueda_historial($conn,$desde,$num_pag,$busqueda)
{
	$query=mysqli_query($conn, "SELECT 
    h.idhistorial,
    l.idlogin as No_Eco_Medico,
    d.nombre as Nombre_Medico,
    d.apellidopaterno as Paterno, 
    p.nombre as Paciente,
    p.apellidopaterno,
    p.apellidomaterno,
    h.fecha,
    h.hora,
    h.tratamiento,
    c.nombrecausa,
    c.descripcion,
    m.idmedicamentos,
    GROUP_CONCAT(DISTINCT m.medicamentosnombre) AS medicina,
    r.idrecurso,
    GROUP_CONCAT(DISTINCT r.nombrerecurso) AS recurso    
FROM
    historial h
	left JOIN
    historial_med hm on h.idhistorial=hm.idhistorial
    left  join 
    historial_rec hr on hr.idhistorial=h.idhistorial
    left  join 
    recursos r on r.idrecurso=hr.idrecurso
    left join
    medicamentos m ON m.idmedicamentos = hm.idmedicamentos
    inner join
    pacientes p on p.idpacientes=h.idpaciente
    inner  join 
    doctores d on d.iddoctores=h.iddoc
    inner  join 
    login l on l.id=d.idlogin
    inner  join 
    causa c on c.idcausa=h.idcausa
    WHERE
(
h.idhistorial LIKE '%$busqueda%' OR
    l.idlogin LIKE '%$busqueda%' OR
    d.nombre LIKE '%$busqueda%' OR
    d.apellidopaterno LIKE '%$busqueda%' OR
    p.nombre LIKE '%$busqueda%' OR
    p.apellidopaterno LIKE '%$busqueda%' OR
    p.apellidomaterno LIKE '%$busqueda%' OR
    h.fecha LIKE '%$busqueda%' OR
    h.hora LIKE '%$busqueda%' OR
    h.tratamiento LIKE '%$busqueda%' OR
    c.nombrecausa LIKE '%$busqueda%' OR
    c.descripcion LIKE '%$busqueda%' OR
    m.idmedicamentos LIKE '%$busqueda%' OR 
    m.medicamentosnombre LIKE '%$busqueda%' OR
    r.idrecurso LIKE '%$busqueda%' OR
    r.nombrerecurso LIKE '%$busqueda%'
)
    AND h.estatus = 1
	GROUP BY 1
     ORDER BY h.idhistorial LIMIT $desde,$num_pag");
	$resultado =mysqli_num_rows($query);
	return $resultado;
}
//aqui
function busqueda_historial2($conn,$desde,$num_pag,$busqueda)
{
	$query=mysqli_query($conn, "SELECT 
    h.idhistorial,
    l.idlogin as No_Eco_Medico,
    d.nombre as Nombre_Medico,
    d.apellidopaterno as Paterno, 
    p.nombre as Paciente,
    p.apellidopaterno,
    p.apellidomaterno,
    h.fecha,
    h.hora,
    h.tratamiento,
    c.nombrecausa,
    c.descripcion,
    m.idmedicamentos,
    GROUP_CONCAT(DISTINCT m.medicamentosnombre) AS medicina,
    r.idrecurso,
    GROUP_CONCAT(DISTINCT r.nombrerecurso) AS recurso    
FROM
    historial h
	left JOIN
    historial_med hm on h.idhistorial=hm.idhistorial
    left  join 
    historial_rec hr on hr.idhistorial=h.idhistorial
    left  join 
    recursos r on r.idrecurso=hr.idrecurso
    left join
    medicamentos m ON m.idmedicamentos = hm.idmedicamentos
    inner join
    pacientes p on p.idpacientes=h.idpaciente
    inner  join 
    doctores d on d.iddoctores=h.iddoc
    inner  join 
    login l on l.id=d.idlogin
    inner  join 
    causa c on c.idcausa=h.idcausa
    WHERE
(
h.idhistorial LIKE '%$busqueda%' OR
    l.idlogin LIKE '%$busqueda%' OR
    d.nombre LIKE '%$busqueda%' OR
    d.apellidopaterno LIKE '%$busqueda%' OR
    p.nombre LIKE '%$busqueda%' OR
    p.apellidopaterno LIKE '%$busqueda%' OR
    p.apellidomaterno LIKE '%$busqueda%' OR
    h.fecha LIKE '%$busqueda%' OR
    h.hora LIKE '%$busqueda%' OR
    h.tratamiento LIKE '%$busqueda%' OR
    c.nombrecausa LIKE '%$busqueda%' OR
    c.descripcion LIKE '%$busqueda%' OR
    m.idmedicamentos LIKE '%$busqueda%' OR 
    m.medicamentosnombre LIKE '%$busqueda%' OR
    r.idrecurso LIKE '%$busqueda%' OR
    r.nombrerecurso LIKE '%$busqueda%'
)
    AND h.estatus = 1
	GROUP BY 1
     ORDER BY h.idhistorial LIMIT $desde,$num_pag");
	return $query;
}

function paginador_busqueda_historial_recurso ($conn,$busqueda)
{
	$rol='';
	if ($busqueda == 'guantes de latex') 
	{
		$rol="OR idrecurso LIKE '%1%' ";
	}
	elseif ($busqueda == 'botella de agua') 
	{
		$rol="OR idrecurso LIKE '%2%' ";
	}
	elseif ($busqueda == 'jeringas') 
	{
		$rol="OR idrecurso LIKE '%3%' ";
	}
	elseif ($busqueda == 'agujas') 
	{
		$rol="OR idrecurso LIKE '%4%' ";
	}
	elseif ($busqueda == 'cateteres ') 
	{
		$rol="OR idrecurso LIKE '%5%' ";
	}
	elseif ($busqueda == 'vendas') 
	{
		$rol="OR idrecurso LIKE '%6%' ";
	}
	elseif ($busqueda == 'curitas') 
	{
		$rol="OR idrecurso LIKE '%7%' ";
	}
	elseif ($busqueda == 'gasa') 
	{
		$rol="OR idrecurso LIKE '%8%' ";
	}
	elseif ($busqueda == 'collarines') 
	{
		$rol="OR idrecurso LIKE '%9%' ";
	}
	elseif ($busqueda == 'ferulas') 
	{
		$rol="OR idrecurso LIKE '%10%' ";
	}
	elseif ($busqueda == 'cubrebocas') 
	{
		$rol="OR idrecurso LIKE '%11%' ";
	}
	elseif ($busqueda == 'depresor lingual ') 
	{
		$rol="OR idrecurso LIKE '%12%' ";
	}
	elseif ($busqueda == 'toallitas impregnadas de alcohol') 
	{
		$rol="OR idrecurso LIKE '%13%' ";
	}
	elseif ($busqueda == 'bolsa de frio instantaneo desechable') 
	{
		$rol="OR idrecurso LIKE '%14%' ";
	}
	elseif ($busqueda == 'toallitas impregnadas de antiseptico') 
	{
		$rol="OR idrecurso LIKE '%15%' ";
	}
	elseif ($busqueda == 'bolsas de plastico ') 
	{
		$rol="OR idrecurso LIKE '%16%' ";
	}
	elseif ($busqueda == 'mesulid ') 
	{
		$rol="OR idmedicamentos LIKE '%1%' ";
	}
	elseif ($busqueda == 'antifludes ') 
	{
		$rol="OR idmedicamentos LIKE '%2%' ";
	}
	elseif ($busqueda == 'nimesulida') 
	{
		$rol="OR idmedicamentos LIKE '%3%' ";
	}
	elseif ($busqueda == 'fluoxetina ') 
	{
		$rol="OR idmedicamentos LIKE '%4%' ";
	}
	elseif ($busqueda == 'desvenlafaxina ') 
	{
		$rol="OR idmedicamentos LIKE '%7%' ";
	}
	elseif ($busqueda == 'antifludes ') 
	{
		$rol="OR idmedicamentos LIKE '%8%' ";
	}
	elseif ($busqueda == 'antifludes') 
	{
		$rol="OR idmedicamentos LIKE '%9%' ";
	}
	elseif ($busqueda == 'bioelectro') 
	{
		$rol="OR idmedicamentos LIKE '%10%' ";
	}
	elseif ($busqueda == 'ketorolaco') 
	{
		$rol="OR idmedicamentos LIKE '%11%' ";
	}
	elseif ($busqueda == 'antifludes') 
	{
		$rol="OR idmedicamentos LIKE '%12%' ";
	}
	elseif ($busqueda == 'venlafaxina') 
	{
		$rol="OR idmedicamentos LIKE '%13%' ";
	}
	elseif ($busqueda == 'sal de uvas') 
	{
		$rol="OR idmedicamentos LIKE '%14%' ";
	}
	elseif ($busqueda == 'buscapina') 
	{
		$rol="OR idmedicamentos LIKE '%15%' ";
	}
	elseif ($busqueda == 'panotos') 
	{
		$rol="OR idmedicamentos LIKE '%16%' ";
	}
	elseif ($busqueda == 'panotos') 
	{
		$rol="OR idmedicamentos LIKE '%17%' ";
	}
	elseif ($busqueda == 'aspirina') 
	{
		$rol="OR idmedicamentos LIKE '%19%' ";
	}
	elseif ($busqueda == 'dramamine') 
	{
		$rol="OR idmedicamentos LIKE '%20%' ";
	}
	elseif ($busqueda == 'tylenol') 
	{
		$rol="OR idmedicamentos LIKE '%21%' ";
	}
	elseif ($busqueda == 'motrin') 
	{
		$rol="OR idmedicamentos LIKE '%22%' ";
	}
	elseif ($busqueda == 'genoprazol ') 
	{
		$rol="OR idmedicamentos LIKE '%24%' ";
	}
	elseif ($busqueda == 'ranitidida ') 
	{
		$rol="OR idmedicamentos LIKE '%25%' ";
	}

	$paginador=mysqli_query($conn, "SELECT COUNT(*) as total FROM `historial/recurso` hr INNER JOIN pacientes p ON p.idpacientes=hr.idpaciente WHERE(
idhistorialrecurso LIKE '%$busqueda%' OR
idpaciente LIKE '%$busqueda%' OR
p.matricula LIKE '%$busqueda%' OR
fecha LIKE '%$busqueda%' OR
hora LIKE '%$busqueda%' OR
causa LIKE '%$busqueda%' OR
cantidadusadamedicina LIKE '%$busqueda%' OR
cantidadusada LIKE '%$busqueda%'
$rol
) ");
	$paginador_res= mysqli_fetch_array($paginador);
	return $paginador_res;
}
function buscar_historial_recurso ($conn,$busqueda,$desde,$num_pag)
{
	$query=mysqli_query($conn, "SELECT 
    hr.idhistorialrecurso,
    hr.idpaciente,
    hr.fecha,
    hr.hora,
    hr.causa,
    hr.idrecurso,
    hr.cantidadusada,
    hr.idmedicamentos,
    hr.cantidadusadamedicina,
    p.matricula,
    m.medicamentosnombre,
    r.nombrerecurso
FROM
    `historial/recurso` hr
    	inner JOIN
    pacientes p ON idpacientes = hr.idpaciente
    left join
    medicamentos m ON m.idmedicamentos=hr.idmedicamentos
    left join
    recursos r ON r.idrecurso=hr.idrecurso  WHERE (
hr.idhistorialrecurso LIKE '%$busqueda%' OR
p.matricula LIKE '%$busqueda%' OR
hr.fecha LIKE '%$busqueda%' OR
hr.hora LIKE '%$busqueda%' OR
hr.causa LIKE '%$busqueda%' OR
hr.cantidadusada LIKE '%$busqueda%' OR
hr.cantidadusadamedicina LIKE '%$busqueda%' OR
m.medicamentosnombre LIKE '%$busqueda%' OR
r.nombrerecurso LIKE '%$busqueda%'
) ORDER BY hr.idhistorialrecurso LIMIT $desde,$num_pag");
	$resultado =mysqli_num_rows($query);
	return $resultado;
}

function buscar_historial_recurso2($conn,$busqueda,$desde,$num_pag)
{
	$query=mysqli_query($conn, "SELECT 
    hr.idhistorialrecurso,
    hr.idpaciente,
    hr.fecha,
    hr.hora,
    hr.causa,
    hr.idrecurso,
    hr.cantidadusada,
    hr.idmedicamentos,
    hr.cantidadusadamedicina,
    p.matricula,
    m.medicamentosnombre,
    r.nombrerecurso
FROM
    `historial/recurso` hr
    	inner JOIN
    pacientes p ON idpacientes = hr.idpaciente
    left join
    medicamentos m ON m.idmedicamentos=hr.idmedicamentos
    left join
    recursos r ON r.idrecurso=hr.idrecurso  WHERE (
hr.idhistorialrecurso LIKE '%$busqueda%' OR
p.matricula LIKE '%$busqueda%' OR
hr.fecha LIKE '%$busqueda%' OR
hr.hora LIKE '%$busqueda%' OR
hr.causa LIKE '%$busqueda%' OR
hr.cantidadusada LIKE '%$busqueda%' OR
hr.cantidadusadamedicina LIKE '%$busqueda%' OR
m.medicamentosnombre LIKE '%$busqueda%' OR
r.nombrerecurso LIKE '%$busqueda%'
) ORDER BY hr.idhistorialrecurso LIMIT $desde,$num_pag");
	return $query;
}

function paginador_buscar_paciente($conn,$busqueda)
{
	$paginador=mysqli_query($conn, "SELECT 
    COUNT(*) AS total
FROM
    pacientes
WHERE
(
idpacientes LIKE '%$busqueda%' OR
nombre LIKE '%$busqueda%' OR
apellidopaterno LIKE '%$busqueda%' OR
apellidomaterno LIKE '%$busqueda%' OR
edad LIKE '%$busqueda%' OR
correo LIKE '%$busqueda%' OR
sexo LIKE '%$busqueda%' OR
matricula LIKE '%$busqueda%'
)
AND estatus = 1");

	$paginador_res= mysqli_fetch_array($paginador);
	return  $paginador_res;
}

function buscar_paciente($conn,$busqueda,$desde,$num_pag)
{
	$query=mysqli_query($conn, "SELECT * FROM `pacientes` WHERE (
idpacientes LIKE '%$busqueda%' OR
nombre LIKE '%$busqueda%' OR
apellidopaterno LIKE '%$busqueda%' OR
apellidomaterno LIKE '%$busqueda%' OR
edad LIKE '%$busqueda%' OR
correo LIKE '%$busqueda%' OR
sexo LIKE '%$busqueda%' OR
matricula LIKE '%$busqueda%'
)
AND	estatus = 1 LIMIT $desde,$num_pag");
	$resultado =mysqli_num_rows($query);
	return $resultado;
}

function buscar_paciente2($conn,$busqueda,$desde,$num_pag)
{
	$query=mysqli_query($conn, "SELECT * FROM `pacientes` WHERE (
idpacientes LIKE '%$busqueda%' OR
nombre LIKE '%$busqueda%' OR
apellidopaterno LIKE '%$busqueda%' OR
apellidomaterno LIKE '%$busqueda%' OR
edad LIKE '%$busqueda%' OR
correo LIKE '%$busqueda%' OR
sexo LIKE '%$busqueda%' OR
matricula LIKE '%$busqueda%'
)
AND	estatus = 1 LIMIT $desde,$num_pag");
	return $query;
}

function paginador_buscar_recurso($conn,$busqueda)
{
	$paginador=mysqli_query($conn, "SELECT COUNT(*) as total FROM recursos WHERE(
idrecurso LIKE '%$busqueda%' OR
nombrerecurso LIKE '%$busqueda%' OR
descripcionrecurso LIKE '%$busqueda%' OR
cantidadtotal LIKE '%$busqueda%' 
)");
	$paginador_res= mysqli_fetch_array($paginador);
	return$paginador_res;
}

function paginador_buscar_medicina($conn,$busqueda)
{
	$paginador=mysqli_query($conn, "SELECT COUNT(*) as total FROM medicamentos WHERE(
idmedicamentos LIKE '%$busqueda%' OR
medicamentosnombre LIKE '%$busqueda%' OR
presentacion LIKE '%$busqueda%' OR
cantidadtot LIKE '%$busqueda%' 
)");
	$paginador_res= mysqli_fetch_array($paginador);
	return$paginador_res;
}

function buscar_recurso($conn,$busqueda,$desde,$num_pag)
{
	$query=mysqli_query($conn, "SELECT * FROM recursos WHERE(
idrecurso LIKE '%$busqueda%' OR
nombrerecurso LIKE '%$busqueda%' OR
descripcionrecurso LIKE '%$busqueda%' OR
cantidadtotal LIKE '%$busqueda%' 
) ORDER BY idrecurso LIMIT $desde,$num_pag");
	$resultado =mysqli_num_rows($query);
	return $resultado;
}

function buscar_medicina($conn,$busqueda,$desde,$num_pag)
{
	$query=mysqli_query($conn, "SELECT * FROM medicamentos WHERE(
idmedicamentos LIKE '%$busqueda%' OR
medicamentosnombre LIKE '%$busqueda%' OR
presentacion LIKE '%$busqueda%' OR
cantidadtot LIKE '%$busqueda%' 
) ORDER BY idmedicamentos LIMIT $desde,$num_pag");
	$resultado =mysqli_num_rows($query);
	return $resultado;
}

function buscar_recurso2($conn,$busqueda,$desde,$num_pag)
{
	$query=mysqli_query($conn, "SELECT * FROM recursos WHERE(
idrecurso LIKE '%$busqueda%' OR
nombrerecurso LIKE '%$busqueda%' OR
descripcionrecurso LIKE '%$busqueda%' OR
cantidadtotal LIKE '%$busqueda%' 
) ORDER BY idrecurso LIMIT $desde,$num_pag");
	return $query;
}

function buscar_medicina2($conn,$busqueda,$desde,$num_pag)
{
	$query=mysqli_query($conn, "SELECT * FROM medicamentos WHERE(
idmedicamentos LIKE '%$busqueda%' OR
medicamentosnombre LIKE '%$busqueda%' OR
presentacion LIKE '%$busqueda%' OR
cantidadtot LIKE '%$busqueda%' 
) ORDER BY idmedicamentos LIMIT $desde,$num_pag");
	return $query;
}

function vista_receta($conn,$id)
{
	$my= mysqli_query($conn,"SELECT 
    h.idhistorial,
    l.idlogin as No_Eco_Medico,
    d.nombre as Nombre_Medico,
    d.apellidopaterno as Paterno, 
    p.nombre,
    p.matricula,
    p.edad,
    p.sexo,
    p.apellidopaterno,
    p.apellidomaterno,
    h.fecha,
    h.hora,
    h.tratamiento,
    c.nombrecausa,
    c.descripcion,
    m.idmedicamentos,
    GROUP_CONCAT(DISTINCT m.medicamentosnombre) AS medicina,
    r.idrecurso,
    GROUP_CONCAT(DISTINCT r.nombrerecurso) AS recurso    
FROM
    historial h
	left JOIN
    historial_med hm on h.idhistorial=hm.idhistorial
    left join
    medicamentos m ON m.idmedicamentos = hm.idmedicamentos
    inner join
    pacientes p on p.idpacientes=h.idpaciente
    inner  join 
    doctores d on d.iddoctores=h.iddoc and h.idhistorial=$id
    inner  join 
    login l on l.id=d.idlogin
    inner  join 
    causa c on c.idcausa=h.idcausa 
    AND h.estatus = 1
    left  join 
    historial_rec hr on hr.idhistorial=h.idhistorial
    left  join 
    recursos r on r.idrecurso=hr.idrecurso
	GROUP BY 1
     ORDER BY h.idhistorial");
	$resul_my= mysqli_num_rows($my);
	return $resul_my;
}

function vista_receta2($conn,$id)
{
	$my= mysqli_query($conn,"SELECT 
    h.idhistorial,
    l.idlogin as No_Eco_Medico,
    d.nombre as Nombre_Medico,
    d.apellidopaterno as Paterno, 
    p.nombre,
    p.matricula,
    p.edad,
    p.sexo,
    p.apellidopaterno,
    p.apellidomaterno,
    h.fecha,
    h.hora,
    h.tratamiento,
    c.nombrecausa,
    c.descripcion,
    m.idmedicamentos,
    GROUP_CONCAT(DISTINCT m.medicamentosnombre) AS medicina,
    r.idrecurso,
    GROUP_CONCAT(DISTINCT r.nombrerecurso) AS recurso    
FROM
    historial h
	left JOIN
    historial_med hm on h.idhistorial=hm.idhistorial
    left join
    medicamentos m ON m.idmedicamentos = hm.idmedicamentos
    inner join
    pacientes p on p.idpacientes=h.idpaciente
    inner  join 
    doctores d on d.iddoctores=h.iddoc and h.idhistorial=$id
    inner  join 
    login l on l.id=d.idlogin
    inner  join 
    causa c on c.idcausa=h.idcausa 
    AND h.estatus = 1
    left  join 
    historial_rec hr on hr.idhistorial=h.idhistorial
    left  join 
    recursos r on r.idrecurso=hr.idrecurso
	GROUP BY 1
     ORDER BY h.idhistorial");
	return $my;
}

function receta_pdf($conn,$id)
{
	$my= mysqli_query($conn,"SELECT 
    h.idhistorial,
    l.idlogin as No_Eco_Medico,
    d.nombre as Nombre_Medico,
    d.apellidopaterno as Paterno, 
    p.nombre,
    p.matricula,
    p.edad,
    p.sexo,
    p.apellidopaterno,
    p.apellidomaterno,
    h.fecha,
    h.hora,
    h.tratamiento,
    c.nombrecausa,
    c.descripcion,
    m.idmedicamentos,
    GROUP_CONCAT(DISTINCT m.medicamentosnombre) AS medicina,
    r.idrecurso,
    GROUP_CONCAT(DISTINCT r.nombrerecurso) AS recurso    
FROM
    historial h
	left JOIN
    historial_med hm on h.idhistorial=hm.idhistorial
    left join
    medicamentos m ON m.idmedicamentos = hm.idmedicamentos
    inner join
    pacientes p on p.idpacientes=h.idpaciente
    inner  join 
    doctores d on d.iddoctores=h.iddoc and h.idhistorial=$id
    inner  join 
    login l on l.id=d.idlogin
    inner  join 
    causa c on c.idcausa=h.idcausa 
    AND h.estatus = 1
    left  join 
    historial_rec hr on hr.idhistorial=h.idhistorial
    left  join 
    recursos r on r.idrecurso=hr.idrecurso
	GROUP BY 1
     ORDER BY h.idhistorial");
$resul_my= mysqli_num_rows($my);
return $resul_my;
}

function receta_pdf2($conn,$id)
{
	$my= mysqli_query($conn,"SELECT 
    h.idhistorial,
    l.idlogin as No_Eco_Medico,
    d.nombre as Nombre_Medico,
    d.apellidopaterno as Paterno, 
    p.nombre,
    p.matricula,
    p.edad,
    p.sexo,
    p.apellidopaterno,
    p.apellidomaterno,
    h.fecha,
    h.hora,
    h.tratamiento,
    c.nombrecausa,
    c.descripcion,
    m.idmedicamentos,
    GROUP_CONCAT(DISTINCT m.medicamentosnombre) AS medicina,
    r.idrecurso,
    GROUP_CONCAT(DISTINCT r.nombrerecurso) AS recurso    
FROM
    historial h
	left JOIN
    historial_med hm on h.idhistorial=hm.idhistorial
    left join
    medicamentos m ON m.idmedicamentos = hm.idmedicamentos
    inner join
    pacientes p on p.idpacientes=h.idpaciente
    inner  join 
    doctores d on d.iddoctores=h.iddoc and h.idhistorial=$id
    inner  join 
    login l on l.id=d.idlogin
    inner  join 
    causa c on c.idcausa=h.idcausa 
    AND h.estatus = 1
    left  join 
    historial_rec hr on hr.idhistorial=h.idhistorial
    left  join 
    recursos r on r.idrecurso=hr.idrecurso
	GROUP BY 1
     ORDER BY h.idhistorial");
return $my;
}

function vista_receta_pase ($conn,$id)
{
	$my= mysqli_query($conn,"SELECT 
    hr.idhistorialrecurso,
    hr.idpaciente,
    hr.fecha,
    hr.hora,
    hr.causa,
    hr.idrecurso,
    hr.cantidadusada,
    hr.idmedicamentos,
    hr.cantidadusadamedicina,
    m.medicamentosnombre,
    r.idrecurso,
    r.nombrerecurso,
    p.nombre,
    p.apellidopaterno,
    p.apellidomaterno,
    p.edad,
    p.sexo,
    p.matricula,
    p.estatus
FROM
    `historial/recurso` hr
        INNER JOIN
    pacientes p ON idpacientes = hr.idpaciente AND idhistorialrecurso =$id
    left join
    medicamentos m ON m.idmedicamentos=hr.idmedicamentos AND idhistorialrecurso =$id
    left join
    recursos r ON r.idrecurso=hr.idrecurso AND idhistorialrecurso =$id");
$resul_my= mysqli_num_rows($my);
return $resul_my;
}

function vista_receta_pase2 ($conn,$id)
{
	$my= mysqli_query($conn,"SELECT 
    hr.idhistorialrecurso,
    hr.idpaciente,
    hr.fecha,
    hr.hora,
    hr.causa,
    hr.idrecurso,
    hr.cantidadusada,
    hr.idmedicamentos,
    hr.cantidadusadamedicina,
    m.medicamentosnombre,
    r.idrecurso,
    r.nombrerecurso,
    p.nombre,
    p.apellidopaterno,
    p.apellidomaterno,
    p.edad,
    p.sexo,
    p.matricula,
    p.estatus
FROM
    `historial/recurso` hr
        INNER JOIN
    pacientes p ON idpacientes = hr.idpaciente AND idhistorialrecurso =$id
    left join
    medicamentos m ON m.idmedicamentos=hr.idmedicamentos AND idhistorialrecurso =$id
    left join
    recursos r ON r.idrecurso=hr.idrecurso AND idhistorialrecurso =$id");
return $my;
}

function receta_recurso_pdf($conn,$id)
{
	$my= mysqli_query($conn,"SELECT 
    hr.idhistorialrecurso,
    hr.idpaciente,
    hr.fecha,
    hr.hora,
    hr.causa,
    hr.idrecurso,
    hr.cantidadusada,
    hr.idmedicamentos,
    hr.cantidadusadamedicina,
    m.medicamentosnombre,
    r.idrecurso,
    r.nombrerecurso,
    p.nombre,
    p.apellidopaterno,
    p.apellidomaterno,
    p.edad,
    p.sexo,
    p.matricula,
    p.estatus
FROM
    `historial/recurso` hr
        INNER JOIN
    pacientes p ON idpacientes = hr.idpaciente AND idhistorialrecurso =$id
    left join
    medicamentos m ON m.idmedicamentos=hr.idmedicamentos AND idhistorialrecurso =$id
    left join
    recursos r ON r.idrecurso=hr.idrecurso AND idhistorialrecurso =$id");
$resul_my= mysqli_num_rows($my);
return $resul_my;
}

function receta_recurso_pdf2($conn,$id)
{
	$my= mysqli_query($conn,"SELECT 
    hr.idhistorialrecurso,
    hr.idpaciente,
    hr.fecha,
    hr.hora,
    hr.causa,
    hr.idrecurso,
    hr.cantidadusada,
    hr.idmedicamentos,
    hr.cantidadusadamedicina,
    m.medicamentosnombre,
    r.idrecurso,
    r.nombrerecurso,
    p.nombre,
    p.apellidopaterno,
    p.apellidomaterno,
    p.edad,
    p.sexo,
    p.matricula,
    p.estatus
FROM
    `historial/recurso` hr
        INNER JOIN
    pacientes p ON idpacientes = hr.idpaciente AND idhistorialrecurso =$id
    left join
    medicamentos m ON m.idmedicamentos=hr.idmedicamentos AND idhistorialrecurso =$id
    left join
    recursos r ON r.idrecurso=hr.idrecurso AND idhistorialrecurso =$id");
return $my;
}

?>