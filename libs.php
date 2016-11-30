<?php

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