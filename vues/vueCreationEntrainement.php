<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#" class="active">Entrainements <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Exercices</a></li>
                <li><a href="#">Muscles</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-md-10 main">
            <div class="form-group">
            <select onchange="fetch_select(this.value);" class="form-control" id="sel1">
                <option>Muscle</option>

                <?php foreach ($groupesMusculaires as $muscle) : ?> 
                    <option value='<?= $muscle['idGm'] ?>'>
                        <?= $muscle['nomGm'] ?>
                    </option> 
                <?php endforeach; ?>

            </select>
            <select id="new_select" class="form-control"></select>
            </div>
        </div>
    </div>
</div>

<?php $contenu = ob_get_clean(); ?>

<?php require './vues/template.php'; ?>