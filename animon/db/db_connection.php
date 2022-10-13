<?php

function newcon() {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "fullstackproject";
    $charset = "utf8mb4";
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        $dsn = "mysql:host=$servername;dbname=$dbname;$charset=$charset";
    // Create connection
    $conn = new PDO($dsn, $username, $password, $opt);
        return $conn;
} catch (PDOException $e) {
        echo ('PDO Exception: '. $e->getMessage());
        die('PDO says no');
        }
}

