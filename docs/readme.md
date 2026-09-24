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
			- "8080:80"
```

- `services` define los servicios del proyecto.
- `php` es el nombre del servicio.
- `build: .` indica que la imagen se debe construir usando el `Dockerfile` de
  la carpeta actual.
- `ports: "8080:80"` conecta el puerto `8080` del equipo con el puerto `80`
  del contenedor. Por eso se accede mediante `localhost:8080`.

## 6. Construir y arrancar el servidor

Desde la carpeta raíz del proyecto, donde están `Dockerfile` y
`docker-compose.yml`, ejecuta:

```bash
docker compose up --build
```

Este comando hace lo siguiente:

1. Lee la configuración de `docker-compose.yml`.
2. Construye la imagen a partir del `Dockerfile`.
3. Copia `index.php` dentro de la imagen.
4. Crea y arranca el contenedor.
5. Publica Apache en el puerto `8080` del equipo.

La opción `--build` fuerza la reconstrucción de la imagen. Es útil después de
cambiar el `Dockerfile` o `index.php` para asegurarse de que el contenedor usa
la versión actualizada.

## 7. Probar la aplicación

Con el contenedor en ejecución, abre esta dirección en el navegador:

[http://localhost:8080](http://localhost:8080)

La respuesta mostrada será:

```text
Hola mundito con PHP
```

También se puede probar desde una terminal con:

```bash
curl http://localhost:8080
```

`curl` realiza una petición HTTP y muestra en la terminal la respuesta del
servidor.

## 8. Consultar el estado y los registros

Para ver los contenedores del proyecto y comprobar si están activos:

```bash
docker compose ps
```

Para consultar los mensajes generados por Apache y el contenedor:

```bash
docker compose logs
```

Para seguir los registros en tiempo real:

```bash
docker compose logs -f
```

La opción `-f` significa _follow_ y mantiene abierta la salida para mostrar
nuevos mensajes.

## 9. Detener el servidor

Si `docker compose up` está ejecutándose en primer plano, se puede pulsar
`Ctrl+C`. También se puede detener desde otra terminal con:

```bash
docker compose down
```

Este comando detiene y elimina los contenedores creados por Docker Compose,
pero no borra los archivos del proyecto ni el código fuente.

## 10. Comandos principales

| Comando                        | Función                                                       |
| ------------------------------ | ------------------------------------------------------------- |
| `docker compose up --build`    | Construye la imagen y arranca el servidor.                    |
| `docker compose up -d --build` | Arranca el servidor en segundo plano y reconstruye la imagen. |
| `docker compose ps`            | Muestra el estado de los servicios.                           |
| `docker compose logs`          | Muestra los registros del servicio.                           |
| `docker compose logs -f`       | Sigue los registros en tiempo real.                           |
| `docker compose down`          | Detiene y elimina los contenedores del proyecto.              |
| `docker compose build`         | Construye la imagen sin arrancar el contenedor.               |

## 11. Como se levanta el servidor y por que funciona

El servidor se levanta siguiendo este recorrido:

1. Docker Compose lee el archivo `docker-compose.yml` y encuentra el servicio
   llamado `php`.
2. La propiedad `build: .` indica que Docker debe utilizar el `Dockerfile` de
   la carpeta actual para construir la imagen.
3. La instruccion `FROM php:8.3-apache` descarga, si es necesario, una imagen
   que ya contiene PHP 8.3 y el servidor web Apache configurado.
4. La instruccion `COPY index.php /var/www/html/index.php` introduce nuestro
   archivo PHP en la carpeta publica de Apache. Esa carpeta es el lugar desde
   el que Apache sirve los archivos de la aplicacion.
5. Docker crea un contenedor a partir de esa imagen. El contenedor es una
   instancia en ejecucion de la imagen y contiene Apache, PHP y el archivo
   `index.php`.
6. La configuracion `8080:80` conecta el puerto `8080` del ordenador con el
   puerto `80` del contenedor. Apache escucha dentro del contenedor en el
   puerto 80, pero desde el ordenador se accede usando el puerto 8080.

Para arrancarlo en segundo plano se utiliza:

```bash
docker compose up -d --build
```

- `up` crea e inicia los servicios definidos en Docker Compose.
- `-d` significa _detached_ y deja el contenedor funcionando en segundo plano,
  por lo que la terminal queda disponible para seguir usando comandos.
- `--build` vuelve a construir la imagen antes de iniciar el contenedor. Esto
  permite incluir los cambios realizados en el `Dockerfile` o en `index.php`.

### Que ocurre al abrir la pagina

Cuando se escribe [http://localhost:8080](http://localhost:8080) en el
navegador, ocurre lo siguiente:

1. `localhost` indica que la peticion se dirige al propio ordenador.
2. `:8080` indica que la peticion se realiza al puerto 8080.
3. Docker recibe la peticion en el puerto 8080 y la redirige al puerto 80 del
   contenedor gracias a la configuracion `8080:80`.
4. Apache recibe la peticion y busca el archivo solicitado en
   `/var/www/html`.
5. Apache encuentra `index.php` y lo pasa al interprete de PHP incluido en la
   imagen `php:8.3-apache`.
6. PHP ejecuta el archivo. La instruccion `echo "Hola mundito con PHP"`
   genera el contenido de la respuesta.
7. Apache devuelve esa respuesta al navegador a traves de Docker.
8. El navegador muestra en pantalla el texto `Hola mundito con PHP`.

Por tanto, el texto no esta escrito directamente en el navegador. Lo genera
PHP cada vez que Apache recibe una peticion para `index.php`. Si se modifica el
archivo, hay que reconstruir y reiniciar el servicio para que el cambio quede
incluido en la imagen:

```bash
docker compose down
docker compose up -d --build
```

## Ordenador Desde Casa

Este es el procedimiento para continuar en casa un servidor que se ha creado
o modificado en clase. El mismo proceso sirve para futuros servidores basados
en Docker Compose.

### Pasos que se realizan en clase

1. Crear o modificar los archivos del proyecto, por ejemplo:
   `Dockerfile`, `docker-compose.yml`, `index.php` y cualquier otro archivo
   necesario.
2. Comprobar que el archivo `Dockerfile` y el archivo `docker-compose.yml`
   estan en la carpeta principal del proyecto.
3. Guardar todos los cambios.
4. Subir o sincronizar la carpeta completa del proyecto en el almacenamiento
   cloudDrive del colegio. Es importante conservar la estructura de carpetas y
   no subir solo el archivo `index.php`.

### Pasos que se realizan al llegar a casa

1. Abrir Docker Desktop y esperar a que indique que Docker esta iniciado.
2. Descargar o sincronizar desde cloudDrive la carpeta completa del proyecto.
   Se puede trabajar directamente dentro de la carpeta sincronizada, aunque es
   recomendable tener una copia local si el servicio de nube utiliza archivos
   bajo demanda.
3. Abrir PowerShell y situarse en la carpeta principal del proyecto, es decir,
   la carpeta que contiene `Dockerfile` y `docker-compose.yml`:

   ```powershell
   cd "C:\ruta\hasta\el\proyecto"
   ```

4. Comprobar que Docker esta disponible:

   ```powershell
   docker --version
   docker compose version
   ```

5. Validar la configuracion antes de iniciar el servidor:

   ```powershell
   docker compose config
   ```

6. Construir la imagen y arrancar el servidor en segundo plano:

   ```powershell
   docker compose up -d --build
   ```

   La opcion `--build` es necesaria cuando se han modificado el `Dockerfile`,
   `index.php` u otros archivos que el `Dockerfile` copia dentro de la imagen.

7. Comprobar que el contenedor esta funcionando:

   ```powershell
   docker compose ps
   ```

8. Abrir en el navegador la direccion indicada en `docker-compose.yml`. En
   este proyecto es:

   [http://localhost:8080](http://localhost:8080)

9. Si la pagina no funciona, consultar los registros del servidor:

   ```powershell
   docker compose logs
   ```

### Cuando se termina de trabajar

Si no se necesita mantener el servidor encendido, detenerlo con:

```powershell
docker compose down
```

Este comando elimina el contenedor y la red del proyecto, pero no borra los
archivos del proyecto ni la imagen. Al volver a trabajar en casa o en clase,
se puede arrancar de nuevo con:

```powershell
docker compose up -d --build
```

### Resumen rapido

En clase: modificar, guardar y sincronizar la carpeta completa en cloudDrive.

En casa: abrir Docker Desktop, descargar o sincronizar los archivos, entrar
en la carpeta del proyecto y ejecutar:

```powershell
docker compose up -d --build
```

Despues, abrir `http://localhost:8080` en el navegador. Antes de apagar el
ordenador, se puede detener el servidor con `docker compose down` y sincronizar
de nuevo los cambios con cloudDrive.

## Guardar el proyecto con Git

### Que es Git y para que sirve

Git es un sistema de control de versiones. Guarda un historial de los cambios
realizados en los archivos del proyecto y permite volver a una version anterior
si algo deja de funcionar. Tambien permite trabajar desde varios ordenadores
sin depender de copiar manualmente todos los archivos.

Git guarda el historial de forma local en una carpeta oculta llamada `.git`.
Por eso Git es muy util para guardar y organizar el proyecto, pero por si solo
no es una copia de seguridad externa: si se estropea el ordenador, tambien se
podria perder la carpeta `.git`.

Lo recomendable es combinar:

- **Git local** para crear versiones y consultar el historial.
- **GitHub, GitLab o un servidor Git remoto** para guardar una copia online y
   poder descargar el proyecto desde otro ordenador.

Para este objetivo, Git es mejor que depender exclusivamente de cloudDrive,
siempre que el repositorio remoto se actualice con `push`. No es necesario
guardar las imagenes ni los contenedores Docker: se guardan los archivos del
proyecto y Docker los vuelve a construir usando el `Dockerfile`.

### Comprobar si Git esta instalado

En PowerShell se puede comprobar con:

```powershell
git --version
```

Si aparece una version, Git esta instalado. En este ordenador la comprobacion
devuelve `git version 2.54.0.windows.1`.

Para comprobar si una carpeta ya es un repositorio Git:

```powershell
git status
```

Si aparece `not a git repository`, Git esta instalado, pero todavia no se ha
inicializado esa carpeta.

### Crear el repositorio por primera vez

Se recomienda trabajar en una carpeta local, por ejemplo
`C:\Users\jenna\Documents\Proyectos`, y no depender de que cloudDrive tenga
todos los archivos disponibles sin conexion. Desde PowerShell:

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

La configuracion de `user.name` y `user.email` solo suele ser necesaria la
primera vez que se utiliza Git en el ordenador.

### Guardar cambios durante el trabajo

Cada vez que se modifique el proyecto, por ejemplo `index.php`, se puede crear
una nueva version con:

```powershell
git status
git add .
git commit -m "Describe el cambio realizado"
```

Un commit no es una copia independiente de todos los archivos, sino un punto
del historial al que se puede volver. Conviene hacer commits pequenos y usar
mensajes que expliquen el cambio.

### Guardar una copia en GitHub o GitLab

Primero se crea un repositorio vacio en GitHub, GitLab u otro servidor Git.
Despues se enlaza con el repositorio local y se sube la primera version:

```powershell
git remote add origin https://github.com/USUARIO/Prueba_php_jenna.git
git branch -M main
git push -u origin main
```

Hay que sustituir la URL por la del repositorio remoto real. El primer `push`
puede pedir iniciar sesion o utilizar un token, segun el servicio elegido.

### Trabajar desde casa y desde clase

La primera vez que se utiliza otro ordenador, se descarga el proyecto con:

```powershell
git clone https://github.com/USUARIO/Prueba_php_jenna.git
cd Prueba_php_jenna
docker compose up -d --build
```

Antes de empezar a trabajar en un ordenador que ya tiene el proyecto:

```powershell
git pull
```

Despues de modificar los archivos y probar el servidor:

```powershell
git add .
git commit -m "Describe el cambio realizado"
git push
```

El flujo habitual es, por tanto:

1. `git pull` para descargar los cambios existentes.
2. Modificar y probar el proyecto con Docker.
3. `git add .` y `git commit` para guardar una nueva version.
4. `git push` para subir esa version al repositorio remoto.

Si se sigue utilizando cloudDrive como medio de intercambio, hay que esperar a
que termine la sincronizacion antes de abrir el proyecto en el otro ordenador.
Cuando el repositorio remoto ya este configurado, Git puede convertirse en el
medio principal para trasladar el proyecto y cloudDrive quedar como copia
adicional.
