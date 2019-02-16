<?php
	session_start();
	$data = array('success' => false ,'message'=>array(),'saving' => false,'error'=>array());
	$koneksi=mysqli_connect("localhost", "root", "","dealsys");

	$username = $_POST['username'];
	$pass = md5($_POST['password']);

	$query = "SELECT * FROM users WHERE username = '$username'";
	$hasil = mysqli_query($koneksi,$query) or die("Error");
	$data  = mysqli_fetch_array($hasil);

	if ($data['username'] && $pass ==$data['password']){
		$_SESSION['username'] = $data['username'];
		$_SESSION['userid'] = $data['id'];
		// header("location:../home-admin.php");
		$data['success'] = true;
	}
	else
	{
		$data['message']='E500-03'; //invalid user password
	}
	echo json_encode($data);
?>