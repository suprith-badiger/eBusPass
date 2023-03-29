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
$passnum=mt_rand(100000000, 999999999);
$propic=$_FILES["propic"]["name"];
$extension = substr($propic,strlen($propic)-4,strlen($propic));
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Profile Pics has Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{

$propic=md5($propic).time().$extension;
 move_uploaded_file($_FILES["propic"]["tmp_name"],"images/".$propic);
$sql="insert into tblpass(PassNumber,FullName,ProfileImage,ContactNumber,Email,IdentityType,IdentityCardno,Category,Source,Destination,FromDate,ToDate,Cost)values(:passnum,:fname,:propic,:cnum,:email,:itype,:icnum,:cat,:source,:des,:fdate,:tdate,:cost)";
$query=$dbh->prepare($sql);
$query->bindParam(':passnum',$passnum,PDO::PARAM_STR);
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
$query->bindParam(':propic',$propic,PDO::PARAM_STR);

 $query->execute();

   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Pass detail has been added.")</script>';
echo "<script>window.location.href ='add-pass.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  

}
}
?>

<!DOCTYPE html>
<html>

<head>
    
    <title>Bus Pass Management System | Add Pass</title>
    <!-- Core CSS - Include with every page -->
    <!-- <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
   <link href="assets/css/style.css" rel="stylesheet" />
      <link href="assets/css/main-style.css" rel="stylesheet" /> -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"/>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

      <link rel="stylesheet" href="includes/nav-bar.css"/>
      <!-- <link rel="stylesheet" href="includes/mngpass.css"/> -->
      <link rel="stylesheet" href="includes/add-pass.css"/>

      



</head>

<body>
    <section id="addPass">
    <?php include_once('includes/header.php');?>

      <form method="post" enctype="multipart/form-data">
    <div class="row forms-row g-6">
      <div class="col-3">
        <label for="InputName" class="col-form-label">Full Name   <i class="fa fa-asterisk"></i></label>
      </div>
      <div class="col-9">
        <input type="text" id="InputName" name="fullname" required="true" class="form-control" placeholder="Enter the name as per Aadhar card " value="">
        </div>
    </div>  
    
    <div class="row forms-row g-6">
    <div class="col-3">
        <label for="InputPhoto" class="col-form-label">Photo <i class="fa fa-asterisk"></i></label>
      </div>
      <div class="col-9">
        <input type="file" id="InputPhoto" name="propic" required="true" class="form-control" value="">
      </div>

    </div> 

    <div class="row forms-row g-6">
    <div class="col-3">
        <label for="InputContact" class="col-form-label">Contact Number <i class="fa fa-asterisk"></i></label>
      </div>
      <div class="col-9">
        <input type="text" id="InputContact" name="cnumber" required="true"   class="form-control" maxlength="10" pattern="[0-9]+" placeholder="Enter your phone number" value="">
      </div>
    </div> 

    <div class="row forms-row g-6">
    <div class="col-3">
        <label for="InputEmail" class="col-form-label">Email <i class="fa fa-asterisk"></i></label>
      </div>
      <div class="col-9">
        <input type="email" id="InputEmail" name="email" required="true" class="form-control" placeholder="Enter your email address" value="">
      </div>

    </div> 

    <div class="row forms-row g-6">
    <div class="col-3">
        <label for="InputID" class="col-form-label">Identiy type <i class="fa fa-asterisk"></i></label>
      </div>
      <div class="col-9">
        <select type="text" id="InputID" name="identitytype" required="true" class="form-control" value="">
        <option selected>Choose Identity Type</option>
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
        <label for="InputIDnum" class="col-form-label">ID Card number <i class="fa fa-asterisk"></i></label>
      </div>
      <div class="col-9">
        <input type="text" id="InputIDnum" name="icnum" required="true" class="form-control" placeholder="Enter your ID number" value="">
      </div>

    </div> 

    <div class="row forms-row g-6">
    <div class="col-3">
        <label for="InputCategory" class="col-form-label">Department <i class="fa fa-asterisk"></i></label></div>
      <div class="col-9">
        <select type="text" id="InputCategory" name="category" required="true" class="form-control" value="">
          <option selected>Select Department</option>
            <?php 

                $sql2 = "SELECT * from   tblcategory";
                $query2 = $dbh -> prepare($sql2);
                $query2->execute();
                $result2=$query2->fetchAll(PDO::FETCH_OBJ);

                foreach($result2 as $row)
                {          
                ?>  
                <option value="<?php echo htmlentities($row->CategoryName);?>"><?php echo htmlentities($row->CategoryName);?></option>
              <?php } 
            ?>
        </select>
      </div>

    </div>
    
    <div class="row forms-row g-6">
      
      <div class="col-3">
        <label for="InputCost" class="col-form-label">Amount <i class="fa fa-asterisk"></i></label>
      </div>
      <div class="col-9">
        <input type="text" id="InputCost" name="cost" required="true" class="form-control" placeholder="Enter the cost of BusPass" value="">
      </div>

    </div>


    <div class="row forms-row g-6">
    <div class="row">
        <div class="col-6">
          <div class="row">
          <div class="col-3">
            <label for="InputSource" class="col-form-label">From <i class="fa fa-asterisk"></i></label>
          </div>
          <div class="col-9">
            <input type="text" id="InputSource" name="source" required="true" class="form-control" value="">
          </div>        

          </div>
          
        </div>
        
        <div class="col-6">
          <div class="row">
            <div class="col-3">
              <label for="InputDestination" class="col-form-label">To <i class="fa fa-asterisk"></i></label>
            </div>
            <div class="col-9">
              <input type="text" id="InputDestination" name="destination" required="true" class="form-control" value="">
            </div>


          </div>
          
        </div>

        </div>
    </div> 

    <div class="row forms-row g-6">
    <div class="row">
        <div class="col-6">
          <div class="row">
          <div class="col-3">
            <label for="InputFromDate" class="col-form-label">Valid from <i class="fa fa-asterisk"></i></label>
          </div>
          <div class="col-9">
            <input type="date" id="InputFromDate" name="fromdate" required="true" class="form-control" value="">
          </div>        

          </div>
          
        </div>
        
        <div class="col-6">
          <div class="row">
            <div class="col-3">
              <label for="InputToDate" class="col-form-label">Valid till<i class="fa fa-asterisk"></i></label>
            </div>
            <div class="col-9">
              <input type="date" id="InputToDate" name="todate" required="true" class="form-control" value="">
            </div>


          </div>
          
        </div>

        </div>
        </div>

    


    <p style="padding-left: 450px"><button type="submit" class="btn btn-lg btn-success" name="submit" id="submit">Submit</button>
    </p> 
 
</form>

    

</section>
        


 
















<!-- 
<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Pass</h1>
            </div>
        </div>
          <form method="post" enctype="multipart/form-data"> 
                                
<div class="form-group"> <label for="exampleInputEmail1">Full Name</label> <input type="text" name="fullname" value="" class="form-control" required='true'> </div>
<div class="form-group"> <label for="exampleInputEmail1">Profile Image</label> <input type="file" name="propic" value="" class="form-control" required='true'> </div>
<div class="form-group"> <label for="exampleInputEmail1">Contact Number</label> <input type="text" name="cnumber" value="" class="form-control" required='true' maxlength="10" pattern="[0-9]+"> </div>
<div class="form-group"> <label for="exampleInputEmail1">Email Address</label> <input type="email" name="email" value="" class="form-control" required='true'> </div>
<div class="form-group"> <label for="exampleInputEmail1">Identity Type</label>
<select type="text" name="identitytype" value="" class="form-control" required='true'>
<option selected>Choose Identity Type</option>
<option value="Voter Card">Voter Card</option>
<option value="PAN Card">PAN Card</option>
<option value="Adhar Card">Adhar Card</option>
<option value="Student Card">Student Card</option>
<option value="Driving License">Driving License</option>
<option value="Passport">Passport</option>
<option value="Any Official Card">Any Official Card</option>
<option value="Any Other Govt Issued Doc">Any Other Govt Issued Doc</option>
 </select></div>
<div class="form-group"> <label for="exampleInputEmail1">Identity Card No.</label> <input type="text" name="icnum" value="" class="form-control" required='true'> 
    </div>
 <div class="form-group"> <label for="exampleInputEmail1">Category</label>
 <select type="text" name="category" value="" class="form-control" required='true'>
 <option selected>select Category</option>
 <?php 

$sql2 = "SELECT * from   tblcategory";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row)
{          
?>  
<option value="<?php echo htmlentities($row->CategoryName);?>"><?php echo htmlentities($row->CategoryName);?></option>
<?php } ?>
 </select>
</div>
<div class="form-group"> <label for="exampleInputEmail1">Source</label> <input type="text" name="source" value="" class="form-control" required='true'> </div>
<div class="form-group"> <label for="exampleInputEmail1">Destination</label> <input type="text" name="destination" value="" class="form-control" required='true'> </div>
<div class="form-group"> <label for="exampleInputEmail1">From Date</label> <input type="date" name="fromdate" value="" class="form-control" required='true'> </div>
<div class="form-group"> <label for="exampleInputEmail1">To Date</label> <input type="date" name="todate" value="" class="form-control" required='true'> </div>
<div class="form-group"> <label for="exampleInputEmail1">Cost</label> <input type="text" name="cost" value="" class="form-control" required='true'> </div>
 <p style="padding-left: 450px"><button type="submit" class="btn btn-primary" name="submit" id="submit">Add</button></p> </form>
   -->

    
      
    

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