<?php
require("php/database.php");

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

$sql = "SELECT u.*
        FROM users u 
        WHERE u.role = 'member' AND (
            u.full_name LIKE '%$search%' OR 
            u.email LIKE '%$search%' OR 
            u.phone LIKE '%$search%' OR 
            u.fitness_level LIKE '%$search%' OR 
            u.workout_time LIKE '%$search%'
        )";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['full_name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['phone']}</td>
            <td>{$row['fitness_level']}</td>
            <td>{$row['workout_time']}</td>
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