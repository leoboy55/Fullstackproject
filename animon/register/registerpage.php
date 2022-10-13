<?php
ob_start();
include("../navbar/navbar.php");
$buffer=ob_get_contents();
ob_end_clean();

$buffer=str_replace("%TITLE%","register/login",$buffer);
echo $buffer;
require_once ("../db/db_connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>register</title>
</head>
<link rel="stylesheet" href="../homepage/pagestyle.css">
<link rel="stylesheet" href="../navbar/navbar_style.css">
<link rel="stylesheet" href="registerstyle.css">
<body>
<div class="hero">
    <div class="form-box">
        <div class="button-box">
            <div id="button"></div>
            <button type="button" class="button-style" onclick="login()">LOG IN</button>
            <button type="button" class="button-style" onclick="register()">REGISTER</button>
        </div>
        <div class="social-icons">
            <img src="../src/google.png" alt="google">
        </div>
        <form id="log-in" class="input-group" action="proces.php" method="post">
                <input type="email" class="input-field" name="email-l" placeholder="Emailadres" required>
                <input type="password" class="input-field" name="password-l" placeholder="Password" required>
            <button type="submit" name="login" class="submit-btn" id="submit-btn">Log In</button>
        </form>
        <form id="register" class="input-group" action="proces.php" method="post">
                <input type="text" name="nickname" class="input-field" placeholder="Nickname" required>
                <input type="email" name="email" class="input-field" placeholder="Emailadres" required>
                <input type="password" name="password" class="input-field" placeholder="Password" required>
            <button type="submit" name="register" class="submit-btn">Register</button>
        </form>
    </div>
</div>
<?php
if (isset($_SESSION["error"]) && $_SESSION["error"] == true){
?>
<script>alert("Verkeerde Email of wachtwoord")</script>
<?php
    $_SESSION["error"] = false;
}
?>
<script>
    const x = document.getElementById("log-in");
    const y = document.getElementById("register");
    const z = document.getElementById("button");

    function register() {
        x.style.display = "none";
        y.style.display = "initial";
        y.style.left = "50px";
        y.style.height = "332px";
        z.style.left = "102px";
    }

    function login() {
        y.style.display = "none";
        x.style.display = "initial";
        x.style.left = "50px";
        z.style.left = "-2px";
    }

</script>
</body>
</html>

