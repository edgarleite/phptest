## Teste para desenvolvedor PHP da upLexis - Laravel 5.1.* ##

### Instalação ###

* `git clone https://github.com/edgarleite/phptest.git`
* `cd phptest`
* `composer install`
* `php artisan key:generate`
* Criar banco de dados e atualizar *.env*
* `php artisan migrate --seed` para criar e popular as tabelas
* `php artisan vendor:publish` para publicar
* `php artisan serve` para iniciar o app em http://localhost/