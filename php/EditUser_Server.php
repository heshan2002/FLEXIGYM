<?php
require("database.php");

// Check if session is not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//--------------------------------Update User---------------------------------------------------//
if(isset($_POST["update_user"])) {
    $user_id = $_SESSION['user_id'];
    
    // Get and sanitize form data
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $height = mysqli_real_escape_string($conn, $_POST['height']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $body_fat = mysqli_real_escape_string($conn, $_POST['body_fat']);
    $muscle_mass = mysqli_real_escape_string($conn, $_POST['muscle_mass']);
    $fitness_level = mysqli_real_escape_string($conn, $_POST['fitness_level']);
    $workout_time = mysqli_real_escape_string($conn, $_POST['workout_time']);

    // Validate required fields
    if(empty($full_name) || empty($email) || empty($phone)) {
        $_SESSION['error'] = "Please fill in all required fields";
        header('location: ../UserProfile.php');
        exit();
    }

    // Update query
    $sql = "UPDATE users SET 
            full_name = '$full_name',
            email = '$email',
            phone = '$phone',
            dob = '$dob',
            gender = '$gender',
            height = '$height',
            weight = '$weight',
            body_fat = '$body_fat',
            muscle_mass = '$muscle_mass',
            fitness_level = '$fitness_level',
            workout_time = '$workout_time'
            WHERE user_id = '$user_id'";
            
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Update session email if it was changed
        if($_SESSION['email'] != $email) {
            $_SESSION['email'] = $email;
        }
        $_SESSION['success'] = "Profile updated successfully!";
    } else {
        $_SESSION['error'] = "Error updating profile: " . mysqli_error($conn);
    }
    
    header('location: ../UserProfile.php');
    exit();
}
?>