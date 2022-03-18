<?php
    //Variables que viene por el metodo del post 
    $NombreProducto = $_POST["Producto"];
    $TProductos = $_POST['TProductos'];
    $Cantidad = $_POST['Cantidad'];
    $Total = $_POST['CostoT'];
    $Nombre = $_POST['Nombre'];
    date_default_timezone_set('America/Mexico_City');
    $now = date('d.m.y');

    //Creamos el formato para crear el archivo txt con el nombre del usuaio y la fecha actual 
    $NombreArchivo = $Nombre.$now.".txt";
    $txt = $NombreProducto."    ".$Cantidad."    ". $Total;
    $archivo = fopen($Nombre."/".$NombreArchivo,'a+');
    $CantidadActual =  $TProductos-$Cantidad;
    //Abrimos el archivo 
    fwrite($archivo,$txt.PHP_EOL); 
    fclose($archivo);  

    // leer archivo json
    $datos = file_get_contents('almacen.json');

    // decodificar json a matriz
    $json_arr = json_decode($datos, true);

    foreach ($json_arr as $clave => $valor) {
        if ($valor['Producto'] == $NombreProducto) {
            $json_arr[$clave]['Cantidad'] = $CantidadActual;
        }
    }

    // codifica la matriz en json y guarda en el archivo
    file_put_contents('almacen.json', json_encode($json_arr));
    
?>
<script>
    window.location.reload();
</script>