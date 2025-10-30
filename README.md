# PandaTask (Backend) - Gestion de Tareas

Aplicacion para Gestion de Tareas mediante columnas personalizables

## 🚀Tecnologías Utilizadas

- Backend Framework: Laravel  (PHP)
- Autenticación: JWT (JSON Web Tokens)
- SQL

## Endpoints de la Aplicacion

### Auth
- Login => `/api/login`
- Register => `/api/register`
### Projects
- Listar Proyectos => `/api/projects`  (GET)
- Crear Proyecto => `/api/projects` (POST)
- Ver Proyecto => `/api/projects/{id}` (GET)
- Actualizar Proyecto => `/api/projects/{id}` (PUT)
- Eliminar Proyecto => `/api/projects/{id}` (DELETE)
### Columns
- Listar Columnas => `/api/projects/{id}/columns`  (GET)
- Crear Columna => `/api/projects/{id}/columns` (POST)
- Ver Columna => `/api/projects/{id}/columns/{id}` (GET)
- Actualizar Columna => `/api/projects/{id}/columns/{id}` (PUT)
- Eliminar Columna => `/api/projects/{id}/columns/{id}` (DELETE)
### Tasks
- Listar Tareas => `/api/projects/{id}/columns/{id}/tasks`  (GET)
- Crear Tarea => `/api/projects/{id}/columns/{id}/tasks` (POST)
- Ver Tarea => `/api/projects/{id}/columns/{id}/tasks/{id}` (GET)
- Actualizar Tarea => `/api/projects/{id}/columns/{id}/tasks/{id}` (PUT)
- Eliminar Tarea => `/api/projects/{id}/columns/{id}/tasks/{id}` (DELETE)

### Requisitos previos

Antes de ejecutar este proyecto en tu entorno local, asegúrate de tener instalados los siguientes requisitos:

- PHP >= 8.0
- Composer (para gestionar las dependencias de PHP)

### Instalacion

1. **Clonar Repositorio**
```
git clone https://github.com/juancarlosgt/task-manager.git
cd task-manager
```

2. **Instalar Dependencias**
```
composer install
```
3. **Configurar Variables de Entorno**
```
cp .env.example .env
```
o en Windows duplica el archivo `.env.example` y cambiale el nombre a `.env`

4. **Genera la clave de la aplicación Laravel:**
```
php artisan key:generate
```

5. **Configura la base de datos:**

Por defecto el proyecto usa `sqlite` , si se quiere usar bases de datos como mysql o postgresql se tienen que configurar las siguientes variables de entorno con los valores correspondientes
```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

6. **Ejecutar Migraciones**

```
php artisan migrate
```

7. **Inicia el servidor de desarrollo de Laravel:**

Una vez todo esté configurado, puedes iniciar el servidor local de Laravel con:
```
php artisan serve
```
Esto iniciará el servidor en `http://127.0.0.1:8000.`