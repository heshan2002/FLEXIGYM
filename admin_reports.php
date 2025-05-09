<?php
session_start();
// Check if user is logged in and is an admin
if (!isset($_SESSION["email"]) || $_SESSION["role"] !== "admin") {
    header("Location: Login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reports - FlexiGym</title>
    <!-- Include your CSS stylesheets here -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Include header/navigation -->
    <?php include('includes/header.php'); ?>
    
    <div class="container">
        <h1>Admin Reports</h1>
        
        <div class="report-options">
            <div class="report-card">
                <h2>Member Report</h2>
                <p>Generate a complete list of all FlexiGym members with their details.</p>
                <a href="php/generate_members_pdf.php" class="btn btn-primary">Generate PDF</a>
            </div>
            
            <!-- Add more report options as needed -->
        </div>
    </div>
    
    <!-- Include footer -->
    <?php include('includes/footer.php'); ?>
</body>
</html>
