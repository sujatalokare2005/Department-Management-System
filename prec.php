<?php
// Assuming you have a database connection established already
// Replace 'your_host', 'your_username', 'your_password', and 'your_database' with your actual database credentials
$con = mysqli_connect("localhost", "root", "", "department");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Assuming you have a table named 'attendance' with columns 'id', 'name', 'class', 'date', 'status'
// Adjust table and column names according to your database schema

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $class = $_POST['year'];
    $month = $_POST['month'];

    // Get the total days in the specified month
    $total_days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, date('Y'));

    // Fetching data from database
    $query = "SELECT id, name, 
                     COUNT(*) AS total_days, 
                     SUM(CASE WHEN status = 'present' AND MONTH(date) = '$month' THEN 1 ELSE 0 END) AS present_days
              FROM attendance  
              WHERE year = '$class' 
              GROUP BY id, name
              ORDER BY id ASC"; // Order by ID in ascending order
    
    $result = mysqli_query($con, $query);

    if (!$result) {
        printf("Error: %s\n", mysqli_error($con));
        exit();
    }

    // Displaying the result
    echo "<h2>Attendance Report for Class $class - Month $month</h2>";
    echo "<table border='1'>
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Attendance Percentage</th>
        </tr>";

    while ($row = mysqli_fetch_array($result)) {
        $id = $row['id'];
        $name = $row['name'];
        $total_days = $total_days_in_month; // Total days in the specified month
        $present_days = $row['present_days'];
        
        // Calculate attendance percentage
        if ($total_days > 0) {
            $attendance_percentage = ($present_days / $total_days) * 100;
        } else {
            $attendance_percentage = 0;
        }

        echo "<tr>";
        echo "<td>" . $id . "</td>";
        echo "<td>" . $name . "</td>";
        echo "<td>" . number_format($attendance_percentage, 2) . "%</td>"; // Format the percentage to two decimal places
        echo "</tr>";
    }

    echo "</table>";

    // Close the database connection
    mysqli_close($con);

    // Adding a print button
    echo "<button onclick='window.print()'>Print</button>";
}
?>
