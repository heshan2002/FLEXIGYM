<?php
session_start();
include "database.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        
        if (hash('sha256', $password) === $user["password"] || password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["user_id"];
            $_SESSION["role"] = $user["role"];
            $_SESSION["full_name"] = $user["full_name"];

            
            if ($user["role"] === "admin") {
                header("Location: ../AdminDashboard.html");
            } elseif ($user["role"] === "trainer") {
                header("Location: ../trainerhome.html");
            } else {
                header("Location: ../index.php"); 
            }
            exit();
        } else {
            echo "<script>alert('Invalid Password!');window.location.href='../Login.html';</script>";
        }
    } else {
        echo "<script>alert('User Not Found!');window.location.href='../Login.html';</script>";
    }
}
?>
