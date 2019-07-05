<?php 
require_once dirname(__DIR__).'/vendor/autoload.php';
$router = new AltoRouter();
/*
    ici les mots /, /produits, /a-propos et /contact se situent dans l'url
    'c' donne le nom de la classe Controller appelée
    'a' donne le nom de la méthode de la classe ci-dessus
*/
$router->map('GET', '/', array('c' => 'DefaultController', 'a' => 'index'));
$router->map('GET', '/produits', array('c' => 'ProduitsController', 'a' => 'index'));
$router->map('GET', '/a-propos', array('c' => 'DefaultController', 'a' => 'about'));
$router->map('GET', '/contact', array('c' => 'DefaultController', 'a' => 'default'));
$match = $router->match();
$controller = 'App\\Controller\\' . $match['target']['c'];
$action = $match['target']['a'];
$object = new $controller();
$print = $object->{$action}();
echo $print;