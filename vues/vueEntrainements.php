<?php $titre = "Entrainements" ?>
<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#" class="active">Entrainements <span class="sr-only">(current)</span></a></li>
                <li><a href="?action=exercices">Exercices</a></li>
                <li><a href="#">Muscles</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-md-10 main">
            <table class="table table-hover">
                <thead>
                    <tr><th>No</th><th>Nom</th><th>Description</th></tr>
                </thead>
                <tbody>
                    <?php $cpt = 1; ?>
                    <?php foreach ($entrainements as $entrainement): ?>
                        <tr>
                            <td><?= $cpt++; ?></td>
                            <td>
                                <a href="<?= "index.php?idWorkout=" . $entrainement['idEntrainement'] ?>">
                                    <?= $entrainement['nomEntrainement'] ?>
                                </a>
                            </td>
                            <td><?= $entrainement['descriptionEntrainement'] ?></td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <?php require_once 'modalEntrainement.php'; ?>

        </div>
    </div>
</div>
<div class='navbar-fixed-bottom'>
    <div class='container-fluid pull-right'>
        <a data-toggle="modal" data-target="#myModal"><img src='images/addBtn.png' width='100'style='padding-right: 20px;'>
        </a>
    </div>
</div>
<?php $contenu = ob_get_clean(); ?>

<?php require './vues/template.php'; ?>