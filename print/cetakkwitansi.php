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
<!-- Copy 2 -->

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
        echo "
        <b>Invoice #".$nonota."</b><br>
        <b>Payment Due:</b> ".$now."<br>";
        ?>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
          <?php
            $rs = mysqli_query($Open,"
                  select a.debet,b.src,b.tgltrx,b.tgljatuhtempo,b.kredit,b.denda,COUNT(case when b.src != 'DP' then 1 else null end) angsuranke
                  From piutang a
                  LEFT JOIN piutangdetail b on a.id = b.piutangid
                  where a.id = $id
                  and tgltrx is not null 
                  ORDER BY tgltrx desc
                  limit 1
                  ");
            while ($rsx = mysqli_fetch_array($rs)) {
              $debet = stripslashes ($rsx['debet']);
              $src = stripslashes ($rsx['src']);
              $tgltrx = stripslashes ($rsx['tgltrx']);
              $tgljatuhtempo = stripslashes ($rsx['tgljatuhtempo']);
              $kredit = stripslashes ($rsx['kredit']);
              $angsuranke = stripslashes ($rsx['angsuranke']);
              $denda = stripslashes ($rsx['denda']);
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
              <td><?php echo number_format($debet); ?></td>
            </tr>
            <tr>
              <th style="width:50%">Pembayaran (Angsuran):</th>
              <td><?php echo number_format($kredit); ?></td>
            </tr>
            <tr>
              <th>Angsuran Ke</th>
              <td><?php echo number_format($angsuranke); ?></td>
            </tr>
            <tr>
              <th>Denda</th>
              <td><?php echo number_format($denda); ?></td>
            </tr>
            <tr>
              <th>Tanggal Bayar</th>
              <td><?php echo $tgltrx; ?></td>
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
