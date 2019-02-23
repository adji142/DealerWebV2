<?php
	include '../config/koneksi.php';
	$data = array('success' => false ,'message'=>array(),'saving' => false,'error'=>array());
	// Global variable

	$action = '';
	$idcust = 0;
	$noktp = '';
	$nama = '';
	$alamat = '';
	$kodepos = '';
	$tmptlahir = '';
	$tgllhr = '';
	$notlp = '';
	$user = '';
	// POST
	if(isset($_POST['noktp'])) $noktp = $_POST['noktp'];
	if(isset($_POST['nama'])) $nama = $_POST['nama'];
	if(isset($_POST['alamat'])) $alamat	  = $_POST['alamat'];
	if(isset($_POST['kodepos'])) $kodepos	  = $_POST['kodepos'];
	if(isset($_POST['tmptlahir'])) $tmptlahir	  = $_POST['tmptlahir'];
	if(isset($_POST['tgllhr'])) $tgllhr	  = $_POST['tgllhr'];
	if(isset($_POST['notlp'])) $notlp	  = $_POST['notlp'];
	if(isset($_POST['user'])) $user	  = $_POST['user'];
	$now	  = date("Y-m-d");
	if(isset($_POST['mode'])) $action = $_POST['mode'];
	if(isset($_POST['idcust'])) $idcust = $_POST['idcust'];
	// GET
	if(isset($_GET['id'])) $idcust = $_GET['id'];
	if(isset($_GET['mode'])) $action = $_GET['mode'];

	// Validasi No mesin
	if($action == ''){
		$rs = mysqli_query($Open,"Select count(*) ext from mastercustomer where noktp = '$noktp'");
		$row = mysqli_fetch_assoc($rs);
		if($row['ext'] > 0){
			$data['message'] = 'E500-EXS-01';
		}
		else{

			$input	="INSERT INTO mastercustomer (noktp,nama,alamat,kodepos,tempatlahir,tgllahir,notlp,createdby,createdon) 
			VALUES 
			('$noktp','$nama','$alamat','$kodepos','$tmptlahir','$tgllhr','$notlp','$user','$now')";
			$query_input =mysqli_query($Open,$input);
			if ($query_input) {
				$data['success'] = true;
			}
			else{
				$data['message'] = 'E500-03'; // gagal input
			}
		}
	}
	elseif ($action == 'edit'){
		$update = "update mastercustomer set nama = '$nama', alamat = '$alamat', notlp = '$notlp' where id = $idcust";
		// print_r($update);
		$query_update = mysqli_query($Open,$update);
		if($query_update){
			$data['success'] = true;
		}
		else{
			$data['message'] = 'E500-04'; // gagal Update
		}
	}
	elseif ($action == 'delete') {
		$delete = mysqli_query($Open,"delete from mastercustomer where id = $idcust");
		if($delete){
			echo "
				<script>
					alert('Delete Berhasil');
					document.location='../custview.php';
				</script>
			";
		}
		else{
			echo "
				<script>
					alert('Delete Gagal');
					document.location='../custview.php';
				</script>
			";
		}
	}
	else{
		$data['message'] = 'E500-05'; // Unidentified Mode
	}
	echo json_encode($data);
?>