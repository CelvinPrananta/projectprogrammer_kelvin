<?php 
session_start();
include 'koneksi.php';
$username = $_POST['username'];
$password = md5($_POST['password']);
$data = mysqli_query($koneksi,"select * from userdata where username='$username' and password='$password'");
if($cek > 0){
	$data = mysqli_fetch_assoc($data);
	if($data['level']=="admin"){
		$_SESSION['username'] = $username;
        $_SESSION['status'] = "login";
		$_SESSION['level'] = "admin";
	header("location:admin/");
	}else if($data['level']=="author"){
		$_SESSION['username'] = $username;
        $_SESSION['status'] = "login";
		$_SESSION['level'] = "author";
		header("location:author/");
	}else if($data['level']=="member"){
		$_SESSION['username'] = $username;
        $_SESSION['status'] = "login";
		$_SESSION['level'] = "member";
		header("location:member/");
    }else{
		header("location:index.php?pesan=gagal");
	}	
	}else{
		header("location:index.php?pesan=gagal");
	}
?>