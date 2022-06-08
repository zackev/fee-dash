<?php
    
include '../../../src/config/connection.php';

error_reporting(0);
if(isset($_POST["submitCsv"]))
{
    if($_FILES['file']['name'])
    {
        $filename = explode(".", $_FILES['file']['name']);
        if($filename[1] == 'csv')
        {

            $handle = fopen($_FILES['file']['tmp_name'], "r");
            while($data = fgetcsv($handle))
            {
                $email                  = mysqli_real_escape_string($connect, $data[0]);  
                $pass_def               = mysqli_real_escape_string($connect, $data[1]);
                $nama_lengkap           = mysqli_real_escape_string($connect, $data[2]);
                $gender                 = mysqli_real_escape_string($connect, $data[3]);  
                $tempat_lahir           = mysqli_real_escape_string($connect, $data[4]);  
                $tgl_lahir              = mysqli_real_escape_string($connect, $data[5]);  
                $status                 = mysqli_real_escape_string($connect, $data[6]);
                $religion               = mysqli_real_escape_string($connect, $data[7]);
                $domicile               = mysqli_real_escape_string($connect, $data[8]);
                $mother_name            = mysqli_real_escape_string($connect, $data[9]);
                $father_name            = mysqli_real_escape_string($connect, $data[10]);
                $no_hp1                 = mysqli_real_escape_string($connect, $data[11]);
                $no_hp2                 = mysqli_real_escape_string($connect, $data[12]);
                $pendidikan             = mysqli_real_escape_string($connect, $data[13]);
                $institusi              = mysqli_real_escape_string($connect, $data[14]);
                $riwayat_penyakit       = mysqli_real_escape_string($connect, $data[15]);
                $pass_md = md5($pass_def);

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
                    ( NULL, '$id_email', '', '', '$nama_lengkap', '$gender', '$tempat_lahir', '$tgl_lahir',
                    '$status','$religion','$domicile','$mother_name','$father_name',
                    '$no_hp1','$no_hp2','$pendidikan','$institusi','$riwayat_penyakit', '')";
                    
                    $valid = mysqli_query($connect, $query_biodata);

                    if(!$valid){
                        header("location: ../index.php?page=employee_list&&valid=Failed");
                    }else{
                        header("location: ../index.php?page=employee_list&&valid=success");
                    }
                    }else{}
                }
                
            }
        }   
    }
}
