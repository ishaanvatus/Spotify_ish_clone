<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate Songs</title>
</head>
<body>
    <h1>Rate Songs</h1>
    <form action="rate_songs.php" method="post">
        <label for="song_selection">Select Song:</label>
        <select name="song_selection" id="song_selection">
            <?php
            // Query to select all songs
            $sql = "SELECT * FROM tracks";
            $result = $pdo->query($sql);

            // Display dropdown list of songs
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$row['track_id']}'>{$row['track_name']} by {$row['artist_name']}</option>";
            }
            ?>
        </select><br><br>
        <label for="rating">Rating (out of 10):</label>
        <input type="number" id="rating" name="rating" min="1" max="10" required><br><br>
        <input type="submit" value="Rate Song">
    </form>
</body>
</html>
