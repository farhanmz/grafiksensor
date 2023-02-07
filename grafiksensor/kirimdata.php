<?php  
	// koneksi ke database
	$konek = mysqli_connect("localhost", "root", "", "grafiksensor");

	// tangkap parameter yang dikirimkan oleh nodemcu
	$accx = $_GET['accx'];
	$accy = $_GET['accy'];
	$accz = $_GET['accz'];

	// simpan ke tabel tb_sensor
	// atur id selalu dimulai dari 1
	mysqli_query($konek, "ALTER TABLE tb_sensor AUTO_INCREMENT=1");
	// simpan nilai acce ke tabel tb_sensor
	$simpan = mysqli_query($konek, "INSERT INTO tb_sensor(accx, accy, accz)VALUES('$accx', '$accy', '$accz')");

	// berikan respon ke nodemcu
	if($simpan)
		echo "Berhasil Disimpan";
	else
		echo "Gagal Tersimpan";

?>