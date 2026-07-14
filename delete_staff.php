<?php
require_once 'mongo_connect.php';

if (isset($_GET['id'])) {
    $staffId = (int)$_GET['id'];
    $result = getMongoDB()->add_staff->deleteOne(['id' => $staffId]);

    if ($result->getDeletedCount() === 1) {
        echo "<script>alert('Staff Deleted successfully!'); window.location.href = 'staff_list.html';</script>";
        exit();
    } else {
        echo "Staff member not found or could not be deleted.";
    }
} else {
    echo "Invalid request. Please provide a staff ID.";
}
?>
