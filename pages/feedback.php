<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'connection.php';

if (isset($_POST['send'])) 
  {
    // Collect inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (empty($name) || empty($email) || empty($message)) {
        echo "All fields are required.";
        exit;
    }

    // Sanitize inputs
    $name = mysqli_real_escape_string($connection, $name);
    $email = mysqli_real_escape_string($connection, $email);
    $message = mysqli_real_escape_string($connection, $message);

    // Insert into database
    $query = "INSERT INTO user_feedback (name, email, message) VALUES ('$name', '$email', '$message')";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        echo "Feedback submitted successfully.";
        // Or redirect to thank you page
        // header("Location: contact.html?feedback=success");
        // exit;
    } else {
        echo "Error saving feedback: " . mysqli_error($connection);
    }
}
?>
