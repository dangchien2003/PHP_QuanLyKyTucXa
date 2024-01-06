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

if($("#thongkesoluongtrong")) {
  canvas = $("#thongkesoluongtrong").find("canvas")[0];
  getText($("#thongkesoluongtrong"));
  drawChart(canvas, option, data, "bar");
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
