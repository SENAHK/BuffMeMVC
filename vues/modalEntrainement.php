<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Ajouter un entrainement</h4>
            </div>
            <div class="modal-body">
                <form id="formAjout" action='' method='post'>
                    <div id="formWithoutSubmit">
                        <div class="form-group">

                            <label for="user">Nom de l'entrainement</label>

                            <input type="text" class="form-control" name='nomEntrainement' id="user">
                        </div>

                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea class="form-control" id='desc' name='descEntrainement' rows="3"></textarea>
                        </div>
                        <div class="panel panel-default panel-dropdown">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    Exercice 1
                                </h3>
                            </div>
                            <div class="panel-body">
                                <div class='form-group'>
                                    <label for='gm'>Groupe musculaire</label>

                                    <select class='form-control' name='gm1' id="gm1" onchange="fetch_select(this.id, this.value)">
                                        <?php foreach ($groupesMusculaires as $muscle) : ?> 
                                            <option value='<?= $muscle['idGm'] ?>'>
                                                <?= $muscle['nomGm'] ?>
                                            </option> 
                                        <?php endforeach; ?>
                                    </select>
                                    <label for='gm'>Exercice</label>
                                    <select class='form-control' name="exercice1" id="exercice1"></select>
                                    <br>
                                    <div id="ex"
                                    <div class="input-group">
                                        <span class="input-group-addon">Séries</span>
                                        <input type="text" clasS="form-control" name="nbSerie1" id="nbSerie1" value="4">
                                        <br>
                                    </div>
                                    <label id="nbSerie_error1" class="help-block text-danger"></label>
                                    
                                    <div class="input-group">
                                        <span class="input-group-addon">Répétitions</span>
                                        <input type="text" clasS="form-control" name="nbRep1" id="nbRep1" value="12">
                                        <br>
                                    </div>
                                    <label id="nbRep_error1" class="help-block text-danger"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <button type="button" class="btn btn-default btn-lg" onclick="addInput(<?= $_SESSION['nbInput']; ?>);">
                        Ajouter un exercice <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                    </button>
                    <p></p>
                    <button type="submit" name='btnAjoutEntrainement' class="btn btn-default">Valider</button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>