<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/AdminDashboard.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://kit.fontawesome.com/dc4ee3e80e.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

<style>
        .success-message {
            display: none;
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            margin-bottom: 20px;
            text-align: center;
            border-radius: 4px;
        }
    </style>
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
    <h2 class="header-title">Create Plane</h2>
    <div class="header-right">
    <button class="logout-btn"><a href="#">Log Out</a></button>
    <img src="./img/Admin.jpg" class="Profile-img" alt="Paris" width="70" height="70" style="clip-path: circle(50%);">
    </div>
  </div>
  <hr>

      <!-- Create Plan Section Begin -->
      <section class="create-plan-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="create-plan-form">
                        <h3>Create Your Fitness Plan</h3>
                        <div id="success-message" class="success-message">
                            Plan created successfully! <a href="membership-plans.html">View all plans</a>
                        </div>
                        <form id="planForm" action="#">
                            <div class="form-group">
                                <label for="plan-name">Plan Name</label>
                                <input type="text" id="plan-name" class="form-control" placeholder="Enter Plan Name" required>
                            </div>
                            <div class="form-group">
                                <label for="plan-description">Plan Description</label>
                                <textarea id="plan-description" class="form-control" rows="4" placeholder="Enter Plan Description" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="plan-duration">Plan Duration (weeks)</label>
                                <input type="number" id="plan-duration" class="form-control" placeholder="Enter Plan Duration" required min="1">
                            </div>
                            <div class="form-group">
                                <label for="plan-image">Upload Image</label>
                                <input type="file" id="plan-image" class="form-control" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="plan-amount">Plan Amount </label>
                                <input type="number" id="plan-amount" class="form-control" placeholder="Enter Plan Amount" required min="0">
                            </div>
                            <button type="submit" class="primary-btn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
</div> <!--adminmain-->
<script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the form element
            const planForm = document.getElementById('planForm');
            const successMessage = document.getElementById('success-message');
            
            // Add submit event listener to the form
            planForm.addEventListener('submit', function(event) {
                // Prevent default form submission
                event.preventDefault();
                
                // Get form values
                const planName = document.getElementById('plan-name').value;
                const planDescription = document.getElementById('plan-description').value;
                const planDuration = document.getElementById('plan-duration').value;
                const planAmount = document.getElementById('plan-amount').value;
                
                // Create plan object
                const plan = {
                    id: Date.now(),  // Use timestamp as unique ID
                    name: planName,
                    description: planDescription,
                    duration: planDuration,
                    amount: planAmount,
                    date: new Date().toLocaleDateString()
                };
                
                // Get existing plans from localStorage or initialize empty array
                let plans = JSON.parse(localStorage.getItem('flexigymPlans')) || [];
                
                // Add new plan to array
                plans.push(plan);
                
                // Save updated plans array to localStorage
                localStorage.setItem('flexigymPlans', JSON.stringify(plans));
                
                // Show success message
                successMessage.style.display = 'block';
                
                // Clear form
                planForm.reset();
                
                // Scroll to top to see success message
                window.scrollTo(0, 0);
                
                // Optional: Redirect to plans page after short delay
                setTimeout(function() {
                    window.location.href = 'membership-plans.html';
                }, 3000);
            });
        });
    </script>


</body>
</html> 