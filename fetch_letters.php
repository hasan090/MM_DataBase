<?php
include 'database.php';

// Retrieve the selected contractor from the query parameter
$selectedContractor = $_GET['contractor'];

// Perform a database query to fetch the distinct letter numbers for the selected contractor
$sql = "SELECT DISTINCT Letter_No FROM detail_table WHERE Contractor_Name = '$selectedContractor'";
$result = mysqli_query($conn, $sql);

// Store the fetched letter numbers in an array
$letters = array();
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $letters[] = $row["Letter_No"];
  }
}

// Return the letter numbers as JSON
header('Content-Type: application/json');
echo json_encode($letters);
?>
