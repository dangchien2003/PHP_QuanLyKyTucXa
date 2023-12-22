$(document).ready(function() {
    $(".bi-eye-slash-fill").hide();
    $(".bi-eye-fill").click(function() {
        $(".bi-eye-fill").hide();
        $(".bi-eye-slash-fill").fadeIn();
        $("#pass-input").attr('type', "text");
    })
    $(".bi-eye-slash-fill").click(function() {
        $(".bi-eye-fill").fadeIn();
        $(".bi-eye-slash-fill").hide();
        $("#pass-input").attr('type', "password");
    })
    
})