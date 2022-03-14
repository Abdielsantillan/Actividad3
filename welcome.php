<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Document</title>
</head>
<body class="pantalla_Principal"> 
<div class="Contenedor_Principal">
	<div class="contenedor_secundario">
		<h2 class="titulo">Ingrese su nombre</h2>
		<form action="pedidos.php" method="POST" >
            <div class="FormContenedor">
                <input type="text" class="input" name="nombre" placeholder="Nombre" value=""/>
            </div>
            <input type="submit" name="Entrar" class="boton" value="Enviar">
        </form>
</div> 
</body>
</html>