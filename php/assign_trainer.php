<?php
include 'database.php';

$member_id = $_POST['member_id'];
$trainer_id = $_POST['trainer_id'];

$sql = "UPDATE members SET assigned_trainer_id = ? WHERE member_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $trainer_id, $member_id);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error";
}

$conn->close();
?>
