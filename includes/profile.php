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
    // Retrieve profile details from the form
    $username = $_POST["username"];
    $email = $_POST["email"];
    $user_id = $_SESSION['user_id']; // Get user ID from session

    try {
        // Prepare the SQL statement to update user profile
        $stmt = $pdo->prepare("UPDATE users SET user_name = :username, email = :email WHERE user_id = :user_id");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        // Redirect to profile page after updating profile
        header("Location: ../pages/profile.html");
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
}
?>
