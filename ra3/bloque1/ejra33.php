<?php
$libros = [
    ['titulo' => 'El principito', 'precio' => 18.50, 'disponible' => true],
    ['titulo' => 'Un monstruo viene a verme', 'precio' => 20.50, 'disponible' => false],
    ['titulo' => 'Invisible', 'precio' => 12.90, 'disponible' => true],
    ['titulo' => 'Matilda', 'precio' => 15.00, 'disponible' => true],
    ['titulo' => 'El Hobbit', 'precio' => 22.00, 'disponible' => false]
];
?>
<h1>Ejercicio 3</h1>
<?php foreach ($libros as $libro): ?>
    <p><?= $libro['titulo'] ?>: <?= $libro['disponible'] ? 'Disponible' : 'Agotado' ?></p>
<?php endforeach; ?>
