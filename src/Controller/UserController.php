<?php 

namespace App\Controller;

use App\Application\Controller;
use App\Application\DatabaseConfig;
use App\Entity\User;
use App\Services\UserLogged;
Use App\Services\PasswordGenerator;

class UserController extends Controller
{
    public function list(){
        if(!UserLogged::isLogged()){
            header('Location: /');
            return;
        }
        $user = new User();
        $users = $user->getAllParents();
        return $this->twig->render('user/list.html.twig',
        [
            'users' => $users
        ]
    );

    }
    public function add(){
        if(!UserLogged::isLogged()){
            header('Location: /');
            return;
        }
        
        if( isset($_POST['form_user'])){
            
            $user = new User();
            $reponseValidityForm = $this->validForm();
            if( gettype( $reponseValidityForm ) === 'boolean' && !$user->exist($_POST['mail'])){
                
            $user->add(
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['mail'],
            $_POST['telephone'],
            0, 
            PasswordGenerator::generate()
            );
            
            header('Location: /dashboard/user');
            return;
            }
           
            return $this->twig->render(
            'user/form.html.twig',
        [
            'error' => $reponseValidityForm,
            'values' => $_POST
        ]
       
    );
            
        }

        return $this->twig->render(
            'user/form.html.twig'
        );
    }

 private function validForm(){
    $nom = $_POST['nom'];
    $prenom= $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $mail = $_POST['mail'];

    $error = [];

    if(strlen(trim($nom)) ===0 ){
        $error['nom'] = true;
    }
    if(strlen(trim($prenom)) ===0 ){
        $error['prenom'] = true;
    }

    

    if(!preg_match(" /^(\d\d\s){4}(\d\d)$/ ", $telephone)){
        $error['telephone'] = true;
    }
    
    if(!preg_match (" /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ " , $mail)){
        $error['mail'] = true;
    }

    if(count($error) !== 0 ){
        return $error;
    }

    return true;
 }

}