<?php
$titre = "Exercices";
ob_start();
?>







<?php
$contenu = ob_get_clean();

require './vues/template.php';
?>

