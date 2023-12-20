var video_status = false;
var checkCam = false;
var click_video = false;
let takePhoto = false;
let imgData = null;
let upload_file = false;
let edit_info = false;
$(document).ready(function () {
    $input_all = $("input"); 
    $select_all = $("select");
    // chỉ đọc
    function set_write_input(allow) {
        $input_all.each(function (index, element) {
            $(element).attr('type') == "radio"?$(element).prop("disabled", !allow):$(element).prop("readOnly", !allow);
        })
    
        $select_all.each(function (index, element) {
            $(element).prop("disabled", !allow);
        })
    }

    set_write_input(false);

    $("#upload").click(function () {
        let file = document.getElementById("inp_file");
        file.click();
        document.getElementById("inp_file").addEventListener("change", () => {
            if (file.files.length == 1) {
                cover_input_to_canvas();
            }
        });
    });
    
    // edit
    var btn_edit = $(".edit");
    btn_edit.each((index, element) => {
        $(element).click(function () {
            switch (index) {
                case 0:
                    alert("0");
                    break;
                case 1:
                    onVideo();
                    break;
                case 2:
                    if($(element).hasClass("no-write")) {
                        btn_save.eq(1).removeClass("d-none");
                        set_write_input(true);
                        $(element).removeClass("no-write");
                        $(element).find("i").addClass("show");
                        edit_info = true;
                    }else {
                        btn_save.eq(1).addClass("d-none");
                        set_write_input(false);
                        $(element).addClass("no-write");
                        $(element).find("i").removeClass("show");
                        edit_info = false;
                    }
                    break;
                default:
                    alert("khác");
            }
        });
    });

    //save
    var btn_save = $(".save");
    btn_save.each((index, element) => {
        $(element).click(function () {
            switch (index) {
                case 0:
                    // downloadImage();
                    sendImgToServer();
                    break;
                case 1:
                    if(edit_info) {
                        $("#form-info-sv").submit();
                    }else {
                        toastError("Chưa kích hoạt chỉnh sửa");
                    }
                    
                    break;
                case 2:
                    alert("2");
                    break;
                default:
                    alert("khác");
            }
        });
    });

    function click_takePhoto() {
        var btn_render = $("#render");
        btn_render.click(function () {
            showImg();
            takeSnapshot();
        });
    }

    click_takePhoto();
});

function showImg(){
    if (!video_status && !upload_file) {
        toastError("Mở camera");
    } else {
        $("#canvas").removeClass("d-none");
        // takeSnapshot();
    }
}

 function cover_input_to_canvas() {
    // Lấy file ảnh từ input
    const file = document.getElementById("inp_file").files[0];
    // Tạo đối tượng FileReader để đọc file ảnh
    const reader = new FileReader();

    reader.onload = function (event) {
        // Tạo một đối tượng hình ảnh mới
        const img = new Image();

        img.onload = function () {
            // Lấy context của canvas
            const canvas = document.getElementById('canvas');
            const ctx = canvas.getContext('2d');

            // Đặt kích thước canvas bằng kích thước của ảnh
            canvas.width = img.width;
            canvas.height = img.height;

            // Vẽ ảnh lên canvas
            ctx.drawImage(img, 0, 0);
        };

        // Thiết lập nguồn ảnh cho đối tượng hình ảnh
        img.src = event.target.result;
        takePhoto = true;
        upload_file=true;
        showImg();
    };

    // Đọc file ảnh như là một định dạng dữ liệu URL
    reader.readAsDataURL(file);
}

function onVideo() {
    if (!click_video) {
        $("#video").removeClass("d-none");
        $("#anhdaidien").addClass("d-none");
        click_video = true;
        camera();
        changeIcon();
    } else {
        $("#anhdaidien").removeClass("d-none");
        $("#video").addClass("d-none");
        click_video = false;
        stopCamera();
        changeIcon();
    }
}

function changeIcon() {
    if (click_video) {
        $(".bi-camera-video-fill").each(function () {
            $(this)
                .removeClass("bi-camera-video-fill")
                .addClass("bi-camera-video-off-fill");
        });
    } else {
        $(".bi-camera-video-off-fill").each(function () {
            $(this)
                .removeClass("bi-camera-video-off-fill")
                .addClass("bi-camera-video-fill");
        });
    }
}

let mediaStream = null;
let isVideoLoaded = false; // Cờ để xác định trạng thái của video

function camera() {
    const constraints = {
        video: {
            facingMode: "user",
            width: 1300,
            height: 1300,
            flipHorizontal: true,
        },
    };
    navigator.mediaDevices
        .getUserMedia(constraints)
        .then((stream) => {
            const video = document.getElementById("video");
            video.srcObject = stream;
            video.onloadedmetadata = () => {
                video.play();
                isVideoLoaded = true; // Cập nhật trạng thái đã tải video
            };
            mediaStream = stream; // Lưu trữ luồng video
            console.log("Kết nối với camera thành công.");
            video_status = true;
        })
        .catch((error) => {
            console.error("Không thể kết nối camera", error);
        });
}

function takeSnapshot() {
    const video = document.getElementById("video");

    // Chỉ chụp ảnh khi video đã được tải và phát
    if (isVideoLoaded && mediaStream) {
        const canvas = document.getElementById("canvas");
        const context = canvas.getContext("2d");

        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        const imgData = canvas.toDataURL("image/png");

        const img = new Image();
        img.src = imgData;

        img.onload = function () {
            context.clearRect(0, 0, canvas.width, canvas.height); // Xóa canvas để vẽ lại hình ảnh

            // Lật hình ảnh theo chiều ngang (hoặc dọc) trước khi vẽ lại lên canvas
            context.translate(canvas.width, 0);
            context.scale(-1, 1); // Lật theo chiều ngang

            context.drawImage(img, 0, 0, canvas.width, canvas.height); // Vẽ hình ảnh đã được lật lên canvas

            // Đoạn code còn lại tương tự như trước để hiển thị ảnh trong một phần tử khác
            canvas.toBlob(function (blob) {
                const imgUrl = URL.createObjectURL(blob);
                const imgElement = new Image();
                imgElement.src = imgUrl;
                canvas.appendChild(imgElement);
            });
        };

        canvas.innerHTML = "";
        canvas.appendChild(img);
        takePhoto = true;
    } else {
        console.log("Vui lòng đợi video được tải và phát trước khi chụp ảnh.");
    }
}

function stopCamera() {
    const video = document.getElementById("video");

    if (video.srcObject) {
        const tracks = video.srcObject.getVideoTracks(); // Lấy danh sách các track video của luồng media
        tracks.forEach((track) => {
            track.stop(); // Dừng mọi track video
        });
        video.srcObject = null; // Xóa đối tượng nguồn của video
        video_status = false;
        console.log("Ngắt kết nối với camera.");
    } else {
        console.log("Không có kết nối camera nào đang chạy.");
    }
}

function downloadImage() {
    if (!takePhoto) {
        toastError("Chưa chụp ảnh");
        return;
    }
    const canvas = document.getElementById("canvas");
    const link = document.createElement("a");
    link.href = canvas.toDataURL("image/png");
    // link.href = './images/captured_image.png';
    link.download = "download";
    link.click();
}

function sendImgToServer() {
    if (!takePhoto) {
        toastError("Chưa chụp ảnh");
        return;
    }
    const canvas = document.getElementById("canvas");
    const imgData = canvas.toDataURL("image/png");

    // Tạo FormData object và thêm dữ liệu hình ảnh vào
    const formData = new FormData();
    formData.append("image", imgData); // 'image' là tên của trường dữ liệu bạn muốn gửi
    // var a = ;
    formData.append("idsv", $('input[name="idsv"]').val());
    // Gửi dữ liệu ảnh đến server bằng XMLHttpRequest
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../../src/handle/upload.php"); // Thay 'upload.php' bằng đường dẫn đến tệp PHP xử lý dữ liệu
    xhr.onload = function () {
        console.log(xhr.responseText);
        if (xhr.status === 200) {
            console.log("Dữ liệu ảnh đã được gửi thành công.");
            // kết quả trả về và giải mã chuỗi json
            var res = JSON.parse(xhr.responseText);
            
            switch (res.status) {
                case 200:
                    toastSuccess("Tải ảnh thành công");
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                    break;
                case 505:
                    toastError("Không tìm thấy id");
                    break;
                case res.status >= 500:
                    toastError("Lỗi máy chủ");
                    break;
            }
        } else {
            console.error("Có lỗi xảy ra khi gửi dữ liệu.");
        }
    };
    xhr.send(formData);
}
