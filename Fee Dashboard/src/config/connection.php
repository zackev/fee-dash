<?php
$connect = mysqli_connect("localhost","root","","db_dashboardfee");

if (mysqli_connect_errno())
{
    echo "Koneksi Error : " . mysqli_connect_error();
}

?>

