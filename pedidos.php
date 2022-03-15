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
                    <select name="Productos" class="Lista" id="producto" >
                        <p>Seleccione un producto
                        <option value="none" selected="selected">---- seleccione el producto ---</option>
                        </p></select>
                        <input type="number" id="cantidad" class="input" name="cantidad"  placeholder="Ingresa la cantidad de productos a comprar" value=""/>
                </div>
            </form>
            <input type="submit" name="Entrar" class="boton2" onclick="EnviarDatos()" value="Enviar"> 
        </div> 
    </div>                   
</body>
<script>
    var contenido = document.getElementById("producto");
    var nombre = "<?php echo $Nombre;?>";
    let p=[];
    fetch("/almacen.json")
        .then(response => {return response.json();})
        .then(jsondata => {
                let x = 0;
                for (let index = 0; index < jsondata.length; index++) {
                    p.push([jsondata[x].Producto , jsondata[x].Precio]);
                    contenido.innerHTML +=` <option  value="${x}"> ${jsondata[x].Producto} </option>`;
                    x++;
                };

            }
        );
    
    function EnviarDatos(){
        //Varibles para obtener los elementos
        var cantidad =  document.getElementById("cantidad").value;
        var id  = document.getElementById("producto").value;
        // variables que viene al seleccionar una option del select
        var elementos = p[id];
        var Producto = elementos[0];
        var Precio = elementos[1];

        console.log(Producto);
        //Aqui se envian los parametros al ajax
        var parametros = {"Producto":Producto,"Cantidad":cantidad,"Nombre":nombre};
        $.ajax({
            data:parametros,
            url:'addCart.php',
            type: 'post',
            beforeSend: function () {
                alert("Procesando, espere por favor");
            },
            success: function (response) {   
                alert("Se a agregado al carrito exito");
            }
        });
    }
        
</script>
</script>
</html>