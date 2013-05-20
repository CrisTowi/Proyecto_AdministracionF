<?php 
	include("php/Cuentas.class.php");

	$nombre = $_POST['nombre'];
	unset($_POST['nombre']);
	$descripcion = $_POST['descripcion']; 
	unset($_POST['descripcion']);
	$fecha = $_POST['fecha'];
	unset($_POST['fecha']);

	Cuentas::AgregarPoliza($nombre, $descripcion, $fecha, $_POST);

	header( 'Location: ingresar_po.php' ) ;
?>