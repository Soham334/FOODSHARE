<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.html");
    exit;
}
?>

$sql = "SELECT v.id, u.name, u.email, v.phone, v.volunteer_role, v.availability, v.created_at
        FROM volunteers v
        JOIN users u ON v.user_id = u.id";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Admin Dashboard</h2>
  <p>Welcome, <?= $_SESSION['user']['name'] ?></p>
  <h3>Total Volunteers: <?= mysqli_num_rows($result) ?></h3>
  <table border="1">
    <tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Role</th><th>Availability</th><th>Registered At</th></tr>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['phone'] ?></td>
        <td><?= $row['volunteer_role'] ?></td>
        <td><?= $row['availability'] ?></td>
        <td><?= $row['created_at'] ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
  <a href="logout.php">Logout</a>
</body>
</html>