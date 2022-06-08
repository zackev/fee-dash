<?php
include "../../../src/config/connection.php";

if(isset($_POST["input_div"])){
    $value = $_POST['value'];

    mysqli_query($connect,"INSERT INTO division VALUES (NULL, '$value')");

    header("location: ../index.php?page=personalia");
}elseif(isset($_POST["btn-Save"])){
    $id = $_POST['id'];
    $division = $_POST['division_name'];

    mysqli_query($connect,"UPDATE division SET division_name = '$division' WHERE id_division = $id");

    header("location: ../index.php?page=personalia");
}elseif(isset($_POST['delete'])){
    $id = $_POST['id'];

    mysqli_query($connect,"DELETE FROM division WHERE id_division = $id");
    header("location: ../index.php?page=personalia");

}elseif(isset($_POST['input_role'])){
    $value = $_POST['value'];
    $id_divisi = $_POST['id'];
    mysqli_query($connect,"INSERT INTO role VALUES (NULL, $id_divisi ,'$value', '0')");
    header("location: ../index.php?page=personalia");

}elseif(isset($_POST['saveRole'])){
    $id = $_POST['id'];
    $role = $_POST['title'];

    mysqli_query($connect,"UPDATE role SET role_name = '$role' WHERE id_role = $id");

    header("location: ../index.php?page=personalia");

}elseif(isset($_POST['deleterole'])){
    $id = $_POST['id'];

    mysqli_query($connect,"DELETE FROM role WHERE id_role = $id");
    header("location: ../index.php?page=personalia");

}elseif(isset($_POST['savesalary'])){
    $id = $_POST['id'];
    $role = $_POST['title'];
    $basic = $_POST['basic'];

    mysqli_query($connect,"UPDATE role SET basic_fee = '$basic' WHERE id_role = $id");

    header("location: ../index.php?page=Salary");
}elseif(isset($_POST['deletebasic'])){
    
    $id = $_POST['id'];

    mysqli_query($connect,"DELETE FROM role WHERE id_role = $id");

    header("location: ../index.php?page=Salary");

}elseif(isset($_POST['input_nom'])){
    $value = $_POST['value'];
    $id = $_POST['role'];
    
    mysqli_query($connect,"UPDATE role SET basic_fee = '$value' WHERE id_role = $id");
    header("location: ../index.php?page=Salary");
}