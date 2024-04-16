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
    // Retrieve track name and rating from the form
    $track_name = $_POST["track_name"];
    $rating = $_POST["rating"];

    try {
        // Prepare the SQL statement to insert rating into database
        $stmt = $pdo->prepare("INSERT INTO ratings (user_id, track_id, `ratings(out of 10)`) VALUES (:user_id, (SELECT track_id FROM tracks WHERE track_name = :track_name), :rating)");
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->bindParam(':track_name', $track_name);
        $stmt->bindParam(':rating', $rating);
        $stmt->execute();

        // Redirect to success page after adding rating
        header("Location: ../includes/dashboard.php");
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
}
?>
