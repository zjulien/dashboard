<?php 
require 'vendor/autoload.php';

$page = 'home';
if (isset ($_get['p'])){
    $page = $_GET['p'];

}

$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader, [
    'cache' => false, //__DIR__ . '/tmp'

]);

switch($page) {
    case 'contact':
    echo $twig->render('contact.twig');
    break;
    case 'home';
    echo $twig->render('home.twig');
    break;
    default:
        header('HTTP/1.0 404 Not Found');
        echo $twig->render('404.twig');
        break;
}

if ($page === 'home'){
    echo $twig->render('home.twig');
    
}



?>

<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>s'enregistrer</title>
    <link rel="stylesheet" type="text/css" href="asset/public/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="header">
        <h2> S'enregistrer</h2>
</div>
<form method="post" action="index.php">
    <--- 
    <div class="input-group">
    <label>Nom</label>
    <input type="text" name="lastname">
</div>
<div class="input-group">
    <label>Prenom</label>
    <input type="text" name="firstname">
</div>
<div class="input-group">
    <label>Email</label>
    <input type="text" name="email">
</div>
<div class="input-group">
    <label>Mot de passe</label>
    <input type="password" name="password">
    </div>
    <div class="input-group">
    <label>confirmer mot de passe</label>
    <input type="password" name="password">
</div>
<div class="input-group">
    <button type="submit" name="register" class="btn">S'enregistrer </button>
</div>
<p>déjà membre? <a href="login.php">Se connecter</p>
</form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html> -->