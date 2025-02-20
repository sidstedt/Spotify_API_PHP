<?php
class AuthenticationData {
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }
    public function getAuthData($userID) {
        $sqlSelect = "SELECT ID FROM user WHERE User_ID = ?";
        $stmtSelect = $this->db->prepare($sqlSelect);
        $stmtSelect->execute([$user_ID]);
        $ID = $stmtSelect->fetchColumn();
        $sql = "SELECT * FROM authentication_data WHERE ID = $ID";
    }
    public function addAuthData($user_ID, $accessToken, $refreshToken, $expirySeconds) {
        $sqlSelect = "SELECT ID FROM user WHERE User_ID = ?";
        $stmtSelect = $this->db->prepare($sqlSelect);
        $stmtSelect->execute([$user_ID]);
        $ID = $stmtSelect->fetchColumn();

        if($ID) {
            date_default_timezone_set('Europe/Stockholm');
            $expiryDate = date('Y-m-d H:i:s', time() + $expirySeconds);
            $sql = "INSERT INTO authentication_data (ID, Access_Token, Refresh_Token, Expiry_Date) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            try {
                if ($stmt->execute([$ID, $accessToken, $refreshToken, $expiryDate])) {
                
                } else {
                    throw new Exception("Error adding authentication data: " . $stmt->errorInfo()[2]);
                }
            } catch (Exception $e) {
                // Log the error message to a file
                $errorMessage = $e->getMessage();
                $logMessage = date("Y-m-d H:i:s") . " - Error: " . $errorMessage . PHP_EOL;
                file_put_contents("error.log", $logMessage, FILE_APPEND | LOCK_EX);
                
                // Output a generic error message to the user
                echo "An error occurred while adding the authentication data. Please try again later.";
            }
        } else {

        }
    }
    public function updateAuthenData($user_ID, $accessToken, $refreshToken, $expirySeconds) {
        $sqlSelect = "SELECT ID FROM user WHERE User_ID = ?";
        $stmtSelect = $this->db->prepare($sqlSelect);
        $stmtSelect->execute([$user_ID]);
        $ID = $stmtSelect->fetchColumn();

        if($ID) {
            date_default_timezone_set('Europe/Stockholm');
            $expiryDate = date('Y-m-d H:i:s', time() + $expirySeconds);
            $sql = "UPDATE authentication_data (ID, Access_Token, Refresh_Token, Expiry_Date) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            try {
                if ($stmt->execute([$ID, $accessToken, $refreshToken, $expiryDate])) {
                
                } else {
                    throw new Exception("Error adding authentication data: " . $stmt->errorInfo()[2]);
                }
            } catch (Exception $e) {
                // Log the error message to a file
                $errorMessage = $e->getMessage();
                $logMessage = date("Y-m-d H:i:s") . " - Error: " . $errorMessage . PHP_EOL;
                file_put_contents("error.log", $logMessage, FILE_APPEND | LOCK_EX);
                
                // Output a generic error message to the user
                echo "An error occurred while adding the authentication data. Please try again later.";
            }
        } else {

        }
    }
    public function deleteAuthData($user_ID) {
        $sqlSelect = "SELECT ID FROM user WHERE User_ID = ?";
        $stmtSelect = $this->db->prepare($sqlSelect);
        $stmtSelect->execute([$user_ID]);
        $ID = $stmtSelect->fetchColumn();
        $sql = "DELETE FROM authentication_data WHERE ID = $ID";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$ID]);
    }
}
?>