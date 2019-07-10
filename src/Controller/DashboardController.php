<?php 

namespace App\Controller;

use App\Application\Controller;
use App\Application\DatabaseConfig;
use App\Services\UserLogged;

class DashboardController extends Controller 
{


    function index(){
        if( !UserLogged::isLogged() ){
            header('Location: /');
            return;
        }
        
        return $this->twig->render('index.html.twig');
    }




}