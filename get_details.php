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
            margin: 20px auto;
            background-color: #fff;
            background-image: url(s.jpeg);
            padding: 20px;sz
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
        <h2 >Staff Details</h2>
        <table border="1">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>City</th>
                <th>District</th>
                <th>Qualification.</th>
                <th>Experiance</th>
                <th>mobile</th>
                <th>adhar</th>
                <th>password</th>
                <th   colspan="2" >Action</th> <!-- New column for Update button -->
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
                $sql = "SELECT * FROM add_staff WHERE name = '$name' AND mobile = '$contact'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["city"] . "</td>";
                        echo "<td>" . $row["district"] . "</td>";
                        echo "<td>" . $row["qualification"] . "</td>";
                        echo "<td>" . $row["experiance"] . "</td>";
                        echo "<td>" . $row["mobile"] . "</td>";
                        echo "<td>" . $row["adhar"] . "</td>";
                        echo "<td>" . $row["password"] . "</td>";
                        // Add the Update button with a link to staff_update.php
                        echo "<td><button onclick='updateStaff(" . $row["id"] . ")'>Update</button></td>";
                        echo "<td><button onclick='deleteStaff(" . $row["id"] . ")'>Delete</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No staff records found</td></tr>";
                }
            }

            // Close the database connection
            $conn->close();
            ?>
        </table>

        <!-- JavaScript function to handle staff deletion -->
        <script>
            function deleteStaff(staffId) {
                if (confirm("Are you sure you want to delete this staff member?")) {
                    // Redirect to delete_staff.php with staff ID as a parameter
                    window.location.href = "delete_staff.php?id=" + staffId;
                }
            }

            function updateStaff(staffId) {
                window.location.href = "staff_update.php?id=" + staffId;
            }
        </script>
    </div>
</body>
</html>
