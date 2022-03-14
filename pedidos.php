<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Document</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<?php   
        session_start();
        $Nombre = $_POST['nombre'];
        $_SESSION["nombre"] = $Nombre;
        $my_dir =str_replace(' ', '', $Nombre);
        if(!is_dir($my_dir)){
            mkdir($my_dir);
        }       
?>
<body class="pantalla_Principal">   
   <div class="Contenedor_Principal">
        <div class="usuario">
            <form  method="post">
                <div class="contenedorC">
                    <h2 class="titulo">Bienvenido: <?php echo $_SESSION['nombre'];?></h2>
                    <select name="Productos" class="Lista" id="producto">
                        <p>Seleccione un producto
                    <option value="none" selected="selected">---- seleccione el producto ---</option>
                    <?php 
                        $fp = fopen('almacen.txt','r');
                        if(!$fp){echo 'ERROR: No ha sido posible abrir el archivo. Revisa su nombre y sus permisos.';exit;};
                        $lines = file('almacen.txt');
                        $lineas = count($lines);
                        
                        $loop = 0;//contador de líneas
                        while ($loop<$lineas) {//loop hasta que se llegue al final del archivo
                            $loop++;
                            $line = fgets($fp);
                            $field[$loop] = explode (',', $line);
                            $precio[]= $field[$loop][2]; 
                            $id = 0;
                            echo '<option  value="'.$field[$loop][0].'">'.$field[$loop][0].'</option>';
                            $id++;
                        }
                        fclose($fp);?>
                        </p></select>
                        <input type="number" id="cantidad" class="input" name="cantidad"  placeholder="Ingresa la cantidad de productos a comprar" value=""/>
                </div>
            </form>
            <input type="submit" name="Entrar" class="boton2" onclick="EnviarDatos()" value="Enviar"> 
        </div> 
    </div>                   
</body>
<script>
    function EnviarDatos(){
        //valores a optener
        var cod = document.getElementById("producto").value;
        var cantidad =  document.getElementById("cantidad").value;
        var precio = <?php echo $precio[2];?> ;
        console.log(precio);
        //Enviar parametros
        var select = document.getElementById("producto"); /*Obtener el SELECT */
        var valor = select.options[select .selectedIndex].value;
        alert(valor);
        var nombre = "<?php echo $Nombre;?>";
        var parametros = {"Producto":cod,"Cantidad":cantidad,"Nombre":nombre};
        $.ajax({
            data:parametros,
            url:'addCart.php',
            type: 'post',
            beforeSend: function () {
                $("#resultado").html("Procesando, espere por favor");
            },
            success: function (response) {   
                $("#resultado").html(response);
            }
        });
            /* Para obtener el texto 
            var combo = document.getElementById("producto");
            var selected = combo.options[combo.selectedIndex].text;
            alert(selected);*/
        }
</script>
</script>
</html>