<?php
// Include database connection
include 'include/db.php';

// Fetch patient names from the database
try {
    // Call the connectDB() function from db.php
    $conn = connectDB();
    
    // SQL query to fetch patient names
    $sql = "SELECT p_id, p_name FROM tbl_patient";
    
    // Prepare and execute the query
    $stmt = $conn->query($sql);
    
    // Fetch all rows as associative array
    $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Send JSON response with patient names
    header('Content-Type: application/json');
    echo json_encode($patients);
} catch (PDOException $e) {
    // Handle database errors
    $response = array(
        'error' => true,
        'message' => 'Error fetching patient names: ' . $e->getMessage()
    );
    echo json_encode($response);
} finally {
    // Close the database connection
    $conn = null;
}
?>
