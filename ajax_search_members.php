<?php
require("php/database.php");

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

$sql = "SELECT u.*, m.plan, m.expiry_date 
        FROM users u 
        JOIN memberships m ON u.user_id = m.user_id 
        WHERE u.role = 'member' AND (
            u.full_name LIKE '%$search%' OR 
            u.email LIKE '%$search%' OR 
            u.phone LIKE '%$search%' OR 
            m.plan LIKE '%$search%'
        )";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['full_name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['phone']}</td>
            <td>{$row['plan']}</td>
            <td>{$row['expiry_date']}</td>
            <td>
              <button class='view-btn'><a href='#viewmember'>View</a></button>
              <button class='delete-btn'><a href='AdminMembers.php?delete_memberId={$row["user_id"]}'>Delete</a></button>
            </td>
          </tr>";
  }
} else {
  echo "<tr><td colspan='6'>No members found.</td></tr>";
}
?>