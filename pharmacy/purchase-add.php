<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="nav2.css">
    <link rel="stylesheet" type="text/css" href="form4.css">
    <title>Purchases</title>
</head>

<body>

<?php require('commom.php'); ?>
    if (file_exists($commonFilePath)) {
        require($commonFilePath);
    } else {
        echo "<p style='color:red;'>Error: Required file 'common.php' not found.</p>";
        exit; // Stop the script execution if the file is missing
    }
    ?>

    <div class="topnav">
        <a href="logout.php">Logout</a>
    </div>
    
    <center>
        <div class="head">
            <h2>ADD PURCHASE DETAILS</h2>
        </div>
    </center>

    <br><br><br><br><br><br><br><br>

    <div class="one row">
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                
        <?php
        // Include the database configuration file
        include "config.php";

        // Initialize variables to store form inputs
        $pid = $sid = $mid = $qty = $cost = $pdate = $mdate = $edate = "";

        // Check if the form is submitted
        if (isset($_POST['add'])) {
            // Get the form input values
            $pid = mysqli_real_escape_string($conn, $_REQUEST['pid']);
            $sid = mysqli_real_escape_string($conn, $_REQUEST['sid']);
            $mid = mysqli_real_escape_string($conn, $_REQUEST['mid']);
            $qty = mysqli_real_escape_string($conn, $_REQUEST['pqty']);
            $cost = mysqli_real_escape_string($conn, $_REQUEST['pcost']);
            $pdate = mysqli_real_escape_string($conn, $_REQUEST['pdate']);
            $mdate = mysqli_real_escape_string($conn, $_REQUEST['mdate']);
            $edate = mysqli_real_escape_string($conn, $_REQUEST['edate']);

            // Check if the provided MED_ID exists in the meds table
            $check_med_id_query = "SELECT * FROM meds WHERE MED_ID = '$mid'";
            $result = mysqli_query($conn, $check_med_id_query);

            if (mysqli_num_rows($result) > 0) {
                // MED_ID exists in meds table, proceed with insertion
                $sql = "INSERT INTO purchase (P_ID, SUP_ID, MED_ID, P_QTY, P_COST, PUR_DATE, MFG_DATE, EXP_DATE) 
        VALUES ('$pid', '$sid', '$mid', '$qty', '$cost', '$pdate', '$mdate', '$edate')";

                // Execute the query and handle errors
                if (mysqli_query($conn, $sql)) {
                    echo "<p style='font-size:8;'>Purchase details successfully added!</p>";
                } else {
                    echo "<p style='font-size:8;color:red;'>Error! Could not add purchase details: " . mysqli_error($conn) . "</p>";
                }
            } else {
                echo "<p style='font-size:8;color:red;'>Error! MED_ID does not exist in the meds table.</p>";
            }
        }

        // Close the database connection
        if (isset($conn)) {
            mysqli_close($conn);
        }
        ?>

        <div class="column">
            <p>
                <label for="pid">Purchase ID:</label><br>
                <input type="number" name="pid" required>
            </p>
            <p>
                <label for="sid">Supplier ID:</label><br>
                <input type="number" name="sid" required>
            </p>
            <p>
                <label for="mid">Medicine ID:</label><br>
                <input type="number" name="mid" required>
            </p>
            <p>
                <label for="pqty">Purchase Quantity:</label><br>
                <input type="number" name="pqty" required>
            </p>
        </div>

        <div class="column">
            <p>
                <label for="pcost">Purchase Cost:</label><br>
                <input type="number" step="0.01" name="pcost" required>
            </p>
            <p>
                <label for="pdate">Date of Purchase:</label><br>
                <input type="date" name="pdate" required>
            </p>
            <p>
                <label for="mdate">Manufacturing Date:</label><br>
                <input type="date" name="mdate" required>
            </p>
            <p>
                <label for="edate">Expiry Date:</label><br>
                <input type="date" name="edate" required>
            </p>
        </div>

        <input type="submit" name="add" value="Add Purchase">
        </form>
        <br>
    </div>

<script>
    // JavaScript for handling dropdown buttons
    var dropdown = document.getElementsByClassName("dropdown-btn");
    for (var i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
</script>

</body>
</html>
