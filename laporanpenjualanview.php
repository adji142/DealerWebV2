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

			            	<h3>Laporan Penjualan</h3>

			            </div>

			            <br>

			            <!-- <div class="tab-content"> -->

			            	<!-- <div class="tab-pane" id="formcontrols"> -->       	

			            	

			            		<div class="span11">

			            		<table id="example1" class="table table-bordered table-hover">

			            			<thead>

								        <th>No Nota</th>

								        <th>Tgl Nota</th>

								        <th>Tempo (Bulan)</th>

								        <th>Jenis Transaksi</th>

								        <th>Nama Unit</th>

								        <th>Warna</th>

								        <th>Nomer Mesin</th>

								        <th>Nomer Rangka</th>

								        <th>Qty</th>

								        <th>Harga</th>

			            			</thead>

			            			<tbody>

			            				

			            					<?php

			            						$rs = mysqli_query($Open,"

									            select a.nonota,convert(a.tglnota,date)tglnota,a.tempo,a.jenistrx,s.namabarang,s.warna,ts.nomesin,ts.norangka,sum(b.qty) qty,sum(b.hrgotr) hrg from penjualan a

inner join penjualandetail b on a.id = b.penjualanid

left join stok s on s.id = b.stockid
left join tabelstok ts on s.id = ts.barangid
group by a.nonota,a.tglnota,a.tempo,a.jenistrx,s.namabarang,s.warna,ts.nomesin,ts.norangka
order by a.tglnota desc

									            ");

									            while ($rsx = mysqli_fetch_array($rs)) {

										            $nonota = stripslashes ($rsx['nonota']);

										            $tglnota = stripslashes ($rsx['tglnota']);

										            $tempo = stripslashes ($rsx['tempo']);

										            $jenistrx = stripslashes ($rsx['jenistrx']);

										            $namabarang = stripslashes ($rsx['namabarang']);

										            $warna = stripslashes ($rsx['warna']);

										            $hrgotr = stripslashes ($rsx['hrg']);

										            $nomesin = stripslashes ($rsx['nomesin']);

										            $norangka = stripslashes ($rsx['norangka']);

										            $qty = stripslashes ($rsx['qty']);

										            echo "

										            <tr>

										              <td>".$nonota."</td>

										              <td>".date('d-m-y',strtotime($tglnota))."</td>

										              <td>".$tempo."</td>

										              <td>".$jenistrx."</td>

										              <td>".$namabarang."</td>

										              <td>".$warna."</td>

										              <td>".$nomesin."</td>

										              <td>".$norangka."</td>

										              <td>".$qty."</td>

										              <td>".number_format($hrgotr)."</td>

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
