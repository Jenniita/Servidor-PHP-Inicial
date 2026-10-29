<?php
$libros = ['El principito', 'Don Quijote de la Mancha', 'Invisible', 'Matilda', 'El Hobbit'];
$busqueda = $_GET['busqueda'] ?? '';
$busqueda = is_string($busqueda) ? $busqueda : '';
$resultados = [];

foreach ($libros as $libro) {
    if (stripos($libro, $busqueda) !== false) {
        $resultados[] = $libro;
    }
}
?>
<h1>Ejercicio 8 — Buscar de verdad</h1>
<form>
    <input type="text" name="busqueda" placeholder="Título del libro">
    <button>Buscar</button>
</form>
<p>Resultados para: <?= htmlspecialchars($busqueda, ENT_QUOTES, 'UTF-8') ?></p>
<?php foreach ($resultados as $libro): ?>
    <p><?= htmlspecialchars($libro, ENT_QUOTES, 'UTF-8') ?></p>
<?php endforeach; ?>
