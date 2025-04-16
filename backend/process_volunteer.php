<?php
session_start();
include "config.php";

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || 
        empty($_POST['volunteer_role']) || empty($_POST['availability'])) {
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
        exit;
    }
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $volunteer_role = $_POST['volunteer_role'];
    $availability = $_POST['availability'];

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

    // Create volunteers table if it doesn't exist
    $create_table_sql = "CREATE TABLE IF NOT EXISTS volunteers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        phone VARCHAR(50) NOT NULL,
        volunteer_role VARCHAR(50) NOT NULL,
        availability TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )";
    
    if (!mysqli_query($conn, $create_table_sql)) {
        echo json_encode(['status' => 'error', 'message' => 'Error creating volunteers table: ' . mysqli_error($conn)]);
        exit;
    }

    // Insert volunteer into database
    $insert_volunteer_query = "INSERT INTO volunteers (user_id, phone, volunteer_role, availability) VALUES (?, ?, ?, ?)";
    $insert_volunteer_stmt = mysqli_prepare($conn, $insert_volunteer_query);
    mysqli_stmt_bind_param($insert_volunteer_stmt, "isss", $user_id, $phone, $volunteer_role, $availability);
    
    if (mysqli_stmt_execute($insert_volunteer_stmt)) {
        echo json_encode(['status' => 'success', 'message' => 'Volunteer application submitted successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error processing volunteer application: ' . mysqli_error($conn)]);
    }
    mysqli_stmt_close($insert_volunteer_stmt);
}
?>