<div class="container" id="conn_spotify">
    <button onclick="logout_Spotify()">Logout of spotify</button>
    <script>
    // Function to handle logout
    const logout_Spotify = () => {
        // Perform AJAX request to logout.php
        fetch('logout.php')
            .then(response => {
                if (response.ok) {
                    // Reload the page after successful logout
                    location.reload();
                } else {
                    console.error('Logout failed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
    </script>

</div>