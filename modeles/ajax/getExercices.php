<?php

require_once '../Exercice.php';

if(isset($_GET['get_option']))
{
    var_dump($_GET['get_option']);
    $idGm = $_GET['get_option'];
    $exo = new Exercice();
    $exercices = $exo->getExercicesByGm($idGm);
    
    foreach ($exercices as $exercice) {
        $id = $exercice['idExercice'];
        $nom = $exercice['nomExercice'];
        echo "<option value='$id'>$nom</option>";
    }
}

