<?php
require_once __DIR__ . '/middleware.php';
protegerSesion();

$bolsa = $_SESSION['bolsa'] ?? [];
?>
<h1>Ejercicio 7 — Mi bolsa</h1>
<ul>
    <?php foreach ($bolsa as $libro): ?>
        <li><?= htmlspecialchars($libro, ENT_QUOTES, 'UTF-8') ?></li>
    <?php endforeach; ?>
</ul>
