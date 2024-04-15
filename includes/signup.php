<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection setup
    include_once "../includes/dbh.inc.php";

    // Retrieve form data
    $user_name = $_POST["user_name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $gender = $_POST["gender"];

    try {
        // Check if the email is already registered
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $existing_user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing_user) {
            // Email already exists, redirect back to signup page with error message
            header("Location: signup.php?error=Email already exists");
            exit();
        } else {
            // Insert new user data into the database
            $stmt = $pdo->prepare("INSERT INTO users (user_name, email, password, gender) VALUES (:user_name, :email, :password, :gender)");
            $stmt->execute(['user_name' => $user_name, 'email' => $email, 'password' => $password, 'gender' => $gender]);

            // Redirect to login page with success message
            header("Location: ../pages/login.html?success=Sign up successful. Please login.");
            exit();
        }
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
}
?>
