<?php $tituloLibro = "El Principito" ?>
<?php $precioLibro = 10.90 ?>
<?php $disponibilidadLibro = true ?>
<?php $precioConIva = $precioLibro * 1.21 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Ejercicio 11 en PHP del Bloque 3</h1>
    <h2>La ficha de un libro</h2>
    <p>Nombre del libro: <?= $tituloLibro ?></p>
    <p>El precio del libro sin IVA: <?=$precioLibro ?></p>
    <p>El precio del libro con IVA <?=$precioConIva?></p>
    <p>Disponibilidad del libro: <?=$disponibilidadLibro ? "Disponible" : "No disponible" ?> </p>
    
</body>
</html>