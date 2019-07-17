<?php

namespace App\Entity;

use App\Application\Database;

class Season extends Database
{

    public function add($nomsaison)
    {
        $sql = 'INSERT INTO saison(nom_saison) values(:nomsaison) ';
        $this->prepare($sql);
        $this->bindParam(':nomsaison', $nomsaison, \PDO::PARAM_STR);
        $this->execute();
    }

    public function getAllSeason()
    {
        $sql = "select id, nom_saison from saison";
        $this->prepare($sql);
        $this->execute();

        return $this->fetchAll();
    }

    public function exist($nomsaison)
    {

        $sql = 'SELECT COUNT(id) AS number FROM saison WHERE nom_saison=:nomsaison';
        $this->prepare($sql);
        $this->bindParam(':nomsaison', $nomsaison, \PDO::PARAM_STR);
        $this->execute();
        $result = $this->fetch();



        if ($result['number'] !== 0) {
            return false;
        }
        return true;
    }

        public function existByUserSaison($idUser, $saison){

            $sql = 'SELECT COUNT(saison_id) AS number FROM user_saison WHERE saison_id=:saisonid and user_id=:userid';
            $this->prepare($sql);
            $this->bindParam(':saisonid', $saison, \PDO::PARAM_INT);
            $this->bindParam(':userid', $idUser, \PDO::PARAM_INT);
            $this->execute();
            
            $result = $this->fetch();

            if ($result['number'] !== 0){
                return true;
            }
            return false;

        }

    public function removeUserBySaison($saison, $idUser)
    {
        $sql = 'DELETE FROM user_saison WHERE saison_id=:saison and user_id=:user';
        $this->prepare($sql);
        $this->bindParam(':saison', $saison, \PDO::PARAM_INT);
        $this->bindParam(':user', $idUser, \PDO::PARAM_INT);
        $this->execute();

        
    }


    public function addUserBySaison($idUser, $saison){
        
        $sql = 'INSERT INTO user_saison(saison_id, user_id) values(:saisonid, :userid)';
        
        $this->prepare($sql);
        $this->bindParam(':saisonid', $saison, \PDO::PARAM_INT);
        $this->bindParam(':userid', $idUser, \PDO::PARAM_INT);
        $this->execute();
    }

    public function listUserAffected($saison){

 
        $sql = 'SELECT * From user_saison left join user on user.id = user_saison.user_id WHERE saison_id =:saison AND user.is_admin = 0';
        $this->prepare($sql);
        $this->bindParam(':saison', $saison, \PDO::PARAM_INT);
        $this->execute();

        return $this->fetchAll();
    }

   
    public function deleteUser($idUser)
    {
        

        $sql = 'DELETE FROM user_saison WHERE user_id=:user';
        $this->prepare($sql);
        $this->bindParam(':user', $idUser, \PDO::PARAM_INT);
        $this->execute();
    }

    public function deleteSaison($idSaison)
    {
        

        $sql = 'DELETE FROM saison WHERE id=:id';
        $this->prepare($sql);
        $this->bindParam(':id', $idSaison, \PDO::PARAM_INT);
        $this->execute();
    }

    // public function FreeUser($idUser, $saison){
    //     $sql = 'SELECT * From '

    // }

}
