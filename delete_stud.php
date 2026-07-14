<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "department";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if student ID is provided in the URL
if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    // Prepare and execute the DELETE query
    $sql = "DELETE FROM students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $student_id);

    if ($stmt->execute()) {
        // Redirect back to the page showing the student list after successful deletion
        header("Location: stud_list.html");
        exit();
    } else {
        echo "Error deleting student: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Invalid request. Please provide a student ID.";
}

// Close the database connection
$conn->close();
?>
