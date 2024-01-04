let option = [];
let data = [];
var canvas = $("#thongkesoluongtrong").find("canvas")[0];
getText($("#thongkesoluongtrong"));
drawChart(canvas, option, data, "pie", [
  "red",
  "blue",
  "green",
  "yellow",
  "orange",
  "aqua",
]);

canvas = $("#thongkesoluongtrong1").find("canvas")[0];
getText($("#thongkesoluongtrong1"));
drawChart(canvas, option, data, "bar");

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
