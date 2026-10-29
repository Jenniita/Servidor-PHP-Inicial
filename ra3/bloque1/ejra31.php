<?php
$libro = ['disponible' => true, 'oferta' => true];

if ($libro['disponible'] && $libro['oferta']) {
    $estado = '¡En oferta!';
} elseif ($libro['disponible']) {
    $estado = 'Disponible';
} else {
    $estado = 'Agotado';
}
?>
<h1>Ejercicio 1</h1>
<p><?= $estado ?></p>
