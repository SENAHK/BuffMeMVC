<?php
/* 
 * RAMUSI Michael - CFPT
 * 2016-2017
 * BuffMeMVC
 */
DEFINE('DB_HOST', "127.0.0.1");
DEFINE('DB_NAME', "buffme");
DEFINE('DB_USER', "buffme_admin");
DEFINE('DB_PASS', "Super");

abstract class Modele {

    // Objet PDO d'accès à la BD
    private $bdd;

    // Exécute une requête SQL éventuellement paramétrée
    protected function executerRequete($sql, $params = null, $lastId = false) {
        if ($params == null) {
            $resultat = $this->getBdd()->query($sql);    // exécution directe
        } else {
            $resultat = $this->getBdd()->prepare($sql);  // requête préparée

            $resultat->execute($params);
        }
        if ($lastId) {
            $resultat = $this->getBdd()->lastInsertId();
        }
        return $resultat;
    }

    protected function creerTransaction() {
        $this->getBdd()->beginTransaction();
    }

    protected function rollBack() {
        $this->getBdd()->rollBack();
    }
    protected function commit(){
        $this->getBdd()->commit();
    }
    // Renvoie un objet de connexion à la BD en initialisant la connexion au besoin
    private function getBdd() {
        if ($this->bdd == null) {
            // Création de la connexion
            $connectionString = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
            $this->bdd = new PDO($connectionString, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $this->bdd;
    }

}
