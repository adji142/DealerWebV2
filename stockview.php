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
			            	<h3>Tambah Master Barang Baru <a href="mstrstock.php" class="btn btn-general" id="btn_submit">Tambah</a></h3>
			            </div>
			            <br>
			            <!-- <div class="tab-content"> -->
			            	<!-- <div class="tab-pane" id="formcontrols"> -->       	
			            	
			            		<div class="span11">
			            		<table id="example1" class="table table-bordered table-hover">
			            			<thead>
			            				<!-- <th>#</th> -->
								        <th>Nama Stock</th>
								        <th>Warna</th>
								        <!-- <th>Nomer Mesin</th>
								        <th>Nomer Rangka</th> -->
								        <th>CC</th>
								        <th>Stock Gudang</th>
			            			</thead>
			            			<tbody>
			            				
			            					<?php
			            						$rs = mysqli_query($Open,"
									            select *, (select sum(pb.qty) from tabelstok pb where pb.barangid = s.id )Pembelian ,
									            (select nomesin from tabelstok pb where pb.barangid = s.id and nomesin is not null limit 1) nomesin,
									            (select  norangka from tabelstok pb where pb.barangid = s.id and norangka is not null limit 1) norangka,
												(select sum(pb.qty) from penjualandetail pb where pb.stockid = s.id ) penjualan,
												(select sum(pb.qty) from tabelstok pb where pb.barangid = s.id ) - 
												(select sum(pb.qty) from penjualandetail pb where pb.stockid = s.id ) qtyakhir
												from stok s
									            ");
									            while ($rsx = mysqli_fetch_array($rs)) {
										            $id = stripslashes ($rsx['id']);
										            $namabarang= stripslashes ($rsx['namabarang']);
										            $warna   = stripslashes ($rsx['warna']);
										            $nomesin   = stripslashes ($rsx['nomesin']);
										            $norangka   = stripslashes ($rsx['norangka']);
										            $cc = stripslashes($rsx['cc']);
										            $qtystok   = stripslashes ($rsx['qtyakhir']);
										            echo "
										            <tr>
										              
										              <td>".$namabarang."</td>
										              <td>".$warna."</td>
										              <td>".$cc."</td>
										              <td>".$qtystok."</td>
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
    $('#example1').DataTable({
    	dom: 'Bfrtip',
    	buttons: [
            'copy', 'excel', 'pdf', 'print'
        ],
        'ordering'    : false,
    });
  })
</script>
