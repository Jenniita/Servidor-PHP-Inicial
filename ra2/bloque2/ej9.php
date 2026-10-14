<?php
$libro = [
    "titulo" => "El principito",
    "precioBase" => 18.50,
    "disponibilidad" => true
];

$iva = 0.21;

//Funcion para calcular el precio con IVA
function calcularPrecioIva($precioBase, $Porcentajeiva)
{

    $precioCalculado = round($precioBase * (1 + $Porcentajeiva), 2);

    return $precioCalculado;
}

$precioConIva = calcularPrecioIva($libro["precioBase"], $iva);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Ejercicio 9 en PHP Bloque 2</h1>
    <h2>Ámbito de variables</h2>
    <p>Nombre del libro: <?= $libro["titulo"] ?></p>
    <p>El precio del libro sin IVA: <?= $libro["precioBase"] ?></p>
    <p>El precio del libro con IVA <?= $precioConIva ?></p>
    <p>Disponibilidad del libro: <?= $libro["disponibilidad"] ? "Disponible" : "No disponible" ?> </p>
    <p>Prueba del error: <?=$precioCalculado ?></p>

</body>

</html>