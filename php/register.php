<?php
session_start();

include "database.php"; 

if (isset($_POST["sign_up"])) {

    $full_name      = mysqli_real_escape_string($conn, $_POST["full_name"]);
    $email          = mysqli_real_escape_string($conn, $_POST["email"]);
    $phone          = mysqli_real_escape_string($conn, $_POST["phone"]);
    $password       = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $dob            = $_POST["dob"];
    $gender         = $_POST["gender"];
    $height         = $_POST["height"];
    $weight         = $_POST["weight"];
    $body_fat       = $_POST["body_fat"];
    $muscle_mass    = $_POST["muscle_mass"];
    $fitness_level  = $_POST["fitness_level"];
    $fitness_goal   = $_POST["fitness_goal"];
    $workout_time   = $_POST["workout_time"];
    $equipment_available    = $_POST["equipment_available"];
    $trainer_preference     = $_POST["trainer_preference"];
    $relationship           = "Other";
    $role                   = "member";

    // Check if the email already exists
    $check_email_query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_email_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        echo "<script>alert('Email already registered! Please use another email.'); window.location.href='../SignUp.php';</script>";
        exit();
    }

    $sql = "INSERT INTO users (full_name, email, phone, password, dob, gender, height, weight, body_fat, muscle_mass, fitness_level, fitness_goal, workout_time, equipment_available, trainer_preference, relationship, role) 
            VALUES ('$full_name', '$email', '$phone', '$password', '$dob', '$gender', $height, $weight, $body_fat, $muscle_mass, '$fitness_level', '$fitness_goal', '$workout_time', '$equipment_available', '$trainer_preference', '$relationship', '$role')";

    $result = mysqli_query($conn,$sql);
    if($result) {
        header ("Location: ../Login.php");
    } else {
        die(mysqli_error($conn));
    }
}


// // Close the connection
mysqli_close($conn);

?>
