
//gestion preview image

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#previewIMG').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
;
$("#inputImage").change(function () {
    readURL(this);
    // document.getElementById("uploadFile").value = this.value;
});
// gestion du plugin datedropper
/*
 $(".mydate").dateDropper({
 lang: 'fr',
 animate: true,
 format: 'd-m-Y'
 });
 */
$(".mytime").timeDropper({
    format: 'HH:mm',
    setCurrentTime: false
});
/////////////////////////////////////////////////
var $suivielt = $('.suivielt');
$(document).ready(function () {

// gestion ajax info 
    var sfFunction = {
        single: function (Url, callback) {

// erreur gestion 
            var myFailure = function (error) {
                console.log("Erreur lors d'envoi" + error);
            };
            // succes gestion 
            var mySuccess = function (json) {
                callback(json);
            };
            sfFunction.singleValue(Url, mySuccess, myFailure);
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
    $(document.body).on('change', '.suivielt', function () {
        var $this = $(this);
        var idElement = $this.prop('id');
        //idElementCible = '#' + idElement + " option:selected";
        idElementCible = $this.find("option:selected");
        $valSelected = $(idElementCible).val();
        if (idElement === '' || $valSelected === '') {
            return null;
        }
        var Url = Routing.generate('objects_loader', {'idelement': idElement, 'valselected': $valSelected});
        sfFunction.single(Url, statementLoader);
        console.log(Url);
    });
});
function showload() {
    var $loader = '<i class="fa fa-spinner fa-spin" style="color:#3c763d;"></i>';
    hideload(); // on vide le champs
    $('.loader').append($loader);
}

function statementLoader(data) {
    var key = data['key'];
    var realdata = data['value'];
    console.log(typeof (realdata));
    if (key === "villekey") {
        $('#garekey').empty();
        if (typeof (realdata) != "undefined") {
            $.each(realdata, function (index, value) {
                $('#garekey').append('<option value="' + index + '">' + value + '</option>');
            });
        }
    } else if (key === "vehiculekey") {
        if (typeof (realdata) === "number") {
            $('#placedispokey').val(realdata);
        } else {
            $('#placedispokey').val('');
        }
    } else if (key === "villedepartkey") {
        $('#villearriveekey').empty();
        if (typeof (realdata) != "undefined") {
            $.each(realdata, function (index, value) {
                $('#villearriveekey').append('<option value="' + index + '">' + value + '</option>');
            });
        }
        $('#villearriveekey').selectpicker('refresh');
    } else {
        console.log(key);
    }
}


