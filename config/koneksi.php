<?php
//buka koneksi ke engine MySQL
	$Open = mysqli_connect("localhost:3307","root","","dealsys");
		if (!$Open){
		die ("Koneksi ke Engine MySQL Gagal !<br>");
		}
?>