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
    // Retrieve form data
    $year = $_POST['year'];
    $semester = $_POST['semester'];
    $subject = $_POST['subject'];

    // Prepare and execute SQL query to fetch files based on year, semester, and subject
    $sql = "SELECT file_content FROM assignment WHERE year = '$year' AND semester = '$semester' AND subject = '$subject'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display list of files
        echo "<h2>List of Files:</h2>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            $file_name = $row['file_content'];
            echo "<li><a href='uploads/$file_name' target='_blank'>$file_name</a></li>";
        }
        echo "</ul>";
    } else {
        echo "No files found for the entered criteria.";
    }
}

// Close the database connection
$conn->close();
?>
