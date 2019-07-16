<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Event;
use App\Entity\Season;
use App\Services\UserLogged;
use App\Application\Controller;
use App\Application\DatabaseConfig;

class EventController extends Controller
{
    public function list()
    {

        if (!UserLogged::isLogged()) {
            header('Location: /');
            return;
        }
        $event = new Event();
        $events = $event->getAllEvent();
        return $this->twig->render(
            'event/list.html.twig',
            [
                'events' => $events
            ]

        );
    }
    public function add()
    {
        if (!UserLogged::isLogged()) {
            header('Location: /');
            return;
        }

        if (isset($_POST['form_event'])) {

            $season = new season();
            $seasons = $season->getAllSeason();
            $event = new Event();
            $reponseValidityForm = $this->validForm();
            if (gettype($reponseValidityForm) === 'boolean') {
                $event->add(
                    $_POST['date'],
                    $_POST['lieu'],
                    $_POST['distance'],
                    $_POST['nrb_enfants'],
                    $_POST['saison_id'],
                    $_POST['saisons']
                    
                );

                header('Location: /dashboard/event');
                return;
            }

            return $this->twig->render(
                'event/form.html.twig',
                [
                    'error' => $reponseValidityForm,
                    'values' => $_POST,
                     'saisons' => $seasons
                ]

                );

            return $this->twig->render(
                'event/form.html.twig'

            );


        }

        return $this->twig->render(
            'event/form.html.twig'
        );
    }

    private function validForm()
    {
        $date = $_POST['date'];
        $lieu = $_POST['lieu'];
        $distance = $_POST['distance'];
        $nrb_enfants = $_POST['enfants'];

       

        if (strlen(trim($date)) === 0) {
            $error['date'] = true;
        }
        if (strlen(trim($lieu)) === 0) {
            $error['lieu'] = true;
        }



        if (strlen(trim($distance)) === 0) {
            $error['distance'] = true;
        }

        if (strlen(trim($nrb_enfants)) === 0) {
            $error['enfants'] = true;
        }

        if (count($error) !== 0) {
            return $error;
        }

        return true;
    }
}
