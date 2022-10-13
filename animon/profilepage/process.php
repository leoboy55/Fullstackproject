<?php

require_once ("../db/db_connection.php");
ini_set( 'session.cookie_httponly', 1 );
ini_set('session.cookie_secure', 1);
session_start();

//add picture into database
if (isset($_POST["submitPicture"])){
    //getting database reference
$conn = newcon();

//getting the post values to session values
$_SESSION["email"] = $_POST["email"];

//creating file value
$file = $_FILES["picture"];

//extracting file values
    $filename = $_FILES["picture"]["name"];
    $fileTmpName = $_FILES["picture"]["tmp_name"];
    $fileSize = $_FILES["picture"]["size"];
    $fileError = $_FILES["picture"]["error"];
    $fileType = $_FILES["picture"]["type"];

    //selects what type of values are valid
    $fileExt = explode(".", $filename);
    $fileActualExt = strtolower(end($fileExt));

    //array which file ext are valid
    $allowed = array("jpg", "jpeg", "png", "pdf");

    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 1000000){
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'uploads/' .$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
            }
            else {
                echo "file size is to large!";
            }

        } else
        {
            echo "error uploading your file!!";
        }

    } else
    {
        echo "not a valid type file!";
    }

$query = "UPDATE account SET picture = '". $fileNameNew ."' WHERE email = '" . $_SESSION["email"] ."'";
    $sth = $conn->prepare($query);
    $result = $sth->execute();
    $sth = null;
    header("location: profilepage.php?added=successfully");
}

