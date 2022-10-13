<?php
ob_start();
include("../navbar/navbar.php");
require_once("../db/db_connection.php");
$conn = newcon();
$buffer=ob_get_contents();
ob_end_clean();

$buffer=str_replace("%TITLE%","anime list",$buffer);
echo $buffer;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<link rel="stylesheet" href="../homepage/pagestyle.css">
<link rel="stylesheet" href="../navbar/navbar_style.css">
<link rel="stylesheet" href="listStyle.css">
<link rel="stylesheet" href="filterStyle.css">
<script src="../jquery-3.6.0.js"></script>
<body>
<div id="wrapper">
    <?php
    if(isset($_SESSION["userEmail"])){
    ?>
    <div id="wrapperFilter">
        <form id="filterForm" method="post">
            <label for="genre" class="genre"></label>
            <select id="genre" name="genre" onchange="SelectBrand()">
            <option value="" disabled selected hidden>Choose the genre</option>
                <option value=''>All genres</option>
                <?php
                $query = "SELECT * FROM genres";
                $sth = $conn->prepare($query);
                $result = $sth->execute();
                $totalRows = $sth->rowCount();

                if ($totalRows > 0) {
                    // output data of each row
                    while ($row = $sth->fetch()) {
                        echo "<option value='" . $row["name"] . "'>" . $row["name"] . "</option>";
                    }
                }
                }
                ?>
            </select>
        </form>
    </div>
    <div id="wrapper2">
    <form name="animeList" method="post" action="process.php">
        <table>
            <thead>

            </thead>
            <tbody id="ans">
            </tbody>
        </table>

     <?php
     if(isset($_SESSION["userEmail"])) {
         $query = "SELECT afbeelding, account_email, idanimes, name, genre, rating, bool FROM animes INNER JOIN account_has_animes 
ON idanimes = animes_idanimes
WHERE account_email = '" . $_SESSION["userEmail"] . "'";

         $sth2 = $conn->prepare($query);
         $result = $sth2->execute();
         $totalRows2 = $sth->rowCount();

         if ($totalRows2 > 0) {
             // output data of each row
             while ($row = $sth2->fetch()) {

                 $_SESSION["animeAray"][] = $row;
                 $afbeelding = $row["afbeelding"];
                 $nameAnime = $row["name"];
                 $genreAnime = $row["genre"];
                 $idAfbeelding = $row["idanimes"];
                 $boolean = $row["bool"];
                 $email = $row["account_email"];

                 echo "<div class='animeBox'>";
                 echo $nameAnime;
                 echo "<img src ='$afbeelding'>";
                 echo "genre: " . $genreAnime;
                 echo "<br>";

                 for ($i = 1; $i < 6; $i++) {
                     //displays 0 star rating
                     if ($row["rating"] < 1) {
                         echo "<button class='starRatingBtn' type='submit' name='rating' value='" . $i . +$idAfbeelding . "'><span>" . "&#9734" . "</span></button>";
                     }
                     //displays 1 star rating
                     if ($row["rating"] == 1) {
                         if ($i === 2) {
                             echo "<button class='starRatingBtn' type='submit' name='rating' value='" . $i . +$idAfbeelding . "'><span>" . "&#9733" . "</span></button>";
                         }
                         if ($i > 1) {
                             echo "<button class='starRatingBtn' type='submit' name='rating' value='" . $i . +$idAfbeelding . "'><span>" . "&#9734" . "</span></button>";
                         }
                     }
                     //displays 2 star rating
                     if ($row["rating"] == 2) {
                         if ($i < 3) {
                             echo "<button class='starRatingBtn' type='submit' name='rating' value='" . $i . +$idAfbeelding . "''><span>" . "&#9733" . "</span></button>";
                         }
                         if ($i > 2) {
                             echo "<button class='starRatingBtn' type='submit' name='rating' value='" . $i . +$idAfbeelding . "''><span>" . "&#9734" . "</span></button>";
                         }
                     }
                     //displays 3 star rating
                     if ($row["rating"] == 3) {
                         if ($i < 4) {
                             echo "<button class='starRatingBtn' type='submit' name='rating' value='" . $i . +$idAfbeelding . "'><span>" . "&#9733" . "</span></button>";
                         }
                         if ($i > 3) {
                             echo "<button class='starRatingBtn' type='submit' name='rating' value='" . $i . +$idAfbeelding . "'><span>" . "&#9734" . "</span></button>";
                         }
                     }
                     //displays 4 star rating
                     if ($row["rating"] == 4) {
                         if ($i < 5) {
                             echo "<button class='starRatingBtn' type='submit' name='rating' value='" . $i . +$idAfbeelding . "''><span>" . "&#9733" . "</span></button>";
                         }
                         if ($i > 4) {
                             echo "<button class='starRatingBtn' type='submit' name='rating' value='" . $i . +$idAfbeelding . "''><span>" . "&#9734" . "</span></button>";
                         }
                     }
                     //displays 5 star rating
                     if ($row["rating"] == 5) {
                         if ($i < 6) {
                             echo "<button class='starRatingBtn' type='submit' name='rating' value='" . $i . +$idAfbeelding . "''><span>" . "&#9733" . "</span></button>";
                         }
                     }
                 }
                 //if anime is not in database display this button
                 if ($boolean == 0) {
                     echo " <button name='add2List' id='addButton' type='submit' value='" . $idAfbeelding . "'><span class='favList'>&#128150;</span></button>";
                 } elseif ($boolean == 1) {
                     echo " <button name='deleteFromList' id='deleteButton' type='submit' value='" . $idAfbeelding . "'><span class='favList' style='float: right; color: red; width: 40px; height: 40px'>&#128148;</span></button>";
                 }
                 echo "</div>";
             }
         }
         echo "</form>";
         echo "</div>";
     } else {
         echo "<div id='textBox2'>" . "register to rate animes!" . "<br>" .
             "<a href='../register/registerpage.php'>" . "CLICK HIER!" . "</a>" .
             "</div>";
     }

        $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        //Popup error code if you are not logged in
        if(strpos($fullurl, "not-logged-in") == true){
            ?>
            <div class="error" id="errorNotLoggedin"> <header>PLEASE LOG IN</header>
            </div>
            <script>
                setTimeout("hidepopup2()", 1500);
            </script>
        <?php
        }
        if(strpos($fullurl, "successfully") == true){
        ?>
            <div class="noError" id="errorNotLoggedin"><header>Succesfully Added</header>
            </div>
            <script>
                setTimeout("hidepopup()", 1500);
            </script>
        <?php
        }
     if(strpos($fullurl, "successfullyremoved") == true){
         ?>
         <div class="noError" id="errorNotLoggedin"><header>Succesfully Removed</header>
         </div>
         <script>
             setTimeout("hidepopup()", 1500);
         </script>
         <?php
     }
        ?>
        <script src="filterpage.js">
            declareBoxId();
        </script>
</body>
</html>
