$(document).ready(function() {

    //ABRIR MODAL
    $(".open_modal").click(function () {
        $(".modal").fadeIn(400);
        $(".modal").css("display", "flex");
    });
    //FECHA MODAL
    $(".modal-close").click(function () {
        $(".modal").fadeOut(400);
    });

    //INTERVALO DE TEMPO - MODAIS
    setInterval(function () {
        $(".modal").fadeOut(1000);
    }, 5000);

    //MOSTRA A SENHA
    $( "#showPass" ).mousedown(function() {
        $("#login_password").attr("type", "text");
    });

    $( "#showPass" ).mouseup(function() {
        $("#login_password").attr("type", "password");
    });

});