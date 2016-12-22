<?php

/*
 * RAMUSI Michael - CFPT
 * 2016-2017
 * BuffMeMVC
 */
session_start();

require_once './modeles/Utilisateur.php';
require_once './modeles/Entrainement.php';
require_once './modeles/Exercice.php';
require_once './modeles/groupeMusculaire.php';
require_once './modeles/libs.php';

// Initialisation des objets
$user = new Utilisateur();
$exo = new Exercice();
$training = new Entrainement();
$gm = new groupeMusculaire();

// Variable globale
$_SESSION['nbInput'] = 1;

try {
    // L'utilisateur n'est pas connecté
    if (!isset($_SESSION['user'])) {
        // Formulaire de Login validé
        if (isset($_REQUEST['submit'])) {
            $username = $_REQUEST['username'];
            $password = sha1($_REQUEST['password']);
            // Cherche le nom de l'utilisateur dans la BD
            $nomUtilisateur = $user->validerLogin($username, $password)[0];
            
            // Si l'utilisateur existe
            if (is_string($nomUtilisateur)) {
                $idUser = $user->getIdUser($nomUtilisateur)[0];
                $_SESSION['user'] = array();
                
                // Garder dans la session les infos utilisateurs                
                $_SESSION['user']['idUser'] = $idUser;
                $_SESSION['user']['nomUtilisateur'] = $nomUtilisateur;
                
                // Chercher les entrainements de l'utilisateur dans la bd
                $entrainements = $training->getEntrainements($idUser);
                
                // Garde en mémoire la liste des groupes musculaires
                $_SESSION['groupesMusculaires'] = $gm->getGroupesMusculaires();
                
                // Afficher les entrainements de l'utilisateur
                require './vues/vueEntrainements.php';
            } else {
                // Les logins sont faux
                throw new Exception("Identifiants non valides !");
            }
        } else {
            // Le login n'a pas encore été envoyé (page par défaut au démarrage du site)
            $msgErreur = FALSE;
            require './vues/vueLogin.php';    
        }
    } else {
        // Si l'utilisateur a appuyé sur "exercices"
        if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'exercices') {
            $muscles = $gm->getGroupesMusculaires();
            // Fonction PHP d'initialisation de temporisation de sortie
            ob_start();
            // Classe les exercices de la BD par groupes musculaires
            foreach ($muscles as $muscle) {
                extract($muscle);
                $exercices = $exo->getExercicesByGm($idGm);
                // Affiche l'exercice et le muscle ciblé
                require './vues/vueExercices.php';
            }
            // Récupère le contenu de la temporisation
            $contenu = ob_get_clean();
            
            // Affiche le contenu
            require './vues/template.php';
        } else {
            // L'utilisateur a selectionné un entrainement
            if (isset($_GET['idWorkout'])) {
                $idWorkout = intval($_GET['idWorkout']);
                // Si l'entrainement est valide
                if ($idWorkout != 0) {
                    // Cherche l'entrainement
                    $entrainement = $training->getEntrainement($idWorkout);
                    require './vues/vueEntrainement.php';
                } else {
                    
                }
            } else {
                // Formulaire d'ajout d'un entrainement
                if (isset($_REQUEST['btnAjoutEntrainement'])) {                    
                    $idUser = $_SESSION['user']['idUser'];
                    
                    // Données saisies par l'utilisateur 
                    $nomEntrainement = filter_input(INPUT_POST, 'nomEntrainement', FILTER_SANITIZE_SPECIAL_CHARS);
                    $descEntrainement = filter_input(INPUT_POST, 'descEntrainement', FILTER_SANITIZE_SPECIAL_CHARS);

                    // Créer des tableaux contenant les données des champs dynamiques
                    $exercices = createArrayOfPostValues("exercice");
                    $repetitions = createArrayOfPostValues("nbRep");
                    $series = createArrayOfPostValues("nbSerie");
                    
                    
                    $tempArray = array();
                    // Rassemble les données des champs dynamiques dans un tableau associatif
                    for ($x = 0; $x < count($exercices); $x++) {
                        array_push($tempArray, array($exercices[$x] => array("nbRep" => $repetitions[$x], "nbSerie" => $series[$x])));
                    }
                    // Insertion d'un entrainement dans la BD
                    $training->insertEntrainement($idUser, $nomEntrainement, $descEntrainement, $tempArray);
                    
                    $training = new Entrainement();
                    // Affiche les entrainements
                    $entrainements = $training->getEntrainements($idUser);
                }

                // Afficher les entrainements de l'utilisateur
                $idUser = $_SESSION['user']['idUser'];
                $nomUtilisateur = $_SESSION['user']['nomUtilisateur'];
                $entrainements = $training->getEntrainements($idUser);
                $groupesMusculaires = $gm->getGroupesMusculaires();
                $_SESSION['groupesMusculaires'] = $groupesMusculaires;
                require './vues/vueEntrainements.php';
            }
        }
    }
} catch (Exception $e) {
    // Exception trouvé: mauvais login
    $msgErreur = TRUE;
    require './vues/vueLogin.php';
}
