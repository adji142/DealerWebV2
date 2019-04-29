<?php
	include '../config/koneksi.php';
	$data = array('success' => false ,'message'=>array(),'saving' => false,'error'=>array());

	$mode = '';
	$id = '';
	$detail = '';

	if(isset($_POST['nonota']))$nonota = $_POST['nonota'];
	if(isset($_POST['tglnota']))$tglnota = $_POST['tglnota'];
	// $tglterima	  = $_POST['tglterima'];
	// $vendor	  = $_POST['vendor'];
	if(isset($_POST['stock']))$stock	  = $_POST['stock'];
	if(isset($_POST['qty']))$qty	  = $_POST['qty'];
	if(isset($_POST['nosin']))$nosin	  = $_POST['nosin'];
	if(isset($_POST['norang']))$norang	  = $_POST['norang'];
	// $Harga	  = $_POST['hrg'];
	$now	  = date("Y-m-d");

	// other 
	if(isset($_GET['id'])) $id = $_GET['id'];
	if(isset($_GET['detail'])) $detail = $_GET['detail'];
	if(isset($_GET['mode'])) $mode = $_GET['mode'];

	if($mode == 'delete'){
		if($detail){
			$delete = mysqli_query($Open,"delete from pembeliandetail where id = $detail");
			if($delete){
				echo "
					<script>
						alert('Delete Berhasil');
						document.location='../pbview.php';
					</script>
				";
			}
			else{
				echo "
					<script>
						alert('Delete Gagal');
						document.location='../pbview.php';
					</script>
				";	
			}
		}
		else{
			echo $id;
			$delete = mysqli_query($Open,"delete from tabelstok where id = $id");
			if($delete){
				echo "
					<script>
						alert('Delete Berhasil');
						document.location='../pbview.php';
					</script>
				";
			}
			else{
				echo "
					<script>
						alert('Delete Gagal');
						document.location='../pbview.php';
					</script>
				";
			}
		}
	}
	else{
		$inputdetail	="INSERT INTO tabelstok (notransaksi,tgltransaksi,barangid,qty,hrgbrg,nomesin,norangka) 
		VALUES 
		('$nonota','$tglnota',$stock,$qty,0,'$nosin','$norang')";
		$query_inputD =mysqli_query($Open,$inputdetail);
		if($query_inputD){
			$data['success'] = true;
		}
		else{
			$data['message'] = 'E500-03'; // gagal input
		}
}
	echo json_encode($data);
?>