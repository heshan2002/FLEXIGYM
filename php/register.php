<?php
session_start();
include "database.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $height = $_POST["height"];
    $weight = $_POST["weight"];
    $body_fat = $_POST["body_fat"];
    $muscle_mass = $_POST["muscle_mass"];
    $fitness_level = $_POST["fitness_level"];
    $fitness_goal = $_POST["fitness_goal"];
    $workout_time = $_POST["workout_time"];
    $equipment_available = $_POST["equipment_available"];
    $trainer_preference = $_POST["trainer_preference"];
    $relationship = $_POST["relationship"];
    
    
    $role = "member";

    
    $check_email_query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_email_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        echo "<script>alert('Email already registered! Please use another email.'); window.location.href='../SignUp.html';</script>";
        exit();
    }
    
    
    $insert_query = "INSERT INTO users (full_name, email, phone, password, dob, gender, height, weight, body_fat, muscle_mass, fitness_level, fitness_goal, workout_time, equipment_available, trainer_preference, relationship, role, registered_at) 
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("ssssssddddsssssss", $full_name, $email, $phone, $password, $dob, $gender, $height, $weight, $body_fat, $muscle_mass, $fitness_level, $fitness_goal, $workout_time, $equipment_available, $trainer_preference, $relationship);
    
    if ($stmt->execute()) {
        echo "<script>alert('Registration successful! Please log in.'); window.location.href='../Login.html';</script>";
    } else {
        echo "<script>alert('Error: Unable to register.'); window.location.href='../SignUp.html';</script>";
    }
    
    $stmt->close();
    $conn->close();
}
?>
