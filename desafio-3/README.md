# Como instalar

1. Tenha certeza que você possui em seu _command line_ as ferramentas: PHP, Composer e Node.
2. Clone o repositório e instale executando os comandos abaixo:

```
composer install
php -r "file_exists('.env') || copy('.env.example', '.env');"
php artisan key:generate --ansi
```

3. Depois de instalado, é necessário configurar o banco de dados. Altere os dados do arquivo .env para corresponder ao seu MySQL local:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=desafio_3
DB_USERNAME=root
DB_PASSWORD=secret
```

4. Depois, basta popular o banco com o _migration_ do Laravel e servir a aplicação:

```
php artisan migrate:fresh --seed
php artisan serve
```

Depois disso, acesse [http://localhost:8000/](http://localhost:8000/)
