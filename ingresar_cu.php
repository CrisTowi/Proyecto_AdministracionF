<!DOCTYPE html>
<html>
<head lang='es'>
	<meta charset='utf-8'>
	<title></title>

</head>
<body>

	<form method='POST' action='agregarCuenta.php'>
		<p>Id de la Cuenta</p>
		<input type='text' style= 'width:210px;' name='idCuenta' id='idCuenta' placeholder='Introduce el código de la cuenta'>
		<p>Nombre de la Cuenta</p>
		<input type='text' style= 'width:210px;' name='nombre' id='nombre' placeholder='Descripción de la cuenta'>
		<p>Tipo de Cuenta</p>
		<?php
            include("php/DataConnection.class.php");
            $db = new DataConnection();
            $result = $db->executeQuery("SELECT * FROM tipocuenta");
            $name = "tipocuenta";
            
            echo "<select style= 'width:210px;' id='".$name."' name='".$name."'>";
            echo "<option value=''>---------</option>";
            while( $dato = mysql_fetch_assoc($result) ){
                echo "<option value='".$dato["idTipoCuenta"]."'>".$dato["Nombre"]."</option>";
            }
            echo "</select>";
        ?>
    	</br>
    	</br>
		<input type='submit' id='botonAgr' value='Agregar'>
	</form>

</body>
</html>