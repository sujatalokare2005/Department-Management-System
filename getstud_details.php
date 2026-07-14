<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
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
                <th colspan="2">Action</th> <!-- New column for Update button -->
            </tr>

            <?php
            // Database connection settings
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "department";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve form data
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $_POST['name'];
                $contact = $_POST['contact'];
                
                // SQL query to retrieve details based on name and contact
                $sql = "SELECT * FROM students WHERE name = '$name' AND contact = '$contact'";
                $result = $conn->query($sql);

                // Display student details fetched from the database
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["age"] . "</td>";
                        echo "<td>" . $row["course"] . "</td>";
                        echo "<td>" . $row["contact"] . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        // Add the Update button with a link to update_stud.php
                        echo "<td><button onclick='updateStudent(" . $row["id"] . ")'>Update</button></td>";
                        // Add the Delete button with a link to delete_stud.php
                        echo "<td><button onclick='deleteStudent(" . $row["id"] . ")'>Delete</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No student records found</td></tr>";
                }
            }

            // Close the database connection
            $conn->close();
            ?>
        </table>

        <!-- JavaScript function to handle student deletion -->
        <script>
            function deleteStudent(studentId) {
                if (confirm("Are you sure you want to delete this student?")) {
                    // Redirect to delete_stud.php with student ID as a parameter
                    window.location.href = "delete_stud.php?id=" + studentId;
                }
            }
            function updateStudent(studentId) {
                // Redirect to update_stud.php with student ID as a parameter
                window.location.href = "update_stud.php?id=" + studentId;
            }
        </script>
    </div>
</body>
</html>
