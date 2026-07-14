<?php
require_once 'mongo_connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["file"])) {
    $date = $_POST['date'] ?? '';
    $file = $_FILES["file"];

    if ($file["error"] === UPLOAD_ERR_OK) {
        $filename = basename($file["name"]);
        $uploadDir = "uploads/";
        $uploadPath = $uploadDir . $filename;

        if (move_uploaded_file($file["tmp_name"], $uploadPath)) {
            $result = getMongoDB()->notice->insertOne([
                'date' => $date,
                'file_content' => $filename,
            ]);

            if ($result->getInsertedCount() === 1) {
                echo '<script>alert("Notice uploaded successfully."); window.location.href = "upload_notice.html";</script>';
                exit();
            } else {
                echo "Error inserting notice into database.";
            }
        } else {
            echo "Failed to move uploaded file to destination directory.";
        }
    } else {
        echo "Error uploading file. Error code: " . $file["error"];
    }
} else {
    echo "No file uploaded.";
}
?>
