<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="estilos.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="main-container">
        <table>
            <thead>
                <tr>
                    <th>Producto</th><th>Cantidad</th><th>Precio</th><th> Agregar o Quitar</th>
                </tr>
            </thead>
            <?php 
                session_start();
                $_SESSION["nombre"];
                $Nombre=$_SESSION["nombre"];
                date_default_timezone_set('America/Mexico_City');
                $now = date('d.m.y');
                $archivo = $Nombre.$now.'.txt';
                $fp = fopen($Nombre.'/'.$archivo,'r');
                if (!$fp){echo 'ERROR: No ha sido posible abrir el archivo. Revisa su nombre y sus permisos.'; exit;};
                $lines = file( $Nombre.'/'.$archivo);
                $pagar =0;
                $lineas = count($lines);
                $loop = 0; // contador de líneas
                while ($loop<$lineas) { // loop hasta que se llegue al final del archivo
                    $loop++;
                    $line = fgets($fp);
                    $field[$loop] = explode ('    ', $line);
                    $fp;  
                    echo ' <tr>
                                <td>'.$field[$loop][0].'</td>
                                <td><input id="'.$loop.'"type="text" value="'.$field[$loop][1].'" readonly></td>
                                <td><input id="'.$loop.'"type="text" value="'.$field[$loop][2].'" readonly></td>
                                <td><button onclick="EliminarProducto('.$loop.')" id="'.$loop.'">-</button>
                                    <button onclick="AgregarProducto('.$loop.')" id="'.$loop.'">+</button>
                                    
                                </td>
                            </tr>';
                    $pagar = $pagar + $field[$loop][2];
                 }fclose($fp);?>
                <tr>
                    <td colspan="3">
                        <button class="boton2" onclick="location.href='pedidos.php'">Regresar</button>
                        <button class="boton2" onclick="guardarCambios(<?php echo $loop?>)">Guardar</button>
                    </td>
                    <td>
                        <p>Total a pagar: <?php echo  $pagar;?></p>
                    </td>
                </tr>
            
        </table>
    </div>
</body>
<script type="text/javascript">
    //Funcion que nos permite restar elementos de nuestro carrito
    function EliminarProducto(id){
        elemento = document.getElementById(id);
        valor = elemento.value;
        if(valor > 0){
            valor = valor-1;
            elemento.value =valor;
        }
    }
    function AgregarProducto(id){
        elemento = document.getElementById(id);
        valor = elemento.value;        
        valor = parseInt(valor)+1;
        elemento.value =valor;    
    }

</script>
</html>
