# Como instalar

1. Tenha certeza que você possui em seu _command line_ as ferramentas: PHP, Composer e Node.
2. Clone o repositório e instale executando os comandos abaixo:

composer install
php -r "file_exists('.env') || copy('.env.example', '.env');"
php artisan key:generate --ansi
php artisan serve
```

Depois disso, acesse [http://localhost:8000/](http://localhost:8000/)