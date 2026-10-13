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
    <h1>Ejercicio 5 con PHP del RA2, Bloque 1</h1>
    <h2>Frase con datos</h2>
    <p>El libro <?= $tituloLibro?> cuesta <?= $precioConIva?> con IVA</p>
</body>
</html>