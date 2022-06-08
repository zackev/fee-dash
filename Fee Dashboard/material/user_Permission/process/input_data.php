<?php
include "../../../src/config/connection.php";
if(isset($_POST['btn-Save'])){
    $id = $_POST['id'];
    $email = $_POST['email'];
    $pass = md5($_POST['pass']);
    $role = $_POST['role'];
    mysqli_query($connect,"UPDATE account SET email = '$email', password = '$pass', access_role = '$role' WHERE id_account = '$id' ");
}elseif(isset($_POST['btnModalDelete'])){
    $id = $_POST['id'];
    mysqli_query($connect,"DELETE FROM account WHERE id_account = '$id'");
}elseif(isset($_POST['savePersonal'])){
    // ambil data file
    $photo = $_FILES['a']['name'];
    $namaSementara = $_FILES['a']['tmp_name'];
    // tentukan lokasi file akan dipindahkan
    $direktori = "../../../src/img/User-img/";
    // pindahkan file
    $terupload = move_uploaded_file($namaSementara, $direktori.$photo);

    $divisi = $_POST['division']; 
    $role = $_POST['role'];
    $pass_md =md5('1'); 
    // Personal Information
    $name = $_POST['nama'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $place = $_POST['b_place'];
    $birthday = $_POST['b_date'];
    $phone = $_POST['p_number'];
    $other = $_POST['o_cont'];

    // Additional information
    $dom = $_POST['domicile'];
    $mom = $_POST['mother'];
    $dad = $_POST['father'];
    $status = $_POST['status'];
    $religion = $_POST['religion'];
    $last = $_POST['last'];
    $instit = $_POST['instit'];
    $disease = $_POST['disease'];

    if($email !== 'Email' && $email !== ''){
        $sql_check_biodata = mysqli_query($connect, "SELECT * FROM account WHERE email='$email'");
        if(mysqli_num_rows($sql_check_biodata) < 1) {
            $query_account = mysqli_query($connect,"INSERT INTO account (id_account, email, password, access_role) 
            values ( NULL,  '$email', '$pass_md', 'User')");
        }
    }

    if($email !== 'Email' && $email !== ''){
        $sql_check_email = mysqli_query($connect,"SELECT * FROM account WHERE email='$email'");
        while($row = mysqli_fetch_array($sql_check_email)){
            $id_email = $row['id_account'];
        }
        $sql_check_biodata = mysqli_query($connect, "SELECT * FROM employee WHERE id_account='$id_email'");
        if(mysqli_num_rows($sql_check_biodata) < 1) {
        $query_biodata = "INSERT INTO employee 
        (id_employee , id_account, id_division, id_role, name, 
        gender, birth_place, birth_date, status, religion, domicile, mother_name, 
        father_name, phone_number, other_contact, last_education, institution, disease_history, photo_link) 
        values 
        ( NULL, '$id_email', '$divisi', '$role', '$name', '$gender', '$place', '$birthday',
        '$status','$religion','$dom','$mom','$dad',
        '$phone','$other','$last','$instit','$disease', '$photo')";
        
        $valid = mysqli_query($connect, $query_biodata);
        }
    }
}
header("location:../index.php");