<?php
session_start();
include "config.php";

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['amount']) || empty($_POST['payment_method'])) {
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
        exit;
    }
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];

    // First check if the user already exists
    $check_user = "SELECT id FROM users WHERE email = ?";
    $check_stmt = mysqli_prepare($conn, $check_user);
    mysqli_stmt_bind_param($check_stmt, "s", $email);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);
    
    if (mysqli_stmt_num_rows($check_stmt) > 0) {
        // User exists, get their ID
        mysqli_stmt_bind_result($check_stmt, $user_id);
        mysqli_stmt_fetch($check_stmt);
    } else {
        // Insert new user
        $insert_user_query = "INSERT INTO users (name, email) VALUES (?, ?)";
        $insert_user_stmt = mysqli_prepare($conn, $insert_user_query);
        mysqli_stmt_bind_param($insert_user_stmt, "ss", $name, $email);
        
        if (mysqli_stmt_execute($insert_user_stmt)) {
            $user_id = mysqli_insert_id($conn);
            mysqli_stmt_close($insert_user_stmt);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error inserting user: ' . mysqli_error($conn)]);
            exit;
        }
    }
    
    if (isset($check_stmt)) {
        mysqli_stmt_close($check_stmt);
    }

    // Insert donation into database
    $insert_donation_query = "INSERT INTO donations (user_id, amount, payment_method) VALUES (?, ?, ?)";
    $insert_donation_stmt = mysqli_prepare($conn, $insert_donation_query);
    mysqli_stmt_bind_param($insert_donation_stmt, "ids", $user_id, $amount, $payment_method);
    
    if (mysqli_stmt_execute($insert_donation_stmt)) {
        echo json_encode(['status' => 'success', 'message' => 'Donation processed successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error processing donation: ' . mysqli_error($conn)]);
    }
    mysqli_stmt_close($insert_donation_stmt);
}
?>