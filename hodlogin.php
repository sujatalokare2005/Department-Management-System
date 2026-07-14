<?php
require_once 'mongo_connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $hod = getMongoDB()->hod->findOne([
        'username' => $username,
        'password' => $password,
    ]);

    if ($hod !== null) {
        header("Location: hod_dash.php");
        exit();
    } else {
        echo "Invalid username or password";
    }
}
?>