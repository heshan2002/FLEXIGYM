<?php
session_start();
require("php/database.php");

// Check if user is logged in and is a member
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "member") {
    header("Location: Login.php");
    exit();
}

// Get the plan ID from URL
if (!isset($_GET['plan_id']) || !is_numeric($_GET['plan_id'])) {
    header("Location: MembershipPlans.php");
    exit();
}

$plan_id = (int)$_GET['plan_id'];
$user_id = $_SESSION["user_id"];

// Get plan details
$sql = "SELECT * FROM membership_plans WHERE plan_id = ? AND status = 'active'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $plan_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: MembershipPlans.php");
    exit();
}

$plan = $result->fetch_assoc();

// Check if user already has an active membership
$checkSql = "SELECT * FROM memberships WHERE user_id = ?";
$checkStmt = $conn->prepare($checkSql);
$checkStmt->bind_param("i", $user_id);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();
$hasMembership = ($checkResult->num_rows > 0);
$existingMembership = $hasMembership ? $checkResult->fetch_assoc() : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Subscribe to <?php echo htmlspecialchars($plan['plan_name']); ?> membership plan at FlexiGym">
    <meta name="keywords" content="gym, fitness, membership, subscription, <?php echo htmlspecialchars($plan['plan_name']); ?>, FlexiGym">
    <meta name="author" content="FlexiGym">
    
    <!-- Open Graph / Social Media Meta Tags -->
    <meta property="og:title" content="Subscribe to <?php echo htmlspecialchars($plan['plan_name']); ?> Plan | FlexiGym">
    <meta property="og:description" content="Join our <?php echo htmlspecialchars($plan['plan_name']); ?> membership plan at FlexiGym">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">
    
    <title>Subscribe to <?php echo htmlspecialchars($plan['plan_name']); ?> Plan | FlexiGym</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,300i,400,500,700,900" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <style>
        .subscription-container {
            max-width: 800px;
            margin: 100px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 30px rgba(0,0,0,0.1);
        }
        .plan-details {
            background: linear-gradient(to right, #f36100, #ff9d58);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        .plan-name {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .plan-price {
            font-size: 36px;
            font-weight: 700;
        }
        .plan-duration {
            font-size: 16px;
            margin-bottom: 15px;
        }
        .plan-description {
            margin-bottom: 15px;
            line-height: 1.6;
        }
        .payment-details {
            margin-top: 30px;
        }
        .form-group {
            margin-bottom: 25px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .payment-btn {
            background: #f36100;
            border: none;
            color: white;
            padding: 15px 30px;
            border-radius: 30px;
            cursor: pointer;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 20px;
            transition: all 0.3s;
        }
        .payment-btn:hover {
            background: #e55a00;
        }
        .benefits-list {
            padding-left: 20px;
        }
        .benefits-list li {
            margin-bottom: 8px;
            list-style-type: none;
            position: relative;
        }
        .benefits-list li:before {
            content: "✓";
            color: #f36100;
            position: absolute;
            left: -20px;
        }
        .back-btn {
            background: transparent;
            border: 2px solid #f36100;
            color: #f36100;
            padding: 10px 20px;
            border-radius: 30px;
            cursor: pointer;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
            transition: all 0.3s;
            display: inline-block;
            text-decoration: none;
        }
        .back-btn:hover {
            background: #f36100;
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    
    
    <div class="subscription-container">
        <a href="MembershipPlans.php" class="back-btn"><i class="fa fa-arrow-left"></i> Back to Plans</a>
        
        <h2 class="text-center mb-4">Subscribe to Membership Plan</h2>
        
        <div class="plan-details">
            <div class="row">
                <div class="col-md-8">
                    <div class="plan-name"><?php echo htmlspecialchars($plan['plan_name']); ?> Plan</div>
                    <div class="plan-duration"><?php echo $plan['duration_months']; ?> <?php echo $plan['duration_months'] > 1 ? 'months' : 'month'; ?> membership</div>
                    <div class="plan-description"><?php echo htmlspecialchars($plan['description']); ?></div>
                </div>
                <div class="col-md-4 text-right">
                    <div class="plan-price">LKR <?php echo number_format($plan['price'], 2); ?></div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <h4>Plan Benefits:</h4>
                <ul class="benefits-list">
                    <?php 
                    $benefits = explode(',', $plan['benefits']);
                    foreach ($benefits as $benefit): 
                    ?>
                        <li><?php echo htmlspecialchars(trim($benefit)); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <div class="col-md-6">
                <div class="payment-details">
                    <h4><?php echo $hasMembership ? 'Update Your Membership' : 'Complete Your Subscription'; ?></h4>
                    
                    <?php if ($hasMembership): ?>
                        <div class="alert alert-info">
                            You currently have a <?php echo htmlspecialchars($existingMembership['plan']); ?> membership valid until <?php echo htmlspecialchars($existingMembership['expiry_date']); ?>. 
                            Subscribing to this plan will update your current membership.
                        </div>
                    <?php endif; ?>
                    
                    <form action="php/process_subscription.php" method="post">
                        <input type="hidden" name="plan_id" value="<?php echo $plan_id; ?>">
                        
                        <div class="form-group">
                            <label for="card_number">Card Number</label>
                            <input type="text" id="card_number" name="card_number" class="form-control" placeholder="1234 5678 9012 3456" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="expiry_date">Expiry Date</label>
                                    <input type="text" id="expiry_date" name="expiry_date" class="form-control" placeholder="MM/YY" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cvv">CVV</label>
                                    <input type="text" id="cvv" name="cvv" class="form-control" placeholder="123" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="card_holder">Card Holder Name</label>
                            <input type="text" id="card_holder" name="card_holder" class="form-control" placeholder="John Doe" required>
                        </div>
                        
                        <button type="submit" class="payment-btn btn-block">
                            Pay LKR <?php echo number_format($plan['price'], 2); ?> and Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer Section -->
    <?php include('includes/footer.php'); ?>
    
    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
