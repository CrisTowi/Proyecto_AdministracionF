<!DOCTYPE html>
<html>
    <head lang='es'>
        <meta charset='utf-8'>
        <link rel="stylesheet" href="css/jquery-ui.css" />
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/jquery-ui.js"></script>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

        <script>
            $(function()
            {
                $('#fecha').datepicker();
                $('#fecha').datepicker('option', {dateFormat: 'yy/mm/dd'});
            });
            function showForm()
            {
                var parametros="";
                var tam = document.getElementById('num').innerHTML;
                var i;
                for(i=0; i<tam; i++)
                {
                    if($("#option"+i).is(":checked")) {
                        parametros = parametros+"option"+i+"="+document.getElementById('option'+i).value+"&";
                    }
                }

                parametros = parametros.slice(0, -1);

                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                }
                else
                {// code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                
                xmlhttp.onreadystatechange=function()
                {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200)
                        {
                        document.getElementById("Contenedor").innerHTML = xmlhttp.responseText;
                        }
                }

                //for()
                xmlhttp.open("GET","getForm.php?"+parametros,true);
                
                xmlhttp.send();
                
            }   
        </script>
        <title>Ingresar Subcuenta</title>

    </head>
    <body>

        <form method='POST' action='agregarPoliza.php'>
            <p>Nombre de la Poliza: </p>
            <input type='text' name='nombre' style= 'width:210px;' id='nombre'  placeholder='Nombre'>
            <p>Descripción: </p>
            <textarea rows='10' cols='20' name='descripcion' style='resize: none;'>

            </textarea>
            <p>Fecha: </p>
            <input type='text' id='fecha' name='fecha' style= 'width:210px;'>
            <br>
            <br>       
            <?php
                include("php/DataConnection.class.php");
                $i =0;
                $db = new DataConnection();

                echo "<p>Cuentas de Activo</p>";
                $result = $db->executeQuery("SELECT s.nombre as Nombre, c.nombre as Cuenta, s.idSubcuenta FROM subcuenta s, cuenta c WHERE s.idCuenta=c.idCuenta AND idTipoCuenta = 1000");
                $name = "cuenta";

                while( $dato = mysql_fetch_assoc($result) ){
                    echo "<input type='checkbox' id='option".$i."' value='".$dato["idSubcuenta"]."'> ".$dato["Nombre"]."<br>";
                    $i++;
                }
                echo "<p>Cuentas de Pasivo</p>";
                $result = $db->executeQuery("SELECT s.nombre as Nombre, c.nombre as Cuenta, s.idSubcuenta FROM subcuenta s, cuenta c WHERE s.idCuenta=c.idCuenta AND idTipoCuenta = 2000");
                $name = "cuenta";

                while( $dato = mysql_fetch_assoc($result) ){
                    echo "<input type='checkbox' id='option".$i."' value='".$dato["idSubcuenta"]."'> ".$dato["Nombre"]."<br>";
                    $i++;
                }
                echo "<p>Cuentas de Captial Contable</p>";
                $result = $db->executeQuery("SELECT s.nombre as Nombre, c.nombre as Cuenta, s.idSubcuenta FROM subcuenta s, cuenta c WHERE s.idCuenta=c.idCuenta AND idTipoCuenta = 3000");
                $name = "cuenta";

                while( $dato = mysql_fetch_assoc($result) ){
                    echo "<input type='checkbox' id='option".$i."' value='".$dato["idSubcuenta"]."'> ".$dato["Nombre"]."<br>";
                    $i++;
                }

                echo "<p id='num'>".$i."</p>";
                echo "Cuentas";
            ?>
            <br>
            <input type="button" value="Aceptar" class='btn btn-primary' onclick='showForm();'>
            <div id='Contenedor'>

            </div>

            <br>
            <br>
            <input type='submit' id='botonAgr' class='btn btn-success' value='Agregar'>
        </form>
    </body>
</html>