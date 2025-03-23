<?php
session_start();
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();

        if (password_verify($password, $user_data["password"])) {
            $_SESSION["user_id"] = $user_data["user_id"];
            $_SESSION["role"] = $user_data["role"];

            if ($user_data["role"] == "admin") {
                header("Location: ../AdminDashboard.html"); 
            } elseif ($user_data["role"] == "trainer") {
                header("Location: ../trainerhome.html"); 
            } else {
                header("Location: ../index.html"); 
            }
            exit();
        }
    }

    echo "<script>alert('Invalid email or password'); window.history.back();</script>";
}

$conn->close();
?>
