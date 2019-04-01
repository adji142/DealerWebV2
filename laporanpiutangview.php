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

			            	<h3>Laporan Piutang angsuran</h3>

			            </div>

			            <br>

			            <!-- <div class="tab-content"> -->

			            	<!-- <div class="tab-pane" id="formcontrols"> -->       	

			            	

			            		<div class="span11">

			            		<table id="example1" class="table table-bordered table-hover">

			            			<thead>

								        <th>Nama Customer</th>

								        <th>No Nota</th>

								        <th>Tgl Nota</th>

								        <th>Tempo (Bulan)</th>

								        <th>Jenis Transaksi</th>

								        <th>Tgl Pembayaran</th>

								        <th>Keterangan</th>

								        <th>Debet</th>

								        <th>Kredit</th>

			            			</thead>

			            			<tbody>

			            				

			            					<?php

			            						$rs = mysqli_query($Open,"

									            select ms.nama,pj.nonota,pj.tempo,pj.jenistrx,CONVERT(pj.tglnota,date) tglnota,pd.tgljatuhtempo,pd.src,coalesce(p.debet,0) debet,coalesce(pd.kredit,0) + coalesce(pd.denda,0) kredit

												from piutang p

												inner join piutangdetail pd on p.id = pd.piutangid

												inner join penjualan pj on pj.id = p.penjualanid

												inner join mastercustomer ms on ms.id = pj.customerid
												order by pj.tglnota desc
									            ");

									            while ($rsx = mysqli_fetch_array($rs)) {

										            $nonota = stripslashes ($rsx['nonota']);

										            $tglnota = stripslashes ($rsx['tglnota']);

										            $tempo = stripslashes ($rsx['tempo']);

										            $jenistrx = stripslashes ($rsx['jenistrx']);

										            $tgljt = stripslashes ($rsx['tgljatuhtempo']);

										            $src = stripslashes ($rsx['src']);

										            $debet = stripslashes ($rsx['debet']);

										            $kredit = stripslashes ($rsx['kredit']);

										            $nama = stripslashes ($rsx['nama']);

										            echo "

										            <tr>

										              <td>".$nama."</td>

										              <td>".$nonota."</td>

										              <td>".date('d-m-y',strtotime($tglnota))."</td>

										              <td>".$tempo."</td>

										              <td>".$jenistrx."</td>

										              <td>".date('d-m-y',strtotime($tgljt))."</td>

										              <td>".$src."</td>

										              <td>".number_format($debet)."</td>

										              <td>".number_format($kredit)."</td>

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
