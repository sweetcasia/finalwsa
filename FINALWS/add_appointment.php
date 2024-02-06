<?php
// Include database connection
include 'include/db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Get form data
        $patientId = $_POST['patientName'];
        $scheduleId = $_POST['scheduleId'];
        
        // Call the connectDB() function from db.php
        $conn = connectDB();
        
        // SQL query to insert appointment
        $sql = "INSERT INTO tbl_appoint (p_id, s_id) VALUES (:p_id, :s_id)";
        
        // Prepare the statement
        $stmt = $conn->prepare($sql);
        
        // Bind parameters
        $stmt->bindParam(':p_id', $patientId);
        $stmt->bindParam(':s_id', $scheduleId);
        
        // Execute the statement
        $stmt->execute();
        
        // Send JSON response indicating success
        header('Content-Type: application/json');
        echo json_encode(array('success' => true));
    } catch (PDOException $e) {
        // Handle database errors
        $response = array(
            'error' => true,
            'message' => 'Error adding appointment: ' . $e->getMessage()
        );
        echo json_encode($response);
    } finally {
        // Close the database connection
        $conn = null;
    }
} else {
    // Send JSON response indicating failure
    header('Content-Type: application/json');
    echo json_encode(array('success' => false, 'message' => 'Form submission error'));
}
?>
