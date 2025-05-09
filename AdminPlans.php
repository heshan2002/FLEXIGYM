<?php
session_start();
require("php/database.php");
require_once('php/tcpdf/tcpdf.php');
ob_start();

if (!isset($_SESSION["email"]) || $_SESSION["role"] !== "admin") {
  header("location:Login.php");
  exit();
}

// Handle AJAX requests
if (isset($_GET['action']) && $_GET['action'] == 'getPlans') {
  $sql = "SELECT * FROM membership_plans ORDER BY plan_name ASC";
  $result = mysqli_query($conn, $sql);
  
  $plans = [];
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $plans[] = $row;
    }
    echo json_encode(['status' => 'success', 'plans' => $plans]);
  } else {
    echo json_encode(['status' => 'error', 'message' => 'No plans found']);
  }
  exit();
}

// Handle plan operations (add/edit/delete)
if (isset($_POST['action'])) {
  $action = $_POST['action'];
  
  if ($action == 'update') {
    $planId = isset($_POST['plan_id']) ? $_POST['plan_id'] : '';
    $planName = $_POST['plan_name'];
    $description = $_POST['description'];
    $durationMonths = $_POST['duration_months'];
    $price = $_POST['price'];
    $benefits = $_POST['benefits'];
    $status = $_POST['status'];
    
    if ($planId) {
      // Update existing plan
      $sql = "UPDATE membership_plans SET 
              plan_name = '$planName', 
              description = '$description', 
              duration_months = $durationMonths, 
              price = $price, 
              benefits = '$benefits', 
              status = '$status' 
              WHERE plan_id = $planId";
      $message = "Plan updated successfully";
    } else {
      // Add new plan
      $sql = "INSERT INTO membership_plans 
              (plan_name, description, duration_months, price, benefits, status) 
              VALUES ('$planName', '$description', $durationMonths, $price, '$benefits', '$status')";
      $message = "Plan added successfully";
    }
    
    if (mysqli_query($conn, $sql)) {
      echo json_encode(['status' => 'success', 'message' => $message]);
    } else {
      echo json_encode(['status' => 'error', 'message' => 'Database error: ' . mysqli_error($conn)]);
    }
    exit();
  }
  
  if ($action == 'delete') {
    $planId = $_POST['plan_id'];
    $sql = "DELETE FROM membership_plans WHERE plan_id = $planId";
    
    if (mysqli_query($conn, $sql)) {
      echo json_encode(['status' => 'success', 'message' => 'Plan deleted successfully']);
    } else {
      echo json_encode(['status' => 'error', 'message' => 'Error deleting plan: ' . mysqli_error($conn)]);
    }
    exit();
  }
}

// Generate PDF report
if (isset($_POST['generate_plans_pdf'])) {
  // Clean any output buffers
  while (ob_get_level()) {
    ob_end_clean();
  }
  
  // Create new PDF document
  $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
  
  // Set document information
  $pdf->SetCreator('FlexiGym');
  $pdf->SetAuthor('FlexiGym Admin');
  $pdf->SetTitle('Membership Plans Report');
  $pdf->SetSubject('Membership Plans');
  
  // Remove header/footer
  $pdf->setPrintHeader(false);
  $pdf->setPrintFooter(false);
  
  // Set margins
  $pdf->SetMargins(15, 15, 15);
  
  $pdf->AddPage();
  $pdf->SetFont('helvetica', 'B', 16);
  $pdf->Cell(0, 10, 'FlexiGym Membership Plans Report', 0, 1, 'C');
  $pdf->SetFont('helvetica', '', 12);

  // Get all plans
  $sql = "SELECT * FROM membership_plans ORDER BY plan_name ASC";
  $result = mysqli_query($conn, $sql);

  $tbl = '<table border="1" cellspacing="0" cellpadding="4">
            <thead>
                <tr style="background-color:#f2f2f2;">
                    <th><b>Plan Name</b></th>
                    <th><b>Duration</b></th>
                    <th><b>Price (LKR)</b></th>
                    <th><b>Status</b></th>
                </tr>
            </thead><tbody>';

  while ($row = mysqli_fetch_assoc($result)) {
    $duration = $row['duration_months'] . ' ' . ($row['duration_months'] > 1 ? 'months' : 'month');
    $status = ucfirst($row['status']);
    
    $tbl .= '<tr>
                <td>' . $row['plan_name'] . '</td>
                <td>' . $duration . '</td>
                <td>' . number_format($row['price'], 2) . '</td>
                <td>' . $status . '</td>
            </tr>';
  }

  $tbl .= '</tbody></table>';
  $pdf->writeHTML($tbl, true, false, false, false, '');

  // Add benefits section
  $pdf->AddPage();
  $pdf->SetFont('helvetica', 'B', 14);
  $pdf->Cell(0, 10, 'Plan Details and Benefits', 0, 1, 'C');
  
  $result = mysqli_query($conn, "SELECT * FROM membership_plans ORDER BY plan_name ASC");
  
  while ($row = mysqli_fetch_assoc($result)) {
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, $row['plan_name'] . ' Plan', 0, 1);
    
    $pdf->SetFont('helvetica', '', 11);
    $pdf->MultiCell(0, 8, 'Description: ' . $row['description'], 0, 'L');
    $pdf->Ln(3);
    
    $pdf->SetFont('helvetica', 'B', 11);
    $pdf->Cell(0, 8, 'Benefits:', 0, 1);
    
    $benefits = explode(',', $row['benefits']);
    $pdf->SetFont('helvetica', '', 11);
    foreach ($benefits as $benefit) {
      $pdf->Cell(10, 8, '•', 0, 0);
      $pdf->MultiCell(0, 8, trim($benefit), 0, 'L');
    }
    
    $pdf->Ln(10);
  }

  // Make sure no output has been sent before this point
  if (headers_sent()) {
    die("Headers already sent. Cannot output PDF.");
  }
  
  // Force download the PDF
  header('Content-Type: application/pdf');
  header('Content-Disposition: attachment; filename="Membership_Plans_Report.pdf"');
  header('Cache-Control: private, max-age=0, must-revalidate');
  header('Pragma: public');
  
  $pdf->Output('Membership_Plans_Report.pdf', 'D');
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/AdminDashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/dc4ee3e80e.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/AdminPlans.css">
</head>

<body class="adminDashboard">    

<!--Admin Left Side Navigation Bar-->  
<div class="adminnav">
  <h3><center>Admin</center></h3>
  <h3 style='color:#397FFF;'><center>FLEXIGYM</center></h3>

  <center><hr style="width:90%;text-align:center;margin-left:0"></center>

  <a href="AdminDashboard.php"><i class='fas fa-house-user' style='margin: 15px 10px 15px 15px;'></i>Dashboard</a>
  <a href="AdminMembers.php"><i class='fa fa-users' style='margin: 15px 10px 15px 15px;'></i>Members</a>
  <a href="AdminTrainers.php"><i class="fa fa-user-tie" style="margin: 15px 10px 15px 15px;"></i>Trainers</a>
  <a href="Adminworkout.php"><i class='fa fa-dumbbell' style='margin: 15px 10px 15px 15px;'></i>Workouts</a>
  <a href="Adminassigntrainer.php"><i class='fa fa-user' style='margin: 15px 10px 15px 15px;' ></i>Assign Trainers</a>
  <a href="AdminPlans.php" class="active"><i class='fa fa-book' style='margin: 15px 10px 15px 15px;' ></i>Plans</a>
</div> <!--adminnav-->

<div class="adminmain">
  <div class="row-ad3">
    <h2 class="header-title">Membership Plans Management</h2>
    <div class="header-right">
      <button class="logout-btn"><a href="php/logout.php">Log Out</a></button>
      <img src="./img/Admin.jpg" class="Profile-img" alt="Admin" width="70" height="70" style="clip-path: circle(50%);">
    </div>
  </div>
  <hr>

  <div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center;">
      <div>
        <button class="add-plan-btn" id="addPlanBtn">Add New Plan</button>
        <button type="button" id="generateReportBtn" class="report-btn">Generate Report</button>
      </div>
      
      <div class="search-container">
        <input type="search" id="plan-search" placeholder="Search plans...">
        <button class="search-icon">Search</button>
      </div>
    </div>

    <div class="table-container">
      <table id="plans-table">
        <thead>
          <tr>
            <th>Plan Name</th>
            <th>Duration</th>
            <th>Price</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="plans-table-body">
          <!-- Plans will be loaded here dynamically -->
        </tbody>
      </table>
    </div>
  </div>

  <!-- Add/Edit Plan Modal -->
  <div id="planModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h3 id="modal-title">Add New Plan</h3>
      <form id="planForm">
        <input type="hidden" id="planId" name="plan_id">
        <div class="form-group">
          <label for="planName">Plan Name*</label>
          <input type="text" id="planName" name="plan_name" required>
        </div>
        <div class="form-group">
          <label for="description">Description*</label>
          <textarea id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
          <label for="durationMonths">Duration (months)*</label>
          <input type="number" id="durationMonths" name="duration_months" min="1" required>
        </div>
        <div class="form-group">
          <label for="price">Price (LKR)*</label>
          <input type="number" id="price" name="price" min="0" step="0.01" required>
        </div>
        <div class="form-group">
          <label for="benefits">Benefits (comma separated)*</label>
          <textarea id="benefits" name="benefits" required></textarea>
        </div>
        <div class="form-group">
          <label for="status">Status</label>
          <select id="status" name="status">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>
        <button type="submit" class="submit-btn">Save Plan</button>
      </form>
    </div>
  </div>

  <!-- Delete Confirmation Modal -->
  <div id="deleteModal" class="modal">
    <div class="modal-content delete-modal">
      <h3>Confirm Deletion</h3>
      <p>Are you sure you want to delete this plan? This action cannot be undone.</p>
      <div class="delete-actions">
        <button id="confirmDelete" class="delete-btn">Delete</button>
        <button id="cancelDelete" class="cancel-btn">Cancel</button>
      </div>
    </div>
  </div>

  <!-- Plan Details Modal -->
  <div id="detailsModal" class="modal">
    <div class="modal-content">
      <span id="closeDetails" class="close">&times;</span>
      <h3>Plan Details</h3>
      <div class="details-container">
        <div class="detail-row">
          <span class="detail-label">Plan Name:</span>
          <span id="detailsPlanName" class="detail-value"></span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Description:</span>
          <span id="detailsDescription" class="detail-value"></span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Duration:</span>
          <span id="detailsDuration" class="detail-value"></span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Price:</span>
          <span id="detailsPrice" class="detail-value"></span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Status:</span>
          <span id="detailsStatus" class="detail-value"></span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Benefits:</span>
          <ul id="detailsBenefitsList" class="benefits-list"></ul>
        </div>
      </div>
    </div>
  </div>
</div> <!--adminmain-->

<script>
// Load plans data when the page loads
document.addEventListener('DOMContentLoaded', function() {
  // Fetch plans data
  fetch('AdminPlans.php?action=getPlans')
    .then(response => response.json())
    .then(data => {
      if (data.status === 'success') {
        displayPlans(data.plans);
      } else {
        console.error(data.message);
      }
    })
    .catch(error => console.error('Error fetching plans:', error));
  
  // Function to display plans in the table
  function displayPlans(plans) {
    const tableBody = document.getElementById('plans-table-body');
    tableBody.innerHTML = '';
    
    plans.forEach(plan => {
      const row = document.createElement('tr');
      const duration = plan.duration_months + (plan.duration_months > 1 ? ' months' : ' month');
      const price = new Intl.NumberFormat('en-US', { 
        style: 'currency', 
        currency: 'LKR',
        minimumFractionDigits: 2 
      }).format(plan.price);
      
      row.innerHTML = `
        <td>${plan.plan_name}</td>
        <td>${duration}</td>
        <td>${price}</td>
        <td>${plan.status.charAt(0).toUpperCase() + plan.status.slice(1)}</td>
        <td>
          <button class="action-btn view-btn" data-plan-id="${plan.plan_id}">View</button>
          <button class="action-btn edit-btn" data-plan-id="${plan.plan_id}">Edit</button>
          <button class="action-btn delete-btn" data-plan-id="${plan.plan_id}">Delete</button>
        </td>
      `;
      
      tableBody.appendChild(row);
    });
    
    // Add event listeners for view, edit, and delete buttons
    attachActionListeners();
  }
  
  // Add event listener for the Add New Plan button
  document.getElementById('addPlanBtn').addEventListener('click', function() {
    // Reset form fields when adding a new plan
    document.getElementById('planForm').reset();
    document.getElementById('planId').value = ''; // Clear hidden ID field
    document.getElementById('modal-title').textContent = 'Add New Plan';
    
    // Show the modal
    document.getElementById('planModal').style.display = 'block';
  });
  
  // Close modal when clicking the X button
  document.querySelectorAll('.close').forEach(closeBtn => {
    closeBtn.addEventListener('click', function() {
      this.closest('.modal').style.display = 'none';
    });
  });
  
  // Close modal when clicking outside of it
  window.addEventListener('click', function(event) {
    if (event.target.classList.contains('modal')) {
      event.target.style.display = 'none';
    }
  });
  
  // Handle plan form submission
  document.getElementById('planForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const formData = new FormData(this);
    formData.append('action', 'update');
    
    fetch('AdminPlans.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.status === 'success') {
        alert(data.message);
        document.getElementById('planModal').style.display = 'none';
        // Refresh plans data
        fetch('AdminPlans.php?action=getPlans')
          .then(response => response.json())
          .then(data => {
            if (data.status === 'success') {
              displayPlans(data.plans);
            }
          });
      } else {
        alert('Error: ' + data.message);
      }
    })
    .catch(error => console.error('Error:', error));
  });
  
  // Function to attach action listeners to buttons
  function attachActionListeners() {
    // View button listeners
    document.querySelectorAll('.view-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const planId = this.getAttribute('data-plan-id');
        viewPlanDetails(planId);
      });
    });
    
    // Edit button listeners
    document.querySelectorAll('.edit-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const planId = this.getAttribute('data-plan-id');
        editPlan(planId);
      });
    });
    
    // Delete button listeners
    document.querySelectorAll('.delete-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const planId = this.getAttribute('data-plan-id');
        document.getElementById('confirmDelete').setAttribute('data-plan-id', planId);
        document.getElementById('deleteModal').style.display = 'block';
      });
    });
  }
  
  // Cancel delete action
  document.getElementById('cancelDelete').addEventListener('click', function() {
    document.getElementById('deleteModal').style.display = 'none';
  });
  
  // Confirm delete action
  document.getElementById('confirmDelete').addEventListener('click', function() {
    const planId = this.getAttribute('data-plan-id');
    
    const formData = new FormData();
    formData.append('action', 'delete');
    formData.append('plan_id', planId);
    
    fetch('AdminPlans.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.status === 'success') {
        alert(data.message);
        document.getElementById('deleteModal').style.display = 'none';
        // Refresh plans data
        fetch('AdminPlans.php?action=getPlans')
          .then(response => response.json())
          .then(data => {
            if (data.status === 'success') {
              displayPlans(data.plans);
            }
          });
      } else {
        alert('Error: ' + data.message);
      }
    })
    .catch(error => console.error('Error:', error));
  });
  
  // Function to view plan details
  function viewPlanDetails(planId) {
    fetch('AdminPlans.php?action=getPlans')
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
          const plan = data.plans.find(p => p.plan_id == planId);
          if (plan) {
            document.getElementById('detailsPlanName').textContent = plan.plan_name;
            document.getElementById('detailsDescription').textContent = plan.description;
            document.getElementById('detailsDuration').textContent = 
              plan.duration_months + (plan.duration_months > 1 ? ' months' : ' month');
            document.getElementById('detailsPrice').textContent = 
              new Intl.NumberFormat('en-US', {style: 'currency', currency: 'LKR'}).format(plan.price);
            document.getElementById('detailsStatus').textContent = 
              plan.status.charAt(0).toUpperCase() + plan.status.slice(1);
            
            // Display benefits as list items
            const benefitsList = document.getElementById('detailsBenefitsList');
            benefitsList.innerHTML = '';
            const benefits = plan.benefits.split(',');
            
            benefits.forEach(benefit => {
              const li = document.createElement('li');
              li.textContent = benefit.trim();
              benefitsList.appendChild(li);
            });
            
            document.getElementById('detailsModal').style.display = 'block';
          }
        }
      });
  }
  
  // Function to populate form for editing
  function editPlan(planId) {
    fetch('AdminPlans.php?action=getPlans')
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
          const plan = data.plans.find(p => p.plan_id == planId);
          if (plan) {
            document.getElementById('planId').value = plan.plan_id;
            document.getElementById('planName').value = plan.plan_name;
            document.getElementById('description').value = plan.description;
            document.getElementById('durationMonths').value = plan.duration_months;
            document.getElementById('price').value = plan.price;
            document.getElementById('benefits').value = plan.benefits;
            document.getElementById('status').value = plan.status;
            
            document.getElementById('modal-title').textContent = 'Edit Plan';
            document.getElementById('planModal').style.display = 'block';
          }
        }
      });
  }
  
  // Search functionality
  document.getElementById('plan-search').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('#plans-table tbody tr');
    
    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
  });
  
  // Handle report generation
  document.getElementById('generateReportBtn').addEventListener('click', function() {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'AdminPlans.php';
    
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'generate_plans_pdf';
    input.value = '1';
    
    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
  });
});
</script>
</body>
</html>
