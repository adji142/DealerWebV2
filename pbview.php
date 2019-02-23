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
			            	<h3>Tambah Transaksi Pembelian Baru <a href="pbinput.php" class="btn btn-general" id="btn_submit">Tambah</a></h3>
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
								        <th>Nama Vendor</th>
								        <th>Nama Unit</th>
								        <th>Warna</th>
								        <th>Qty</th>
								        <th>Harga</th>
								        <th>Total</th>
			            			</thead>
			            			<tbody>
			            				
			            					<?php
			            						$rs = mysqli_query($Open,"
									            select a.id,b.id detail,a.nonota,a.tglnota,v.namavendor,s.namabarang,s.warna,b.qtybeli,b.hrgbeli ,
												COALESCE(b.qtybeli,0) * COALESCE(b.hrgbeli,0) total
												from pembelian a
												left join pembeliandetail b on a.id = b.pembelianid
												inner join vendor v on a.vendorid = v.id
												inner join stok s on b.stockid = s.id
									            ");
									            while ($rsx = mysqli_fetch_array($rs)) {
										            $id = stripslashes ($rsx['id']);
										            $iddetail = stripslashes ($rsx['detail']);
										            $nonota = stripslashes ($rsx['nonota']);
										            $tglnota = stripslashes ($rsx['tglnota']);
										            $namavendor = stripslashes ($rsx['namavendor']);
										            $namabarang = stripslashes ($rsx['namabarang']);
										            $warna = stripslashes ($rsx['warna']);
										            $qtybeli = stripslashes ($rsx['qtybeli']);
										            $hrgbeli = stripslashes ($rsx['hrgbeli']);
										            $total = stripslashes ($rsx['total']);
										            echo "
										            <tr>
										              <td>
										              <a href = 'pbinput.php?id=".$id."&detail=".$iddetail."' class='btn btn-info'>Add Item</a>
										              <a href = 'process/pbinputpro.php?id = ".$id."&detail=".$iddetail."&mode=delete' class='btn btn-danger'>delete</a>
										              </td>
										              <td>".$nonota."</td>
										              <td>".$tglnota."</td>
										              <td>".$namavendor."</td>
										              <td>".$namabarang."</td>
										              <td>".$warna."</td>
										              <td>".$qtybeli."</td>
										              <td>".$hrgbeli."</td>
										              <td>".$total."</td>
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