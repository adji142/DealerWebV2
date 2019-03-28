<?php
include 'parts/header.php';
?>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget widget-nopad">
						<div class="widget-header"> <i class="icon-list-alt"></i>
			            	<h3>Tambah Transaksi Penjualan Baru <a href="pjinput.php" class="btn btn-general" id="btn_submit">Tambah</a></h3>
			            </div>
			            <br>
			            <!-- <div class="tab-content"> -->
			            	<!-- <div class="tab-pane" id="formcontrols"> -->       	
			            	
			            		<div class="span11">
			            		<table id="example1" class="table table-bordered table-hover">
			            			<thead>
			            				<th>#</th>
								        <th>No Nota</th>
								        <th>Tgl Nota</th>
								        <th>Kode Transaksi</th>
								        <th>Nama Customer</th>
								        <th>Nama Unit</th>
								        <th>Warna</th>
								        <th>Harga</th>
								        <th>DP</th>
								        <th>Bunga</th>
			            			</thead>
			            			<tbody>
			            				
			            					<?php
			            						$rs = mysqli_query($Open,"
									            select a.id,a.nonota,a.tglnota,mc.nama,s.namabarang,s.warna,b.hrgotr,a.jenistrx,coalesce(SUM(pd.kredit),0) dp,
									            case when a.jenistrx = 'K' then '2%' else '' end bunga
									            from penjualan a
												left join penjualandetail b on a.id= b.penjualanid
												left join mastercustomer mc on mc.id = a.customerid
												left join stok s on s.id = b.stockid
												left join piutang p on p.penjualanid = a.id
												left join piutangdetail pd on pd.piutangid = p.id and pd.src = 'DP'
												group by a.nonota,a.tglnota,mc.nama,s.namabarang,s.warna,b.hrgotr,a.jenistrx
									            ");
									            while ($rsx = mysqli_fetch_array($rs)) {
										            $id = stripslashes ($rsx['id']);
										            $nonota = stripslashes ($rsx['nonota']);
										            $tglnota = stripslashes ($rsx['tglnota']);
										            $nama = stripslashes ($rsx['nama']);
										            $namabarang = stripslashes ($rsx['namabarang']);
										            $warna = stripslashes ($rsx['warna']);
										            $hrgotr = stripslashes ($rsx['hrgotr']);
										            $dp = stripslashes ($rsx['dp']);
										            $trx = stripslashes ($rsx['jenistrx']);
										            $kembang = stripslashes ($rsx['bunga']);
										            echo "
										            <tr>
										              <td>
										              <a href = 'process/pjinputpro.php?id=".$id."&dp=".$dp."&mode=cetak' class='btn btn-info'>Cetak</a>
										              </td>
										              <td>".$nonota."</td>
										              <td>".date('d-m-y',strtotime($tglnota))."</td>
										              <td>".$trx."</td>
										              <td>".$nama."</td>
										              <td>".$namabarang."</td>
										              <td>".$warna."</td>
										              <td>".number_format($hrgotr)."</td>
										              <td>".number_format($dp)."</td>
										              <td>".$kembang."</td>
										            </tr>
										            ";
										          }
			            					?>
			            				
			            			</tbody>
			            		</table>
			            	</div>
			            	
			            	<!-- </div> -->
			            <!-- </div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include 'parts/footer.php';
?>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
</script>