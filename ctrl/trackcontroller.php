<?php
require_once 'models/Track.php';

class TrackController {
    public function index() {
        // Visa en lista över alla låtar
        $trackModel = new Track();
        $tracks = $trackModel->getAllTracks();
        // Visa vyn
        require 'views/track/index.php';
    }

    public function create() {
        // Visa formuläret för att lägga till en ny låt
        require 'views/track/create.php';
    }

    public function store() {
        // Lägg till en ny låt baserat på POST-data
        $name = $_POST['name'];
        $artist = $_POST['artist'];
        $album = $_POST['album'];
        $genre = $_POST['genre'];

        $trackModel = new Track();
        $trackModel->addTrack($name, $artist, $album, $genre);

        // Omdirigera till låtlistan
        header('Location: index.php');
    }

    // Implementera metoder för redigering och borttagning av låtar om det behövs
}
?>
