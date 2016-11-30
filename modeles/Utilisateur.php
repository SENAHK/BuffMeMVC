<?php

require_once __DIR__.'/Modele.php';

class Utilisateur extends Modele {

    public function validerLogin($user, $password) {
        $sql = "SELECT nomUtilisateur from utilisateurs where nomUtilisateur =:user AND mdpUtilisateur=:pass";
        $requete = $this->executerRequete($sql, array(":user" => $user, ":pass" => $password));
        return $requete->fetch();
    }

    public function getIdUser($usr) {
        $sql = "SELECT idUtilisateur from utilisateurs where nomUtilisateur =?";
        $requete = $this->executerRequete($sql, array($usr));
        return $requete->fetch();
    }

}
