//particlesJS();
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