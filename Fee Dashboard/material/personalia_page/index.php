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

    include '../../src/config/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personalia</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;700&family=Poppins:wght@100;300;600&display=swap" rel="stylesheet">
    
    <!-- View -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="../../src/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

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
                        <li class="" data-toggle="tooltip" data-placement="right" title="Dashboard (coming soon)" id="tool-market">
                            <a href="../dashboard/index.php">
                                <canvas class="logo-dashboard"></canvas>
                            </a>
                        </li>

                        <li class="active" data-toggle="tooltip" data-placement="right" title="Personalia" id="tool-freebies">
                            <a href="?page=employee_list"> 
                                <canvas class="logo-personalia-active"></canvas>
                            </a>
                        </li>

                        <li class="" data-toggle="tooltip" data-placement="right" title="Salary" id="tool-newsletter">
                            <a href="../salary/index.php">
                                <canvas class="logo-salary"></canvas>
                            </a>
                        </li>

                        <li class="" data-toggle="tooltip" data-placement="right" title="User Permission" id="tool-team">
                            <a href="../user_Permission/index.php">
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
                    if($_GET['page'] == 'employee_list'){
                    ?>
                        <div class="main-header">
                            <div class="title-page">
                                <a class="linked-personalia" href="">
                                    Personalia > <a for="">Employee list</a>
                                </a><br>
                                <label for="" style="font-size: 25px; font-weight: 600;">
                                <?php
                                $sql_employee = mysqli_query($connect,"SELECT * FROM employee");
                                ?>
                                <?=mysqli_num_rows($sql_employee)?> employee
                                </label>
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
                                <input type="text" placeholder="Search Name" id="search">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16" style="color:5055BE;">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </div>
                            
                            <div class="position-short">
                                <select class=" role" name="role" id="role" onchange="roleSelect(this)">
                                    <?php
                                    $query_role  = mysqli_query($connect, "SELECT * FROM role");
                                    while($data = mysqli_fetch_array($query_role)){
                                    ?>
                                        <option  value="filterRole=<?=$data['id_role']?>"><?=$data['role_name']?></option>
                                        <?php
                                    }
                                    ?>
                                    <option value="allrole">All Role</option>
                                    <option selected value="Position">Position</option>
                                </select>
                            </div>
                            <div class="division-short">
                                <select class=" division" name="division" id="division"  onchange="handleSelect(this)">
                                    <?php
                                    $query_division  = mysqli_query($connect, "SELECT * FROM division");
                                    while($data = mysqli_fetch_array($query_division)){
                                    ?>
                                        <option value="filterdivision=<?=$data['id_division']?>"><?=$data['division_name']?></option>
                                    <?php
                                    }
                                    ?>  

                                        <option value="alldivision">All Division</option>
                                        <option selected value="Division">Division</option>

                                </select>
                            </div>
                        </div>
                        <div class="distance-content" >
                            <div class="content" style="display: flex; flex-wrap: wrap;">
                                <?php
                                error_reporting(0);
                                    if($_GET['filterdivision']){
                                        $filter = $_GET['filterdivision'];
                                        $query_user = mysqli_query($connect,"SELECT * FROM employee WHERE id_division = '$filter'");
                                    }elseif($_GET['filterRole']){
                                        $filter = $_GET['filterRole'];
                                        $query_user = mysqli_query($connect,"SELECT * FROM employee WHERE id_role = '$filter'");
                                    }else{
                                        $query_user = mysqli_query($connect,"SELECT * FROM employee");
                                    }
                                    
                                    while($row = mysqli_fetch_array($query_user)){
                                ?>
                                <div class="list" id="content">
                                    <div class="row" id="idCard">
                                        <div id="card" class="card" style="margin-right: 21px; margin-left: 15px; width: 7rem; border-radius: 15px; padding-bottom: .5rem; margin-bottom: 10px;">
                                            <a class="img-profil" href="index.php?page=profile_details&&id=<?=$row['id_employee']?>">
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
                                            <div class="card-body" align="center" style="padding: 0 1rem; " id="cardbody">
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
                                                <label for="" class="divison-card">
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
                                    </div>
                                </div>
                                <!-- Modal Quick-->
                                <div class="modal fade" id="modalQuick<?=$row['id_employee']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <form action="process/inputData.php" method="post">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header titleModal">
                                                    <input type="hidden" value="<?=$row['id_employee']?>" name="id">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Quick Edit</h5>
                                                    <button type="button" style="position: absolute; right: 13px; top: 8px;" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                </div>
                                                <div class="modal-body bodyModal">
                                                    <div class="nameinput">
                                                        <label for="name">Name</label><br>
                                                        <input type="text" name="name" class="" value="<?=$row['name']?>"><br>
                                                        <label for="name">Division</label><br>
                                                        <select class=" division" name="division" id="division">
                                                            <?php
                                                            $query_division  = mysqli_query($connect, "SELECT * FROM division");
                                                            while($data = mysqli_fetch_array($query_division)){
                                                            ?>
                                                                <option value="<?=$data['id_division']?>"><?=$data['division_name']?></option>
                                                            <?php
                                                            }
                                                            $iddiv = $row['id_division'];
                                                            $sqldiv = mysqli_query($connect, "SELECT * FROM division WHERE id_division = '$iddiv'");
                                                            while($datadiv = mysqli_fetch_array($sqldiv)){
                                                            ?>
                                                            <option selected value="<?=$row['id_division']?>"><?=$datadiv['division_name']?></option>
                                                            <?php
                                                            }
                                                            ?>

                                                        </select>
                                                    </div>
                                                    <div class="nameinput">
                                                        <label for="name">Email</label><br>
                                                        <?php
                                                        $id_account = $row['id_account'];
                                                            $query_acc = mysqli_query($connect,"SELECT * FROM account WHERE id_account = '$id_account'");
                                                            while($r = mysqli_fetch_array($query_acc)){
                                                            ?>
                                                            <input name="email" type="text" class="form-biodata" value="<?=$r['email']?>"><br>
                                                            <?php
                                                            }
                                                            ?>
                                                        <label for="name">Position</label><br>
                                                        <select class="role" name="role" id="role">
                                                            <?php
                                                            $query_role  = mysqli_query($connect, "SELECT * FROM role");
                                                            while($data = mysqli_fetch_array($query_role)){
                                                            ?>
                                                                <option  value="<?=$data['id_role']?>"><?=$data['role_name']?></option>
                                                        
                                                            <?php
                                                            }
                                                            $idrole = $row['id_role'];
                                                            $sqlRole = mysqli_query($connect, "SELECT * FROM role WHERE id_role = '$idrole'");
                                                            while($datarole = mysqli_fetch_array($sqlRole)){
                                                            ?>
                                                            <option selected value="<?=$row['id_role']?>"><?=$datarole['role_name']?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary btnModalSave" name="btnModalSave">Save and Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- Modal Delete-->
                                <div class="modal fade" id="modalDelete<?=$row['id_employee']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <form action="process/inputData.php" method="post">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content" style="padding: 6% 9%;">
                                            <div class="modal-header" style="border: none;">
                                                <button style="position: absolute; right: 13px; top: 8px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class=" titleModal">
                                                <h5 class="h5modal" id="exampleModalCenterTitle">Are you Sure to Delete?</h5>
                                                <label class="labelmodal" for="">you will delete data from this account</label>
                                            </div>
                                            <div class="modal-body bdyModal" style="    align-self: center;">
                                                <input type="hidden" name="id" value="<?=$row['id_employee']?>">
                                                <h5 style="color: #5055BE; margin: 0; font-weight: 700;"><?=$row['name']?></h5>
                                                <label class="positionlabelmodal" for="">
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
                                            </div>
                                            <button name="btnModalDelete" class="btn btn-primary btnModalDelete">Delete</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                               
                                <div class="addUser">
                                    <a class="btn-addUser" data-toggle="modal" data-target="#modalAdd" href=""><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                        </svg>
                                    </a>
                                </div>
                                <div class="circle"></div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                    }else if($_GET['page'] == 'profile_details'){
                        
                    ?>                        
                        <div class="main-header">
                            <div class="title-page">
                                <a class="linked-personalia" href="">
                                    Personalia > <a for="" href="?page=employee_list">Employee list </a><label for="">></label><a href="">Profile Details</a>
                                </a><br>
                                <label for="" style="font-size: 25px; font-weight: 600;">Profile Details</label>
                            </div>
                            <div class="user-profil">
                                <div class="image-user">
                                    <img src="../../src/img/User-img/image 4.jpg" alt="">
                                </div>
                                <div class="name-space">
                                    <label style="font-size: 13px; font-weight: 700; margin: 0;" for="">Nama User</label><br>
                                    <label style="font-size: 12px;" for="">Role</label>
                                </div>
                            </div>
                        </div>
                            <?php
                            error_reporting(0);
                                if($_GET['edit'] == 'editPersonal'){
                                    $id_employee = $_GET['id'];
                                    $query_employee = mysqli_query($connect,"SELECT * FROM employee WHERE id_employee = '$id_employee'");
                                    while($row = mysqli_fetch_array($query_employee)){
    
                            ?>
                            <form action="process/inputData.php" method="post" enctype="multipart/form-data">
                                <input type="file"  style="display: none;" name="a" id="file" value="<?=$row['photo_link']?>">
                                <div class="user">
                                    <div class="user-img">
                                        <div class="imgPersonal">
                                            <label for="file" id="uploadBtn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                                                    <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1v6zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2z"/>
                                                    <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zm0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7zM3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                                                </svg>
                                            </label>
                                            <img src="../../src/img/User-img/<?=$row['photo_link']?>" alt="" id="photo">
                                        </div>

                                    </div> 
                                    <div class="name-user">
                                        <label style="font-size: 13px; font-weight: 700; margin: 0;" for=""><?=$row['name']?></label><br>
                                        <label style="font-size: 12px; border-radius: 15px; padding: 1px 6px; background-color: #B6B9FF;" for="">
                                        <?php
                                            $id_division = $row['id_division'];
                                            $query_div = mysqli_query($connect,"SELECT * FROM division WHERE id_division = '$id_division'");
                                            while($r_div = mysqli_fetch_array($query_div)){
                                        ?>
                                            <?=$r_div['division_name']?>
                                        <?php
                                            }
                                            ?>
                                        </label>
                                        <label style="font-size: 12px;" for="">
                                        <?php
                                            $id_role = $row['id_role'];
                                            $query_div = mysqli_query($connect,"SELECT * FROM role WHERE id_role = '$id_role'");
                                            while($r_div = mysqli_fetch_array($query_div)){
                                        ?>
                                            <?=$r_div['role_name']?>
                                        <?php
                                            }
                                            ?>

                                        </label>
                                    </div>
                                </div>

                                <div class="content-details">
                                    <div class="content-personal">
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr class="title-table">
                                                    <th colspan="2">Personal Information</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-personal">
                                                <tr>
                                                    <input type="hidden" name="id" value="<?=$row['id_employee']?>">
                                                    <td class="nametd"><p class="font-weight-bold text-body">Name</p></td>
                                                    <td>: <input name="nama" type="text" class="form-biodata" value="<?=$row['name']?>"></td>
                                                </tr>
                                                <tr>
                                                    <td class="nametd"><p class="font-weight-bold text-body">Email</p></td>
                                                    <td>                                                    
                                                        <?php
                                                        $id_account = $row['id_account'];
                                                        $query_acc = mysqli_query($connect,"SELECT * FROM account WHERE id_account = '$id_account'");
                                                        while($r = mysqli_fetch_array($query_acc)){
                                                        ?>
                                                        :  <input name="email" type="text" class="form-biodata" value="<?=$r['email']?>">
                                                        <?php
                                                        }
                                                        ?>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="nametd"><p class="font-weight-bold text-body">Gender</p></td>
                                                    <td>: <input name="gender" type="text" class="form-biodata" value="<?=$row['gender']?>"></td>
                                                </tr>
                                                <tr>
                                                    <td class="nametd"><p class="font-weight-bold text-body">Birthplace</p></td>
                                                    <td>: <input name="b_place" type="text" class="form-biodata" value="<?=$row['birth_place']?>"></td>
                                                </tr>
                                                <tr>
                                                    <td clas="nametd"><p class="font-weight-bold text-body">Date of birth</p></td>
                                                    <td>: <input name="b_date" type="text" class="form-biodata" value=" <?=$row['birth_date']?>"></td>
                                                </tr>
                                                <tr>
                                                    <td class="nametd"><p class="font-weight-bold text-body">Phone Number</p></td>
                                                    <td>: <input name="p_number" type="text" class="form-biodata" value=" <?=$row['phone_number']?>"></td>
                                                </tr>

                                                <tr>
                                                    <td class="nametd"><p class="font-weight-bold text-body">Other Contact</p></td>
                                                    <td>: <input name="o_cont" type="text" class="form-biodata" value=" <?=$row['other_contact']?>"></td>
                                                </tr>

                                            </tbody>
                                        </table>                            
                                    </div>
                                    <div class="content-additional">
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr class="title-table">
                                                    <th colspan="2">Additional Information</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-personal">
                                                <tr>
                                                    <td class="nametd"><p class="font-weight-bold text-body">Domicilied Now</p></td>
                                                    <td>: <input name="domicile" type="text" class="form-biodata" value="<?=$row['domicile']?>"></td>
                                                </tr>
                                                <tr>
                                                    <td class="nametd"><p class="font-weight-bold text-body">Mother Name</p></td>
                                                    <td>: <input name="mother" type="text" class="form-biodata" value="<?=$row['mother_name']?>"></td>
                                                </tr>
                                                <tr>
                                                    <td class="nametd"><p class="font-weight-bold text-body">Father Name</p></td>
                                                    <td>: <input name="father" type="text" class="form-biodata" value="<?=$row['father_name']?>"></td>
                                                </tr>
                                                <tr>
                                                    <td class="nametd"><p class="font-weight-bold text-body">Status</p></td>
                                                    <td>: <input name="status" type="text" class="form-biodata" value="<?=$row['status']?>"></td>
                                                </tr>
                                                <tr>
                                                    <td clas="nametd"><p class="font-weight-bold text-body">Religion</p></td>
                                                    <td>: <input name="religion" type="text" class="form-biodata" value="<?=$row['religion']?>"></td>
                                                </tr>
                                                <tr>
                                                    <td clas="nametd"><p class="font-weight-bold text-body">Last Education</p></td>
                                                    <td>: <input name="last" type="text" class="form-biodata" value="<?=$row['last_education']?>"></td>
                                                </tr>
                                                <tr>
                                                    <td clas="nametd"><p class="font-weight-bold text-body">Institution</p></td>
                                                    <td>: <input name="instit" type="text" class="form-biodata" value="<?=$row['institution']?>"></td>
                                                </tr>
                                                <tr>
                                                    <td clas="nametd"><p class="font-weight-bold text-body">Disease History</p></td>
                                                    <td>: <input name="disease" type="text" class="form-biodata" value="<?=$row['disease_history']?>"></td>
                                                </tr>
                                            </tbody>
                                        </table>                            
                                    </div>
                                </div>
                                    <button class="btn btn-primary btn-editBiodata" name="savePersonal">Save</button>
                            </form>
                            <?php
                                    }
                            }else{
                                error_reporting(0);
                                $id_employee = $_GET['id'];
                                $query_employee = mysqli_query($connect,"SELECT * FROM employee WHERE id_employee = '$id_employee'");
                                while($row = mysqli_fetch_array($query_employee)){
                                ?>
                            <div class="user">
                                <div class="user-img">
                                    <?php
                                    $img = $row['photo_link'];
                                    if($img == NULL){
                                    ?>
                                    <img src="" alt="">
                                    <div class="imgPersonal" style="margin-top: -24px !important;">
                                        <!-- <input style="display:none;" type="file" id="file" name="image" > -->
                                        <label for="file" id="uploadBtn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                                                <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1v6zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2z"/>
                                                <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zm0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7zM3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                                            </svg>
                                        </label>
                                    </div>
                                    <?php
                                    }else{
                                    ?>
                                    <img src="../../src/img/User-img/<?=$row['photo_link']?>" alt="">
                                    <?php

                                        }
                                    
                                    ?>
                                </div>
                                <div class="name-user">
                                    <label style="font-size: 13px; font-weight: 700; margin: 0;" for=""><?=$row['name']?></label><br>
                                    <label style="font-size: 12px; border-radius: 15px; padding: 1px 6px; background-color: #B6B9FF;" for="">
                                    <?php
                                        $id_division = $row['id_division'];
                                        $query_div = mysqli_query($connect,"SELECT * FROM division WHERE id_division = '$id_division'");
                                        while($r_div = mysqli_fetch_array($query_div)){
                                    ?>
                                        <?=$r_div['division_name']?>
                                    <?php
                                        }
                                        ?>
                                    </label>
                                    <label style="font-size: 12px;" for="">
                                    <?php
                                        $id_role = $row['id_role'];
                                        $query_div = mysqli_query($connect,"SELECT * FROM role WHERE id_role = '$id_role'");
                                        while($r_div = mysqli_fetch_array($query_div)){
                                    ?>
                                        <?=$r_div['role_name']?>
                                    <?php
                                        }
                                        ?>

                                    </label>
                                </div>
                            </div>
                            <div class="content-details">
                                <div class="content-personal">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr class="title-table">
                                                <th colspan="2">Personal Information</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-personal">
                                            <tr>
                                                <td class="nametd"><p class="font-weight-bold text-body">Name</p></td>
                                                <td>: <?=$row['name']?></td>
                                            </tr>
                                            <tr>
                                                <td class="nametd"><p class="font-weight-bold text-body">Email</p></td>
                                                <td>
                                                    <?php
                                                    $id_account = $row['id_account'];
                                                    $query_acc = mysqli_query($connect,"SELECT * FROM account WHERE id_account = '$id_account'");
                                                    while($r = mysqli_fetch_array($query_acc)){
                                                    ?>
                                                    : <?=$r['email']?> 

                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="nametd"><p class="font-weight-bold text-body">Gender</p></td>
                                                <td>: <?=$row['gender']?></td>
                                            </tr>
                                            <tr>
                                                <td class="nametd"><p class="font-weight-bold text-body">Birthplace</p></td>
                                                <td>: <?=$row['birth_place']?></td>
                                            </tr>
                                            <tr>
                                                <td clas="nametd"><p class="font-weight-bold text-body">Date of birth</p></td>
                                                <td>: <?=$row['birth_date']?></td>
                                            </tr>
                                            <tr>
                                                <td class="nametd"><p class="font-weight-bold text-body">Phone Number</p></td>
                                                <td>: <?=$row['phone_number']?></td>
                                            </tr>

                                            <tr>
                                                <td class="nametd"><p class="font-weight-bold text-body">Other Contact</p></td>
                                                <td>: <?=$row['other_contact']?></td>
                                            </tr>

                                        </tbody>
                                    </table>                            
                                </div>
                                <div class="content-additional">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr class="title-table">
                                                <th colspan="2">Additional Information</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-personal">
                                            <tr>
                                                <td class="nametd"><p class="font-weight-bold text-body">Domicilied Now</p></td>
                                                <td>: <?=$row['domicile']?></td>
                                            </tr>
                                            <tr>
                                                <td class="nametd"><p class="font-weight-bold text-body">Mother Name</p></td>
                                                <td>: <?=$row['mother_name']?></td>
                                            </tr>
                                            <tr>
                                                <td class="nametd"><p class="font-weight-bold text-body">Father Name</p></td>
                                                <td>: <?=$row['father_name']?></td>
                                            </tr>
                                            <tr>
                                                <td class="nametd"><p class="font-weight-bold text-body">Status</p></td>
                                                <td>: <?=$row['status']?></td>
                                            </tr>
                                            <tr>
                                                <td clas="nametd"><p class="font-weight-bold text-body">Religion</p></td>
                                                <td>: <?=$row['religion']?></td>
                                            </tr>
                                            <tr>
                                                <td clas="nametd"><p class="font-weight-bold text-body">Last Education</p></td>
                                                <td>: <?=$row['last_education']?></td>
                                            </tr>
                                            <tr>
                                                <td clas="nametd"><p class="font-weight-bold text-body">Institution</p></td>
                                                <td>: <?=$row['institution']?></td>
                                            </tr>
                                            <tr>
                                                <td clas="nametd"><p class="font-weight-bold text-body">Disease History</p></td>
                                                <td>: <?=$row['disease_history']?></td>
                                            </tr>
                                        </tbody>
                                    </table>                            
                                </div>
                            </div>
                                <a href="?page=profile_details&edit=editPersonal&id=<?=$_GET['id']?>" class="btn btn-primary btn-editBiodata">Edit Data</a>
                            <?php
                                }
                            ?>
                        <?php
                        }
                        ?>
  
                        <div class="addUser">
                            <a class="btn-addUser" data-toggle="modal" data-target="#modalAdd" href=""><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                            </a>
                        </div>
                        <div class="circle"></div>

                    <?php
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bootstrap CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- Modal -->
    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom:none;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: -webkit-center;">
                   <canvas class="modalAdd"></canvas>
                   <h5>Add employee by CSV</h5>
                   <form action="process/upload_csv.php" method="post" enctype="multipart/form-data">
                        <div class="drop-zone" align="center">
                                <canvas class="iconUpload"></canvas><br>
                                <span class="drop-zone__prompt">Drop the Excel / CSV file here</span>
                                <input type="file" name="file" class="drop-zone__input" multiple="multiple">
                            </div>
                        <button class="btn btn-upload" name="submitCsv">Select File</button>
                   </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    error_reporting(0);
    if($_GET['valid'] == 'success'){
        echo '<script>$(document).ready(function(){$("#modalNotification").modal("show");});</script>';
    }
    ?>
    <!-- Modal Success-->
    <div class="modal fade" id="modalNotification" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="border:0;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: -webkit-center; padding-bottom: 60px;">
                    <canvas class="modalSuccess"></canvas>
                    <h5 >Success Upload CSV data</h5>
                    <p style="font-size: 10px;">Click continue to fill the division and job position data</p>
                    <label for="" style="font-size: 20px; font-weight: 700;">Lee Min Ho</label><br>
                    <button data-toggle="modal" data-target="#modalChoose" data-dismiss="modal" class="btn btn-upload" name="">Continue</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Choose-->
    <div class="modal fade" id="modalChoose" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="border:0;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: -webkit-center; padding-bottom: 60px;">
                    <form action="process/inputData.php" method="post">
                        <canvas class="modalChoose"></canvas>
                        <h5 style="margin-bottom: 35px;">Choose division and position</h5>
                        <div class="SelectChoose">
                            <!-- Division -->
                            <select class=" division" name="division" id="division">
                                <?php
                                $query_division  = mysqli_query($connect, "SELECT * FROM division");
                                while($data = mysqli_fetch_array($query_division)){
                                ?>
                                    <option value="<?=$data['id_division']?>"><?=$data['division_name']?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <!-- position -->
                            <select class=" role" name="role" id="role">
                                <?php
                                $query_role  = mysqli_query($connect, "SELECT * FROM role");
                                while($data = mysqli_fetch_array($query_role)){
                                ?>
                                    <option selected value="<?=$data['id_role']?>"><?=$data['role_name']?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <button class="btn btn-upload" name="savedataModal">Save data and Continue</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function handleSelect(elm)
        {
            window.location = "index.php?page=employee_list&&"+elm.value;
        }
        function roleSelect(elm)
        {
            window.location = "index.php?page=employee_list&&"+elm.value;
        }
    </script>
    <script src="js/dropzone.js"></script>
    <script src="js/apps.js"></script>
    <!-- process popUp 3dots -->
    <script>
        document.querySelector('div').onclick = ({
        target
        }) => {if (!target.classList.contains('more')) 
                return document.querySelectorAll('.dropout.active').forEach(
                    (d) => d !== target.parentElement && d.classList.remove('active'))
                    target.parentElement.classList.toggle('active')
                }
    </script>

    <!-- search process -->
    <script>
        $(document).ready(function() {
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#idCard div").filter(function() {
                    $(this).toggle($(this).find('label').text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>
</html>