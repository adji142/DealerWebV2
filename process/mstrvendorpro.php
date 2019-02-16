<?php
	include '../config/koneksi.php';
	$data = array('success' => false ,'message'=>array(),'saving' => false,'error'=>array());

	$kdvendor = $_POST['kdvendor'];
	$nmvendor = $_POST['nmvendor'];
	$alamat	  = $_POST['alamat'];
	$notlp	  = $_POST['notlp'];
	$user	  = $_POST['user'];
	$now	  = date("Y-m-d");

	// Validasi No mesin

	$rs = mysqli_query($Open,"Select count(*) ext from vendor where kodevendor = '$kdvendor' ");
	$row = mysqli_fetch_assoc($rs);
	if($row['ext'] > 0){
		$data['message'] = 'E500-EXS-01';
	}
	else{

		$input	="INSERT INTO vendor (kodevendor, namavendor, alamatvendor, notlp,createdby,createdon) 
		VALUES 
		('$kdvendor','$nmvendor','$alamat','$notlp','$user','$now')";
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