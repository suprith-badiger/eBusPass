<?php

error_reporting(0);

include('includes/dbconnection.php');

?>

    <section id="title">
        <nav class="navbar fixed-top navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="dashboard.php">Admin</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                    aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="manage-category.php" role="button">
                                Category
                            </a>        
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Bus Pass
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="add-pass.php">Add Pass</a></li>
                                <li>
                                    <hr class="dropdown-divider"/>
                                </li>
                                <li><a class="dropdown-item" href="manage-pass.php">Manage Pass</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Enquiry
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="readenq.php">Seen Enquiries</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item" href="unreadenq.php">Unseen Enquiries</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="search-pass.php" class="nav-link">Search</a>
                        </li>
                        <li class="nav-item">
                            <a href="pass-bwdates-report.php" class="nav-link">Report</a>
                        </li>
                        <li class="nav-item nav-admin dropdown">
                            <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">Profile</a> 
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="change-password.php">Settings</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item" href="logout.php" >Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </section>
    

