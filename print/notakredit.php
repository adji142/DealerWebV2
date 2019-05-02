<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dealer Putra Utama Motor | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../asset/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../asset/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../asset/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../asset/dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <?php 
    include '../config/koneksi.php';
    $now    = date("d-m-Y");
    $id = 0 ;
    $dp = 0 ;
    $nonota = '';
    $tglnota = '';
    $alamatkirim = '';
    $namacust = '';
    $tlp = '';
    $hrgotr = 0;
    if(isset($_GET['id'])) $id = $_GET['id'];
    if(isset($_GET['dp'])) $dp = $_GET['dp'];

    $rs = mysqli_query($Open,"
            select a.id,a.nonota,a.tglnota,COALESCE(a.alamatkirim,mc.alamat) alamat,mc.nama,mc.notlp from penjualan a
            left join penjualandetail b on a.id = b.penjualanid
            left join mastercustomer mc on mc.id = a.customerid
            where a.id = $id
    ");
    $row = mysqli_fetch_assoc($rs);

    $nonota = $row['nonota'];
    $tglnota = $row['tglnota'];
    $alamatkirim = $row['alamat'];
    $namacust = $row['nama'];
    $tlp = $row['notlp'];
  ?>
</head>
<!-- onload="window.print();" -->
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> KWITANSI TANDA TERIMA NOTA KREDIT - Dealer Putra Utama Motor.
          <small class="pull-right"><?php echo $now; ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        To
        <address>
          <strong>Dealer Putra Utama Motor</strong><br>
          Jalan Slamet Riyadi Gayam, Johosari, Joho, <br>
          Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57513<br>
          Phone: 0822-6420-3544<br>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        From
        <address>
        <?php
          echo "<strong>".$namacust."</strong><br>
          ".$alamatkirim."<br>
          Phone: ".$tlp."<br>
          ";
          ?>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <?php
        echo "<h2><b> ASLI </b></h2><br>
        <b>Invoice #".$nonota."</b><br>
        <b>Payment Due:</b> ".$now."<br>";
        ?>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Qty</th>
            <th>UNIT</th>
            <th>Warna</th>
            <th>Tahun</th>
            <th>Nomer Mesin</th>
            <th>Nomer Rangka</th>
            <th>SubTotal</th>
          </tr>
          </thead>
          <tbody>
          <?php
            $rs = mysqli_query($Open,"
                  select b.id,b.qty,b.hrgotr,st.namabarang,st.warna,st.tahun,ts.nomesin,ts.norangka from penjualan a
                  left join penjualandetail b on a.id = b.penjualanid
                  left join stok st on st.id= b.stockid
                  LEFT JOIN tabelstok ts on st.id = ts.barangid
                  where a.id = $id
                  ");
            while ($rsx = mysqli_fetch_array($rs)) {
              $id = stripslashes ($rsx['id']);
              $qty = stripslashes ($rsx['qty']);
              $hrgotr = stripslashes ($rsx['hrgotr']);
              $namabarang = stripslashes ($rsx['namabarang']);
              $warna = stripslashes ($rsx['warna']);
              $tahun = stripslashes ($rsx['tahun']);
              $nomesin = stripslashes ($rsx['nomesin']);
              $norangka = stripslashes ($rsx['norangka']);
              echo "
                <tr>
                  <td>".$qty."</td>
                  <td>".$namabarang."</td>
                  <td>".$warna."</td>
                  <td>".$tahun."</td>
                  <td>".$nomesin."</td>
                  <td>".$norangka."</td>
                  <td>".number_format($hrgotr)."</td>
                </tr>
              ";
            }
          ?>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
        <p class="lead">Payment Methods:</p>
        TUNAI

        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          Biaya pengiriman gratis dan akan di kirim dengan expedisi yang tersedia di dealer menggunakan mobil bak terbuka.
        </p>
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
        <p class="lead">Amount Due <?php echo $now;?></p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td><?php echo number_format($hrgotr); ?></td>
            </tr>
            <tr>
              <th>Tax (10%)</th>
              <td>Included</td>
            </tr>
            <tr>
              <th>Shipping:</th>
              <td>Free</td>
            </tr>
            <tr>
              <th>Total:</th>
              <td><?php echo number_format($hrgotr); ?></td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <div class="row">
      <div class="col-xs-12">
        <table class="table table-striped">
          <thead>
          <tr>
            <td align="center">PENGANTAR</td>
            <td align="center">PENERIMA</td>
          </tr>
          </thead>
          <tr>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td align="center">(....................)</td>
            <td align="center">(....................)</td>
          </tr>
        </table>
      </div>
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->

<!-- Copy 1 -->

<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> KWITANSI TANDA TERIMA NOTA KREDIT - Dealer Putra Utama Motor.
          <small class="pull-right"><?php echo $now; ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        To
        <address>
          <strong>Dealer Putra Utama Motor</strong><br>
          Jalan Slamet Riyadi Gayam, Johosari, Joho, <br>
          Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57513<br>
          Phone: 0822-6420-3544<br>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        From
        <address>
        <?php
          echo "<strong>".$namacust."</strong><br>
          ".$alamatkirim."<br>
          Phone: ".$tlp."<br>
          ";
          ?>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <?php
        echo "<h2><b> COPY 1 </b></h2><br>
        <b>Invoice #".$nonota."</b><br>
        <b>Payment Due:</b> ".$now."<br>";
        ?>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Qty</th>
            <th>UNIT</th>
            <th>Warna</th>
            <th>Tahun</th>
            <th>Nomer Mesin</th>
            <th>Nomer Rangka</th>
            <th>SubTotal</th>
          </tr>
          </thead>
          <tbody>
          <?php
            $rs = mysqli_query($Open,"
                  select b.id,b.qty,b.hrgotr,st.namabarang,st.warna,st.tahun,ts.nomesin,ts.norangka from penjualan a
                  left join penjualandetail b on a.id = b.penjualanid
                  left join stok st on st.id= b.stockid
                  LEFT JOIN tabelstok ts on st.id = ts.barangid
                  where a.id = $id
                  ");
            while ($rsx = mysqli_fetch_array($rs)) {
              $id = stripslashes ($rsx['id']);
              $qty = stripslashes ($rsx['qty']);
              $hrgotr = stripslashes ($rsx['hrgotr']);
              $namabarang = stripslashes ($rsx['namabarang']);
              $warna = stripslashes ($rsx['warna']);
              $tahun = stripslashes ($rsx['tahun']);
              $nomesin = stripslashes ($rsx['nomesin']);
              $norangka = stripslashes ($rsx['norangka']);
              echo "
                <tr>
                  <td>".$qty."</td>
                  <td>".$namabarang."</td>
                  <td>".$warna."</td>
                  <td>".$tahun."</td>
                  <td>".$nomesin."</td>
                  <td>".$norangka."</td>
                  <td>".number_format($hrgotr)."</td>
                </tr>
              ";
            }
          ?>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
        <p class="lead">Payment Methods:</p>
        TUNAI

        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          Biaya pengiriman gratis dan akan di kirim dengan expedisi yang tersedia di dealer menggunakan mobil bak terbuka.
        </p>
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
        <p class="lead">Amount Due <?php echo $now;?></p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td><?php echo number_format($hrgotr); ?></td>
            </tr>
            <tr>
              <th>Tax (10%)</th>
              <td>Included</td>
            </tr>
            <tr>
              <th>Shipping:</th>
              <td>Free</td>
            </tr>
            <tr>
              <th>Total:</th>
              <td><?php echo number_format($hrgotr); ?></td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <div class="row">
      <div class="col-xs-12">
        <table class="table table-striped">
          <thead>
          <tr>
            <td align="center">PENGANTAR</td>
            <td align="center">PENERIMA</td>
          </tr>
          </thead>
          <tr>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td align="center">(....................)</td>
            <td align="center">(....................)</td>
          </tr>
        </table>
      </div>
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>

<!-- Copy 2 -->

<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> KWITANSI TANDA TERIMA NOTA KREDIT - Dealer Putra Utama Motor.
          <small class="pull-right"><?php echo $now; ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        To
        <address>
          <strong>Dealer Putra Utama Motor</strong><br>
          Jalan Slamet Riyadi Gayam, Johosari, Joho, <br>
          Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57513<br>
          Phone: 0822-6420-3544<br>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        From
        <address>
        <?php
          echo "<strong>".$namacust."</strong><br>
          ".$alamatkirim."<br>
          Phone: ".$tlp."<br>
          ";
          ?>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <?php
        echo "<h2><b> COPY 2 </b></h2><br>
        <b>Invoice #".$nonota."</b><br>
        <b>Payment Due:</b> ".$now."<br>";
        ?>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Qty</th>
            <th>UNIT</th>
            <th>Warna</th>
            <th>Tahun</th>
            <th>Nomer Mesin</th>
            <th>Nomer Rangka</th>
            <th>SubTotal</th>
          </tr>
          </thead>
          <tbody>
          <?php
            $rs = mysqli_query($Open,"
                  select b.id,b.qty,b.hrgotr,st.namabarang,st.warna,st.tahun,ts.nomesin,ts.norangka from penjualan a
                  left join penjualandetail b on a.id = b.penjualanid
                  left join stok st on st.id= b.stockid
                  LEFT JOIN tabelstok ts on st.id = ts.barangid
                  where a.id = $id
                  ");
            while ($rsx = mysqli_fetch_array($rs)) {
              $id = stripslashes ($rsx['id']);
              $qty = stripslashes ($rsx['qty']);
              $hrgotr = stripslashes ($rsx['hrgotr']);
              $namabarang = stripslashes ($rsx['namabarang']);
              $warna = stripslashes ($rsx['warna']);
              $tahun = stripslashes ($rsx['tahun']);
              $nomesin = stripslashes ($rsx['nomesin']);
              $norangka = stripslashes ($rsx['norangka']);
              echo "
                <tr>
                  <td>".$qty."</td>
                  <td>".$namabarang."</td>
                  <td>".$warna."</td>
                  <td>".$tahun."</td>
                  <td>".$nomesin."</td>
                  <td>".$norangka."</td>
                  <td>".number_format($hrgotr)."</td>
                </tr>
              ";
            }
          ?>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
        <p class="lead">Payment Methods:</p>
        TUNAI

        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          Biaya pengiriman gratis dan akan di kirim dengan expedisi yang tersedia di dealer menggunakan mobil bak terbuka.
        </p>
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
        <p class="lead">Amount Due <?php echo $now;?></p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td><?php echo number_format($hrgotr); ?></td>
            </tr>
            <tr>
              <th>Tax (10%)</th>
              <td>Included</td>
            </tr>
            <tr>
              <th>Shipping:</th>
              <td>Free</td>
            </tr>
            <tr>
              <th>Total:</th>
              <td><?php echo number_format($hrgotr); ?></td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <div class="row">
      <div class="col-xs-12">
        <table class="table table-striped">
          <thead>
          <tr>
            <td align="center">PENGANTAR</td>
            <td align="center">PENERIMA</td>
          </tr>
          </thead>
          <tr>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td align="center">(....................)</td>
            <td align="center">(....................)</td>
          </tr>
        </table>
      </div>
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- KWITANSI PEMBAYARAN DP -->

<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> KWITANSI PEMBAYARAN UANG MUKA.
          <small class="pull-right"><?php echo $now; ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        To
        <address>
          <strong>Dealer Putra Utama Motor</strong><br>
          Jalan Slamet Riyadi Gayam, Johosari, Joho, <br>
          Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57513<br>
          Phone: 0822-6420-3544<br>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        From
        <address>
        <?php
          echo "<strong>".$namacust."</strong><br>
          ".$alamatkirim."<br>
          Phone: ".$tlp."<br>
          ";
          ?>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <?php
        echo "<h2><b> ASLI </b></h2><br>
        <b>Invoice #".$nonota."</b><br>
        <b>Payment Due:</b> ".$now."<br>";
        ?>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
          <?php
            $rs = mysqli_query($Open,"
                  select b.id,b.qty,b.hrgotr,st.namabarang,st.warna,st.tahun,ts.nomesin,ts.norangka from penjualan a
                  left join penjualandetail b on a.id = b.penjualanid
                  left join stok st on st.id= b.stockid
                  LEFT JOIN tabelstok ts on st.id = ts.barangid
                  where a.id = $id
                  ");
            while ($rsx = mysqli_fetch_array($rs)) {
              $id = stripslashes ($rsx['id']);
              $qty = stripslashes ($rsx['qty']);
              $hrgotr = stripslashes ($rsx['hrgotr']);
              $namabarang = stripslashes ($rsx['namabarang']);
              $warna = stripslashes ($rsx['warna']);
              $tahun = stripslashes ($rsx['tahun']);
              $nomesin = stripslashes ($rsx['nomesin']);
              $norangka = stripslashes ($rsx['norangka']);
            }
          ?>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          Bayarlah angsuran sesuai tanggal jatuhtempo yang sudah di setujui sebelum nya. Kwitansi ini menjadi bukti pembayaran yang sah.

        </p>
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
        <p class="lead">Amount Due <?php echo $now;?></p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td><?php echo number_format($hrgotr); ?></td>
            </tr>
            <tr>
              <th style="width:50%">Pembayaran (DP):</th>
              <td><?php echo $dp; ?></td>
            </tr>
            <tr>
              <th>Tax (10%)</th>
              <td>Included</td>
            </tr>
            <tr>
              <th>Shipping:</th>
              <td>Free</td>
            </tr>
            <tr>
              <th>Total Sisa Saldo Piutang:</th>
              <td><?php echo intval($hrgotr) - intval($dp); ?></td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <div class="row">
      <div class="col-xs-12">
        <table class="table table-striped">
          <thead>
          <tr>
            <td align="center">KASIR</td>
            <td align="center">PELANGGAN</td>
          </tr>
          </thead>
          <tr>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td align="center">(....................)</td>
            <td align="center">(....................)</td>
          </tr>
        </table>
      </div>
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>

<!-- KWITANSI COPY 1 -->

<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> KWITANSI PEMBAYARAN UANG MUKA.
          <small class="pull-right"><?php echo $now; ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        To
        <address>
          <strong>Dealer Putra Utama Motor</strong><br>
          Jalan Slamet Riyadi Gayam, Johosari, Joho, <br>
          Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57513<br>
          Phone: 0822-6420-3544<br>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        From
        <address>
        <?php
          echo "<strong>".$namacust."</strong><br>
          ".$alamatkirim."<br>
          Phone: ".$tlp."<br>
          ";
          ?>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <?php
        echo "<h2><b> COPY 1 </b></h2><br>
        <b>Invoice #".$nonota."</b><br>
        <b>Payment Due:</b> ".$now."<br>";
        ?>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
          <?php
            $rs = mysqli_query($Open,"
                  select b.id,b.qty,b.hrgotr,st.namabarang,st.warna,st.tahun,ts.nomesin,ts.norangka from penjualan a
                  left join penjualandetail b on a.id = b.penjualanid
                  left join stok st on st.id= b.stockid
                  LEFT JOIN tabelstok ts on st.id = ts.barangid
                  where a.id = $id
                  ");
            while ($rsx = mysqli_fetch_array($rs)) {
              $id = stripslashes ($rsx['id']);
              $qty = stripslashes ($rsx['qty']);
              $hrgotr = stripslashes ($rsx['hrgotr']);
              $namabarang = stripslashes ($rsx['namabarang']);
              $warna = stripslashes ($rsx['warna']);
              $tahun = stripslashes ($rsx['tahun']);
              $nomesin = stripslashes ($rsx['nomesin']);
              $norangka = stripslashes ($rsx['norangka']);
            }
          ?>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          Bayarlah angsuran sesuai tanggal jatuhtempo yang sudah di setujui sebelum nya. Kwitansi ini menjadi bukti pembayaran yang sah.

        </p>
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
        <p class="lead">Amount Due <?php echo $now;?></p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td><?php echo number_format($hrgotr); ?></td>
            </tr>
            <tr>
              <th style="width:50%">Pembayaran (DP):</th>
              <td><?php echo $dp; ?></td>
            </tr>
            <tr>
              <th>Tax (10%)</th>
              <td>Included</td>
            </tr>
            <tr>
              <th>Shipping:</th>
              <td>Free</td>
            </tr>
            <tr>
              <th>Total Sisa Saldo Piutang:</th>
              <td><?php echo intval($hrgotr) - intval($dp); ?></td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <div class="row">
      <div class="col-xs-12">
        <table class="table table-striped">
          <thead>
          <tr>
            <td align="center">KASIR</td>
            <td align="center">PELANGGAN</td>
          </tr>
          </thead>
          <tr>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td align="center">(....................)</td>
            <td align="center">(....................)</td>
          </tr>
        </table>
      </div>
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
</body>
</html>
