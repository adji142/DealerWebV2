<?php
include 'parts/header.php';
$id = 0;
$noktp = '';
$nama = '';
$alamat = '';
$pos = '';
$tmptlahir = '';
$tgllhr = '';
$notlp = '';
$desable = '';
$mode = '';
$idcust = 0;
if (isset($_GET['id'])) 
{
	$id = $_GET['id'];
	$desable = 'readonly';
	$rs = mysqli_query($Open,"select * from mastercustomer where id = $id");
	$row = mysqli_fetch_assoc($rs);

	$noktp = $row['noktp'];
	$nama = $row['nama'];
	$alamat = $row['alamat'];
	$pos = $row['kodepos'];
	$tmptlahir = $row['tempatlahir'];
	$tgllhr = $row['tgllahir'];
	$notlp = $row['notlp'];
	$mode = 'edit';
	$idcust = $row['id'];
}

?>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget widget-nopad">
						<div class="widget-header"> <i class="icon-list-alt"></i>
			            	<h3>Tambah Master Stock Baru</h3>
			            </div>
			            <br>
			            <!-- <div class="tab-content"> -->
			            	<!-- <div class="tab-pane" id="formcontrols"> -->
			            		<form id="edit-profile" class="form-horizontal" enctype='application/json'>
			            			<fieldset>
			            				<div class="control-group">
											<label class="control-label" for="username">Nomer Identitas (KTP)</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="noktp" placeholder="Nomer Identitas (KTP)" required="" name="noktp" <?php echo $desable ?> value = "<?php echo $noktp; ?>" >
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">
											<label class="control-label" for="username">Nama</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="nama" placeholder="Nama" required="" name="nama" value="<?php echo $nama; ?>">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">
											<label class="control-label" >Alamat</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="alamat" placeholder="Alamat" required="" name="alamat" value="<?php echo $alamat; ?>">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">
											<label class="control-label" >Kode POS</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="kodepos" placeholder="Nomer Mesin" required="" name="kodepos" <?php echo $desable ?> value = "<?php echo $pos; ?>" >
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">
											<label class="control-label" >Tempat Lahir</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="tmptlahir" placeholder="Tempat Lahir" required="" name="tmptlahir" <?php echo $desable ?> value = "<?php echo $tmptlahir ?>" >
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">
											<label class="control-label" >Tanggal Lahir</label>
											<div class="controls">
												<input type="date" placeholder="Tanggal Lahir" class="span6 disabled" id="tgllhr" required="" name="tgllhr" <?php echo $desable ?> value="<?php echo $tgllhr; ?>">

												<input type="hidden" class="span6 disabled" id="user"  required="" name="user" value="<?php echo $username;?>">
												<input type="hidden" class="span6 disabled" id="mode"  required="" name="mode" value="<?php echo $mode;?>">
												<input type="hidden" class="span6 disabled" id="idcust"  required="" name="idcust" value="<?php echo $idcust;?>">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">
											<label class="control-label" >Nomor Telepon</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="notlp" placeholder="Nomer Telepon" required="" name="notlp" value="<?php echo $notlp; ?>">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
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
        		url: "process/mstrcustpro.php",
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
        					document.location='custview.php';
        				});
        			}
        			else{
        				if(response.message == 'E500-EXS-01'){
	        				Swal.fire({
	        					title: 'Error !',
	        					text: 'Nomer Rangka Sudah ada',
	        					type: 'error',
	        					confirmButtonText: 'Cool'
	        				});
        				}
        				else if (response.message=='E500-03'){
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