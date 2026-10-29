<?php
$libros = [
    ['titulo' => 'El principito', 'disponible' => true],
    ['titulo' => 'Don Quijote de la Mancha', 'disponible' => true],
    ['titulo' => 'Invisible', 'disponible' => true],
    ['titulo' => 'Matilda', 'disponible' => false],
    ['titulo' => 'El Hobbit', 'disponible' => false]
];
$busqueda = $_GET['busqueda'] ?? '';
$busqueda = is_string($busqueda) ? $busqueda : '';
$soloDisponibles = ($_GET['estado'] ?? '') === 'disponibles';
?>
<h1>Ejercicio 9 — Filtrar por disponibilidad</h1>
<form>
    <input type="text" name="busqueda" placeholder="Título del libro" value="<?= htmlspecialchars($busqueda, ENT_QUOTES, 'UTF-8') ?>">
    <select name="estado">
        <option value="">Todos los libros</option>
        <option value="disponibles" <?= $soloDisponibles ? 'selected' : '' ?>>Solo disponibles</option>
    </select>
    <button>Buscar</button>
</form>
<?php foreach ($libros as $libro): ?>
    <?php if (stripos($libro['titulo'], $busqueda) !== false && (!$soloDisponibles || $libro['disponible'])): ?>
        <p><?= htmlspecialchars($libro['titulo'], ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>
<?php endforeach; ?>
