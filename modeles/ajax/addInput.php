<?php session_start(); ?>
<?php $groupesMusculaires = $_SESSION['groupesMusculaires']; ?>

<?php if (isset($_SESSION['nbInput'])): ?>

    <?php $_SESSION['nbInput'] ++; ?>
    <?php $nb = $_SESSION['nbInput']; ?>

    <?php $idGm = "gm" . $nb; ?>
    <?php $idEx = "exercice" . $nb; ?>
    <?php $nbSerie = "nbSerie" . $nb ?>
    <?php $nbRep = "nbRep" . $nb ?>

    <div class="panel panel-default panel-dropdown">
        <div class="panel-heading">
            <h3 class="panel-title">
                <?= "Exercice " . $nb ?> 
            </h3>
        </div>
        <div class="panel-body">
            <div class='form-group'>
                <label for='gm'>Groupe musculaire</label>

                <select class='form-control' name='<?= $idGm ?>' id="<?= $idGm ?>" onchange="fetch_select(this.id, this.value);">

                    <?php foreach ($groupesMusculaires as $muscle) : ?> 
                        <option value='<?= $muscle['idGm'] ?>'>
                            <?= $muscle['nomGm'] ?>
                        </option> 
                    <?php endforeach; ?>

                </select>
                <label for='gm'>Exercice</label>
                <select class='form-control' name='<?= $idEx ?>' id="<?= $idEx ?>"></select>
                <div class="input-group">
                    <span class="input-group-addon">Séries</span>
                    <input type="text" clasS="form-control" name="<?= $nbSerie ?>" id="<?= $nbSerie ?>" value="4">
                </div>
                <div class="input-group">
                    <span class="input-group-addon">Répétitions</span>
                    <input type="text" clasS="form-control" name="<?= $nbRep ?>" id="<?= $nbRep ?>" value="12">
                </div>
                <label id="nbRep_error<?=$nb?>" class="help-block text-danger"></label>
            </div>
        </div>
    </div>

<?php endif; ?>

