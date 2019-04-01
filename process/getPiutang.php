<?php
	include '../config/koneksi.php';
	$data = array('success' => false ,'message'=>array(),'data'=>array());
	if (isset($_POST['piutid'])) $id = $_POST['piutid'];
	try {
		$rs = mysqli_query($Open,"
		select p.id,pj.nonota,pj.tglnota,p.debet otr,pj.tempo,
		(select SUM(kredit) from piutangdetail where piutangid = p.id and src = 'DP') dp,
		SUM(case when pd.src !='DP' then kredit else 0 end) pembayaran,
		p.debet - SUM(COALESCE(pd.kredit,0)) saldo,
		MAX(case when src != 'DP' then pd.tgljatuhtempo when src = 'DP' then date_add(pd.tgljatuhtempo,INTERVAL 1 Month) else '1000-01-01' end) jt,
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
		$to_encode = array();
		while($row = mysqli_fetch_assoc($rs)) {
		  $to_encode[] = $row;
		}

		// var_dump($row);
		$data['success'] = true;
		$data['data'] = $to_encode;
		
	} catch (Exception $e) {
		$data['success'] = false;
	}
	echo json_encode($data);
	// $otr = $row['otr'];
	// $dp = $row['dp'];
	// $tempo = $row['tempo'];
	// $tgljatuhtempo = date('Y-m-d', strtotime($row['jt']. ' + 1 Month'));

	// $sisahutang = $otr - $dp;
	// $angsuran = $sisahutang / $tempo;
	// $bunga = $sisahutang * 2/100;

	// $totalangsuran = round($angsuran) + round($bunga);
?>
