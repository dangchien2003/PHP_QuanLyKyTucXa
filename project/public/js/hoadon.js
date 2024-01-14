$(document).ready(function() {
    if($('#ngaychot').val() == "") {
        getdatenow();
    }
    findTT();

    findInputChange($("#fillter_t"), 't');
    findInputChange($("#ngaychot"), 'ngaychot');
    findInputChange($("#find_MP"), 'mp');
})

function findInputChange(input, key) {
    $(input).on('change', function() {
        var value = $(input).val();
        addParams(key, value);
        location.reload();
    })
}

function findTT() {
    $('.tt').each((index, element) => {
        $(element).click(() => {
            var tinhtrang = 0;
            switch (index) {
                case 1:
                    tinhtrang = 5;
                    break;
                case 2:
                    tinhtrang = 6;
                    break;
                default: tinhtrang = 0;
            }
            addParams("tt", tinhtrang);
            location.reload();
        })
    })
}

function getdatenow() {
    var today = new Date();
    $("#ngaychot").val(today.toISOString().split('T')[0]); 
}