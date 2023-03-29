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
   
    <title>Bus Pass Management System | Pass Report Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
        <link rel="stylesheet" href="includes/nav-bar.css">
        <link rel="stylesheet" href="includes/mngpass.css">

</head>

<body>
   
       <?php include_once('includes/header.php');?>
       <section id="passreport">
       <?php
$fdate=$_POST['fromdate'];
$tdate=$_POST['todate'];

?>

<div class="card">
  <div class="card-body">
<h4 text-align="center" style="color:rgb(51, 51, 51)">Pass Report from <?php echo $fdate?> to <?php echo $tdate?></h4>
                                <table class="styled-table">
                                    <thead>
                                       <tr>
                                            <th>S.NO</th>
                                           <th>Pass Number</th>
                                            <th>Full Name</th>
                                            <th>Contact Number</th>
                                            <th>Email</th>
                                            <th>Creation Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$sql="SELECT * from tblpass where date(PasscreationDate) between '$fdate' and '$tdate'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                <tr>
                  <td><?php echo htmlentities($cnt);?></td>
                  <td><?php  echo htmlentities($row->PassNumber);?></td>
                  <td><?php  echo htmlentities($row->FullName);?></td>
                  <td><?php  echo htmlentities($row->ContactNumber);?></td>
                  <td><?php  echo htmlentities($row->Email);?></td>
                  <td><?php  echo htmlentities($row->PasscreationDate);?></td>
                  <td>
                    <a href="view-pass-detail.php?viewid=<?php echo htmlentities ($row->ID);?>"><img class="images" src="includes/images/eye (1).png "></a> 
                    <a href="edit-pass-detail.php?editid=<?php echo htmlentities ($row->ID);?>"><img class="images" src="includes/images/edit (2).png "></a></td>
                </tr>
                 <?php 
$cnt=$cnt+1;
} } else { ?>
  <tr>
    <td colspan="12"> No record found against between this date</td>

  </tr>
   
<?php } ?> 
                                       
                                        
                                    </tbody>
                                </table>
                                </div>

       
       </section>
       
   
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>

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