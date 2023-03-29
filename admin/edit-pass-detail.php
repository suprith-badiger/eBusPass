<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {


 $fname=$_POST['fullname'];
$cnum=$_POST['cnumber'];
$email=$_POST['email'];
$itype=$_POST['identitytype'];
$icnum=$_POST['icnum'];
$cat=$_POST['category'];
$source=$_POST['source'];
$des=$_POST['destination'];
$fdate=$_POST['fromdate'];
$tdate=$_POST['todate'];
$cost=$_POST['cost'];
$eid=$_GET['editid'];
$sql="update tblpass set FullName=:fname,ContactNumber=:cnum,Email=:email,IdentityType=:itype,IdentityCardno=:icnum,Category=:cat,Source=:source,Destination=:des,FromDate=:fdate,ToDate=:tdate, Cost=:cost where ID=:eid";
$query=$dbh->prepare($sql);

$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':cnum',$cnum,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':itype',$itype,PDO::PARAM_STR);
$query->bindParam(':icnum',$icnum,PDO::PARAM_STR);
$query->bindParam(':cat',$cat,PDO::PARAM_STR);
$query->bindParam(':source',$source,PDO::PARAM_STR);
$query->bindParam(':des',$des,PDO::PARAM_STR);
$query->bindParam(':fdate',$fdate,PDO::PARAM_STR);
$query->bindParam(':tdate',$tdate,PDO::PARAM_STR);
$query->bindParam(':cost',$cost,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
 $query->execute();

  
         echo '<script>alert("Pass Detail has been updated")</script>';

}
?>

<!DOCTYPE html>
<html>

<head>
    
    <title>Bus Pass Management System | Edit Pass</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    
        <link rel="stylesheet" href="includes/nav-bar.css"/>
        <link rel="stylesheet" href="includes/add-pass.css"/>
        <link rel="stylesheet" href="includes/edit-pass.css"/>



</head>

<body>
      <?php include_once('includes/header.php');?>

      <section id="edit-pass">
      <form method="post" enctype="multipart/form-data"> 
                                    <?php
$eid=$_GET['editid'];
$sql="SELECT * from  tblpass where ID=$eid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?> 
  <h2 colspan="6">
 Pass ID: <?php  echo ($row->PassNumber);?></h2>

<div class="row forms-row g-6">
    <div class="col-3">
        <label for="InputName" class="col-form-label">Full Name</label>
    </div>
    <div class="col-9">
        <input type="text" name="fullname" value="<?php  echo $row->FullName;?>" class="form-control" required='true'>
    </div>
</div>

<div class="row forms-row g-6">
    <div class="col-3">
    <label for="InputPhoto" class="col-form-label">Photo</label> 
    </div>
    <div class="col-9 image-col">
    <img src="images/<?php echo $row->ProfileImage;?>" width="50" height="50" value="<?php  echo $row->ProfileImage;?>">
    <a class="anchor-tag" href="changeimage.php?editid=<?php echo $row->ID;?>"> &nbsp; Edit Image</a> 
    </div>
</div>

<div class="row forms-row g-6">
    <div class="col-3">
        <label for="InputPhone" class="col-form-label">Contact Number</label>
    </div>
    <div class="col-9">
        <input type="text" name="cnumber" value="<?php  echo $row->ContactNumber;?>" class="form-control" required='true' maxlength="10" pattern="[0-9]+">
    </div>
</div>

<div class="row forms-row g-6">
    <div class="col-3">
        <label for="InputEmail" class="col-form-label">Email id</label>
    </div>
    <div class="col-9">
        <input type="email" name="email" value="<?php  echo $row->Email;?>" class="form-control" required='true'>
    </div>
</div>

<div class="row forms-row g-6">
    <div class="col-3">
        <label for="InputIdentity" class="col-form-label">Identity type</label>
    </div>
    <div class="col-9">
    <select type="text" name="identitytype" value="" class="form-control" required='true'>
        <option value="<?php  echo $row->IdentityType;?>"><?php  echo $row->IdentityType;?></option>
        <option value="Voter Card">Voter Card</option>
        <option value="PAN Card">PAN Card</option>
        <option value="Adhar Card">Adhar Card</option>
        <option value="Student Card">Student Card</option>
        <option value="Driving License">Driving License</option>
        <option value="Passport">Passport</option>
        <option value="Any Official Card">Any Official Card</option>
        <option value="Any Other Govt Issued Doc">Any Other Govt Issued Doc</option>
     </select>
    </div>
</div>

<div class="row forms-row g-6">
    <div class="col-3">
        <label for="InputName" class="col-form-label">Identity Card No.</label>
    </div>
    <div class="col-9">
        <input type="text" name="icnum" value="<?php  echo $row->IdentityCardno;?>" class="form-control" required='true'> 
    </div>
</div>

<div class="row forms-row g-6">
    <div class="col-3">
        <label for="InputName" class="col-form-label">Category</label>
    </div>
    <div class="col-9">
    <select type="text" name="category" value="" class="form-control" required='true'>
      <option value="<?php  echo $row->Category;?>"><?php  echo $row->Category;?></option>
<?php 

$sql2 = "SELECT * from   tblcategory";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row2)
{          
    ?>  
<option value="<?php echo htmlentities($row2->CategoryName);?>"><?php echo htmlentities($row2->CategoryName);?></option>
 <?php } ?>
     </select>
    </div>
</div>


<div class="row forms-row g-6">
    <div class="col-3">
        <label for="InputFromDate" class="col-form-label">From Date</label>
    </div>
    <div class="col-9">
        <input type="date" name="fromdate" value="<?php  echo $row->FromDate;?>" class="form-control" required='true'> 
    </div>
</div>

<div class="row forms-row g-6">
    <div class="col-3">
        <label for="InputToDate" class="col-form-label">To Date</label>
    </div>
    <div class="col-9">
        <input type="date" name="todate" value="<?php  echo $row->ToDate;?>" class="form-control" required='true'>  
    </div>
</div>

<div class="row forms-row g-6">
    <div class="col-3">
        <label for="InputCost" class="col-form-label">Cost</label>
    </div>
    <div class="col-9">
        <input type="text" name="cost" value="<?php  echo $row->Cost;?>" class="form-control" required='true'>  
    </div>
</div>

<div class="row forms-row g-6">
    <div class="col-3">
        <label for="InputPhone" class="col-form-label">Pass creation Date</label>
    </div>
    <div class="col-9">
        <input type="text" value="<?php  echo $row->PasscreationDate;?>" class="form-control" readonly='true'> 
    </div>
</div>



<?php $cnt=$cnt+1;}} ?> 
     <p style="padding-left: 450px"><button type="submit" class="btn btn-primary" name="submit" id="submit">Update</button></p> 
    
    </form>


      </section>
    
            
                                  
                            
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous">
    </script>
</body>

</html>
<?php }  ?>