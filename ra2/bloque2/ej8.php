<?php
$libro1 = [
    "titulo" => "El principito",
    "precioBase" => 18.50,
    "disponibilidad" => true,
    "precioIva" => 18.50 * 1.21
];

$libro2 = [
    "titulo" => "Un Monstruo viene a verme",
    "precioBase" => 20.50,
    "disponibilidad" => false,
    "precioIva" => 20.50 * 1.21
];

$libro3 = [
    "titulo" => "Invisible",
    "precioBase" => 12.90,
    "disponibilidad" => true,
    "precioIva" => 12.90 * 1.21
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Ejercicio 8 en PHP Bloque 2</h1>
    <h2>Catálogo a mano</h2>

    <div>
        <h3>Libro 1</h3>
        <div>
            <p>Nombre del libro:
                <?= $libro1["titulo"] ?>
            </p>
            <p>El precio del libro sin IVA:
                <?= $libro1["precioBase"] ?>
            </p>
            <p>El precio del libro con IVA
                <?= $libro1["precioIva"] ?>
            </p>
            <p>Disponibilidad del libro:
                <?= $libro1["disponibilidad"] ? "Disponible" : "No disponible" ?>
            </p>
        </div>

    </div>

    <div>
        <h3>Libro 2</h3>
        <div>
            <p>Nombre del libro:
                <?= $libro2["titulo"] ?>
            </p>
            <p>El precio del libro sin IVA:
                <?= $libro2["precioBase"] ?>
            </p>
            <p>El precio del libro con IVA
                <?= $libro2["precioIva"] ?>
            </p>
            <p>Disponibilidad del libro:
                <?= $libro2["disponibilidad"] ? "Disponible" : "No disponible" ?>
            </p>
        </div>
    </div>
    <div>
        <h3>Libro 3</h3>
        <div>
            <p>Nombre del libro:
                <?= $libro3["titulo"] ?>
            </p>
            <p>El precio del libro sin IVA:
                <?= $libro3["precioBase"] ?>
            </p>
            <p>El precio del libro con IVA
                <?= $libro3["precioIva"] ?>
            </p>
            <p>Disponibilidad del libro:
                <?= $libro3["disponibilidad"] ? "Disponible" : "No disponible" ?>
            </p>
        </div>
    </div>


</body>

</html>