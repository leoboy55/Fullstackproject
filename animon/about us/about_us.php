<?php
ob_start();
include("../navbar/navbar.php");
$buffer=ob_get_contents();
ob_end_clean();

$buffer=str_replace("%TITLE%","about us",$buffer);
echo $buffer;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About Us!</title>
</head>
<link rel="stylesheet" href="../homepage/pagestyle.css">
<link rel="stylesheet" href="../navbar/navbar_style.css">
<link rel="stylesheet" href="about_us.css">
<body>
<div class="card" onclick="imgVisible()">
<div><img src="../src/goku.jpg" alt="goku" id="img1"></div>
    <div class="text">Who are we?
        <br>
        <br>
        <br>
        PRESS HERE
    </div>
</div>
<div id="textbox">
    <h2>Vision</h2>
    <p>We Want that Anime is seen as normal worldwide and not as a tabboo.</p>
</div>
</body>
</html>

<script type="text/javascript">
    const img = document.getElementById("img1");
    let boolean = false;

    function imgVisible() {
        if (boolean === false) {
            img.style.visibility = "visible";
            boolean = true;
        } else {
            img.style.visibility = "hidden";
            boolean = false;
        }
    }
</script>