<?php

require_once("../db/db_connection.php");
session_start();

$error = false;

//register user into db
if (isset($_POST['register'])) {
    $nickname = $_POST["nickname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $conn = newcon();
    $sth2 = $conn->prepare('INSERT INTO account (email, nickname, password) VALUES (:email , :nickname , :password)');
    $sth2->bindParam(':email', $email, PDO::PARAM_STR, 45);
    $sth2->bindParam(':nickname', $nickname, PDO::PARAM_STR, 45);
    $sth2->bindParam(':password', $password, PDO::PARAM_STR, 500);
    $result2 = $sth2->execute();

    if ($result2 === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $result2 . "<br>" . $conn->error;
    }
    $_SESSION["userSession"] = $nickname;
    $_SESSION["userEmail"] = $email;

    $query2 =
        "
        INSERT INTO account_has_animes (account_email, animes_idanimes,bool,rating) VALUES ('" . $_SESSION["userEmail"] . "', 6, 0, 0);
    INSERT INTO account_has_animes (account_email, animes_idanimes,bool,rating) VALUES ('" . $_SESSION["userEmail"] . "', 7, 0, 0);
    INSERT INTO account_has_animes (account_email, animes_idanimes,bool,rating) VALUES ('" . $_SESSION["userEmail"] . "', 8, 0, 0);
    INSERT INTO account_has_animes (account_email, animes_idanimes,bool,rating) VALUES ('" . $_SESSION["userEmail"] . "', 9, 0, 0);
    INSERT INTO account_has_animes (account_email, animes_idanimes,bool,rating) VALUES ('" . $_SESSION["userEmail"] . "', 10, 0, 0);
    INSERT INTO account_has_animes (account_email, animes_idanimes,bool,rating) VALUES ('" . $_SESSION["userEmail"] . "', 11, 0, 0);
    INSERT INTO account_has_animes (account_email, animes_idanimes,bool,rating) VALUES ('" . $_SESSION["userEmail"] . "', 12, 0, 0);
    INSERT INTO account_has_animes (account_email, animes_idanimes,bool,rating) VALUES ('" . $_SESSION["userEmail"] . "', 13, 0, 0);
    INSERT INTO account_has_animes (account_email, animes_idanimes,bool,rating) VALUES ('" . $_SESSION["userEmail"] . "', 14, 0, 0);
    INSERT INTO account_has_animes (account_email, animes_idanimes,bool,rating) VALUES ('" . $_SESSION["userEmail"] . "', 15, 0, 0);
    ";

    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);
    $sth3 = $conn->prepare($query2);
    $sth3->execute();
    $sth3 = null;
    $sth2 = null;
    $conn = null;
    header("location: ../homepage/index.php");
}
//log in user
if(isset($_POST['email-l']) && isset($_POST['password-l'])){
    $emailUser = $_POST['email-l'];
    $passwordUser = $_POST['password-l'];
    $conn = newcon();
    $sth = $conn->prepare("SELECT email, password, nickname FROM account WHERE email = :email AND password = :password");
    $sth->bindParam(':email', $emailUser, PDO::PARAM_STR, 45);
    $sth->bindParam(':password', $passwordUser, PDO::PARAM_STR, 500);
    $result = $sth->execute();
    $totalrows = $sth->rowCount();

    if ($totalrows > 0) {
        // output data of each row
        while($row = $sth->fetch()) {
            echo "email: " . $row["email"]. " - ww: " . $row["password"]. "  -naam: " . $row["nickname"]. "<br>";
            $_SESSION["userSession"] = $row["nickname"];
            $_SESSION["userEmail"] = $row["email"];
            header("location: ../homepage/index.php");
        }
    } else {
        header("location: registerpage.php");
        $error = true;
        $_SESSION["error"] = $error;
    }
    $sth = null;
    $conn = null;
}


