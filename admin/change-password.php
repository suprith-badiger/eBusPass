<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
error_reporting(0);
if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $adminid = $_SESSION['bpmsaid'];
        $cpassword = md5($_POST['currentpassword']);
        $newpassword = md5($_POST['newpassword']);
        $sql = "SELECT ID FROM tbladmin WHERE ID=:adminid and Password=:cpassword";
        $query = $dbh->prepare($sql);
        $query->bindParam(':adminid', $adminid, PDO::PARAM_STR);
        $query->bindParam(':cpassword', $cpassword, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            $con = "update tbladmin set Password=:newpassword where ID=:adminid";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1->bindParam(':adminid', $adminid, PDO::PARAM_STR);
            $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();

            echo '<script>alert("Your password successully changed")</script>';
            echo "<script>window.location.href ='change-password.php'</script>";
        } else {
            echo '<script>alert("Your current password is wrong")</script>';

        }
    }
    ?>
    <!DOCTYPE html>
    <html>

    <head>

        <title>Bus Pass Management System | Change Password</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />

        <link rel="stylesheet" href="includes/nav-bar.css">
        <link rel="stylesheet" href="includes/cng-pass.css"/>

        <script type="text/javascript">
            function checkpass() {
                if (document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
                    alert('New Password and Confirm Password field does not match');
                    document.changepassword.confirmpassword.focus();
                    return false;
                }
                return true;
            }

        </script>

    </head>

    <body>
        <?php include_once('includes/header.php'); ?>
        <section id="cng-password">

        <div class="card">
  <div class="card-body">

        <form name="changepassword" method="post" onsubmit="return checkpass();" action="">

<div class="row forms-row g-6">
<div class="col-3">
<label for="InputName" class="col-form-label">Current Password</label>
</div>
<div class="col-9">
<input type="password"  name="currentpassword" id="currentpassword" required="true" class="form-control" placeholder="Enter the current password" value="">
</div>
</div>  


<div class="row forms-row g-6">
<div class="col-3">
<label for="InputName" class="col-form-label">New Password</label>
</div>
<div class="col-9">
<input type="password" name="newpassword" required="true" class="form-control" placeholder="Enter the new password" value="">
</div>
</div>  


<div class="row forms-row g-6">
<div class="col-3">
<label for="InputName" class="col-form-label">Confirm Password</label>
</div>
<div class="col-9">
<input type="password" name="confirmpassword" id="confirmpassword"  required="true" class="form-control" placeholder="Enter the same password to confirm " value="">
</div>
</div>  

<p style="padding-left: 450px"><button type="submit" class="btn btn-primary" name="submit"
                    id="submit">Change</button>
</p>

</form>

</div>


        </section>



   
                

                    
               


    


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>


    </body>

    </html>
<?php } ?>