let option = [];
let data = [];
if ($("#thongketinhtrangphong")) {
  var canvas = $("#thongketinhtrangphong").find("canvas")[0];
  getText($("#thongketinhtrangphong"));
  drawChart(canvas, option, data, "pie", [
    "red",
    "blue",
    "green",
    "yellow",
    "orange",
    "aqua",
  ]);
}

if ($("#thongkesoluongtrong")) {
  canvas = $("#thongkesoluongtrong").find("canvas")[0];
  getText($("#thongkesoluongtrong"));
  drawChart(canvas, option, data, "bar");
}

if ($("#thongkesvdangkytheothang")) {
  canvas = $("#thongkesvdangkytheothang").find("canvas")[0];
  getText($("#thongkesvdangkytheothang"));
  drawChart(canvas, option, data, "bar");
}
if ($("#thongkehoadonphong")) {
  canvas = $("#thongkehoadonphong").find("canvas")[0];
  getText($("#thongkehoadonphong"));
  drawChart(canvas, option, data, "pie", [
    "red",
    "blue",
    "green",
    "yellow",
    "orange",
    "aqua",
  ]);
}
if ($("#thongkehoadondiennuoc")) {
  canvas = $("#thongkehoadondiennuoc").find("canvas")[0];
  getText($("#thongkehoadondiennuoc"));
  drawChart(canvas, option, data, "pie", [
    "red",
    "blue",
    "green",
    "yellow",
    "orange",
    "aqua",
  ]);
}
if ($("#thongkehoadonxe")) {
  canvas = $("#thongkehoadonxe").find("canvas")[0];
  getText($("#thongkehoadonxe"));
  drawChart(canvas, option, data, "pie", [
    "red",
    "blue",
    "green",
    "yellow",
    "orange",
    "aqua",
  ]);
}

function getText(parent) {
  option = [];
  data = [];
  $(parent)
    .find(".group")
    .each((index, element) => {
      option.push($(element).find(".option").text());
      data.push($(element).find(".data").text());
    });
}
