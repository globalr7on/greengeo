Startup 
    Passo 1 Comandos para o novo serviço
        php artisan migrate
        php artisan permission:create-permission-routes
        (all seeders) php artisan db:seed
        (single seeder) php artisan db:seed --class=NameSeeder

    Passo 2 Manual cache resest (Permissions)
        php artisan permission:cache-reset

    Passo 3 Laravel/Passport
        php artisan migrate
        php artisan passport:install

Nova Ruta
    php artisan route:cache

Install just one time 
Migrate cambiando el tipo de column
    composer require doctrine/dbal