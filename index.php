<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

?>
  
<!DOCTYPE html>
<html lang="en">
<head>
<title>Bus Pass Management System | Home </title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BUS PASS</title>
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;800&family=Ubuntu&display=swap" rel="stylesheet" />

  <!-- Bootstrap CSS stylesheets -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
  <link rel="stylesheet" href="CSS-2/style.css"/>

  <!-- Font Awesome logo -->
  <script src="https://kit.fontawesome.com/6978f47505.js" crossorigin="anonymous"></script>

  <!-- bootstrap scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
    integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk"
    crossorigin="anonymous">
  </script>
</head>


<body>
<section id="title">
    <div class="container-fluid ms-auto">
      <nav class="navbar navbar-expand-lg navbar-dark">

        <a class="navbar-brand" href="#"><img src="images copy/bus-logo.png" width="40" height="33"
            class="d-inline-block align-text-top">
          BUS PASS
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Admin
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="admin/index.php">Login</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="#verify-pass">Verify Pass</a>
            </li>
           
            <li class="nav-item">
              <a class="nav-link" href="#about-us">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contact-us">Contact</a>
            </li>
          </ul>
      </nav>

      <div class="row">
        <div class="col-lg-6 features-title">
          <h1>We Love 🤍 to see you in our Bus.</h1>
          <a class="btn btn-light btn-md login-button" href="admin/index.php" role="button"><i class="fa-solid fa-user"></i>
          Sign in</a>
        </div>
        <div class="col-lg-6 features-title">
          <img class="title-img" src="images copy/Bus Stop-banner.png" width="84%" height="99%" alt="banner" style="margin-left: 60px;"/>
        </div>
      </div>
    </div>
  </section>



  <!-- <section id="login">


    <div class="container-fluid-2 ms-auto">

      <div class="row">
        <div class="col-lg-6">

          <img src="images copy\Mobile login-rafiki.png" width="95%" height="98%" alt="login-page">

        </div>

        <div class=" login-form1 col-lg-6">
          <h2 class="welcome-msg"> <img src="images copy\bus-logo.png" width="40" height="30"
              class="d-inline-block align-text-top"> Well come!</h2>
          <div class=" login-form form-floating mb-3">
            <input type="text" class="form-control" required="true" id="username" name="username" value="<?php if(isset($_COOKIE["
              user_login"])) { echo $_COOKIE["user_login"]; } ?>">
          
            <label for="floatingInput">Username</label>
          </div>
          <div class=" login-form form-floating">
            <input type="password" class="form-control" id="password" name="password" required="true" value="<?php if(isset($_COOKIE["
              userpassword"])) { echo $_COOKIE["userpassword"]; } ?>">
             
            <label for="floatingPassword">Password</label>
          </div>
          <div class="login-checkbox mb-3 form-check">
            <input type="checkbox" id="remember" name="remember" <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?> />
          
            <label class="form-check-label" for="exampleCheck1">Remember me</label>
          </div>
          <div>
            <a class="btn btn-md btn-dark login-btn" href="Admin/dashboard.php" role="button"><i class="fa-solid fa-user"></i>Sing in</a>
          </div>
        </div>
      </div>
    </div>
  </section> -->

  <section id="contact-us">
<?php
  if(isset($_POST['submit']))
  {


 $name=$_POST['name'];
    $email=$_POST['email'];
    $message=$_POST['message'];

$sql="insert into tblcontact(Name,Email,Message)values(:name,:email,:message)";
$query=$dbh->prepare($sql);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
 $query->execute();

   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
   echo "<script>alert('Your message was sent successfully!.');</script>";
echo "<script>window.location.href ='index.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}
?>
  <div class="container-fluid ms-auto">
    <div class="row">
      <div class="row">
        <div class="col-6">
          <img class="title-img" src="images copy/5197176-removebg-preview.png" width="75%" height="89%" alt="banner" style="margin: 10px"/>
        </div>
        <div class="col-6">
            <h2>Have a Question ? <br> Contact Us</h2>
            <p><i class="fa fa-map-marker"></i> Address:  Central Office, Post Bag No-2778, Shanthinagar, Bengaluru-560027.</p>
						<p><i class="fa fa-phone"></i> Contact Number: 080-26252625</p>
						<p><i class="fa fa-envelope-o"></i> Email: awatar@ksrtc.org </p> 
        </div>
      </div>

    <div class="col-12 question-form">
    <form action="#" method="post">
        <div class= row>
          <div class="col-6">
            <input type="text" name="name" class="form-control" placeholder="Name" required="true">
          </div>
          <div class="col-6">
            <input type="email" class="form-control" name="email" placeholder="Email" required="true">
          </div>
        </div>

        <div class= row>
          <div class="col-12">
          <textarea placeholder="Write message to us..." class="form-control" name="message" required="true"></textarea>
          </div>
        </div>
        <input type="submit" class="btn btn-sm submit-button" name="submit" value="SUBMIT">
			</form>
				
    </div>
  </div>
  </div>
</section>


  <section id="verify-pass">
    <div class="container-fluid-2 ms-auto">
      <div class="row">
        <div class="col-6 serach-sec">
          <h2 class="line">Verify the Pass</h2>
          <form action="#" method="post">
						<input id="searchdata" type="text" name="searchdata" class="search-pass-form form-control" placeholder="Search by Pass Number" required="true">
					<a href="#verify-pass" role="button"> <button style=" margin: 10px 0 0 20px; background-color: black; color: white;" type="submit" class="btn btn-sm" name="search" id="submit">Search</button> </a>
					</form>
        </div>
        <div class="col-6 search-sec-result">
        <?php
          if(isset($_POST['search']))
          { 
          $sdata=$_POST['searchdata'];
        ?>
          <h6 style="padding-bottom: 20px; color:white;"> Result against "<?php echo $sdata;?>" keyword </h6>
            <table class="styled-table" style="font-size: 12px;">
                                    <thead>
                                        <tr>
                                           	<th>Pass Number</th>
                                            <th>Full Name</th>
                                            <th>Creation Date</th>
                                            <th>Valid Till</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$sql="SELECT * from tblpass where PassNumber like '$sdata%'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                <tr>
                  <td><?php  echo htmlentities($row->PassNumber);?></td>
                  <td><?php  echo htmlentities($row->FullName);?></td>
                  <td><?php  echo htmlentities($row->PasscreationDate);?></td>
                  <td><?php  echo htmlentities($row->ToDate);?></td>
                </tr>
               <?php 
$cnt=$cnt+1;
} } else { ?>
  <tr>
    <td colspan="8">No record found against this search</td>

  </tr>
   
<?php } }?> 
                                       
                                        
                        </tbody>
                    </table>
        </div>
      </div>
    </div>
  </section>

  <!-- <section id="about-us">
  <div class="container-fluid ms-auto">
      <div class="row">
        <div class="col-6 about-sec">
          <div class="row">
            <div class="col-6">
              <img class="our-img" src="images copy\21004063-removebg-preview.png" alt="">
            </div>

            <div class="col-6">
            <h2>Suprith. Badiger
                <br> <span> B.E. [CSE] 2024</span>
                </h2> 
            </div>
          </div>
        </div>

        <div class="col-6 about-sec">
        <div class="row">
            <div class="col-6">
              <img class="our-img" src="images copy\21004063-removebg-preview.png" alt="">
            </div>

            <div class="col-6">
               <h2>Veeresh. Banakar
                <br> <span> B.E. [CSE] 2024</span>
                </h2> 
            </div>
          </div>
      
        </div>
      </div>
  </div>

  </section> -->


  <section id="about-us">
    <div class="container-fluid  ms-auto">
      <div class="row">
          <div class="col-6">
          <h2>Growth and Progress</h2>
                <p style="padding: 10px 2px;">
                Along with the rapid progress of Karnataka in all spheres of 
                activity, KSRTC has emerged as the best organisation in meeting the aspirations of Kannadigas and the people 
                of neighbouring states of Karnataka. <br> As at the end of 31-03-1997,the Corporationoperated its services in 19 Divisions- 17 Divisions 
                operating mofussil services and 2 Division operating city services of Bangalore. It had 108 Depots, 
                2 Regional Workshops and a Central Office at Bangalore. <br> There were 281 permanent and 11 temporary bus 
                stations with 337wayside shelters and 1009 pick-up shelters. 
                </p>
          </div>
          <div class="col-6">
          <img class="title-img" src="images copy/2672335-removebg-preview.png" width="90%" height="89%" alt="banner" style="margin: 20px"/>
          </div>
        </div>
    </div>
  </section>

		
	<footer class="dark-section" id="footer">
    <div class="container-footer">
      <p>© Copyright 2022</p>
    </div>
  </footer>

</body>
</html>
