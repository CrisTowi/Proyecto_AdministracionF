<!DOCTYPE html>
<html>
<head lang='es'>
    <meta charset='utf-8'>
    <title>Ingresar Subcuenta</title>

</head>
<body>

    <form method='POST' action='agregarSubcuenta.php'>
        <p>Id de la Subcuenta</p>
        <input type='text' name='idSubcuenta' style= 'width:160px;' id='idSubcuenta'  placeholder='Código de la subcuenta'>
        <p>Nombre de la Subcuenta</p>
        <input type='text' name='nombre' style= 'width:160px;' id='nombre' placeholder='Nombre de la subucuenta'>

        <p>Tipo de Cuenta</p>
        <?php
            include("php/DataConnection.class.php");
            $db = new DataConnection();
            $result = $db->executeQuery("SELECT * FROM cuenta");
            $name = "cuenta";
            
            echo "<select  style= 'width:160px;' id='".$name."' name='".$name."'>";
            echo "<option value=''>---------</option>";
            while( $dato = mysql_fetch_assoc($result) ){
                echo "<option value='".$dato["idCuenta"]."'>".$dato["Nombre"]."</option>";
            }
            echo "</select>";
        ?>
        </br>
        </br>
        <input type='submit' id='botonAgr' value='Agregar'>
    </form>

</body>
</html>