<?php

session_start();

require_once './modeles/Utilisateur.php';
require_once './modeles/Entrainement.php';
require_once './modeles/Exercice.php';
require_once './modeles/groupeMusculaire.php';
require_once './libs.php';

$user = new Utilisateur();
$training = new Entrainement();
$gm = new groupeMusculaire();
$_SESSION['nbInput'] = 1;

try {
    // Formulaire de Login validé
    if (!isset($_SESSION['user'])) {
        if (isset($_REQUEST['submit'])) {
            $username = $_REQUEST['username'];
            $password = sha1($_REQUEST['password']);
            $nomUtilisateur = $user->validerLogin($username, $password)[0];

            if (is_string($nomUtilisateur)) {
                $idUser = $user->getIdUser($nomUtilisateur)[0];
                $_SESSION['user'] = array();
                array_push($_SESSION['user'], $idUser);
                array_push($_SESSION['user'], $nomUtilisateur);

                $entrainements = $training->getEntrainements($idUser);

                // Afficher les entrainements de l'utilisateur
                require './vues/vueEntrainements.php';
            } else {
                throw new Exception("Identifiants non valides !");
            }
        } else {
            $msgErreur = FALSE;
            require './vues/vueLogin.php';  // action par défaut  
        }
    } else {

        if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'exercices') {
            require './vues/vueExercices.php';
        } else {
            // Sélection d'un entrainement
            if (isset($_GET['idWorkout'])) {
                $idWorkout = intval($_GET['idWorkout']);
                if ($idWorkout != 0) {
                    $entrainement = $training->getEntrainement($idWorkout);
//                if (empty($entrainement)) {
//                    throw new Exception("Identifiant d'entrainement non valide");
//                }
                    require './vues/vueEntrainement.php';
                } else {
                    
                }
            } else {
                // Formulaire d'ajout d'un entrainement
                if (isset($_REQUEST['btnAjoutEntrainement'])) {
                    $idUser = array_keys($_SESSION['user'])[0];
                    $nomEntrainement = filter_input(INPUT_POST, 'nomEntrainement', FILTER_SANITIZE_SPECIAL_CHARS);
                    $descEntrainement = filter_input(INPUT_POST, 'descEntrainement', FILTER_SANITIZE_SPECIAL_CHARS);

                    $exercices = createArrayOfPostValues("exercice");
                    $repetitions = createArrayOfPostValues("nbRep");
                    $series = createArrayOfPostValues("nbSerie");

                    $tempArray = array();

                    for ($x = 0; $x < count($exercices); $x++) {
                        array_push($tempArray, array($exercices[$x] => array("nbRep" => $repetitions[$x], "nbSerie" => $series[$x])));
                    }

                    $training->insertEntrainement($idUser, $nomEntrainement, $descEntrainement, $tempArray);
                    $training = new Entrainement();
                    $entrainements = $training->getEntrainements($idUser);
                }
                // Affichage des entrainements
                $idUser = $_SESSION['user'][0];
                $nomUtilisateur = $_SESSION['user'][1];

                $entrainements = $training->getEntrainements($idUser);
                $groupesMusculaires = $gm->getGroupesMusculaires();
                $_SESSION['groupesMusculaires'] = $groupesMusculaires;
                // Afficher les entrainements de l'utilisateur
                require './vues/vueEntrainements.php';
            }
        }
    }
} catch (Exception $e) {
    $msgErreur = TRUE;
    require './vues/vueLogin.php';
}
