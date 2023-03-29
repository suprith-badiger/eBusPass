<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
    
?>

<!DOCTYPE html>
<html></html>

<head>
    
    <title>Bus Pass Management System | Update Category</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;800&family=Ubuntu&display=swap"
    rel="stylesheet" />
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"/>
    
    <link rel="stylesheet" href="includes/nav-bar.css"/>
    <link rel="stylesheet" href="includes/pass-details.css"/>

<script type="text/javascript">     
    function PrintDiv() {    
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'width=500,height=500');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
          }
 </script>

</head>

<body>
    
      <?php include_once('includes/header.php');?>
        
  <section id="pass-details">        
                    
        <div class="row" id="divToPrint">
            <div class="col-lg-12 col-md-12 col-sm-12">
<?php
$vid=$_GET['viewid'];
$sql="SELECT * from  tblpass where ID=$vid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>

<div  style="background-color: rgb(235 235 235);  font-family: Ubuntu;" class="card">
<div class="card-header">
    <img  style=" width: 950px; height: 100px;" 
    src="includes\images\Screenshot_20230117_124658.png" alt="banner">
  </div>
  <div style= "  flex: 1 1 auto;
  padding: var(--bs-card-spacer-y) var(--bs-card-spacer-x);
  color: var(--bs-card-color); "class="card-body">
  <table style=" caption-side: bottom;
                  border-collapse: collapse;" class="table">

            <tr>
            <tr>
            <td colspan="2" style="font-size:30px; 
                                   color:black;
                                   font-weight: 700; 
                                   text-align: center">
                  Pass ID: <?php  echo ($row->PassNumber);?>
              </td>
            </tr>
            <tr>
              <td>
                <table class=" table table-bordered" style="caption-side: bottom;
                  border-collapse: collapse; border-width: var(--bs-border-width) 0;">
                  <tr>
                  <th scope>Full Name</th>
                    <!-- <td colspan="3"> -->
                    <td><?php  echo ($row->FullName);?></td>
                  </tr>
                  <tr>
                    <th scope>Mobile Number</th>
                    <td><?php  echo ($row->ContactNumber);?></td>
                  </tr>

                  <tr>
                    <th scope>Source</th>
                    <td><?php  echo ($row->Source);?></td>
                  </tr>

                  <tr>
                  <th scope>Destination</th>
                    <td><?php  echo ($row->Destination);?></td>
                  </tr>

                  <tr>
                    <th scope>Valid from</th>
                      <td><?php  echo ($row->FromDate);?></td>
                  </tr>

                  <tr>
                  <th scope>Valid till</th>
                      <td><?php  echo ($row->ToDate);?></td>
                  </tr>

                  <tr>
                    <th scope>Cost</th>
                    <td><?php  echo ($row->Cost);?></td>
                  </tr>



                </table>
              </td>
                
                <td colspan="2"><img style="position: absolute; width: 250px; height: 250px; opacity: 80%;"
                
                src="images/<?php  echo ($row->ProfileImage);?>" >
                
                <img  style="position: relative; z-index: 1;
                      margin: 195px 25px 0 80px;
                      height: 150px;
                      width: 150px;" class="stamp" src="includes/images/KSRTC_Logo-removebg-preview.png" alt="stamp">
                </td>
            

            </tr>
            <?php $cnt=$cnt+1;}} ?>
   </table> 
  </div>
</div>
        

  















<!-- 
               <td colspan="6" style="font-size:20px;color:blue">
                  Pass ID: <?php  echo ($row->PassNumber);?>
              </td>
            </tr> 
          
             <tr>
              <th scope>Category</th>
                <td colspan="3"><?php  echo ($row->Category);?>
              </td>
            </tr> 
            
              <tr>
                <td>
                <table  class="table table-borderless">
                  <tr>
                  <th scope>Full Name</th>
                     <td colspan="3"> 
                    <td><?php  echo ($row->FullName);?></td>
                  </tr>
                  <tr>
                    
                    <th scope>Mobile Number</th>
                    <td><?php  echo ($row->ContactNumber);?></td>
                  </tr>
                </table>

                </td>
                <th scope>Photo</th>
                <td ><img src="images/<?php  echo ($row->ProfileImage);?>" width="100" height="100">
                </td>
            
              </tr>
            
            
            <tr>
              <th scope>Photo</th>
                <td ><img src="images/<?php  echo ($row->ProfileImage);?>" width="50" height="50">
                </td>
            </tr>
           
            <tr>
              <th scope>Mobile Number</th>
              <td><?php  echo ($row->ContactNumber);?></td>
              <th scope>Email</th>
              <td><?php  echo ($row->Email);?></td>
            </tr>
            
            <tr>
              <th scope>Identity Type</th>
              <td><?php  echo ($row->IdentityType);?></td>
              <th scope>Identity Card Number</th>
              <td><?php  echo ($row->IdentityCardno);?></td>
            </tr>
  
            <tr>
              <th scope>Source</th>
              <td><?php  echo ($row->Source);?></td>
              <th scope>Destination</th>
              <td><?php  echo ($row->Destination);?></td>
            </tr>
            
            <tr>
              <th scope>From Date</th>
                <td><?php  echo ($row->FromDate);?></td>
                  <th scope>To Date</th>
                <td><?php  echo ($row->ToDate);?></td>
            </tr>
  
            <tr>
              <th scope>Cost</th>
              <td><?php  echo ($row->Cost);?></td>
              <th scope>Pass Creation Date</th>
              <td><?php  echo ($row->PasscreationDate);?></td>
            </tr> -->
                       
            
 
   
    <p style="text-align: center;font-size: 20px;color: red">
      <input class="btn btn-primary" type="button" value="print" onclick="PrintDiv();" />
    </p>
    
            </div>                
      </div>

    </sectoion>  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous">
    </script>

</body>

</html>
<?php }  ?>


