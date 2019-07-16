<?php

namespace App\Entity;

use App\Application\Database;

class Event extends Database
{

    public function getAllEvent()
    {
        $sql = 'SELECT id, date, distance, lieu, saison_id, nrb_enfants FROM event ';
        $this->prepare($sql);
        $this->execute();

        return $this->fetchAll();
    }

public function add($date, $distance, $lieu, $saison_id, $nrb_enfants){

        $sql='INSERT INTO event(date, distance, lieu, distance, saison_id, nrb_enfants) values(:date, :distance, :lieu, :saison_id, :nrb_enfants)';
        $this-prepare($sql);
        $this->bindParam(':date', $date, \PDO::PARAM_STR);
        $this->bindParam(':lieu', $lieu, \PDO::PARAM_STR);
        $this->bindParam(':distance', $distance, \PDO::PARAM_STR);
        $this->bindParam(':saison_id' , $saison_id, \PDO::PARAM_STR);
        $this->bindParam('nrb_enfants', $nrb_enfants, \PDO::PARAM_INT);
        $this->execute();
        

}

public function getAllSeason()
    {
        $sql = "select id, nom_saison from saison";
        $this->prepare($sql);
        $this->execute();
        return $this->fetchAll();
    }

} 