/* 
 * RAMUSI Michael - CFPT
 * 2016-2017
 * BuffMeMVC
 */

// Quand le document HTML est chargé
$(document).ready(function () {

    // Lors du submit du login
    $('#formLogin').on('submit', function (e) {

        //___ Validation username ___
        var username = $('#user');
        // Check si une valeur est entrée
        if (!username.val()) {
            // Ajoute un visuel d'erreur
            username.closest('.form-group').removeClass('has-success').addClass('has-error');

            // Stop l'envoi du formulaire
            e.preventDefault();
        } else {
            username.closest('.form-group').removeClass('has-error').addClass('has-success');
        }

    });

    //Lors du submit de l'ajout d'un entrainement
    $('#formAjout').on('submit', function (e) {        
        var nomEntrainement = $('#nomEntrainement');        
        if (!nomEntrainement.val()) {
            // Ajoute un visuel d'erreur
            username.closest('.form-group').removeClass('has-success').addClass('has-error');

            // Stop l'envoi du formulaire
            e.preventDefault();
        }       
        
        validerChampsNombre(['#nbSerie', '#nbRep'], e);
    });

});
/**
 * validerChampsNombre permet de vérifier que le tableau de input html spécifié
 * en paramètre contient bien des nombres
 * @param {array} prefixes tableau d'inputs html au format jQuery (ex: #monChamp)
 * @param {type} e l'évenement par défaut de la fonction submit jQuery
 * @returns {undefined}
 */
function validerChampsNombre(prefixes, e) {
    var id = 1;

    while (true) {
        var champs = [];
        var selector = "";

        // Créer un tableau de sélecteur jQuery avec le tableau des id html
        for (i = 0; i < prefixes.length; i++) {
            selector = $(prefixes[i] + id);
            champs.push(selector);
        }

        // Si l'élement existe
        if (champs[0].length) {
            // Pour chaque élément du tableau
            for (i = 0; i < champs.length; i++) {
                champ = champs[i];

                // Si le texte du input html n'est pas un nombre
                if (isNaN(champ.val())) {
                    // Ajouter des messages d'erreur aux element html bootstrap
                    champ.closest('.input-group').addClass('has-error');
                    champ.removeClass('has-success').addClass('has-error');
                    champ.parent().next().text('entrez un chiffre !');

                    // Empecher l'evenement e d'envoyer le formulaire au serveur
                    e.preventDefault();
                } else {
                    // Supprimez les messages d'erreurs
                    champ.closest('.input-group').removeClass('has-error');
                    champ.removeClass('has-error');
                    champ.parent().next().text('');
                }
            }
            id++;
        } else {
            break;
        }
    }
}

/**
 * fetch_select permet de mettre à jour le select des exercices suivant le select
 * du groupe musculaire sélectionné
 * @param {type} idSelect est l'id html du select
 * @param {type} val est la valeur de l'option du select
 * @returns {undefined}
 */
function fetch_select(idSelect, val)
{
    $.ajax({
        type: 'get',
        url: './modeles/ajax/getExercices.php',
        data: {
            get_option: val
        },
        success: function (response) {
            // Retirer les deux premiers caractères
            var id = idSelect.substring(1).substring(1);
            $('#exercice' + id).html(response);
        }
    });
}
/**
 * addInput permet l'ajout dynamique des elements html permettant d'entrer
 * des exercices à un entrainement
 * @param {type} val
 * @returns {undefined}
 */
function addInput(val) {
    $.ajax({
        type: 'get',
        url: './modeles/ajax/addInput.php',
        success: function (response) {
            $('#formWithoutSubmit').append(response);
        }
    });
}

