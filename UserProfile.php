<?php
require("php/database.php");

session_start();

if (!isset($_SESSION["email"])) {
  header("location:Login.php");
  exit();
}

// Debug: Print session data
error_log("Session data: " . print_r($_SESSION, true));

// Fetch user data
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
$user_data = mysqli_fetch_assoc($result);
?>
<?php include("php/EditUser_Server.php"); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="css/UserProfile.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="css/header.css">
</head>
<body class="myprofile">

<header class="flexigym-header">
    <nav class="flexigym-nav">
      <ul class="flexigym-nav-left">
        <li><a href="./index.php">Home</a></li>
        <li><a href="./about-us.php">About us</a></li>
        <li><a href="./Plans.php">PLANS</a></li>
        <li><a href="./Trainers.php">MY WORKOUTS</a></li>
        <li><a href="./Progress.php">PROGRESS</a></li>
        <li><a href="./contact.php">Contact</a></li>
      </ul>
      <ul class="flexigym-nav-right">
        <li><a href="#"><i class="fas fa-search"></i></a></li>
        <li><a href="Login.php">Logout</a></li>
      </ul>
    </nav>
  </header>


    <form action="php/EditUser_Server.php" method="post" onsubmit="return confirmUpdate()">
        <div class="container">
            <div class="sidebar">
                <div class="profile">
                    <h1>MY PROFILE</h1>
                    <img src="./img/User.png" class="Profile-img" alt="Paris" width="70" height="70" style="clip-path: circle(50%);">
                    
                    <div class="details">
                        <p>Current Fitness Level : <span><?php echo htmlspecialchars($user_data['fitness_level']); ?></span></p>
                        <p>Preferred Workout Time : <span><?php echo htmlspecialchars($user_data['workout_time']); ?></span></p>
                    </div>
                    <!-- <button type="button" class="profile-btn" onclick="window.location.href='MembershipPlans.php'">Upgrade Membership</button> -->
                </div>
            </div>

            <div class="main-content">
                <div class="tab-content">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="full_name" value="<?php echo $user_data['full_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="<?php echo $user_data['email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Phone No</label>
                        <input type="text" name="phone" value="<?php echo $user_data['phone']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>DOB</label>
                        <input type="date" name="dob" value="<?php echo $user_data['dob']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender">
                            <option value="Male" <?php echo ($user_data['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                            <option value="Female" <?php echo ($user_data['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                            <option value="Other" <?php echo ($user_data['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Height (cm)</label>
                        <input type="number" name="height" value="<?php echo $user_data['height']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Weight (kg)</label>
                        <input type="number" name="weight" value="<?php echo $user_data['weight']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Body Fat Percentage</label>
                        <input type="number" step="0.1" name="body_fat" value="<?php echo $user_data['body_fat']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Muscle Mass (kg)</label>
                        <input type="number" step="0.1" name="muscle_mass" value="<?php echo $user_data['muscle_mass']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Fitness Level</label>
                        <select name="fitness_level">
                            <option value="Beginner" <?php echo ($user_data['fitness_level'] == 'Beginner') ? 'selected' : ''; ?>>Beginner</option>
                            <option value="Intermediate" <?php echo ($user_data['fitness_level'] == 'Intermediate') ? 'selected' : ''; ?>>Intermediate</option>
                            <option value="Advanced" <?php echo ($user_data['fitness_level'] == 'Advanced') ? 'selected' : ''; ?>>Advanced</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Preferred Workout Time</label>
                        <select name="workout_time">
                            <option value="Morning" <?php echo ($user_data['workout_time'] == 'Morning') ? 'selected' : ''; ?>>Morning</option>
                            <option value="Afternoon" <?php echo ($user_data['workout_time'] == 'Afternoon') ? 'selected' : ''; ?>>Afternoon</option>
                            <option value="Evening" <?php echo ($user_data['workout_time'] == 'Evening') ? 'selected' : ''; ?>>Evening</option>
                            <option value="Night" <?php echo ($user_data['workout_time'] == 'Night') ? 'selected' : ''; ?>>Night</option>
                        </select>
                    </div>
                    <button type="submit" name="update_user" class="edit-btn">Save Changes</button>
                </div>
            </div>
        </div>
    </form>

    <script>
    function confirmUpdate() {
        return confirm("Are you sure you want to update your profile details?");
    }
    </script>
</body>
</html>
