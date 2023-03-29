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
   
    <title>Bus Pass Management System | Search Pass</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />

    <link rel="stylesheet" href="includes/nav-bar.css"/>
    <link rel="stylesheet" href="includes/search-pass.css"/>
    <link rel="stylesheet" href="includes/add-pass.css"/>
</head>

<body>
   
       <?php include_once('includes/header.php');?>
       <section id="search-pass">

       <div class="card">
  <div class="card-body">
   
  <form method="post">
       <div class="row forms-row g-6">
      <div class="col-3">
        <label for="searchdata" class="col-form-label">Search </label>
      </div>
      <div class="col-9">
        <input id="searchdata" type="text" name="searchdata" required="true" class="form-control" aria-describedby="searchHelp" value="">
        <div id="searchHelp" class="form-text">Search by Pass Number / Contact No.</div>
        </div>
      </div>
      
      <button type="submit" class="btn btn-primary" name="search" id="submit">Find</button>
        </form>
  </div>
</div>

<?php
if(isset($_POST['search']))
{ 

$sdata=$_POST['searchdata'];
?>


<div class="card">
  <div class="card-body">
  <h5 text-align="center">Results for "<?php echo $sdata;?>" keyword </h5>
                                <table class="styled-table">
                                    <thead>
                                        <tr>
                                            <th>S.NO</th>
                                            <th>Pass Number</th>
                                            <th>Full Name</th>
                                            <th>Contact Number</th>
                                            <th>Creation Date</th>
                                            <th>Valid till</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$sql="SELECT * from tblpass where PassNumber like '$sdata%'|| ContactNumber like '$sdata%'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               
?>
               <tr>
                  <td><?php  echo htmlentities($cnt);?></td>
                  <td><?php  echo htmlentities($row->PassNumber);?></td>
                  <td><?php  echo htmlentities($row->FullName);?></td>
                  <td><?php  echo htmlentities($row->ContactNumber);?></td>
                  <td><?php  echo htmlentities($row->PasscreationDate);?></td>
                  <td><?php  echo htmlentities($row->ToDate);?></td>
                  <td><a href="view-pass-detail.php?viewid=<?php echo htmlentities ($row->ID);?>"><img class="images" src="includes/images/eye (1).png "></a> 
                   <a href="edit-pass-detail.php?editid=<?php echo htmlentities ($row->ID);?>"><img class="images" src="includes/images/edit (2).png "></a>
                </td>
                </tr>
               <?php 
$cnt=$cnt+1;
} } else { ?>
  <tr>
    <td colspan="12">No record found against this search :(</td>

  </tr>
   
<?php } }?> 
                                       
                                        
                        </tbody>
                </table>

    
  </div>
</div>





 
</section>
            

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous">
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