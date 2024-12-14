# Pasos de Configuración Inicial del Entorno Laravel
## Actualizar Laravel
  ```bash
   composer update
   ```
## Crear .env 
  ```bash
   cp .env.example .env
   ```
## Generar key 
  ```bash
   php artisan key:generate
   ```
## Añador datps de conexion en el .env
  ```bash
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=
  DB_USERNAME=
  DB_PASSWORD=
   ```


Este documento describe los pasos necesarios para inicializar un proyecto Laravel con migraciones, seeders, permisos y la configuración de Passport.

## Passo 1: Inicialización del Entorno y Datos

1. **Ejecutar las migraciones**  
   Esto creará la estructura básica de la base de datos.  
   ```bash
   php artisan migrate
   ```

2. **Sembrar datos iniciales** (opcional)  
   Si cuentas con seeders generales o múltiples, ejecútalos ahora.  
   ```bash
   php artisan db:seed
   ```

3. **Crear las rutas de permisos**  
   Esto asume que ya has sembrado datos básicos y quieres generar las rutas de permisos.  
   ```bash
   php artisan permission:create-permission-routes
   ```

4. **Sembrar datos adicionales específicos**  
   Si necesitas ejecutar un seeder particular (por ejemplo, `NameSeeder`):  
   ```bash
   php artisan db:seed --class=NameSeeder
   ```

## Passo 2: Reseteo Manual del Caché de Permisos

Una vez que hayas creado los permisos y ejecutado los seeders necesarios, es conveniente limpiar la caché de permisos:  
```bash
php artisan permission:cache-reset
```

## Passo 3: Configuración de Laravel Passport

Por último, si aún no has configurado Passport, o necesitas preparar el entorno para OAuth:

1. **Ejecutar migraciones (opcional)**  
   Si Passport no estaba previamente instalado, corre las migraciones nuevamente:  
   ```bash
   php artisan migrate
   ```

2. **Instalar Passport**  
   Instala las llaves de Passport para la autenticación OAuth:  
   ```bash
   php artisan passport:install
   ```

Con estos pasos completados, tu entorno debería estar correctamente inicializado con permisos, datos básicos, y Passport configurado.
