# Servidor PHP con Docker

Este proyecto crea un servidor web sencillo con PHP y Apache dentro de un
contenedor Docker. Al acceder desde el navegador, el servidor muestra el texto
`Hola mundito con PHP`.

## 1. Requisitos previos

Es necesario tener instalado y ejecutándose **Docker Desktop**, que incluye
Docker Engine y Docker Compose.

Para comprobar que Docker está disponible, abre una terminal y ejecuta:

```bash
docker --version
docker compose version
```

- `docker --version` muestra la versión instalada de Docker.
- `docker compose version` comprueba que está disponible Docker Compose, la
  herramienta que permite definir y ejecutar servicios desde un archivo YAML.

## 2. Estructura del proyecto

```text
Prueba_php_jenna/
├── Dockerfile
├── docker-compose.yml
├── index.php
└── docs/
		└── readme.md
```

- `index.php`: contiene el código PHP que ejecuta el servidor.
- `Dockerfile`: indica cómo construir la imagen del servidor.
- `docker-compose.yml`: configura el servicio y la conexión de puertos.
- `docs/readme.md`: contiene esta documentación.

## 3. Crear la página PHP

El archivo `index.php` contiene:

```php
<?php

echo "Hola mundito con PHP";
```

La instrucción `echo` envía ese texto como respuesta HTTP cuando se solicita la
página.

## 4. Crear la imagen del servidor

El `Dockerfile` define la imagen que se utilizará:

```dockerfile
FROM php:8.3-apache

COPY index.php /var/www/html/index.php

EXPOSE 80
```

- `FROM php:8.3-apache` utiliza una imagen oficial con PHP 8.3 y Apache ya
  preparados para funcionar juntos.
- `COPY index.php /var/www/html/index.php` copia la página PHP al directorio
  público que Apache sirve por defecto.
- `EXPOSE 80` documenta que Apache escucha en el puerto 80 dentro del
  contenedor.

## 5. Configurar el servicio con Docker Compose

El archivo `docker-compose.yml` contiene:

```yaml
services:
	php:
		build: .
		ports:
      - "8081:80"
```

- `services` define los servicios del proyecto.
- `php` es el nombre del servicio.
- `build: .` indica que la imagen se debe construir usando el `Dockerfile` de
  la carpeta actual.
- `ports: "8081:80"` conecta el puerto `8081` del equipo con el puerto `80`
  del contenedor. Por eso se accede mediante `localhost:8081`.

## 6. Usar el servidor

Ejecuta los comandos desde la carpeta raíz del proyecto, donde se encuentran
`Dockerfile` y `docker-compose.yml`.

### Iniciar

La primera vez en cada ordenador, o después de cambiar `Dockerfile` o
`index.php`, construye la imagen y arranca el servidor en segundo plano:

```powershell
docker compose up -d --build
```

El `Dockerfile` copia `index.php` dentro de la imagen. Por eso los cambios en
ese archivo requieren reconstruirla. En los siguientes arranques en el mismo
ordenador, si no has cambiado esos archivos, basta con:

```powershell
docker compose up -d
```

### Comprobar y abrir

Comprueba que el contenedor está activo:

```powershell
docker compose ps
```

Abre [http://localhost:8081](http://localhost:8081) en el navegador. Para
consultar los registros si algo no funciona, ejecuta `docker compose logs`; con
`docker compose logs -f` se actualizan en tiempo real. Pulsa `Ctrl+C` para
dejar de seguirlos; eso no detiene el servidor.

También puedes comprobar la respuesta desde PowerShell:

```powershell
curl http://localhost:8081
```

### Detener

Para detener y eliminar el contenedor, conservando los archivos del proyecto y
la imagen:

```powershell
docker compose down
```

## 7. Diferencias frente a un servidor Node.js

Esta parte compara este proyecto PHP con un servidor Node.js sencillo ejecutado
directamente en el ordenador. Este repositorio no incluye una aplicación Node;
los nombres de archivo y el puerto de Node dependen del proyecto que se use.

| Situación | PHP de este proyecto | Node.js habitual, fuera de Docker |
| --- | --- | --- |
| Primera vez en un ordenador | `docker compose up -d --build` construye la imagen y arranca Apache con PHP. | `npm install` instala las dependencias del proyecto; luego se inicia el servidor. |
| Iniciar de nuevo sin cambios | `docker compose up -d` arranca el contenedor usando la imagen existente. | `npm start` inicia la aplicación, si `package.json` define ese script. |
| Cambiar el código | Ejecuta `docker compose up -d --build`: `index.php` se copia dentro de la imagen y hay que reconstruirla. | Si se ejecuta con `node server.js`, detén el proceso con `Ctrl+C` y vuelve a iniciarlo. `node --watch server.js` reinicia el proceso al detectar cambios, en versiones compatibles de Node.js. |
| Cambiar dependencias | No hay dependencias PHP instaladas con Composer en este proyecto. | Ejecuta `npm install` cuando cambien las dependencias declaradas en `package.json`. |
| Abrir en el navegador | `http://localhost:8081` (puerto del ordenador conectado al puerto 80 del contenedor). | La dirección depende del puerto elegido por la aplicación; un ejemplo común es `http://localhost:3000`. |
| Detener | `docker compose down`. | Pulsa `Ctrl+C` en la terminal donde está ejecutándose el servidor. |

En Node.js, si `package.json` no tiene un script `start`, se puede iniciar el
archivo principal directamente, por ejemplo con `node server.js`. El comando
`npm install` no hace falta en cada arranque: se usa al preparar el proyecto en
un ordenador o cuando cambian sus dependencias.

Si la aplicación Node también se ejecuta dentro de Docker y su `Dockerfile`
copia el código a la imagen, se aplica la misma regla que en este servidor PHP:
usa `docker compose up -d --build` la primera vez y después de cambiar los
archivos copiados; usa `docker compose up -d` para arrancarla de nuevo sin
cambios. Un montaje de archivos del ordenador dentro del contenedor puede
permitir ver cambios sin reconstruir la imagen, pero depende de la
configuración del proyecto.

## 8. Cómo funciona una petición

Al abrir la página en el navegador, la petición sigue este recorrido:

1. El navegador solicita `localhost:8081` al propio ordenador.
2. Docker Compose redirige el puerto `8081` del ordenador al puerto `80` del
  contenedor, según la regla `8081:80`.
3. Apache busca `index.php` en `/var/www/html` y lo ejecuta con PHP.
4. PHP genera la respuesta y Apache la devuelve al navegador.

El texto de la página lo genera el código PHP; no está escrito directamente
en el navegador.

## 9. Trabajar en clase y en casa

Si se usa cloudDrive para trasladar el proyecto, sincroniza la carpeta completa
conservando su estructura, incluidos `Dockerfile`, `docker-compose.yml` e
`index.php`. Espera a que la sincronización termine antes de abrir los archivos
en el otro ordenador.

En cada ordenador se necesita Docker Desktop. Una vez descargado el proyecto,
abre PowerShell en la carpeta que contiene `docker-compose.yml` y sigue la
sección [Usar el servidor](#6-usar-el-servidor). Cada ordenador tiene su propia
imagen Docker: hay que construirla la primera vez en ese equipo y volver a
construirla si cambian los archivos copiados a la imagen.

## 10. Usar Git para sincronizar el proyecto

### Qué es Git y para qué sirve

Git es un sistema de control de versiones. Guarda un historial de los cambios
realizados en los archivos del proyecto y permite volver a una versión anterior
si algo deja de funcionar. También permite trabajar desde varios ordenadores
sin depender de copiar manualmente todos los archivos.

Git guarda el historial de forma local en una carpeta oculta llamada `.git`.
Por eso Git es muy útil para guardar y organizar el proyecto, pero por sí solo
no es una copia de seguridad externa: si se estropea el ordenador, también se
podría perder la carpeta `.git`.

Lo recomendable es combinar:

- **Git local** para crear versiones y consultar el historial.
- **GitHub, GitLab o un servidor Git remoto** para guardar una copia online y
   poder descargar el proyecto desde otro ordenador.

Para este objetivo, Git es mejor que depender exclusivamente de cloudDrive,
siempre que el repositorio remoto se actualice con `push`. No es necesario
guardar las imagenes ni los contenedores Docker: se guardan los archivos del
proyecto y Docker los vuelve a construir usando el `Dockerfile`.

### Comprobar si Git está instalado

En PowerShell se puede comprobar con:

```powershell
git --version
```

Si aparece una versión, Git está instalado.

Para comprobar si una carpeta ya es un repositorio Git:

```powershell
git status
```

Si aparece `not a git repository`, Git esta instalado, pero todavia no se ha
inicializado esa carpeta.

### Crear un repositorio nuevo

Se recomienda trabajar en una carpeta local, por ejemplo
`C:\Users\jenna\Documents\Proyectos`, y no depender de que cloudDrive tenga
todos los archivos disponibles sin conexión. Ejecuta estos comandos solo si
la carpeta aún no es un repositorio Git:

```powershell
cd "C:\ruta\hasta\Prueba_php_jenna"
git config --global user.name "Tu nombre"
git config --global user.email "tu-correo@example.com"
git init
git add .
git commit -m "Estado inicial del proyecto"
git status
```

Estos comandos hacen lo siguiente:

1. `git init` convierte la carpeta en un repositorio Git.
2. `git add .` prepara los archivos actuales para guardarlos.
3. `git commit` crea una version permanente del proyecto con un mensaje.
4. `git status` muestra si quedan cambios pendientes.

La configuración de `user.name` y `user.email` solo suele ser necesaria la
primera vez que se utiliza Git en el ordenador.

### Guardar cambios durante el trabajo

Antes de empezar a trabajar en un ordenador que ya tiene el repositorio,
descarga los cambios que se hayan subido desde otro ordenador:

```powershell
git pull origin main
```

Después de modificar los archivos, guarda y sube los cambios desde la carpeta
principal del proyecto:

```powershell
git status
git add .
git commit -m "Describe el cambio realizado"
git push origin main
```

`git add .` prepara los archivos modificados, nuevos o eliminados. El commit
guarda un punto en el historial; créalo cuando haya cambios preparados.
`git push origin main` sube el commit a GitHub.

### Si Git rechaza un `push`

Normalmente significa que el remoto contiene cambios que aún no están en el
ordenador. Ejecuta `git pull origin main`, resuelve cualquier conflicto que
Git indique y después vuelve a guardar y subir los cambios. No uses
`git push --force`, porque puede sobrescribir cambios remotos.

### Vincular un repositorio nuevo a GitHub o GitLab

Primero se crea un repositorio vacío en GitHub, GitLab u otro servidor Git.
Después se enlaza con el repositorio local y se sube la primera versión. Este
paso se realiza una sola vez y se omite si el repositorio ya tiene configurado
un remoto llamado `origin`:

```powershell
git remote add origin https://github.com/USUARIO/Prueba_php_jenna.git
git branch -M main
git push -u origin main
```

Hay que sustituir la URL por la del repositorio remoto real. El primer `push`
puede pedir iniciar sesión o utilizar un token, según el servicio elegido.

### Clonar el repositorio en otro ordenador

Para descargar el repositorio en otro ordenador por primera vez, ejecuta:

```powershell
git clone https://github.com/Jenniita/Servidor-PHP-Inicial.git
cd Servidor-PHP-Inicial
```

Después, sigue la sección [Usar el servidor](#6-usar-el-servidor) para
arrancarlo. En los siguientes días, ejecuta `git pull origin main` antes de
trabajar y sigue el flujo de guardado de esta sección al terminar.
