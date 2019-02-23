<?php
include '../config/koneksi.php';
$data = array('success' => false ,'message'=>array(),'saving' => false,'error'=>array());

$id = 0;
$otr = 0;
$dp = 0;
$tempo = 0;
$now	  = date("Y-m-d");
$tgljatuhtempo = '';
if (isset($_POST['id'])) $id = $_POST['id'];

// Mencari data data yang di perlukan
// print_r($id);
$rs = mysqli_query($Open,"
select p.id,pj.nonota,pj.tglnota,p.debet otr,pj.tempo,
SUM(case when pd.src ='DP' then kredit else 0 end) dp,
SUM(case when pd.src !='DP' then kredit else 0 end) pembayaran,
p.debet - SUM(COALESCE(pd.kredit,0)) saldo,
DATE_ADD(max(pd.tgljatuhtempo),INTERVAL 30 day) jt,
COUNT(case when pd.src != 'DP' then 1 else null end) angsuranke
from piutang p
left join piutangdetail pd on p.id = pd.piutangid
left join penjualan pj on p.penjualanid = pj.id
where p.id = $id
group by pj.nonota,pj.tglnota,p.debet
");
$row = mysqli_fetch_assoc($rs);

$otr = $row['otr'];
$dp = $row['dp'];
$tempo = $row['tempo'];
$tgljatuhtempo = date('Y-m-d', strtotime($row['jt']. ' + 30 DAY'));

$sisahutang = $otr - $dp;
$angsuran = $sisahutang / $tempo;
$bunga = $sisahutang * 2/100;

$totalangsuran = round($angsuran) + round($bunga);

$insertPiutDetail = "INSERT INTO piutangdetail(piutangid,kredit,tgljatuhtempo,createdby,createdon,src,tgltrx) 
					VALUES($id,$totalangsuran,'$tgljatuhtempo','','$now','KAS','$now')";
$inputPiutDetail = mysqli_query($Open,$insertPiutDetail);

if($inputPiutDetail){
	$data['success'] = true;
}
else{
	$data['message'] = 'E500-03'; // gagal input
}
echo json_encode($data);
?>