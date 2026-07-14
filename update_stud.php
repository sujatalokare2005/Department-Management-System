<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            background-image: url(b1.jpeg);
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            background-image: url(Regi.jpeg);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
        }
        input[type="text"], select {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Student Details</h2>

        <?php
        // Database connection settings
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "department";
        
        // Create a connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve the updated details from the form
            $student_id = $_POST['student_id'];
            $name = $_POST['name'];
            $age = $_POST['age'];
            $course = $_POST['course'];
            $contact = $_POST['contact'];
            $status= $_POST['status'];

            // Update the student details in the database
            $sql = "UPDATE students SET name=?, age=?, course=?, contact=?,status=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssi", $name, $age, $course, $contact,$status, $student_id);

            if ($stmt->execute()) {
                echo "<script>alert('Student details updated successfully!'); window.location.href = 'stud_list.html';</script>";
                exit();
            } else {
                echo "Error updating student details: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        }

        // Check if the ID parameter is provided in the URL
        if (isset($_GET['id'])) {
            $student_id = $_GET['id'];

            // Retrieve student details based on the provided ID
            $sql = "SELECT * FROM students WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $student_id);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if the query was successful
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Display a form with student details filled in the input fields
                ?>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                    <input type="hidden" name="student_id" value="<?php echo $row['id']; ?>">
                   
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br>

                    <label for="age">Age:</label>
                    <input type="text" id="age" name="age" value="<?php echo $row['age']; ?>"><br>

                    <label for="course">Course:</label>
                    <input type="text" id="course" name="course" value="<?php echo $row['course']; ?>"><br>

                    <label for="contact">Contact No:</label>
                    <input type="text" id="contact" name="contact" value="<?php echo $row['contact']; ?>"><br>
                

                    <label for="status">Status:</label>
                   <select id="status" name="status" required>
                    <option  value="<?php echo $row['status']; ?>">
                    <option value="Pass">Pass</option>
                    <option value="Fail">Fail</option>
                     </select>


                     <button type="submit">Update</button>
                    
                </form>
                <?php
            } else {
                echo "Student not found.";
            }
        } else {
            echo "Invalid request. Please provide a student ID.";
        }

        // Close the database connection
