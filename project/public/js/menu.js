// menu
$(document).ready(function () {
    var a = $(".parent-menu");
    var b = $(".sub-menu");
    a.each((i, e) => {
        $(e).click(function () {
            if ($(e).hasClass("on")){
                $(b[i]).slideUp();
                $(e).find(".left").removeClass("d-none");
                $(e).find(".down").addClass("d-none");
                $(e).removeClass("on");
            }
            else {
                $(b[i]).slideDown();
                $(e).find(".down").removeClass("d-none");
                $(e).find(".left").addClass("d-none");
                $(e).addClass("on");
            }
                 
        })
    });
});
