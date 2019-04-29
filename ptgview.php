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
								        <th>Denda</th>
								        <th>Saldo</th>
			            			</thead>
			            			<tbody>
			            				
			            					<?php
			            						$rs = mysqli_query($Open,"
									            select p.id,pj.nonota,convert(pj.tglnota,date)tglnota,p.debet otr,
															SUM(case when pd.src ='DP' then kredit else 0 end) dp,
															SUM(case when pd.src !='DP' then kredit else 0 end) pembayaran,
															p.debet - SUM(COALESCE(pd.kredit,0)) saldo,
															max(pd.tgljatuhtempo) jt,
															COUNT(case when pd.src != 'DP' then 1 else null end) angsuranke,
															SUM(denda) denda
															from piutang p
															left join piutangdetail pd on p.id = pd.piutangid
															left join penjualan pj on p.penjualanid = pj.id
															where (select SUM(kredit) from piutangdetail where piutangid = p.id) < p.debet
															group by pj.nonota,pj.tglnota,p.debet
															order by pj.Nonota, pj.tglnota desc
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
										            $denda = stripslashes ($rsx['denda']);
										            echo "
										            <tr>
										              <td>
										              <button class='btn btn-info' id='bayar' value = '".$id."' name ='".$nonota."'>Bayar</button>
										              </td>
										              <td>".$nonota."</td>
										              <td>".$tglnota."</td>
										              <td>".number_format($otr)."</td>
										              <td>".number_format($dp)."</td>
										              <td>".$angsuranke."</td>
										              <td>".$jt."</td>
										              <td>".number_format($pembayaran)."</td>
										              <td>".$denda."</td>
										              <td>".number_format($saldo)."</td>
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

<!-- begin modal -->

<div class="modal fade" id="ModalBayar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">                      
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4>Pembayaran Nota</h4>
          <form id="gobayar" enctype='application/json'>
          <div class="form-group has-feedback">
            <label for="">No Nota<span>*</span></label>
            <input type="hidden" name = "idpiut" id = "idpiut" class="form-control" readonly="">
            <input type="hidden" name = "tempo" id = "tempo" class="form-control" readonly="">
            <input type="hidden" name = "otr" id = "otr" class="form-control" readonly="">
            <input type="text" name = "nonota" id = "nonota" class="form-control" readonly="">
          </div>

          <div class="form-group has-feedback">
            <label for="">Angsuranke<span>*</span></label>
            <input type="text" name = "angsuranke" id = "angsuranke" class="form-control" readonly="">
          </div>
          <div class="form-group has-feedback">
            <label for="">Angsuran<span>*</span></label>
            <input type="text" name = "angsuranpokok" id = "angsuranpokok" class="form-control" readonly="">
          </div>
          <div class="form-group has-feedback">
            <label for="">Denda<span>*</span></label>
            <input type="text" name = "denda" id = "denda" class="form-control" readonly="">
          </div>
          <div class="form-group has-feedback">
            <label for="">Total Angsuran<span>*</span></label>
            <input type="text" name = "rpangsuran" id = "rpangsuran" class="form-control" readonly="">
          </div>
          <div class="form-group has-feedback">
            <label for="">RpBayar<span>*</span></label>
            <input type="text" name = "Bayar" id = "Bayar" class="form-control" placeholder="Bayar">
          </div>
          </form>
          <button class="btn btn-general" id="btn_bayar">Bayar</button>
          <button class="btn btn-danger" id="btn_lunas">Bayar Lunas</button>
        </div>                        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
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
    $("#:button").click(function () {
        var id = $(this).prop("value");
        var nonota =$(this).prop("name");
        GetPiutang(id);
  //       Swal.fire({
		//   title: 'Apakah anda yakin?',
		//   text: "Apakah anda yakin akan membayar nota "+ nonota + " ?",
		//   type: 'warning',
		//   showCancelButton: true,
		//   confirmButtonColor: '#3085d6',
		//   cancelButtonColor: '#d33',
		//   confirmButtonText: 'Ya, Yakin!'
		// }).then((result) => {
		//   if (result.value) {
		//     // mulai ajax beraksi close sementara
		//     // $.ajax({
		//     // 	type: "post",
  //     //   		url: "process/bayarpro.php",
  //     //   		data: {id:id},
  //     //   		dataType: "json",
  //     //   		success: function (response) {
  //     //   			if(response.success == true){
  //     //   				Swal.fire({
  //     //   					title: 'Berhasil',
  //     //   					text: 'Data Berhasil di simpan',
  //     //   					type: 'success',
  //     //   					confirmButtonText: 'Cool'
  //     //   				}).then(function() {
  //     //   					document.location='ptgview.php';
  //     //   				});
  //     //   			}
  //     //   			else
  //     //   			{
  //     //   				Swal.fire({
  //     //   					title: 'Error !',
  //     //   					text: 'Gagal Input Data Stock',
  //     //   					type: 'error',
  //     //   					confirmButtonText: 'Cool'
  //     //   				});	
  //     //   			}
  //     //   		}
		//     // });
		//   }
		// })

    });

    // action button
    $("#btn_bayar").click(function () {
    	// begin logic pembayaran
    	var id = $('#idpiut').val();
    	var nonota = $('#nonota').val();
    	// alert(id);
    	Swal.fire({
		  title: 'Apakah anda yakin?',
		  text: "Apakah anda yakin akan membayar nota "+ nonota + " ?",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Ya, Yakin!'
		}).then((result)=>{
			if (result.value) {
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
        					window.open('print/cetakkwitansi.php?id='+id, '_blank');
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
		});
    });

    $('#btn_lunas').click(function (){
		var id = $('#idpiut').val();
    	var otr = $('#otr').val();
    	var angsuran = $('#angsuranpokok').val();
    	var tempo = $('#tempo').val();
    	var sisaangsuran =(angsuran * (tempo-$('#angsuranke').val()-1));
    	var totalpotongan = sisaangsuran*7/100;
    	var totalbayar = 0;
    	var pelunasan = "ya";
    	if(sisaangsuran>=6){
    		totalbayar = sisaangsuran - totalpotongan;
    	}
    	Swal.fire({
		  title: 'Apakah anda yakin?',
		  text: "Apakah anda yakin akan membayar Lunas nota ?",
		  html : "<table>"+
		  			"<tr>"+
		  				"<td>OTR</td>"+
		  				"<td>:</td>"+
		  				"<td>"+otr+"</td>"+
		  			"</tr>"+
		  			"<tr>"+
		  				"<td>Total Sisa Angsuran Pokok plus bunga</td>"+
		  				"<td>:</td>"+
		  				"<td>"+sisaangsuran+"</td>"+
		  			"</tr>"+
		  			"<tr>"+
		  				"<td>Total Diskon potongan</td>"+
		  				"<td>:</td>"+
		  				"<td>"+sisaangsuran * 7/100+"</td>"+
		  			"</tr>"+
		  			"<tr>"+
		  				"<td>Total Bayar</td>"+
		  				"<td>:</td>"+
		  				"<td>"+totalbayar+"</td>"+
		  			"</tr>"+
		  			"</table>",
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Ya, Yakin!'
		}).then((result)=>{
			if (result.value) {
				$.ajax({
		    	type: "post",
        		url: "process/bayarpro.php",
        		data: {id:id,pelunasan:pelunasan},
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
		});
    });
  });
  function GetPiutang(piutid){
  	// $('#ModalBayar').modal('show');
  	var sisahutang =0;
  	var angsuran =0;
  	var bunga =0;
  	var TotalAngsuran =0;
  	var now = new Date();
  	$.ajax({
	   	type: "post",
		url: "process/getPiutang.php",
		data: {piutid:piutid},
		dataType: "json",
		success: function (response) {
			if(response.success == true){

				$.each(response.data,function (k,v) {
					sisahutang = v.otr - v.dp;
					angsuran = sisahutang / v.tempo;
					bunga = sisahutang * 2/100;
					var jt = new Date(v.jt);
					var denda = 0;
					var angsuranpokok = 0;
					9
					angsuranpokok = Math.round(angsuran) + Math.round(bunga);
					//alert(jt)
					// alert(now)
					if(jt < now && jt != 'Wed Jan 01 1000 07:07:12 GMT+0707 (Western Indonesia Time)'){
						denda = angsuranpokok * 0.5/100;
					}
					TotalAngsuran = Math.round(angsuran) + Math.round(bunga) + denda;
					$('#idpiut').val(v.id);
					$('#nonota').val(v.nonota);
					$('#angsuranke').val(v.angsuranke);
					$('#rpangsuran').val(formatNumber(TotalAngsuran));
					$('#Bayar').val(formatNumber(TotalAngsuran));
					$('#denda').val(formatNumber(denda));
					$('#angsuranpokok').val(formatNumber(angsuranpokok));
					$('#tempo').val(v.tempo);
					$('#otr').val(formatNumber(v.otr));
					$('#ModalBayar').modal('show');
				});
			}
		}
  	});
  }
	function formatNumber(num) {
	  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
	}
</script>
