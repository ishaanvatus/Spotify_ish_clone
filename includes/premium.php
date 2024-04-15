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

// Retrieve user ID
$user_id = $_SESSION['user_id'];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if duration is set and valid
    if (isset($_POST["duration"]) && ($_POST["duration"] == "monthly" || $_POST["duration"] == "yearly")) {
        // Define start date as current date
        $start_date = date("Y-m-d");

        // Define end date based on selected duration
        if ($_POST["duration"] == "monthly") {
            $end_date = date("Y-m-d", strtotime("+1 month"));
        } elseif ($_POST["duration"] == "yearly") {
            $end_date = date("Y-m-d", strtotime("+1 year"));
        }

        // Insert subscription record into database
        $sql = "INSERT INTO subscription (user_id, type, start_date, end_date) VALUES (:user_id, :type, :start_date, :end_date)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':user_id' => $user_id,
            ':type' => $_POST["duration"],
            ':start_date' => $start_date,
            ':end_date' => $end_date
        ]);

        // Redirect to dashboard or subscription confirmation page
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid duration selected, handle error or redirect back to form
        // Example: echo "Invalid duration selected!";
        // Redirect back to form
        header("Location: premium.html");
        exit();
    }
} else {
    // Form not submitted, redirect back to form
    header("Location: premium.html");
    exit();
}
?>
