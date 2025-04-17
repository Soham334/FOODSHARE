<?php
$connection = mysqli_connect("localhost", "root", "");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$db = mysqli_select_db($connection, 'demo');

if (!$db) {
    die("Database selection failed: " . mysqli_error($connection));
}
?>
