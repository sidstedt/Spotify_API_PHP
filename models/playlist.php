<?php

class Playlist {
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }
    // Metod för att lägga till en spellista
    public function addPlaylist($playlist_data, $user_ID) {
        // Prepare the SQL statement
        $sql = "INSERT INTO playlist (Playlist_ID, User_ID, Name, URL) VALUES (?, ?, ?, ?)";
        // Prepare the statement
        $stmt = $this->db->prepare($sql);
        $playlist_array = json_decode(json_encode($playlist_data), true);
        // Iterate through each playlist data
        foreach ($playlist_array['items'] as $value) {
            // Extract playlist information
            $name = $value['name'];
            $url = $value['uri']; // URI for playlist. If you want to open an external player.
            $id = $value['id']; // ID to use as a reference for tracks.                    
            try {
                // Execute the statement
                $stmt->execute([$id, $user_ID, $name, $url]);
            } catch (PDOException $e) {
                // Log the error message to a file
                $errorMessage = $e->getMessage();
                $logMessage = date("Y-m-d H:i:s") . " - Error: " . $errorMessage . PHP_EOL;
                file_put_contents("error.log", $logMessage, FILE_APPEND | LOCK_EX);
                // Output a generic error message to the user
                echo "An error occurred while adding the playlist. Please try again later.";
            }
        }
    }
    
    // Metod för att hämta spellistor baserat på användar-ID
    public function getPlaylistsByUserID($userID) {
        $sql = "SELECT * FROM Playlist WHERE User_ID = $userID";
        $result = $this->query($sql);
        $playlists = array();
        while ($row = $result->fetch_assoc()) {
            $playlists[] = $row;
        }
        return $playlists;
    }
}
?>