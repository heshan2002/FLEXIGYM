<?php
//-----------------------Add New Trainer---------------------------------------------//

 if(isset($_POST["add_trainer"])) {

    $t_name = mysqli_real_escape_string($conn, $_POST['tName']);
    $t_email = mysqli_real_escape_string($conn, $_POST['tEmail']);
    $t_specialty = mysqli_real_escape_string($conn, $_POST['tSpecialty']);
    $t_years = mysqli_real_escape_string($conn, $_POST['tYears']);
    // $t_profilePic = mysqli_real_escape_string($conn, $_POST['tPic']);

    $sql= "INSERT INTO trainers (name, email, specialty, experience_years) VALUES ('$t_name', '$t_email', '$t_specialty', '$t_years')";
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