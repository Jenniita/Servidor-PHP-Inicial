<?php
session_start();

if (!isset($_SESSION['bolsa'])) {
    $_SESSION['bolsa'] = [];
}

if (isset($_POST['libro']) && $_POST['libro'] !== '') {
    $_SESSION['bolsa'][] = $_POST['libro'];
}
?>
<h1>Ejercicio 4</h1>

<form method="post">
    <select name="libro">
        <option>El principito</option>
        <option>Don Quijote de la Mancha</option>
        <option>Invisible</option>
    </select>
    <button>Añadir a la bolsa</button>
</form>

<h2>Bolsa de préstamos</h2>
<ul>
    <?php foreach ($_SESSION['bolsa'] as $libro): ?>
        <li><?= htmlspecialchars($libro, ENT_QUOTES, 'UTF-8') ?></li>
    <?php endforeach; ?>
</ul>
