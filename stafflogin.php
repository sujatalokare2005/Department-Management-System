<?php
// Assuming your database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "department";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform SQL query to check if the username and password match
    $sql = "SELECT * FROM add_staff WHERE name='$username' AND password='$password'";
    $result = $conn->query($sql);

    // Check if the query was successful and if there is a matching user
    if ($result->num_rows > 0) {
        // Authentication successful, redirect or perform further actions as needed
        header("Location: staff_dash.php"); // Redirect to the dashboard
            exit();
    } else {
        // Authentication failed, redirect or display an error message
        echo "Invalid username or password";
    }
}

// Close the database connection
$conn->close();
?>
