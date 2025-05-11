<?php
include 'database.php';

$sql = "SELECT * FROM membership_plans ORDER BY plan_id DESC";
$result = $conn->query($sql);

$plans = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $plans[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($plans);

$conn->close();
?>
