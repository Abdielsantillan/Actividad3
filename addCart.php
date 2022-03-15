<?php
    $NombreProducto = $_POST["Producto"];
    $Cantidad = $_POST['Cantidad'];
    $Total = $_POST['CostoT'];
    $Nombre = $_POST['Nombre'];
    $NombreArchivo = $Nombre.".txt";
    $txt = $NombreProducto."    ".$Cantidad."    ". $Total;
    $archivo = fopen($Nombre."/".$NombreArchivo,'a+');
    fwrite($archivo,$txt.PHP_EOL); 
    fclose($archivo);  
?>