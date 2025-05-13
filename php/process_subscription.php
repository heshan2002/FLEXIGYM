<?php
session_start();
require("database.php");

// Check if user is logged in and is a member
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "member") {
    header("Location: ../Login.php");
    exit();
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST['plan_id'])) {
    header("Location: ../MembershipPlans.php");
    exit();
}

$plan_id = (int)$_POST['plan_id'];
$user_id = $_SESSION["user_id"];

// Get plan details
$sql = "SELECT * FROM membership_plans WHERE plan_id = ? AND status = 'active'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $plan_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['subscription_error'] = "The selected plan is not available.";
    header("Location: ../MembershipPlans.php");
    exit();
}

$plan = $result->fetch_assoc();

// Sample payment processing (in a real app, you would integrate with a payment gateway)
// For this demo, we'll simulate a successful payment
$payment_successful = true;

if ($payment_successful) {
    // Calculate expiry date based on plan duration
    $expiry_date = date('Y-m-d', strtotime('+' . $plan['duration_months'] . ' months'));
    
    // Check if user already has a membership
    $checkSql = "SELECT * FROM memberships WHERE user_id = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("i", $user_id);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    
    if ($checkResult->num_rows > 0) {
        // Update existing membership
        $updateSql = "UPDATE memberships SET 
                    plan = ?,
                    amount_paid = ?,
                    payment_status = 'completed',
                    expiry_date = ?
                    WHERE user_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("sdsi", $plan['plan_name'], $plan['price'], $expiry_date, $user_id);
        
        if ($updateStmt->execute()) {
            // Redirect to success page
            $_SESSION['subscription_success'] = true;
            $_SESSION['plan_name'] = $plan['plan_name'];
            $_SESSION['expiry_date'] = $expiry_date;
            header("Location: ../subscription_success.php");
            exit();
        } else {
            $_SESSION['subscription_error'] = "Failed to update your membership. Please try again.";
            header("Location: ../MembershipPlans.php");
            exit();
        }
    } else {
        // Create new membership
        $insertSql = "INSERT INTO memberships (user_id, plan, amount_paid, payment_status, expiry_date) 
                    VALUES (?, ?, ?, 'completed', ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("isds", $user_id, $plan['plan_name'], $plan['price'], $expiry_date);
        
        if ($insertStmt->execute()) {
            // Redirect to success page
            $_SESSION['subscription_success'] = true;
            $_SESSION['plan_name'] = $plan['plan_name'];
            $_SESSION['expiry_date'] = $expiry_date;
            header("Location: ../subscription_success.php");
            exit();
        } else {
            $_SESSION['subscription_error'] = "Failed to create your membership. Please try again.";
            header("Location: ../MembershipPlans.php");
            exit();
        }
    }
} else {
    // Payment failed
    $_SESSION['subscription_error'] = "Payment processing failed. Please try again.";
    header("Location: ../subscribe.php?plan_id=" . $plan_id);
    exit();
}
?>
