<?php
session_start();
include 'views/html/header.php';

include 'private/db.php';
include 'public/curl_Class.php';
include 'ctrl/authenticationcontroller.php';
include 'ctrl/trackcontroller.php';
include 'ctrl/playlistcontroller.php';
include 'ctrl/usercontroller.php';

$db = new DB();
$cURL = new CurlClass();
$auth_Ctrl = new AuthenticationController($db, $cURL);
$user_Ctrl = new UserController($db);
$playlist_Ctrl = new playlistController($db, $cURL);
$track_Ctrl = new trackController($db, $cURL);
var_dump(php_ini_loaded_file(), php_ini_scanned_files());
if (!empty($_SESSION['token'])) {
    // Determine the current page based on the URL parameter
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 'index';

    // Include the corresponding view based on the current page
    switch ($currentPage) {
        case 'index':
            include 'views/index.logged.in.php';
            break;
        case 'playlist':
            include 'views/index.playlist.php';
            break;
        case 'track':
            include 'views/index.track.php';
            break;
        case 'player':
            include 'views/index.player.php';
            break;
        default:
            // If page not found, include a default view
            include 'views/index.logged.in.php';
    }
} else {
    include 'views/index.login.php';
}

include 'views/html/footer.php';
?>
