<?php
    session_start();
    if(!isset($_SESSION['email']) ) {
        header('location: ../login/index.php');
        exit;
    }else{
        if($_SESSION['role'] == 'User'){
            header('location:  ../login/index.php?error=Userblog');
        }
    }

    include '../../src/config/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashbord</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;700&family=Poppins:wght@100;300;600&display=swap" rel="stylesheet">
    
    <!-- View -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="../../src/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>
<body>
    <div class="grid-content">
        <div class="navbarDiv">
            <nav align="center">
                <div class="item" align="left">
                    <div class="logo">
                        <a href="">
                            <img src="../../src/img/LOGO-RRG.svg"/>
                        </a>
                        </div>
                    
                    <ul>
                        <li class="active" data-toggle="tooltip" data-placement="right" title="Dashboard (coming soon)" id="tool-market">
                            <a href="">
                                <canvas class="logo-dashboard-active"></canvas>
                            </a>
                        </li>
    
                        <li class="" data-toggle="tooltip" data-placement="right" title="Personalia" id="tool-freebies">
                            <a href="../personalia_page/?page=employee_list"> 
                                <canvas class="logo-personalia"></canvas>
                            </a>
                        </li>
    
                        <li class="" data-toggle="tooltip" data-placement="right" title="Salary" id="tool-newsletter">
                            <a href="../salary/index.php">
                                <canvas class="logo-salary"></canvas>
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
                        <div class="main-header">
                            <div class="title-page">
                                <a class="linked-personalia" href="">
                                Dashboard  > <a href="index.php" style="color: #5055BE; font-weight: 600;">overview</a>
                                </a><br>
                                <label for="" style="font-size: 25px; font-weight: 700;">Welcome to dashboard</label>
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
                        <div class="namePage">
                            <label for="" style="color: #5055BE; font-weight: 600;">Salary And Cashbon</label><br>
                            <label for="" style="color: #A5A5A5; font-size: 10px;">Comparing Data</label>
                        </div>
                        <br><br>
                        <div class="distance-content" >
                            <div class="content" style="display: flex;     margin-top: -33px;">
                                <div class="chart">
                                    <div class="soryby" style="display:flex;">
                                        <div class="position-short">
                                            <select class=" role" name="role" id="role" onchange="monthSelect(this)">
                                                <option value=''>--Select Month--</option>
                                                <option selected value='1'>January</option>
                                                <option value='2'>February</option>
                                                <option value='3'>March</option>
                                                <option value='4'>April</option>
                                                <option value='5'>May</option>
                                                <option value='6'>June</option>
                                                <option value='7'>July</option>
                                                <option value='8'>August</option>
                                                <option value='9'>September</option>
                                                <option value='10'>October</option>
                                                <option value='11'>November</option>
                                                <option value='12'>December</option>
                                            </select>
                                        </div>
                                        <div class="division-short">
                                            <select class=" division" name="division" id="ddlYears"  onchange="handleSelect(this)">
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                                <div class="monthlySalary">
                                    <?php
                                    error_reporting(0);
                                        if($_GET['dateYears']){
                                            $year = $_GET['dateYears'];
                                            $sql = mysqli_query($connect,"SELECT SUM(total) as total,date FROM fee WHERE YEAR(date) = '$year'");
                                        }elseif($_GET['dateMonth']){
                                            $month = $_GET['dateMonth'];
                                            $sql = mysqli_query($connect,"SELECT SUM(total) as total,date FROM fee WHERE MONTH(date) = '$month'");
                                        }else{
                                            $sql = mysqli_query($connect,"SELECT SUM(total) as total,date FROM fee");
                                        }   
                                        while($row = mysqli_fetch_array($sql)){
                                    ?>
                                    <label style="    font-weight: 700;" for="">Monthly salary total</label><br>
                                    <label  style="font-size: 10px; color: #a5a5a5;" for="">On <?=$row['date']?></label><br>
                                    <label style="font-size: 26px; color: #5055BE; font-weight: 700;" for="">Rp. <?=number_format($row['total'],2,',','.')?></label><br>
                                    <a style="font-size: 11px; padding: 1px 12px; font-weight: 600; background-color:#FCDC89 !important;" href="../salary/index.php?page=details" class="btn btn-warning">See details</a><br>
                                    <canvas class="coin"></canvas>
                                    <?php
                                        }
                                        ?>
                                </div>
                            </div>
                            <div class="personaliaUpda">
                                <label for="" style="color: #5055BE; font-weight: 600;">Personalia Update</label><br>
                                    <div class="personal">
                                        <?php
                                        $sql = mysqli_query($connect,"SELECT * FROM employee");
                                        while($row = mysqli_fetch_array($sql)){
                                        ?>
                                            <div id="card" class="card" style="margin-right: 10px; margin-left: 5px; width: 7rem; border-radius: 15px; height: 8rem; margin-bottom: 10px;">
                                                <div class="card-body" align="center" style="padding: 0 1rem; " id="cardbody">
                                                    <div class="img-profil">
                                                        <a href="index.php?page=profile_details&&id=<?=$row['id_employee']?>">
                                                            <?php
                                                            if($row['photo_link'] == ''){
                                                            ?>
                                                            <img align="center" class="card-img-top" src="../../src/img/User-img/icons8-user-64.png" alt="Card image cap">
                                                            <?php
                                                            }else{
                                                            ?>
                                                            <img align="center" class="card-img-top" src="../../src/img/User-img/<?=$row['photo_link']?>" alt="Card image cap">
                                                            <?php
                                                            }
                                                            ?>
                                                        </a>
                                                    </div>
                                                    <label class="card-tite" id="label" for="" style="font-size: 9px; font-weight: 700; margin-bottom: 0;"><?=$row['name']?></label>
                                                    <label for="" style="font-size: 8px; margin-bottom: 0; display: table-row-group;">
                                                        <?php
                                                        $id_role = $row['id_role'];
                                                        $sql_role  = mysqli_query($connect,"SELECT * FROM role WHERE id_role = '$id_role'");
                                                        while($r_role = mysqli_fetch_array($sql_role)){
                                                        ?>
                                                        <?=$r_role['role_name']?>
                                                        <?php
                                                        }
                                                        ?>
                                                    </label>
                                                    <label for="" class="division-cardDashboard">
                                                        <?php
                                                        $id_division = $row['id_division'];
                                                        $sql_div  = mysqli_query($connect,"SELECT * FROM division WHERE id_division = '$id_division'");
                                                        while($r_division = mysqli_fetch_array($sql_div)){
                                                        ?>
                                                        <?=$r_division['division_name']?>
                                                        <?php
                                                        }
                                                        ?>
                                                    </label>
                                                    <div class="pointThree" id="<?=$row['id_employee']?>">
                                                        <div class="dropout">
                                                            <button class="more">
                                                                <span></span>
                                                                <span></span>
                                                                <span></span>
                                                            </button>
                                                            <ul>
                                                                <li>
                                                                    <a href="" data-toggle="modal" data-target="#modalQuick<?=$row['id_employee']?>">Quick Edit</a>
                                                                </li>
                                                                <li>
                                                                    <a href="" data-toggle="modal" data-target="#modalDelete<?=$row['id_employee']?>">Delete</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bootstrap CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- JAVASCRIPT ADD ROW -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php
    if($_GET['dateYears']){
        $years = $_GET['dateYears'];
        $month = mysqli_query($connect,"SELECT MONTH(date) AS bulan, SUM(total) AS jumlah_bulanan FROM fee WHERE YEAR(date) = '$years' GROUP BY MONTH(date)");
        $salary = mysqli_query($connect,"SELECT SUM(total) AS jumlah_bulanan FROM fee WHERE YEAR(date) = '$years' GROUP BY MONTH(date)");
        $cashbon = mysqli_query($connect,"SELECT SUM(nominal) as nominalcash FROM cashbon WHERE YEAR(date) = '$years' GROUP BY MONTH(date)");
    }elseif($_GET['dateMonth']){
        $monthdate = $_GET['dateMonth'];
        $month = mysqli_query($connect,"SELECT MONTH(date) AS bulan, SUM(total) AS jumlah_bulanan FROM fee WHERE MONTH(date) = '$monthdate' GROUP BY MONTH(date)");
        $salary = mysqli_query($connect,"SELECT SUM(total) AS jumlah_bulanan FROM fee WHERE MONTH(date) = '$monthdate' GROUP BY MONTH(date)");
        $cashbon = mysqli_query($connect,"SELECT SUM(nominal) as nominalcash FROM cashbon WHERE MONTH(date) = '$monthdate' GROUP BY MONTH(date)");
    }else{
        $month = mysqli_query($connect,"SELECT MONTH(date) AS bulan, SUM(total) AS jumlah_bulanan FROM fee WHERE MONTH(date) != 0 GROUP BY MONTH(date)");
        $salary = mysqli_query($connect,"SELECT SUM(total) AS jumlah_bulanan FROM fee WHERE MONTH(date) != 0 GROUP BY MONTH(date)");
        $cashbon = mysqli_query($connect,"SELECT SUM(nominal) as nominalcash FROM cashbon WHERE MONTH(date) != 0 GROUP BY MONTH(date)");   
    }
    while($b = mysqli_fetch_array($month)) {$ambilbulan =  $b['bulan'];}
        if ($ambilbulan=="01")  $namabulan="Januari";
        elseif ($ambilbulan=="02")  $namabulan="Februari";
        elseif ($ambilbulan=="03")  $namabulan="Maret";
        elseif ($ambilbulan=="04")  $namabulan="April";
        elseif ($ambilbulan=="05")  $namabulan="Mei";
        elseif ($ambilbulan=="06")  $namabulan="Juni";
        elseif ($ambilbulan=="07")  $namabulan="Juli";
        elseif ($ambilbulan=="08")  $namabulan="Agustus";
        elseif ($ambilbulan=="09")  $namabulan="September";
        elseif ($ambilbulan=="10")  $namabulan="Oktober";
        elseif ($ambilbulan=="11")  $namabulan="November";
        elseif ($ambilbulan=="12")  $namabulan="Desember"; 
    ?>
    <script>
    const selectedData = (param, callback = null) => {
        $.ajax({
            type: "POST",
            url:"date/selectedData.php",
            dataType: "json",
            data: {time: param.time, type: param.type},
            success: (response) => { 
                callback(response.data);
            },
            error: (error) => {
                console.error(error);
            }
        });
    }

        const labels = [
            <?php echo '"' . $namabulan . '",'; ?>
        ];
        const data = {
            labels: labels,
            datasets: [{
                        label: ['Salary'],
                        backgroundColor: [
                            'rgba(80, 85, 190, 1)', 
                        ],
                        borderColor: [
                            'rgba(80, 85, 190, 1)',
                        ],
                        data: [<?php while ($p = mysqli_fetch_array($salary)) { echo '"' . $p['jumlah_bulanan'] . '",';}?>],
                    },{
                        label:['Cashbon'],
                        backgroundColor: [
                            'rgba(252, 220, 137, 1)',
                        ],
                        borderColor: [
                            'rgba(252, 220, 137, 1)',
                        ],
                        data: [<?php while ($b = mysqli_fetch_array($cashbon)) { echo '"' . $b['nominalcash'] . '",';}?>],
                    }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {}
        };
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );


    </script>
    <script type="text/javascript">
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
    </script>   
    <script type="text/javascript">
        function handleSelect(elm)
        {
            window.location = "index.php?dateYears="+elm.value;
        }
        function monthSelect(elm)
        {
            window.location = "index.php?dateMonth="+elm.value;
        }
    </script>

</body>
</html>