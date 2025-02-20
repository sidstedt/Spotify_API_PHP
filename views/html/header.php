<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Spotify API Test</title>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>
<div class="container" id="navmenu">
    <!-- navigation menu -->
    <ul class="navigation">
        <?php 
            // Determine the current page based on the URL parameter
            $currentPage = isset($_GET['page']) ? $_GET['page'] : 'index';
        ?>
        <!-- Show Home link regardless of login status -->
        <li class="nav-item">
            <a class="nav-link <?php if ($currentPage == "index") { ?>active<?php } ?>" href="index.php?page=index">Home</a>
        </li>
        <!-- Check if user has logged in, then display rest of the navigation -->
        <?php if (!empty($_SESSION['token'])) { ?>
            <!-- Show additional links only if logged in -->
            <li class="nav-item">
                <a class="nav-link <?php if ($currentPage == "playlist") { ?>active<?php } ?>" href="index.php?page=playlist">Playlist</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($currentPage == "track") { ?>active<?php } ?>" href="index.php?page=track">Tracks</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($currentPage == "player") { ?>active<?php } ?>" href="index.php?page=player">Player</a>
            </li>
            <!-- Add more links for other pages -->
        <?php } ?>
    </ul>
</div>