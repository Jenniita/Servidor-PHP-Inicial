# Servidor-PHP-Inicial
Primer Proyecto Servidor PHP Entornos de Servidores

Consulta la documentación completa en [docs/readme.md](docs/readme.md).

## 9 de octubre de 2026 — RA2 ejercicios

Se ha empezado a organizar el contenido del RA2 en carpetas por bloque y ejercicio:

- `ra2/bloque1/ej1.php`: muestra el resultado de sumar 2 + 2.
- `ra2/bloque1/ej2.php`: mezcla HTML y PHP para mostrar el resultado de 5 + 5 y la hora actual de España. Se configura la zona horaria `Europe/Madrid`, que ajusta automáticamente el horario de verano e invierno.

También se ha configurado Docker para servir los ejercicios en Apache por el puerto `8081`. La carpeta local `ra2` se monta dentro del contenedor, así que, una vez iniciado con `docker compose up -d`, los nuevos archivos y cambios guardados en esa carpeta están disponibles sin reconstruir la imagen.

Por ejemplo, el ejercicio 2 se puede abrir en <http://localhost:8081/ra2/bloque1/ej2.php>.
