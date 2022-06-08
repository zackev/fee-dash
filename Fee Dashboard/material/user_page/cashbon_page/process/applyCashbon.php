<?php
include '../../../../src/config/connection.php';

if(isset($_POST['apply'])){
    $id = $_POST['id'];
    $value = $_POST['value'];
    $date = date('Y-m-d');

    $fee = mysqli_query($connect,"SELECT AVG(total) FROM fee WHERE id_employee = '$id'");
    while($avg = mysqli_fetch_array($fee)){
        $avgrate = $avg['AVG(total)'];
    }
    // menghitung maksimal cashbon
    $countpaid = $avgrate / 3;
    // membulatkan bilangan 
    $roundpaid =  round($countpaid);

    if($value > $roundpaid){
        header("location:../index.php?alert=max");
    }else{
        $query = mysqli_query($connect,"SELECT * FROM cashbon WHERE id_employee = '$id' && status='active'");
       if(mysqli_num_rows($query) > 0){
           
            header("location:../index.php?alert=on");
       }else{
        echo "a";
           mysqli_query($connect,"INSERT INTO cashbon VALUES (NULL, '$id','$date','$value','pending','')");
        }
    header("location: ../");
    }
}