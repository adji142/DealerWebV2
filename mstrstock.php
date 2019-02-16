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
			            	<h3>Tambah Master Stock Baru</h3>
			            </div>
			            <br>
			            <!-- <div class="tab-content"> -->
			            	<!-- <div class="tab-pane" id="formcontrols"> -->
			            		<form id="edit-profile" class="form-horizontal" enctype='application/json'>
			            			<fieldset>
			            				<div class="control-group">
											<label class="control-label" for="username">Nama Barang</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="nmbrg" placeholder="Nama Barang" required="" name="nmbrg">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">
											<label class="control-label" for="nama">Warna</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="warna" placeholder="Warna" required="" name="warna">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">
											<label class="control-label" for="nama">Nomer Mesin</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="nosin" placeholder="Nomer Mesin" required="" name="nosin">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">
											<label class="control-label" for="nama">Nomer Rangka</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="norang" placeholder="Nomer Rangka" required="" name="norang">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">
											<label class="control-label" for="nama">Tahun</label>
											<div class="controls">
												<input type="text" placeholder="Tahun" class="span6 disabled" id="tahun" required="" name="tahun" maxlength="4">

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
        		url: "process/mstrstockpro.php",
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
        					document.location='stockview.php';
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