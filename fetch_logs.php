<?php
// Include your database connection
include('config.php');

// Instantiate the Database class and get the connection
$database = new Database();
$db = $database->getConnection();

// Check if the connection was successful
if ($db === null) {
    echo json_encode(['error' => 'Database connection failed']);
    exit();
}

try {
    // Prepare the SQL statement
    $stmt = $db->prepare("SELECT ul.id, u.username, ul.action, ul.details, ul.log_date
FROM user_logs ul
JOIN users u ON ul.user_id = u.id
ORDER BY ul.log_date DESC;
");
    
    // Execute the statement
    $stmt->execute();
    
    // Fetch all logs as associative arrays
    $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Return logs as JSON
    echo json_encode($logs);
} catch (PDOException $e) {
    // Handle query errors
    echo json_encode(['error' => 'Query failed: ' . $e->getMessage()]);
    
    exit();
}
?>
