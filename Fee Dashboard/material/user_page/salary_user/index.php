<?php
    session_start();
    if(!isset($_SESSION['email']) ) {
        header('location: ../../login/index.php');
        exit;
    }
    error_reporting(0);
    if($_GET['error'] == 'pass'){
        echo "<script type='text/javascript'>alert('your current password is differrent');</script>";
    }

    include '../../../src/config/connection.php';
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
    <link rel="stylesheet" href="../../../src/css/style-user.css">  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

</head>

<body>
    <div class="grid">
        <div class="navbarDiv">
            <nav align="center">
                <div class="item" align="left">
                    <div class="logo">
                        <a href="">
                            <img src="../../../src/img/LOGO-RRG.svg"/>
                        </a>
                    </div>
                    
                    <ul>
                        <li class="active" data-toggle="tooltip" data-placement="right" title="">
                            <a href="">
                                <canvas class="logo-salary-active"></canvas>
                            </a>
                        </li>

                        <li class="" data-toggle="tooltip" data-placement="right" title="Personalia" id="tool-freebies">
                            <a href="../cashbon_page/"> 
                                <canvas class="logo-cashbon"></canvas>
                            </a>
                        </li>

                        <li class="" data-toggle="tooltip" data-placement="right" title="Salary" id="tool-newsletter">
                            <a href="../profile_page/">
                                <canvas class="logo-user"></canvas>
                            </a>
                        </li>

                        <li class="nav-bottom" data-toggle="tooltip" data-placement="right" title="Initialization Setup" id="tool-sync">
                            <a href="" data-toggle="modal" data-target="#changePassword">
                                <canvas class="change-pass"></canvas>
                            </a>
                        </li>
                        <li class="" data-toggle="tooltip" data-placement="right" title="Logout" id="tool-sync">
                            <form action="../../login/process/logout.php" method="post">
                                <button class="btn-logout">
                                    <canvas class="logo-logout"></canvas>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- navbar Phone -->
        <div class="navbarphone">
            <div class="logo">
                <a href="">
                    <img src="../../../src/img/LOGO-RRG.svg"/>
                </a>
            </div>
            <div>
                <a onclick="openNav()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                </a>
            </div>
        </div>
        <div class="sidebarPhone" id="navbar_phone">
            <a class="closeNavbar" onclick="closeNav()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                    <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                </svg>
            </a>
            <div class="userTitle">
                <div class="img-profile">
                    <?php
                        $id = $_SESSION['id'];
                        $sqlName = mysqli_query($connect,"SELECT * FROM employee WHERE id_account = '$id'");
                        while($r_name = mysqli_fetch_array($sqlName)){
                    ?>
                        <img src="../../../src/img/User-img/<?=$r_name['photo_link']?>" alt="">
                    <?php
                        }
                    ?>   
                </div>
                <div class="userName">
                    <label class="nameLabel" for="">
                        <?php
                            $id = $_SESSION['id'];
                            $sqlName = mysqli_query($connect,"SELECT * FROM employee WHERE id_account = '$id'");
                            while($r_name = mysqli_fetch_array($sqlName)){
                        ?>
                            <?=$r_name['name']?>
                        <?php
                            }
                        ?>
                    </label><br>
                    <label for=""><?=$_SESSION['role']?></label>
                </div>
            </div>
            <nav align="center">
                <div class="item" align="left">
                    <ul>
                        <li class="active" data-toggle="tooltip" data-placement="right" title="">
                            <a href="">
                                <canvas class="logo-salary-active"></canvas>
                            </a>
                        </li>

                        <li class="" data-toggle="tooltip" data-placement="right" title="Personalia" id="tool-freebies">
                            <a href="../cashbon_page/"> 
                                <canvas class="logo-cashbon"></canvas>
                            </a>
                        </li>

                        <li class="" data-toggle="tooltip" data-placement="right" title="Salary" id="tool-newsletter">
                            <a href="../profile_page/">
                                <canvas class="logo-user"></canvas>
                            </a>
                        </li>

                        <li class="nav-bottom" data-toggle="tooltip" data-placement="right" title="Initialization Setup" id="tool-sync">
                            <a href="" data-toggle="modal" data-target="#changePassword">
                                <canvas class="change-pass"></canvas>
                            </a>
                        </li>
                        <li class="" data-toggle="tooltip" data-placement="right" title="Logout" id="tool-sync">
                            <form action="../../login/process/logout.php" method="post">
                                <button class="btn-logout">
                                    <canvas class="logo-logout"></canvas>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="main-page">
            <div class="headPage">
                <div class="left-header">
                    <a class="salarytitle" href="">Salary</a> > <a class="overviewtitle" href="">overview</a>
                    <h3>Welcome, 
                        <?php
                            $id = $_SESSION['id'];
                            $sqlName = mysqli_query($connect,"SELECT * FROM employee WHERE id_account = '$id' ");
                            while($r_name = mysqli_fetch_array($sqlName)){
                        ?>
                            <?=$r_name['name']?>
                        <?php
                            }
                        ?>
                    </h3>
                </div>
                <div class="right-header">
                    <div class="imgUser">
                        <?php
                            $id = $_SESSION['id'];
                            $sqlName = mysqli_query($connect,"SELECT * FROM employee WHERE id_account = '$id'");
                            
                            while($r_name = mysqli_fetch_array($sqlName)){
                        ?>
                           <img src="../../../src/img/User-img/<?=$r_name['photo_link']?>" alt="">
                        <?php
                            }
                        ?>   
                    </div>
                    <div class="nameUser">
                        <label class="nameUser-title" for="">
                            <?php
                                $id = $_SESSION['id'];
                                $sqlName = mysqli_query($connect,"SELECT * FROM employee WHERE id_account = '$id'");
                                while($r_name = mysqli_fetch_array($sqlName)){
                            ?>
                                <?=$r_name['name']?>
                            <?php
                                }
                            ?>
                        </label><br>
                        <label class="nameRole-title" for=""><?=$_SESSION['role']?></label>
                    </div>
                </div>
            </div>
            <?php
            $id = $_SESSION['id'];
            $date = date('m');
            
            $empl = mysqli_query($connect,"SELECT * FROM employee WHERE id_account = '$id' ");
            while($r = mysqli_fetch_array($empl)){
                $idempl = $r['id_employee'];
            }
            $dateGet = $_GET['date'];
            if($_GET['date'] != 0){

                $sqlSalary = mysqli_query($connect,"SELECT * FROM fee WHERE id_employee = '$idempl'  && date = '$dateGet'GROUP BY id_fee ");
            }else{
                date_default_timezone_set('Asia/Jakarta');
                $date = date('m');
                $sqlSalary = mysqli_query($connect,"SELECT *, MAX(id_fee) FROM fee WHERE id_employee = '$idempl'");
            }
            while($row = mysqli_fetch_array($sqlSalary)){
            ?>
            <div class="head-content">
                <div>
                    <label class="total_Salary" for="">Total Salary</label><br>
                    <label class="nominal_Salary" for="">Rp <?=number_format($row['total'], 0, ".", ".")?></label>
                </div>
                <div>
                    <div class="dateSalary">
                        <label for=""><?=$dateGet?></label>
                        <select name="" id="" onchange="javascript:handleSelect(this)">
                            <?php
                                $datequery = mysqli_query($connect,"SELECT * FROM fee WHERE id_employee = $idempl");
                                while($rDate = mysqli_fetch_array($datequery)){
                            ?>
                                <option value="<?=$rDate['date']?>"><?=$rDate['date']?></option>
                            <?php
                                }
                                ?>
                                <option value=""  selected><?=$dateGet?></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="main-content content-salary">
                <div class="tableSalarySet">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><img src="../../../src/img/SalarySet.svg" alt=""></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Basic</th>
                                <td>Rp <?=number_format($row['basic_fee'], 0, ".", ".")?></td>
                            </tr>
                            <tr>
                                <th scope="row">Absent</th>
                                <td><?=$row['absent']?></td>
                            </tr>
                            <tr>
                                <th scope="row">Transport</th>
                                <td>Rp <?=number_format($row['transport_fee'], 0, ".", ".")?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="tableSalarySet">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><img class="imgNote" src="../../../src/img/NoteUser.svg" alt=""></th>
                                <!-- <th scope="col"></th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- <th scope="row">Basic</th> -->
                                <td><?=$row['note']?></td>
                            </tr>
                            <!-- <tr>
                                <th scope="row">Absent</th>
                                <td>Jacob</td>
                            </tr>
                            <tr>
                                <th scope="row">Transport</th>
                                <td>Jacob</td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
                
                <div class="tableSalarySet">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><img src="../../../src/img/additional.svg" alt=""></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Overtime</th>
                                <td>Rp <?=number_format($row['overtime'], 0, ".", ".")?></td>
                            </tr>
                            <tr>
                                <th scope="row">tip</th>
                                <td>Rp <?=number_format($row['tip'], 0, ".", ".")?></td>
                            </tr>
                            <tr>
                                <th scope="row">More</th>
                                <td>Rp <?=number_format($row['more'], 0, ".", ".")?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="tableSalarySet">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><img src="../../../src/img/deduction.svg" alt=""></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">cashbon</th>
                                <td>Rp <?=number_format($row['cashbon'], 0, ".", ".")?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!-- bootstrap CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        function openNav() {
            $("#navbar_phone").css("left", "0");
            $("#navbar_phone").css("opacity", "1");
        }
        function closeNav() {
            $("#navbar_phone").css("left", "-300px");
            $("#navbar_phone").css("opacity", "0");
        }

    </script>
    <!-- Modal -->
    <div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="process/changePassword.php" method="post">
            <div class="modal-content">
                <div class="modal-header" style="border:0;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 1rem 5rem 5rem 5rem;">
                    <center>
                        <h5>Change and update your password</h5>
                    </center>
                    <div class="inputChange">
                        <input type="hidden" value="<?=$_SESSION['id']?>" name="id">
                        <label for="">Current Password</label><br>
                        <input type="password" class="" name="password">
                        <label for="">New Password</label><br>
                        <input type="password" class="" name="Newpassword"><br>
                        <button class="btn btn-primary btn-change">change</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        function handleSelect(date)
        {
            window.location = "?date="+date.value;
        }
    </script>
</body>
</html>