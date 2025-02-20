<?php
class Track {
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }
    // Metod för att lägga till en ny låt
    public function addTracks($playlistData) {
        $playlist_array = json_decode(json_encode($playlist_data), true);
        $sql = "INSERT INTO track (Name, Artist, Album, Genre) VALUES ('$name', '$artist', '$album', '$genre')";
        return $this->query($sql);
    }

    // Metod för att hämta information om en låt baserat på låt-ID
    public function getTrackByID($trackID) {
        $sql = "SELECT * FROM Track WHERE ID = $trackID";
        $result = $this->query($sql);
        return $result->fetch_assoc();
    }

    // Metod för att uppdatera information om en låt
    public function updateTrack($trackID, $name, $artist, $album, $genre) {
        $sql = "UPDATE Track SET Name = '$name', Artist = '$artist', Album = '$album', Genre = '$genre' WHERE ID = $trackID";
        return $this->query($sql);
    }

    // Metod för att ta bort en låt
    public function deleteTrack($trackID) {
        $sql = "DELETE FROM Track WHERE ID = $trackID";
        return $this->query($sql);
    }
}
?>