<?php

namespace App\Controller;

use App\Application\Controller;
use App\Application\DatabaseConfig;
use App\Entity\Season;
// use App\Entity\User;
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

    public function add(){
if(!UserLogged::isLogged()){
    header('Location: /');
    return;

}
if( isset($_POST['form_season'])){
$season = new Season();
$reponseValidityForm = $this->validForm();
if(gettype($reponseValidityForm) === 'boolean' && !$season->exist($_POST['saison']) ){

$season->add(
    $_POST['saison']
);



header('Location: /dashboard/season');
return;

}

    return $this->twig->render(
        'season/form.html.twig',
        [
            'error' =>$reponseValidityForm,
            'values' =>$_POST
        ]
    );

    }
     return $this->twig->render(
         'season/form.html.twig'
     );
}

private function validForm(){
    $nomsaison = $_POST['saison'];
    $error = [];

    if(strlen(trim($nomsaison)) ===0 ){
        $error['saison'] = true;
    }
    
    if(count ($error) !== 0 ){
        return $error;
    }
    return true;
}
}