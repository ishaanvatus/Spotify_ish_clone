<?php

// Start session
session_start();

// Check if user is logged in, if not redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Include the database connection setup
include_once "../includes/dbh.inc.php";

// Retrieve user data
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Spotify Clone</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Welcome to Spotify Clone</h1>
            <nav>
                <ul>
                    <li><a href="../includes/genre.php">By Genre</a></li>
                    <li><a href="../pages/premium.html">Upgrade to Premium</a></li>
                    <li><a href="../includes/make_playlist.php">Make Playlist</a></li>
                    <li><a href="../includes/listen.php">Add Music</a></li>
                    <li><a href="../includes/rate.php">Rate</a></li>
                    <li><a href="../includes/profile.php">Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <h2>Hello, <?php echo $user_name; ?>!</h2>
            <p>This is your dashboard. You can access various features from the navigation menu.</p>
            <!-- Add more content as needed -->
        </div>
    </main>

    <footer>
        <div class="container">
            <p>Spotify Clone - All rights reserved</p>
        </div>
    </footer>
</body>
</html>
