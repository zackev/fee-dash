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
    <title>Initalization Setup</title>

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
    
                        <li class="nav-bottom active" data-toggle="tooltip" data-placement="right" title="Initialization Setup" id="tool-sync">
                            <a href="../initialization_page/index.php?personalia">
                                <canvas class="logo-setting-active"></canvas>
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
                                Initalization Setup  > <a href="index.php" style="color: #000; font-weight: 600;">Element</a>
                                </a><br>
                                <label for="" style="font-size: 25px; font-weight: 600;">User List</label>
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

                            <?php
                            error_reporting(0);
                            if($_GET['page'] == 'personalia'){
                            ?>
                            <div class="position-short">
                                <a class="btnPersonal-act" href="">
                                    <canvas class="btn-personal-active"></canvas>
                                </a>
                            </div>
                            <div class="division-short">
                                <a class="btnSalary" href="index.php?page=Salary">
                                    <canvas class="btn-salary"></canvas>
                                </a>
                            </div>
                            <?php
                            }elseif($_GET['page'] == 'Salary'){
                            ?>
                            <div class="position-short">
                                <a class="btnPersonal" href="index.php?page=personalia">
                                    <canvas class="btn-personal"></canvas>
                                </a>
                            </div>
                            <div class="division-short">
                                <a class="btnSalary-active" href="">
                                    <canvas class="btn-salary-active"></canvas>
                                </a>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        <br><br>
                        <div class="distance-content" style="display: flex; justify-content: space-between;">
                        <?php
                            error_reporting(0);
                            if($_GET['page'] == 'personalia'){
                            ?>
                            <div class="content">
                                <label for="">Division</label>
                                <table class="table table-borderless">
                                    <thead class="tableHead">
                                        <tr>
                                            <th scope="col" class="th-title">Title</th>
                                            <th scope="col">Position</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query_division = mysqli_query($connect,"SELECT * FROM division");
                                        while($row = mysqli_fetch_array($query_division)){
                                        ?>
                                        <tr>
                                        <?php
                                        error_reporting(0);
                                        if($row['id_division'] == $_GET['edit']){
                                        ?>
                                            <td>
                                                <form class="float-left" action="process/input_data.php" method="POST">
                                                    <input class="d-none" type="text" name="id" value="<?=$_GET['id']?>">
                                                    <input autofocus type="text" class="inp-div" name="division_name" id="" value="<?=$row['division_name']?>">
                                            </td>
                                            <td></td>
                                            <td class="text-right">
                                                <button name="btn-Save" class="btn-save-division">
                                                    <canvas class="btn-saveDivision"></canvas>
                                                </button>
                                                </form>
                                                <?php
                                                if($_GET['id'] == $row['id_division']){
                                                ?>
                                                <a class="btn-arrowRight-Active" href="?page=personalia&&elements=role&&id=<?=$row['id_division']?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="black" class="bi bi-arrow-right" viewBox="0 0 16 16" style="margin-top:-5px !important;">
                                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                                    </svg>
                                                </a>
                                                <?php
                                                }else{
                                                ?>
                                                <a class="btn-arrowRight" href="?page=personalia&&elements=role&&id=<?=$row['id_division']?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="black" class="bi bi-arrow-right" viewBox="0 0 16 16" style="margin-top:-5px !important;">
                                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                                    </svg>
                                                </a>
                                                <?php
                                                }
                                                ?>
                                            </td>

                                        <?php
                                        }else{
                                        ?>

                                            <td><?=$row['division_name']?></td>
                                            <?php
                                            $id_division = $row['id_division'];
                                            $sql_check_role = mysqli_query($connect, "SELECT * FROM role WHERE id_division='$id_division'");
                                            ?>
                                            <td><?=mysqli_num_rows($sql_check_role)?></td>
                                            <td>
                                                <a class="btn-permission" href="?page=personalia&&elements=role&&id=<?=$row['id_division']?>&&edit=<?=$row['id_division']?>"><canvas class="btn-editPermission"></canvas></a>
                                                <a class="btn-permissiondelete" href="" data-toggle="modal" data-target="#DeleteDivision<?=$row['id_division']?>"><canvas class="btn-deletePermission"></canvas></a>
                                                <?php
                                                if($_GET['id'] == $row['id_division']){
                                                ?>
                                                <a class="btn-arrowRight-Active" href="?page=personalia&&elements=role&&id=<?=$row['id_division']?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="black" class="bi bi-arrow-right" viewBox="0 0 16 16" style="margin-top:-5px !important;">
                                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                                    </svg>
                                                </a>
                                                <?php
                                                }else{
                                                ?>
                                                <a class="btn-arrowRight" href="?page=personalia&&elements=role&&id=<?=$row['id_division']?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="black" class="bi bi-arrow-right" viewBox="0 0 16 16" style="margin-top:-5px !important;">
                                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                                    </svg>
                                                </a>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <?php
                                        }
                                            ?>
                                        </tr>
                                        <!-- Modal Delete-->
                                        <div class="modal fade" id="DeleteDivision<?=$row['id_division']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <form action="process/input_data.php" method="post">
                                                        <div class="modal-header" style="border: 0;">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="text-align: -webkit-center;     padding-bottom: 80px;">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to delete permantly?</h5>
                                                            <p class="parText-modal">If you delete this element, all data related to it will be lost</p>
                                                            <input type="hidden" name="id" value="<?=$row['id_division']?>"><br>
                                                            <label class="lb-modalText" for=""><?=$row['division_name']?></label><br>
                                                            <label for="">Division</label><br>
                                                            <button name="delete" class="btn btn-primary btn-deleteDivision">Delete now</button>
                                                            <button type="button" class="btn btn-secondary btn-cancelModal" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="3">
                                                <form action="process/input_data.php" method="POST">
                                                    <input type="text" name="value" class="inp-div" placeholder="Insert here">
                                                    <input class="btn-addDiv" name="input_div" type="submit" value="Add Division">
                                                </form>
                                            </td>
                                        </tr>
                                      
                                    </tbody>
                                </table>                                
                            </div>
                            <div class="content" style="margin-left: 20px;">
                                <label for="">Role</label>
                                <table class="table table-borderless">
                                    <thead class="tableHead">
                                        <tr>
                                            <th scope="col" class="th-title" style="width: 330px;">Title</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $id_divisi = $_GET['id'];
                                        $query_role = mysqli_query($connect,"SELECT * FROM role WHERE id_division = '$id_divisi'");
                                        while($row = mysqli_fetch_array($query_role)){
                                        ?>
                                        <tr>
                                        <?php
                                        error_reporting(0);
                                        if($row['id_role'] == $_GET['editrole']){
                                        ?>
                                        <td>
                                            <form class="float-left" action="process/input_data.php" method="POST">
                                                <input class="d-none" type="text" name="param" value="edit_role">
                                                <input class="d-none" type="text" name="id" value="<?=$row['id_role']?>">
                                                <input class="d-none" type="text" name="id_division" value="<?=$_GET['id']?>">

                                                <input autofocus type="text" class="inp-div" name="title" id="" value="<?=$row['role_name']?>">
                                        </td>
                                        <td class="text-right">
                                                <button name="saveRole" class="btn-save-division">
                                                    <canvas class="btn-saveDivision"></canvas>
                                                </button>

                                                <!-- <input type="submit" class="btn-save-user" name="saveRole" id="" value="Save"> -->
                                            </form>
                                        </td>

                                        <?php
                                        }else{
                                        ?>

                                            <td><?=$row['role_name']?></td>
                                            <td>
                                                <a class="btn-permission" href="?page=personalia&&elements=role&&id=<?=$row['id_division']?>&&editrole=<?=$row['id_role']?>"><canvas class="btn-editPermission"></canvas></a>
                                                <a class="btn-permissiondelete" href="" data-toggle="modal" data-target="#DeleteRole<?=$row['id_role']?>"><canvas class="btn-deletePermission"></canvas></a>
                                            </td>
                                        <?php
                                        }
                                        ?>
                                        </tr>
                                        <!-- Modal Delete-->
                                        <div class="modal fade" id="DeleteRole<?=$row['id_role']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <form action="process/input_data.php" method="post">
                                                        <div class="modal-header" style="border: 0;">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="text-align: -webkit-center;     padding-bottom: 80px;">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to delete permantly?</h5>
                                                            <p class="parText-modal">If you delete this element, all data related to it will be lost</p>
                                                            <input type="hidden" name="id" value="<?=$row['id_role']?>"><br>
                                                            <label class="lb-modalText" for=""><?=$row['role_name']?></label><br>
                                                            <label for="">Position</label><br>
                                                            <button name="deleterole" class="btn btn-primary btn-deleteDivision">Delete now</button>
                                                            <button type="button" class="btn btn-secondary btn-cancelModal" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        if(isset($_GET['id'])){
                                        ?>
                                        <tr>
                                            <td colspan="3">
                                                <form action="process/input_data.php" method="POST">
                                                    <input type="hidden" name="id" value="<?=$_GET['id']?>">
                                                    <input type="text" name="value" class="inp-div" placeholder="Insert here">
                                                    <input class="btn-addDiv" name="input_role" type="submit" value="Add Role">
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>                                
                            </div>
                            <?php
                            }elseif($_GET['page'] == 'Salary'){
                            ?>
                            <div class="content" style="margin-left: 20px;">
                                <label for="">Basic Fee</label>
                                <table class="table table-borderless">
                                    <thead class="tableHead">
                                        <tr>
                                            <th scope="col" class="th-title">Nominal</th>
                                            <th scope="col" class="th-title">Position</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        $query_role = mysqli_query($connect,"SELECT * FROM role WHERE basic_fee != '0'");
                                        while($row = mysqli_fetch_array($query_role)){
                                        ?>
                                        <tr>
                                        <?php
                                        error_reporting(0);
                                        if($row['id_role'] == $_GET['editrole']){
                                        ?>
                                        <td>
                                            <form class="float-left" action="process/input_data.php" method="POST">
                                                <input class="d-none" type="text" name="param" value="edit_role">
                                                <input class="d-none" type="text" name="id" value="<?=$row['id_role']?>">
                                                
                                                <input autofocus type="text" class="inp-div" name="basic" id="" value="<?=$row['basic_fee']?>">
                                        </td>
                                        <td>
                                                <select name="" id="">
                                                    <option value="<?=$row['role_name']?>" selected><?=$row['role_name']?></option>
                                                </select>
                                            <!-- <input readonly type="text" class="inp-div" name="title" id="" value="<?=$row['role_name']?>"> -->
                                        </td>
                                        <td class="text-right">
                                                <button name="savesalary" class="btn-save-division">
                                                    <canvas class="btn-saveDivision"></canvas>
                                                </button>

                                                <!-- <input type="submit" class="btn-save-user" name="saveRole" id="" value="Save"> -->
                                            </form>
                                        </td>

                                        <?php
                                        }else{
                                        ?>

                                            <td><?=$row['basic_fee']?></td>
                                            <td><?=$row['role_name']?></td>
                                            <td>
                                                <a class="btn-permission" href="?page=Salary&&editrole=<?=$row['id_role']?>"><canvas class="btn-editPermission"></canvas></a>
                                                <a class="btn-permissiondelete" href="" data-toggle="modal" data-target="#DeleteRole<?=$row['id_role']?>"><canvas class="btn-deletePermission"></canvas></a>
                                            </td>
                                        <?php
                                        }
                                        ?>
                                        </tr>
                                        <!-- Modal Delete-->
                                        <div class="modal fade" id="DeleteRole<?=$row['id_role']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <form action="process/input_data.php" method="post">
                                                        <div class="modal-header" style="border: 0;">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="text-align: -webkit-center;     padding-bottom: 80px;">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to delete permantly?</h5>
                                                            <p class="parText-modal">If you delete this element, all data related to it will be lost</p>
                                                            <input type="hidden" name="id" value="<?=$row['id_role']?>"><br>
                                                            <label class="lb-modalText" for=""><?=$row['role_name']?></label><br>
                                                            <label for="">Position</label><br>
                                                            <button name="deletebasic" class="btn btn-primary btn-deleteDivision">Delete now</button>
                                                            <button type="button" class="btn btn-secondary btn-cancelModal" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="1">
                                                <form action="process/input_data.php" method="POST">
                                                    <input type="hidden" name="id" value="<?=$_GET['id']?>">
                                                    <input type="text" name="value" class="inp-div" placeholder="Insert here">
                                                    
                                                
                                            </td>
                                            <td>
                                                <select name="role" id="">
                                                    <?php
                                                        $rsql = mysqli_query($connect,"SELECT * FROM role");
                                                        while($r = mysqli_fetch_array($rsql)){
                                                    ?>
                                                    <option value="<?=$r['id_role']?>"><?=$r['role_name']?></option>
                                                    <?php
                                                        }
                                                        ?>
                                                    <option value="" selected>role select</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input class="btn-addDiv" name="input_nom" type="submit" value="Add Nominal">
                                                </form>
                                            </td>
                                        </tr>
                                       
                                    </tbody>
                                </table>                                
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
    <!-- bootstrap CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- JAVASCRIPT ADD ROW -->

</body>
</html>