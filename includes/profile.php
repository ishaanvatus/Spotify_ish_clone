<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <h1>User Profile</h1>
    <?php
    // Include the database connection setup
    include_once "../includes/dbh.inc.php";

    // Retrieve user data
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];

    // Query to fetch user's basic information
    $sql = "SELECT * FROM users WHERE user_id = $user_id";
    $result = $pdo->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);

    // Display user's basic information
    echo "<p>User ID: {$row['user_id']}</p>";
    echo "<p>User Name: {$row['user_name']}</p>";
    echo "<p>Email: {$row['email']}</p>";
    echo "<p>Gender: {$row['gender']}</p>";
    ?>
</body>
</html>
