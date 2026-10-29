<?php
$libros = [
    ['titulo' => 'El principito', 'precio' => 18.50, 'disponible' => true, 'oferta' => true],
    ['titulo' => 'Un monstruo viene a verme', 'precio' => 20.50, 'disponible' => false, 'oferta' => false],
    ['titulo' => 'Invisible', 'precio' => 12.90, 'disponible' => true, 'oferta' => false],
    ['titulo' => 'Matilda', 'precio' => 15.00, 'disponible' => true, 'oferta' => false],
    ['titulo' => 'El Hobbit', 'precio' => 22.00, 'disponible' => false, 'oferta' => false]
];

// Calcula el precio del libro con el 21 % de IVA.
function precioConIva($libro)
{
    return $libro['precio'] * 1.21;
}

// Devuelve el estado del libro según disponibilidad y oferta.
function estadoLibro($libro)
{
    if ($libro['disponible'] && $libro['oferta']) {
        return '¡En oferta!';
    } elseif ($libro['disponible']) {
        return 'Disponible';
    } else {
        return 'Agotado';
    }
}
?>
<h1>Ejercicio 5</h1>
<?php foreach ($libros as $libro): ?>
    <p>
        <?= $libro['titulo'] ?> —
        <?= number_format(precioConIva($libro), 2) ?> € —
        <?= estadoLibro($libro) ?>
    </p>
<?php endforeach; ?>
