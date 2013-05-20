<?php 

foreach ($_GET as $key => $value)
{
	echo "Id: $value:   ";
	echo "<input type=text class='cargo' name='"."c"."$value' placeholder='Cargo'> <input type=text class='abono' name='"."a"."$value' placeholder='Abono'> <br>";
}

?>