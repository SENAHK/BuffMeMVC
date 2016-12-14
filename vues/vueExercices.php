<?php
$titre = "Exercices";
//ob_start();
?>

<?php foreach ($exercices as $exercice): ?>
    <?php extract($exercice); ?>
    <div class="panel panel-primary">
        <div class="panel-heading"> <?= $nomGm; ?> </div>
        <div class="panel-body"> <?= $nomExercice; ?></div>
    </div>

<?php endforeach; ?>

<?php
//$contenu = ob_get_clean();
//require './vues/template.php';
?>

