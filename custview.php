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
			            	<h3>Tambah Master Customer Baru <a href="mstrcust.php" class="btn btn-general" id="btn_submit">Tambah</a></h3>
			            </div>
			            <br>
			            <!-- <div class="tab-content"> -->
			            	<!-- <div class="tab-pane" id="formcontrols"> -->       	
			            	
			            		<div class="span11">
			            		<table id="example1" class="table table-bordered table-hover">
			            			<thead>
			            				<th>#</th>
								        <th>Nama</th>
								        <th>Nomer KTP</th>
								        <th>Alamat</th>
								        <th>No Telepon</th>
			            			</thead>
			            			<tbody>
			            				
			            					<?php
			            						$rs = mysqli_query($Open,"
									            select * from mastercustomer
									            ");
									            while ($rsx = mysqli_fetch_array($rs)) {
										            $id = stripslashes ($rsx['id']);
										            $nama= stripslashes ($rsx['nama']);
										            $noktp   = stripslashes ($rsx['noktp']);
										            $alamat   = stripslashes ($rsx['alamat']);
										            $notlp   = stripslashes ($rsx['notlp']);
										            echo "
										            <tr>
										              <td>
										              <a href = 'mstrcust.php?id=".$id."&mode=edit' class='btn btn-info'>Edit</a>
										              <a href = 'process/mstrcustpro.php?id=".$id."&mode=delete' class='btn btn-danger'>delete</a>
										              </td>
										              <td>".$nama."</td>
										              <td>".$noktp."</td>
										              <td>".$alamat."</td>
										              <td>".$notlp."</td>
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