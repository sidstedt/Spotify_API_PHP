<?php
    class RequestHandler {
        public function getUserID($cURL, $access_token) {
            $user_URL = "https://api.spotify.com/v1/me";
            $response = $cURL->get_request($user_URL, $access_token);
            return $response->id;
        }
        public function getUserPlaylist($cURL, $user_ID, $access_token) {
            $playlist_URL = 'https://api.spotify.com/v1/users/' . $user_ID . '/playlists';
            $user_Playlist = $cURL->get_request($playlist_URL, $access_token);
            return $user_Playlist;
        }
    }
?>