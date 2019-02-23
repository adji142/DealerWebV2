<?php
	include '../config/koneksi.php';
	$data = array('success' => false ,'message'=>array(),'saving' => false,'error'=>array());
	// Global variable

	$action = '';
	$id = 0;
	$detail = 0;
	$nonota = '';
	$tglnota = '';
	$cust = '';
	$stock = '';
	$hrg = 0;
	$dp = 0;
	$trxtype = '';
	$user = '';
	$tempo = 0;
	$angsuran = 0;
	$alamat = '';
	$tgljatuhtempo = '';
	// POST
	if(isset($_POST['nonota'])) $nonota = $_POST['nonota'];
	if(isset($_POST['tglnota'])) $tglnota = $_POST['tglnota'];
	if(isset($_POST['cust'])) $cust	  = $_POST['cust'];
	if(isset($_POST['stock'])) $stock	  = $_POST['stock'];
	if(isset($_POST['hrg'])) $hrg	  = $_POST['hrg'];
	if(isset($_POST['dp'])) $dp	  = $_POST['dp'];
	if(isset($_POST['trxtype'])) $trxtype	  = $_POST['trxtype'];
	if(isset($_POST['tempo'])) $tempo	  = $_POST['tempo'];
	if(isset($_POST['angsuran'])) $angsuran	  = $_POST['angsuran'];
	if(isset($_POST['alamat'])) $alamat	  = $_POST['alamat'];
	if(isset($_POST['user'])) $user	  = $_POST['user'];
	$now	  = date("Y-m-d");
	if(isset($_POST['mode'])) $action = $_POST['mode'];
	if(isset($_POST['id'])) $id = $_POST['id'];
	$tgljatuhtempo  = date('Y-m-d', strtotime($tglnota. ' + '.$tempo.' month'));

	// GET
	if(isset($_GET['id'])) $id = $_GET['id'];
	if(isset($_GET['detail'])) $detail = $_GET['detail'];
	if(isset($_GET['mode'])) $action = $_GET['mode'];
	if(isset($_GET['dp'])) $dp = $_GET['dp'];

	// Validasi No mesin
	if($action == 'delete'){
		if($detail){
			$delete = mysqli_query($Open,"delete from penjualandetail where id = $detail");
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
			$delete = mysqli_query($Open,"delete from penjualan where id = $id");
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
	elseif ($action == 'cetak') {
		if(intval($dp)>0){
			// Cetak nota kredit
			echo "<script type=\"text/javascript\">
		        window.open('../print/notakredit.php?id=".$id."&dp=".$dp."', '_blank')
		        window.location.replace('../pjview.php')
		    </script>";
		    $data['success']=true;
		}
		else{
			echo "<script type=\"text/javascript\">
		        window.open('../print/notatunai.php?id=".$id."', '_blank')
		        window.location.replace('../pjview.php')
		    </script>";
		    $data['success']=true;
		}
	}
	else{
		$input	="INSERT INTO penjualan (customerid,nonota,tglnota,alamatkirim,tempo,createdby,createdon,tgljatuhtempo,jenistrx)
					VALUES
					($cust,'$nonota','$tglnota','$alamat',$tempo,'$user','$now','$tgljatuhtempo','$trxtype')
		";
		// print_r($input);
		$query_input =mysqli_query($Open,$input);
		if($query_input){
			$idpenjualan = mysqli_insert_id($Open);
			$inputdetail = "INSERT INTO penjualandetail(penjualanid,stockid,qty,hrgotr,createdby,createdon)
							VALUES 
							($idpenjualan,$stock,1,$hrg,'$user','$now')";
			$query_inputD =mysqli_query($Open,$inputdetail);
			if($query_inputD){
				$data['success'] = true;
			}
			else{
				$data['message'] = 'E500-03-PJD'; // gagal input Detail
			}
		}
		else
		{
			$data['message'] = 'E500-03-PJH'; // gagal input Header
		}
		// Insert ke piutang
		$debet = intval($hrg) - intval($dp) ;
		$insertPiut = "INSERT INTO piutang(customerid,debet,createdby,createdon,penjualanid) VALUES
						($cust,$debet,'$user','$now',$idpenjualan)";
		$inputPiut = mysqli_query($Open,$insertPiut);
		if($inputPiut){
			$idPiutang = mysqli_insert_id($Open);

			if($trxtype == 'K'){
				$insertPiutDetail = "INSERT INTO piutangdetail(piutangid,kredit,tgljatuhtempo,createdby,createdon,src) VALUES($idPiutang,$dp,'$tglnota','$user','$now','DP')";
				$inputPiutDetail = mysqli_query($Open,$insertPiutDetail);
				if($inputPiutDetail){
					$data['success'] = true;
				}
				else{
					$data['message'] = 'E500-03'; // gagal input
				}
			}
			elseif ($trxtype == 'T') {
				$insertPiutDetail = "INSERT INTO piutangdetail(piutangid,kredit,tgljatuhtempo,createdby,createdon,src) VALUES($idPiutang,$hrg,'$tglnota','$user','$now','KAS')";
				$inputPiutDetail = mysqli_query($Open,$insertPiutDetail);
				if($inputPiutDetail){
					$data['success'] = true;
				}
				else{
					$data['message'] = 'E500-03'; // gagal input
				}
			}
			else{
				$data['message'] = 'E500-03-TRX'; // TRXTYPE Tidak dikenali
			}
		}
		else{
			$data['message'] = 'E500-03'; // gagal input
		}

	}
	echo json_encode($data);
?>