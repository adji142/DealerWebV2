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
			            	<h3>Tambah Transaksi Stock Baru <a href="pbinput.php" class="btn btn-general" id="btn_submit">Tambah</a></h3>
			            </div>
			            <br>
			            <!-- <div class="tab-content"> -->
			            	<!-- <div class="tab-pane" id="formcontrols"> -->       	
			            	
			            		<div class="span11">
			            		<table id="example1" class="table table-bordered table-hover">
			            			<thead>
			            				<th>#</th>
								        <th>No transaksi</th>
								        <th>Tgl transaksi</th>
								        <th>Nama Unit</th>
								        <th>Warna</th>
								        <th>Qty</th>
								        <th>No Mesin</th>
								        <th>No Rangka</th>
			            			</thead>
			            			<tbody>
			            				
			            					<?php
			            						$rs = mysqli_query($Open,"
									            select a.id,a.notransaksi,a.tgltransaksi,s.namabarang,s.warna,a.qty,a.nomesin,a.norangka
												from tabelstok a
												inner join stok s on a.barangid = s.id
												order by a.tgltransaksi desc
									            ");
									            while ($rsx = mysqli_fetch_array($rs)) {
										            $id = stripslashes ($rsx['id']);
										            $nonota = stripslashes ($rsx['notransaksi']);
										            $tglnota = stripslashes ($rsx['tgltransaksi']);
										            $namabarang = stripslashes ($rsx['namabarang']);
										            $warna = stripslashes ($rsx['warna']);
										            $qtybeli = stripslashes ($rsx['qty']);
										            $nomesin = stripslashes ($rsx['nomesin']);
										            $norangka = stripslashes ($rsx['norangka']);
										            echo "
										            <tr>
										              <td>
										              <a href = 'process/pbinputpro.php?id=".$id."&mode=delete' class='btn btn-danger'>delete</a>
										              </td>
										              <td>".$nonota."</td>
										              <td>".$tglnota."</td>
										              <td>".$namabarang."</td>
										              <td>".$warna."</td>
										              <td>".$qtybeli."</td>
										              <td>".$nomesin."</td>
										              <td>".$norangka."</td>
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