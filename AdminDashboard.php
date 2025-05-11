<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/AdminDashboard.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://kit.fontawesome.com/dc4ee3e80e.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
  <a href="#"><i class='fa fa-book' style='margin: 15px 10px 15px 15px;' ></i>Plans</a>
  
 
</div> <!--adminnav-->

<div class="adminmain">
  <div class="row-ad3">
    <h2 class="header-title">Admin Dashboard</h2>
    <div class="header-right">
    <button class="logout-btn"><a href="Login.php">Log Out</a></button>
    <img src="./img/Admin.jpg" class="Profile-img" alt="Paris" width="70" height="70" style="clip-path: circle(50%);">
    </div>
  </div>
  <hr>

  <!--Admin Dashboard Cards-->
  <!--Row 1-->
  <div class="row-ad1">
    <div class="col-ad1">
    <div class="admincard">
        <div class="admincontainer">

          <a href="AdminPassengers.php"><h4><i class='fa fa-users'></i><b>Members</b></h4></a>
          <p><b>10</b></p> 
          <hr>
          
        </div> <!--admincontainer-->
      </div> <!--admincard-->
    </div> <!--col-ad1-->

    <div class="col-ad2">
      <div class="admincard">
        <div class="admincontainer">

          <a href="AdminFlights.php"><h4><i class='fa fa-user-tie' ></i><b>Trainers</b></h4></a>
          <p><b>15</b></p> 
          <hr>
        </div> <!--admincontainer-->
      </div> <!--admincard-->
    </div> <!--col-ad2-->
    
    <div class="col-ad3">
      <div class="admincard">
        <div class="admincontainer">
    
          <a href="AdminSchedule.php"><h4><i class="fa fa-book"></i><b>Plans</b></h4></a> 
          <p><b>2</b></p> 
          <hr>

        </div> <!--admincontainer-->
      </div> <!--admincard-->
    </div> <!--col-ad3-->
  </div> <!--row-ad1-->
 
</div> <!--adminmain-->

<!-- Chart Containers: Place after summary cards -->
<div class="admin-charts-container">
  <div class="admin-chart-box">
    <canvas id="membersChart"></canvas>
  </div>
  <div class="admin-chart-box">
    <canvas id="trainersChart"></canvas>
  </div>
</div>

<!-- Chart Script: Place before </body> -->
<script>
  // Hardcoded data for monthly added members
  const membersData = {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    datasets: [{
      label: 'Members Added',
      data: [12, 19, 14, 17, 22, 25, 20, 18, 24, 21, 15, 23],
      backgroundColor: 'rgba(74, 144, 226, 0.7)',
      borderColor: 'rgba(74, 144, 226, 1)',
      borderWidth: 1
    }]
  };

  // Hardcoded data for monthly added trainers
  const trainersData = {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    datasets: [{
      label: 'Trainers Added',
      data: [2, 3, 1, 4, 2, 3, 2, 1, 3, 2, 2, 4],
      backgroundColor: [
        'rgba(255, 99, 132, 0.7)',
        'rgba(255, 159, 64, 0.7)',
        'rgba(255, 205, 86, 0.7)',
        'rgba(75, 192, 192, 0.7)',
        'rgba(54, 162, 235, 0.7)',
        'rgba(153, 102, 255, 0.7)',
        'rgba(201, 203, 207, 0.7)',
        'rgba(255, 99, 132, 0.7)',
        'rgba(255, 159, 64, 0.7)',
        'rgba(255, 205, 86, 0.7)',
        'rgba(75, 192, 192, 0.7)',
        'rgba(54, 162, 235, 0.7)'
      ],
      borderColor: 'rgba(54, 162, 235, 1)',
      borderWidth: 1
    }]
  };

  // Bar chart for members
  new Chart(document.getElementById('membersChart'), {
    type: 'bar',
    data: membersData,
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        title: { display: true, text: 'Monthly Added Members' }
      },
      scales: {
        y: { beginAtZero: true }
      }
    }
  });

  // Pie chart for trainers
  new Chart(document.getElementById('trainersChart'), {
    type: 'pie',
    data: {
      labels: trainersData.labels,
      datasets: [{
        label: 'Trainers Added',
        data: trainersData.datasets[0].data,
        backgroundColor: trainersData.datasets[0].backgroundColor,
        borderColor: trainersData.datasets[0].borderColor,
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'bottom' },
        title: { display: true, text: 'Monthly Added Trainers' }
      }
    }
  });
</script>

</body>
</html> 
