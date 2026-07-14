<?php
// Start the session
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "department";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if both ID and password are provided
    if (isset($_POST['id']) && isset($_POST['password'])) {
        // Retrieve ID and password from the form
        $id = $_POST['id'];
        $password = $_POST['password'];

        // Prepare and execute the query
        $sql = "SELECT * FROM students WHERE id = '$id' AND password = '$password'";
        $result = $conn->query($sql);

        // Check if there is a matching row in the database
        if ($result->num_rows > 0) {
            // Authentication successful
            // Redirect the user to a dashboard or some other page
            $_SESSION['id'] = $id;
            header("Location: student_dash.php");
            exit();
        } else {
            // Authentication failed
            echo "Invalid ID or password";
        }
    } else {
        // ID or password not provided
        echo "Please provide both ID and password";
    }
}

// Close the database connection
$conn->close();
?>