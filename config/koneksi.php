<?php
//buka koneksi ke engine MySQL
	$Open = mysqli_connect("koprasiwanitausahamandiri.com","u6018530_root","admin123","u6018530_dealsys");
	//mysqli_connect("localhost","root","hsp123","dealsys");
		// $Open = mysqli_connect("localhost","root","lagis3nt0s4","dealsys");
		if (!$Open){
		die ("Koneksi ke Engine MySQL Gagal !<br>");
		}
?>