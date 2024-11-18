<?php


require_once 'config.php'; 

class Logger {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    
    public function logUserAction($userId, $action, $details = null) {
        if (!$this->db) {
            return false;
        }

        $query = "INSERT INTO user_logs (user_id, action, details) VALUES (:user_id, :action, :details)";
        $stmt = $this->db->prepare($query);

        // Bind parameters
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':action', $action, PDO::PARAM_STR);
        $stmt->bindParam(':details', $details, PDO::PARAM_STR);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            // Optionally log the error to a file or monitoring system
            error_log("Logging Error: " . $e->getMessage());
            return false;
        }
    }
}
?>
