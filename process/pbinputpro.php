<?php
	include '../config/koneksi.php';
	$data = array('success' => false ,'message'=>array(),'saving' => false,'error'=>array());

	$mode = '';
	$id = '';
	$detail = '';

	$nonota = $_POST['nonota'];
	$tglnota = $_POST['tglnota'];
	$tglterima	  = $_POST['tglterima'];
	$vendor	  = $_POST['vendor'];
	$stock	  = $_POST['stock'];
	$qty	  = $_POST['qty'];
	$Harga	  = $_POST['hrg'];
	$user	  = $_POST['user'];
	$now	  = date("Y-m-d");

	// other 
	if(isset($_GET['id']))$id = $_GET['id'];
	if(isset($_GET['detail']))$detail = $_GET['detail'];
	if(isset($_GET['mode']))$mode = $_GET['mode'];

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
			$delete = mysqli_query($Open,"delete from pembelian where id = $id");
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

	$rs = mysqli_query($Open,"Select * from pembelian where nonota = '$nonota' and tglnota = '$tglnota'");
	$rowcount=mysqli_num_rows($rs);

	if($rowcount == 0){
		$input	="INSERT INTO pembelian (nonota,tglnota,tglterima,vendorid,createdby,createdon) 
		VALUES 
		('$nonota','$tglnota','$tglterima',$vendor,'$user','$now')";
		$query_input =mysqli_query($Open,$input);
		if($query_input){
			$idpembelian = mysqli_insert_id($Open);
			$inputdetail	="INSERT INTO pembeliandetail (pembelianid,stockid,qtybeli,hrgbeli,createdby,createdon) 
			VALUES 
			($idpembelian,$stock,$qty,$Harga,'$user','$now')";
			$query_inputD =mysqli_query($Open,$inputdetail);
			if($query_inputD){
				$data['success'] = true;
			}
			else{
				$data['message'] = 'E500-03'; // gagal input
			}
		}
		else
		{
			$data['message'] = 'E500-03'; // gagal input
		}
	}
	else{
		$row = mysqli_fetch_assoc($rs);
		$idpembelian = $row['id'];
		$inputdetail	="INSERT INTO pembeliandetail (pembelianid,stockid,qtybeli,hrgbeli,createdby,createdon) 
		VALUES 
		($idpembelian,$stock,$qty,$Harga,'$user','$now')";
		$query_inputD =mysqli_query($Open,$inputdetail);
		if($query_inputD){
			$data['success'] = true;
		}
		else{
			$data['message'] = 'E500-03'; // gagal input
		}
	}
}
	echo json_encode($data);
?>