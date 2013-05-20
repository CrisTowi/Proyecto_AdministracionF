<?php 
	include("php/Cuentas.class.php"); 
	$idCuenta = $_POST['idCuenta'];
	$nombre = $_POST['nombre'];
	$tipocuenta = $_POST['tipocuenta'];

	Cuentas::AgregarCuenta($idCuenta, $nombre, $tipocuenta);

	header( 'Location: ingresar_cu.php' ) ;
?>