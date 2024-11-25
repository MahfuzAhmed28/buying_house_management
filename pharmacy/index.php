<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="login1.css">
    <title>Login</title>
</head>

<body>

    <div class="header">
        <h1>ESSENTIAL CLOTING LIMITED</h1>
        <!--<p style="margin-top:-20px;line-height:1;font-size:30px;">A Database Management Systems Project</p>
        <p style="margin-top:-20px;line-height:1;font-size:20px;">Department of Computer Science and Engineering</p>-->
    </div>

    <br><br><br><br>
    <div class="container">
        <form method="post" action="">
            <div id="div_login">
                <h1>Admin Login</h1>
                <center>
                    <div>
                        <input type="text" class="textbox" id="uname" name="username" placeholder="Username" />
                    </div>
                    <div>
                        <input type="password" class="textbox" id="pwd" name="password" placeholder="Password" />
                    </div>
                    <div>
                        <input type="submit" value="Submit" name="submit" />
                        <!--<button name = "login" style="padding: 5px 20px;background: #017CBF"><i class = "glyphicon glyphicon-log-in"> Login</i></button>-->
                        <!--<input type="submit" value="Click here for Pharmacist Login" name="psubmit" />-->
                        <?php
                        include "config.php";
                        // Admin credentials
                        $adminUsername = 'groupf';
                        $adminPassword = '12345';

                        // Check if form data is submitted
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $inputUsername = isset($_POST['username']) ? $_POST['username'] : '';
                            $inputPassword = isset($_POST['password']) ? $_POST['password'] : '';

                            $query = $conn->query("SELECT * FROM `ecl_employee` WHERE (`employee_username` = '$inputUsername' && `employee_pass` = '$inputPassword' && `employee_dept`='Accounts') || ('$inputUsername'='md' && '$inputPassword'='md22')") or die(mysqli_error());
                            $fetch = $query->fetch_array();
                            $row = $query->num_rows;

                            $querym = $conn->query("SELECT * FROM `ecl_employee` WHERE (`employee_username` = '$inputUsername' && `employee_pass` = '$inputPassword' && `employee_dept`='Marchant')|| ('$inputUsername'='md' && '$inputPassword'='md22')") or die(mysqli_error());
                            $fetchm = $querym->fetch_array();
                            $rowm = $querym->num_rows;

                            $queryc = $conn->query("SELECT * FROM `ecl_employee` WHERE (`employee_username` = '$inputUsername' && `employee_pass` = '$inputPassword' && `employee_dept`='Commercial')|| ('$inputUsername'='md' && '$inputPassword'='md22')") or die(mysqli_error());
                            $fetchc = $queryc->fetch_array();
                            $rowc = $queryc->num_rows;

                            $queryy = $conn->query("SELECT * FROM `ecl_employee` WHERE (`employee_username` = '$inputUsername' && `employee_pass` = '$inputPassword' && `employee_dept`='Yarn')|| ('$inputUsername'='md' && '$inputPassword'='md22')") or die(mysqli_error());
                            $fetchy = $queryy->fetch_array();
                            $rowy = $queryy->num_rows;

                            

                            // Check if the entered username and password match the admin credentials
                            if ($row > 0) {
                                session_start();
                                $_SESSION['user'] = $inputUsername;
                                header('location: account.php');
                                exit();
                            }
                            else if ($rowm > 0) {
                                session_start();
                                $_SESSION['user'] = $inputUsername;
                                header('location: marchant.php');
                                exit();
                            }

                            else if ($rowc > 0) {
                                session_start();
                                $_SESSION['user'] = $inputUsername;
                                header('location: commercial.php');
                                exit();
                            }
                            else if ($rowy > 0) {
                                session_start();
                                $_SESSION['user'] = $inputUsername;
                                header('location: yarn.php');
                                exit();
                            }
                            
                            
                             else {
                                echo "<p style='color:red;'>Invalid username or password!</p>";
                            }
                        }

                        if (isset($_POST['psubmit'])) {
                            header("location: mainpage.php");
                            exit();
                        }
                        ?>
                    </div>
                </center>
            </div>
        </form>
    </div>

    <div class="footer">
        <br>
         Developed by Group-F
        <br><br>
    </div>

</body>

</html>
