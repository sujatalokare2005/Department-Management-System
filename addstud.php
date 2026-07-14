<?php
require_once 'mongo_connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student = [
        'id' => isset($_POST['id']) ? (int)$_POST['id'] : null,
        'name' => $_POST['name'] ?? '',
        'age' => $_POST['age'] ?? '',
        'course' => $_POST['course'] ?? '',
        'password' => $_POST['password'] ?? '',
        'contact' => $_POST['contact'] ?? '',
    ];

    $result = getMongoDB()->students->insertOne($student);

    if ($result->getInsertedCount() === 1) {
        echo "Student added successfully";
    } else {
        echo "Error adding student.";
    }
}
?>
