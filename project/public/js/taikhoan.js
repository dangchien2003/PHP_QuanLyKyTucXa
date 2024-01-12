


$(document).ready(function() {
    var all_user = $(".user");
    var btn_qmk = $(".quenmk");

    btn_qmk.each(function(index, element) {
        $(element).click(() => {
            var user = $(all_user[index]).text().trim();
            // Tạo FormData object và thêm dữ liệu hình ảnh vào
            const formData = new FormData();
            formData.append("user", user); 
            // Gửi dữ liệu ảnh đến server bằng XMLHttpRequest
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../../src/handle/quenmk.php"); // Thay 'upload.php' bằng đường dẫn đến tệp PHP xử lý dữ liệu
            xhr.onload = function () {
                if (xhr.status === 200) {
                    // kết quả trả về và giải mã chuỗi json
                    res = JSON.parse(xhr.responseText);
                    switch (res.status) {
                        case 200:
                            toastSuccess("Lấy lại thành công");
                            var mk = $("#body_table").find('tr').eq(index).find(".mk").text(res.message);
                            break;
                        case 505:
                            toastError(res.message);
                            break;
                        case res.status >= 500:
                            toastError(res.message);
                            break;
                        default:
                            toastInfo(res.message);
                    }
                } else {
                    toastError("Có lỗi xảy ra khi gửi dữ liệu.");
                }
            };
            xhr.send(formData);
        })
    })

});