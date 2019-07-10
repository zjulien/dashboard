<?php
namespace App\Entity;

use App\Application\Database;

class Season extends Database{

public function add($nomsaison){
$sql = 'INSERT INTO saison(nom_saison) values(:nomsaison) ';
$this->prepare($sql);
$this->bindParam(':nomsaison',$nomsaison, \PDO::PARAM_STR);
$this->execute();

}

public function getAllSeason(){
    $sql="select id, nom_saison from saison";
    $this->prepare($sql);
    $this->execute();

    return $this->fetchAll();
}

public function exist($nomsaison){
 
    $sql = 'SELECT count(id) AS number FROM saison WHERE nom_saison=:nomsaison';
    $this->prepare($sql);
    $this->bindParam(':nomsaison' , $nomsaison, \PDO::PARAM_STR);
    $this->execute();
    $result = $this->fetch();



    if($result['number'] !== 0){
        return false;
    }
    return true;
}

}