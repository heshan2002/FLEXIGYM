<?php
include 'database.php';
session_start();

// Check if user is admin
if (!isset($_SESSION["email"]) || $_SESSION["role"] !== "admin") {
    echo "unauthorized";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['plan_id'])) {
    $plan_id = (int)$_POST['plan_id'];
    $plan_name = mysqli_real_escape_string($conn, $_POST['plan_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $duration_months = (int)$_POST['duration_months'];
    $price = (float)$_POST['price'];
    $benefits = mysqli_real_escape_string($conn, $_POST['benefits']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    
    // Validate inputs
    if (empty($plan_name) || empty($description) || $duration_months <= 0 || $price < 0) {
        echo "invalid_input";
        exit();
    }
    
    $sql = "UPDATE membership_plans SET 
            plan_name = ?, 
            description = ?, 
            duration_months = ?, 
            price = ?, 
            benefits = ?, 
            status = ? 
            WHERE plan_id = ?";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssidssi", $plan_name, $description, $duration_months, $price, $benefits, $status, $plan_id);
    
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error: " . $stmt->error;
    }
    
    $stmt->close();
} else {
    echo "invalid_request";
}

$conn->close();
?>
