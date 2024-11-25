<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="nav2.css">
    <link rel="stylesheet" type="text/css" href="form3.css">
    <link rel="stylesheet" type="text/css" href="table2.css">
    <title>New Sales</title>
</head>

<body>

    <?php require('commom.php'); ?>

    <div class="topnav">
        <a href="logout.php">Logout</a>
    </div>

    <center>
        <div class="head">
            <h2>Add New Sale</h2>
        </div>
    </center>

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <center>
            <select id="cid" name="cid">
                <option value="0" selected="selected">*Select Customer ID (only once for a customer's sales)</option>

                <?php
                include "config.php";
                $qry = "SELECT c_id FROM customer";
                $result = $conn->query($qry);
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option>" . $row["c_id"] . "</option>";
                    }
                }
                ?>

            </select>
            &nbsp;&nbsp;
            <input type="submit" name="custadd" value="Add to Proceed.">
    </form>

    <?php
    session_start();

    $qry1 = "SELECT id from admin where a_username='$_SESSION[user]'";
    $result1 = $conn->query($qry1);
    if ($result1 && $result1->num_rows > 0) {
        $row1 = $result1->fetch_row();
        $eid = $row1[0];
    }

    if (isset($_POST['cid'])) {
        $cid = $_POST['cid'];
        if (isset($_POST['custadd'])) {
            $qry2 = "INSERT INTO sales(c_id,e_id) VALUES ('$cid','$eid')";
            if (!($result2 = $conn->query($qry2))) {
                echo "<p style='font-size:8; color:red;'>Invalid! Enter valid Customer ID to record Sales.</p>";
            }
        }
    }

    ?>

    <form method="post">
        <select id="med" name="med">
            <option value="0" selected="selected">Select Medicine</option>

            <?php
            $qry3 = "SELECT med_name FROM meds";
            $result3 = $conn->query($qry3);
            if ($result3 && $result3->num_rows > 0) {
                while ($row4 = $result3->fetch_assoc()) {
                    echo "<option>" . $row4["med_name"] . "</option>";
                }
            }
            ?>

        </select>
        &nbsp;&nbsp;
        <input type="submit" name="search" value="Search">
    </form>

    <br><br><br>
    </center>

    <?php
    if (isset($_POST['search']) && !empty($_POST['med'])) {
        $med = $_POST['med'];
        $qry4 = "SELECT * FROM meds where med_name='$med'";
        $result4 = $conn->query($qry4);
        $row4 = $result4->fetch_row();
    }
    ?>

    <div class="one row" style="margin-right:160px;">
        <form method="post">
            <div class="column">

                <label for="medid">Medicine ID:</label>
                <input type="number" name="medid" value="<?php echo isset($row4[0]) ? $row4[0] : ''; ?>"><br><br>

                <label for="mdname">Medicine Name:</label>
                <input type="text" name="mdname" value=""><br><br>

            </div>
            <div class="column">

                <label for="mcat">Category:</label>
                <input type="text" class="form-control" name="mcat"><br><br>

                <label for="mloc">Location:</label>
                <input type="text" name="mloc" value=""><br><br>

            </div>
            <div class="column">

               

                <label for="mprice">Price of One Unit:</label>
                <input type="number" name="mprice" value=""><br><br>

            </div>
            <label for="mcqty">Quantity Required:</label>
            <input type="number" name="mcqty">
            &nbsp;&nbsp;&nbsp;
            <input type="submit" name="add" value="Add Medicine">&nbsp;&nbsp;&nbsp;

            <?php




if (isset($_POST['add'])) {
    // Get the latest sale_id from the sales table
    $qry5 = "SELECT sale_id FROM sales ORDER BY sale_id DESC LIMIT 1";
    $result5 = $conn->query($qry5);
    if ($result5 && $result5->num_rows > 0) {
        $row5 = $result5->fetch_assoc();
        $sid = $row5['sale_id'];
    } else {
        // Handle the case where no sale_id is found (optional)
        echo "Error: Unable to fetch sale_id.";
        exit;
    }
    
    // Get form inputs
    $mid = $_POST['medid'];
    $qty = (int)$_POST['mcqty'];
    $price_per_unit = (float)$_POST['mprice'];
    $total_price = $price_per_unit * $qty; // Define total_price as a variable

    // Check for existing entry in the sales_items table
    $check_query = "SELECT sale_qty, tot_price FROM sales_items WHERE sale_id = ? AND med_id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ii", $sid, $mid);
    $stmt->execute();
    $check_result = $stmt->get_result();

    if ($check_result->num_rows > 0) {
        // Record exists, update the existing entry
        $existing_row = $check_result->fetch_assoc();
        $new_sale_qty = $existing_row['sale_qty'] + $qty;
        $new_tot_price = $existing_row['tot_price'] + $total_price; // Use the defined total_price variable

        $update_query = "UPDATE sales_items SET sale_qty = ?, tot_price = ? WHERE sale_id = ? AND med_id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("idii", $new_sale_qty, $new_tot_price, $sid, $mid);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Medicine updated successfully.";
        } else {
            echo "Error updating medicine.";
        }
    } else {
        // Record does not exist, insert a new entry
        $insert_query = "INSERT INTO sales_items (sale_id, med_id, sale_qty, tot_price) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("iiid", $sid, $mid, $qty, $total_price); // Use the defined total_price variable
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Medicine added successfully.";
        } else {
            echo "Error adding medicine.";
        }
    }

    // Close the statement
    $stmt->close();

    // Provide a link to view the order
    echo "<br><br> <center>";
    echo "<a class='button1 view-btn' href=pos2.php?sid=" . $sid . ">View Order</a>";
    echo "</center>";
}






            ?>

        </form>
    </div>

    <script>
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
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
