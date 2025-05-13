<?php
session_start();
require("php/database.php");

// Check if user is logged in and has a successful subscription
if (!isset($_SESSION["user_id"]) || !isset($_SESSION['subscription_success'])) {
    header("Location: MembershipPlans.php");
    exit();
}

$plan_name = $_SESSION['plan_name'];
$expiry_date = $_SESSION['expiry_date'];

// Clear the session variables once used
unset($_SESSION['subscription_success']);
unset($_SESSION['plan_name']);
unset($_SESSION['expiry_date']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Confirmed | FlexiGym</title>
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,300i,400,500,700,900" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <style>
        .success-container {
            max-width: 700px;
            margin: 120px auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 30px rgba(0,0,0,0.1);
            text-align: center;
        }
        .success-icon {
            color: #36b37e;
            font-size: 80px;
            margin-bottom: 30px;
        }
        .success-title {
            color: #333;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .success-message {
            color: #555;
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .plan-details {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }
        .plan-name {
            color: #f36100;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .buttons {
            margin-top: 30px;
        }
        .btn-dashboard {
            display: inline-block;
            background: #f36100;
            color: white;
            padding: 12px 30px;
            border-radius: 30px;
            margin: 0 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
            text-decoration: none;
        }
        .btn-dashboard:hover {
            background: #e55a00;
            text-decoration: none;
            color: white;
        }
        .btn-workouts {
            display: inline-block;
            background: #212122;
            color: white;
            padding: 12px 30px;
            border-radius: 30px;
            margin: 0 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
            text-decoration: none;
        }
        .btn-workouts:hover {
            background: #333;
            text-decoration: none;
            color: white;
        }
    </style>
</head>
<body>
   
    
    <div class="success-container">
        <div class="success-icon">
            <i class="fa fa-check-circle"></i>
        </div>
        
        <h1 class="success-title">Subscription Confirmed!</h1>
        
        <p class="success-message">
            Thank you for subscribing to FlexiGym. Your membership has been successfully activated.
        </p>
        
        <div class="plan-details">
            <div class="plan-name"><?php echo htmlspecialchars($plan_name); ?> Plan</div>
            <p>Valid until: <strong><?php echo date('F j, Y', strtotime($expiry_date)); ?></strong></p>
        </div>
        
        <p>You now have access to all the features and benefits of your membership plan. Start your fitness journey with FlexiGym today!</p>
        
        <div class="buttons">
            <a href="UserProfile.php" class="btn-dashboard">My Profile</a>
            <a href="Trainers.php" class="btn-workouts">Start Workouts</a>
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
