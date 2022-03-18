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
                    <th>Producto</th><th>Cantidad</th><th>Precio</th>
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
                            <td>'.$field[$loop][0].'</td><td>'.$field[$loop][1].'</td></td><td>$ '.$field[$loop][2].'</td>
                        </tr>';
                    $pagar = $pagar + $field[$loop][2];
                } 
                fclose($fp);?>
                <tr>
                    <td colspan="2">
                        <button class="boton2" onclick="location.href='pedidos.php'">Regresar</button>
                    </td>
                    <td>
                        <p>Total a pagar: <?php echo  $pagar;?></p>
                    </td>
                </tr>
        </table>
    </div>
</body>
</html>