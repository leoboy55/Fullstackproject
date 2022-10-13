<?php
ob_start();
include("../navbar/navbar.php");
require_once("../db/db_connection.php");
$conn = newcon();
$buffer=ob_get_contents();
ob_end_clean();

$buffer=str_replace("%TITLE%","profile page",$buffer);
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
<link rel="stylesheet" href="profilepagestyle.css">
<link rel="stylesheet" href="../homepage/pagestyle.css">
<link rel="stylesheet" href="../navbar/navbar_style.css">
<body>
<div id="wrapper">
    <div id="profileSection">
        <div id="profileNameHolder">
            <text><?php

                $query = "SELECT nickname, picture, email FROM account WHERE email = '" . $_SESSION["userEmail"] . "'";
                $sth = $conn->prepare($query);
                $result = $sth->execute();
                $totalRows = $sth->rowCount();

                if ($totalRows > 0) {
                    // output data of each row
                    while ($row = $sth->fetch()) {
                        $profilePicture = $row["picture"];
                        $email = $row["email"];
                        echo htmlspecialchars($row["nickname"]);

                ?></text>
        </div>
        <div id="profilePictureHolder">
            <img style="border-radius: 50%; width: 195px; height: 195px" src="uploads/<?php
            if($profilePicture == null){
                echo "profile.png";
            } else {
                echo $profilePicture;
            }
            ?>" alt="profile-Picture">
        </div>
        <form id="form" name="upload" method="post" action="process.php" enctype="multipart/form-data">
        <div id="uploadHolder">
                <input class="uploadButton" name="picture" value="" type="file" accept=".jpg, .jpeg, .png">
            <input type="hidden" name="email" value="<?php echo $email ?>">
        </div>
            <div id="buttonHolder">
                <button id="button" name="submitPicture" value="" type="submit">Upload</button>
            </div>
        </form>
    </div>
</div>
<?php
                    }
}
                ?>
<div id="AnimeList"><h1>YOUR ANIME LIST &#10084;</h1></div>
<wrapper id="wrapperAnimeList">
        <?php
        $query2 = "SELECT afbeelding, account_email, idanimes, name, genre, rating, bool FROM animes INNER JOIN account_has_animes 
ON idanimes = animes_idanimes WHERE bool = 1 AND account_email = '" . $_SESSION["userEmail"] . "'";
        $sth = $conn->prepare($query2);
        $result = $sth->execute();
        $totalRows = $sth->rowCount();

        if ($totalRows > 0) {
            // output data of each row
            while ($row = $sth->fetch()) {
                $_SESSION["animeAray"][] = $row;
                $afbeelding = $row["afbeelding"];
                $nameAnime = $row["name"];
                $genreAnime = $row["genre"];
                $idAfbeelding = $row["idanimes"];
                $boolean = $row["bool"];
                $email = $row["account_email"];

                echo "<div class='animeBox'>";
                echo "<div class='name'>" . $nameAnime . "</div>";
                echo "<img src ='$afbeelding'>";
                echo "genre: " . $genreAnime;
                echo "<br>";
                echo "<br>";
                echo "</div>";
            }
        } else {
            echo "no animes added yet!";
        }
        $sth = null;
        ?>
</wrapper>
</body>
<script src="../jquery-3.6.0.js"></script>
<script src="mobileVersion.js">
</script>
</html>