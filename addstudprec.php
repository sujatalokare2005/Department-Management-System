<?php
// Assuming your database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "department"; // Replace with your actual database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve attendance information from the form
    $id= $_POST['id'];
    $name = $_POST['name'];
    $date = $_POST['date'];
    $status = $_POST['status'];
    $year = $_POST['year'];

    // Perform SQL query to insert attendance information into the database
    $sql = "INSERT INTO attendance (id,name, date, status, year) VALUES ('$id','$name', '$date', '$status', '$year')";

    if ($conn->query($sql) === TRUE) {
        echo "Attendance submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
