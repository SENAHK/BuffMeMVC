<?php
/* 
 * RAMUSI Michael - CFPT
 * 2016-2017
 * BuffMeMVC
 */
require_once __DIR__.'/Modele.php';

class Exercice extends Modele {

    public function getExercicesByGm($idGm) {
        $sql = "SELECT nomExercice, idExercice "
                . "from exercices "
                . "natural join cibler "
                . "natural join groupemusculaire "
                . "where idGm = ? ";
        $requete = $this->executerRequete($sql, [$idGm]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

}