<?php
session_start();

$usuarios = [
    'admin' => ['contrasena' => '1234', 'rol' => 'admin'],
    'usuario' => ['contrasena' => '1234', 'rol' => 'usuario']
];

$mensaje = '';

if (
    isset($_POST['usuario'], $_POST['contrasena'])
    && is_string($_POST['usuario'])
    && is_string($_POST['contrasena'])
) {
    $nombre = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    if (isset($usuarios[$nombre]) && $usuarios[$nombre]['contrasena'] === $contrasena) {
        $_SESSION['usuario'] = $nombre;
        $_SESSION['rol'] = $usuarios[$nombre]['rol'];
        $mensaje = 'Sesión iniciada como ' . htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
    } else {
        $mensaje = 'Usuario o contraseña incorrectos.';
    }
}
?>
<h1>Ejercicio 5 — Login</h1>
<form method="post">
    <input name="usuario" placeholder="Usuario" required>
    <input name="contrasena" type="password" placeholder="Contraseña" required>
    <button>Iniciar sesión</button>
</form>
<p><?= $mensaje ?></p>
<p>Usuarios de prueba: admin / 1234 y usuario / 1234.</p>
