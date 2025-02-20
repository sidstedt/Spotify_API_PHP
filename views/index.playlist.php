<?php


?>
<div class="container" id="playlist">
    <h2><button onclick="">Fetch playlist</button></h2>
    <h1><?php echo $_SESSION['user_ID']; ?>: Playlists</h1>
    <button id="togglePlay">Toggle Play</button></p>
    <script src="https://sdk.scdn.co/spotify-player.js"></script>
    <script>
        const token = '<?php echo $_SESSION['token']; ?>';
    </script>
    <script src="scripts/player.js"></script>
</div>
<div class="playlist_con">
    <?php
        foreach ($user_Playlist as $content) {
            if (is_array($content)) {
                foreach ($content as $value) {

                    echo "<div class='grid_item'>";
                    echo "Playlist: $value->name <br/>";
                    echo "<button onclick=\"play_song('$value->uri')\">Play</button><br/><br/>";
                    echo "<button onclick=\"window.open('$value->uri')\">Open in Spotify</button><br/><br/>";
                    echo "</div>";
                }
            }
        }
        ?>
</div>