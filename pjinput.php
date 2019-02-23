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
$alamatkirim = '';
$nonota = 'NT000';
$now	  = date("Y-m-d");

if (isset($_GET['id'])) $id = $_GET['id'];
if (isset($_GET['detail'])) $detail = $_GET['detail'];

$rs = mysqli_query($Open,"select COALESCE(MAX(id),0) + 1 nomer from penjualan");
$row = mysqli_fetch_assoc($rs);

$nonota = $nonota.''.$row['nomer'];
if ($detail > 0){
	$desable = 'readonly';
}

?>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget widget-nopad">
						<div class="widget-header"> <i class="icon-list-alt"></i>
			            	<h3>Tambah Transaksi Pembelian</h3>
			            </div>
			            <br>
			            <!-- <div class="tab-content"> -->
			            	<!-- <div class="tab-pane" id="formcontrols"> -->
			            		<form id="edit-profile" class="form-horizontal" enctype='application/json'>
			            			<fieldset>
			            				<div class="control-group">
											<label class="control-label" for="username">Nomer Nota</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="nonota" placeholder="Nomer Nota" required="" name="nonota" readonly="" value = "<?php echo $nonota;?>">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">
											<label class="control-label" for="nama">Tanggal Nota</label>
											<div class="controls">
												<input type="date" class="span6 disabled" id="tglnota" placeholder="Tanggal Nota" required="" readonly="" name="tglnota" value = "<?php echo $now ?>">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->\
										<div class="control-group">
											<label class="control-label" for="nama">Customer</label>
											<div class="controls">
												<select class="form-control select2" required="" name="cust" id="cust" <?php echo $desable; ?> >
													<?php
													if($id != 0){
														$rs = mysqli_query($Open,"
											            select * from mastercustomer where id = $vendorid
											            ");
													}
													else{
														$rs = mysqli_query($Open,"
											            select * from mastercustomer
											            ");
													}
											            while ($rsx = mysqli_fetch_array($rs)) {
											            	$id = stripslashes ($rsx['id']);
											            	$namacust = stripslashes ($rsx['nama']);
											            	$noktp = stripslashes ($rsx['noktp']);
											            	$alamatkirim = stripslashes ($rsx['alamat']);
											            	echo "<option value = '".$id."'>".$namacust ." | ".$noktp."</option>";
											            }
													?>
								                </select>

											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">
											<label class="control-label" for="nama">Barang</label>
											<div class="controls">
												<select class="form-control select2" required="" name="stock" id="stock">
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
								                <input type="hidden" class="span6 disabled" id="alamat"  required="" name="alamat" value="<?php echo $alamatkirim;?>">
												<!-- <input type="hidden" class="span6 disabled" id="user"  required="" name="user" value="<?php echo $username;?>"> -->
											</div> <!-- /controls -->				
										</div>
										<div class="control-group">
											<label class="control-label" for="nama">Harga Jual OTR</label>
											<div class="controls">
												<input type="number" class="span6 disabled" id="hrg" placeholder="Harga" required="" name="hrg">
												<input type="hidden" class="span6 disabled" id="user"  required="" name="user" value="<?php echo $username;?>">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="nama">Uang Muka</label>
											<div class="controls">
												<input type="number" class="span6 disabled" id="dp" placeholder="Uang Muka" name="dp">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="nama">Jenis Transaksi</label>
											<div class="controls">
												<select class="form-control select2" name="trxtype" id="trxtype" onchange="getTempo(this)">
													<option value = ''>----- Select -----</option>
													<option value = 'T'>Tunai</option>
													<option value = 'K'>Kredit</option>
												</select>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="nama">Tempo</label>
											<div class="controls">
												<input type="number" class="span6 disabled" id="tempo" placeholder="Tempo" required="" name="tempo">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="nama">Angsuran Perbulan</label>
											<div class="controls">
												<input type="number" class="span6 disabled" id="angsuran" placeholder="Angsuran" required="" name="angsuran" readonly="">
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
		$('#tempo').focusout(function() {
			var otr = $('#hrg').val();
			var dp = $('#dp').val();
			var tempo = $('#tempo').val();
			var sisahutang = 0;
			var angsuran = 0 ;
			var bunga = 0;
			if(otr != 0 && dp != 0 && tempo != 0){
				sisahutang = otr - dp;
				angsuran = (sisahutang / tempo);
				bunga = sisahutang * 2/100
				$('#angsuran').val(Math.round(angsuran) + Math.round(bunga));
			}
			else
			{
				Swal.fire({
					title: 'Error !',
					text: 'Detail Harga Tidak boleh kosong',
					type: 'error',
					confirmButtonText: 'Cool'
				});
			}
		});
		$('#edit-profile').submit(function (e){
			$('#btn_submit').text('Tunggu Sebentar...');
        	$('#btn_submit').attr('disabled',false);
        	e.preventDefault();
        	var me = $(this);

        	$.ajax({
        		type: "post",
        		url: "process/pjinputpro.php",
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
        					document.location='pjview.php';
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
	function getTempo(sel){
		var type = sel.value;

		if(type == 'T'){
			$('#tempo').attr('disabled',true);
			$('#dp').attr('disabled',true);
			$('#tempo').val('0');
			$('#dp').val('0');
		}
		else{
			$('#tempo').attr('disabled',false);
			$('#tempo').val('0');
		}
	}
</script>