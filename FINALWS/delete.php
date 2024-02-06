<?php
// Include database connection
include 'include/db.php';

// Check if schedule_id is set
if(isset($_POST['schedule_id'])) {
    // Get the schedule ID
    $schedule_id = $_POST['schedule_id'];

    try {
        // Connect to the database
        $conn = connectDB();

        // Prepare and execute the DELETE statement
        $sql = "DELETE FROM tbl_schedule WHERE s_id = :schedule_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':schedule_id', $schedule_id);
        $stmt->execute();

        // Check if rows were affected
        if ($stmt->rowCount() > 0) {
            echo "success";
        } else {
            echo "failure";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Close the database connection
        $conn = null;
    }
} else {
    echo "Schedule ID not provided";
}
?>
