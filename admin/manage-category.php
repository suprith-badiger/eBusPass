<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
} else {

    // Code for deleting product from cart
    if (isset($_GET['delid'])) {
        $rid = intval($_GET['delid']);
        $sql = "delete from tblcategory where ID=:rid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rid', $rid, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('Data deleted');</script>";
        echo "<script>window.location.href = 'manage-category.php'</script>";


    }

    ?>
<!DOCTYPE html>
<html>

<head>
   
    <title>Bus Pass Management System | Manage Category</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />

   
    <link rel="stylesheet" href="includes/nav-bar.css">
    <link rel="stylesheet" href="includes/manage-cat.css">
    <link rel="stylesheet" href="includes/add-pass.css"/>

</head>

<body>
    
       <?php include_once('includes/header.php'); ?>
      

<section id="dept">
 
    <div class="card-deck container-fluid">
        <div class="row">
            <?php
            $sql = "SELECT * from tblcategory";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);

            $cnt = 1;
            if ($query->rowCount() > 0) {
                foreach ($results as $row) {
                    ?>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card cat-card">
                    <img class="card-img-top cat-card-img-top" src="images/<?php echo ($row->DeptLogo); ?>" alt="Dept. logo">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlentities($row->CategoryName); ?></h5>
                        <div class="row logo-img">
                            <div class="col">
                                <a  class="cat-anchortag" href="edit-category-detail.php?editid=<?php echo htmlentities($row->ID); ?>" role="button">
                                    Edit<img class="action-img" src="includes/images/writing.png" alt="">
                                </a>
                            </div>
                            <div class="col">
                                <a class="cat-anchortag" href="manage-category.php?delid=<?php echo ($row->ID); ?>" role="button" onclick="return confirm('Do you really want to Delete ?');">
                                    Remove<img class="action-img" src="includes/images/trash (1).png" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Creation Date : <?php echo htmlentities($row->CreationDate); ?></small>
                    </div>
                </div>
            </div>
                
<?php $cnt = $cnt + 1;
                }
            }
            ?> 

</div>
<?php

        if (strlen($_SESSION['bpmsaid'] == 0)) {
            header('location:logout.php');
        } else {
            if (isset($_POST['submit'])) {


                $catname = $_POST['catname'];
                $propic = $_FILES["propic"]["name"];
                $extension = substr($propic, strlen($propic) - 4, strlen($propic));
                $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");



                $ret = "select CategoryName, DeptLogo from tblcategory where CategoryName=:catname";
                $query = $dbh->prepare($ret);
                $query->bindParam(':catname', $catname, PDO::PARAM_STR);

                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() == 0) {
                    if (!in_array($extension, $allowed_extensions)) {
                        echo "<script>alert('Profile Pics has Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
                    } else {

                        $propic = md5($propic) . time() . $extension;
                        move_uploaded_file($_FILES["propic"]["tmp_name"], "images/" . $propic);
                        $sql = "insert into tblcategory(CategoryName, DeptLogo) values(:catname ,:propic)";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':catname', $catname, PDO::PARAM_STR);
                        $query->bindParam(':propic', $propic, PDO::PARAM_STR);

                        $query->execute();

                        $LastInsertId = $dbh->lastInsertId();
                        if ($LastInsertId > 0) {
                            echo '<script>alert("Category has been added.")</script>';
                            echo "<script>window.location.href ='manage-category.php'</script>";
                        } else {
                            echo '<script>alert("Something Went Wrong. Please try again")</script>';
                        }


                    }
                } else {

                    echo "<script>alert('Category Name Already Exist. Please try again');</script>";
                }
            }

            ?>
<div class="addbutton" >
    <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Add
    </button>
</div>
<div class="modal-dialog modal-dialog-centered">
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add new category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <div class="card">
            <div class="row">
                <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    
                                <form method="post" enctype="multipart/form-data"> 

                                <div class="row forms-row g-6">
                                    <div class="col-3">
                                        <label for="InputName" class="col-form-label">Name</label>
                                    </div>
                                    <div class="col-9 ">
                                        <input type="text" name="catname" value="" class="form-control" required='true'> 
                                    </div>
                                </div>

                                <div class="row forms-row g-6">
                                    <div class="col-3">
                                        <label for="InputName" class="col-form-label">Logo</label>
                                    </div>
                                    <div class="col-9 ">
                                        <input type="file" name="propic" value="" class="form-control" required='true'> 
                                    </div>
                                </div>

                                    
            <!-- <div class="form-group"> 
                <label for="exampleInputEmail1">DEPARTMET NAME</label> <input type="text" name="catname" value="" class="form-control" required='true'> 
            <div class="form-group"> <label for="exampleInputEmail1">DEPARTMET LOGO</label> <input type="file" name="propic" value="" class="form-control" required='true'> </div>
        </div> -->
        <div class="modal-footer">
      <p style="padding-left: 45px"><button type="submit" class="btn btn-primary" name="submit" id="submit">Add</button></p>
      </div>
   
     
         </form>
                        </div>
                                
                    </div>
                </div>
            </div>
         </div> 
        



      </div>
     
    </div>
  </div>
</div>
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
<?php
                }
        }
            
?>