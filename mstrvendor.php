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
			            	<h3>Tambah Master Vendor Baru</h3>
			            </div>
			            <br>
			            <!-- <div class="tab-content"> -->
			            	<!-- <div class="tab-pane" id="formcontrols"> -->
			            		<form id="edit-profile" class="form-horizontal" enctype='application/json'>
			            			<fieldset>
			            				<div class="control-group">
											<label class="control-label" for="username">Kode Vendor</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="kdvendor" placeholder="Kode Vendor" required="" name="kdvendor">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">
											<label class="control-label" for="nama">Nama Vendor</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="nmvendor" placeholder="Nama Vendor" required="" name="nmvendor">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">
											<label class="control-label" for="nama">Alamat Vendor</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="alamat" placeholder="Alamat Vendor" required="" name="alamat">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">
											<label class="control-label" for="nama">Nomer Telepon</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="notlp" placeholder="Nomer Telepon" required="" name="notlp">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">
											<div class="controls">
												<input type="hidden" class="span6 disabled" id="user"  required="" name="user" value="<?php echo $username;?>">
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
        		url: "process/mstrvendorpro.php",
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
        					document.location='vendorview.php';
        				});
        			}
        			else{
        				if(response.message == 'E500-EXS-01'){
	        				Swal.fire({
	        					title: 'Error !',
	        					text: 'Vendor Sudah Ada',
	        					type: 'error',
	        					confirmButtonText: 'Cool'
	        				});
        				}
        				else if (response.message=='E500-03'){
        					Swal.fire({
	        					title: 'Error !',
	        					text: 'Gagal Input Data Vendor',
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