# Sistema para Gestión de Votaciones (Backend)

El proyecto contiene el backend de un sistema para gestión de votos. Este contiene la API desarrollada con el Framework PHP CodeIgniter versión 3, para ser consumidos desde el frontend. Por otro lado, se encuentra el archivo `data.sql`, que posee la estructura de tabla y datos de prueba de la base de datos.

## Pre-requisitos

- Es necesario tener instalado PHP 7.*.

- MySQL instalado junto con un gestor para la manipulación y administración de la base de datos.

## Instalacióm

- En primer lugar, se debe clonar el proyecto, por ejemplo (utilizando HTTPS) con la línea de comando:

```bash
git clone https://github.com/Roccma/votaciones-backend.git
```

O bien, descargarlo y ubicarse con la consola dentro del directorio.

- Luego, al abrir el gestor de base de datos que se utilice, crear la base de datos y ejecutar el archivo `data.sql`.

- Desde el proyecto, dirigirse al archivo `votaciones-backend/application/config/database.php`. Y allí indicar los parámetros para su conexión (HOST, USER, PASSWORD, PORT Y DATABASE).

- Una vez corriendo nuesro servidor local, el proyecto ya estará funcionando correctamente con los endpoints disponibles para ser utilizados.
