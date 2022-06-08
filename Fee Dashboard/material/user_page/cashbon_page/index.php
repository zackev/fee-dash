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
  <title>Cashbon</title>
  
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
        <!-- navbar desktop -->
        <div class="navbarDiv">
            <nav align="center">
                <div class="item" align="left">
                    <div class="logo">
                        <a href="">
                            <img src="../../../src/img/LOGO-RRG.svg"/>
                        </a>
                    </div>
                    
                    <ul>
                        <li class="" data-toggle="tooltip" data-placement="right" title="">
                            <a href="../salary_user/">
                                <canvas class="logo-salary"></canvas>
                            </a>
                        </li>

                        <li class="active" data-toggle="tooltip" data-placement="right" title="Personalia" id="tool-freebies">
                            <a href=""> 
                                <canvas class="logo-cashbon-active"></canvas>
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
                            <a href="../salary_user/">
                                <canvas class="logo-salary"></canvas>
                            </a>
                        </li>

                        <li class="active" data-toggle="tooltip" data-placement="right" title="Personalia" id="tool-freebies">
                            <a href=""> 
                                <canvas class="logo-cashbon-active"></canvas>
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

        <!-- main page  -->
        <div class="main-page">
            <div class="headPage">
                <div class="left-header">
                    <a class="salarytitle" href="">Cashbon</a> > <a class="overviewtitle" href="">Details</a>
                    <h3>Welcome, 
                        <?php
                            if($_GET['alert'] == 'on'){
                                echo "<script>
                                alert('Employees already cashbon');
                                </script>";
                            }elseif($_GET['alert'] == 'max'){
                                echo "<script type='text/javascript'>alert('sorry, cashbon exceeds the maximum ');</script>";
                            }
                        
                            $id = $_SESSION['id'];
                            $sqlName = mysqli_query($connect,"SELECT * FROM employee WHERE id_account = '$id'");
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
            <div class="main-content">
                    <div class="userCashbon">
                        <div class="user">
                            <div class="user-img">
                                <?php
                                $idnama = $_SESSION['id'];
                                $emp = mysqli_query($connect,"SELECT * FROM employee WHERE id_account='$idnama'");
                                while($r = mysqli_fetch_array($emp)){
                                ?>
                                    <img src="../../../src/img/User-img/<?=$r['photo_link']?>" alt="">
                                <?php
                                }
                                ?>
                            </div>
                            <div class="name-user">
                                <label class="nameUserCashbon" for="">
                                    <?php
                                    $idnama = $_SESSION['id'];
                                    $employee = mysqli_query($connect,"SELECT * FROM employee WHERE id_account = '$idnama'");
                                    while($rname = mysqli_fetch_array($employee)){
                                    ?>
                                    <?=$rname['name']?>
                                    <?php
                                    }
                                    ?>
                                </label><br>
                                <label class="roleuserCashbon" for="">
                                    <?php
                                         $idnama = $_SESSION['id'];
                                        $query_div = mysqli_query($connect,"SELECT * FROM employee WHERE id_account = '$idnama'");
                                        while($r_div = mysqli_fetch_array($query_div)){
                                            $idrole= $r_div['id_role'];
                                            $idemployee= $r_div['id_employee'];
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
                        <div class="applyCashbon_btn">
                            <a data-toggle="modal" data-target="#modalApplyCashbon">Apply for cash bonds</a>
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
                                            <?php
                                            $queryAcc = mysqli_query($connect,"SELECT * FROM employee WHERE id_account = '$idnama'");
                                            while($rowAcc = mysqli_fetch_array($queryAcc)){
                                                $idEmpl = $rowAcc['id_employee'];
                                            }
                                        $query = mysqli_query($connect,"SELECT cashbon.*, employee.name, fee.cashbon FROM cashbon JOIN employee ON employee.id_employee = cashbon.id_employee JOIN fee ON fee.id_employee = cashbon.id_employee  WHERE fee.id_employee = '$idEmpl'");
                                        while($rowCash = mysqli_fetch_array($query)){
                                            ?>
                                    <tr>
                                        <td><?=number_format($rowCash['nominal'], 0, ".", ".")?></td>
                                        <td>
                                            <?php
                                                $cashbon = $rowCash['nominal'];
                                                $cicilan = $rowCash['cashbon'];
                                                $leftover = $cashbon - $cicilan; 
                                            ?>
                                            <?=number_format($leftover, 0, ".", ".")?>
                                        </td>
                                    </tr>
                                    <?php
                                            }
                                            ?>
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
                                     $queryest = mysqli_query($connect,"SELECT MAX(date) AS dateFee FROM fee WHERE id_employee = $idEmpl");
                                     while($rowEst = mysqli_fetch_array($queryest)){
                                         $datefee = $rowEst['dateFee'];
                                    }
                                        $queryDate  = mysqli_query($connect,"SELECT cashbon.date as cashbon_date, fee.date as fee_date, cashbon.nominal, fee.cashbon FROM fee JOIN cashbon ON cashbon.id_employee = fee.id_employee WHERE fee.id_employee = '$idEmpl' && fee.date = ' $datefee'");
                                        while($rowDate = mysqli_fetch_array($queryDate)){
                                            $datecreate = $rowDate['cashbon_date'];
                                            $nominal = $rowDate['nominal'];
                                            $cashbon = $rowDate['cashbon'];
                                            
                                            $estnominal  = $nominal/$cashbon;
                                            $estDate = date('Y-m-d', strtotime('+'.$estnominal.'month', strtotime($datecreate))); 
                                    ?>
                                    <tr>
                                        <td><?=$datecreate?></td>
                                        <td><?=$estDate?></td>
                                        
                                    </tr>
                                    <?php
                                    }
                                    ?>
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
                                    $query = mysqli_query($connect,"SELECT * FROM cashbon WHERE id_employee=$id");
                                    while($datacash = mysqli_fetch_array($query)){
                                    ?>

                                    <tr>
                                        <td><?=$datacash['date']?></td>
                                        <td><?=number_format($datacash['nominal'], 0, ".", ".")?></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Error -->
                    <div class="tabelCash">
                        <?php
                        $queryCashAct = mysqli_query($connect,"SELECT * FROM cashbon WHERE id_employee = '$idEmpl'");
                        while($data = mysqli_fetch_array($queryCashAct)){
                                if($data['status'] == 'active'){
                            ?>
                                <label class="statusCashbonActive" for="">Active</label>
                            <?php
                                }elseif($data['status'] == 'pending'){
                                ?>
                                <label class="statusCashbonPending" for="">Pending</label>
                            <?php
                                }elseif($data['status'] == 'reject'){
                                ?>
                                <label class="statusCashbonReject" for="">Reject</label>
                                <?php
                                }else{
                                ?>
                                <label class="statusCashbon" for="">Complete</label>
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
                                    $queryAccTable = mysqli_query($connect,"SELECT * FROM employee WHERE id_account = '$idnama'");
                                    while($rowAccTable = mysqli_fetch_array($queryAccTable)){
                                        $idEmployees = $rowAccTable['id_employee'];
                                    }
                                    $query = mysqli_query($connect,"SELECT cashbon.*, employee.name, fee.cashbon,fee.date AS datefee FROM cashbon JOIN employee ON employee.id_employee = cashbon.id_employee JOIN fee ON fee.id_employee = cashbon.id_employee  WHERE fee.id_employee = '$idEmployees'");
                                    while($rowCash = mysqli_fetch_array($query)){
                               ?>
                                 <tr>
                                    <td><?=$rowCash['datefee']?></td>
                                    <td><?=number_format($rowCash['nominal'], 0, ".", ".")?></td>
                                    <td>
                                    <?php
                                        $cashbon = $rowCash['nominal'];
                                        $cicilan = $rowCash['cashbon'];
                                        $leftover = $cashbon - $cicilan; 
                                    ?>
                                    <?=number_format($leftover, 0, ".", ".")?>
                                    </td>
                                </tr>
                                <?php
                                    }
                                    ?>
                            </tbody>
                        </table>      
                    </div>
            </div>
        </div>
    </div>

    <!-- Modal apply cashbon-->
    <div class="modal fade" id="modalApplyCashbon" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="    padding-bottom: 40px;">
                <h5>Apply for new cash bond</h5>
                <table style="width: 100%;">
                    <tbody>
                        <tr>
                            <td>Maximum loan limit (RP)</td>
                            <?php
                                $fee = mysqli_query($connect,"SELECT AVG(total) FROM fee WHERE id_employee = '$id'");
                                while($avg = mysqli_fetch_array($fee)){
                                    $avgrate = $avg['AVG(total)'];
                                }
                                // menghitung maksimal cashbon  
                                $countpaid = $avgrate / 3;
                                // membulatkan bilangan 
                                $roundpaid =  round($countpaid);
                            ?>
                            <td><label class="validasiMax" for=""><?=number_format($roundpaid, 0, ".", ".")?></label></td>
                        </tr>
                        <tr>
                            <td>Salary deduction every month (Rp)</td>
                            <td><label class="validasiMax" id="validasiMax" for="">500.000</label></td>
                        </tr>
                        <tr>
                            <td>Credit request (Rp)</td>
                            <td></td>
                        </tr>
                        <form action="process/applyCashbon.php" method="post">
                            <tr>
                                <td>
                                    <?php
                                    $idnama = $_SESSION['id'];
                                    $employee = mysqli_query($connect,"SELECT * FROM employee WHERE id_account = '$idnama'");
                                    while($rname = mysqli_fetch_array($employee)){
                                    ?>
                                        <input type="hidden" name="id" value="<?=$rname['id_employee']?>">
                                    
                                    <?php
                                    }
                                    ?>
                                    <input type="text" id="cashbonReq" name="value" class="form-control number" onchange="request()">
                                </td>
                                <div id="errmsg"></div>
                                <td><button name="apply" class="btn">Apply Now</button></td>
                            </tr>
                        </form>
                        </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
    <!-- bootstrap CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <!-- nav close and open process -->
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
    
    <!-- script mencari Salary deduction every month -->
    <script>
        function request(){
            var reqCash = document.getElementById('cashbonReq').value;
            var total = reqCash * 10/100;
            document.getElementById('validasiMax').innerHTML = total;
        }
    </script>

    <!-- modal change password -->
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
                        <input type="hidden" name="<?=$_SESSION['id']?>" name="id">
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

</body>
</html>