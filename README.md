# RubyBox API
Este es el repositorio de la API de RubyBox que utiliza [Laravel](https://laravel.com)

# Instalación Desarrollo
1. Asegurate de tener Docker instalado.
2. Clona el repositorio
3. Una vez dentro copia y pega el archivo `.env.example` a `.env`
4. Ejecuta este comando para instalar las dependencias de composer
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs
```
5. Una vez instalado [configura el alias de `sail`](https://laravel.com/docs/sail#configuring-a-shell-alias)
6. Ejecuta estos comandos (puedes ejecutar uno por uno para ver el resultado de cada uno):
```bash
sail build --no-cache           # Crea la imagen del proyecto
sail up -d                      # Ejecuta los servicios
sail art key:generate           # Genera llave de encriptación
sail art migrate:fresh --seed   # Genera y popula la base de datos (puedes omitir la opción --seed si no quieres popularla)
sail art storage:link           # Crea un symlink para visitar la ruta /storage/ y obtener archivos locales
sail art config:cache           # Guarda en cache la configuración para mejorar el rendimiento
sail art route:cache            # Guarda las rutas en cache para mejorar el rendimiento
```

# Manejo de la Base de Datos
Estos son algunos comandos útiles para manejar la base de datos en el desarrollo:

- `sail art migrate`: Ejecuta las migraciones pendientes para generar tablas y columnas
- `sail art migrate:fresh`: Limpia todas las tablas y ejecuta todas las migraciones
- `sail art migrate:rollback`: Deshace todas las operaciones de base de datos que hayas realizado
- `sail art migrate:rollback --step=#`: Deshace las operaciones de la base de datos que hayas realizado, con un limite de `#` pasos.

Opciones para agregar:
- `--seed`: Popula la base de datos con datos generados

Para mas información puedes ver la [documentación de migraciones de Laravel](https://laravel.com/docs/migrations).

# Documentación
Para mas información sobre los distintos aspectos de la API es recomendable revisar la [documentación de Laravel](https://laravel.com/docs)