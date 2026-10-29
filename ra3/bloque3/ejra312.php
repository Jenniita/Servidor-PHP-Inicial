<?php
$libros = ['El principito', 'Don Quijote de la Mancha', 'Invisible', 'Matilda', 'El Hobbit'];
$busqueda = $_GET['busqueda'] ?? '';
$busqueda = is_string($busqueda) ? $busqueda : '';
?>
<h1>Ejercicio 12 — Catálogo en PHP</h1>
<form method="get">
    <input name="busqueda" placeholder="Buscar libro">
    <button>Buscar</button>
</form>
<?php foreach ($libros as $libro): ?>
    <?php if (stripos($libro, $busqueda) !== false): ?>
        <p><?= htmlspecialchars($libro, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>
<?php endforeach; ?>
<p>PHP usa foreach y $_GET para recoger la búsqueda.</p>
