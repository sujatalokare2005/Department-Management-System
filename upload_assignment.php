<?php
require_once 'mongo_connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $year = $_POST['year'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $semester = $_POST['semester'] ?? '';

    if (empty($year) || empty($subject) || empty($semester)) {
        echo "All fields are required.";
        exit;
    }

    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $filename = basename($_FILES["file"]["name"]);
        $uploadDir = "uploads/";
        $uploadPath = $uploadDir . $filename;

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadPath)) {
            $result = getMongoDB()->assignment->insertOne([
                'year' => $year,
                'subject' => $subject,
                'semester' => $semester,
                'file_content' => $filename,
            ]);

            if ($result->getInsertedCount() === 1) {
                echo '<script>alert("Assignment uploaded successfully."); window.location.href = "assignment.html";</script>';
                exit();
            } else {
                echo "Error inserting assignment into database.";
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
?>
