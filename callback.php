<?php
session_start();

// Include required files

require 'public/curl_Class.php'; // Holds the curl methods
require 'models/authentication.php'; // stores authentication
require 'models/user.php'; // stores user
require 'ctrl/playlistcontroller.php'; // playlist methods
require 'private/db.php'; // for db connection
require 'private/config.php'; // holds credentials
require 'ctrl/request.handler.php'; // holds methods for data 
require 'models/track.php';

// create object references
$cURL = new CurlClass();
$db = new DB();
$authData = new AuthenticationData($db);
$userData = new User($db);
$request = new RequestHandler();
$playlist = new Playlist($db);
$track = new Track($db);

    // submit with authorization code and redirection
    $submit_post_fields = 'grant_type=authorization_code&code=' . $_GET['code'] . "&redirect_uri=" . $redirect_URI;
    // Encode app id and password
    $access_token_cred = "Basic " . base64_encode($client_ID . ':' . $client_Secret);

    // Start cURL Post request and pass along values.
    $token_data = $cURL->post_request($get_token_url, $submit_post_fields, $access_token_cred);

// Store access token in session
$_SESSION['token'] = $token_data->access_token;
// Get user id and store for later use
$user_ID = $request->getUserID($cURL, $_SESSION['token']);
// store user id in session
$_SESSION['user_ID'] = $user_ID;
// if request of token was a success, get data and store
if(!empty($_SESSION['token'] && !empty($_SESSION['user_ID']))) {
    // Store user in database
    $userData->addUser($user_ID);
    // Store authentication data in database
    $authData->addAuthData($user_ID, $token_data->access_token, $token_data->refresh_token, $token_data->expires_in);
    // store playlist in database
    $playlistData = $request->getUserPlaylist($cURL, $user_ID, $token_data->access_token);
    $playlist->addPlaylist($playlistData, $user_ID);
    $track->addTracks($playlistData);
}
// Take user to index.php
header("Location: index.php");
?>