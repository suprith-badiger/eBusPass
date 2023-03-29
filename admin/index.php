<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login'])) 
  {
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $sql ="SELECT ID FROM tbladmin WHERE UserName=:username and Password=:password";
    $query=$dbh->prepare($sql);
    $query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
{
foreach ($results as $result) {
$_SESSION['bpmsaid']=$result->ID;
}

  if(!empty($_POST["remember"])) {
//COOKIES for username
setcookie ("user_login",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
//COOKIES for password
setcookie ("userpassword",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
} else {
if(isset($_COOKIE["user_login"])) {
setcookie ("user_login","");
if(isset($_COOKIE["userpassword"])) {
setcookie ("userpassword","");
        }
      }
}
$_SESSION['login']=$_POST['username'];
echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
} else{
echo "<script>alert('Invalid Details');</script>";
}
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;800&family=Ubuntu&display=swap"
        rel="stylesheet" />

    <!-- Bootstrap CSS stylesheets -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link rel="stylesheet" href="includes/loginStyle.css" />

    <!-- Font Awesome logo -->
    <script src="https://kit.fontawesome.com/6978f47505.js" crossorigin="anonymous"></script>

    <!-- bootstrap scripts -->
</head>
<body>
    <section id="login">
        <div class="container-fluid ms-auto">
            <div class="row">
                <div class="col-lg-6">
                    <img src="images\Mobile login-rafiki.png" width="90%" height="95%" alt="login-page" />
                </div>
                <div class="login-form1 col-lg-6">
                    <h2><i class="fa-regular fa-id-card"></i>Well come</h2>
                <form role="form" method="post" name="login">
                    <div class="login-form form-floating mb-3">
                        <input type="text" class="form-control"  required="true" name="username" value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>">
                        <!-- <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" /> -->
                        <label for="floatingInput">Username</label>
                    </div>
                    <div class="login-form form-floating">
                        <!-- <input type="password" class="form-control" id="floatingPassword" placeholder="Password" /> -->
                        <input type="password" class="form-control" name="password" required="true" value="<?php if(isset($_COOKIE["userpassword"])) { echo $_COOKIE["userpassword"]; } ?>">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 login-checkbox mb-3 form-check">
                            <!-- <input type="checkbox" class="form-check-input" id="exampleCheck1" /> -->
                            <input type="checkbox" id="remember" name="remember" <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?> />
                            <label class="form-check-label" for="exampleCheck1">Remember me</label>
                        </div>

                        <div class="col-lg-6" style="padding-top: 10px;">
                            <!-- <a class="forgot-password-link" href="forgot-password.php">Forgot password ?</a> -->
                        </div>
                    </div>
                    <div class="d-grid gap-2" style="text-align: center">
                        <!-- <a class="btn btn-md btn-primary btn-outline-light login-btn" href="" role="button">
                            <i class="login-icons fa-solid fa-user"></i>Sign in</a> -->

                            <input type="submit" value="Login" class="btn btn-md btn-primary btn-outline-light login-btn" name="login" >
                

                        <a class="btn btn-md btn-primary btn-outline-light login-btn" href="../index.php" role="button">
                            <i class="login-icons-home fa-solid fa-house"></i>Home</a>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </section>


         <!-- Core Scripts - Include with every page -->
         <script src="assets/plugins/jquery-1.10.2.js"></script>
         <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
         <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>

         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>
</html>