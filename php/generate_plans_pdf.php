<?php
ob_start();
require("database.php");
require_once('tcpdf/tcpdf.php');

// Generate PDF for membership plans
if (isset($_POST['generate_plans_pdf'])) {
  $pdf = new TCPDF();
  $pdf->AddPage();
  $pdf->SetFont('helvetica', 'B', 16);
  $pdf->Cell(0, 10, 'FlexiGym Membership Plans Report', 0, 1, 'C');
  $pdf->SetFont('helvetica', '', 12);

  $sql = "SELECT * FROM membership_plans";
  $result = mysqli_query($conn, $sql);

  $tbl = '<table border="1" cellspacing="0" cellpadding="4">
            <thead>
                <tr style="background-color:#f2f2f2;">
                    <th><b>Plan ID</b></th>
                    <th><b>Plan Name</b></th>
                    <th><b>Duration</b></th>
                    <th><b>Price</b></th>
                    <th><b>Description</b></th>
                </tr>
            </thead><tbody>';

  while ($row = mysqli_fetch_assoc($result)) {
    $tbl .= '<tr>
                <td>' . $row['plan_id'] . '</td>
                <td>' . $row['plan_name'] . '</td>
                <td>' . $row['duration'] . ' months</td>
                <td>$' . $row['price'] . '</td>
                <td>' . $row['description'] . '</td>
            </tr>';
  }

  $tbl .= '</tbody></table>';
  $pdf->writeHTML($tbl, true, false, false, false, '');

  ob_end_clean(); // Clean the buffer before sending PDF
  $pdf->Output('Membership_Plans_Report.pdf', 'D'); // Send PDF as download
  exit();
}
?>
