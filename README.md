# Servidor-PHP-Inicial
Primer Proyecto Servidor PHP Entornos de Servidores

Consulta la documentación completa en [docs/readme.md](docs/readme.md).

## 9 de octubre de 2026 — RA2 ejercicios

Hoy he preparado el proyecto para organizar y ejecutar los ejercicios del RA2 con PHP y Docker. También he practicado cómo mezclar HTML y PHP, mostrar valores, usar variables y booleanos, calcular con operadores y configurar la hora local.

### Organización de los ejercicios

Los ejercicios están organizados por resultado de aprendizaje y bloque. El nombre `ra2/bloque1/ej3.php`, por ejemplo, indica que es el ejercicio 3 del bloque 1 del RA2.

En el momento de escribir estas notas, los ejercicios con contenido son:

- `ra2/bloque1/ej1.php`: muestra el resultado de `2 + 2`.
- `ra2/bloque1/ej2.php`: muestra `5 + 5` y la hora de España.
- `ra2/bloque1/ej3.php`: declara y muestra el título, el precio y la disponibilidad de un libro.
- `ra2/bloque1/ej4.php`: calcula y muestra el precio con IVA y la disponibilidad del libro.

La carpeta se puede ampliar creando archivos como `ra2/bloque1/ej5.php` o creando otro bloque, por ejemplo `ra2/bloque2/ej1.php`.

### Cómo abrir un ejercicio con Docker

El `Dockerfile` prepara PHP con Apache y copia los archivos del proyecto a la imagen. En `docker-compose.yml`, el puerto `8081` de tu ordenador se conecta al puerto `80` del servidor, y la carpeta local `ra2` se monta dentro del contenedor en `/var/www/html/ra2`.

1. Abre una terminal en la carpeta raíz del proyecto, donde está `docker-compose.yml`.
2. Inicia Docker Desktop y ejecuta:

   ```powershell
   docker compose up -d
   ```

   Esto inicia el servidor y aplica la configuración de Compose. Si el contenedor ya existía con una configuración anterior, Compose lo actualiza.
3. Abre el archivo en el navegador usando esta forma de dirección:

   ```text
   http://localhost:8081/ra2/bloque1/ej4.php
   ```

   Cambia `ej4.php` por el ejercicio que quieras ver.

Al guardar o crear archivos dentro de `ra2`, el montaje hace que Apache vea los cambios directamente; no hace falta reconstruir la imagen por cada ejercicio. Si Docker está parado, vuelve a iniciarlo con `docker compose up -d`. Para detener el servicio, ejecuta `docker compose down` desde la raíz del proyecto.

### Variables y tipos básicos

En PHP, una variable empieza por `$` y se crea asignándole un valor. No hace falta declarar el tipo por adelantado:

```php
$tituloLibro = "El Principito"; // texto
$precioLibro = 10.90;           // número
$disponible = true;             // booleano: true o false
```

Para insertar el valor de una variable en el HTML se puede usar `<?= ... ?>`. Es una forma abreviada de imprimir un valor; por ejemplo:

```php
<p>Título: <?= $tituloLibro ?></p>
```

Al imprimir un booleano directamente, `true` se representa como `1` y `false` no muestra texto. Para mostrar una etiqueta comprensible se puede usar el operador ternario:

```php
<?= $disponible ? "Disponible" : "No disponible" ?>
```

La expresión comprueba `$disponible`: si es verdadero, muestra `"Disponible"`; si es falso, muestra `"No disponible"`.

### Operadores: sumar y calcular el IVA

PHP puede hacer operaciones directamente, como `2 + 2`. Para añadir un 21 % de IVA al precio, se multiplica el precio original por `1.21` y se guarda el resultado en otra variable:

```php
$precioConIva = $precioLibro * 1.21;
```

Después se muestra `$precioConIva` en el HTML. Con un precio original de `10.90`, el resultado matemático es `13.189`; se puede mostrar con dos decimales si se necesita formato de moneda.

### Mostrar la hora de España

PHP toma la zona horaria del servidor, que puede no coincidir con la de España. Para indicar la zona peninsular y obtener la hora en formato de 24 horas, se usan:

```php
date_default_timezone_set('Europe/Madrid');
echo date("H:i");
```

La zona `Europe/Madrid` ajusta automáticamente la hora de verano e invierno.

Por ejemplo, el ejercicio 2 se puede abrir en <http://localhost:8081/ra2/bloque1/ej2.php>.
