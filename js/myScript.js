$(function () {
    // Lors du submit de l'ajout d'un entrainement
    $('#formLogin').on('submit', function (e) {

        //___ Validation username ___
        var username = $('#user');
        // Check si une valeur est entrée
        if (!username.val()) {
            // Ajoute un avertissement visuel d'erreur
            username.closest('.form-group').removeClass('has-success').addClass('has-error');

            // Stop l'envoi du formulaire
            e.preventDefault();
        } else {
            username.closest('.form-group').removeClass('has-error').addClass('has-success');
        }

    });

    //___Validation formulaire d'ajout d'un entrainement___
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

//            if (nbRep.length) {

                // Si l'utilisateur entre autre chose qu'un nombre
//                if (isNaN(nbRep.val())) {
//                    nbRep.closest('.input-group').addClass('has-error');
//                    nbRep.removeClass('has-success').addClass('has-error');
//                    $('#nbRep_error' + id).text('Entrez un chiffre !');
//                     e.preventDefault();
//                } else {
//                    nbRep.closest('.input-group').removeClass('has-error');
//                    nbRep.removeClass('has-error');
//                    $('#nbRep_error' + id).text('');
//                }
//                
//                if (isNaN(nbSerie.val())) {
//                    nbSerie.closest('.input-group').addClass('has-error');
//                    nbSerie.removeClass('has-success').addClass('has-error');
//                    $('#nbSerie_error' + id).text('Entrez un chiffre !');
//                     e.preventDefault();
//                } else {
//                    nbSerie.closest('.input-group').removeClass('has-error');
//                    nbSerie.removeClass('has-error');
//                    $('#nbSerie_error' + id).text('');
//                }
//                id++;


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

