<?php
session_start();

// Include the database connection setup
include_once "dbh.inc.php";
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
    // Retrieve genre from the form
    $genre = $_POST["genre"];

    try {
        // Prepare the SQL statement to select tracks by genre
        $stmt = $pdo->prepare("SELECT t.* FROM tracks t INNER JOIN artist_tracks at ON t.track_id = at.track_id INNER JOIN artists a ON at.artist_id = a.artist_id WHERE a.genre = :genre");
        $stmt->bindParam(':genre', $genre);
        $stmt->execute();

        // Fetch tracks data
        $tracks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Display tracks by genre
        foreach ($tracks as $track) {
            echo "Track ID: " . $track['track_id'] . "<br>";
            echo "Track Name: " . $track['track_name'] . "<br>";
            echo "Duration (mins): " . $track['duration(mins)'] . "<br>";
            echo "Release Date: " . $track['release_date'] . "<br><br>";
        }
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
}
?>
