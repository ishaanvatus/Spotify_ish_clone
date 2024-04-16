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
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white p-4">
    <header>
        <div class="container">
            <h1 class="text-center font-bold text-5xl text-green-500 p-6">Welcome to Spotify Clone</h1>
            <nav class="bg-slate-900 border-2 border-white text-xl p-4 rounded-3xl w-[300px] text-blue-500">
                <ul>
                    <li class="hover:text-purple-500"><a href="../pages/genre.html">By Genre</a></li>
                    <li class="hover:text-purple-500"><a href="../pages/premium.html">Upgrade to Premium</a></li>
                    <li class="hover:text-purple-500"><a href="../includes/make_playlist.php">Make Playlist</a></li>
                    <li class="hover:text-purple-500"><a href="../pages/add_music.html">Add Music</a></li>
                    <li class="hover:text-purple-500"><a href="../pages/rate.html">Rate</a></li>
                    <li class="hover:text-purple-500"><a href="../pages/profile.html">Profile</a></li>
                    <li class="hover:text-purple-500"><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="text-3xl py-4">
        <div class="container">
            <h2>Hello, <span class="font-bold text-green-500"><?php echo $user_name; ?></span>!</h2>
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
