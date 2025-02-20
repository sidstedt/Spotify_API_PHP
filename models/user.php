<?php
class User    {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    // Metod för att hämta användarinformation baserat på användar-ID
    public function getUsers($userID) {
        $sql = "SELECT * FROM user WHERE ID = $userID";
        $result = $this->query($sql);
        return $result->fetch_assoc();
    }

    // Metod för att lägga till en ny användare
    public function addUser($user_ID) {
        $sql = "INSERT INTO user (User_ID) VALUES (?)";
        $stmt = $this->db->prepare($sql);
        try {
            if ($stmt->execute([$user_ID])) {
                echo "User added successfully with ID: " . $user_ID;
            } else {
                throw new Exception("Error adding user: " . $stmt->errorInfo()[2]);
            }
        } catch (Exception $e) {
            // Log the error message to a file
            $errorMessage = $e->getMessage();
            $logMessage = date("Y-m-d H:i:s") . " - Error: " . $errorMessage . PHP_EOL;
            file_put_contents("error.log", $logMessage, FILE_APPEND | LOCK_EX);
            
            // Output a generic error message to the user
            echo "An error occurred while adding the user. Please try again later.";
        }
    }
    // Metod för att ta bort en användare
    public function deleteUser($userID) {
        $sql = "DELETE FROM user WHERE ID = $userID";
        return $this->query($sql);
    }
}
?>