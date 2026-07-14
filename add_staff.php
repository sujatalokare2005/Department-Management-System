<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $city = $_POST["city"];
    $district = $_POST["district"];
    $qualification = $_POST["education"];
    $experiance = $_POST["experiance"];
    $mobile = $_POST["contact"];
    $adhar = $_POST["adhar"];
    $password = $_POST["password"];

    // Example: Save data to a database (you need to replace this with your own database logic)
    // Establish connection to database (replace these values with your own database credentials)
    $servername = "localhost";
    $username = "root";
    $password_db = "";
    $dbname = "department";

    // Create connection
    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement
    $sql = "INSERT INTO add_staff (id,name, email, city, district, qualification, experiance, mobile, adhar, password)
            VALUES ('$id','$name', '$email', '$city', '$district', '$qualification', '$experiance', '$mobile', '$adhar', '$password')";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "Staff added  successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
