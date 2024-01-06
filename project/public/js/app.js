$(document).ready(function () {
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
