<?php
$metodo = $_SERVER['REQUEST_METHOD'];
$valor = $metodo === 'POST' ? ($_POST['libro'] ?? '') : ($_GET['libro'] ?? '');
$valor = is_string($valor) ? $valor : '';
?>
<h1>Ejercicio 11 — GET y POST</h1>

<form method="get">
    <input name="libro" placeholder="Libro" required>
    <button>Enviar con GET</button>
</form>

<form method="post">
    <input name="libro" placeholder="Libro" required>
    <button>Enviar con POST</button>
</form>

<?php if ($valor !== ''): ?>
    <p>Recibido con <?= htmlspecialchars($metodo) ?>: <?= htmlspecialchars($valor) ?></p>
<?php endif; ?>

<p>GET muestra el dato en la URL y conviene para búsquedas. POST no lo muestra en la URL y conviene para enviar formularios.</p>
