<h1>Ejercicio 7 — Buscar con GET</h1>
<form>
    <input type="text" name="busqueda" placeholder="Título del libro">
    <button>Buscar</button>
</form>
<?php if (isset($_GET['busqueda']) && is_string($_GET['busqueda'])): ?>
    <p>Resultados para: <?= htmlspecialchars($_GET['busqueda'], ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>
