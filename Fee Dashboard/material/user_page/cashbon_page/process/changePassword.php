<?php
session_start();

include "../../../../src/config/connection.php";
$id = $_POST['id'];
$p = md5($_POST['password']);
$np = md5($_POST['Newpassword']);
if($p == $_SESSION['pass']){
    mysqli_query($connect,"UPDATE account SET password = '$np' WHERE id_account = '$id'");
    header("location:../");
}else{
    header("location:../?error=pass");
}