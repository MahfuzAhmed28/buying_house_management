<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="table1.css">
<link rel="stylesheet" type="text/css" href="nav2.css">
<head>
<title>Suppliers</title>
</head>

<body>

<?php require('commom.php'); ?>

	<div class="topnav">
		<a href="logout.php">Logout</a>
	</div>
	
	<center>
	<div class="head">
	<h2> SUPPLIERS LIST</h2>
	</div>
	</center>
	
	<table align="right" id="table1" style="margin-right:100px;">
		<tr>
			<th>Supplier ID</th>
			<th>Company Name</th>
			<th>Address</th>
			<th>Phone Number</th>
			<th>Email Address</th>
			<th>Action</th>
		</tr>
		
	<?php
	
	include "config.php";
	$sql = "SELECT sup_id,sup_name,sup_add,sup_phno,sup_mail FROM suppliers";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
	
	while($row = $result->fetch_assoc()) {

	echo "<tr>";
		echo "<td>" . $row["sup_id"]. "</td>";
		echo "<td>" . $row["sup_name"] . "</td>";
		echo "<td>" . $row["sup_add"]. "</td>";
		echo "<td>" . $row["sup_phno"]. "</td>";
		echo "<td>" . $row["sup_mail"]. "</td>";
		echo "<td align=center>";
		echo "<a class='button1 edit-btn' href=supplier-update.php?id=".$row['sup_id'].">Edit</a>";
		echo "<a class='button1 del-btn' href=supplier-delete.php?id=".$row['sup_id'].">Delete</a>";
		echo "</td>";
	echo "</tr>";
	}
	echo "</table>";
	} 

	$conn->close();
	
	?>
	
</body>

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

</html>

