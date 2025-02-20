<div class="container" id="conn_spotify">
    <button onclick="LogInReq()">Log In with Spotify</button>

    <script src="scripts/config.js"></script>
    <script>
        // User log in request on button click
        const LogInReq = () => {
            // URL for Spotify API authorization
            let logInUri = 'https://accounts.spotify.com/authorize' +
                // Client ID, used as an identifier for the user
                `?client_id=${Config.client_ID}` +
                '&response_type=code' +
                `&redirect_uri=${Config.redirect_URI}` +
                `&scope=${Config.scope}`;
            
            // Open URL to request user log in from Spotify
            window.open(logInUri, '_self');
        }
    </script>
</div>