// Quand le document HTML est chargé
$(function () {
    
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

        var nbRep = $('#nbRep');
        var nbSerie = $('#nbSerie');

        var flag = true;
        var id = 1;

        while (flag) {
            nbRep = $('#nbRep' + id);
            nbSerie = $('#nbSerie' + id);
            var champs = [nbRep, nbSerie];

            // Si l'élement existe
            if (champs[0].length) {
                for (i = 0; i < champs.length; i++) {
                    // Si l'utilisateur entre autre chose qu'un nombre
                    champ = champs[i];
                    if (isNaN(champ.val())) {
                        champ.closest('.input-group').addClass('has-error');
                        champ.removeClass('has-success').addClass('has-error');
                        champ.parent().next().text('entrez un chiffre !');
                        e.preventDefault();
                    } else {
                        champ.closest('.input-group').removeClass('has-error');
                        champ.removeClass('has-error');
                        champ.parent().next().text('');
                    }
                }
                id++;
            } else {
                flag = false;
            }
        }
    });

});

function fetch_select(nom, val)
{
    $.ajax({
        type: 'get',
        url: './modeles/ajax/getExercices.php',
        data: {
            get_option: val
        },
        success: function (response) {
            // Retirer les deux premiers caractères
            var id = nom.substring(1).substring(1);
            $('#exercice' + id).html(response);
        }
    });
}

function addInput(val) {
    $.ajax({
        type: 'get',
        url: './modeles/ajax/addInput.php',
        success: function (response) {
            $('#formWithoutSubmit').append(response);
        }
    });
}

