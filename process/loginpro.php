<?php
	session_start();
	include '../config/koneksi.php';
	$data = array('success' => false ,'message'=>array(),'saving' => false,'error'=>array());
	//$koneksi=mysqli_connect("localhost", "root", "","dealsys");

	$username = $_POST['username'];
	$pass = md5($_POST['password']);

	$query = "SELECT * FROM users WHERE username = '$username'";
	$hasil = mysqli_query($Open,$query) or die("Error");
	$data_fetch  = mysqli_fetch_array($hasil);

	if ($data_fetch['username'] && $pass ==$data_fetch['password']){
		$_SESSION['username'] = $data_fetch['username'];
		$_SESSION['userid'] = $data_fetch['id'];
		// header("location:../home-admin.php");
		$data['success'] = true;
	}
	else
	{
		$data['message']='E500-03'; //invalid user password
	}
	echo json_encode($data);
?>