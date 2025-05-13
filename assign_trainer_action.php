<?php
include("db_connection.php");

if (isset($_POST['trainer_id']) && isset($_POST['member_id'])) {
    $trainer_id = intval($_POST['trainer_id']);
    $member_id = intval($_POST['member_id']);

    // Assign trainer
    $query = "INSERT INTO trainer_assignments (trainer_id, member_id) VALUES ($trainer_id, $member_id)";
    if (mysqli_query($conn, $query)) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
