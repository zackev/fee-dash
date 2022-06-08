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

include "../../src/config/connection.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;700&family=Poppins:wght@100;300;600&display=swap" rel="stylesheet">
    
    <!-- View -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="../../src/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>
<body style="overflow-x: hidden;">
    <div class="grid-content">
        <div class="navbarDiv">
            <nav align="center">
                <div class="item" align="left">
                    <div class="logo">
                        <a href="">
                            <img src="../../src/img/LOGO-RRG.svg"/>
                        </a>
                        </div>
                    
                    <ul style="padding-left: 0 !important;">
                        <li class="" data-toggle="tooltip" data-placement="right" title="Dashboard (coming soon)" id="tool-market">
                            <a href="../dashboard/">
                                <canvas class="logo-dashboard"></canvas>
                            </a>
                        </li>
    
                        <li class="" data-toggle="tooltip" data-placement="right" title="Personalia" id="tool-freebies">
                            <a href="../personalia_page/index.php?page=employee_list"> 
                                <canvas class="logo-personalia"></canvas>
                            </a>
                        </li>
    
                        <li class="active" data-toggle="tooltip" data-placement="right" title="Salary" id="tool-newsletter">
                            <a href="">
                                <canvas class="logo-salary-active"></canvas>
                            </a>
                        </li>
    
                        <li class="" data-toggle="tooltip" data-placement="right" title="User Permission" id="tool-team">
                            <a href="../user_Permission/">
                                <canvas class="logo-user"></canvas>
                            </a>
                        </li>
                        
                        <div class="notif-team" id="notif-place"><p id="notif"></p></div>
    
                        <li class="nav-bottom" data-toggle="tooltip" data-placement="right" title="Initialization Setup" id="tool-sync">
                            <a href="../initialization_page/index.php?page=personalia">
                                <canvas class="logo-setting"></canvas>
                            </a>
                        </li>
                        <li class="" data-toggle="tooltip" data-placement="right" title="Logout" id="tool-sync">
                            <form action="../login/process/logout.php" method="post">
                                <button class="btn-logout">
                                    <canvas class="logo-logout"></canvas>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="main-middler-full">
            <div class="main-container">
                <div class="main-content-middler">
                    <div class="content-middler">
                        <?php
                            error_reporting(0);
                            if($_GET['page'] == 'details'){
                        ?>
                        <div class="main-header">
                            <div class="title-page">
                                <a class="linked-personalia" href="">
                                    Salary  > <a href="index.php" style="color: #000; font-weight: 600;">Salary summary</a> > <a href="" style="color: #5055BE; font-weight: 600;">Salary Details</a>
                                </a><br>
                                <label for="" style="font-size: 25px; font-weight: 600;">Salary Summary</label>
                            </div>
                            <div class="user-profil">
                                <?php
                                $param_id = $_SESSION['id'];
                                $sql = mysqli_query($connect,"SELECT * FROM employee WHERE id_account = '$param_id'");
                                while($data = mysqli_fetch_array($sql)){
                                ?>
                                <div class="image-user">
                                    <img src="../../src/img/User-img/<?=$data['photo_link']?>" alt="">
                                </div>
                                <div class="name-space">
                                    <label style="font-size: 13px; font-weight: 700; margin: 0; " for=""><?=$data['name']?></label><br>
                                    <label style="font-size: 12px;" for=""><?=$_SESSION['role']?></label>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="shortcut-tools">
                            <label for="" class="sortby">Sort by:</label>
                            <div class="position-short">
                                <select class=" role" name="role" id="role" onchange="roleSelect(this)">
                                    <?php
                                    $query_role  = mysqli_query($connect, "SELECT * FROM role");
                                    while($data = mysqli_fetch_array($query_role)){
                                    ?>
                                        <option  value="<?=$data['id_role']?>"><?=$data['role_name']?></option>
                                        <?php
                                    }
                                    ?>
                                    <option  value="Position">Position</option>
                                </select>
                            </div>
                            <div class="division-short">
                                <select class=" division" name="division" id="division"  onchange="divisionDetails(this)">
                                    <?php
                                    $query_division  = mysqli_query($connect, "SELECT * FROM division");
                                    while($data = mysqli_fetch_array($query_division)){
                                    ?>
                                        <option value="<?=$data['id_division']?>"><?=$data['division_name']?></option>
                                    <?php
                                    }
                                    ?>
                                        <option value="Division">Division</option>

                                </select>
                            </div>                            
                            <div class="division-short">
                                <select name="" id="" onchange="nameSelect(this)">
                                    <?php
                                    $query_role  = mysqli_query($connect, "SELECT * FROM employee");
                                    while($data = mysqli_fetch_array($query_role)){
                                    ?>
                                     <option  value="<?=$data['id_employee']?>"><?=$data['name']?></option>
                                        <?php
                                    }
                                    ?>
                                    <option value="" selected>Name</option>
                                </select>
                            </div>
                            <form action="process/inputSalary.php" method="post">
                                <div class="right-edit">
                                    <label for=""><?=$_GET['date']?></label>
                                    <?php
                                        if($_GET['editData'] == 'editdata'){
                                    ?>
                                    <button name="save" id="saveButton" style="background-color: #5055BE !important; padding: 4px 10px; font-size: 12px;" class="btn btn-primary">Save Data</button>
                                    <?php
                                    }else{
                                        $idActive = $_GET['idActiv'];
                                    ?>
                                    <a href="index.php?page=details&&idActiv=<?=$idActive?>&&date=<?=$_GET['date']?>&&editData=editdata" style="background-color: #5055BE !important; padding: 4px 10px; font-size: 12px;" class="btn btn-primary">Edit Data</a>
                                    <?php
                                    }
                                    ?>
                                </div>
                        </div>
                        <div class="distance-content">
                            <div class="content">
                                <div class="tableSalary">
                                    <table class="table table-borderless">
                                        <thead class="tableHead">
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Total(Rp)</th>
                                                <th scope="col">Basic</th>
                                                <th scope="col">Absent</th>
                                                <th scope="col">Transport</th>
                                                <th scope="col">Overtime</th>
                                                <th scope="col">Tip</th>
                                                <th scope="col">Cashbond</th>
                                                <th scope="col">More</th>
                                                <th scope="col">Note</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                                
                                                $id = $_GET['idActiv'];
                                                $date = $_GET['date'];
                                                if($_GET['nameDetails']){
                                                    $idname= $_GET['nameDetails'];
                                                    $sql = mysqli_query($connect,"SELECT fee.*, employee.name FROM fee JOIN employee ON fee.id_employee = employee.id_employee WHERE fee.id_activity = '$id' && fee.date = '$date' && fee.id_employee='$idname' GROUP BY fee.id_employee");
                                                }elseif($_GET['divisiDetails']){

                                                }elseif($_GET['positionDetails']){

                                                }else{
                                                   
                                                    $sql = mysqli_query($connect,"SELECT fee.*, employee.name FROM fee JOIN employee ON fee.id_employee = employee.id_employee WHERE fee.id_activity = '$id' && fee.date = '$date' GROUP BY fee.id_employee");
                                                }
                                                while($row = mysqli_fetch_array($sql)){
                                            ?>
                                            <tr class="tbody">
                                            <?php
                                            if($_GET['editData'] == 'editdata'){
                                                $date = $_GET['date'];
                                                $idActiv = $_GET['idActiv'];
                                                ?>  
                                                <td><?=$row['name']?></td>
                                                <td id="total"><?=$row['total']?></td>
                                                <td>
                                                    <input type="hidden" name="idActive" value="<?=$idActiv?>">
                                                    <input type="hidden" name="date" id="date" value="<?=$date?>">
                                                    <input type="hidden" name="id[]" id="id_fee" value="<?=$row['id_fee']?>">
                                                    <input type="text" name="basic[]" id="basic_fee" value="<?=$row['basic_fee']?>" class="inputSalary" required>
                                                </td>
                                                <td><input type="text" name="absen[]" id="absent" value="<?=$row['absent']?>"  class="inputSalary"></td>
                                                <td><input type="text" name="transport[]" id="transport_fee" value="<?=$row['transport_fee']?>" class="inputSalary"></td>
                                                <td><input type="text" name="overtime[]" id="overtime" value="<?=$row['overtime']?>" class="inputSalary"></td>
                                                <td><input type="text" name="tip[]" id="tip" value="<?=$row['tip']?>" class="inputSalary"></td>
                                                <td><input type="text" name="cashbon[]" id="cashbon" value="<?=$row['cashbon']?>" class="inputSalary"></td>
                                                <td><input type="text" name="more[]" id="more" value="<?=$row['more']?>" class="inputSalary"></td>
                                                <td><input type="text" name="note[]" id="note" value="<?=$row['note']?>" class="inputSalary"></td>
                                            </form>
                                                <?php
                                            }else{
                                                ?>
                                                <td><?=$row['name']?></td>
                                                <td id="total"><?=$row['total']?></td>
                                                <td><?=$row['basic_fee']?></td>
                                                <td><?=$row['absent']?></td>
                                                <td><?=$row['transport_fee']?></td>
                                                <td><?=$row['overtime']?></td>
                                                <td><?=$row['tip']?></td>
                                                <td><?=$row['cashbon']?></td>
                                                <td><?=$row['more']?></td>
                                                <td><?=$row['note']?></td>
                                                <?php
                                                }
                                                ?>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php
                        }elseif($_GET['page'] == 'plusSalary'){
                        ?>
                        <div class="main-header">
                            <div class="title-page">
                                <a class="linked-personalia" href="">
                                    Salary  > <a href="index.php" style="color: #000; font-weight: 600;">Salary summary</a> > <a href="" style="color: #5055BE; font-weight: 600;">Salary Details</a>
                                </a><br>
                                <label for="" style="font-size: 25px; font-weight: 600;">Salary Summary</label>
                            </div>
                            <div class="user-profil">
                                <?php
                                $param_id = $_SESSION['id'];
                                $sql = mysqli_query($connect,"SELECT * FROM employee WHERE id_account = '$param_id'");
                                while($data = mysqli_fetch_array($sql)){
                                ?>
                                <div class="image-user">
                                    <img src="../../src/img/User-img/<?=$data['photo_link']?>" alt="">
                                </div>
                                <div class="name-space">
                                    <label style="font-size: 13px; font-weight: 700; margin: 0; " for=""><?=$data['name']?></label><br>
                                    <label style="font-size: 12px;" for=""><?=$_SESSION['role']?></label>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="shortcut-tools">
                            <label for="" class="sortby">Sort by:</label>
                            <div class="position-short">
                                <select name="" id="">
                                    <option value="" selected>Division</option>
                                </select>
                            </div>
                            <div class="division-short">
                                <select name="" id="">
                                    <option value="" selected>Position</option>
                                </select>
                            </div>
                            <div class="division-short">
                                <select name="" id="">
                                    <option value="" selected>Name</option>
                                </select>
                            </div>
                            <div class="right-edit">
                                <a href="index.php?page=details&&editData=edit" style="background-color: #5055BE !important; padding: 4px 10px; font-size: 12px;" class="btn btn-primary">Edit Data</a>
                            </div>
                        </div>
                        <div class="distance-content">
                            <div class="content">
                                
                                <div class="tableSalary">
                                    <form action="process/inputSalary.php" method="post" id="formSalary">
                                        <table class="table table-borderless" id="table_salary">
                                            <thead class="tableHead">
                                                <tr>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Total(Rp)</th>
                                                    <th scope="col">Basic</th>
                                                    <th scope="col">Absent</th>
                                                    <th scope="col">Transport</th>
                                                    <th scope="col">Overtime</th>
                                                    <th scope="col">Tip</th>
                                                    <th scope="col">Cashbond</th>
                                                    <th scope="col">Warranty</th>
                                                    <th scope="col">More</th>
                                                    <th scope="col">Note</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="tbody">

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <button class="btn btn-success submitSalary" name="submit" id="submitSalary">Submit</button>
                                </form>
                                
                                <center>
                                    <button class="btn-row" style="color: #000;" id="addRow">Add row 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="#5055BE" class="bi bi-plus-square" viewBox="0 0 16 16">
                                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg>
                                    </button>                          
                                </center>
                            </div>
                        </div>
                        <?php
                        }elseif($_GET['page'] == 'cashbond'){
                            if($_GET['alert'] == 'on'){
                                echo "<script>
                                alert('Employees already cashbon');
                                </script>";
                            }elseif($_GET['alert'] == 'max'){
                                echo "<script type='text/javascript'>alert('sorry, cashbon exceeds the maximum ');</script>";
                            }

                        ?>
                        <div class="main-header">
                            <div class="title-page">
                                <a class="linked-personalia" href="">
                                    Salary  > <a href="index.php?page=cashbond" style="color: #5055BE; font-weight: 600;">Cashbon</a> 
                                </a><br>
                                <label for="" style="font-size: 25px; font-weight: 600;">Salary Summary</label>
                            </div>
                            <div class="user-profil">
                                <?php
                                $param_id = $_SESSION['id'];
                                $sql = mysqli_query($connect,"SELECT * FROM employee WHERE id_account = '$param_id'");
                                while($data = mysqli_fetch_array($sql)){
                                ?>
                                <div class="image-user">
                                    <img src="../../src/img/User-img/<?=$data['photo_link']?>" alt="">
                                </div>
                                <div class="name-space">
                                    <label style="font-size: 13px; font-weight: 700; margin: 0; " for=""><?=$data['name']?></label><br>
                                    <label style="font-size: 12px;" for=""><?=$_SESSION['role']?></label>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="shortcut-tools">
                            <label for="" class="sortby">Sort by:</label>
                            <div class="position-short">
                                <select class=" role" name="role" id="role" onchange="roleSelect(this)">
                                    <?php
                                    $query_role  = mysqli_query($connect, "SELECT * FROM role");
                                    while($data = mysqli_fetch_array($query_role)){
                                    ?>
                                        <option  value="<?=$data['id_role']?>"><?=$data['role_name']?></option>
                                        <?php
                                    }
                                    ?>
                                    <option  value="Position">Position</option>
                                </select>
                            </div>
                            <div class="division-short">
                                <select class=" division" name="division" id="division"  onchange="divisionDetails(this)">
                                    <?php
                                    $query_division  = mysqli_query($connect, "SELECT * FROM division");
                                    while($data = mysqli_fetch_array($query_division)){
                                    ?>
                                        <option value="<?=$data['id_division']?>"><?=$data['division_name']?></option>
                                    <?php
                                    }
                                    ?>
                                        <option value="Division">Division</option>

                                </select>
                            </div>                            
                            <div class="division-short">
                                <select name="" id="" onchange="nameSelect(this)">
                                    <?php
                                    $query_role  = mysqli_query($connect, "SELECT * FROM employee");
                                    while($data = mysqli_fetch_array($query_role)){
                                    ?>
                                     <option  value="<?=$data['id_employee']?>"><?=$data['name']?></option>
                                        <?php
                                    }
                                    ?>
                                    <option value="" selected>Name</option>
                                </select>
                            </div>
                            <div class="right-edit">
                                <a style="font-size: 12px;" onclick="openVal()" class="checkCashbon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                        <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                    </svg>
                                    Cashbond validation
                                </a>
                                <a style="margin-left: 10px; background-color: #5055BE !important; padding: 4px 10px; font-size: 12px;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Create
                                </a>
                            </div>
                        </div>
                        <div class="distance-content">
                            <div class="content">
                                <table class="table table-borderless" id="">
                                    <thead class="tableHead">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Create</th>
                                            <th scope="col">Cashbon(Rp)</th>
                                            <th scope="col">Leftover(Rp)</th>
                                            <th scope="col">Est.Paid off</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php
                                            $query = mysqli_query($connect,"SELECT cashbon.*, employee.name, fee.cashbon FROM cashbon JOIN employee ON employee.id_employee = cashbon.id_employee JOIN fee ON fee.id_employee = cashbon.id_employee GROUP BY cashbon.id_cashbon");
                                            while($row = mysqli_fetch_array($query)){
                                            ?>
                                        <tr>
                                            <td>
                                                <?=$row['name']?>
                                            </td>
                                            <td>
                                                <?php
                                                if($row['status'] == 'complete'){
                                                ?>
                                                <label class="statusCashbon" for="">Complete</label>
                                                <?php
                                                }elseif($row['status'] == 'active'){
                                                ?>
                                                <label class="statusCashbonActive" for="">Active</label>
                                                <?php
                                                }elseif($row['status'] == 'reject'){
                                                ?>
                                                <label class="statusCashbonReject" for="">Rejected</label>
                                                <?php
                                                }else{
                                                ?>
                                                <label class="statusCashbonpending" for="">Pending</label>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td><?=$row['date']?></td>
                                            <td><?=number_format($row['nominal'], 0, ".", ".")?></td>
                                            <td>
                                                <?php
                                                    $cashbonFee = $row['cashbon'];
                                                    $nominalCashbon = $row['nominal'];
                                                    $leftover = $nominalCashbon -  $cashbonFee;
                                                ?>
                                                <?=number_format($leftover, 0, ".", ".")?>
                                            </td>
                                            <td><?=$row['date']?></td>
                                            <td><a href="index.php?page=detailsCashbon&&id=<?=$row['id_cashbon']?>" style="background-color: #5055BE !important;" class="btn btn-primary">Details</a></td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>      
                            </div>
                        </div>
                        <div id="validasiBar" class="sideValidasi">
                            <a class="closeNavbar" onclick="closeVal()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-x-lg" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                                    <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                                </svg>
                            </a>
                            <h5>Need Validation</h5>
                            <?php
                            $sql = mysqli_query($connect,"SELECT * FROM cashbon WHERE status='pending'");
                            while($rValid = mysqli_fetch_array($sql)){
                            ?>
                            <div class="accordion accordion-flush" id="accordionFlushExample<?=$rValid['id_cashbon']?>">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne<?=$rValid['id_cashbon']?>">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne<?=$rValid['id_cashbon']?>" aria-expanded="false" aria-controls="flush-collapseOne" style="font-size: 12px; font-weight: 700;">
                                        <?php
                                            $idnama = $rValid['id_employee'];
                                            $employee = mysqli_query($connect,"SELECT * FROM employee WHERE id_account = '$idnama'");
                                            while($rname = mysqli_fetch_array($employee)){
                                            ?>
                                                <?=$rname['name']?> | 
                                            
                                            <?php
                                            }
                                            ?>
                                            <label for="" style="color: #5055BE;"><?=$rValid['date']?></label>
                                    </button>
                                    </h2>
                                    <div id="flush-collapseOne<?=$rValid['id_cashbon']?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <table class="table-validasiCheck">
                                                <form action="process/inputSalary.php" method="post">
                                                <tbody class="">
                                                    <tr >
                                                        <td>Maximum loan limit (RP)</td>
                                                        <?php
                                                        $name = $rValid['id_employee'];
                                                            $fee = mysqli_query($connect,"SELECT AVG(total) FROM fee WHERE id_employee = '$name'");
                                                            while($avg = mysqli_fetch_array($fee)){
                                                                $avgrate = $avg['AVG(total)'];
                                                            }
                                                            // menghitung maksimal cashbon  
                                                            $countpaid = $avgrate / 3;
                                                            // membulatkan bilangan 
                                                            $roundpaid =  round($countpaid);
                                                        ?>
                                                        <td><label for="" class="validasiMax"><?=number_format($roundpaid, 0, ".", ".")?></label></td>
                                                    </tr>
                                                    <tr>
                                                        <?php
                                                            $nominal = $rValid['nominal'];
                                                            $total = $nominal*10/100;
                                                        ?>
                                                        <td>Salary deduction every month (Rp)</td>
                                                        <td><label class="validasiMax" for=""><?=number_format($total, 0, ".", ".")?></label></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Credit request (Rp)</td>
                                                        <td><label class="validasiCredit" for=""><?=number_format($rValid['nominal'], 0, ".", ".")?></label></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="buttonValidasi">
                                                <input type="hidden" name="id" value="<?=$rValid['id_employee']?>">
                                                <input type="hidden" name="date" value="<?=$rValid['date']?>">
                                                <button name="validate" class="btn btnValidate">Validate</button>
                                                <button name="reject" class="btn btnReject">Reject</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        <?php
                        }elseif($_GET['page'] == 'detailsCashbon'){
                        ?>
                        <div class="main-header">
                            <div class="title-page">
                                <a class="linked-personalia" href="">
                                    Salary  > <a href="index.php?page=cashbond" style="color: #000; font-weight: 600;">Cashbon</a> > <a href="" style="color: #5055BE; font-weight: 600;">Cashbon Details</a>
                                </a><br>
                                <label for="" style="font-size: 25px; font-weight: 600;">Cashbon Details</label>
                            </div>
                            <div class="user-profil">
                                <?php
                                $param_id = $_SESSION['id'];
                                $sql = mysqli_query($connect,"SELECT * FROM employee WHERE id_account = '$param_id'");
                                while($data = mysqli_fetch_array($sql)){
                                ?>
                                <div class="image-user">
                                    <img src="../../src/img/User-img/<?=$data['photo_link']?>" alt="">
                                </div>
                                <div class="name-space">
                                    <label style="font-size: 13px; font-weight: 700; margin: 0; " for=""><?=$data['name']?></label><br>
                                    <label style="font-size: 12px;" for=""><?=$_SESSION['role']?></label>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="distance-content">
                            <div class="content" style="display:flex; margin-top: 55px;">
                                <?php
                                $idcasbon = $_GET['id'];
                                $queryCashbon = mysqli_query($connect,"SELECT * FROM cashbon WHERE id_cashbon = '$idcasbon'");
                                while($row = mysqli_fetch_array($queryCashbon)){
                                ?>
                                    <div class="userCashbon">
                                        <div class="user">
                                            <div class="user-img">
                                                <?php
                                                $idnama = $row['id_employee'];
                                                $emp = mysqli_query($connect,"SELECT * FROM employee WHERE id_employee='$idnama'");
                                                while($r = mysqli_fetch_array($emp)){
                                                ?>
                                                <img src="../../src/img/User-img/<?=$r['photo_link']?>" alt="">
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="name-user">
                                                <label style="font-size: 12px; font-weight: 700; margin: 0;" for="">
                                                    <?php
                                                    $idname = $row['id_employee'];
                                                    $employee = mysqli_query($connect,"SELECT * FROM employee WHERE id_employee = '$idname'");
                                                    while($rname = mysqli_fetch_array($employee)){
                                                    ?>
                                                    <?=$rname['name']?>
                                                    <?php
                                                    }
                                                    ?>
                                                </label><br>
                                                <label style="font-size: 12px; border-radius: 15px; padding: 2px 8px; background-color: #B6B9FF; width: 100px;" for="">
                                                    <?php
                                                        $idnama = $row['id_employee'];
                                                        $query_div = mysqli_query($connect,"SELECT * FROM employee WHERE id_employee = '$idnama'");
                                                        while($r_div = mysqli_fetch_array($query_div)){
                                                            $idrole= $r_div['id_role'];
                                                            $role = mysqli_query($connect,"SELECT * FROM role WHERE id_role='$idrole'");
                                                            while($r_role = mysqli_fetch_array($role)){
                                                    ?>
                                                        <?=$r_role['role_name']?>
                                                    <?php
                                                            }
                                                        }
                                                        ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="toptable">
                                            <table class="topCashbon">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 90px;">Cashbon (Rp)</th>
                                                        <th>Leftover (Rp)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <?php
                                                                $sqlAct = mysqli_query($connect,"SELECT MIN(id_cashbon) AS id FROM cashbon WHERE id_employee = '$idnama'");
                                                                while($r = mysqli_fetch_array($sqlAct)){
                                                                    $idc = $r['id'];
                                                                }
                                                                $qCash = mysqli_query($connect,"SELECT * FROM cashbon WHERE id_cashbon=$idc");
                                                                while($rc = mysqli_fetch_array($qCash)){
                                                            ?>
                                                            <?=number_format($rc['nominal'], 0, ".", ".")?>
                                                            <?php
                                                                }
                                                                ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $sqlAct = mysqli_query($connect,"SELECT MAX(id_cashbon) AS id FROM cashbon WHERE id_employee = '$idnama'");
                                                                while($r = mysqli_fetch_array($sqlAct)){
                                                                    $idc = $r['id'];
                                                                }
                                                                $qCash = mysqli_query($connect,"SELECT * FROM cashbon WHERE id_cashbon=$idc");
                                                                while($rc = mysqli_fetch_array($qCash)){
                                                            ?>
                                                            <?=number_format($rc['nominal'], 0, ".", ".")?>
                                                            <?php
                                                                }
                                                                ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="bottomtable">
                                            <table class="topCashbon">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 90px;">Create</th>
                                                        <th>Est. Paid off</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $query = mysqli_query($connect,"SELECT MIN(date) AS datecash FROM cashbon WHERE status='active' && id_employee=$idnama");
                                                        while($dataAct = mysqli_fetch_array($query)){
                                                        ?>

                                                        <tr>
                                                            <td><?=$dataAct['datecash']?></td>
                                                            <?php
                                                            }
                                                            $queryfee = mysqli_query($connect,"SELECT MAX(date) AS datefee FROM fee WHERE cashbon != 0 && id_employee=$idnama");
                                                            while($datefee = mysqli_fetch_array($queryfee)){
                                                            ?>
                                                            <td><?=$datefee['datefee']?></td>
                                                            <?php
                                                            }
                                                            ?>
                                                        </tr>
                                                       
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="bottomtable">
                                            <table class="topCashbon">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 90px;">Cashbon History</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $qcashbon = mysqli_query($connect,"SELECT * FROM cashbon WHERE id_employee = $idnama");
                                                    while($rcash = mysqli_fetch_array($qcashbon)){
                                                    ?>
                                                    <tr>
                                                        <td><?=$rcash['date']?></td>
                                                        <td><?=number_format($rcash['nominal'], 0, ".", ".")?></td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tabelCash">
                                        <?php
                                            $sqlcash = mysqli_query($connect,"SELECT MAX(id_cashbon) FROM cashbon WHERE id_employee = $idnama");
                                            while($rmax = mysqli_fetch_array($sqlcash)){
                                                $maxId = $rmax['MAX(id_cashbon)'];
                                            }
                                            $sqlact = mysqli_query($connect,"SELECT * FROM cashbon WHERE id_cashbon = $maxId");
                                            while($stat = mysqli_fetch_array($sqlact)){
                                            if($stat['status'] == 'active'){
                                        ?>
                                            <label class="statusCashbonActive" for="">Active</label>
                                        <?php
                                            }else{
                                        ?>
                                            <label for="" align="right" class="statusCashbon">Complete</label>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <table class="table table-borderless" id="">
                                            <thead class="tableHead">
                                                <tr>
                                                    <th style="width: 250px;" scope="col">Date</th>
                                                    <th style="width: 250px;" scope="col">Debit(Rp)</th>
                                                    <th style="width: 250px;" scope="col">Leftover</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sqlact = mysqli_query($connect,"SELECT * FROM cashbon WHERE id_cashbon = $maxId");
                                                    while($stat = mysqli_fetch_array($sqlact)){
                                                
                                                    if($stat['status'] == 'active'){
                                                    $date = date('Y-m-d');
                                                    $id = $row['id_cashbon'];
                                                    $dataId = mysqli_query($connect,"SELECT * FROM cashbon WHERE id_cashbon = '$id'");
                                                    while($data = mysqli_fetch_array($dataId)){
                                                        $idemployee = $data['id_employee'];
                                                    }
                                                ?>
                                                    <?php
                                                        $sql = mysqli_query($connect,"SELECT cashbon.nominal,cashbon.status, fee.cashbon, fee.date FROM cashbon JOIN fee ON fee.id_employee = cashbon.id_employee WHERE cashbon.id_employee = $idnama && cashbon.id_cashbon = $maxId");
                                                        while($cash = mysqli_fetch_array($sql)){
                                                    ?>
                                                <tr>
                                                    <td><?=$cash['date']?></td>
                                                    <td><?=number_format($row['nominal'], 0, ".", ".")?></td>
                                                    <td>
                                                    <?php
                                                        $a = $cash['nominal'];
                                                        $b = $cash['cashbon'];
                                                        $c = $a - $b;
                                                        
                                                        ?> 
                                                        <?=number_format($c, 0, ".", ".")?>
                                                    </td>
                                                </tr>
                                                    <?php
                                                        }
                                                        ?>

                                                <tr>
                                                    <td colspan="3">
                                                        <form action="process/inputSalary.php" method="POST">
                                                            <input type="hidden" name="id" value="<?=$idemployee?>">
                                                            <input type="hidden" name="idCashbon" value="<?=$id?>">
                                                            <input type="hidden" name="date" value="<?=$date?>">
                                                            <input type="text" name="value" class="inp-div" style="font-size: 12px;" placeholder="Insert here" required>
                                                            <input class="btn-addDiv" name="input_cash" type="submit" value="Input">
                                                        </form>
                                                    </td>
                                                </tr>

                                                <?php
                                                    }else{
                                                ?>
                                                <tr>
                                                    <td><?=$stat['date']?></td>
                                                    <td><?=number_format($stat['nominal'], 0, ".", ".")?></td>

                                                    <td>
                                                        <?php
                                                            $sql = mysqli_query($connect,"SELECT cashbon.nominal,cashbon.status, fee.cashbon, fee.date FROM cashbon JOIN fee ON fee.id_employee = cashbon.id_employee WHERE cashbon.id_employee = $idnama && cashbon.id_cashbon = $maxId");
                                                            while($rowleft = mysqli_fetch_array($sql)){
                                                                $aleft = $cash['nominal'];
                                                                $bleft = $cash['cashbon'];
                                                                $cleft = $aleft - $bleft;
                                                        ?>
                                                        <?=number_format($cleft, 0, ".", ".")?>
                                                        <?php
                                                            }   
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>      
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                        <?php
                            }else{
                        ?>
                        <div class="main-header">
                            <div class="title-page">
                                <a class="linked-personalia" href="">
                                    Salary  > <a for="" style="color: #5055BE; font-weight: 600;">Salary summary</a>
                                </a><br>
                                <label for="" style="font-size: 25px; font-weight: 600;">Salary Summary</label>
                            </div>
                            <div class="user-profil">
                                <?php
                                $param_id = $_SESSION['id'];
                                $sql = mysqli_query($connect,"SELECT * FROM employee WHERE id_account = '$param_id'");
                                while($data = mysqli_fetch_array($sql)){
                                ?>
                                <div class="image-user">
                                    <img src="../../src/img/User-img/<?=$data['photo_link']?>" alt="">
                                </div>
                                <div class="name-space">
                                    <label style="font-size: 13px; font-weight: 700; margin: 0; " for=""><?=$data['name']?></label><br>
                                    <label style="font-size: 12px;" for=""><?=$_SESSION['role']?></label>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="shortcut-tools">
                            <div class="search">
                                <input onkeyup="searching()" type="text" placeholder="Search Name" id="searchInput">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16" style="color:5055BE;">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </div>
                            <div class="position-short">
                                <select class=" division" name="division" id="ddlYears"  onchange="handleSelect(this)">
                                </select>
                            </div>
                            <div class="division-short">
                                
                                <select name="" id="" onchange="total(this)">
                                <?php
                                    $query_activity  = mysqli_query($connect, "SELECT * FROM activity");
                                    while($row = mysqli_fetch_array($query_activity)){
                                        $code = $row['id_activity'];
                                    }
                                    $sql = mysqli_query($connect,"SELECT SUM(total) as total FROM fee WHERE id_activity = '$code'");
                                        while($r = mysqli_fetch_array($sql)){     
                                ?>
                                    <option value="" selected>Select total</option>
                                    <option value="<?=$r['total']?>"><?=$r['total']?></option>
                                    <?php
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="distance-content">
                            <div class="content">
                                <table class="table table-borderless" id="table">
                                    <thead class="tableHead">
                                        <tr>
                                            <th scope="col">Salary Date</th>
                                            <th scope="col">Publisher</th>
                                            <th scope="col">Recipient</th>
                                            <th scope="col">Total(Rp)</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query_activity  = mysqli_query($connect, "SELECT * FROM activity");
                                    while($row = mysqli_fetch_array($query_activity)){
                                        $code = $row['id_activity'];
                                    ?>
                                        <tr>
                                            <?php
                                            $query_activitys  = mysqli_query($connect, "SELECT * FROM fee WHERE id_activity='$code' LIMIT 1");
                                            while($data = mysqli_fetch_array($query_activitys)){
                                                $orgDate = $data['date'];  
                                                $date = date("d M Y", strtotime($orgDate));  
                                            
                                            ?>
                                            <td><?=$date?></td>
                                            <?php
                                            }
                                            ?>
                                            <td><label class="labeltable" for="">
                                                <?php
                                                    $id = $row['id_employee'];
                                                    $namesql = mysqli_query($connect,"SELECT * FROM employee where id_employee = '$id'");
                                                    while($Rname = mysqli_fetch_array($namesql)){

                                                ?>
                                                <?=$Rname['name']?>
                                                <?php
                                                    }
                                                    ?>
                                            </label></td>
                                            <?php
                                            $sql_sum = mysqli_query($connect, "SELECT * FROM fee WHERE id_activity='$code'");
                                            ?>
                                            <td><?=mysqli_num_rows($sql_sum)?></td>
                                            <?php
                                            $query_sums  = mysqli_query($connect, "SELECT SUM(total) AS total FROM fee WHERE id_activity='$code'");
                                            while($datas = mysqli_fetch_array($query_sums)){
                                            ?>
                                            <td><?=number_format($datas['total'])?></td>
                                            <?php
                                            }
                                            ?>
                                            <td><a href="index.php?page=details&&idActiv=<?=$code?>&&date=<?=$row['date']?>" style="background-color: #5055BE !important;" class="btn btn-primary">Details</a></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>                            
                            </div>
                        </div>
                        <div class="plusSalary">
                            <a href="?page=plusSalary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="30" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                                </svg>
                            </a>
                        </div>
                        <div class="addSalary">
                            <a href="?page=cashbond">
                                <canvas class="iconNote"></canvas>
                            </a>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Create Cashbon-->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <form action="process/inputSalary.php" method="post">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom: none;">
                    
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> 
                <div class="modal-body" style="align-self: center;">
                <h5 class="modal-title" id="staticBackdropLabel">Quick Edit</h5>
                    <div class="nameinput">
                        <label for="name">Name</label><br>
                        <select class=" division w-100" name="name" id="name">
                            <?php
                            $query_name  = mysqli_query($connect, "SELECT * FROM employee");
                            while($data = mysqli_fetch_array($query_name)){
                            ?>
                                <option value="<?=$data['id_employee']?>"><?=$data['name']?></option>
                            <?php
                            }
                            ?>
                                <option value="" selected></option>
                        </select>
                    </div>
                    <div class="nameinput">
                        <label for="name">Credit Request(Rp)</label><br>
                        <input name="cashbon" type="text" class="form-biodata number" value="" placeholder="3000000"><br>
                        <label for="name">Est. Monthly debit(Rp) </label><br>
                        <input name="debit" type="text" class="form-biodata number" value="" placeholder="200000">
                        <div id="errmsg"></div>
                    </div>
                    <button class="btn btn-primary btnModalSave" style="width: 85% !important;" name="btnCreate">Create Now</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <!-- bootstrap CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    <!-- JAVASCRIPT ADD ROW -->
    <!-- script add row -->
    <script>
        $(document).ready(function() {

            var html = `<tr class="tbody" id="row">
                            <td> 
                                <select class="selectSalary"  name="name[]" id="nameUser" required>
                                    <?php
                                    $query_role  = mysqli_query($connect, "SELECT * FROM employee");
                                    while($data = mysqli_fetch_array($query_role)){
                                    ?>
                                        <option  value="<?=$data['id_employee']?>"><?=$data['name']?></option>
                                        <?php
                                    }
                                    ?>
                                    <option selected  value=""></option>
                                </select>
                            </td>
                            <td><input  type="text" name="total[]" class="inputSalary"></td>
                            <td><input id="basic" type="text" name="basic[]"  class="inputSalary" required></td>
                            <td><input type="text" name="absen[]"  class="inputSalary"></td>
                            <td><input type="text" name="transport[]"  class="inputSalary"></td>
                            <td><input type="text" name="overtime[]"  class="inputSalary"></td>
                            <td><input type="text" name="tip[]"  class="inputSalary"></td>
                            <td><input type="text" name="cashbon[]"  class="inputSalary"></td>
                            <td><input type="text" name="warranty[]"  class="inputSalary"></td>
                            <td><input type="text" name="more[]"  class="inputSalary"></td>
                            <td><input type="text" name="note[]"  class="inputSalary"></td>
                            </tr>`;  
            var max = 5;
            var x = 1;
            $('#addRow').click(function(){
                if(x <= max){
                    $('#table_salary').append(html);
                    x++;
                }
            });
           
            // $('#submitSalary').click(function(){
            //     $.ajax({
            //         url:"process/inputSalary.php",
            //         method:"post",
            //         data:$('#formSalary').serialize(),
            //         success:function(data){
            //             alert(data);
            //             $('#formSalary')[0].reset();
            //         }
            //     })
            // })
        });
        // var total = document.getElementById("total").innerHTML;
        // var basic_fee = document.querySelectorAll("basic_fee");
        // for(i = 0; i < basic_fee; i++){
        //     var transport_fee = document.querySelectorAll("transport_fee");
        //     var c = basic_fee[i] + 100;
        //     console.log(c)
        // }
        var thisOptionValue = [];
        $("#nameUser").each(function() {
            thisOptionValue.push($(this).val());

        });
        console.log(thisOptionValue)
        var data = document.getElementsByName("absen[]");
        console.log(data);
    </script>
    <!-- open bar validasi cashbon -->
    <script>
        function openVal() {
            $("#validasiBar").css("right", "0");
           
        }

        function closeVal() {
            $("#validasiBar").css("right", "-400px");
        }

        // function arrowValid() {
        //     var x = document.getElementById("tbody");
        //     var btn = document.getElementById("buttonValid");
        //     var ar = document.getElementById("arrow");
        //     if (x.style.display == "none") { 
        //         x.style.display = "block";
        //         btn.style.display = "block";
        //         ar.style.transform = "rotate(180deg)";
        //     } else {
        //         x.style.display = "none";
        //         btn.style.display = "none";
        //         ar.style.transform = "rotate(0deg)";
        //     }
        // }
    </script>
    <!-- script search -->
    <script>
        function searching() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("table");
        tr = table.getElementsByTagName("tr");
        console.log(input)
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
            }       
        }
        }
    </script>
    <!-- script sortcut year -->
    <script>
        window.onload = function () {
                //Reference the DropDownList.
                var ddlYears = document.getElementById("ddlYears");
        
                //Determine the Current Year.
                var currentYear = (new Date()).getFullYear();
        
                //Loop and add the Year values to DropDownList.
                for (var i = 1950; i <= currentYear; i++) {
                    var option = document.createElement("OPTION");
                    option.innerHTML = i;
                    option.value = i;
                    ddlYears.appendChild(option);
                }
            };
        function handleSelect(elm)
        {
            window.location = "index.php?dateYears="+elm.value;
        }
        function total(elm)
        {
            window.location = "index.php?total="+elm.value;
        }
        function divisionDetails(elm)
        {
            window.location = "index.php?page=details&&divisiDetails="+elm.value;
        }
        function roleSelect(elm)
        {
            window.location = "index.php?page=details&&positionDetails="+elm.value;
        }
        function nameSelect(elm)
        {
            window.location = "index.php?page=details&&nameDetails="+elm.value;
        }
    </script>
    <!-- script input only number -->
    <script>
        $(function(){
        $(".number").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                $("#errmsg").html("Number Only").stop().show().fadeOut("slow");
            return false;
            }
        });
        });
    </script>
</body>
</html>