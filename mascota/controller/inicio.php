<?php
require_once("../db/connection.php");
session_start();
if($_POST["inicio"]){
	// inicia sesion para los usuarios
	$usuario = $_POST["usuario"];
	$clave = $_POST["clave"];
	
	
	/// consultamos el usuario segun el usuario y la clave
	$con="select * from usuario where ALIAS_USU = '$usuario' and PASSWD_USU = '$clave'"; 	
	$query=mysqli_query($mysqli, $con);
	$fila=mysqli_fetch_assoc($query);
	
	if($fila){		
		/// si el usario y la clave son correctas, creamo las sessiones S
			
		$_SESSION['id_user'] = $fila['IDENT_USU']; 
		$_SESSION['nombres'] = $fila['PNOMBRE_USU']; 
		$_SESSION['tipo'] = $fila['ID_TUSU'];
		$_SESSION['usuario'] = $fila['ALIAS_USU'];
		
				/// dependiendo del tipo de usuario lo redireccinamos a una pagina
		/// si es un administrador
		if($_SESSION['tipo'] == 1){
			header("Location: ../model/admin/index1.php"); 
			exit();
		}
		/// si es un Veterinario
		elseif($_SESSION['tipo'] == 2){
			header("Location: ../model/veterinario/index1.php"); 
			exit();		
		}
		/// si es un Duenio
		elseif($_SESSION['tipo'] == 3){
			header("Location: ../model/duenio/index1.php"); 
			exit();		
		}
		
		
	}else{
		/// si el usuario y la clave son incorrectas lo lleva a la pagina de inio y se muestra un mensaje
		header("Location: ../errorlog.html"); 
		exit();
	}
	
}	
?>