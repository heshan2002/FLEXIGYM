<?php
include 'database.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $plan_id = $_GET['id'];
    
    $sql = "SELECT * FROM membership_plans WHERE plan_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $plan_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $plan = $result->fetch_assoc();
        header('Content-Type: application/json');
        echo json_encode($plan);
    } else {
        echo json_encode(['error' => 'Plan not found']);
    }
    
    $stmt->close();
} else {
    echo json_encode(['error' => 'Invalid plan ID']);
}

$conn->close();
?>
