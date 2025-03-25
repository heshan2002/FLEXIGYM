<?php

//-----------------------Delete Member---------------------------------------------//

 if(isset($_GET["delete_memberId"])) {

    $delete_memberId = mysqli_real_escape_string($conn, $_GET['delete_memberId']);

    $sql = "DELETE FROM users WHERE user_id = '$delete_memberId'";
    $result = mysqli_query($conn,$sql);

    if ($result) {
     
        header('location: AdminMembers.php');

    } 
    else {
        echo "<script>alert('Sorry! You Can Not Delete This Member')</script>";
    }
  
 }

 ?>