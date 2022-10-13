<?php
ob_start();
include("../navbar/navbar.php");
$buffer=ob_get_contents();
ob_end_clean();

$buffer=str_replace("%TITLE%","Homepage",$buffer);
echo $buffer;
require_once("../db/db_connection.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Animon Homepage</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="pagestyle.css">
<link rel="stylesheet" href="../navbar/navbar_style.css">
<link rel="stylesheet" href="homepage.css">
<script src="../jquery-3.6.0.js"></script>
<body>
<div class="card">
    <iframe src="https://www.youtube.com/embed/bT9csxkth8g" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
<label>
    <input type="text" id="live_search" placeholder="Search..">
</label>
<div id="searchresult">
</div>
<script type="text/javascript">
 $(document).ready(function () {
     $("#live_search").keyup(function () {
         let input = $(this).val();
         if(input !== ""){
             $.ajax({
                 url:"livesearch.php",
                 method: "POST",
                 data:{input:input},
                 success:function (data){
                     $("#searchresult").html(data);
                 }
             });
         } else {
             $("#searchresult").empty();
         }
     });
 });
</script>
</body>
</html>




