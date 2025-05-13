<?php
session_start();
require("php/database.php");

$user_role = isset($_SESSION["role"]) ? $_SESSION["role"] : "guest";
$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;

// Get all active plans
$sql = "SELECT * FROM membership_plans WHERE status = 'active' ORDER BY price ASC";
$result = $conn->query($sql);

$plans = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $plans[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="FlexiGym Membership Plans">
    <meta name="keywords" content="FlexiGym, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Membership Plans | FlexiGym</title>

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
    <link rel="stylesheet" href="css/plans.css" type="text/css">
    <style>
        .membership-item {
            border-radius: 15px;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 40px;
            overflow: hidden;
            position: relative;
            background: #fff;
            border: 1px solid rgba(0,0,0,0.05);
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .membership-item:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 35px rgba(0,0,0,0.15);
        }
        
        .membership-title {
            background: linear-gradient(135deg, #f36100, #ff9d58);
            padding: 30px 20px;
            color: #fff;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .membership-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 100%;
            height: 20px;
            background: #fff;
            border-radius: 50% 50% 0 0;
            opacity: 0.1;
        }
        
        .membership-title h4 {
            color: #fff;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }
        
        .membership-price {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .membership-price h2 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 0;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        
        .membership-price span {
            font-size: 16px;
            opacity: 0.9;
            margin-top: 5px;
        }
        
        .membership-desc {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 1px solid #f0f0f0;
            font-size: 15px;
            color: #666;
            line-height: 1.6;
        }
        
        .membership-benefits {
            padding: 20px 25px;
            list-style: none;
            margin: 0;
            flex-grow: 1;
        }
        
        .membership-benefits li {
            padding: 10px 0;
            display: flex;
            align-items: flex-start;
            color: #555;
            font-size: 15px;
            border-bottom: 1px dashed rgba(0,0,0,0.07);
        }
        
        .membership-benefits li:last-child {
            border-bottom: none;
        }
        
        .membership-benefits .fa {
            color: #f36100;
            margin-right: 12px;
            margin-top: 5px;
            font-size: 16px;
        }
        
        .membership-btn {
            display: block;
            margin: 10px 20px 25px;
            text-align: center;
            border-radius: 30px;
            padding: 12px 20px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(243, 97, 0, 0.2);
        }
        
        .membership-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(243, 97, 0, 0.3);
        }
        
        .recommended-badge {
            position: absolute;
            top: 0;
            right: 0;
            background: #f36100;
            color: white;
            padding: 8px 30px;
            font-size: 14px;
            font-weight: bold;
            transform: rotate(45deg) translate(22%, -10%);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            z-index: 1;
            letter-spacing: 1px;
        }
        
        .section-title {
            margin-bottom: 60px;
        }
        
        .section-title h2 {
            position: relative;
            display: inline-block;
            padding-bottom: 20px;
            font-size: 36px;
            font-weight: 700;
        }
        
        .section-title h2:after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(to right, #f36100, #ff9d58);
            border-radius: 2px;
        }
        
        .section-title p {
            font-size: 18px;
            color: #666;
            margin-top: 20px;
        }
        
        .membership-section {
            padding: 100px 0;
            background-color: #f8f9fa;
        }
        
        .callto-section {
            padding: 100px 0;
        }
        
        .callto-text h2 {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #fff;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
        }
        
        .callto-text p {
            font-size: 18px;
            color: rgba(255,255,255,0.9);
            margin-bottom: 30px;
        }
        
        .callto-btn {
            font-size: 16px;
            padding: 15px 30px;
            font-weight: 600;
            letter-spacing: 1px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            transition: all 0.3s;
        }
        
        .callto-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        }
        
        @media (max-width: 991px) {
            .membership-item {
                margin-bottom: 30px;
            }
            
            .section-title h2 {
                font-size: 32px;
            }
            
            .callto-text h2 {
                font-size: 36px;
            }
        }
        
        @media (max-width: 767px) {
            .membership-section {
                padding: 70px 0;
            }
            
            .section-title {
                margin-bottom: 40px;
            }
            
            .section-title h2 {
                font-size: 28px;
            }
            
            .callto-text h2 {
                font-size: 30px;
            }
        }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <!-- Header Section Begin -->

    <?php include('includes/header.php'); ?>
    <!-- Header End -->
   
    

    <!-- Membership Plans Section Begin -->
    <section class="membership-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Choose Your Membership Plan</h2>
                        <p>FlexiGym offers a variety of membership plans to fit your needs and goals.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php 
                $planCount = 0;
                foreach ($plans as $plan): 
                    $isRecommended = ($planCount === 1); // Mark the middle plan as recommended
                    $planCount++;
                ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="membership-item">
                            <?php if ($isRecommended): ?>
                                <span class="recommended-badge">POPULAR</span>
                            <?php endif; ?>
                            <div class="membership-title">
                                <h4><?php echo htmlspecialchars($plan['plan_name']); ?></h4>
                                <div class="membership-price">
                                    <h2>LKR <?php echo number_format($plan['price'], 2); ?></h2>
                                    <span>/ <?php echo $plan['duration_months']; ?> <?php echo $plan['duration_months'] > 1 ? 'months' : 'month'; ?></span>
                                </div>
                            </div>
                            <div class="membership-desc">
                                <p><?php echo htmlspecialchars($plan['description']); ?></p>
                            </div>
                            <ul class="membership-benefits">
                                <?php 
                                $benefitsArray = explode(',', $plan['benefits']);
                                foreach ($benefitsArray as $benefit): 
                                ?>
                                    <li><i class="fa fa-check"></i> <?php echo htmlspecialchars(trim($benefit)); ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <?php if ($user_role === "member"): ?>
                                <a href="subscribe.php?plan_id=<?php echo $plan['plan_id']; ?>" class="primary-btn membership-btn">Activate Plan</a>
                            <?php elseif ($user_role === "guest"): ?>
                                <a href="Login.php" class="primary-btn membership-btn">Login to Activate Now</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- Membership Plans Section End -->

    <!-- Membership Call To Action Begin -->
    <section class="callto-section set-bg" data-setbg="img/callto-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="callto-text">
                        <h2>Join Today and Transform Your Body</h2>
                        <p>Start your fitness journey with FlexiGym and see results in no time.</p>
                        <a href="<?php echo $user_role === 'member' ? '#' : 'SignUp.php'; ?>" class="primary-btn callto-btn">
                            <?php echo $user_role === 'member' ? 'View Your Profile' : 'Sign Up Now'; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Membership Call To Action End -->

    <!-- Footer Section Begin -->
    <?php include('includes/footer.php'); ?>
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