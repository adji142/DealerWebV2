<?php
	include '../config/koneksi.php';
	$data = array('success' => false ,'message'=>array(),'saving' => false,'error'=>array());

	$nmbrg = $_POST['nmbrg'];
	$warna = $_POST['warna'];
	$nosin	  = $_POST['nosin'];
	$norang	  = $_POST['norang'];
	$tahun	  = $_POST['tahun'];
	$user	  = $_POST['user'];
	$now	  = date("Y-m-d");

	// Validasi No mesin

	$rs = mysqli_query($Open,"Select count(*) ext from stok where nomesin = '$nosin' or norangka = '$norang'");
	$row = mysqli_fetch_assoc($rs);
	if($row['ext'] > 0){
		$data['message'] = 'E500-EXS-01';
	}
	else{

		$input	="INSERT INTO stok (namabarang, warna, nomesin, norangka,tahun,createdby,createdon) 
		VALUES 
		('$nmbrg','$warna','$nosin','$norang','$tahun','$user','$now')";
// print_r($input);
		$query_input =mysqli_query($Open,$input);
		// echo $query_input;
		if ($query_input) {
			$data['success'] = true;
		}
		else{
			$data['message'] = 'E500-03'; // gagal input
		}
	}
	echo json_encode($data);
?>