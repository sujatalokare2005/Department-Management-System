<?php
require_once 'mongo_connect.php';

$cursor = getMongoDB()->notice->find([], ['projection' => ['date' => 1, 'file_content' => 1]]);
$count = 0;

echo "<h2>List of Notices:</h2>";
echo "<table>";
echo "<tr><th>Date</th><th>Notice</th></tr>";

foreach ($cursor as $row) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['date'] ?? '') . "</td>";
    echo "<td><a href='uploads/" . htmlspecialchars($row['file_content'] ?? '') . "' target='_blank'>" . htmlspecialchars($row['file_content'] ?? '') . "</a></td>";
    echo "</tr>";
    $count++;
}

echo "</table>";

if ($count === 0) {
    echo "No notices uploaded yet.";
}
?>
