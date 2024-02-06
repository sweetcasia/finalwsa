<?php
// Include database connection
include 'include/db.php';

// Fetch schedule IDs from the database
try {
    // Call the connectDB() function from db.php
    $conn = connectDB();
    
    // SQL query to fetch schedule IDs
    $sql = "SELECT s_id FROM tbl_schedule";
    
    // Prepare and execute the query
    $stmt = $conn->query($sql);
    
    // Fetch all rows as associative array
    $schedules = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Send JSON response with schedule IDs
    header('Content-Type: application/json');
    echo json_encode($schedules);
} catch (PDOException $e) {
    // Handle database errors
    $response = array(
        'error' => true,
        'message' => 'Error fetching schedule IDs: ' . $e->getMessage()
    );
    echo json_encode($response);
} finally {
    // Close the database connection
    $conn = null;
}
?>
