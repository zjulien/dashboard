<?php

namespace App\Controller;

use App\Application\Controller;
use App\Application\DatabaseConfig;
use App\Entity\Season;
use App\Entity\User;
use App\Services\UserLogged;


class SeasonController extends Controller
{
public function list()
{
if (!UserLogged::isLogged()) {
header('Location: /');
return;
}

$user = new User();
$users = $user->getAllParents();
return $this->twig->render(
'season/list.html.twig',
[
'users' => $users
]

);
}
}