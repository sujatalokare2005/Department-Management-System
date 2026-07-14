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
            background-image: url('b1.jpg'); /* Update the URL with the correct path */
           background-size: cover; /* Ensures the image covers the entire background */
             margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            background-image: url(s.jpeg);
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>HOD Dashboard</h1>
        <h2>Welcome, HOD!</h2>
        <div>
            <a href="add_staff.html" class="button">Add Staff</a>
            <a href="upload_notice.html" class="button">Upload Notice</a>
            <a href="staff_list.html" class="button">Staff List</a>
            <a href="stud_list.html" class="button">Student List</a>
            <a href="show_pres.html" class="button">Show Student Presence</a>
            <a href="stud_list.html" class="button">Set to Pass</a>
        </div>
        
        <!-- Your content here -->
    </div>
</body>
</html>
