function augmentediv() {
    var elem = document.getElementById("myBar");
    var a = 0;
    var id = setInterval(frame, 15);
    function frame() {
        if (a == 60) {
            clearInterval(id);
        } else {
            $('#div-top').css("height",a+"%");
            $('#div-bottom').css("height",a+"%");
            a++;
        }
    }
}