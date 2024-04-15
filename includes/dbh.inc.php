<?php
    //data source name
    $dsn = "mysql:host=localhost;dbname=MusicBrainz";
    $db_username = "root";
    $db_password = "";
    //php data object
    try {
        $pdo = new PDO($dsn, $db_username, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection Failed: " . $e->getMessage();
    }
?>