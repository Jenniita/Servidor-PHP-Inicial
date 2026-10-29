<?php
function puedePrestarse($usuario, $libro)
{
    if (!$usuario) {
        return false;
    }

    if (!$usuario['activo']) {
        return false;
    }

    if (!$libro['disponible']) {
        return false;
    }

    return true;
}

$usuario = ['activo' => true];
$libro = ['disponible' => true];
?>
<h1>Ejercicio 2</h1>
<p><?= puedePrestarse($usuario, $libro) ? 'Puede prestarse' : 'No puede prestarse' ?></p>
