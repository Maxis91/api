<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteC

    ?>ond %{REQUEST_FILENAME} !-f
    RewriteRule ^((?s).*)$ index.php?_url=/$1 [QSA,L]
</IfModule>

<?php
use Phalcon\Mvc\Micro;
$app = new Micro();
$app->get('/api/users', function () {});
$app->get('/api/users/search/{name}', function ($nom) {});
$app->get('/api/users/{id:[0-9]+}', function ($id) {});
$app->post('/api/users', function () {});

$app->handle();



$ap = new Micro();
$ap->get('/api/robots', function () {});
$ap->get('/api/robots/search/{name}', function ($nom) {});
$ap->get('/api/robots/{id:[0-9]+}', function ($id) {});
$ap->post('/api/robots', function () {});


$ap->handle();
?>
