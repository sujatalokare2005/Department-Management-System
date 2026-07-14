<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOD Dashboard</title>
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
        <h2>Update Staff Details</h2>

        <?php
        require_once 'mongo_connect.php';

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $s_id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
            $new_s_id = isset($_POST['new_id']) ? (int)$_POST['new_id'] : 0;
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $city = $_POST['city'] ?? '';
            $district = $_POST['district'] ?? '';
            $qualification = $_POST['qualification'] ?? '';
            $experiance = $_POST['experiance'] ?? '';
            $mobile = $_POST['contact'] ?? '';
            $adhar = $_POST['adhar'] ?? '';
            $password = $_POST['password'] ?? '';

            $result = getMongoDB()->add_staff->updateOne(
                ['id' => $s_id],
                ['$set' => [
                    'id' => $new_s_id,
                    'name' => $name,
                    'email' => $email,
                    'city' => $city,
                    'district' => $district,
                    'qualification' => $qualification,
                    'experiance' => $experiance,
                    'mobile' => $mobile,
                    'adhar' => $adhar,
                    'password' => $password,
                ]]
            );

            if ($result->getMatchedCount() > 0) {
                echo "<script>alert('Staff details updated successfully!'); window.location.href = 'staff_list.html';</script>";
                exit();
            } else {
                echo "Error updating staff details or staff member not found.";
            }
        }

        if (isset($_GET['id'])) {
            $s_id = (int)$_GET['id'];
            $row = getMongoDB()->add_staff->findOne(['id' => $s_id]);

            if ($row) {
        ?>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                    <!-- Include input field for the new ID -->
                    <label for="new_id">ID:</label>
                    <input type="text" id="new_id" name="new_id" value="<?php echo $row['id']; ?>" required><br>
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required><br>
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" value="<?php echo $row['city']; ?>" required><br>

                    <label for="district">District:</label>
                    <input type="text" id="district" name="district" value="<?php echo $row['district']; ?>" required><br>
                    <label for="education">Qualification:</label>
                    <input type="text" id="qualification" name="qualification" value="<?php echo $row['qualification']; ?>" required><br>

                    <label for="experience">Experience:</label>
                    <input type="text" id="experience" name="experiance" value="<?php echo $row['experiance']; ?>" required><br>
                    <label for="contact">Mobile No.:</label>
                    <input type="text" id="contact" name="contact" value="<?php echo $row['mobile']; ?>" required><br>
                    <label for="aadhar">Aadhar Number:</label>
                    <input type="text" id="aadhar" name="adhar" value="<?php echo $row['adhar']; ?>" required><br>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" value="<?php echo $row['password']; ?>" required><br>
                    <button type="submit">Update</button>
                </form>
        <?php
            } else {
                echo "Staff member not found.";
            }
        } else {
            echo "Invalid request. Please provide a staff ID.";
        }
        ?>
    </div>
</body>
</html>