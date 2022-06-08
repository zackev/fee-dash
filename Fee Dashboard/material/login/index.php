<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;700&family=Poppins:wght@100;300;600&display=swap" rel="stylesheet">
    
    <!-- View -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="../../src/css/style-user.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

</head>
<body class="bodyLogin">
    <div class="main">
        <div class="formLogin">
            <form action="process/auth_session.php" method="post">
            <p class="textLoginSign">Sign In</p>
            <h1 style="font-size: 30px;">Welcome to RRPayRoll</h1>
            <label class="loginDesc" for="" style="font-size: 12px;">Check your payroll data, cash bonds, and dependents<br> every month safely and comfortably.</label><br><br>
            <?php
            error_reporting(0);
                if($_GET['error'] == 'Login Failed'){
            ?>
            <label class="loginFailed" for="">Login Failed</label>
            <?php
                }else{
            ?>

            <?php
                }
            ?>
            <fieldset class="form-group border fieldsetlogin" >
                <legend class="w-auto px-2" style="font-size: 15px;">email</legend>
                <input type="text" name="email" class="" placeholder="Enter Email"><br>
            </fieldset>
            <fieldset class="form-group border fieldsetlogin" >
                <legend class="w-auto px-2" style="font-size: 15px;">password</legend>
                <input type="password" name="pass" class="" placeholder="Enter Password"><br>
            </fieldset>
            <button type="submit" class="btn btn-primary btnLogin">Login</button><br>
            <p class="pForgot" style="text-align: -webkit-center;">Forgot Password? *contact HRD</p>
        </form>
        </div>
        <div class="logintheme">
            <img class="img-rounded" style="inline-size: -webkit-fill-available;" src="../../src/img/Right_Login.jpg" alt="">
            <!-- <canvas class="right_login" width="304" height="236"></canvas> -->
            <!-- <canvas class="imageLogin"></canvas>
            <canvas class="textLogin"></canvas>
            <canvas class="imageLoginTarget"></canvas>
            <canvas class="imageLoginFile"></canvas> -->
        </div>
    </div>
</body>
</html>