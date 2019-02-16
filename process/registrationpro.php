<?php
	include '../config/koneksi.php';
	$data = array('success' => false ,'message'=>array(),'saving' => false,'error'=>array());
	// print_r($_POST);
	// Variable parsing dari Form Tampilan

	$username = $_POST['username'];
	$fullname = $_POST['nama'];
	$pass	  = md5($_POST['pass']);
	$role	  = $_POST['role'];
	$now	  = date("Y-m-d");

	// Proses input user
	$input	="INSERT INTO users (username, nama, password, createdon,createdby) VALUES 
	('$username','$fullname','$pass','$now','System')";
	$query_input =mysqli_query($Open,$input);

	if ($query_input) {
		$rs = mysqli_query($Open,"Select * from users where username = '$username'");
		$row = mysqli_fetch_assoc($rs);
		if($role=="pb"){
			if($row){
				$input	="INSERT INTO userrole 
				VALUES 
				(".$row['id'].",3)";
				$query_input =mysqli_query($Open,$input);	

				if($query_input){
					$data['success'] = true; // berhasil input role
				}
				else
				{
					$data['message'] = 'E500-02'; // Gagal input role
				}
			}
			else{
				$data['message'] = 'E404-01'; // Data user tidak di temukan saat input role
			}
		}
		else if($role =="pj"){
			if($row){
				$input	="INSERT INTO userrole VALUES 
				(".$row['id'].",4)";
				$query_input =mysqli_query($Open,$input);

				if($query_input){
					$data['success'] = true; // berhasil input role
				}
				else
				{
					$data['message'] = 'E500-02'; // Gagal input role
				}			
			}
			else{
				$data['message'] = 'E404-01'; // Data user tidak di temukan saat input role
			}
		}
		else if ($role == "piut"){
			if($row){
				$input	="INSERT INTO userrole VALUES 
				(".$row['id'].",2)";
				$query_input =mysqli_query($Open,$input);	

				if($query_input){
					$data['success'] = true; // berhasil input role
				}
				else
				{
					$data['message'] = 'E500-02'; // Gagal input role
				}		
			}
			else{
				$data['message'] = 'E404-01'; // Data user tidak di temukan saat input role
			}
		}
		else if($role == "mng"){
			if($row){
				$input	="INSERT INTO userrole VALUES 
				(".$row['id'].",1)";
				$query_input =mysqli_query($Open,$input);		

				if($query_input){
					$data['success'] = true; // berhasil input role
				}
				else
				{
					$data['message'] = 'E500-02'; // Gagal input role
				}	
			}
			else{
				$data['message'] = 'E404-01'; // Data user tidak di temukan saat input role
			}
		}
		else{
			$data['message'] = 'E404-02'; // Role tidak di temukan
		}
	}
	else
	{
		$data['message'] = 'E500-01'; // Gagal simpan data user
	}

	echo json_encode($data);
?>