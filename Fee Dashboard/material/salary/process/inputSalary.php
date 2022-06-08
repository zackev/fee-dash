<?php
session_start();
 if(!isset($_SESSION['email']) ) {
     header('location: ../login/index.php');
     exit;
 }else{
     if($_SESSION['role'] == 'User'){
         header('location:  ../user_page/salary_user/');
     }
 }
include "../../../src/config/connection.php";
if(isset($_POST['submit'])){
    $id = $_SESSION['id'];
    $data = $_POST;
    $sqlAcc = mysqli_query($connect,"SELECT id_employee FROM employee  WHERE id_account = '$id'");
    while($dataAcc = mysqli_fetch_array($sqlAcc)){
            $idempl = $dataAcc['id_employee'];
            $date = date("Y-m-d");
            mysqli_query($connect,"INSERT INTO activity VALUES (NULL,'$idempl','$date','')");
            $idActiv = mysqli_query($connect,"SELECT MAX(id_activity) as id FROM activity");
            while($r = mysqli_fetch_array($idActiv)){
                $rID = $r['id'];
                $count = count($_POST['name']);
                for($i=0; $i < $count; $i++){
                    $sql = mysqli_query($connect,"INSERT INTO fee  VALUES (NULL,'','{$_POST['name'][$i]}','$rID','$date','{$_POST['basic'][$i]}','{$_POST['transport'][$i]}','{$_POST['absen'][$i]}','{$_POST['overtime'][$i]}','{$_POST['cashbon'][$i]}','{$_POST['tip'][$i]}','','{$_POST['more'][$i]}','{$_POST['total'][$i]}','{$_POST['note'][$i]}','') ");
                   print_r($_POST['name'][$i]);
                }
            }
    }

    $date = date("Y-m-d");
    $sql = mysqli_query($connect,"SELECT fee.id_fee, cashbon.id_cashbon, cashbon.id_employee FROM fee JOIN cashbon ON cashbon.id_employee = fee.id_employee WHERE fee.cashbon != 0 && cashbon.status = 'active' && fee.date='$date'");
    while($r = mysqli_fetch_array($sql)){
        $idfee = $r['id_fee'];
        $idcashbons = $r['id_cashbon'];
        $a = str_split($idfee);
        $b = str_split($idcashbons);
        for($i=0; $i < COUNT($a); $i++){
            for($j=0;$j<COUNT($b);$j++){

                mysqli_query($connect,"INSERT INTO installment VALUES (NULL,'$idcashbons[$j]','$idfee[$i]')");
            }
        }
    }
    header("location:../?page=plusSalary");
}elseif(isset($_POST['save'])){
    $idActive = $_POST['idActive'];
    echo $idActive;
    $data = $_POST;
    $date = $_POST['date'];
    $count = count($_POST['basic']);
    for($i=0; $i < $count; $i++){
        $sql = mysqli_query($connect,"UPDATE fee  SET basic_fee = '{$_POST['basic'][$i]}', transport_fee = '{$_POST['transport'][$i]}', absent = '{$_POST['absen'][$i]}', overtime = '{$_POST['overtime'][$i]}', cashbon = '{$_POST['cashbon'][$i]}',tip = '{$_POST['tip'][$i]}',more = '{$_POST['more'][$i]}', note = '{$_POST['note'][$i]}' WHERE id_fee = '{$_POST['id'][$i]}' && id_activity = '$idActive'");
    }
    header("location:../index.php?page=details&&idActiv=$idActive&&date=$date");

}elseif(isset($_POST['btnCreate'])){
    $name = $_POST['name'];
    $debit = $_POST['debit'];
    $casbon = $_POST['cashbon'];
    $date = date('Y-m-d');
    $exp = explode("-", $date);
    $month = $exp[1];
    $fee = mysqli_query($connect,"SELECT AVG(total) FROM fee WHERE id_employee = '$name'");
    while($avg = mysqli_fetch_array($fee)){
        $avgrate = $avg['AVG(total)'];
    }
    // menghitung maksimal cashbon
    $countpaid = $avgrate / 3;
    // membulatkan bilangan 
    $roundpaid =  round($countpaid);

    if($casbon > $roundpaid){
        header("location:../index.php?page=cashbond&&alert=max");
    }else{
        $query = mysqli_query($connect,"SELECT * FROM cashbon WHERE id_employee = '$name' && status='active'");
        $id = mysqli_fetch_array($query);

        // looping jika data cashbon active maka tidak akan bisa untuk cashbon lagi jika tidak maka akan di proses
       if(mysqli_num_rows($query) > 0){
            header("location:../index.php?page=cashbond&&alert=on");
       }else{
            //insert ke tabel cashbon
            mysqli_query($connect,"INSERT INTO cashbon VALUES (NULL, '$name','$date','$casbon','active','')");
           
            header("location:../index.php?page=cashbond");
       }
    }

}elseif(isset($_POST['input_cash'])){
    $id = $_POST['id'];
    $idCashbon = $_POST['idCashbon'];
    $date = $_POST['date'];
    $explode= explode("-",$date);  
    $month = $explode[1];
    $value = $_POST['value'];

    // proses mengambil total fee
    $idfee = mysqli_query($connect,"SELECT * FROM fee WHERE id_employee = '$id' && MONTH(date) = '$month'");
    while($row = mysqli_fetch_array($idfee)){
        $total = $row['total'];
    }

    // menghitung total fee setelah dikurangi cicilan
    $jumlah = $total - $value;
    // proses UPDATE cashbon dan total fee di tabel database fee
    mysqli_query($connect,"UPDATE fee SET cashbon = '$value',total = '$jumlah' WHERE id_employee = '$id' && MONTH(date) = '$month'");
   
    // Proses meng-update status, jika totalnominal nya sama dengan 0 maka akan di update menjadi complete jika tidak maka tetap active
    $cashbon = mysqli_query($connect,"SELECT * FROM cashbon WHERE id_employee = '$id' && status = 'active'");
    while($rowCashbon =  mysqli_fetch_array($cashbon)){
        $nominal = $rowCashbon['nominal'];
        $totalNominal = $nominal - $value;

        if($totalNominal == 0){
            mysqli_query($connect,"UPDATE cashbon SET status = 'complete' WHERE id_employee = '$id' && status = 'active'");
        }
    }
    
    // proses kembali ke halaman detail cashbon
    header("location:../?page=detailsCashbon&&id=$idCashbon");
    
}elseif(isset($_POST['validate'])){
    $id = $_POST['id'];
    $date = $_POST['date'];
    mysqli_query($connect,"UPDATE cashbon SET status = 'active' WHERE id_employee = '$id' && date = '$date'");
    header("location:../index.php?page=cashbond");

}elseif(isset($_POST['reject'])){
    $id = $_POST['id'];
    $date = $_POST['date'];
    mysqli_query($connect,"UPDATE cashbon SET status = 'reject' WHERE id_employee = '$id' && date = '$date'");
    header("location:../index.php?page=cashbond");
}