<?php
include '../../../src/config/connection.php';

if(isset($_POST['savedataModal'])){
    $divisi = $_POST['division'];
    $role = $_POST['role'];

    $sql_employee = mysqli_query($connect,"SELECT MAX(id_employee) FROM employee");
    $res_employee = mysqli_fetch_array($sql_employee);
    $employee_id = $res_employee[0];

    mysqli_query($connect,"UPDATE employee SET id_division = '$divisi', id_role = '$role' WHERE id_employee = '$employee_id'");


    header("location: ../index.php?page=profile_details&&id=$employee_id");
}elseif(isset($_POST['savePersonal'])){
    // ambil data file
    $photo = $_FILES['a']['name'];
    $namaSementara = $_FILES['a']['tmp_name'];
    // tentukan lokasi file akan dipindahkan
    $direktori = "../../../src/img/User-img/";
    // pindahkan file
    $terupload = move_uploaded_file($namaSementara, $direktori.$photo);
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $b_place = $_POST['b_place'];
    $b_date = $_POST['b_date'];
    $p_number = $_POST['p_number'];
    $o_cont = $_POST['o_cont'];
    $mother = $_POST['mother'];
    $father = $_POST['father'];
    $status = $_POST['status'];
    $religion = $_POST['religion'];
    $last = $_POST['last'];
    $instit = $_POST['instit'];
    $disease = $_POST['disease'];
    $domicile = $_POST['domicile'];
  

    mysqli_query($connect,"UPDATE employee SET name = '$nama',gender = '$gender', birth_place = '$b_place', birth_date = '$b_date',
    status = '$status', religion = '$religion', domicile = '$domicile', mother_name = '$mother', father_name = '$father', phone_number = '$p_number', other_contact = '$o_cont', 
    last_education = '$last', institution = '$instit', disease_history = '$disease', photo_link='$photo'  WHERE id_employee = '$id'");
    
    header("location: ../index.php?page=profile_details&&id=$id");

}elseif(isset($_POST['btnModalSave'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $divisi = $_POST['division'];
    $role = $_POST['role'];
    $query = mysqli_query($connect,"SELECT * FROM employee WHERE id_employee = '$id'");
    while($data = mysqli_fetch_array($query)){
        $id_account = $data['id_account'];
    }

    mysqli_query($connect,"UPDATE account SET email = '$email' WHERE id_account = '$id_account'");

    mysqli_query($connect,"UPDATE employee SET id_division = '$divisi', id_role = '$role', name = '$name' WHERE id_employee = '$id'");


    header("location: ../index.php?page=employee_list");

}elseif(isset($_POST['btnModalDelete'])){
    $id = $_POST['id'];

    mysqli_query($connect,"DELETE FROM employee WHERE id_employee = '$id'");

    header("location: ../index.php?page=employee_list");

}