var $validationid = $('.validationid');
var $idVoyage = 0;
var $idvalSelected = 1;
$(document).ready(function () {

// gestion ajax info 

    var safricFunction = {
        single: function (route, Id, callback) {
            if (route === '' || Id === '' || Id <= 0) {
                return null;
            }
            var Url = Routing.generate(route, {'id': Id});

            // erreur gestion 
            var myFailure = function (error) {
                console.log("Erreur lors d'envoi" + error);
                hideloader();
            };
            // succes gestion 
            var mySuccess = function (json) {
                hideloader();
                callback(json);
            };
            safricFunction.singleValue(Url, mySuccess, myFailure);
        },
        singleValue: function (UrlFormRoute, onSuccess, onFailure) {
            $.ajax({
                type: 'GET',
                url: UrlFormRoute,
                dataType: 'json',
                success: onSuccess,
                error: onFailure
            });
        }
    };
    $validationid.on('click', function () {
        //Get id value on click With :$(this).prop('id')
        showloader();
        $idVoyage = $(this).prop('id');
        safricFunction.single('voyage_show_ajax', $idVoyage, statementOfVChoice);
    });

    $(document.body).on('change', '#selectid', function () {
        var $this = $(this);
        var idElement = $this.attr('id');
        //idElementCible = '#' + idElement + " option:selected";
        idElementCible = $this.find("option:selected");
        
        $valSelected = $(idElementCible).val();
        var UrlPayment = Routing.generate('transaction_new', {'voyage': $idVoyage, 'nbrepay': $valSelected});
        $("#UrlPaymentId").attr('href', UrlPayment);
        console.log(UrlPayment);
    });

});
function showloader() {
    var $loader = '<h4>Patientez un instant...</h4><div class="loader center"><i class="fa fa-3x fa-spinner fa-spin" style="color:#3c763d;"></i></div>';
    hideloader(); // on vide le champs
    $('.load').append($loader);
    //$(".loader").fadeTo(100, 0.6);
}

function hideloader() {
    // $(".loader").fadeOut(100, function () {
    $(".load").empty();
    // });
}


function statementOfVChoice(data) {
    var content = '<div class="row p20"><div class="col-sm-6"><h4>Choisissez le nombre de places:</h4></div><div class="col-sm-6" id="nbplaces"></div></div>';
    var nbre = data['places'];
    console.log(typeof (nbre));

    if (typeof (nbre) === "number" && nbre > 0) {
        $('.load').append(content);
        $('#nbplaces').append('<div class="input-group" id="inputgroupid"><select style="width:70px;" class="form-control pull-right" id="selectid"></select></div>');
        if (nbre <= 10) {
            for (i = 1; i <= nbre; i++) {
                console.log(i);
                $('#selectid').append('<option value="' + i + '">' + i + '</option>');
            }
        } else {
            for (i = 1; i <= 10; i++) {
                $('#selectid').append('<option value="' + i + '">' + i + '</option>');
            }
        }
        $('#inputgroupid').append('<span class="input-group-addon"> <label><b>/ ' + nbre + ' place(s) disponible(s)</b></label> </span>');
        var UrlPayment = Routing.generate('transaction_new', {'voyage': $idVoyage, 'nbrepay': 1});
        var contentend = '<div class="p10"><button type="button" class="btn btn-danger pull-left" data-dismiss="modal" aria-label="Close">ANNULER</button><a id="UrlPaymentId" class="btn btn-success pull-right" href="' + UrlPayment + '">CONFIRMER </a></div>';
        $('.load').append(contentend);
        console.log(UrlPayment);
    } else {
        $('.load').append('<h4>Choisir le nombre de places:</h4><span id="nbplaces"></span><div class="p10"><button type="button" class="btn btn-danger pull-left" data-dismiss="modal" aria-label="Close">ANNULER</button></div>');
        $('#nbplaces').append(nbre);
    }

}