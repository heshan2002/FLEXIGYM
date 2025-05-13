<?php
session_start();
include("database.php"); // change this to your DB connection file
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Assign Trainer | Admin</title>
<link rel="stylesheet" href="css/AdminDashboard.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://kit.fontawesome.com/dc4ee3e80e.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/AdminworkoutT.css">
<link rel="stylesheet" href="css/Adminassigntrainer.css">
</head>

<body class="adminDashboard">

<div class="adminnav">
  <h3><center>Admin</center></h3>
  <h3 style='color:#397FFF;'><center>FLEXIGYM</center></h3>
  <center><hr style="width:90%;text-align:center;margin-left:0"></center>
  <a href="AdminDashboard.php"><i class='fas fa-house-user' style='margin: 15px 10px 15px 15px;'></i>Dashboard</a>
  <a href="AdminMembers.php"><i class='fa fa-users' style='margin: 15px 10px 15px 15px;'></i>Members</a>
  <a href="AdminTrainers.php"><i class="fa fa-user-tie" style="margin: 15px 10px 15px 15px;"></i>Trainers</a>
  <a href="Adminworkout.php"><i class='fa fa-dumbbell' style='margin: 15px 10px 15px 15px;'></i>Workouts</a>
  <a href="Adminassigntrainer.php"><i class='fa fa-user' style='margin: 15px 10px 15px 15px;'></i>Assign Trainers</a>
  <a href="createplan.php"><i class='fa fa-book' style='margin: 15px 10px 15px 15px;'></i>Plans</a>
</div>

<div class="adminmain">
  <div class="row-ad3">
    <h2 class="header-title">Admin Dashboard</h2>
    <div class="header-right">
      <button class="logout-btn"><a href="#">Log Out</a></button>
      <img src="./img/Admin.jpg" class="Profile-img" alt="Admin" width="70" height="70" style="clip-path: circle(50%);">
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
        <?php
        // Fetch all trainers
        $trainerQuery = "SELECT * FROM trainers";
        $trainerResult = mysqli_query($conn, $trainerQuery);

        while ($trainer = mysqli_fetch_assoc($trainerResult)) {
            $trainerId = $trainer['trainer_id'];

            // Check if trainer is already assigned
            $assignmentQuery = "SELECT * FROM trainer_assignments WHERE trainer_id = $trainerId";
            $assigned = mysqli_query($conn, $assignmentQuery);
            $assignedRow = mysqli_fetch_assoc($assigned);
            $assignedStatus = $assignedRow ? "Assigned" : "Available";

            echo "<tr>";
            echo "<td>{$assignedStatus}</td>";
            echo "<td>{$trainer['name']}</td>";
            echo "<td>{$trainer['email']}</td>";
            echo "<td>{$trainer['specialty']}</td>";
            echo "<td><a href='deletetrainer.php?id={$trainerId}' onclick=\"return confirm('Are you sure?')\">Delete</a></td>";

            if ($assignedRow) {
                // Show assigned member name
                $memberId = $assignedRow['member_id'];
                $memberQuery = "SELECT full_name FROM users WHERE id = $memberId";
                $memberResult = mysqli_query($conn, $memberQuery);
                $memberName = mysqli_fetch_assoc($memberResult)['full_name'];
                echo "<td>$memberName</td>";
            } else {
                echo "<td><button class='assign-btn' data-trainerid='{$trainerId}'>Assign</button></td>";
            }

            echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Popup for selecting a member -->
  <div class="popup" id="popup">
    <div class="popup-content">
      <h3>Select a Member</h3>
      <ul id="memberList">
        <?php
        // List only members with a membership
        $memberQuery = "
            SELECT u.id, u.full_name
            FROM users u
            INNER JOIN membership m ON u.id = m.member_id
        ";
        $members = mysqli_query($conn, $memberQuery);
        while ($member = mysqli_fetch_assoc($members)) {
            echo "<li data-memberid='{$member['id']}'>{$member['full_name']}</li>";
        }
        ?>
      </ul>
      <button class="close-btn" onclick="document.getElementById('popup').style.display='none'">Close</button>
    </div>
  </div>

</div> <!-- End of adminmain -->

<script src="js/Adminassigntrainer.js"></script>
</body>
</html>
