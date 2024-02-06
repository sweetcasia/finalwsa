<?php
include_once 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <link rel="stylesheet" type="text/css" href="css/appss.css">

</head>
<body>
    <h1 style="text-align:center; color: white;">Appointments</h1>

    <!-- Button to open modal -->
    <button onclick="openModal()" class="add-appointment-btn">Add Appointment</button>


    <?php
    // Include database connection
    include 'include/db.php';

    try {
        // Call the connectDB() function from db.php
        $conn = connectDB();
        
        // SQL query to fetch appointments
        $sql = "SELECT a.a_id, p.p_name, s.s_date, s.s_status 
                FROM tbl_appoint a
                JOIN tbl_patient p ON a.p_id = p.p_id
                JOIN tbl_schedule s ON a.s_id = s.s_id";
        
        // Execute the query
        $stmt = $conn->query($sql);
        
        // Check if any appointments were found
        if ($stmt->rowCount() > 0) {
            // Appointments found, display them in a table
            echo "<div class='center'>";
            echo "<table class='appointment-table'>";
            echo "<thead><tr><th>Appointment ID</th><th>Patient Name</th><th>Schedule Date</th><th>Schedule Status</th></tr></thead>";
            echo "<tbody>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>" . $row["a_id"] . "</td><td>" . $row["p_name"] . "</td><td>" . $row["s_date"] . "</td><td>" . $row["s_status"] . "</td></tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            // No appointments found, display empty table with headers
            echo "<div class='center'>";
            echo "<table class='appointment-table'>";
            echo "<thead><tr><th>Appointment ID</th><th>Patient Name</th><th>Schedule Date</th><th>Schedule Status</th></tr></thead>";
            echo "<tbody>";
            echo "<tr><td colspan='4'>No appointments found</td></tr>"; // Row indicating no appointments
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        }
    } catch (PDOException $e) {
        // Display any errors that occur during execution
        echo "Error: " . $e->getMessage();
    } finally {
        // Close the database connection
        $conn = null;
    }
    
    ?>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 style = "color:white;">Add Appointment</h2>
            <!-- Form for adding appointment -->
            <form id="addAppointmentForm">
                <label for="patientName" style = "color:white;">Patient Name:</label>
                <select id="patientName" name="patientName">
                    <!-- Options for patient names will be added here dynamically -->
                </select><br><br>
                <label for="scheduleId"style = "color:white;">Schedule ID:</label>
                <select id="scheduleId" name="scheduleId">
                    <!-- Options for schedule IDs will be added here dynamically -->
                </select><br><br>
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.querySelector("button");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        function openModal() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Function to close the modal
        function closeModal() {
            modal.style.display = "none";
        }

        // Fetch patient names and schedule IDs from the database and populate the dropdown menus
        // This should be done using AJAX to fetch data from the server and dynamically update the options
        // Here, I'm assuming you already have an endpoint to fetch patient names and schedule IDs
        // You'll need to replace the URLs with your actual endpoints
        fetch('fetch_patient_names.php')
            .then(response => response.json())
            .then(data => {
                var selectPatient = document.getElementById('patientName');
                data.forEach(patient => {
                    var option = document.createElement('option');
                    option.value = patient.p_id;
                    option.text = patient.p_name;
                    selectPatient.appendChild(option);
                });
            });

        fetch('fetch_schedule_ids.php')
            .then(response => response.json())
            .then(data => {
                var selectSchedule = document.getElementById('scheduleId');
                data.forEach(schedule => {
                    var option = document.createElement('option');
                    option.value = schedule.s_id;
                    option.text = schedule.s_id;
                    selectSchedule.appendChild(option);
                });
            });

        // Submit form function
        document.getElementById('addAppointmentForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission
            var formData = new FormData(this);
            fetch('add_appointment.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Check if appointment was successfully added
                if (data.success) {
                    alert('Appointment added successfully');
                    closeModal(); // Close the modal
                    // Reload the page to reflect changes
                    location.reload();
                } else {
                    alert('Failed to add appointment');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while adding appointment');
            });
        });
    </script>
</body>
</html>
