<?php
require("php/database.php");

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

$sql = "SELECT * FROM trainers 
        WHERE name LIKE '%$search%' OR 
              email LIKE '%$search%' OR 
              specialty LIKE '%$search%' OR 
              availability LIKE '%$search%'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['specialty']}</td>
            <td>{$row['availability']}</td>
            <td>
              <button class='view-btn'><a href='#viewtrainer'>View</a></button>
              <a href='AdminTrainers.php?delete_trainerId={$row["trainer_id"]}'><button class='delete-btn' onclick='alert()'>Delete</button></a>
            </td>
          </tr>";
  }
} else {
  echo "<tr><td colspan='5'>No trainers found.</td></tr>";
}
?> 