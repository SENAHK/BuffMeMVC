<?php
/* 
 * RAMUSI Michael - CFPT
 * 2016-2017
 * BuffMeMVC
 */
require_once __DIR__ . '/Modele.php';

class groupeMusculaire extends Modele {

    public function getGroupesMusculaires() {
        $sql = "SELECT * from groupemusculaire";
        $requete = $this->executerRequete($sql);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

}
