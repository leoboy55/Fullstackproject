<?php
session_start();
require_once ("../db/db_connection.php");

$k = $_POST["id"];
$k=trim($k);
$conn = newcon();
$sqlQuery = "SELECT idanimes, account_email, name, afbeelding, bool, rating, genres_name
    FROM animes
    JOIN animes_has_genres ON animes.idanimes = animes_has_genres.animes_idanimes
    JOIN account_has_animes ON animes.idanimes = account_has_animes.animes_idanimes 
    WHERE genres_name = '{$k}' AND account_email = '" . $_SESSION["userEmail"] . "'";

$sth = $conn->prepare($sqlQuery);
$results = $sth->execute();
$totalRows = $sth->rowCount();

$results = mysqli_query($conn, $sqlQuery);

if ($totalRows > 0) {

    while ($row = $sth->fetch()) {

        $_SESSION["animeAray"][] = $row;
        $afbeelding = $row["afbeelding"];
        $nameAnime = $row["name"];
        $genreAnime = $row["genres_name"];
        $idAfbeelding = $row["idanimes"];
        $boolean = $row["bool"];

        echo "<div class='animeBoxFilter'>";
        echo $nameAnime;
        echo "<img src ='$afbeelding'>";
        echo "genre: " . $genreAnime;
        echo "<br>";

        for ($i = 1; $i < 6; $i++) {
            //displays 0 star rating
            if ($row["rating"] < 1) {
                echo "<button class='starRatingBtn' type='submit' name='rating' value='" . $i . + $idAfbeelding . "'><span>" . "&#9734" . "</span></button>";
            }
            //displays 1 star rating
            if ($row["rating"] == 1) {
                if ($i === 2) {
                    echo "<button class='starRatingBtn' type='submit' name='rating' value='" . $i . + $idAfbeelding . "'><span>" . "&#9733" . "</span></button>";
                }
                if ($i > 1) {
                    echo "<button class='starRatingBtn' type='submit' name='rating' value='" . $i . + $idAfbeelding . "'><span>" . "&#9734" . "</span></button>";
                }
            }
            //displays 2 star rating
            if ($row["rating"] == 2) {
                if ($i < 3) {
                    echo "<button class='starRatingBtn' type='submit' name='rating' value='" . $i . + $idAfbeelding . "''><span>" . "&#9733" . "</span></button>";
                }
                if ($i > 2) {
                    echo "<button class='starRatingBtn' type='submit' name='rating' value='" . $i . + $idAfbeelding . "''><span>" . "&#9734" . "</span></button>";
                }
            }
            //displays 3 star rating
            if ($row["rating"] == 3) {
                if ($i < 4) {
                    echo "<button class='starRatingBtn' type='submit' name='rating' value='" . $i . + $idAfbeelding . "'><span>" . "&#9733" . "</span></button>";
                }
                if ($i > 3) {
                    echo "<button class='starRatingBtn' type='submit' name='rating' value='" . $i . + $idAfbeelding . "'><span>" . "&#9734" . "</span></button>";
                }
            }
            //displays 4 star rating
            if ($row["rating"] == 4) {
                if ($i < 5) {
                    echo "<button class='starRatingBtn' type='submit' name='rating' value='" . $i . + $idAfbeelding . "''><span>" . "&#9733" . "</span></button>";
                }
                if ($i > 4) {
                    echo "<button class='starRatingBtn' type='submit' name='rating' value='" . $i . + $idAfbeelding . "''><span>" . "&#9734" . "</span></button>";
                }
            }
            //displays 5 star rating
            if ($row["rating"] == 5) {
                if ($i < 6) {
                    echo "<button class='starRatingBtn' type='submit' name='rating' value='" . $i . + $idAfbeelding . "''><span>" . "&#9733" . "</span></button>";
                }
            }
        }
        //if anime is not in database display this button
        if($boolean == 0) {
            echo " <button name='add2List' id='addButton' type='submit' value='" . $idAfbeelding . "'><span class='favList'>&#128150;</span></button>";
        }
        elseif ($boolean == 1){
            echo " <button name='deleteFromList' id='deleteButton' type='submit' value='" . $idAfbeelding . "'><span class='favList' style='float: right; color: red; width: 40px; height: 40px'>&#128148;</span></button>";
        }
        echo "</div>";
    }
}