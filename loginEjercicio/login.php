<?php
  session_start();

  // Usuarios en memoria. La clave se guarda HASHEADA, nunca en texto plano.
  // (El hash se generaria una vez con password_hash("1234", PASSWORD_DEFAULT))
  $usuarios = [
    "ana" => '$2y$10$abcd...hashdeejemplo...'
  ];

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST["usuario"] ?? "";
    $clave   = $_POST["clave"] ?? "";

    // ¿Existe el usuario Y su contrasena coincide con el hash guardado?
    if (isset($usuarios[$usuario]) && password_verify($clave, $usuarios[$usuario])) {
      $_SESSION["usuario"] = $usuario;   // abrir sesion
      header("Location: perfil.php");
      exit;
    } else {
      $error = "Usuario o contrasena incorrectos";
    }
  }
?>
<form method="POST">
  <input type="text" name="usuario" placeholder="Usuario">
  <input type="password" name="clave" placeholder="Contrasena">
  <button>Entrar</button>
</form>
<?php if (isset($error)) echo "<p>" . htmlspecialchars($error) . "</p>"; ?>