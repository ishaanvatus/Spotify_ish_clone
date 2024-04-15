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
        <!-- List of songs with radio buttons -->
        <?php
        // Query to select all songs
        $sql = "SELECT * FROM tracks";
        $result = $pdo->query($sql);

        // Display songs with radio buttons
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<input type='radio' id='track{$row['track_id']}' name='selected_songs[]' value='{$row['track_id']}'>";
            echo "<label for='track{$row['track_id']}'>{$row['track_name']} by {$row['artist_name']}</label><br>";
        }
        ?>
        <br>
        <input type="submit" value="Make Playlist">
    </form>
</body>
</html>
