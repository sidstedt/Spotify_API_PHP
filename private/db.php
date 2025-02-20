<?php
class DB extends PDO
{
    public function __construct($dbname = "spotify_api") {
        try {
            // Attempt to establish a connection to the database
            parent::__construct("mysql:host=localhost;dbname=$dbname;charset=utf8", "root", "password");
            $this->log("success");
        } catch (PDOException $e) {
            $this->log("Error" . $e->getMessage());
        }
    }
    private function log($message) {
        // Define the log file path
        $logFile = "db_log.txt";
        // Log the message along with the current timestamp
        $logMessage = date("Y-m-d H:i:s") . " - " . $message . PHP_EOL;
        // Append the log message to the log file
        file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);
    }
}
?>
