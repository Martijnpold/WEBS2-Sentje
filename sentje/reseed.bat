call composer dump-autoload
call php artisan migrate:reset
call php artisan migrate
call php artisan db:seed