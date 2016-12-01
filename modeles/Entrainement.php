<?php

require_once __DIR__ . '/Modele.php';

class Entrainement extends Modele {

    public function getEntrainements($idUtilisateur) {
        $sql = "SELECT nomEntrainement, descriptionEntrainement, idEntrainement, idUtilisateur from entrainements where idUtilisateur=?";
        $entrainements = $this->executerRequete($sql, [$idUtilisateur]);
        $resultat = $entrainements->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

    public function getEntrainement($idEntrainement) {
        $sql = "SELECT * from composer where idEntrainement=?";
        $entrainements = $this->executerRequete($sql, [$idEntrainement]);
        $resultat = $entrainements->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

    public function insertEntrainement($idUtilisateur, $nomEntr, $descEntr, $exercices) {
        try {
            $this->creerTransaction();
            $sql = "INSERT INTO entrainements VALUES('', :nom, :desc, :id)";
            $lastId = $this->executerRequete($sql, [":nom" => $nomEntr, ":desc" => $descEntr, "id" => $idUtilisateur], true);

            foreach ($exercices as $exercice) {
                $idExercice = array_keys($exercice)[0];
                foreach ($exercice as $infos) {
                    $nbRep = $infos['nbRep'];
                    $nbSerie = $infos['nbSerie'];
                }
                $this->insertComposer($idExercice, $lastId, $nbRep, $nbSerie);
            }

            $this->commit();
        } catch (Exception $ex) {
            $this->rollBack();
            echo $ex->getMessage();
        }
    }

    public function insertComposer($idExercice, $idEntrainement, $nbRep, $nbSerie) {
        $sql = "INSERT INTO composer VALUES(:rep, :serie, :idEntrainement, :idExo)";
        $this->executerRequete($sql, [":rep" => $nbRep, ":serie" => $nbSerie, ":idEntrainement" => $idEntrainement, ":idExo" => $idExercice]);
    }

    public function getNomEntrainement($idEntrainement) {
        $sql = "SELECT nomEntrainement from entrainements where idEntrainement=?";
        $entrainements = $this->executerRequete($sql, [$idEntrainement]);
        $resultat = $entrainements->fetch();
        return $resultat[0];
    }

}
