<?php

require_once './modeles/Utilisateur.php';
require_once './modeles/Entrainement.php';
require_once './modeles/Exercice.php';
require_once './modeles/groupeMusculaire.php';
require_once './libs.php';
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
            throw new Exception("Identifiants non valides !");
        }
    } else {
        // Formulaire d'ajout d'un entrainement
        if (isset($_REQUEST['btnAjoutEntrainement'])) {
            $idUser = array_keys($_SESSION['user'])[0];
            $nomEntrainement = filter_input(INPUT_POST, 'nomEntrainement', FILTER_SANITIZE_SPECIAL_CHARS);
            $descEntrainement = filter_input(INPUT_POST, 'descEntrainement', FILTER_SANITIZE_SPECIAL_CHARS);
            $exercices;

//            foreach ($_REQUEST as $key => $value) {
//                if (strpos($key, "exercice") !== false) {
//                    array_push($exercices, $value);
//                }
//            }

            $exercices = createArrayOfPostValues("exercice");
            $repetitions = createArrayOfPostValues("nbRep");
            $series = createArrayOfPostValues("nbSerie");

            $tempArray = array();

            for ($x = 0; $x < count($exercices); $x++) {

                array_push($tempArray, array($exercices[$x] => array("nbRep" => $repetitions[$x], "nbSerie" => $series[$x])));
            }

            foreach ($tempArray as $value) {
                foreach ($value as $val) {
                    print_r($val['nbRep']);
                    print "<br>";
                }
            }

            //var_dump($idExercice);
            $training->insertEntrainement($idUser, $nomEntrainement, $descEntrainement, $tempArray);
            $entrainements = $training->getEntrainements($idUser);
            // Afficher les entrainements de l'utilisateur
            require './vues/vueEntrainements.php';
        } else {
            // L'utilisateur clique sur un entrainement
            if (isset($_GET['idWorkout'])) {
                $idWorkout = intval($_GET['idWorkout']);
                if ($idWorkout != 0) {
                    $entrainement = $training->getEntrainement($idWorkout);
                    var_dump($entrainement);
                    require './vues/vueEntrainement.php';
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