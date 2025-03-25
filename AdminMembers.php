<?php
require("php/database.php");

session_start();

if (!isset($_SESSION["email"])) {
  header("location:Login.php");
  exit();
}

?>
<?php include("php/adminMember_server.php"); ?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/AdminMembers.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/dc4ee3e80e.js" crossorigin="anonymous"></script> 
</head>

<body class="adminDashboard">

  <!--Admin Left Side Navigation Bar-->  
  <div class="adminnav">

  <h3 ><center>Admin</center></h3>
  <h3 style='color:#397FFF;'><center>FLEXIGYM</center></h3>

  <center><hr style="width:90%;text-align:center;margin-left:0"></center>

  <a href="AdminDashboard.php"><i class='fas fa-house-user' style='margin: 15px 10px 15px 15px;'></i>Dashboard</a>
  <a href="AdminMembers.php"><i class='fa fa-users' style='margin: 15px 10px 15px 15px;'></i>Members</a>
  <a href="AdminTrainers.php"><i class="fa fa-user-tie" style="margin: 15px 10px 15px 15px;"></i>Trainers</a>
  <a href="Adminworkout.html"><i class='fa fa-dumbbell' style='margin: 15px 10px 15px 15px;'></i>Workouts</a>
  <a href="Adminassigntrainer.html"><i class='fa fa-user' style='margin: 15px 10px 15px 15px;' ></i>Asign Trainers</a>
  <a href="#"><i class='fa fa-book' style='margin: 15px 10px 15px 15px;' ></i>Plans</a>
  <!-- <a href="#"><i class='fa fa-user-circle-o' style='margin: 15px 10px 15px 15px;' ></i>Profile</a> -->
 
</div> <!--adminnav-->

    <div class="adminUsers">
    <h3>Members</h3>
    <hr>

    <div style="display: flex; justify-content: space-between; align-items: center;">
      <!--Report Generation Button-->
      <div>
          <button class="report-btn">Generate Report</button>
      </div>
  
      <!--Search Box-->
      <div class="search-container">
          <input type="search" id="member-search" name="q" placeholder="Search...">
          <button class="search-icon">Search</button>
      </div>
  </div>

    <!--Registers Users Table-->
    
    <table>
      <tr>
        <th>Full Name</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Membership Type</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
      
      <?php
        $sql = "SELECT u.* , m.plan, m.expiry_date 
                FROM users u JOIN memberships m ON u.user_id = m.user_id 
                WHERE role = 'member'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {

          while ($row = mysqli_fetch_assoc($result)) {
      ?>

    <tr>
        <!-- <th scope="row"></th> -->
        <td><?php echo $row["full_name"]?></td>
        <td><?php echo $row["email"]?></td>
        <td><?php echo $row["phone"]?></td>
        <td><?php echo $row["plan"]?></td>
        <td><?php echo $row["expiry_date"]?></td>
        <td>
        


          <!-- View Button -->
          <button class="view-btn"><a href="#viewmember">View</a></button>

          <div class="overlay" id="viewmember">
            <div class="viewwrapper">
               <a href="#" class="close">&times;</a>
               <div class="trainer-content">
                <div class="trainer-container">
                  <div class="container">
                    <div class="sidebar">
                        <div class="profile">
                            <img src="../img/Admin.jpg" alt="Profile Picture">
                            <h2>Member</h2>
                            <h2><?php echo $row["full_name"]?></h2>
                            <div class="details">
                                <h5>Email: <span><?php echo $row["email"]?></span></h5>
                                <h5>Phone No: <span><?php echo $row["phone"]?></span></h5>
                                <h5>DOB: <span><?php echo $row["dob"]?></span></h5>
                                <h5>Gender: <span><?php echo $row["gender"]?></span></h5>
                                <h5>Membership Type: <span><?php echo $row["plan"]?></span></h5>
                            </div>
                        </div>
                    </div>
            
                    <div class="main-content">
                        <div class="tabs">
                            <button class="tab active" data-tab="account">ACCOUNT</button>
                        </div>
            
                        <div class="tab-content" id="tab-content">
                            <div class="form-group">
                                <label>Height</label>
                                <input type="text" value="<?php echo $row["height"]?>">
                            </div>
                            <div class="form-group">
                                <label>Weight</label>
                                <input type="text" value="<?php echo $row["weight"]?>">
                            </div>
                            <div class="form-group">
                                <label>Body Fat Percentage</label>
                                <input type="text" value="<?php echo $row["body_fat"]?>">
                            </div>
                            <div class="form-group">
                                <label>Muscle Mass</label>
                                <input type="text" value="<?php echo $row["muscle_mass"]?>">
                            </div>
                            <div class="form-group">
                                <label>Current Fitness Level</label>
                                <input type="text" value="<?php echo $row["fitness_level"]?>">
                            </div>
                            <div class="form-group">
                                <label>Preferrend Workout Time</label>
                                <input type="email" value="<?php echo $row["workout_time"]?>">
                            </div>
                            
                            <button class="back-btn"><a href="AdminMembers.php">Back</a></button>
                        </div>
                    </div>
                </div>
                </div>
                </div>
              </div>
            </div>



        <!-- Delete Button -->
        <button class="delete-btn"><a href="AdminMembers.php?delete_memberId=<?php echo $row["user_id"]?>">Delete</a></button>
        </td>
        </tr>
        <?php } }?>
    </table>
  </div> 

</body>   
</html>
