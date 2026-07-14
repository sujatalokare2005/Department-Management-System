<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "department";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate inputs
    $year = $_POST['year'];
    $subject = $_POST['subject'];
    $semester = $_POST['semester'];

    if (empty($year) || empty($subject) || empty($semester)) {
        echo "All fields are required.";
        exit;
    }

    // Check if file is uploaded without errors
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $filename = basename($_FILES["file"]["name"]);
        $uploadDir = "uploads/";
        $uploadPath = $uploadDir . $filename;

        // Move uploaded file to destination directory
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadPath)) {
            // Insert file information into database
            $sql = "INSERT INTO syllabus (year, subject, semester, file_content) VALUES ('$year', '$subject', '$semester', '$filename')";

            if ($conn->query($sql) === TRUE) {
                echo '<script>alert("Syllabus uploaded successfully."); window.location.href = "syllabus.html";</script>';
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Failed to upload file.";
        }
    } else {
        echo "Error uploading file.";
    }
} else {
    echo "Invalid request.";
}

// Close database connection
$conn->close();
?>
