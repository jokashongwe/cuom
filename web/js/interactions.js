/**
 * Created by ramseytiger on 12/21/16.
 */

$(function () {
$(".loading").hide();
    
var $inp=$("#motcle");
$inp.focus();
    var txtclient=$('input[name=recherche]');
$inp.keyup(function(event){
    $('#mesitems').show().html('');
    $(".loading").show();
    var motcle = $(this).val();
    var DONNEE = 'recherche=' + txtclient.val();
    $.ajax({
        type: "POST",
        dataType:'json',
        url: Routing.generate('medecin_recherche'),
        data: DONNEE,
        cache: false,
        minLength: 1,
        beforeSend: function () {
            $('#mesitems').find('li').remove();
        },
        success: function(data) {


            $.each(data.items, function(index,value) {
                //$("#ott").text(value.libelle+'<br/>'+value.Prix);
                var nophoto="../uploads/photos_medecins/"+value.photo+"";
                var lien=Routing.generate('medecin_afficher',{ id:value.id });
                $('#mesitems').prepend(' <li><div class="panel panel-success"><div class="panel-body"><div class="col-md-4"><img src='+nophoto +' width="30px" height="30px"/></div><div class="col-md-8"></div><ul class="list-unstyled"><li><strong>Nom</strong> : '+value.nom+' '+value.postnom+''+value.prenom+'</li> <li><strong>Specialités :</strong> '+value.specialites+'</li> <li><strong>Hopital :</strong> '+value.hopital+'</li> <li><strong>Annee :</strong> '+value.annee+'</li> </ul> </div> </div> </div></li>');

                    //$('#resultats').html('<div>'+value.libelle+'</div>');
                //alert(value.libelle);
            });

            $(".loading").hide();
        }
    });
    return false;
});
});
