<?php
namespace App\Entity;

use App\Application\Database;

class User extends Database{

public function countByEmailAndPassword(string $email, string $pwd){

    $sql = 'select count(id) as number from user where mail=:email and mot_de_passe = password(:pwd) ';
    $this->prepare($sql);
    $this->bindParam(':email', $email, \PDO::PARAM_STR);
    $this->bindParam(':pwd', $pwd, \PDO::PARAM_STR);
    $this->execute();

    $result = $this->fetch();
    return $result ['number'];
}
public function getAllParents(){
    $sql = 'select id, nom, prenom, mail, telephone from user where is_admin =0';
    $this->prepare($sql);
    $this->execute();
    
    return $this->fetchAll();
}

public function add($nom, $prenom, $mail, $telephone, $isadmin, $password){
    
    $sql = 'insert into user(nom, prenom, mail, telephone, is_admin, mot_de_passe) values(:nom, :prenom, :mail, :telephone, :isadmin, password(:password))';
    $this->prepare($sql);
    $this->bindParam(':nom', $nom, \PDO::PARAM_STR);
    $this->bindParam(':prenom', $prenom, \PDO::PARAM_STR);
    $this->bindParam(':mail', $mail, \PDO::PARAM_STR);
    $this->bindParam(':telephone', $telephone, \PDO::PARAM_STR);
    $this->bindParam(':isadmin', $isadmin, \PDO::PARAM_INT);
    $this->bindParam(':password', $password, \PDO::PARAM_STR);
    $this->execute();
}
public function exist($mail){
    $sql = 'select count(id) as number from user where mail = :mail';
    $this->prepare($sql);
    $this->bindParam(':mail', $mail, \PDO::PARAM_STR);
    $this->execute();
    $result = $this->fetch();

    if($result['number'] !== 0){
        return false;
    }
    return true;
}


}