<?php
/* 
 * RAMUSI Michael - CFPT
 * 2016-2017
 * BuffMeMVC
 */

/**
 * validerEnvoi permet de vérifier que les données envoyées ne sont pas vides
 * @param string $input est la valeur d'un filter_input
 * @return boolean
 */
function validerEnvoi($input) {
    if ($input != null && $input != false) {
        if ($input == "") {
            return false;
        } else {
            return true;
        }
    }
}

/**
 * createArrayOfPostValues trouve les champs post qui possèdent un préfixe spécifié
 * @param type $postValue est la sous-chaine à chercher
 * @return array tableau contenant les champs trouvés
 */
function createArrayOfPostValues($postValue) {
    $array = array();
    foreach ($_POST as $key => $value) {
        if (strpos($key, $postValue) !== false) {
            array_push($array, $value);
        }
    }
    return $array;
}
