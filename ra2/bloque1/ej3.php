<?php $tituloLibro = "El Principito" ?>
<?php $precioLibro = 10.90 ?>
<?php $disponibilidadLibro = true ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ejercicio 3 en PHP  del RA2 Bloque 1</h1>
    <h2>Declaración de variables</h2>
    <h3>1.Texto</h3>
    <p>Título del libro <?= $tituloLibro?></p>
    <h3>2.Precio</h3>
    <p>Precio del libro <?= $precioLibro ?></p>
    <h3>3. Disponibilidad</h3>
    <p>La disponibilidad del libro es <?= $disponibilidadLibro ? "Disponible" : "No disponible" ?></p>

    
    
</body>
</html>