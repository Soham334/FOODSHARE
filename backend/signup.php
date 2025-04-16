<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $phone = $_POST['phone'];
    $role = $_POST['volunteer_role'];
    $availability = $_POST['availability'];

    $sql_user = "INSERT INTO users (name, email, password, is_admin) VALUES ('$name', '$email', '$password', 0)";

    if (mysqli_query($conn, $sql_user)) {
        $user_id = mysqli_insert_id($conn);
        $sql_volunteer = "INSERT INTO volunteers (user_id, phone, volunteer_role, availability) VALUES ('$user_id', '$phone', '$role', '$availability')";
        if (mysqli_query($conn, $sql_volunteer)) {
            header("Location: login.html");
            exit();
        } else {
            echo "Error in volunteers: " . mysqli_error($conn);
        }
    } else {
        echo "Error in users: " . mysqli_error($conn);
    }
}
?>