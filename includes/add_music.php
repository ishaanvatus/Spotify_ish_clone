<?php
session_start();

// Include the database connection setup
include_once "../includes/dbh.inc.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: ../pages/login.html");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve track details from the form
    $track_name = $_POST["track_name"];
    $duration = $_POST["duration"];
    $release_date = $_POST["release_date"];

    try {
        // Prepare the SQL statement to insert track into database
        $stmt = $pdo->prepare("INSERT INTO tracks (track_name, `duration(mins)`, release_date) VALUES (:track_name, :duration, :release_date)");
        $stmt->bindParam(':track_name', $track_name);
        $stmt->bindParam(':duration', $duration);
        $stmt->bindParam(':release_date', $release_date);
        $stmt->execute();

        // Redirect to dashboard or another page after adding track
        header("Location: ../pages/add_music.html");
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
}
?>
