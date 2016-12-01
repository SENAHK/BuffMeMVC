<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="index.php" class="active">Entrainements <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Exercices</a></li>
                <li><a href="#">Muscles</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-md-10 main">
            <table class="table table-hover">
                <thead>
                    <tr><th>No</th><th>Nom</th><th>Séries</th><th>Répétitions</th></tr>
                </thead>
                <tbody>
                    <?php $cpt = 1; ?>
                    <?php foreach ($entrainement as $exercice): ?>
                        <tr>
                            <td><?= $cpt++; ?></td>
                            <td><?= $exercice['nomExercice'] ?></td>
                            <td><?= $exercice['nbSerie'] ?></td>
                            <td><?= $exercice['nbRep'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $contenu = ob_get_clean(); ?>
<?php require './vues/template.php'; ?>