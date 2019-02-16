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
			            	<h3>Tambah User Baru</h3>
			            </div>
			            <br>
			            <!-- <div class="tab-content"> -->
			            	<!-- <div class="tab-pane" id="formcontrols"> -->
			            		<form id="edit-profile" class="form-horizontal" enctype='application/json'>
			            			<fieldset>
			            				<div class="control-group">
											<label class="control-label" for="username">Username</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="username" placeholder="Username" required="" name="username">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">
											<label class="control-label" for="nama">Nama</label>
											<div class="controls">
												<input type="text" class="span6 disabled" id="nama" placeholder="Nama Lengkap" required="" name="nama">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">
											<label class="control-label" for="password">Password</label>
											<div class="controls">
												<input type="password" class="span6 disabled" id="password" placeholder="Password" required="" name="pass">
											</div> <!-- /controls -->				
										</div> <!-- /control-group -->
										<div class="control-group">
											<label class="control-label">Roles</label>
                                            <div class="controls">
	                                            <label class="radio inline">
	                                              <input type="radio"  name="role" id = "pb" value="pb"> Pembelian
	                                            </label>
                                            
	                                            <label class="radio inline">
	                                              <input type="radio" name="role" id="pj" value="pj"> Penjualan
	                                            </label>

	                                            <label class="radio inline">
	                                              <input type="radio" name="role" id="piut" value="piut"> Piutang
	                                            </label>

	                                            <label class="radio inline">
	                                              <input type="radio" name="role" id="mng" value="mng"> Manager
	                                            </label>
                                          	</div>	<!-- /controls -->		
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
        		url: "process/registrationpro.php",
        		data: me.serialize(),
        		dataType: "json",
        		success: function (response) {
        			if(response.success == true){
        				Swal.fire({
        					title: 'Berhasil',
        					text: 'Data Berhasil di simpan',
        					type: 'success',
        					confirmButtonText: 'Cool'
        				});
        				$('#btn_submit').text('Save');
        				$('#btn_submit').attr('disabled',false);
        				// $('#username').text('');
        				// $('#nama').text('');
        				// $('#password').text('');
        				$('#edit-profile').trigger("reset");
        				
        			}
        			else{
        				if(response.message == 'E500-02'){
        				Swal.fire({
        					title: 'Error !',
        					text: 'Gagal Menyimpan role',
        					type: 'error',
        					confirmButtonText: 'Cool'
        				});
        				}
        				else if(response.message == 'E404-01'){
        				Swal.fire({
        					title: 'Error !',
        					text: 'User Tidak di temukan',
        					type: 'error',
        					confirmButtonText: 'Cool'
        				});
        				}
        				else if(response.message == 'E500-01'){
        				Swal.fire({
        					title: 'Error !',
        					text: 'Gagal Input User',
        					type: 'error',
        					confirmButtonText: 'Cool'
        				});
        				}
        				else{
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