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
			            	<h3>Tambah Master Stock Baru <a href="mstrstock.php" class="btn btn-general" id="btn_submit">Tambah</a></h3>
			            </div>
			            <br>
			            <!-- <div class="tab-content"> -->
			            	<!-- <div class="tab-pane" id="formcontrols"> -->       	
			            	
			            		<div class="span11">
			            		<table id="example1" class="table table-bordered table-hover">
			            			<thead>
			            				<th>#</th>
								        <th>Nama Stock</th>
								        <th>Warna</th>
								        <th>Nomer Mesin</th>
								        <th>Nomer Rangka</th>
								        <th>Stock Gudang</th>
			            			</thead>
			            			<tbody>
			            				
			            					<?php
			            						$rs = mysqli_query($Open,"
									            select * from stok
									            ");
									            while ($rsx = mysqli_fetch_array($rs)) {
										            $id = stripslashes ($rsx['id']);
										            $namabarang= stripslashes ($rsx['namabarang']);
										            $warna   = stripslashes ($rsx['warna']);
										            $nomesin   = stripslashes ($rsx['nomesin']);
										            $norangka   = stripslashes ($rsx['norangka']);
										            $qtystok   = stripslashes ($rsx['qtystok']);
										            echo "
										            <tr>
										              <td>button</td>
										              <td>".$namabarang."</td>
										              <td>".$warna."</td>
										              <td>".$nomesin."</td>
										              <td>".$norangka."</td>
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