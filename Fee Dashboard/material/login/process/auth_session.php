<?php
// mengaktifkan session php
session_start();
 
// menghubungkan dengan koneksi
include '../../../src/config/connection.php';
 
// menangkap data yang dikirim dari form
$email = $_POST['email'];
$password = md5($_POST['pass']);

// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($connect,"SELECT * FROM account WHERE email='$email' and password='$password'");

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);
$row = mysqli_fetch_array($data);
if($cek > 0){
	$_SESSION['email'] = $row['email'];
	$_SESSION['password'] = $row['password'];
	$_SESSION['id'] = $row['id_account'];
	$_SESSION['role'] = $row['access_role'];
        if($_SESSION['role'] == 'Admin'){
            header("location:../../dashboard/index.php");
        }elseif($_SESSION['role'] == 'User'){
            header("location: ../../user_page/salary_user/index.php");
        }
}else{
	header("location:../index.php?error=Login Failed");
}