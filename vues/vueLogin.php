<?php $titre = "Accueil"; ?>
<?php
if ($msgErreur) {
    $class = "has-error";
} else {
    $class = "";
}
?>
<?php ob_start(); ?>

<div class="container">
    <div class="row">                
        <div class="col-sm-4 col-sm-offset-2 menu">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
        </div>                 
        <div class="col-sm-4 menu">
            <form id="formLogin" action='' method='post'>
                <div class="form-group <?= $class ?>">
                    <label for="user">Nom d'utilisateur</label>
                    <input type="text" class="form-control <?= $class ?>" name='username' id="user" value="admin">
                </div>

                <div class="form-group <?= $class ?>">
                    <label for="pass">Mot de passe</label>
                    <input type="password" class="form-control <?= $class ?>" id="pass" name='password' value="Super">

                    <?php if ($msgErreur): ?>
                        <div style="color: #a94442;">Identfiants erronés</div>
                    <?php endif; ?>

                    <button type="submit" name='submit' class="btn btn-default">Buff me !</button>
                </div>
            </form>

        </div> 
    </div>
</div>
<?php $contenu = ob_get_clean(); ?>
<?php
require './vues/template.php';
