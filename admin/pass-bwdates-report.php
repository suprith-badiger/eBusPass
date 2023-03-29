<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {

    ?>
    <!DOCTYPE html>
    <html>

    <head>

        <title>Bus Pass Management System |Pass Reports</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
        <link rel="stylesheet" href="includes/nav-bar.css">
        <link rel="stylesheet" href="includes/pass-report.css"/>

    </head>

    <body>
    <?php include_once('includes/header.php'); ?>
        <section id="pass-report">

<div class="card">
  <div class="card-body">
  <form method="post" name="bwdatesreport" action="pass-bwdates-reports-details.php">
       <div class="row forms-row g-6">
       <div class="col-3">
        <label for="passreport" class="col-form-label">From Date</label>
       </div>
       <div class="col-9">
        <input id="fromdate" type="date" name="fromdate" required="true" class="form-control" value="">
        </div>
       </div>

       <div class="row forms-row g-6">
       <div class="col-3">
        <label for="passreport" class="col-form-label">To Date</label>
       </div>
       <div class="col-9">
        <input id="todate" type="date" name="todate" required="true" class="form-control" value="">
        </div>
       </div>
      
      
       <button type="submit" class="btn btn-primary" name="search" id="submit">Get Report</button>
        </form>

        </div>        
    </section>
  

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>

    </body>

    </html>
<?php } ?>