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
    <title>User Permission</title>

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
                            <a href="../personalia_page/?page=employee_list"> 
                                <canvas class="logo-personalia"></canvas>
                            </a>
                        </li>
    
                        <li class="" data-toggle="tooltip" data-placement="right" title="Salary" id="tool-newsletter">
                            <a href="../salary/">
                                <canvas class="logo-salary"></canvas>
                            </a>
                        </li>
    
                        <li class="active" data-toggle="tooltip" data-placement="right" title="User Permission" id="tool-team">
                            <a href="">
                                <canvas class="logo-user-active"></canvas>
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
                                <?php
                                error_reporting(0);
                                if($_GET['page']=='add'){        
                                ?>
                                <a class="linked-personalia" href="">
                                    User Permission  > <a href="index.php" style="color: #000; font-weight: 600;">User List ></a><a href="#" style="color: #000; font-weight: 600;">Add User</a>
                                </a><br>
                                <label for="" style="font-size: 25px; font-weight: 600;">Add User</label>

                                <?php
                                }else{
                                ?>
                                <a class="linked-personalia" href="">
                                    User Permission  > <a href="index.php" style="color: #000; font-weight: 600;">User List</a>
                                </a><br>
                                <label for="" style="font-size: 25px; font-weight: 600;">User List</label>
                                <?php
                                }
                                ?>
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
                        <?php
                        error_reporting(0);
                        if($_GET['page']=='add'){
                        ?>
                            <form action="process/input_data.php" method="post" enctype="multipart/form-data">
                                <input type="file"  style="display: none;" name="a" id="file" value="">
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
                                        <select name="division" id="" class="selectPerm">
                                            <?php
                                                $query_div = mysqli_query($connect,"SELECT * FROM division");
                                                while($r_div = mysqli_fetch_array($query_div)){
                                            ?>
                                                <option value="<?=$r_div['id_division']?>"><?=$r_div['division_name']?></option>
                                            <?php
                                                }
                                                ?>
                                        </select><br><br>
                                        <select name="role" id="" class="selectPerm">
                                            <?php
                                                $query_div = mysqli_query($connect,"SELECT * FROM role");
                                                while($r_div = mysqli_fetch_array($query_div)){
                                            ?>
                                                <option value="<?=$r_div['id_role']?>"><?=$r_div['role_name']?></option>
                                            <?php
                                                }
                                                ?>
                                        </select>
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
                                                    <td>: <input name="nama" type="text" class="form-biodata" value=""></td>
                                                </tr>
                                                <tr>
                                                    <td class="nametd"><p class="font-weight-bold text-body">Email</p></td>
                                                    <td>                                                    
                                                        :  <input name="email" type="text" class="form-biodata" value="<?=$r['email']?>">
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
                        }else{
                        ?>
                        <div class="shortcut-tools">
                            <div class="search">
                                <input type="text" onkeyup="searching()" placeholder="Search Name" id="searchInput">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16" style="color:5055BE;">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </div>
                            <div class="right-edit">
                                <a href="?page=add" style="background-color: #5055BE !important; padding: 4px 10px; font-size: 12px;" class="btn btn-primary">Add  User</a>
                            </div>
                        </div>
                        <div class="distance-content">
                            <div class="content" style="overflow: auto; height: 70vh;">
                                <table class="table table-borderless" id="tablePerm">
                                    <thead class="tableHead">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Password</th>
                                            <th scope="col">Level</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        error_reporting(0);
                                        $sql = mysqli_query($connect,"SELECT * FROM account");
                                        while($row = mysqli_fetch_array($sql)){
                                            if($_GET['edit'] == $row['id_account']) {
                                        ?>
                                        <form action="process/input_data.php" method="post">
                                        <tr class="editperm">
                                            <td>
                                                <input type="hidden" name="id" value="<?=$_GET['edit']?>">
                                                <?php
                                                $id_account = $row['id_account'];
                                                $query_acc = mysqli_query($connect,"SELECT * FROM employee WHERE id_account = '$id_account'");
                                                while($r = mysqli_fetch_array($query_acc)){
                                                ?>
                                                <input type="text" value="<?=$r['name']?>">
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td><input name="email" type="text" value="<?=$row['email']?>"></td>
                                            <td><input type="password" name="pass" id="" value="<?=$row['password']?>"></td>
                                            <td>
                                                <select name="role" id="">
                                                    <option selected value="<?=$row['access_role']?>"><?=$row['access_role']?></option>
                                                    <option selected value="User">User</option>
                                                    <option selected value="Admin">Admin</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button name="btn-Save" class="btn-save-division">
                                                    <canvas class="btn-saveDivision"></canvas>
                                                </button>
                                            </td>
                                        </tr>
                                        </form>
                                        <?php
                                            }else{
                                        ?>
                                        <tr>
                                            <td>
                                                <?php
                                                $id_account = $row['id_account'];
                                                $query_acc = mysqli_query($connect,"SELECT * FROM employee WHERE id_account = '$id_account'");
                                                while($r = mysqli_fetch_array($query_acc)){
                                                ?>
                                                <?=$r['name']?>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td><?=$row['email']?></td>
                                            <td><input class="pass-view-user" disabled type="password" name="" id="" value="<?=$row['password']?>"></td>
                                            <td><?=$row['access_role']?></td>
                                            <td>
                                                <a class="btn-permission" href="index.php?edit=<?=$row['id_account']?>"><canvas class="btn-editPermission"></canvas></a>
                                                <a class="btn-permissiondelete" data-toggle="modal" data-target="#modalDelete<?=$row['id_account']?>" href=""><canvas class="btn-deletePermission"></canvas></a>
                                                <!-- <a class="btn-permissionuser" href=""><canvas class="btn-userPermission"></canvas></a> -->
                                            </td>
                                        </tr>
                                        <!-- Modal Delete-->
                                        <div class="modal fade" id="modalDelete<?=$row['id_account']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <form action="process/input_data.php" method="post">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content" style="padding: 6% 9%;">
                                                    <div class=" titleModal">
                                                        <h5 class="h5modal" id="exampleModalCenterTitle">Are you Sure to Delete?</h5>
                                                        <label class="labelmodal" for="">you will delete data from this account</label>
                                                    </div>
                                                    <div class="modal-body bdyModal" style="    align-self: center;">
                                                        <input type="hidden" name="id" value="<?=$row['id_account']?>">
                                                        <h5 style="color: #5055BE; margin: 0; font-weight: 700;">
                                                            <?php
                                                            $id_account = $row['id_account'];
                                                            $query_acc = mysqli_query($connect,"SELECT * FROM employee WHERE id_account = '$id_account'");
                                                            while($r = mysqli_fetch_array($query_acc)){
                                                            ?>
                                                            <?=$r['name']?>
                                                            <?php
                                                            }
                                                            ?>
                                                        </h5>
                                                    </div>
                                                    <button name="btnModalDelete" class="btn btn-primary btnModalDelete">Delete</button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>                                
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
    <script src="js/app.js"></script>
    <!-- bootstrap CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        function searching() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("tablePerm");
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
</body>
</html>