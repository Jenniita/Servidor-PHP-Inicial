<?php
session_start();
$_SESSION['visitas'] = ($_SESSION['visitas'] ?? 0) + 1;
?>
<h1>Ejercicio 3</h1>
<p>Has visitado esta página <?= $_SESSION['visitas'] ?> veces en esta sesión.</p>
