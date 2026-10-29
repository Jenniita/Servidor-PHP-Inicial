<?php
session_start();

function protegerSesion(): void
{
    if (!isset($_SESSION['usuario'])) {
        header('Location: ejra45.php');
        exit;
    }
}

function protegerAdmin(): void
{
    protegerSesion();

    if (($_SESSION['rol'] ?? '') !== 'admin') {
        http_response_code(403);
        exit('Acceso solo para administradores.');
    }
}
