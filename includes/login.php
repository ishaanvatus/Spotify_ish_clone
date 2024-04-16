<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection setup
    include_once "../includes/dbh.inc.php";

    // Retrieve eweite tmail and password from the login form
    $email = $_POST["email"];
    $password = $_POST["password"];

    try {
        // Prepare the SQL statement to fetch user data based on email
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists and password is correct
        if ($user && password_verify($password, $user['password'])) {
            // Login successful, set session variables
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['user_name'];
            // Redirect to dashboard or homepage
            header("Location: dashboard.php");
            exit();
        } else {
            // Invalid credentials, redirect back to login page with error message
            header("Location: ../pages/login.html?error=Invalid credentials");
            exit();
        }
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
}
?>