<?php

require_once ("../db/db_connection.php");
session_start();

//adding anime to your favourite list
if (isset($_POST["add2List"]) && isset($_SESSION["userEmail"])){
    $_SESSION["id"] = $_POST["add2List"];
    $conn = newcon();
    $query = "INSERT INTO account_has_animes (account_email, animes_idanimes, bool) VALUES ('" . $_SESSION["userEmail"] . "' , '" . $_SESSION['id'] . "', 1)
     ON DUPLICATE KEY UPDATE bool = 1";

    $sth = $conn->prepare($query);
    $result = $sth->execute();
    $totalRows = $sth->rowCount();

    if ($totalRows > 0) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
    $sth = null;
    header("location: list.php?added=successfully");
}
//error if you are not logged in
else {
    header("location: list.php?added=not-logged-in");
}

//deleting anime from your favourite list
if (isset($_POST["deleteFromList"]) && isset($_SESSION["userEmail"])){
    $_SESSION["id"] = $_POST["deleteFromList"];
    $conn = newcon();
    $query3 = "UPDATE account_has_animes SET bool = 0 WHERE animes_idanimes = '" . $_SESSION["id"] . "' AND account_email = '" . $_SESSION["userEmail"] ."'";
    $sth = $conn->prepare($query3);
    $result3 = $sth->execute();

    $sth = null;
    header("location: list.php?added=successfullyremoved");
}

//adding rating to anime
if(isset($_POST["rating"]) && isset($_SESSION["userEmail"])){
    $array = str_split($_POST["rating"]);
    foreach ($array as $value){
        if($value < 6){
            $rating = $value;
        }
        elseif ($value >= 6){
            $id = $value;
        }
        $_SESSION["rating"] = $rating;
        $_SESSION["id"] = $id;
    }
    echo "rating:" . $_SESSION["rating"] . "<br>";
    echo "id: " . $_SESSION["id"];

    $conn = newcon();
    $query2 = "UPDATE account_has_animes SET rating = '" . $_SESSION["rating"] . "' WHERE animes_idanimes = '" . $_SESSION["id"] . "' AND account_email = '" . $_SESSION["userEmail"] . "'";
    $sth = $conn->prepare($query2);
    $result = $sth->execute();
    $sth = null;
    header("location: list.php?added=successfully");
}


