<?php
include 'database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>

  <link rel="stylesheet" href="style.css">

  <title>MM Database</title>
</head>

<body>
  <header class="container">
    <div class="row">
      <div class="col-sm">
        <img style="    margin-left: 50%;" class="box1" src="12.png" alt="" />
      </div>
      <div class="col-sm">
        <h2 style="margin-top: 10%; margin-left: 30%;">MM Database</h2>
      </div>
      <div class="col-sm">
        <img class="box1" src="12.png" alt="" />
      </div>
    </div>
  </header>


  <center>
    <form method="GET" autocomplete="off">
      <div class="check_box">
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" />
          <label class="form-check-label" for="inlineRadio1">Letters</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" />
          <label class="form-check-label" for="inlineRadio2">Responses</label>
        </div>
      </div>
      <div class="col-md-4">
        <label for="validationCustom04" for="contractor" class="form-label">Contractor:</label>
        <select class="form-select" id="contractor" aria-label="Default select example" name="contractor">
          <option selected disabled value="">Select Contractor</option>
          
<?php
        $selectedContractor = isset($_GET['contractor']) ? $_GET['contractor'] : '';
        $sql = "SELECT DISTINCT Contractor_Name FROM detail_table";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $name = $row["Contractor_Name"];
            $selected = ($selectedContractor == $name) ? 'selected' : '';
            echo '<option value="' . $name . '" ' . $selected . '>' . $name . '</option>';
          }
        }
        ?>




        </select>
        <div class="invalid-feedback">Please select a valid state.</div>
      </div>
      <div class="col-md-4">
        <label for="validationCustom04" for="letter" class="form-label">Letter No:</label>
        <select class="form-select" id="letter" aria-label="Default select example" name="letter">
          <option selected disabled value="">Select Letter No</option>
          <?php
           $selectedContractor = isset($_GET['contractor']) ? $_GET['contractor'] : '';
          // Retrieve the selected contractor from the query parameter
          $sql = "SELECT DISTINCT Letter_No FROM detail_table WHERE Contractor_Name = '$selectedContractor'";
          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $name = $row["Letter_No"];
              // Check if the option should be selected based on the GET parameter
              $selected = isset($_GET['letter']) && $_GET['letter'] == $name ? 'selected' : '';
              echo '<option value="' . $name . '"' . $selected . '>' . $name . '</option>';
            }
          }
          ?>
        </select>
      </div>
      <input style="margin-top: 1%" class="btn btn-primary" type="submit" value="Search">
      <input style="margin-top: 1%" class="btn btn-danger" type="reset" onclick="reloadPage()" value="Reset">
    </form>
  </center>


  <br>
  <div class="main">







    <div class="col-md-2">
      <div class="col-md-12">
        <label for="validationCustom04" class="form-label">Subject:</label>
        <label class="form-control" for="validationCustom04" class="form-label">
          <?php


          $Contractor_Name = $_GET['contractor'];
          $Letter_No = $_GET['letter'];
          $stmt = $conn->prepare("SELECT * FROM detail_table WHERE Contractor_Name = ? AND Letter_No = ?");
          $stmt->bind_param("ss", $Contractor_Name, $Letter_No);
          $stmt->execute();
          $result = $stmt->get_result();



          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo $row['Letter_Subject'] . "<br>";
            }
          } else {
            echo "<p></p>";
          }
          $stmt->close();
          ?>
        </label>
      </div>
      <div class="col-md-12">
        <label for="validationCustom04" class="form-label">Date:</label>
        <label class="form-control" for="validationCustom04" class="form-label">
          <?php
          $Contractor_Name2 = $_GET['contractor'];
          $Letter_No2 = $_GET['letter'];
          $stmt2 = $conn->prepare("SELECT * FROM detail_table WHERE Contractor_Name = ? AND Letter_No = ?");
          $stmt2->bind_param("ss", $Contractor_Name2, $Letter_No2);
          $stmt2->execute();
          $result2 = $stmt2->get_result();
          if ($result2->num_rows > 0) {
            while ($row2 = $result2->fetch_assoc()) {
              echo $row2['Letter_Date'];
            }
          } else {
            echo "<p></p>";
          }
          $stmt2->close();
          ?>
        </label>
      </div>
      <br>
      <div class="main1">
        <?php
        $Contractor_Name3 = $_GET['contractor'];
        $Letter_No3 = $_GET['letter'];
        $stmt3 = $conn->prepare("SELECT * FROM detail_table WHERE Contractor_Name = ? AND Letter_No = ?");
        $stmt3->bind_param("ss", $Contractor_Name3, $Letter_No3);
        $stmt3->execute();
        $result3 = $stmt3->get_result();

        if ($result3->num_rows > 0) {
          while ($row3 = $result3->fetch_assoc()) {
            echo $row3['Letter_Body'];
          }
        } else {
          echo "<p></p>";
        }
        $stmt3->close();
        ?>
      </div>
    </div>

    <div class="col-md-2">
      <div class="col-md-12">
        <label for="validationCustom04" class="form-label">Subect:</label>
        <label class="form-control" for="validationCustom04" class="form-label">&emsp;
          <?php
          $Contractor_Name4 = $_GET['contractor'];
          $Letter_No4 = $_GET['letter'];

          $stmt4 = $conn->prepare("SELECT Letter_Subject_ref FROM detail_table JOIN ref_table ON Letter_No = Letter_No_ref WHERE Letter_No = ? AND Contractor_Name = ?");
          $stmt4->bind_param("ss", $Letter_No4, $Contractor_Name4);
          $stmt4->execute();
          $result4 = $stmt4->get_result();

          if ($result4->num_rows > 0) {
            while ($row4 = $result4->fetch_assoc()) {
              echo $row4['Letter_Subject_ref'];
            }
          } else {
            echo "";
          }

          $stmt4->close();

          ?>
        </label>
      </div>
      <div class="col-md-12">
        <label for="validationCustom04" class="form-label">Date:</label>
        <label class="form-control" for="validationCustom04" class="form-label">&emsp;
          <?php
          $Contractor_Name5 = $_GET['contractor'];
          $Letter_No5 = $_GET['letter'];

          $stmt5 = $conn->prepare("SELECT Letter_Date_ref FROM detail_table JOIN ref_table ON Letter_No = Letter_No_ref WHERE Letter_No = ? AND Contractor_Name = ?");
          $stmt5->bind_param("ss", $Letter_No5, $Contractor_Name5);
          $stmt5->execute();
          $result5 = $stmt5->get_result();

          if ($result5->num_rows > 0) {
            while ($row5 = $result5->fetch_assoc()) {
              echo $row5['Letter_Date_ref'];
            }
          } else {
            echo "";
          }

          $stmt5->close();

          ?>

        </label>
        <br>

      </div>
      <div class="main1">
        &emsp;
        <?php
        $Contractor_Name6 = $_GET['contractor'];
        $Letter_No6 = $_GET['letter'];

        $stmt6 = $conn->prepare("SELECT ref_1 FROM detail_table JOIN ref_table ON Letter_No = Letter_No_ref WHERE Letter_No = ? AND Contractor_Name = ?");
        $stmt6->bind_param("ss", $Letter_No6, $Contractor_Name6);
        $stmt6->execute();
        $result6 = $stmt6->get_result();

        if ($result6->num_rows > 0) {
          while ($row6 = $result6->fetch_assoc()) {
            echo $row6['ref_1'];
          }
        } else {
          echo "";
        }

        $stmt6->close();

        ?>
      </div>
    </div>
    <div class="col-md-2">
      <div class="col-md-12">
        <label for="validationCustom04" class="form-label">Subect:</label>
        <label class="form-control" for="validationCustom04" class="form-label">Subect:</label>
      </div>
      <div class="col-md-12">
        <label for="validationCustom04" class="form-label">Date:</label>
        <label class="form-control" for="validationCustom04" class="form-label">Date:</label>
        <br>

      </div>
      <div class="main1">
        &emsp;
        <?php
        $Contractor_Name7 = $_GET['contractor'];
        $Letter_No7 = $_GET['letter'];

        $stmt7 = $conn->prepare("SELECT ref_2 FROM detail_table JOIN ref_table ON Letter_No = Letter_No_ref WHERE Letter_No = ? AND Contractor_Name = ?");
        $stmt7->bind_param("ss", $Letter_No7, $Contractor_Name7);
        $stmt7->execute();
        $result7 = $stmt7->get_result();

        if ($result7->num_rows > 0) {
          while ($row7 = $result7->fetch_assoc()) {
            echo $row7['ref_2'];
          }
        } else {
          echo "";
        }

        $stmt7->close();

        ?>
      </div>
    </div>

    <div class="col-md-2">
      <div class="col-md-12">
        <label for="validationCustom04" class="form-label">Subect:</label>
        <label class="form-control" for="validationCustom04" class="form-label">Subect:</label>


      </div>
      <div class="col-md-12">
        <label for="validationCustom04" class="form-label">Date:</label>
        <label class="form-control" for="validationCustom04" class="form-label">Date:</label>
        <br>



      </div>
      <div class="main1">
        &emsp;
        <?php
        $Contractor_Name8 = $_GET['contractor'];
        $Letter_No8 = $_GET['letter'];

        $stmt8 = $conn->prepare("SELECT ref_3 FROM detail_table JOIN ref_table ON Letter_No = Letter_No_ref WHERE Letter_No = ? AND Contractor_Name = ?");
        $stmt8->bind_param("ss", $Letter_No8, $Contractor_Name8);
        $stmt8->execute();
        $result8 = $stmt8->get_result();

        if ($result8->num_rows > 0) {
          while ($row8 = $result8->fetch_assoc()) {
            echo $row8['ref_3'];
          }
        } else {
          echo "";
        }

        $stmt8->close();

        ?>
      </div>
    </div>

    <div class="col-md-2">
      <div class="col-md-12">
        <label for="validationCustom04" class="form-label">Subect:</label>
        <label class="form-control" for="validationCustom04" class="form-label">Subect:</label>
      </div>
      <div class="col-md-12">
        <label for="validationCustom04" class="form-label">Date:</label>
        <br>
        <label class="form-control" for="validationCustom04" class="form-label">Date:</label>
        <br>


      </div>
      <div class="main1">
        &emsp;
        <?php
        $Contractor_Name9 = $_GET['contractor'];
        $Letter_No9 = $_GET['letter'];

        $stmt9 = $conn->prepare("SELECT ref_4 FROM detail_table JOIN ref_table ON Letter_No = Letter_No_ref WHERE Letter_No = ? AND Contractor_Name = ?");
        $stmt9->bind_param("ss", $Letter_No9, $Contractor_Name9);
        $stmt9->execute();
        $result9 = $stmt9->get_result();

        if ($result9->num_rows > 0) {
          while ($row9 = $result9->fetch_assoc()) {
            echo $row9['ref_4'];
          }
        } else {
          echo "";
        }

        $stmt9->close();

        ?>
      </div>



      <div class="main1">

        <div class="main1">
          &emsp;
          <?php
          $Contractor_Name10 = $_GET['contractor'];
          $Letter_No10 = $_GET['letter'];

          $stmt10 = $conn->prepare("SELECT ref_3 FROM detail_table JOIN ref_table ON Letter_No = Letter_No_ref WHERE Letter_No = ? AND Contractor_Name = ?");
          $stmt10->bind_param("ss", $Letter_No10, $Contractor_Name10);
          $stmt10->execute();
          $result10 = $stmt10->get_result();

          if ($result10->num_rows > 0) {
            while ($row10 = $result10->fetch_assoc()) {
              $ref_3 = $row10['ref_3'];

              $stmt11 = $conn->prepare("SELECT Letter_body FROM detail_table WHERE ref_3 = ?");
              $stmt11->bind_param("s", $ref_3);
              $stmt11->execute();
              $result11 = $stmt11->get_result();

              if ($result11->num_rows > 0) {
                while ($row = $result11->fetch_assoc()) {
                  echo "Letter Body: " . $row['Letter_body'] . "<br>";
                }
              } else {
                echo "No matching letter body found";
              }

              $stmt11->close();
            }
          } else {
            echo "";
          }

          $stmt10->close();

          ?>
        </div>

      </div>
    </div>
  </div>
  <script src="javascript.js"></script>



</body>

</html>