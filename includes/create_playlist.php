<?php
include_once '../includes/dbh.inc.php';

if (!$pdo) {
    die("Database connection failed.");
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate playlist name
    $playlist_name = $_POST['playlist_name'];
    if (empty($playlist_name)) {
        die("Playlist name is required.");
    }

    // Validate selected songs
    $selected_songs = $_POST['selected_songs'];
    if (empty($selected_songs)) {
        die("Select at least one song for the playlist.");
    }

    try {
        // Start a transaction
        $pdo->beginTransaction();

        // Insert playlist into playlists table
        $stmt = $pdo->prepare("INSERT INTO playlists (playlist_name) VALUES (:playlist_name)");
        $stmt->bindParam(':playlist_name', $playlist_name);
        $stmt->execute();

        // Get the playlist_id of the newly inserted playlist
        $playlist_id = $pdo->lastInsertId();

        // Insert selected songs into track_playlists table
        foreach ($selected_songs as $track_id) {
            $stmt = $pdo->prepare("INSERT INTO track_playlists (playlist_id, track_id) VALUES (:playlist_id, :track_id)");
            $stmt->bindParam(':playlist_id', $playlist_id);
            $stmt->bindParam(':track_id', $track_id);
            $stmt->execute();
        }

        // Insert record into user_playlists table
        // Assume $user_id is the ID of the user creating the playlist
        $user_id = $_SESSION['user_id']; // Example session variable holding user ID
        $stmt = $pdo->prepare("INSERT INTO user_playlists (playlist_id, user_id) VALUES (:playlist_id, :user_id)");
        $stmt->bindParam(':playlist_id', $playlist_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        // Commit the transaction
        $pdo->commit();

        // Redirect to a success page or display a success message
        header("Location: ../pages/playlist_created.html");
        exit();
    } catch (Exception $e) {
        // Rollback the transaction on error
        $pdo->rollback();
        echo "Error: " . $e->getMessage();
    }
}
?>
