$(document).ready(function () {
  $("#myquyen").click(function () {
    let quyen = $("#myquyen").children("#quyen");
    if ($(quyen).hasClass("d-none")) {
      $(quyen).removeClass("d-none");
    } else {
      $(quyen).addClass("d-none");
    }
  });

  $(".tick").each(function (index, element) {
    $(element).click(function () {
      id = $($(".id-q")[index]).val();
      const formData = new FormData();
      formData.append("id", id);
      const xhr = new XMLHttpRequest();
      xhr.open("POST", "../../src/handle/chapnhanquyen.php");
      xhr.onload = function () {
        console.log(xhr.responseText);
        if (xhr.status === 200) {
          console.log("Dữ liệu ảnh đã được gửi thành công.");
          // kết quả trả về và giải mã chuỗi json
          var res = JSON.parse(xhr.responseText);

          switch (res.status) {
            case 200:
              toastSuccess("Đã cấp quyền");
              setTimeout(() => {
                location.reload();
              }, 1000);
              break;
            case 505:
              toastError("Không thể cấp quyền");
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
    });
  });

  $(".cancle").each(function (index, element) {
    $(element).click(function () {
      id = $($(".id-q")[index]).val();
      const formData = new FormData();
      formData.append("id", id);
      const xhr = new XMLHttpRequest();
      xhr.open("POST", "../../src/handle/huyxinquyen.php");
      xhr.onload = function () {
        console.log(xhr.responseText);
        if (xhr.status === 200) {
          console.log("Dữ liệu ảnh đã được gửi thành công.");
          // kết quả trả về và giải mã chuỗi json
          var res = JSON.parse(xhr.responseText);

          switch (res.status) {
            case 200:
              toastSuccess("Đã huỷ");
              setTimeout(() => {
                location.reload();
              }, 1000);
              break;
            case 505:
              toastError("Không thể huỷ");
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
    });
  });

  function print_toast() {
    // Lấy URL hiện tại
    let url = new URL(window.location.href);
    let params = new URLSearchParams(url.search);
    let message = params.get("message");
    let status = params.get("status");
    if (message && status) {
      switch (parseInt(status)) {
        case 200:
          toastSuccess(message);
          break;
        case 300:
          toastInfo(message);
          break;
        default:
          toastError(message);
          break;
      }
    }
  }
  print_toast();
});
function drawChart(canvas, option, data, type, background = "blue") {
  if (option.length == data.length) {
    var data = {
      labels: option,
      datasets: [
        {
          label: "",
          data: data,
          backgroundColor: background,
        },
      ],
    };
    new Chart(canvas, {
      type: type,
      data: data,
    });
  }
}

function addParams(key, value) {
  let currentURL = window.location.href; // Lấy URL hiện tại
  console.log(currentURL);
  let url = new URL(currentURL);
  let params = new URLSearchParams(url.search);

  // Xóa tất cả các tham số 't' hiện có từ URL
  params.delete(key);

  // Thêm tham số 't' mới vào URL
  params.set(key, value);

  // Gán các tham số đã chỉnh sửa vào URL
  url.search = params.toString();
  history.replaceState(null, "", url.toString());
}
