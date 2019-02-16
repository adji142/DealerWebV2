<?php
//buka koneksi ke engine MySQL
	$Open = mysqli_connect("localhost","root","","dealsys");
		if (!$Open){
		die ("Koneksi ke Engine MySQL Gagal !<br>");
		}
?>