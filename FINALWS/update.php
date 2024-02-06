<?php
// Include database connection
include 'include/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['schedule_id']) && isset($_POST['new_date'])) {
    $schedule_id = $_POST['schedule_id'];
    $new_date = $_POST['new_date'];

    try {
        $conn = connectDB(); // Call the connectDB() function from db.php
        $sql = "UPDATE tbl_schedule SET s_date = :new_date WHERE s_id = :schedule_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':new_date', $new_date);
        $stmt->bindParam(':schedule_id', $schedule_id);
        $stmt->execute();
        echo "success"; // Send success response
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Close the database connection
        $conn = null;
    }
}
?>
