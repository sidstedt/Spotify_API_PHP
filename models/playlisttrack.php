<?php

class PlaylistTrack {
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }
    // Metod för att lägga till en låt i en spellista
    public function addTrackToPlaylist($playlistID, $trackID) {
        $sql = "INSERT INTO Playlist_Track (Playlist_ID, Track_ID) VALUES ($playlistID, $trackID)";
        return $this->query($sql);
    }

    // Metod för att hämta låtar i en spellista baserat på spellista-ID
    public function getTracksByPlaylistID($playlistID) {
        $sql = "SELECT * FROM Playlist_Track WHERE Playlist_ID = $playlistID";
        $result = $this->query($sql);
        $tracks = array();
        while ($row = $result->fetch_assoc()) {
            $tracks[] = $row;
        }
        return $tracks;
    }
}
?>