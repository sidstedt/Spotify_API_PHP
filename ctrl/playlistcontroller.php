<?php
require_once 'models/playlist.php';

class PlaylistController {
    public function index($userID) {
        // Visa en lista över spellistor för en specifik användare
        $playlistModel = new Playlist();
        $playlists = $playlistModel->getPlaylistsByUserID($userID);
        // Visa vyn
        require 'views/playlist/index.php';
    }
    public function create($userID) {

    }
    public function store($db, $playlist_data, $userID) {
        $playlistModel = new Playlist();
        $playlistModel->addPlaylist($db, $playlist_data, $userID);
    }
    // Implementera metoder för redigering och borttagning av spellistor om det behövs
}
?>
