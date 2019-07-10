<?php

namespace App\Services;

abstract class PasswordGenerator
{
public function generate(){
    $choice = "AZERTYUIOPQSDFGHJKLMWXCVBNazertyuiopqsdfghjklmwxcvbn0123456789&é#!?;:";
    $password = '';

    for($i = 0; $i<12; $i++){
        $password .= $choice[rand(0, strlen($choice) -1)];
    }

    return $password;
}

}