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

    let clicked = false;

    $('#nho').click(function() {
        if (!clicked) {
            $(this).prop('checked', true);
            clicked = true;
        }else {
            $(this).prop('checked', false);
            clicked = false;
        }
    });
})