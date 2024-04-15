<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sort Songs by Genre</title>
</head>
<body>
    <h1>Songs Sorted by Genre</h1>
    <?php
    // Include the database connection setup
    include_once "../includes/dbh.inc.php";

    // Query to select songs sorted by genre
    $sql = "SELECT * FROM tracks INNER JOIN artists ON tracks.artist_id = artists.artist_id ORDER BY artists.genre, tracks.track_name";
    $result = $pdo->query($sql);

    // Display songs sorted by genre
    echo "<ul>";
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<li>{$row['track_name']} by {$row['artist_name']} (Genre: {$row['genre']})</li>";
    }
    echo "</ul>";
    ?>
</body>
</html>
