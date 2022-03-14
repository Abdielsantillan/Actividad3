<?php
    $NombreProducto = $_POST["Producto"];
    $Cantidad = $_POST['Cantidad'];
    $Nombre = $_POST['Nombre'];
    $NombreArchivo = $Nombre.".txt";
    $txt = $NombreProducto."    ".$Cantidad;
    $archivo = fopen($Nombre."/".$NombreArchivo,'a+');
    fwrite($archivo,$txt.PHP_EOL); 
    fclose($archivo);  
?>