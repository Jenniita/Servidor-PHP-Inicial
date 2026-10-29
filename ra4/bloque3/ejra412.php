<?php
$libros = ['El principito', 'Don Quijote de la Mancha', 'Invisible'];
$busqueda = $_GET['busqueda'] ?? '';
$busqueda = is_string($busqueda) ? $busqueda : '';
$resultados = array_filter(
    $libros,
    fn ($libro) => stripos($libro, $busqueda) !== false
);
?>
<h1>Ejercicio 12 — Catálogo en PHP</h1>
<form method="get">
    <input name="busqueda" placeholder="Buscar libro">
    <button>Buscar</button>
</form>
<ul>
    <?php foreach ($resultados as $libro): ?>
        <li><?= htmlspecialchars($libro) ?></li>
    <?php endforeach; ?>
</ul>
<p>En PHP se recorre el catálogo con foreach y se lee el formulario desde $_GET.</p>
