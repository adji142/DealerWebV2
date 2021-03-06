<?php
include '../config/koneksi.php';
$data = array('success' => false ,'message'=>array(),'saving' => false,'error'=>array());
// var_dump($_POST);
$id = 0;
$otr = 0;
$dp = 0;
$tempo = 0;
$now	  = date("Y-m-d");
$tgljatuhtempo = '';
$pelunasan = "";

if (isset($_POST['id'])) $id = $_POST['id'];
if(isset($_POST['denda'])) $denda = $_POST['denda'];
if (isset($_POST['pelunasan'])) $pelunasan = $_POST['pelunasan'];

// Mencari data data yang di perlukan
// print_r($id);
$rs = mysqli_query($Open,"
		select p.id,pj.nonota,pj.tglnota,p.debet otr,pj.tempo,pd.tgljatuhtempo,
		(select SUM(kredit) from piutangdetail where piutangid = p.id and src = 'DP') dp,
		SUM(case when pd.src !='DP' then kredit else 0 end) pembayaran,
		p.debet - SUM(COALESCE(pd.kredit,0)) saldo,
		MAX(case when src != 'DP' then pd.tgljatuhtempo when src = 'DP' then date_add(pd.tgljatuhtempo,INTERVAL 1 Month) else '' end) jt,
		COUNT(case when pd.src != 'DP' then 1 else null end) + 1 angsuranke,
		DATE(NOW()) now
		from piutang p
		left join piutangdetail pd on p.id = pd.piutangid
		left join penjualan pj on p.penjualanid = pj.id
		where p.id = $id
		group by pj.nonota,pj.tglnota,p.debet,pd.src
		order by pd.tgljatuhtempo desc
		limit 1
");

$row = mysqli_fetch_assoc($rs);

// var_dump($row);
$otr = $row['otr'];
$dp = $row['dp'];
$tempo = $row['tempo'];
$tgljatuhtempo = date('Y-m-d', strtotime($row['tgljatuhtempo']. ' + 1 Month'));
$tgljatuhtempoori = date('Y-m-d',strtotime($row['jt']));
$dateofserver = strtotime($row['now']);

$sisahutang = $otr - $dp;
$angsuran = $sisahutang / $tempo;
$bunga = $sisahutang * 2/100;
$denda = 0 ;

$totalangsuran = round($angsuran) + round($bunga);

if($pelunasan == "ya"){
	$totalangsuran = $row['saldo'];
}
// var_dump($tgljatuhtempoori."s/d".$now);
if ($tgljatuhtempoori < $now) {
	$denda = round($totalangsuran * 0.5 / 100);
	
}

$insertPiutDetail = "INSERT INTO piutangdetail(piutangid,kredit,tgljatuhtempo,createdby,createdon,src,tgltrx,denda) 
					VALUES($id,$totalangsuran,'$tgljatuhtempo','','$now','KAS','$now',$denda)";
$inputPiutDetail = mysqli_query($Open,$insertPiutDetail);

if($inputPiutDetail){
	$data['success'] = true;
}
else{
	$data['message'] = 'E500-03'; // gagal input
}
echo json_encode($data);
?>
