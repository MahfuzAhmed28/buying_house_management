<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="nav2.css">
    <link rel="stylesheet" type="text/css" href="form4.css">
    <title>Help</title>
</head>

<body>

<?php require('commom.php'); ?>
   

    <div class="topnav">
        <a href="logout.php">Logout</a>
    </div>
    
    <center>
        <div class="head">
            <h1>DEVELOPERS INFO</h1>
        </div>
    </center>

    <br><br><br><br><br><br><br><br>
   <center>
    <section>
        
<br>
<br>
    <h2>DMEDICINA POS Software is developed by students of computer Science and Engineering Department of  IUBAT  </h2>
        
        <h2>&nbsp; Developers Details:</h2>
        <ul>
        <li><h4>BYADHANATH BISWAS </h4></li>
            <li><h4>Md. Shorifuzzaman</h4></li>
            <li><h4>Md. Shafi Hasan </h4></li>
            <li><h4>Nahida Ahamed Suma </h4></li>
            <li><h4>Sadia </h4></li>
           
        </ul>
    </section>
</center>
<br>
<center>
    <section>
        

        
        <h2>Contact Info:</h2>
        <ul>
            <li><h4>Phone No :+8801952952154 </h4> </li>
            <li><h4>Email: biswashridoy528@gmail.com</h4></li>
        </ul>
    </section>
</center>


<br>
         <center>
            <h1> THANKS ALL </h1>
</center>
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
