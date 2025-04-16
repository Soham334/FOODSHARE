<?php
session_start();
<?php include 'config.php'; ?>

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    if (password_verify($password, $row['password'])) {
        $_SESSION['user'] = $row;
        if ($row['is_admin']) {
            header("Location: admin_dashboard.php");
        } else {
            echo "Login successful. Welcome, " . $row['name'];
        }
    } else {
        echo "Invalid password.";
    }
} else {
    echo "User not found.";
}
?>