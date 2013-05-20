<?php 
	include("php/Cuentas.class.php"); 
	$idSubcuenta = $_POST['idSubcuenta'];
	$nombre = $_POST['nombre'];
	$cuenta = $_POST['cuenta'];

	Cuentas::AgregarSubcuenta($idSubcuenta, $nombre, $cuenta);

	header( 'Location: ingresar_sub.php' ) ;
?>