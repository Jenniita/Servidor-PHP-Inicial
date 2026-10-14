<?php
$libros = [
    ["titulo" => "El principito", "precio" => 18.50, "precioIva" => 18.50 * 1.21, "disponibilidad" => true],
    ["titulo" => "Un Monstruo viene a verme", "precio" => 20.50, "precioIva" => 20.50 * 1.21, "disponibilidad" => false],
    ["titulo" => "Invisible", "precio" => 12.90, "precioIva" => 12.90 * 1.21, "disponibilidad" => true]
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
    <h2>El catálogo a mano</h2>
    <?php foreach ($libros as $libro): ?>
        <p>Nombre del libro: <?= $libro["titulo"] ?></p>
        <p>El precio del libro sin IVA: <?= $libro["precio"] ?></p>
        <p>El precio del libro con IVA: <?= $libro["precioIva"] ?></p>
        <p>Disponibilidad del libro: <?= $libro["disponibilidad"] ? "Disponible" : "No disponible" ?></p>
    <?php endforeach; ?>
</body>

</html>