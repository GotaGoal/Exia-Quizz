//particlesJS();
var compteur_point = 0;
function augmentediv() {
    var a = 0;
    var id = setInterval(incrementeA, 15);
    function incrementeA() {
        if (a == 60) {
            $('#bouton-demarrage').css("display","none");


            clearInterval(id);
            var b = 60;
            var idb = setInterval(incrementeB,15);
            function incrementeB()
            {
                if(b == -10)
                {
                    clearInterval(idb);
                    $('#page-accueil').remove();
                    $('.container-question').addClass('active');
                    $('#particles-js').css("background-color", "rgb(41,204,39");
                    $('#q').css("background-color", "rgb(41,204,39");
                    $('#submit_on').css("background-color", "rgb(41,204,39");


                }
                else {
                    $('#div-top').css("height",b+"%");
                    $('#div-bottom').css("height",b+"%");
                    b--;
                }
            }
        } else {
            $('#div-top').css("height",a+"%");
            $('#div-bottom').css("height",a+"%");
            a++;
        }

    }







}

function next(id,reponse,question_id)
{
    if(id == reponse)
    {
        compteur_point ++;
    }


    //$('#'+question_id+'question').css('display','none');
    $('#'+question_id+'question').remove();

    var tmp = question_id + 1;
    $('#'+tmp+'question').css('display','block');

    if(question_id <4)
    {
        $('#particles-js').css("background-color", "rgb(41,204,39");
        $('#q').css("background-color", "rgb(41,204,39");
        $('#submit_on').css("background-color", "rgb(41,204,39");
    }
    else if(question_id>3 && question_id<9)
    {
        $('#particles-js').css("background-color", "rgb(219,111,30");
        $('#q').css("background-color", "rgb(219,111,30");
        $('#submit_on').css("background-color", "rgb(219,111,30");
    }
    else if(question_id>8)
    {
        $('#particles-js').css("background-color", "rgb(255,36,0");
        $('#q').css("background-color", "rgb(255,36,0");
        $('#submit_on').css("background-color", "rgb(255,36,0");

    }

    if(question_id == 14)
    {
        $('#affiche_result').css('display','block');
        $('#affichage_score').text(compteur_point);

        if(compteur_point >10)
        {
            $('#affiche_commentaire').text('Vous avez remporté un tapis de souris !')
            $('#sub_com').text('Vous êtes prêt à intégrer l\'Exia !')
        }
        else
        {
            $('#affiche_commentaire').text('Malheureusement vous n\'avez pas marqué assez de points pour remporter notre cadeau. :(');
            $('#sub_com').text('Ne vous inquiétez pas l\'Exia vous apportera toutes ces connaissances :)');
        }

    }


}