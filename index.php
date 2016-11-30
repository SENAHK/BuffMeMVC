<?php

require_once './modeles/Utilisateur.php';
require_once './modeles/Entrainement.php';
require_once './modeles/Exercice.php';
require_once './modeles/groupeMusculaire.php';
session_start();

$user = new Utilisateur();
$training = new Entrainement();
$gm = new groupeMusculaire();
$_SESSION['nbInput'] = 1;


try {
    // Formulaire de Login validé
    if (isset($_REQUEST['submit'])) {
        $username = $_REQUEST['username'];
        $password = sha1($_REQUEST['password']);
        $nomUtilisateur = $user->validerLogin($username, $password)[0];

        // Si login réussi
        if (is_string($nomUtilisateur)) {
            $idUser = $user->getIdUser($nomUtilisateur)[0];
            $entrainements = $training->getEntrainements($idUser);
            $_SESSION['entrainements'] = $entrainements;
            $_SESSION['user'] = array($idUser => $nomUtilisateur);

            $groupesMusculaires = $gm->getGroupesMusculaires();
            $_SESSION['groupesMusculaires'] = $groupesMusculaires;
            // Afficher les entrainements de l'utilisateur
            require './vues/vueEntrainements.php';
        } else {
            throw new Exception("Identifiants non valides");
        }
    } else {
        // Formulaire d'ajout d'un entrainement
        if (isset($_REQUEST['btnAjoutEntrainement'])) {
            $idUser = array_keys($_SESSION['user'])[0];
            $nomEntrainement = filter_input(INPUT_POST, 'nomEntrainement', FILTER_SANITIZE_SPECIAL_CHARS);
            $descEntrainement = filter_input(INPUT_POST, 'descEntrainement', FILTER_SANITIZE_SPECIAL_CHARS);
            $exercices = array();

            foreach ($_REQUEST as $key => $value) {
                if (strpos($key, "exercice") !== false) {
                    array_push($exercices, $value);
                }
            }

            $training->insertEntrainement($idUser, $nomEntrainement, $descEntrainement, $exercices, "4", "12");
            $entrainements = $training->getEntrainements($idUser);

            // Afficher les entrainements de l'utilisateur
            require './vues/vueEntrainements.php';
        } else {
            // L'utilisateur clique sur un entrainement
            if (isset($_GET['idWorkout'])) {
                $idWorkout = intval($_GET['idWorkout']);
                if ($idWorkout != 0) {
                    $entrainement = $training->getEntrainement($idWorkout);
                    
                } else {
                    throw new Exception("Identifiant d'entrainement non valide");
                }
            } else {
                $msgErreur = FALSE;
                require './vues/vueLogin.php';  // action par défaut
            }
        }
    }
} catch (Exception $e) {
    $msgErreur = TRUE;
    require './vues/vueLogin.php';
}