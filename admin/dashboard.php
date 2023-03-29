<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
    
?>
  
<!DOCTYPE html>
<html>

<head>
    <title>Bus Pass Management System | Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    
        <link rel="stylesheet" href="includes/nav-bar.css"/>
    <link rel="stylesheet" href="includes/dashB.css"/>

    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(nicEditors.allTextAreas);
    </script>
</head>

<body>
<?php include_once('includes/header.php');?>

<section id="stats">
        <div class="row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <a class="anchor-tag" href="manage-category.php" role="button">
                    <div class="card">
                            <?php 
                                $sql ="SELECT ID from tblcategory ";
                                $query = $dbh ->
                                prepare($sql); $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                $totalcat=$query->rowCount(); 
                            ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="includes/images/category.png" class="card-img-top dashboard-img" alt="..." />
                            </div>
                            <div class="col-sm-6">
                                <h1 class="numbers"><?php echo htmlentities($totalcat);?></h1>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 style="font-weight: 500; font-size: 30px" class="card-title">
                                CATEGORY
                            </h5>
                            <p class="card-text">
                                Number of categories available for Bus Pass
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6">
                <a href="manage-pass.php" class="anchor-tag" role="button">
                    <div class="card">
                    <?php 
                                    $sql ="SELECT ID from tblpass";
                                    $query = $dbh ->prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $totalpass=$query->rowCount(); 
                                ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="includes/images/immigration.png" class="card-img-top dashboard-img" alt="..." />
                            </div>
                            <div class="col-sm-6">
                                <h1 class="numbers"><?php echo htmlentities($totalpass);?></h1>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 style="font-weight: 500; font-size: 30px" class="card-title">
                                TOTAL PASS
                            </h5>
                            <p class="card-text">Number of Bus Pass distributed till now</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
                <a href="todays-pass.php" class="anchor-tag" role="buttton">
                    <div class="card">
                    <?php                                 
                                    $sql ="SELECT ID from tblpass where date(PasscreationDate)=CURDATE()";
                                    $query = $dbh ->
                                    prepare($sql); $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $today_pass=$query->rowCount(); 
                                ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="includes/images/calendar.png" class="card-img-top dashboard-img" alt="..." />
                            </div>
                            <div class="col-sm-6">
                                <h1 class="numbers"><?php echo htmlentities($today_pass);?></h1>
                            </div>
                        </div>
                        <div class="card-body">
                                
                            <h5 style="font-weight: 500; font-size: 30px" class="card-title">
                                TODAY
                            </h5>
                            <p class="card-text">Number of Bus Pass created Today</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6">
                <a href="last-7days-pass.php" class="anchor-tag" role="button">
                    <div class="card">
                    <?php 
                                    $sql ="SELECT ID from tblpass where date(PasscreationDate)>=(DATE(NOW()) -
                                    INTERVAL 7 DAY)"; $query = $dbh -> prepare($sql);
                                    $query->execute(); $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $seven_pass=$query->rowCount();
                                ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="includes/images/7-days.png" class="card-img-top dashboard-img" alt="..." />
                            </div>
                            <div class="col-sm-6">
                                <h1 class="numbers"> <?php echo htmlentities($seven_pass);?></h1>
                            </div>
                        </div>
                        <div class="card-body">
                                
                            <h5 style="font-weight: 500; font-size: 30px" class="card-title">
                                LAST 7 DAYS
                            </h5>
                            <p class="card-text">
                                Number of Bus Pass created in last 7 days
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>






    <!-- Core Scripts - Include with every page -->
    <!-- <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous">
    </script>
</body>

</html>

<?php }  ?>