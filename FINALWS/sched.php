<?php
// Include database connection
include 'include/db.php';
include_once 'header.php';

// Initialize variables
$date = '';
$errors = array();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $date = trim($_POST['schedule_date']);

    // Validate date
    if (empty($date)) {
        $errors[] = "Date is required";
    }

    // Insert data into database if no errors
    if (empty($errors)) {
        try {
            $conn = connectDB(); // Call the connectDB() function from db.php
            $sql = "INSERT INTO tbl_schedule (s_date) VALUES (:s_date)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':s_date', $date);
            $stmt->execute();
            
            echo "<script>alert('Schedule added, You can now proceed to appointments');</script>";
            echo "<script>window.location.href = 'sched.php';</script>"; // Redirect to app.php
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            // Close the database connection
            $conn = null;
        }
    }
}

// Fetch data from database
// Fetch data from database
try {
    $conn = connectDB(); // Call the connectDB() function from db.php
    $sql = "SELECT `s_id`, `s_date`, `s_status` FROM `tbl_schedule`";
    $stmt = $conn->query($sql);
    
    if ($stmt->rowCount() > 0) {
        echo "<div class='center'>";
        echo "<table class='schedule-table'>";
        echo "<thead><tr><th>ID</th><th>Date</th><th>Status</th><th>Action</th></tr></thead>";
        echo "<tbody>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>" . $row["s_id"] . "</td><td>" . $row["s_date"] . "</td><td>" . $row["s_status"] . "</td>";
            echo "<td><button onclick='openEditModal(" . $row['s_id'] . ")'>Edit</button> <button onclick='deleteSchedule(" . $row['s_id'] . ")'>Delete</button></td></tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    } else {
       
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


// Close the database connection
$conn = null;




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Management</title>
    <link rel="stylesheet" type="text/css" href="css/schedule.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script>
        $(function() {
            $("#schedule_date").datepicker({
                dateFormat: 'yy-mm-dd'
            });
            
            $("#edit_schedule_date").datepicker({
                dateFormat: 'yy-mm-dd' // Set the date format as desired
            });
        });

    

        // Function to open the edit modal and pre-fill the date input
        function openEditModal(scheduleId) {
            document.getElementById("edit_schedule_id").value = scheduleId;
            document.getElementById("editScheduleModal").style.display = "block";
            // You can also pre-fill the date input with the current schedule date
            // document.getElementById("edit_schedule_date").value = currentScheduleDate;
        }

        // Function to close the edit modal
        function closeEditModal() {
            document.getElementById("editScheduleModal").style.display = "none";
        }

        // Function to submit the edit form
        // Function to submit the edit form
        // Function to submit the edit form
        function submitEditSchedule() {
    // Close the modal
    closeEditModal();

    // Get the schedule ID and new date
    var scheduleId = document.getElementById("edit_schedule_id").value;
    var newDate = document.getElementById("edit_schedule_date").value;

    // Make an AJAX request to update.php
    $.ajax({
        url: 'update.php',
        type: 'POST',
        data: {
            schedule_id: scheduleId,
            new_date: newDate
        },
        success: function(response) {
            if (response === "success") {
                alert("Schedule updated successfully");
                // Redirect to sched.php
                window.location.href = 'sched.php';
            } else {
                alert("Failed to update schedule");
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert("An error occurred while updating the schedule");
        }
    });

    return false; // Prevent form submission
}



     function deleteSchedule(scheduleId) {
        // Confirm deletion
        if (confirm("Are you sure you want to delete this schedule?")) {
            // Make an AJAX request to delete.php
            $.ajax({
                url: 'delete.php',
                type: 'POST',
                data: {
                    schedule_id: scheduleId
                },
                success: function(response) {
                    if (response === "success") {
                        // Reload the page to reflect changes
                        window.location.href = 'sched.php';
                    } else {
                        alert("Failed to delete schedule");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("An error occurred while deleting the schedule");
                }
            });
        }
    }






    </script>
</head>
<body>
<div id="editScheduleModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h2 style = "color:white;">Edit Schedule</h2>
        <form id="editScheduleForm" method="post" onsubmit="return submitEditSchedule()">
            <div class="form-group">
                <label for="edit_schedule_date">New Date:</label>
                <input type="text" id="edit_schedule_date" name="edit_schedule_date" placeholder="Choose Date" required>
            </div>
            <div class="form-group">
                <input type="hidden" id="edit_schedule_id" name="schedule_id">
                <input type="submit" style = "color:white";value="Update">
            </div>
        </form>
    </div>
</div>

<div class="center">
    <!-- Display the table of tbl_schedule's data -->

    
    <!-- Add the <h> tag below the table -->
    

    <div class="schedule-form">
        <form method="post">
            <div class="form-group">
            <h2 style="color: white; text-align: center;">Set Schedule</h2>
                <label for="schedule_date"style = "color:white";>Date:</label>
                <input type="text" id="schedule_date" name="schedule_date" placeholder="Choose Date" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
</div>

</body>
</html>
