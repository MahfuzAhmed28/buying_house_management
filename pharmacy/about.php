<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="nav2.css">
    <link rel="stylesheet" type="text/css" href="form4.css">
    <title>About</title>
</head>

<body>

<?php require('commom.php'); ?>
    

    <div class="topnav">
        <a href="logout.php">Logout</a>
    </div>
    
    <center>
        <div class="head">
            <h1>ABOUT OUR POS SOFTWARE</h1>
        </div>
    </center>

    <br><br><br><br><br><br><br><br>
   <center>
    <section>
        <center>
            <br>
            <h1>DMEDICINA POS is a Medicine Shop Management System designed to help users manage their medicine shops efficiently.</h1>
</center>
        <h2>Features of DMEDICINA POS:</h2>
        <ul>
            <li><h4>Creation of a large medicine database by Admin or User</li>
            <li><h4>Suppliers Info</h4></li>
            <li><h4>Daily Purchase Information From Suppliers</h4></li>
            <li><h4>Employees Info</h4></li>
            <li><h4>Customer Info</h4></li>
            <li><h4>Selling Medicine to the Customer </h4></li>
            <li><h4>About Our Pos softwore</h4> </li>
            <li><h4>Developers Info</h4></li>
        </ul>

        <h3>In future , we plan to introduce additional features and improvements to enhance the functionality and usability of the application.</h4>
    </section>
<center>
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
