<?php
$libros = [
    ['titulo' => 'El principito', 'disponible' => true],
    ['titulo' => 'Un monstruo viene a verme', 'disponible' => false],
    ['titulo' => 'Invisible', 'disponible' => true],
    ['titulo' => 'Matilda', 'disponible' => true],
    ['titulo' => 'El Hobbit', 'disponible' => false]
];

$disponibles = 0;
foreach ($libros as $libro) {
    if ($libro['disponible']) {
        $disponibles++;
    }
}
?>
<h1>Ejercicio 4</h1>
<p><?= $disponibles ?> de <?= count($libros) ?> disponibles</p>
