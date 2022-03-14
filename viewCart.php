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
                    <th>Producto</th><th>Cantidad</th>
                </tr>
            </thead>
            <?php 
                $fp = fopen('Abdiel/Abdiel.txt','r');

                if (!$fp){echo 'ERROR: No ha sido posible abrir el archivo. Revisa su nombre y sus permisos.'; exit;};
                $lines = file('Abdiel/Abdiel.txt');
                $lineas = count($lines);
                $loop = 0; // contador de líneas
                while ($loop<$lineas) { // loop hasta que se llegue al final del archivo
                    $loop++;
                    $line = fgets($fp);
                    $field[$loop] = explode ('    ', $line);
                    $fp;  
                    echo ' <tr>
                            <td>'.$field[$loop][0].'</td><td>'.$field[$loop][1].'</td>
                        </tr>';
                } 
                fclose($fp);?>
        </table>
    </div>
</body>
</html>