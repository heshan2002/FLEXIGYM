<?php
//-----------------------Add New Trainer---------------------------------------------//

 if(isset($_POST["add_trainer"])) {

    $t_name = mysqli_real_escape_string($conn, $_POST['tName']);
    $t_email = mysqli_real_escape_string($conn, $_POST['tEmail']);
    $t_specialty = mysqli_real_escape_string($conn, $_POST['tSpecialty']);
    $t_years = mysqli_real_escape_string($conn, $_POST['tYears']);


    // File Upload Handling
    $targetDir = "img/trainer/"; // Folder to store uploaded images
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true); // Create folder if it doesn't exist
    }

    $fileName = time() . "_" . basename($_FILES["fileToUpload"]["name"]); // Avoid duplicate names
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Allowed file formats
    $allowedTypes = ["jpg", "jpeg", "png", "gif"];

    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFilePath)) {
            echo "File uploaded successfully!";
        } else {
            echo "Error uploading the file.";
            exit();
        }
    } else {
        echo "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
        exit();
    }

    $sql= "INSERT INTO trainers (name, email, specialty, experience_years, profile_picture) VALUES ('$t_name', '$t_email', '$t_specialty', '$t_years', '$fileName')";
    $result = mysqli_query($conn,$sql);

    if ($result) {

        echo "<script>alert('Add New Trainer is Successful')</script>";
        header('location: AdminTrainers.php');

    } 
    else {
        echo "<script>alert('Sorry! Add New Trainer is Unsuccessful')</script>";
    }
  
 }

 
 //-----------------------Delete Trainer---------------------------------------------//

 if(isset($_GET["delete_trainerId"])) {

    $delete_trainerID = mysqli_real_escape_string($conn, $_GET['delete_trainerId']);

    $sql = "DELETE FROM trainers WHERE trainer_id = '$delete_trainerID'";
    $result = mysqli_query($conn,$sql);

    if ($result) {
     
        header('location: AdminTrainers.php');

    } 
    else {
        echo "<script>alert('Sorry! You Can Not Delete This Trainer')</script>";
    }
  
 }

 ?>