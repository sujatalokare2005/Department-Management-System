<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
           
            background-color: #f4f4f4;
            background-image: url(b1.jpg);
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            background-image: url(s.jpeg);
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e5e5e5;
        }

        a {
            text-decoration: none;
            color: #3498db;
        }
      

        button {
            padding: 8px;
            background-color: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #c0392b;
        }
        th[colspan="2"] {
            text-align: center;
        }
        h2 {
            text-align: center;
            color: #333;
        }
    </style>
    <!-- Head section remains the same -->
</head>
<body>
    <div class="container " >
        <h2 >Student Details</h2>
        <table border="1">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Age</th>
                <th>Course</th>
                <th>Contact No.</th>
                <th>Status</th>
            </tr>

<?php
// Start the session
session_start();

// Check if session ID is set
if (!isset($_SESSION['id'])) {
    echo "Session ID not set";
    exit();
}

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

$id = $_SESSION['id'];

// Prepare and execute the query to fetch student details
$sql = "SELECT * FROM students WHERE id = '$id'";
$result = $conn->query($sql);

// Check if there is a matching row in the database
if ($result->num_rows > 0) {
    // Fetch and display the student details
    while ($row = $result->fetch_assoc()) {
        echo "<td> " . $row['id'] . "</td>";
        echo "<td> " . $row['name'] . "</td>";
        echo "<td>" . $row["age"] . "</td>";
        echo "<td>" . $row["course"] . "</td>";
        echo "<td>" . $row["contact"] . "</td>";
        echo "<td>" . $row["status"] . "</td>";
    
        // Display other details as needed
    }
} else {
    echo "Student not found";
}

// Close the database connection
$conn->close();
?>
</table>
</div>
</body>
</html>