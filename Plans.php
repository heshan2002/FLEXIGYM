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
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            overflow: hidden;
            position: relative;
            background: #fff;
        }
        
        .membership-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        
        .membership-title {
            background: linear-gradient(to right, #f36100, #ff9d58);
            padding: 25px 20px;
            color: #fff;
            text-align: center;
        }
        
        .membership-title h4 {
            color: #fff;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .membership-price {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .membership-price h2 {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 0;
            color: #fff;
        }
        
        .membership-desc {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }
        
        .membership-benefits {
            padding: 20px;
            list-style: none;
        }
        
        .membership-benefits li {
            padding: 8px 0;
            display: flex;
            align-items: flex-start;
        }
        
        .membership-benefits .fa {
            color: #f36100;
            margin-right: 10px;
            margin-top: 5px;
        }
        
        .membership-btn {
            display: block;
            margin: 15px 20px 25px;
            text-align: center;
            border-radius: 30px;
            transition: all 0.3s;
        }
        
        .recommended-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #f36100;
            color: white;
            padding: 5px 15px;
            font-size: 14px;
            font-weight: bold;
            transform: rotate(45deg) translate(15px, -15px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            z-index: 1;
        }
        
        .section-title h2 {
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
        }
        
        .section-title h2:after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            width: 60%;
            height: 3px;
            background: #f36100;
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
                                <a href="subscribe.php?plan_id=<?php echo $plan['plan_id']; ?>" class="primary-btn membership-btn">Subscribe Now</a>
                            <?php elseif ($user_role === "guest"): ?>
                                <a href="Login.php" class="primary-btn membership-btn">Login to Subscribe</a>
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