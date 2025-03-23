<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"];
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
    $fitness_goal = isset($_POST["fitness_goal"]) ? $_POST["fitness_goal"] : "General Fitness";  
    $workout_time = $_POST["workout_time"];
    $equipment_available = $_POST["equipment_available"];
    $trainer_preference = $_POST["trainer_preference"];

    
    $check_email = "SELECT email FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_email);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        echo "<script>alert('Email already exists! Try a different one.'); window.history.back();</script>";
        exit();
    }

    
    $sql = "INSERT INTO users (full_name, email, phone, password, dob, gender, height, weight, body_fat, muscle_mass, fitness_level, fitness_goal, workout_time, equipment_available, trainer_preference, role) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'member')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssdddssssss", $fullname, $email, $phone, $password, $dob, $gender, $height, $weight, $body_fat, $muscle_mass, $fitness_level, $fitness_goal, $workout_time, $equipment_available, $trainer_preference);

    if ($stmt->execute()) {
        echo "<script>alert('Registration Successful!'); window.location='../Login.html';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
