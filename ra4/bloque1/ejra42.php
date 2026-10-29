<?php
if (isset($_POST['busqueda_cookie']) && $_POST['busqueda_cookie'] !== '') {
    // Guardar una cookie que dura 30 días. Debe ir antes del HTML.
    setcookie("busqueda", $_POST['busqueda_cookie'], time() + 60 * 60 * 24 * 30);
    header('Location: ejra42.php');
    exit;
}
?>
<h1>Ejercicio 2</h1>

<h2>Cookie</h2>
<p>
    <?php
    // En una petición posterior, leer la cookie.
    if (isset($_COOKIE["busqueda"])) {
        echo "Tu última búsqueda: " . htmlspecialchars($_COOKIE["busqueda"]);
    } else {
        echo "Todavía no tienes ninguna búsqueda guardada.";
    }
    ?>
</p>
<form method="post">
    <input name="busqueda_cookie" placeholder="Término de búsqueda" required>
    <button>Guardar cookie</button>
</form>

<h2>localStorage</h2>
<p id="busqueda_local">Tu última búsqueda: ninguna</p>
<input id="termino_local" placeholder="Término de búsqueda">
<button onclick="guardarBusqueda()">Guardar localStorage</button>

<p>La cookie llega al servidor. localStorage no.</p>
<p>localStorage sobrevive al cerrar la pestaña; una cookie persistente también, hasta que caduque.</p>

<script>
const termino = document.getElementById('termino_local');
const busquedaGuardada = localStorage.getItem('busqueda');
if (busquedaGuardada) {
    document.getElementById('busqueda_local').textContent = 'Tu última búsqueda: ' + busquedaGuardada;
    termino.value = busquedaGuardada;
}

function guardarBusqueda() {
    localStorage.setItem('busqueda', termino.value);
    document.getElementById('busqueda_local').textContent = 'Tu última búsqueda: ' + termino.value;
}
</script>
