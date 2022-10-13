<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>%TITLE%</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="navbar_style.css">
<body>
<div class="container1">
    <div class="row">
        <div class="col" id="logo">
            <img id="logo" src="../src/logo.jpg" alt="logo">
        </div>
        <div class="col" id="home">
            <a href="../homepage/index.php"><strong>HOME</strong></a>
        </div>
        <div class="col" id="animeList">
            <a href="../Animelist/list.php"><strong>ANIME LIST</strong></a>
        </div>
        <div class="col-md-3" id="about">
            <a href="../about%20us/about_us.php"><strong>ABOUT US</strong></a>
        </div>
            <?php
                    if(isset($_SESSION["userSession"])){
                        ?>
                            <div class="col" id="account">
                    <button id="accountbtn" onclick="showMenu()"><strong style='color: deepskyblue'>ACCOUNT</strong></button>
                            </div>
            <?php
                    }
                    else {
                        echo "<div class='col' id='register1'>";
                        echo "<a href='../register/registerpage.php'><strong style='color: deepskyblue'>REGISTER / LOG IN</strong></a>";
                        echo "</div>";
                    }
            ?>
    </div>
</div>
<div id="dropDownMenu">
    <span id="1"> <a href="../profilepage/profilepage.php">MY LIST</a></span>
    <span id="2"> <a href="../homepage/logout.php">LOGOUT</a></span>
</div>
</body>
<script>

    const dropDownMenu = document.getElementById("dropDownMenu");
    let bool = false;

    function showMenu() {
        if(bool === false) {
            dropDownMenu.style.visibility = "visible";
            bool = true;
        }
        else {
            dropDownMenu.style.visibility = "hidden";
            bool = false
        }
    }
</script>
</html>