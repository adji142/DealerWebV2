<?php
//buka koneksi ke engine MySQL
	$Open = mysqli_connect("localhost","root","hsp123","dealsys");
		if (!$Open){
		die ("Koneksi ke Engine MySQL Gagal !<br>");
		}
?>