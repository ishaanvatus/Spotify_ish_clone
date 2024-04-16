<?php
// Include the file that handles the database connection
include_once '../includes/dbh.inc.php';

// Check if the database connection is successful
if (!$pdo) {
    die("Database connection failed.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Playlist</title>
</head>
<body>
    <h1>Create Playlist</h1>
    <form action="create_playlist.php" method="post">
        <label for="playlist_name">Playlist Name:</label>
        <input type="text" id="playlist_name" name="playlist_name" required><br><br>
        <label>Select Songs:</label><br>
        <?php
        // Query to select all songs from the tracks table
        $sql = "SELECT * FROM tracks";
        $result = $pdo->query($sql);

        // Check if there are any tracks available
        if ($result->rowCount() > 0) {
            // Display songs with checkboxes for multiple selection
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<input type='checkbox' id='track{$row['track_id']}' name='selected_songs[]' value='{$row['track_id']}'>";
                echo "<label for='track{$row['track_id']}'>{$row['track_name']} ({$row['duration(mins)']} mins)</label><br>";
            }
        } else {
            echo "No tracks found.";
        }
        ?>
        <br>
        <input type="submit" value="Make Playlist">
    </form>
</body>
</html>
