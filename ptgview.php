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
			            	<h3>Status Piutang dan pembayaran</h3>
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
								        <th>OTR</th>
								        <th>DP</th>
								        <th>Pembayaran ke</th>
								        <th>Jatuh Tempo</th>
								        <th>Pembayaran</th>
								        <th>Saldo</th>
			            			</thead>
			            			<tbody>
			            				
			            					<?php
			            						$rs = mysqli_query($Open,"
									            select p.id,pj.nonota,convert(pj.tglnota,date)tglnota,p.debet otr,
												SUM(case when pd.src ='DP' then kredit else 0 end) dp,
												SUM(case when pd.src !='DP' then kredit else 0 end) pembayaran,
												p.debet - SUM(COALESCE(pd.kredit,0)) saldo,
												DATE_ADD(max(pd.tgljatuhtempo),INTERVAL 30 day) jt,
												COUNT(case when pd.src != 'DP' then 1 else null end) angsuranke
												from piutang p
												left join piutangdetail pd on p.id = pd.piutangid
												left join penjualan pj on p.penjualanid = pj.id
												group by pj.nonota,pj.tglnota,p.debet
									            ");
									            while ($rsx = mysqli_fetch_array($rs)) {
										            $id = stripslashes ($rsx['id']);
										            $nonota = stripslashes ($rsx['nonota']);
										            $tglnota = stripslashes ($rsx['tglnota']);
										            $otr = stripslashes ($rsx['otr']);
										            $dp = stripslashes ($rsx['dp']);
										            $pembayaran = stripslashes ($rsx['pembayaran']);
										            $saldo = stripslashes ($rsx['saldo']);
										            $jt = stripslashes ($rsx['jt']);
										            $angsuranke = stripslashes ($rsx['angsuranke']);
										            echo "
										            <tr>
										              <td>
										              <button class='btn btn-info' id = 'bayar' value = '".$id."' name = '".$nonota."'>Bayar</button>
										              </td>
										              <td>".$nonota."</td>
										              <td>".$tglnota."</td>
										              <td>".$otr."</td>
										              <td>".$dp."</td>
										              <td>".$angsuranke."</td>
										              <td>".$jt."</td>
										              <td>".$pembayaran."</td>
										              <td>".$saldo."</td>
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
    	// dom :'Bfrtip',
    	// buttons	: ['excel','print']
    })
    // $(document).ready(function(){
    // 	$('#example1').DataTable({
    // 		dom :'Bfrtip'
    // 		buttons:
    // 	})
    // });
    $("#bayar:button").click(function () {  
        var id = $(this).prop("value");
        var nonota =$(this).prop("name");

        Swal.fire({
		  title: 'Apakah anda yakin?',
		  text: "Apakah anda yakin akan membayar nota "+ nonota + " ?",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Ya, Yakin!'
		}).then((result) => {
		  if (result.value) {
		    // mulai ajax beraksi
		    $.ajax({
		    	type: "post",
        		url: "process/bayarpro.php",
        		data: {id:id},
        		dataType: "json",
        		success: function (response) {
        			if(response.success == true){
        				Swal.fire({
        					title: 'Berhasil',
        					text: 'Data Berhasil di simpan',
        					type: 'success',
        					confirmButtonText: 'Cool'
        				}).then(function() {
        					document.location='ptgview.php';
        				});
        			}
        			else
        			{
        				Swal.fire({
        					title: 'Error !',
        					text: 'Gagal Input Data Stock',
        					type: 'error',
        					confirmButtonText: 'Cool'
        				});	
        			}
        		}
		    });
		  }
		})

    });
  })
</script>