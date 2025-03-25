<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $trainer_id = $_POST['trainer_id'];

    if (!empty($trainer_id)) {
        $query = "DELETE FROM trainers WHERE trainer_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $trainer_id);
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "error: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Invalid ID";
    }
}
?>
