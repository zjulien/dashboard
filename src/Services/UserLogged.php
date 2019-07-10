<?php
namespace App\Services;

 abstract class  UserLogged {

 public  function isLogged(){
    session_start();
    if ( !isset($_SESSION['login']) && $_SESSION['login'] !== 1 ){
        return false;
    }

    return true;
}
}