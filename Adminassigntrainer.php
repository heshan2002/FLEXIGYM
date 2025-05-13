<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/AdminDashboard.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://kit.fontawesome.com/dc4ee3e80e.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/AdminworkoutT.css">
<link rel="stylesheet" href="css/Adminassigntrainer.css">

</head>

<body class="adminDashboard">    


<div class="adminnav">

  <h3 ><center>Admin</center></h3>
  <h3 style='color:#397FFF;'><center>FLEXIGYM</center></h3>

  <center><hr style="width:90%;text-align:center;margin-left:0"></center>

  <a href="AdminDashboard.php"><i class='fas fa-house-user' style='margin: 15px 10px 15px 15px;'></i>Dashboard</a>
  <a href="AdminMembers.php"><i class='fa fa-users' style='margin: 15px 10px 15px 15px;'></i>Members</a>
  <a href="AdminTrainers.php"><i class="fa fa-user-tie" style="margin: 15px 10px 15px 15px;"></i>Trainers</a>
  <a href="Adminworkout.php"><i class='fa fa-dumbbell' style='margin: 15px 10px 15px 15px;'></i>Workouts</a>
  <a href="Adminassigntrainer.php"><i class='fa fa-user' style='margin: 15px 10px 15px 15px;' ></i>Asign Trainers</a>
  <a href="createplan.php"><i class='fa fa-book' style='margin: 15px 10px 15px 15px;' ></i>Plans</a>
  
 
</div> <!--adminnav-->

<div class="adminmain">
  <div class="row-ad3">
    <h2 class="header-title">Admin Dashboard</h2>
    <div class="header-right">
    <button class="logout-btn"><a href="#">Log Out</a></button>
    <img src="./img/Admin.jpg" class="Profile-img" alt="Paris" width="70" height="70" style="clip-path: circle(50%);">
    </div>
  </div>
  <hr>


  <div class="container">
    <h2>Assign Trainer to Member</h2>
    <table>
        <thead>
            <tr>
                <th>Status</th>
                <th>Name</th>
                <th>Email</th>
                <th>Specialty</th>
                <th>Delete</th>
                <th>Assign</th>
            </tr>
        </thead>
        <tbody>
            <!-- Trainer data will be loaded here dynamically -->
        </tbody>
    </table>
</div>

<!-- Popup for selecting a member -->
<div class="popup" id="popup">
    <div class="popup-content">
        <h3>Select a Member</h3>
        <ul>
            <!-- Member list will be loaded here dynamically -->
        </ul>
        <button class="close-btn" onclick="document.getElementById('popup').style.display='none'">Close</button>
    </div>
</div>

<script src="js/Adminassigntrainer.js"></script>
</body>
</html> 