<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wme_project";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM detail_table,ref_table WHERE detail_table.Letter_No=ref_table.Letter_No_ref";
        
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>Letter No</th><th>Contractor Name</th><th>Letter Date</th><th>Letter Subject</th><th>Letter Body</th><th>Ref Contractor Name</th><th>Ref Letter Subject</th><th>Ref Letter Date</th><th>Ref 1</th><th>Ref 2</th><th>Ref 3</th><th>Ref 4</th></tr>";
    
    // Loop through the result and display each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['Letter_No'] . "</td>";
        echo "<td>" . $row['Contractor_Name'] . "</td>";
        echo "<td>" . $row['Letter_Date'] . "</td>";
        echo "<td>" . $row['Letter_Subject'] . "</td>";
        echo "<td>" . $row['Letter_Body'] . "</td>";
        echo "<td>" . $row['Contractor_Name_ref'] . "</td>";
        echo "<td>" . $row['ref_Letter_Subject'] . "</td>";
        echo "<td>" . $row['ref_Letter_Date'] . "</td>";
        echo "<td>" . $row['ref_1'] . "</td>";
        echo "<td>" . $row['ref_2'] . "</td>";
        echo "<td>" . $row['ref_3'] . "</td>";
        echo "<td>" . $row['ref_4'] . "</td>";
        echo "</tr>";
    }
    
    // Close the HTML table
    echo "</table>";
} else {
    echo "No results found.";
}

// Close the database connection
mysqli_close($conn);
?>
