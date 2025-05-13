<?php
require("php/database.php");
require_once('php/tcpdf/tcpdf.php');

session_start();

if (!isset($_SESSION["email"])) {
  header("location:Login.php");
  exit();
}

// =================== Generate PDF ===================
if (isset($_POST['generate_trainer_pdf'])) {
  $pdf = new TCPDF();
  $pdf->AddPage();
  $pdf->SetFont('helvetica', 'B', 16);
  $pdf->Cell(0, 10, 'FlexiGym Trainer Report', 0, 1, 'C');
  $pdf->SetFont('helvetica', '', 12);

  $sql = "SELECT name, email, specialty, experience_years, availability FROM trainers";
  $result = mysqli_query($conn, $sql);

  $tbl = '<table border="1" cellspacing="0" cellpadding="4">
            <thead>
                <tr style="background-color:#f2f2f2;">
                    <th><b>Full Name</b></th>
                    <th><b>Email</b></th>
                    <th><b>Specialty</b></th>
                    <th><b>Experience Years</b></th>
                    <th><b>Availability</b></th>
                </tr>
            </thead><tbody>';

  while ($row = mysqli_fetch_assoc($result)) {
    $tbl .= '<tr>
                <td>' . $row['name'] . '</td>
                <td>' . $row['email'] . '</td>
                <td>' . $row['specialty'] . '</td>
                <td>' . $row['experience_years'] . '</td>
                <td>' . $row['availability'] . '</td>
            </tr>';
  }

  $tbl .= '</tbody></table>';
  $pdf->writeHTML($tbl, true, false, false, false, '');

  ob_end_clean(); // Clean the buffer before sending PDF
  $pdf->Output('Trainer_Report.pdf', 'D'); // Send PDF as download
  exit();
}

?>
<?php include("php/adminTrainer_server.php"); ?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/AdminTrainers.css">
  <link rel="stylesheet" href="css/AdminDashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/dc4ee3e80e.js" crossorigin="anonymous"></script> 
  <script src="https://www.dukelearntoprogram.com/course1/common/js/image/SimpleImage.js"></script>
  <script>
    function upload(){
    var imgcanvas = document.getElementById("canv1");
    var fileinput = document.getElementById("finput");
    var image = new SimpleImage(fileinput);
    image.drawTo(imgcanvas);
    }

    function alert() {
    document.getElementById("popup").style.display = "block";
    }
</script>
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
  <a href="Adminworkout.php"><i class='fa fa-dumbbell' style='margin: 15px 10px 15px 15px;'></i>Workouts</a>
  <a href="Adminassigntrainer.php"><i class='fa fa-user' style='margin: 15px 10px 15px 15px;' ></i>Asign Trainers</a>
  <a href="#"><i class='fa fa-book' style='margin: 15px 10px 15px 15px;' ></i>Plans</a>
  
 
</div> <!--adminnav-->

    <div class="adminUsers">
    <div class="row-ad3">
    <h2 class="header-title">Trainers</h2>
    <div class="header-right">
    <button class="logout-btn"><a href="Login.php">Log Out</a></button>
    <img src="./img/Admin.jpg" class="Profile-img" alt="Paris" width="70" height="70" style="clip-path: circle(50%);">
  </div>
  </div>
    <hr>

    
    <div style="display: flex; justify-content: space-between; align-items: center;">
      <div style="display: flex; gap: 10px;">
          <!--Add Trainer Button-->
          <button class="addtrainer-btn"><a href="#divOne">Add New Trainer</a></button>

          <!--Report Generation Button-->
          <form method="post" action="AdminTrainers.php" style="margin: 0;">
              <button class="report-btn" type="submit" name="generate_trainer_pdf">Generate Report</button>
          </form>
      </div>
  
      <!--Search Box-->
      <div class="search-container">
          <input type="search" id="trainer-search" placeholder="Search...">
      </div>
  </div>

  <!-- Add Trainer Overlay -->
  <div class="overlay" id="divOne">
    <div class="wrapper">
      <h3>Add a new Trainer</h3>
      <hr style="background-color: rgb(15, 15, 206);">
      <a href="#" class="close">&times;</a>
      <div class="trainer-content">
        <div class="trainer-container">
          <form class="trainerlabel" action="AdminTrainers.php" method="post" enctype="multipart/form-data">
            <div class="input-group username">
              <label for="tName" >Full Name</label>
              <input type="text" placeholder="First Name" id="tName" name="tName" required>
            </div>

            <div class="input-group username">
              <label for="tEmail" >Email</label>
              <input type="email" placeholder="Email" id="tEmail" name="tEmail" required>
            </div>

            <div class="input-group username">
              <label for="tYears" >Experience Years</label>
              <input type="text" placeholder="Ecperience Years" id="tYears" name="tYears" required>
            </div>

            <div class="specialty" >
              <label for="tSpecialty">Specialty</label>
              <select id="tSpecialty" name="tSpecialty" >
                <option>--select--</option>
                <option value="Bodybuilding">Bodybuilding</option>
                <option value="Strength">Strength</option>
                <option value="Yoga">Yoga</option>
                <option value="Athletic">Athletic</option>
                <option value="Fitness">Fitness</option>
              </select>
            </div>

            <div class="addtrainer-column">
              <div class="uploadimage">
                <canvas id= "canv1" ></canvas>
                <input type="file" multiple="false"  accept="image/*" id="fileToUpload" name="fileToUpload" onchange="upload()">
              </div>
            </div>
              
            <button type="submit-btn" class="submit-btn" onclick="sendMessage()"  name="add_trainer">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

    <!--Registers Users Table-->
    
    <table id="trainer-table">
      <thead>
        <tr>
          <th>Full Name</th>
          <th>Email</th>
          <th>Specialty</th>
          <th>Availability</th>
          <th>Actions</th>
        </tr>
      </thead>  
      <tbody id="trainer-table-body">
      
      <?php
        $sql = "SELECT * FROM trainers";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
      ?>

      <tr>
        <td><?php echo $row["name"]?></td>
        <td><?php echo $row["email"]?></td>
        <td><?php echo $row["specialty"]?></td>
        <td><?php echo $row["availability"]?></td>
        <td>
          <!-- View Button -->
          <button class="view-btn"><a href="#viewtrainer<?php echo $row['trainer_id']; ?>">View</a></button>

          <div class="overlay" id="viewtrainer<?php echo $row['trainer_id']; ?>">
            <div class="viewwrapper">
               <a href="#" class="close">&times;</a>
               <div class="trainer-content">
                <div class="trainer-container">
                  <div class="container">
                    <div class="sidebar">
                        <div class="profile">
                            <!-- <img src="../img/trainer/<?php echo $row['fileToUpload']; ?>" alt="Profile Picture"> -->
                            <h2>Trainer</h2>
                        </div>
                    </div>
            
                    <div class="main-content">
                        <div class="tabs">
                            <button class="tab active" data-tab="account">Personal Details</button>
                        </div>
            
                        <div class="tab-content" id="tab-content">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" value="<?php echo $row["name"]?>">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" value="<?php echo $row["email"]?>">
                            </div>
                            <div class="form-group">
                                <label>specialty</label>
                                <input type="text" value="<?php echo $row["specialty"]?>">
                            </div>
                            <div class="form-group">
                                <label>Work Experience</label>
                                <input type="text" value="<?php echo $row["experience_years"]?>">
                            </div>
                            <button class="back-btn"><a href="AdminTrainers.php">Back</a></button>
                        </div>
                    </div>
                </div>
                </div>
                </div>
              </div>
            </div>
            

          <!-- Delete Button -->
           <button class="delete-btn" onclick="return confirm('Are you sure you want to delete this trainer? This action cannot be undone.');"><a href="AdminTrainers.php?delete_trainerId=<?php echo $row["trainer_id"]?>">Delete</a></button>
        </td>
        </tr>
        <?php } }?>
      </tbody>
    </table>
  </div> 

  <!-- AJAX Search Script -->
  <script>
    document.getElementById("trainer-search").addEventListener("keyup", function () {
      const query = this.value;

      const xhr = new XMLHttpRequest();
      xhr.open("GET", "ajax_search_trainers.php?search=" + query, true);
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          document.getElementById("trainer-table-body").innerHTML = xhr.responseText;
        }
      };
      xhr.send();
    });
  </script>

</body>   
</html>
