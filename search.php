<?php

    $Contractor_Name = $_GET['contractor'];
    $Letter_No = $_GET['letter'];
// Prepare the query
$stmt = $conn->prepare("SELECT * FROM detail_table WHERE Contractor_Name = ? AND Letter_No = ?");
$stmt->bind_param("ss", $Contractor_Name, $Letter_No);

// Execute the query
$stmt->execute();

// Fetch the results
$result = $stmt->get_result();

// Display the results
if ($result->num_rows > 0) {
  echo "<h2>Search Results:</h2>";
  while ($row = $result->fetch_assoc()) {
    echo  $row['Letter_Subject'] . "<br>";
    echo  $row['Letter_Date'] ;
    echo "<hr>";
  }
} else {
  echo "<p>No results found.</p>";
}

// Close the statement and database connection
$stmt->close();
$conn->close();
?>
