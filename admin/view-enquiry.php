<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
 $vid=$_GET['viewid'];
$isread=1;
$sql="update tblcontact set IsRead=:isread where ID=:vid";
$query=$dbh->prepare($sql);
$query->bindParam(':isread',$isread,PDO::PARAM_STR);
$query->bindParam(':vid',$vid,PDO::PARAM_STR);
$query->execute();

  ?>
<!DOCTYPE html>
<html>

<head>
   
    <title>Bus Pass Management System | View Enquiry Detail</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
        
        <link rel="stylesheet" href="includes/nav-bar.css"/>
        <link rel="stylesheet" href="includes/view-enq.css"/>

</head>

<body>
    
   <?php include_once('includes/header.php');?>

   <section id="view-enq">
   <?php

$sql="SELECT * from  tblcontact where ID=$vid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
   

    <h3>View Message</h3>

  <div class="card card-bg">
  <h5 class="card-header">Email :   <?php  echo ($row->Email);?></h5>
  <div class="card-body">
    <h5 class="card-title">Name :   <?php  echo ($row->Name);?></h5>
    <p class="card-text"><?php  echo ($row->Message);?></p>
  </div>
</div>
<?php $cnt=$cnt+1;}} ?>
    
 </section>

        
         
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>

    <script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>

</body>

</html>
<?php }  ?>