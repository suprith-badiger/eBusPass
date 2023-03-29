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
   
    <title>Bus Pass Management System | Read Enquiry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
        
        <link rel="stylesheet" href="includes/nav-bar.css"/>
        <link rel="stylesheet" href="includes/read-enq.css"/>


</head>

<body>
    
       <?php include_once('includes/header.php');?>
       <section id="read-enq">
       
                    
    <table class="styled-table">
    <thead>
        <tr>
            <th>S No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Enquiry Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
$sql="SELECT * from tblcontact where IsRead='1'";
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
                                        <td><?php  echo htmlentities($row->Name);?></td>
                                        <td><?php  echo htmlentities($row->Email);?></td>
                                        <td>
                                        <span class="badge rounded-pill text-bg-light"><?php  echo htmlentities($row->EnquiryDate);?></span>
                                        </td>
                                        <td>
                                            <a class="anchor-tag" href="view-enquiry.php?viewid=<?php echo htmlentities ($row->ID);?>">View Details</a>
                                        </td>
                  </tr>
               <?php $cnt=$cnt+1;}} ?>  
    </tbody>
</table>

</section>
                    




          
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>

    <!-- Page-Level Plugin Scripts-->
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