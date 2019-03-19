<!DOCTYPE html>
<html lang="en">
<head>
<?php
session_start();
include 'config/koneksi.php';
$userid = $_SESSION['userid'];
  if(!isset($_SESSION['userid'])){
    ?>
      <script language="JavaScript">
        document.location='login.php';
      </script>
    <?php
  }
?>
<meta charset="utf-8">
<title>Dealer Putra Utama Motor</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="asset/css/bootstrap.min.css" rel="stylesheet">
<link href="asset/css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
        rel="stylesheet">
<link href="asset/css/font-awesome.css" rel="stylesheet">
<link href="asset/css/style.css" rel="stylesheet">
<!-- <link href="asset/css/pages/dashboard.css" rel="stylesheet"> -->
<link href="asset/css/pages/signin.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="asset/css/sweetalert2.min.css">
<!-- datatable -->
<link rel="stylesheet" href="asset/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="asset/datatables.net-bs/css/dataTables.bootstrap.min.css">


<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="index.php">Dealer Putra Utama Motor</a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <li class="dropdown"><a href="process/logout.php" class="dropdown-toggle"><i class="icon-cog"></i> Logout <b class="caret"></b></a>
          </li>
        </ul>
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<!-- /navbar -->
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <!-- <li class="active"><a href="index.html"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li> -->
        <?php
          $rs = mysqli_query($Open,"
            select d.*,a.username from users a
            inner join userrole b on a.id = b.userid
            inner join permissionrole c on c.roleid = b.roleid
            inner join permission d on d.id = c.permissionid
            where a.id = $userid
            ");
          $username = '';
          while ($rsx = mysqli_fetch_array($rs)) {
            $username = stripslashes ($rsx['username']);
            $link= stripslashes ($rsx['link']);
            $permissionname   = stripslashes ($rsx['permissionname']);
            $ico   = stripslashes ($rsx['ico']);
            echo "
              <li><a href='".$link."'><i class='".$ico."'></i><span>".$permissionname."</span> </a> </li>
            ";
          }
        ?>
        <!-- <li><a href="<?= $link?>"><i class="<?= $ico?>"></i><span><?= $permissionname?></span> </a> </li> -->
        <!-- <li><a href="guidely.html"><i class="icon-facetime-video"></i><span>App Tour</span> </a></li>
        <li><a href="charts.html"><i class="icon-bar-chart"></i><span>Charts</span> </a> </li>
        <li><a href="shortcodes.html"><i class="icon-code"></i><span>Shortcodes</span> </a> </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-long-arrow-down"></i><span>Drops</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="icons.html">Icons</a></li>
            <li><a href="faq.html">FAQ</a></li>
            <li><a href="pricing.html">Pricing Plans</a></li>
            <li><a href="login.html">Login</a></li>
            <li><a href="signup.html">Signup</a></li>
            <li><a href="error.html">404</a></li>
          </ul>
        </li> -->
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
<!-- /subnavbar -->