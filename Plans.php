<?php
session_start();
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="FlexiGym Membership Plans">
    <meta name="keywords" content="FlexiGym, fitness, membership, gym">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FlexiGym | Membership Plans</title>

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
    <style>
        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
        .delete-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .delete-btn:hover {
            background-color: #c82333;
            transform: translateY(-2px);
        }
        .edit-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .edit-btn:hover {
            background-color: #0069d9;
            transform: translateY(-2px);
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.7);
        }
        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 30px;
            border-radius: 8px;
            width: 50%;
            max-width: 600px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        .close-modal {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s;
        }
        .close-modal:hover {
            color: #333;
        }
        
        /* Enhanced styling for membership items */
        .membership-item {
            transition: all 0.3s ease;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .membership-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        .mi-title {
            padding: 25px 20px;
            border-bottom: 2px solid rgba(255,255,255,0.1);
        }
        .membership-item ul {
            padding: 25px 30px !important;
        }
        .membership-item ul li {
            position: relative;
            padding-left: 25px !important;
            margin-bottom: 15px !important;
        }
        .membership-item ul li:before {
            content: "\f00c";
            font-family: 'FontAwesome';
            position: absolute;
            left: 0;
            color: #f36100;
        }
        .gold-item {
            background: linear-gradient(135deg, #f36100, #ffa84c) !important;
        }
        .platinum-item {
            background: linear-gradient(135deg, #333, #777) !important;
        }
        .membership-btn {
            margin: 0 30px 30px !important;
            width: calc(100% - 60px);
            text-align: center;
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        .membership-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        /* Custom plans section styling */
        .custom-plans-section {
            background-color: #f8f9fa;
            padding: 80px 0;
        }
        .create-plan-btn-container {
            text-align: center;
            margin-bottom: 40px;
        }
        .create-plan-btn {
            background: linear-gradient(135deg, #f36100, #ffa84c);
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            display: inline-block;
            transition: all 0.3s ease;
            border: none;
            font-size: 16px;
        }
        .create-plan-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(243, 97, 0, 0.3);
        }
        
        /* Enhanced Custom Plans Section Styling */
        .custom-plans-section .section-title {
            position: relative;
            padding-bottom: 30px;
            margin-bottom: 50px;
            text-align: center; /* Add this line to center the content */
        }
        
        .custom-plans-section .section-title h2 {
            font-size: 42px;
            font-weight: 700;
            text-transform: uppercase;
            background: linear-gradient(135deg, #f36100, #ffa84c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
            position: relative;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }
        
        .custom-plans-section .section-title p {
            font-size: 18px;
            color: #666;
            line-height: 1.6;
            max-width: 700px;
            margin: 0 auto;
            position: relative;
        }
        
        .custom-plans-section .section-title:after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: 0;
            width: 80px;
            height: 3px;
            background: linear-gradient(135deg, #f36100, #ffa84c);
            transform: translateX(-50%);
        }
        
        .custom-plans-section {
            background: linear-gradient(to bottom, #f8f9fa, #ffffff);
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }
        
        .custom-plans-section:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml;utf8,<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="1.5" fill="%23f36100" opacity="0.2"/></svg>');
            background-size: 30px 30px;
            pointer-events: none;
        }
        /* End of Enhanced Custom Plans Section Styling */
        
        /* Custom plan cards */
        .pricing-item {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            margin-bottom: 30px;
        }
        .pricing-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        .pricing-header {
            background: linear-gradient(135deg, #333, #555);
            padding: 20px;
            color: white;
            text-align: center;
        }
        .pricing-body {
            padding: 25px;
        }
        .pricing-body .price {
            text-align: center;
            margin-bottom: 20px;
        }
        .pricing-body .price h2 {
            font-size: 42px;
            color: #f36100;
            margin-bottom: 0;
        }
        .pricing-footer {
            padding: 0 25px 25px;
            text-align: center;
        }
        
        /* No plans message */
        .no-plans {
            background: white;
            padding: 30px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            font-size: 18px;
        }
        .no-plans a {
            color: #f36100;
            font-weight: 600;
        }
        
        /* Compare section */
        .compare-section {
            padding: 80px 0;
            background-color: #fff;
        }
        .compare-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        .compare-table th, .compare-table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }
        .compare-table th {
            background-color: #f5f5f5;
        }
        .compare-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .feature-name {
            text-align: left;
            font-weight: 500;
        }
        
        /* Success Message Toast */
        .success-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #28a745;
            color: white;
            padding: 15px 25px;
            border-radius: 5px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            z-index: 1100;
            transform: translateY(-100px);
            opacity: 0;
            transition: all 0.5s ease;
        }
        .success-toast.show {
            transform: translateY(0);
            opacity: 1;
        }
        .success-toast .toast-content {
            display: flex;
            align-items: center;
        }
        .success-toast i {
            margin-right: 10px;
            font-size: 20px;
        }
        
        /* Delete Confirmation Modal */
        .delete-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.7);
            display: none;
            z-index: 1100;
            justify-content: center;
            align-items: center;
        }
        .delete-modal-content {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            text-align: center;
            width: 400px;
            max-width: 90%;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            position: relative;
        }
        .delete-modal-content h4 {
            margin-bottom: 20px;
            color: #333;
        }
        .delete-modal-icon {
            font-size: 50px;
            color: #dc3545;
            margin-bottom: 20px;
        }
        .delete-modal-actions {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }
        .confirm-delete-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .confirm-delete-btn:hover {
            background-color: #c82333;
        }
        .cancel-delete-btn {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .cancel-delete-btn:hover {
            background-color: #5a6268;
        }
        
        /* Enhanced Section Title Styling - For All Sections */
        .section-title {
            position: relative;
            padding-bottom: 30px;
            margin-bottom: 50px;
            text-align: center;
        }
        
        .section-title h2 {
            font-size: 42px;
            font-weight: 700;
            text-transform: uppercase;
            background: linear-gradient(135deg, #f36100, #ffa84c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
            position: relative;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }
        
        .section-title p {
            font-size: 18px;
            color: #666;
            line-height: 1.6;
            max-width: 700px;
            margin: 0 auto;
            position: relative;
        }
        
        .section-title:after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: 0;
            width: 80px;
            height: 3px;
            background: linear-gradient(135deg, #f36100, #ffa84c);
            transform: translateX(-50%);
        }
        
        /* Membership Plans Section Specific Styling */
        .membership-plans {
            position: relative;
            overflow: hidden;
            background: linear-gradient(to bottom, #ffffff, #f8f9fa);
            padding: 100px 0;
        }
        
        /* Compare Section Specific Styling */
        .compare-section {
            position: relative;
            overflow: hidden;
            background: linear-gradient(to bottom, #f8f9fa, #ffffff);
            padding: 100px 0;
        }
        
        /* Remove duplicate styles from custom plans section that are now global */
        .custom-plans-section .section-title h2,
        .custom-plans-section .section-title p,
        .custom-plans-section .section-title:after {
            /* These styles are now handled by the global section-title styles */
        }
    </style>
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
                                <li><a href="./Progress.php">PROGRESS</a></li>
                                <li><a href="./contact.php">Contact</a></li>
                                <li class="search-btn search-trigger"><i class="fa fa-search"></i></li>
<<<<<<< Updated upstream
<<<<<<< Updated upstream
                                <!-- Show Logout if logged in, otherwise show Login -->
                                <?php if (isset($_SESSION["user_id"])): ?>
                                <li><a href="Login.php" class="mobile-menu">Logout</a></li>
                            <?php else: ?>
                                <li><a href="Login.html" class="mobile-menu">Login</a></li>
                            <?php endif; ?>
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
                            </ul>
                        </nav>
                        <div id="mobile-menu-wrap"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->
    
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-area set-bg" data-setbg="img/classes/classes-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-content">
                        <h2>Membership Plans</h2>
                        <div class="links">
                            <a href="./index.html">Home</a>
                            <a href="./membership-plans.html" class="rt-breadcrumb">Membership Plans</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Membership Plans Section Begin -->
    <section class="membership-plans spad">
        <div class="container">
            <div class="row">
<<<<<<< Updated upstream
<<<<<<< Updated upstream
                <div class="col-md-4 col-sm-6">
                    <a href="MembershipPlans.php" style="text-decoration: none; color: inherit; display: block;">
                        <div class="single-classes">
                            <div class="classes-img">
                                <img src="img/classes/classes-1.jpg" alt="">
                            </div>
                            <div class="classes-text">
                                <h5>Pilates</h5>
                                <p>Pellentesque dictum nisl in nibh dictum volutpat nec a quam. Vivamus suscipit nisl quis
                                    nulla pretium, vitae ornare leo.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a href="MembershipPlans.php" style="text-decoration: none; color: inherit; display: block;">
                        <div class="single-classes">
                            <div class="classes-img">
                                <img src="img/classes/classes-2.jpg" alt="">
                            </div>
                                <div class="classes-text">
                                <h5>Body Building</h5>
                                <p>Pellentesque dictum nisl in nibh dictum volutpat nec a quam. Vivamus suscipit nisl quis
                                    nulla pretium, vitae ornare leo.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a href="MembershipPlans.php" style="text-decoration: none; color: inherit; display: block;">
                        <div class="single-classes">
                            <div class="classes-img">
                                <img src="img/classes/classes-3.jpg" alt="">
                            </div>
                            <div class="classes-text">
                                <h5>Fitness</h5>
                                <p>Pellentesque dictum nisl in nibh dictum volutpat nec a quam. Vivamus suscipit nisl quis
                                    nulla pretium, vitae ornare leo.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a href="MembershipPlans.php" style="text-decoration: none; color: inherit; display: block;">
                        <div class="single-classes">
                            <div class="classes-img">
                             <img src="img/classes/classes-4.jpg" alt="">
                            </div>
                            <div class="classes-text">
                                <h5>Yoga</h5>
                                <p>Pellentesque dictum nisl in nibh dictum volutpat nec a quam. Vivamus suscipit nisl quis
                                    nulla pretium, vitae ornare leo.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a href="MembershipPlans.php" style="text-decoration: none; color: inherit; display: block;">
                        <div class="single-classes">
                            <div class="classes-img">
                                <img src="img/classes/classes-5.jpg" alt="">
                            </div>
                            <div class="classes-text">
                                <h5>Trx</h5>
                                <p>Pellentesque dictum nisl in nibh dictum volutpat nec a quam. Vivamus suscipit nisl quis
                                    nulla pretium, vitae ornare leo.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a href="MembershipPlans.php" style="text-decoration: none; color: inherit; display: block;">
                        <div class="single-classes">
                            <div class="classes-img">
                                <img src="img/classes/classes-6.jpg" alt="">
                            </div>
                            <div class="classes-text">
                                <h5>Spinning</h5>
                                <p>Pellentesque dictum nisl in nibh dictum volutpat nec a quam. Vivamus suscipit nisl quis
                                    nulla pretium, vitae ornare leo.</p>
                            </div>
                        </div>
                    </a>
=======
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Choose Your Membership Plan</h2>
                        <p>Select the plan that best fits your fitness goals and lifestyle</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Silver Plan -->
                <div class="col-lg-4 col-md-6">
                    <div class="membership-item">
                        <div class="mi-title">
                            <h4>Silver Plan</h4>
                            <div class="price">
                                <h2>$29.99</h2>
=======
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Choose Your Membership Plan</h2>
                        <p>Select the plan that best fits your fitness goals and lifestyle</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Silver Plan -->
                <div class="col-lg-4 col-md-6">
                    <div class="membership-item">
                        <div class="mi-title">
                            <h4>Silver Plan</h4>
                            <div class="price">
                                <h2>$29.99</h2>
                                <span>/ month</span>
                            </div>
                        </div>
                        <ul>
                            <li>Access to gym facilities</li>
                            <li>Basic fitness classes</li>
                            <li>Locker usage</li>
                            <li>Free WiFi</li>
                            <li>Access from 8am to 5pm</li>
                        </ul>
                        <a href="payment.html?plan=silver&price=29.99" class="primary-btn membership-btn">Choose Plan</a>
                    </div>
                </div>
                
                <!-- Gold Plan -->
                <div class="col-lg-4 col-md-6">
                    <div class="membership-item gold-item">
                        <div class="mi-title">
                            <h4>Gold Plan</h4>
                            <div class="price">
                                <h2>$59.99</h2>
                                <span>/ month</span>
                            </div>
                        </div>
                        <ul>
                            <li>24/7 Access to gym facilities</li>
                            <li>All fitness classes included</li>
                            <li>Personal trainer (1 session/week)</li>
                            <li>Towel service</li>
                            <li>Nutritional consultation</li>
                            <li>Free parking</li>
                        </ul>
                        <a href="payment.html?plan=gold&price=59.99" class="primary-btn membership-btn">Choose Plan</a>
                    </div>
                </div>
                
                <!-- Platinum Plan -->
                <div class="col-lg-4 col-md=6">
                    <div class="membership-item platinum-item">
                        <div class="mi-title">
                            <h4>Platinum Plan</h4>
                            <div class="price">
                                <h2>$99.99</h2>
>>>>>>> Stashed changes
                                <span>/ month</span>
                            </div>
                        </div>
                        <ul>
<<<<<<< Updated upstream
                            <li>Access to gym facilities</li>
                            <li>Basic fitness classes</li>
                            <li>Locker usage</li>
                            <li>Free WiFi</li>
                            <li>Access from 8am to 5pm</li>
                        </ul>
                        <a href="payment.html?plan=silver&price=29.99" class="primary-btn membership-btn">Choose Plan</a>
                    </div>
                </div>
                
                <!-- Gold Plan -->
                <div class="col-lg-4 col-md-6">
                    <div class="membership-item gold-item">
                        <div class="mi-title">
                            <h4>Gold Plan</h4>
                            <div class="price">
                                <h2>$59.99</h2>
                                <span>/ month</span>
                            </div>
                        </div>
                        <ul>
                            <li>24/7 Access to gym facilities</li>
                            <li>All fitness classes included</li>
                            <li>Personal trainer (1 session/week)</li>
                            <li>Towel service</li>
                            <li>Nutritional consultation</li>
                            <li>Free parking</li>
                        </ul>
                        <a href="payment.html?plan=gold&price=59.99" class="primary-btn membership-btn">Choose Plan</a>
                    </div>
                </div>
                
                <!-- Platinum Plan -->
                <div class="col-lg-4 col-md=6">
                    <div class="membership-item platinum-item">
                        <div class="mi-title">
                            <h4>Platinum Plan</h4>
                            <div class="price">
                                <h2>$99.99</h2>
                                <span>/ month</span>
                            </div>
                        </div>
                        <ul>
=======
>>>>>>> Stashed changes
                            <li>24/7 Access to all facilities</li>
                            <li>All premium classes included</li>
                            <li>Personal trainer (3 sessions/week)</li>
                            <li>VIP locker & towel service</li>
                            <li>Full nutritional program</li>
                            <li>Access to spa & sauna</li>
                            <li>Massage session (1/month)</li>
                        </ul>
                        <a href="payment.html?plan=platinum&price=99.99" class="primary-btn membership-btn">Choose Plan</a>
<<<<<<< Updated upstream
                    </div>
>>>>>>> Stashed changes
                </div>
            </div>
        </div>
    </section>
    <!-- Membership Plans Section End -->

    <!-- Compare Plans Section Begin -->
    <section class="compare-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Compare Plans</h2>
                        <p>See which plan offers the features you need</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="compare-table">
                            <thead>
                                <tr>
                                    <th>Feature</th>
                                    <th>Silver</th>
                                    <th>Gold</th>
                                    <th>Platinum</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="feature-name">Gym Access Hours</td>
                                    <td>8am - 5pm</td>
                                    <td>24/7</td>
                                    <td>24/7</td>
                                </tr>
                                <tr>
                                    <td class="feature-name">Fitness Classes</td>
                                    <td>Basic Only</td>
                                    <td>All Classes</td>
                                    <td>All Premium Classes</td>
                                </tr>
                                <tr>
                                    <td class="feature-name">Personal Training</td>
                                    <td><i class="fa fa-times" style="color: #dc3545"></i></td>
                                    <td>1 session/week</td>
                                    <td>3 sessions/week</td>
                                </tr>
                                <tr>
                                    <td class="feature-name">Nutritional Guidance</td>
                                    <td><i class="fa fa-times" style="color: #dc3545"></i></td>
                                    <td>Consultation</td>
                                    <td>Full Program</td>
                                </tr>
                                <tr>
                                    <td class="feature-name">Spa & Sauna</td>
                                    <td><i class="fa fa-times" style="color: #dc3545"></i></td>
                                    <td><i class="fa fa-times" style="color: #dc3545"></i></td>
                                    <td><i class="fa fa-check" style="color: #28a745"></i></td>
                                </tr>
                                <tr>
                                    <td class="feature-name">Monthly Price</td>
                                    <td>$29.99</td>
                                    <td>$59.99</td>
                                    <td>$99.99</td>
                                </tr>
                            </tbody>
                        </table>
=======
>>>>>>> Stashed changes
                    </div>
                </div>
            </div>
        </div>
    </section>
<<<<<<< Updated upstream
    <!-- Compare Plans Section End -->

    <!-- Custom Plans Section Begin -->
    <section class="custom-plans-section">
=======
    <!-- Membership Plans Section End -->

    <!-- Compare Plans Section Begin -->
    <section class="compare-section">
>>>>>>> Stashed changes
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
<<<<<<< Updated upstream
                        <h2>Custom Fitness Plans</h2>
                        <p>Check out these custom fitness plans created by our community or create your own</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 create-plan-btn-container">
                    <a href="create-plan.html" class="create-plan-btn">
                        <i class="fa fa-plus-circle"></i> Create Your Own Plan
                    </a>
                </div>
            </div>
=======
                        <h2>Compare Plans</h2>
                        <p>See which plan offers the features you need</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="compare-table">
                            <thead>
                                <tr>
                                    <th>Feature</th>
                                    <th>Silver</th>
                                    <th>Gold</th>
                                    <th>Platinum</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="feature-name">Gym Access Hours</td>
                                    <td>8am - 5pm</td>
                                    <td>24/7</td>
                                    <td>24/7</td>
                                </tr>
                                <tr>
                                    <td class="feature-name">Fitness Classes</td>
                                    <td>Basic Only</td>
                                    <td>All Classes</td>
                                    <td>All Premium Classes</td>
                                </tr>
                                <tr>
                                    <td class="feature-name">Personal Training</td>
                                    <td><i class="fa fa-times" style="color: #dc3545"></i></td>
                                    <td>1 session/week</td>
                                    <td>3 sessions/week</td>
                                </tr>
                                <tr>
                                    <td class="feature-name">Nutritional Guidance</td>
                                    <td><i class="fa fa-times" style="color: #dc3545"></i></td>
                                    <td>Consultation</td>
                                    <td>Full Program</td>
                                </tr>
                                <tr>
                                    <td class="feature-name">Spa & Sauna</td>
                                    <td><i class="fa fa-times" style="color: #dc3545"></i></td>
                                    <td><i class="fa fa-times" style="color: #dc3545"></i></td>
                                    <td><i class="fa fa-check" style="color: #28a745"></i></td>
                                </tr>
                                <tr>
                                    <td class="feature-name">Monthly Price</td>
                                    <td>$29.99</td>
                                    <td>$59.99</td>
                                    <td>$99.99</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Compare Plans Section End -->

    <!-- Custom Plans Section Begin -->
    <section class="custom-plans-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Custom Fitness Plans</h2>
                        <p>Check out these custom fitness plans created by our community or create your own</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 create-plan-btn-container">
                    <a href="create-plan.html" class="create-plan-btn">
                        <i class="fa fa-plus-circle"></i> Create Your Own Plan
                    </a>
                </div>
            </div>
>>>>>>> Stashed changes
            <div class="row" id="custom-plans-container">
                <!-- Custom plans will be dynamically inserted here -->
            </div>
        </div>
    </section>
    <!-- Custom Plans Section End -->

    <!-- Modal for Editing Plan -->
    <div id="editPlanModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h3>Edit Fitness Plan</h3>
            <form id="editPlanForm">
                <input type="hidden" id="edit-plan-id">
                <div class="form-group">
                    <label for="edit-plan-name">Plan Name</label>
                    <input type="text" id="edit-plan-name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="edit-plan-description">Plan Description</label>
                    <textarea id="edit-plan-description" class="form-control" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="edit-plan-duration">Plan Duration (weeks)</label>
                    <input type="number" id="edit-plan-duration" class="form-control" required min="1">
                </div>
                <div class="form-group">
                    <label for="edit-plan-amount">Plan Amount</label>
                    <input type="number" id="edit-plan-amount" class="form-control" required min="0">
                </div>
                <button type="submit" class="primary-btn">Update Plan</button>
            </form>
        </div>
    </div>

    <!-- Success Toast Notification -->
    <div class="success-toast" id="deleteSuccessToast">
        <div class="toast-content">
            <i class="fa fa-check-circle"></i>
            <span>Plan deleted successfully!</span>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="delete-modal" id="deleteConfirmModal">
        <div class="delete-modal-content">
            <div class="delete-modal-icon">
                <i class="fa fa-trash"></i>
            </div>
            <h4>Delete Fitness Plan</h4>
            <p>Are you sure you want to delete this plan? This action cannot be undone.</p>
            <div class="delete-modal-actions">
                <button id="confirmDeleteBtn" class="confirm-delete-btn">Delete</button>
                <button id="cancelDeleteBtn" class="cancel-delete-btn">Cancel</button>
            </div>
        </div>
    </div>

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
<<<<<<< Updated upstream
<<<<<<< Updated upstream
                        <div class="footer-icon-img">
                            <img src="img/footer-icon.png" alt="">
                        </div>
                        
=======
=======
>>>>>>> Stashed changes
                        <div class="copyright">
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | FlexiGym
                        </div>
>>>>>>> Stashed changes
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

    <!-- Add this script at the end of your file, before the closing body tag -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get container for custom plans
            const customPlansContainer = document.getElementById('custom-plans-container');
            const modal = document.getElementById('editPlanModal');
            const deleteModal = document.getElementById('deleteConfirmModal');
            const closeModal = document.querySelector('.close-modal');
            const editForm = document.getElementById('editPlanForm');
            const successToast = document.getElementById('deleteSuccessToast');
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
            const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
            
            // Current plan ID to delete
            let currentDeletePlanId = null;
            
            // Close modal when clicking the X
            closeModal.onclick = function() {
                modal.style.display = "none";
            }
            
            // Close modal when clicking outside of it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
                if (event.target == deleteModal) {
                    deleteModal.style.display = "none";
                }
            }
            
            // Cancel delete button click
            cancelDeleteBtn.addEventListener('click', function() {
                deleteModal.style.display = "none";
            });
            
            // Confirm delete button click
            confirmDeleteBtn.addEventListener('click', function() {
                if (currentDeletePlanId !== null) {
                    // Get existing plans
                    let plans = JSON.parse(localStorage.getItem('flexigymPlans')) || [];
                    
                    // Filter out the plan to delete
                    plans = plans.filter(plan => plan.id !== currentDeletePlanId);
                    
                    // Save updated plans back to localStorage
                    localStorage.setItem('flexigymPlans', JSON.stringify(plans));
                    
                    // Show success message
                    showSuccessToast();
                    
                    // Refresh the display
                    displayPlans();
                    
                    // Hide the confirmation modal
                    deleteModal.style.display = "none";
                }
            });
            
            // Function to display plans
            function displayPlans() {
                // Get plans from localStorage
                const plans = JSON.parse(localStorage.getItem('flexigymPlans')) || [];
                
                // Clear current content
                customPlansContainer.innerHTML = '';
                
                if (plans.length === 0) {
                    // Display message if no custom plans
                    customPlansContainer.innerHTML = '<div class="col-lg-12"><div class="no-plans">No custom plans available yet. Be the first to <a href="create-plan.html">create your own fitness plan!</a></div></div>';
                } else {
                    // Display each plan
                    plans.forEach(plan => {
                        const planHtml = `
                        <div class="col-lg-4 col-md-6">
                            <div class="pricing-item">
                                <div class="pricing-header">
                                    <h3>${plan.name}</h3>
                                </div>
                                <div class="pricing-body">
                                    <div class="price">
                                        <h2>$${plan.amount}</h2>
                                        <span>/${plan.duration} weeks</span>
                                    </div>
                                    <p>${plan.description}</p>
                                    <p><small><i class="fa fa-calendar"></i> Created: ${plan.date}</small>
                                    ${plan.lastUpdated ? `<small><br><i class="fa fa-refresh"></i> Updated: ${plan.lastUpdated}</small>` : ''}
                                    </p>
                                </div>
                                <div class="pricing-footer">
                                    <a href="payment.html?plan=${encodeURIComponent(plan.name)}&price=${plan.amount}" class="primary-btn">Choose Plan</a>
                                    <div class="action-buttons">
                                        <button class="edit-btn" data-id="${plan.id}"><i class="fa fa-pencil"></i> Edit</button>
                                        <button class="delete-btn" data-id="${plan.id}"><i class="fa fa-trash"></i> Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                        
                        customPlansContainer.innerHTML += planHtml;
                    });
                    
                    // Add event listeners to delete buttons
                    document.querySelectorAll('.delete-btn').forEach(button => {
                        button.addEventListener('click', function() {
                            const planId = Number(this.getAttribute('data-id'));
                            deletePlan(planId);
                        });
                    });
                    
                    // Add event listeners to edit buttons
                    document.querySelectorAll('.edit-btn').forEach(button => {
                        button.addEventListener('click', function() {
                            const planId = Number(this.getAttribute('data-id'));
                            openEditModal(planId);
                        });
                    });
                }
            }
            
            // Function to delete a plan
            function deletePlan(planId) {
                // Set the current plan ID to delete
                currentDeletePlanId = planId;
                
                // Show the delete confirmation modal
                deleteModal.style.display = "flex";
            }
            
            // Function to show success toast
            function showSuccessToast() {
                successToast.classList.add('show');
                
                // Hide the toast after 3 seconds
                setTimeout(function() {
                    successToast.classList.remove('show');
                }, 3000);
            }
            
            // Function to open edit modal and populate with plan data
            function openEditModal(planId) {
                // Get existing plans
                const plans = JSON.parse(localStorage.getItem('flexigymPlans')) || [];
                
                // Find the plan to edit
                const plan = plans.find(p => p.id === planId);
                
                if (plan) {
                    // Populate the form
                    document.getElementById('edit-plan-id').value = plan.id;
                    document.getElementById('edit-plan-name').value = plan.name;
                    document.getElementById('edit-plan-description').value = plan.description;
                    document.getElementById('edit-plan-duration').value = plan.duration;
                    document.getElementById('edit-plan-amount').value = plan.amount;
                    
                    // Show the modal
                    modal.style.display = "block";
                }
            }
            
            // Handle form submission for editing
            editForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const planId = Number(document.getElementById('edit-plan-id').value);
                const planName = document.getElementById('edit-plan-name').value;
                const planDescription = document.getElementById('edit-plan-description').value;
                const planDuration = document.getElementById('edit-plan-duration').value;
                const planAmount = document.getElementById('edit-plan-amount').value;
                
                // Get existing plans
                let plans = JSON.parse(localStorage.getItem('flexigymPlans')) || [];
                
                // Find and update the plan
                const planIndex = plans.findIndex(p => p.id === planId);
                
                if (planIndex !== -1) {
                    plans[planIndex] = {
                        ...plans[planIndex],  // Keep existing properties like date, id
                        name: planName,
                        description: planDescription,
                        duration: planDuration,
                        amount: planAmount,
                        lastUpdated: new Date().toLocaleDateString()
                    };
                    
                    // Save updated plans back to localStorage
                    localStorage.setItem('flexigymPlans', JSON.stringify(plans));
                    
                    // Hide modal
                    modal.style.display = "none";
                    
                    // Refresh the display
                    displayPlans();
                }
            });
            
            // Initial display of plans
            displayPlans();
        });
    </script>
</body>
</html>
