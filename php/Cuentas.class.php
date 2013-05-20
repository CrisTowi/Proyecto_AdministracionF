<?php 

	include("DataConnection.class.php");
	
	class Cuentas{
		private $idCUenta;
		private $descripcion;
		private $cargo;
		private $abono;

		public function __construct($idCuenta, $descripcion, $cargo, $abono)
		{

			$this->idCUenta = $idCUenta;
			$this->descripcion = $descripcion;
			$this->cargo = $cargo;
			$this->abono = $abono;
		}
		public static function getidCuenta()
		{

			return $this->idCuenta;
		}

		public static function getDescripcion()
		{

			return $this->descripcion;
		}

		public static function getCargo()
		{

			return $this->cargo;
		}

		public static function getAbono()
		{

			return $this->abono;
		}
		public static function AgregarCuenta($idCuenta, $nombre, $tipocuenta)
		{
			$db = new DataConnection();
			$qry = "INSERT INTO cuenta(idCuenta, nombre, idTipoCUenta) VALUES(".$idCuenta.", '".$nombre."', ".$tipocuenta.")";
			if($result = $db->executeQuery($qry))
			{
				return true;
			}
			else
			{
				return false;
			}

		}
		public static function AgregarSubcuenta($idSubcuenta, $nombre, $idCuenta)
		{
			$db = new DataConnection();
			$qry = "INSERT INTO subcuenta(idSubcuenta, nombre, idCuenta, Cargo, Abono) VALUES(".$idSubcuenta.", '".$nombre."', ".$idCuenta.", 0, 0)";
			if($result = $db->executeQuery($qry))
			{
				return true;
			}
			else
			{
				return false;
			}

		}
		public static function AgregarPoliza($nombre, $descripcion, $fecha, $arreglo)
		{
			$db = new DataConnection();

			$qry = "INSERT INTO poliza(nombre, descripcion, fecha) VALUES('".$nombre."', '".$descripcion."', '".$fecha."')";
			$result = $db->executeQuery($qry);

			$qry = "SELECT * FROM poliza";
			$result = $db->executeQuery($qry);

			while($fila = mysql_fetch_array($result))
			{
				$idpoliza = $fila['idPoliza'];
			}
			$i = 0;
			foreach ($arreglo as $key => $value)
			{
				if($i == 0)
				{
					$qry = "INSERT INTO cuenta_poliza(idSubcuenta, idPoliza, Abono, Cargo) VALUES(".substr($key,1).", ".$idpoliza.", 0, ".$value.")";
					$result = $db->executeQuery($qry);
					$qry = "UPDATE subcuenta set Cargo = Cargo + ".$value." where idSubcuenta = ".substr($key,1);
					$result = $db->executeQuery($qry);
					$i = 1;
				}
				elseif ($i == 1) 
				{
					$qry = "SELECT * FROM cuenta_poliza";
					$result = $db->executeQuery($qry);

					while($fila = mysql_fetch_array($result))
					{
						$idcp = $fila['idCuenta_Poliza'];
					}

					$qry = "UPDATE cuenta_poliza SET Abono = ".$value." WHERE idCuenta_Poliza = ".$idcp;
					$result = $db->executeQuery($qry);
					$qry = "UPDATE subcuenta set Abono = Abono + ".$value." where idSubcuenta = ".substr($key,1);
					$result = $db->executeQuery($qry);

					$i= 0;
				}
			}
		}
	}
?>