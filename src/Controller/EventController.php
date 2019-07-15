<?php

namespace App\Controller;

use App\Application\Controller;
use App\Application\DatabaseConfig;
use App\Entity\Season;
use App\Entity\User;
use App\Services\UserLogged;

class EventController extends Controller
{
    public function list(){

    if (!UserLogged::isLogged()) {
        header('Location: /');
        return;
    }
    $event = new Event ();
    $events = $event->getAllEvent();
    return $this->twig->render(
        'event/event.html.twig',
        [
            'events' => $events
        ]

        );

}

}