<?php
include 'parts/header.php';

$id = 0;
$detail = 0;
$desable = '';

// declare variable
$nonota = '';
$tglnota = '';
$tglterima='';
$vendorid = null;
$nonota = 'STK000';

if (isset($_GET['id'])) $id = $_GET['id'];
if (isset($_GET['detail'])) $detail = $_GET['detail'];

$rs = mysqli_query($Open,"select COALESCE(MAX(id),0) + 1 nomer from tabelstok");
$row = mysqli_fetch_assoc($rs);
$nonota = $nonota.''.$row['nomer'];

if ($detail > 0){
	$desable = 'readonly';
	$rs = mysqli_query($Open,"select b.id vendorid,a.* from pembelian a inner join vendor b on a.vendorid = b.id where a.id = $id");
	$row = mysqli_fetch_assoc($rs);

	$nonota = $row['nonota'];
	$tglnota = $row['tglnota'];
	$tglterima = $row['tglterima'];
	$vendorid = $row['id'];
	
}

?>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget widget-nopad">
						<div class="widget-header"> <i class="icon-list-alt"></i>
			            	<h3>Tambah Transaksi Stock</h3>
			            </div>
			            <br>
			            <!-- <div class="tab-content"> -->
			            	<!-- <div class="tab-pane" id="formcontrols"> -->
			            		<form id="edit-profile" class="form-horizontal" enctype='application/json'>
			            			<fieldset>
			            				<div class="control-group">
											<label class="control-label" for="username">Nomer Transaksi</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="nonota" placeholder="Nomer Transaksi" required="" name="nonota" value = "<?php echo $nonota;?>" readonly>
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">
											<label class="control-label" for="nama">Tanggal Transaksi</label>
											<div class="controls">
												<input type="date" class="span6 disabled" id="tglnota" placeholder="Tanggal Nota" required="" name="tglnota" <?php echo $desable; ?> value = "<?php echo $tglnota ?>">
											</div> <!-- /controls -->				
										</div>
										<div class="control-group">
											<label class="control-label" for="nama">Barang</label>
											<div class="controls">
												<select class="form-control select2" name="stock" id="stock">
													<?php
														$rs = mysqli_query($Open,"
											            select * from stok
											            ");
											            while ($rsx = mysqli_fetch_array($rs)) {
											            	$idstk = stripslashes ($rsx['id']);
											            	$namabarang = stripslashes ($rsx['namabarang']);
											            	$warna = stripslashes ($rsx['warna']);

											            	echo "<option value = '".$idstk."'>".$namabarang ." | ".$warna."</option>";
											            }
													?>
								                </select>

												<!-- <input type="hidden" class="span6 disabled" id="user"  required="" name="user" value="<?php echo $username;?>"> -->
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">
											<label class="control-label" for="nama">Nomer Mesin</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="nosin" placeholder="Nomer Mesin" required="" name="nosin">
											</div>				
										</div> 
										<div class="control-group">
											<label class="control-label" for="nama">Nomer Rangka</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="norang" placeholder="Nomer Rangka" required="" name="norang">
											</div> 
										</div> 
										<div class="control-group">
											<label class="control-label" for="nama">Jumlah</label>
											<div class="controls">
												<input type="number" class="span6 disabled" id="qty" placeholder="Jumlah" required="" name="qty">
											</div>
										</div>
										<div class="form-actions">
											<!-- <button type="submit" class="btn btn-primary">Save</button>  -->
											<button class="btn btn-general" id="btn_submit">Save</button>
											<!-- <button class="btn">Cancel</button> -->
										</div>
			            			</fieldset>
			            		</form>
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
<script type="text/javascript">
	$(function () {
		$('.select2').select2()

		$(document).ready(function () {
			// alert();
			// Swal.fire({
			//   title: 'Error!',
			//   text: 'Do you want to continue',
			//   type: 'error',
			//   confirmButtonText: 'Cool'
			// })
		});
		$('#edit-profile').submit(function (e){
			$('#btn_submit').text('Tunggu Sebentar...');
        	$('#btn_submit').attr('disabled',false);
        	e.preventDefault();
        	var me = $(this);

        	$.ajax({
        		type: "post",
        		url: "process/pbinputpro.php",
        		data: me.serialize(),
        		dataType: "json",
        		success: function (response) {
        			if(response.success == true){
        				Swal.fire({
        					title: 'Berhasil',
        					text: 'Data Berhasil di simpan',
        					type: 'success',
        					confirmButtonText: 'Cool'
        				}).then(function() {
        					document.location='pbview.php';
        				});
        			}
        			else{
        				if (response.message=='E500-03'){
        					Swal.fire({
	        					title: 'Error !',
	        					text: 'Gagal Input Data Stock',
	        					type: 'error',
	        					confirmButtonText: 'Cool'
	        				});	
        				}
        				else
        				{
        					Swal.fire({
	        					title: 'Error !',
	        					text: 'Unidentified Error',
	        					type: 'error',
	        					confirmButtonText: 'Cool'
	        				});
        				}
        			}
        		}
        	});
		});
	});
</script>