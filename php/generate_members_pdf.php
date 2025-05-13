<?php
// This is a separate file to handle PDF generation without any output before headers
session_start();
require("database.php");
require_once('tcpdf/tcpdf.php');

// Check user permission
if (!isset($_SESSION["email"]) || $_SESSION["role"] !== "admin") {
  header("location:../Login.php");
  exit();
}

// Clear all previous output and buffers
if (ob_get_level()) {
  ob_end_clean();
}

// Create PDF object with better configuration
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('FlexiGym');
$pdf->SetAuthor('FlexiGym Admin');
$pdf->SetTitle('Member Report');
$pdf->SetSubject('FlexiGym Member List');
$pdf->SetKeywords('FlexiGym, Members, Report');

// Disable header and footer for cleaner output
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT);
$pdf->SetAutoPageBreak(TRUE, 15);

// Add a page
$pdf->AddPage();
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'FlexiGym Member Report', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 12);

// Get member data
$sql = "SELECT u.* 
        FROM users u  
        WHERE u.role = 'member'";
$result = mysqli_query($conn, $sql);

// Create HTML table
$tbl = '<table border="1" cellspacing="0" cellpadding="4" style="width: 100%;">
          <thead>
              <tr style="background-color:#f2f2f2;">
                  <th><b>Full Name</b></th>
                  <th><b>Email</b></th>
                  <th><b>Phone</b></th>
                  <th><b>Fitness Level</b></th>
                  <th><b>Workout Time</b></th>
              </tr>
          </thead><tbody>';

while ($row = mysqli_fetch_assoc($result)) {
  $tbl .= '<tr>
              <td>' . htmlspecialchars($row['full_name']) . '</td>
              <td>' . htmlspecialchars($row['email']) . '</td>
              <td>' . htmlspecialchars($row['phone']) . '</td>
              <td>' . htmlspecialchars($row['fitness_level']) . '</td>
              <td>' . htmlspecialchars($row['workout_time']) . '</td>
          </tr>';
}

$tbl .= '</tbody></table>';
$pdf->writeHTML($tbl, true, false, false, false, '');

// Reset pointer to the last page
$pdf->lastPage();

try {
    // Clean output buffer again to be safe
    while (ob_get_level()) {
        ob_end_clean();
    }
    
    // Set headers to force download
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="FlexiGym_Member_Report.pdf"');
    header('Cache-Control: private, max-age=0, must-revalidate');
    header('Pragma: public');
    
    // Output PDF as string to browser (I = inline, D = download)
    $pdf->Output('FlexiGym_Member_Report.pdf', 'D');
} catch (Exception $e) {
    echo 'Error generating PDF: ' . $e->getMessage();
} catch (Exception $e) {
    // If there's an error, display it (in production, log instead)
    die('Error generating PDF: ' . $e->getMessage());
}
exit();
?>
