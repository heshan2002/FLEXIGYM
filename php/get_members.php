<?php
include 'database.php';

$sql = "SELECT member_id, name FROM members WHERE assigned_trainer_id IS NULL";
$result = $conn->query($sql);

$members = [];
while ($row = $result->fetch_assoc()) {
    $members[] = $row;
}

echo json_encode($members);
$conn->close();
?>
