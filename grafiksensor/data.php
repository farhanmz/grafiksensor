<?php  
	// koneksi database
	$konek = mysqli_connect("localhost", "root", "", "grafiksensor");

	// baca data dari tabel tb_sensor

	// baca id tertinggi
	$sql_id = mysqli_query($konek, "SELECT MAX(id) FROM tb_sensor");
	// tanggap datanya
	$data_id = mysqli_fetch_array($sql_id);
	// ambil id terkahir / terbesar
	$id_akhir = $data_id['MAX(id)']; // id = 8
	$id_awal = $id_akhir - 4;

	// baca informasi tanggal untuk semua data
	$tanggal = mysqli_query($konek, "SELECT tanggal FROM tb_sensor WHERE id>='$id_awal' and id<='$id_akhir' ORDER BY id ASC");

	// baca informasi acc untuk semua data
	$accx = mysqli_query($konek, "SELECT accx FROM tb_sensor WHERE id>='$id_awal' and id<='$id_akhir' ORDER BY id ASC");
	$accy = mysqli_query($konek, "SELECT accy FROM tb_sensor WHERE id>='$id_awal' and id<='$id_akhir' ORDER BY id ASC");
	$accz = mysqli_query($konek, "SELECT accz FROM tb_sensor WHERE id>='$id_awal' and id<='$id_akhir' ORDER BY id ASC");

?>

<!-- tampilan grafik -->
<div class="panel panel-primary">
	<div class="panel-heading">
		Grafik Sensor
	</div>

	<div class="panel-body">
		<!-- siapkan canvas untuk grafik -->
		<canvas id="myChart"></canvas>

		<!-- gambar grafik -->
		<script type="text/javascript">
			// baca id canvastempat grafik akan diletakan
			var canvas = document.getElementById('myChart');
			// letakkan data data untuk grafik
			var data = {
				labels : [
					<?php  
						while($data_tanggal = mysqli_fetch_array($tanggal))
						{
							echo '"'.$data_tanggal['tanggal'].'",';
						}
					?>
				],
				datasets : [
				{
					label : "AccX",
					fill : true,
					backgroundColor : "rgba(52, 231, 43, 0.2)",
					borderColor : "rgba(52, 231, 43, 1)",
					lineTension : 0.5,
					pointRadius : 3,
					data : [
						<?php  
							while($data_accx = mysqli_fetch_array($accx))
							{
								echo $data_accx['accx'].',';
							}
						?>
					]
				},
				{
					label : "AccY",
					fill : true,
					backgroundColor : "rgba(239, 82, 93, 0.5)",
					borderColor : "rgba(239, 82, 93, 1)",
					lineTension : 0.5,
					pointRadius : 3,
					data : [
						<?php  
							while($data_accy = mysqli_fetch_array($accy))
							{
								echo $data_accy['accy'].',';
							}
						?>
					]
				},
				{
					label : "AccZ",
					fill : true,
					backgroundColor : "rgba(62, 254, 255, 0.5)",
					borderColor : "rgba(62, 254, 255, 1)",
					lineTension : 0.5,
					pointRadius : 3,
					data : [
						<?php  
							while($data_accz = mysqli_fetch_array($accz))
							{
								echo $data_accz['accz'].',';
							}
						?>
					]
				}

				]
			};

			// option grafik
			var option = {
				showLine : true,
				animation : {duration : 0}
			};

			// cetak grafik kedalam canvas
			var myLineChart = Chart.Line(canvas, {
				data : data,
				options : option
			});

		</script>
	</div>
</div>