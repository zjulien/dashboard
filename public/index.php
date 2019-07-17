<?php 
require_once dirname(__DIR__).'/vendor/autoload.php';
$router = new AltoRouter();
/*
    ici les mots /, /produits, /a-propos et /contact se situent dans l'url
    'c' donne le nom de la classe Controller appelée
    'a' donne le nom de la méthode de la classe ci-dessus
*/
$router->map('GET|POST', '/', array('c' => 'SecurityController', 'a' => 'login'));
$router->map('GET','/dashboard', array('c' => 'DashboardController', 'a' => 'index'));
$router->map('GET','/logout', array('c' => 'SecurityController', 'a' => 'logout'));


$router->map('GET','/dashboard/user', array('c' => 'UserController', 'a' => 'list'));
$router->map('GET|POST','/dashboard/user/add', array('c' => 'UserController', 'a' => 'add'));
$router->addMatchTypes(array('iduser' => '[0-9]{1,5}'));
$router->map('GET', '/dashboard/user/delete/[i:iduser]', array('c'=> 'UserController', 'a' => 'delete'));


$router->addMatchTypes(array('idsaison' => '[0-9]{1,5}'));
$router->map('GET', '/dashboard/season/delete/[i:idsaison]', array('c'=> 'SeasonController', 'a' => 'delete'));
$router->map('GET', '/dashboard/season', array('c' => 'SeasonController', 'a' => 'list'));
$router->map('GET|POST', '/dashboard/season/add', array('c' => 'SeasonController', 'a' => 'add'));

$router->map('GET', '/dashboard/season/affected/[i:id]', array('c' =>'SeasonController', 'a' => 'affected'));
$router->map('POST', '/dashboard/season/uptadeaffected', array('c' =>'SeasonController', 'a' => 'updateAffected'));

$router->map('GET','/dashboard/event', array('c' => 'EventController', 'a' => 'list'));
$router->map('GET|POST','/dashboard/event/add', array('c' => 'EventController', 'a' => 'add'));
 

$match = $router->match();

$controller = 'App\\Controller\\' . $match['target']['c']; //les antislashs sont des caractères d'échappement


$action = $match['target']['a']; //On récupère que le 'a' qui est l'action


//INSTANCIER L'OBJET D'APRES L'URL
$object = new $controller();
if (count($match['params']) === 0)
$print = $object->{$action}();
else
$print = $object->{$action}($match['params']);

echo $print;
