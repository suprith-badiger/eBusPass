<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {

    $eid=$_GET['editid'];
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

    $query= "update tblpass set ProfileImage=:propic where ID=:eid";
    $query = $dbh->prepare($query);
     $query->bindParam(':propic',$propic,PDO::PARAM_STR);
     $query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();

echo '<script>alert("Profile pic has been updated")</script>';
  
}}
?>
<!DOCTYPE html>
<html>

<head>
    
    <title>Bus Pass Management System | Update Image</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    
        <link rel="stylesheet" href="includes/nav-bar.css"/>
        <link rel="stylesheet" href="includes/add-pass.css"/>
        <link rel="stylesheet" href="includes/cng-img.css"/>


</head>

<body>
    
      <?php include_once('includes/header.php');?>

      <section id="cng-img">
            
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


    <div class="row forms-row g-6">
      <div class="col-3">
        <label for="InputName" class="col-form-label">Full Name </label>
      </div>
      <div class="col-9">
      <input type="text" name="fullname" value="<?php  echo $row->FullName;?>" class="form-control" readonly='true' value="Disabled readonly input">
        </div>
    </div> 

    <div class="row forms-row g-6">
      <div class="col-3">
        <label for="InputName" class="col-form-label">Old Photo </label>
      </div>
      <div class="col-9 img-col">
        <img src="images/<?php echo $row->ProfileImage;?>" width="100" height="100" value="<?php  echo $row->ProfileImage;?>">
        </div>
    </div>
    
    <div class="row forms-row g-6">
      <div class="col-3">
        <label for="InputName" class="col-form-label">New Photo </label>
      </div>
      <div class="col-9 ">
        <input type="file" name="propic" class="form-control" accept="image/*">
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