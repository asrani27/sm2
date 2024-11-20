<!DOCTYPE HTML>
<html>

<head>
<style>
img {
  pointer-events: none;
  z-index: 1;
  position: absolute;
}
.canvasjs-chart-container {
  position: relative;
}
</style>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
<script type="text/javascript">
window.onload = function () {
  var dataPoints = [
    { label: "banana", y: 10000 },
    { label: "mango", y: 3430 },
    { label: "grape", y: 28 },
  ];

  // Hitung total nilai dari semua dataPoints
  var total = dataPoints.reduce((sum, point) => sum + point.y, 0);

  // Tambahkan indexLabel untuk menampilkan angka total dan persentase
  dataPoints.forEach((point) => {
    point.yFormatted = point.y.toLocaleString(); // Format angka dengan pemisah ribuan
    var percentage = ((point.y / 85000) * 100).toFixed(1); // Persentase 1 desimal
    point.indexLabel = `${point.yFormatted} (${percentage}%)`; // Format label
    point.indexLabelFontSize = 24; // Ukuran font label
    point.indexLabelPlacement = "inside"; // Posisi label di dalam bar
    point.indexLabelFontColor = "white"; // Ubah warna teks untuk kontras
    point.indexLabelVerticalAlign = "bottom"; // Posisi vertikal label di bagian bawah
    point.indexLabelMaxWidth = 80; // Menambahkan batas lebar maksimum label
    point.indexLabelWrap = true;
  });

  var chart = new CanvasJS.Chart("chartContainer", {
    theme: "light2",
    title: {
      text: "Pilkada Kota Banjarmasin",
    },
    axisY: {
      maximum: total, // Menambahkan batas maksimum hingga 50
      title: "Suara",
    },
    data: [
      {
        type: "column",
        dataPoints: dataPoints, // Gunakan dataPoints yang sudah dimodifikasi
      },
    ],
  });
  chart.render();

  var images = [];
  var fruits = [];

  images.push({
    url: "https://canvasjs.com/wp-content/uploads/images/gallery/gallery-overview/banana.png",
  });
  images.push({
    url: "https://canvasjs.com/wp-content/uploads/images/gallery/gallery-overview/mango.png",
  });
  images.push({
    url: "https://canvasjs.com/wp-content/uploads/images/gallery/gallery-overview/grape.png",
  });

  addImages(chart);

  function addImages(chart) {
    for (var i = 0; i < chart.data[0].dataPoints.length; i++) {
      var label = chart.data[0].dataPoints[i].label;

      if (label) {
        fruits.push(
          $("<img>")
            .attr("src", images[i].url)
            .attr("class", label)
            .css("display", "none")
            .appendTo($("#chartContainer>.canvasjs-chart-container"))
        );
      }

      positionImage(fruits[i], i);
    }
  }

  function positionImage(fruit, index) {
    var barTop = chart.axisY[0].convertValueToPixel(chart.data[0].dataPoints[index].y); // Posisi atas bar
    var imageCenter = chart.axisX[0].convertValueToPixel(
      chart.data[0].dataPoints[index].x
    );

    fruit.width(chart.dataPointWidth * 0.5); // Ukuran lebar gambar
    fruit.height(chart.dataPointWidth * 0.42); // Ukuran tinggi gambar
    fruit.css({
      position: "absolute",
      display: "block",
      top: barTop - fruit.height() - 10, // Posisi di atas bar
      left: imageCenter - fruit.width() / 2,
    });
  }

  $(window).resize(function () {
    for (var i = 0; i < chart.data[0].dataPoints.length; i++) {
      positionImage(fruits[i], i);
    }
  });
};
</script>
</head>
<body>
  <div id="chartContainer" style="height: 600px; width: 100%;"></div>
</body>
</html>
