<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {


 $catname=$_POST['catname'];

$eid=$_GET['editid'];
$ret="select CategoryName from tblcategory where CategoryName=:catname";
 $query= $dbh -> prepare($ret);
$query->bindParam(':catname',$catname,PDO::PARAM_STR);

$query-> execute();
     $results = $query -> fetchAll(PDO::FETCH_OBJ);
     if($query -> rowCount() == 0)
{
$sql="update tblcategory set CategoryName=:catname where ID=:eid";
$query=$dbh->prepare($sql);
$query->bindParam(':catname',$catname,PDO::PARAM_STR);

$query->bindParam(':eid',$eid,PDO::PARAM_STR);

 $query->execute();

   echo '<script>alert("Category name has been updated")</script>';
  
}
else
{

echo "<script>alert('Category Name Already Exist. Please try again');</script>";
}
}
?>

<!DOCTYPE html>
<html>

<head>
    
    <title>Bus Pass Management System | Update Category</title>
    <!-- Core CSS - Include with every page -->
    <!-- <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
   <link href="assets/css/style.css" rel="stylesheet" />
      <link href="assets/css/main-style.css" rel="stylesheet" /> -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
        
    <link rel="stylesheet" href="includes/nav-bar.css">
    <link rel="stylesheet" href="includes/edit-cat.css">



</head>

<body>
  
    
      <?php include_once('includes/header.php');?>

      <section id="edit-cat">
      <div class="card card-bg">
        <div class="card-header">
            Edit Department Name
        </div>
        <div class="card-body">
        <form method="post" enctype="multipart/form-data"> 
                                      <?php
$eid=$_GET['editid'];
$sql="SELECT * from  tblcategory where ID=$eid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                    
    <div class="form-group"> <label for="exampleInputEmail1">Category Name</label> <input type="text" name="catname" value="<?php  echo $row->CategoryName;?>" class="form-control" required='true'> </div>
   
     <?php $cnt=$cnt+1;}} ?> 
     
    
   
            
            
        </div>
        <div class="card-footer text-muted">
        <p style="padding-left: 37px"><button type="submit" class="btn btn-primary" name="submit" id="submit">Update</button></p> 
            
        </div>
      </div>

      </form>

      </section>

     


                                    
    
     

        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous">
    </script>

    <!-- <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script> -->

</body>

</html>
<?php }  ?>