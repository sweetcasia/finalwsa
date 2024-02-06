<?php
// Include database connection
include 'include/db.php';
include_once 'header.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if name and email are provided
    if (!empty($_POST['p_name']) && !empty($_POST['p_email'])) {
        try {
            $conn = connectDB(); // Call the connectDB() function from db.php
            $sql = "INSERT INTO tbl_patient (p_name, p_email) VALUES (:p_name, :p_email)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':p_name', $_POST['p_name']);
            $stmt->bindParam(':p_email', $_POST['p_email']);
            $stmt->execute();
            
            // Close the database connection
            $conn = null;

            // Redirect to sched.php
            header("Location: sched.php");
            exit(); // Ensure that subsequent code is not executed after redirection
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Name and email are required";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Patients List</title>
    <script>
        // Function to display an alert and redirect
        function registrationSuccessful() {
            alert("Registration Successful");
            window.location.href = "sched.php"; // Redirect to sched.php
        }
    </script>
</head>
<link rel="stylesheet" type="text/css" href="css/index.css">
<body>

<h1>Patient Registration</h1>

<form method="post" onsubmit="registrationSuccessful()">
    <div class="form-group">
        <label for="p_name" style = "color:white";>Name:</label>
        <input type="text" id="p_name" name="p_name" required>
    </div>
    <div class="form-group">
        <label for="p_email"style = "color:white";>Email:</label>
        <input type="email" id="p_email" name="p_email" required>
    </div>
    <div class="form-group">
        <input type="submit" value="Submit">
    </div>
</form>

</body>
</html>
