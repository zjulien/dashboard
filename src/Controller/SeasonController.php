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

        $season = new season();
        $seasons = $season->getAllSeason();
        return $this->twig->render(
            'season/list.html.twig',
            [
                'saisons' => $seasons
            ]

        );
    }

    public function add()
    {
        if (!UserLogged::isLogged()) {
            header('Location: /');
            return;
        }
        if (isset($_POST['form_season'])) {
            $season = new Season();
            $reponseValidityForm = $this->validForm();
            if (gettype($reponseValidityForm) === 'boolean' && !$season->exist($_POST['saison'])) {

                $season->add(
                    $_POST['saison']
                );



                header('Location: /dashboard/season');
                return;
            }

            return $this->twig->render(
                'season/form.html.twig',
                [
                    'error' => $reponseValidityForm,
                    'values' => $_POST
                ]
            );
        }
        return $this->twig->render(
            'season/form.html.twig'
        );
    }

    public function affected($param)

    {
        if (!UserLogged::isLogged()) {
            header('Location: /');
            return;
        }

        $user = new User();
        $users = $user->getUserBySaison($param['id']);
        $saison = new Season();
        $saisons = $saison->listUserAffected($param['id']);
        return $this->twig->render(
            'season/affected.html.twig',
            [
                'users' => $users,
                'saison' => $param['id'],
                'usersaison' => $saisons
            ]
        );
    }
    //selection de tout les parents non affecté à l'id

    //selection des parents affecté à l'id


    private function validForm()
    {
        $nomsaison = $_POST['saison'];
        $error = [];

        if (strlen(trim($nomsaison)) === 0) {
            $error['saison'] = true;
        }

        if (count($error) !== 0) {
            return $error;
        }
        return true;
    }

    public function updateAffected()
    {

        if (!UserLogged::isLogged()) {
            header('Location: /');
            return;
        }
        if (isset($_POST['form_affected'])) {
            $saison = new Season();
            if (isset($_POST['affected'])) {

                foreach ($_POST['affected'] as $idUser) {

                    if (!$saison->existByUserSaison($idUser, $_POST['saison'])) {
                        $saison->addUserBySaison($idUser, $_POST['saison']);
                    }
                }
            }

            if (isset($_POST['desaffected'])) {

                foreach ($_POST['desaffected'] as $idUser) {

                    if ($saison->removeUserBySaison($idUser, $_POST['saison'])) {
                        $saison->addUserBySaison($idUser, $_POST['saison']);
                    }
                }
            }
        }
        header('Location: /dashboard/season');
        return;
    }

    // public function UserAffected(){

    //     if (!UserLogged::isLogged()) {
    //         header('Location: /');
    //         return;
    //     }
    //     if (isset($_POST['form_desaffected'])){
    //         $saison = new Season();
    //         if (isset($_POST['desaffected'])){
    //             $saison->deleteUser($idUser, $_POST['saison']);

    //         }
    //     }
    // }


}
