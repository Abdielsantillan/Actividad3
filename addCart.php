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
    //Creamos la variabl txt que es la que contendra la informacion del archivo
    $txt = $NombreProducto."    ".$Cantidad."    ". $Total;
    //se crea el archivo si no existe ademas se le otorgan los permisos necesarios
    
    $condicion = true;
    $ruta = ($Nombre.'/'.$NombreArchivo);
    $ValorA = file($ruta,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); // lo carga a un vector
   
    //print_r($lineas);
    if(empty($ValorA)){
        $abrir = fopen($Nombre."/".$NombreArchivo,'a');
        fwrite($abrir,$txt.PHP_EOL); 
        fclose($abrir);
       
    }else{
        foreach($ValorA as $n => $l){
            // recorre el vector pareseando las líneas
            $ll = explode('    ', $l);
           
            if($ll[0] == $NombreProducto){
                // si encuentra la línea, modifica
                $ll[1] = $ll[1] + $Cantidad;
                $ll[2] = $ll[2] + $Total;
                // rearma la cadena
                $tmp = implode('    ', $ll);
                // la asigna al vector en la posición orginal
                $ValorA[$n] = $tmp;
                // sale del foreach, porque no tiene sentido seguir buscando.
                // print_r($n);
                $condicion = false ;
                break;
            }
        }
        if ($condicion == true){
            array_push($ValorA, $txt);
        }
        $contenido = implode(PHP_EOL,$ValorA);
        $abrir = fopen($Nombre."/".$NombreArchivo,'w');
        fwrite($abrir,$contenido); 
        fclose($abrir); 

    }
    
    // leer archivo json
    $datos = file_get_contents('almacen.json');
    $abrir = fopen('almacen.json','w');
    if (flock(  $abrir, LOCK_EX)) {  // adquirir un bloqueo exclusivo
        ftruncate(  $abrir, 0);      // truncar el fichero
        fwrite(  $abrir, "Escribir algo aquí\n");
        fflush(  $abrir);            // volcar la salida antes de liberar el bloqueo
        flock(  $abrir, LOCK_UN);    // libera el bloqueo
        echo "¡Sin problema!";
    }else {
        echo "¡No se pudo obtener el bloqueo!";
    }
    //variable para editar la cantidad del json
    $CantidadActual =  $TProductos-$Cantidad;
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