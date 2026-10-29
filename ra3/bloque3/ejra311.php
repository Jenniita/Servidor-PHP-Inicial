<?php
$metodo = $_SERVER['REQUEST_METHOD'];
$libro = $metodo === 'POST' ? ($_POST['libro'] ?? '') : ($_GET['libro'] ?? '');
$libro = is_string($libro) ? $libro : '';
?>
<h1>Ejercicio 11 — GET y POST</h1>
<form method="get">
    <input name="libro" placeholder="Buscar libro">
    <button>Buscar con GET</button>
</form>
<form method="post">
    <input name="libro" placeholder="Buscar libro">
    <button>Buscar con POST</button>
</form>
<?php if ($libro !== ''): ?>
    <p>Recibido con <?= htmlspecialchars($metodo) ?>: <?= htmlspecialchars($libro, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>
<p>GET muestra el dato en la URL y sirve para búsquedas. POST envía el dato en el cuerpo y sirve para enviar datos que no deben aparecer en la URL.</p>
