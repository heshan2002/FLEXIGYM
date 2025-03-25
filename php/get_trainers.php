<?php
include 'database.php'; // Connect to DB

$sql = "SELECT trainer_id, name, email, specialty, availability FROM trainers";
$result = $conn->query($sql);

$trainers = [];
while ($row = $result->fetch_assoc()) {
    $trainers[] = $row;
}

echo json_encode($trainers);
$conn->close();
?>
