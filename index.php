<?php
session_start();

require("php/logout.php");
?>


<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="TopGym Template">
    <meta name="keywords" content="TopGym, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TopGym | Fitness HTML Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,300i,400,500,700,900" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/barfiller.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
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
                            <a href="./index.php">
                                <img src="img/logo.gif" alt="">
                            </a>
                        </div>
                        <nav class="mobile-menu">
                            <ul>
                            <li><a href="./index.php">Home</a></li>
                                <li><a href="./about-us.php">About us</a></li>
                                <li><a href="./Plans.php">PLANS</a></li>
                                <li><a href="./Trainers.php">MY WORKOUTS</a></li>
                                <li><a href="http://localhost/ap/ap/">PROGRESS</a></li>
                                <li><a href="./contact.php">Contact</a></li>
                                <li class="search-btn search-trigger"><i class="fa fa-search"></i></li>

                                <!-- Show Logout if logged in, otherwise show Login -->
                                <?php if (isset($_SESSION["user_id"])): ?>
                                    <li><a href="Login.php?logout='1'" class="mobile-menu" name="logout" >Logout</a></li>
                                <?php else: ?>
                                    <li><a href="Login.php" class="mobile-menu">Login</a></li>
                                <?php endif; ?>
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
                <li><a href="./UserProfile.php"><i class="fa fa-user" color="white"></i></a></li>
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                <li><a href="#"><i class="fa fa-behance"></i></a></li>
            </ul>
        </div>
    </div>
    <!-- Top Social End -->
    <!-- Hero Slider Section Begin -->
    <section class="hero-slider">
        <div class="slide-items owl-carousel">
            <div class="single-slide set-bg active" data-setbg="img/bga.jpg">
                <a href="https://www.youtube.com/watch?v=SEVuD_djKrU" class="play-btn pop-up"><i class="fa fa-play"></i></a>
                <h1>FLEXIGYM</h1>
                <a href="SignUp.php" class="primary-btn">Join Us</a>
            </div>
            <div class="single-slide set-bg" data-setbg="img/bga-2.jpg">
                <a href="https://www.youtube.com/watch?v=SEVuD_djKrU" class="play-btn pop-up"><i class="fa fa-play"></i></a>
                <h1>FLEXIGYM</h1>
                <a href="SignUp.php" class="primary-btn">Join Us</a>
            </div>
            <div class="single-slide set-bg" data-setbg="img/bg-3.jpg">
                <a href="https://www.youtube.com/watch?v=SEVuD_djKrU" class="play-btn pop-up"><i class="fa fa-play"></i></a>
                <h1>FLEXIGYM</h1>
                <a href="SignUp.php" class="primary-btn">Join Us</a>
            </div>
        </div>
    </section>
    <!-- Hero Slider End -->
    <!-- Features Section Begin -->
    <section class="features-section spad">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-features">
                        <div class="features-img">
                            <img src="img/features/feature-1.jpg" alt="">
                        </div>
                        <div class="feature-text">
                            <div class="feature-icon">
                                <img src="img/features/icon-1.png" alt="">
                            </div>
                            <h5>Amazing Setting</h5>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-features">
                        <div class="features-img">
                            <img src="img/features/feature-2.jpg" alt="">
                        </div>
                        <div class="feature-text">
                            <div class="feature-icon">
                                <img src="img/features/icon-2.png" alt="">
                            </div>
                            <h5>Best Trainers</h5>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-features">
                        <div class="features-img">
                            <img src="img/features/feature-3.jpg" alt="">
                        </div>
                        <div class="feature-text">
                            <div class="feature-icon">
                                <img src="img/features/icon-3.png" alt="">
                            </div>
                            <h5>Plans</h5>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features Section End -->
    <!-- Services Section Begin -->
    <section class="services-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <span>Features</span>
                        <h2>Services</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="single-service">
                        <img src="img/icon-1.png" alt="">
                        <h5>Pilates</h5>
                        <p></p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-service c-text">
                        <img src="img/icon-2.png" alt="">
                        <h5>Free Lifting</h5>
                        <p></p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-service">
                        <img src="img/icon-3.png" alt="">
                        <h5>Yoga</h5>
                        <p></p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-service">
                        <img src="img/icon-4.png" alt="">
                        <h5>Spinning</h5>
                        <p></p>
                    </div>
                </div>
            </div>
            <div class="row p-70">
                <div class="col-lg-12 text-center">
                    <a href="#" class="service-btn primary-btn">see all the services</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->
    <!-- Trainer Section Begin -->
    <section class="trainer-section set-bg" data-setbg="img/trainer-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <span>The Best</span>
                        <h2>Trainers</h2>
                        <a href="#" class="primary-btn trainer-btn">See All</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="single-trainer">
                        <div class="trainer-img">
                            <img src="img/trainer/trainer-1.jpg" alt="">
                            <div class="img-hover">
                                <a href="#"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="trainer-text">
                            <h5>Rachel Smith <span>Aerobics Instructor</span></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-trainer">
                        <div class="trainer-img">
                            <img src="img/trainer.jpg" alt="">
                            <div class="img-hover">
                                <a href="#"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="trainer-text">
                            <h5>Micheal Williams <span>Aerobics Instructor</span></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-trainer">
                        <div class="trainer-img">
                            <img src="img/trainer1.jpg" alt="">
                            <div class="img-hover">
                                <a href="#"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="trainer-text">
                            <h5>James Brown <span>Aerobics Instructor</span></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Traniner Section End -->
    <!-- Upcoming Event Begin -->
    <section class="upcoming-event-section spad-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="upcoming-classes">
                        <div class="up-title">
                            <span>Next</span>
                            <h5>Upcomming Classes</h5>
                        </div>
                        <ul class="classes-time">
                            <li><img src="img/stopwatch.png" alt=""> Gym Fitness <span>11:00 - 12:00</span></li>
                            <li><img src="img/stopwatch.png" alt=""> Pilates <span>12:00 - 13:00</span></li>
                            <li><img src="img/stopwatch.png" alt=""> Spinning <span>13:00 - 14:00</span></li>
                            <li><img src="img/stopwatch.png" alt=""> Yoga <span>14:00 - 15:00</span></li>
                            <li><img src="img/stopwatch.png" alt=""> Gym Fitness <span>15:00 - 16:00</span></li>
                            <li><img src="img/stopwatch.png" alt=""> Pilates <span>16:00 - 17:00</span></li>
                        </ul>
                    </div>
                </div>
               
                <div class="col-lg-4 col-md-12">
                    <div class="member-sign-up set-bg" data-setbg="img/signup-bg.jpg">
                        <div class="up-title">
                            <span>New</span>
                            <h5>Personal Trainer</h5>
                        </div>
                        <p></p>
                        <div class="member-signup-btn">
                            <a href="#" class="primary-btn">Sign up Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Upcoming Event End -->
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
                                <li><a href="./index.php">Home</a></li>
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
                       
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/circle-progress.min.js"></script>
    <script src="js/jquery.barfiller.js"></script>
    <script src="js/main.js"></script>
</body>

</html>