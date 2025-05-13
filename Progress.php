<?php
session_start();
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="TopGym Template">
    <meta name="keywords" content="TopGym, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Progress Tracker | FlexiGym</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,300i,400,500,700,900" rel="stylesheet">

    <!-- Css Styles -->
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/barfiller.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-menu">
                        <div class="logo">
                            <a href="./index.html">
                                <img src="img/logo.gif" alt="">
                            </a>
                        </div>
                        <nav class="mobile-menu">
                            <ul>
                                <li><a href="./index.php">Home</a></li>
                                <li><a href="./about-us.php">About us</a></li>
                                <li><a href="./Plans.php">PLANS</a></li>
                                <li><a href="./Trainers.php">TRAINERS</a></li>
                                <li><a href="http://localhost/ap/ap/">PROGRESS</a></li>
                                <li><a href="./contact.php">Contact</a></li>
                                <li class="search-btn search-trigger"><i class="fa fa-search"></i></li>
                            </ul>
                        </nav>
                        <div id="mobile-menu-wrap"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->
    <!-- Search Bar Begin -->
    <section class="search-bar-wrap">
        <span class="search-close"><i class="fa fa-close"></i></span>
        <div class="search-bar-table">
            <div class="search-bar-tablecell">
                <div class="search-bar-inner">
                    <h2>Search</h2>
                    <form action="#">
                        <input type="search" placeholder="Type Keywords">
                        <button type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Search Bar End -->
    <!-- Top Social Begin -->
    <div class="top-social">
        <div class="top-social-links">
            <ul>
                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                <li><a href="#"><i class="fa fa-behance"></i></a></li>
            </ul>
        </div>
    </div>
    <!-- Top Social End -->
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-area set-bg" data-setbg="img/blog/blog-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-content">
                        <h2>Progress Tracker</h2>
                        <div class="links">
                            <a href="./index.html">Home</a>
                            <a href="./Progress.html" class="rt-breadcrumb">Progress</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Progress Section Begin -->
    <section class="progress-tracker spad-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Track Your Fitness Journey</h2>
                        <p>Monitor your progress, celebrate achievements, and stay motivated</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="upload-section text-center mb-5">
                        <button id="uploadBtn" class="primary-btn">📷 Upload Progress Photos</button>
                        <input type="file" id="fileInput" accept="image/*" style="display:none;">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="progress-timeline">
                        <h3>Progress Timeline</h3>
                        <div id="progressEntries">
                            <div class="entry">
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5>2024-01-15</h5>
                                        <div>
                                            <button class="btn btn-sm btn-outline-primary edit-btn">✏️</button>
                                            <button class="btn btn-sm btn-outline-danger delete-btn">🗑️</button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <img src="img/placeholder-progress.jpg" alt="Progress Image" class="img-fluid rounded">
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Stats:</strong></p>
                                                <ul class="list-unstyled">
                                                    <li>Weight: 75.5 kg</li>
                                                    <li>Muscle Mass: 42.3 kg</li>
                                                    <li>Body Fat: 18.5%</li>
                                                </ul>
                                                <p class="mt-3"><strong>Notes:</strong></p>
                                                <p>Feeling stronger this week. Added 5kg to my bench press.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="progress-sidebar">
                        <!-- 3D Avatar Display -->
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>Body Avatar</h4>
                                <div class="avatar-toggle">
                                    <label for="avatarViewSwitch">3D View</label>
                                    <label class="toggle-switch">
                                        <input type="checkbox" id="avatarViewSwitch" checked>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="avatar-container">
                                    <canvas id="avatarCanvas"></canvas>
                                    <div class="avatar-controls">
                                        <button id="rotateLeft"><i class="fa fa-undo"></i> Rotate</button>
                                        <button id="viewFront" class="active">Front</button>
                                        <button id="viewSide">Side</button>
                                        <button id="viewBack">Back</button>
                                    </div>
                                </div>
                                <div class="avatar-metrics">
                                    <h4>Body Measurements</h4>
                                    <div class="metric-item">
                                        <span class="metric-label">Chest</span>
                                        <span class="metric-value">42 in</span>
                                    </div>
                                    <div class="metric-item">
                                        <span class="metric-label">Waist</span>
                                        <span class="metric-value">34 in</span>
                                    </div>
                                    <div class="metric-item">
                                        <span class="metric-label">Hips</span>
                                        <span class="metric-value">38 in</span>
                                    </div>
                                    <div class="metric-item">
                                        <span class="metric-label">Arms</span>
                                        <span class="metric-value">15 in</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <h4>Progress Overview</h4>
                            </div>
                            <div class="card-body">
                                <p><strong>Total Progress</strong></p>
                                <p>Initial Weight: <span id="initialWeight">75.5 kg</span></p>
                                <p>Current Weight: <span id="currentWeight">75.5 kg</span></p>
                                
                                <p class="mt-3"><strong>Body Composition</strong></p>
                                <p>Initial Body Fat: <span id="initialBodyFat">18.5%</span></p>
                                <p>Current Body Fat: <span id="currentBodyFat">18.5%</span></p>
                                
                                <div class="progress mt-3">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25% to Goal</div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h4>Update Progress</h4>
                            </div>
                            <div class="card-body">
                                <form id="progressForm">
                                    <div class="form-group">
                                        <label for="weightInput">Weight (kg):</label>
                                        <input type="number" class="form-control" id="weightInput" step="0.1">
                                    </div>
                                    <div class="form-group">
                                        <label for="muscleMassInput">Muscle Mass (kg):</label>
                                        <input type="number" class="form-control" id="muscleMassInput" step="0.1">
                                    </div>
                                    <div class="form-group">
                                        <label for="bodyFatInput">Body Fat (%):</label>
                                        <input type="number" class="form-control" id="bodyFatInput" step="0.1">
                                    </div>
                                    <div class="form-group">
                                        <label for="notesInput">Notes:</label>
                                        <textarea class="form-control" id="notesInput" rows="3"></textarea>
                                    </div>
                                    <button type="button" id="updateProgress" class="primary-btn">Update Progress</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Progress Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer-section set-bg" data-setbg="img/footer-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-content">
                        <div class="footer-logo">
                            <a href="#"><img src="img/logo.png" alt=""></a>
                        </div>
                        <div class="footer-menu">
                            <ul>
                                <li><a href="./home.html">Home</a></li>
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Classes</a></li>
                                <li><a href="#">Instructors</a></li>
                                <li><a href="#">News</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div>
                        <div class="subscribe-form">
                            <form action="#">
                                <input type="text" placeholder="your Email">
                                <button type="submit">Sign Up</button>
                            </form>
                        </div>
                        <div class="social-links">
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-dribbble"></i></a>
                            <a href="#"><i class="fa fa-behance"></i></a>
                        </div>
                        <div class="footer-icon-img">
                            <img src="img/footer-icon.png" alt="">
                        </div>
                        <div class="copyright">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </div>
                    </div>
                </div>n End -->
            </div>
        </div>ugins -->
    </footer>rc="js/jquery-3.3.1.min.js"></script>
    <!-- Footer Section End -->in.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <!-- Js Plugins -->.carousel.min.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script></script>
    <script src="js/bootstrap.min.js"></script>cript>
    <script src="js/jquery.slicknav.js"></script>>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/circle-progress.min.js"></script>
    <script src="js/jquery.barfiller.js"></script>    <script src="js/main.js"></script>    <script src="js/progress-tracker.js"></script></body>
</html>