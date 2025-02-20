<?php
require 'private/db.php';
require 'models/authentication.php';
session_start();
$db = new DB();
$auth = new AuthenticationData($db);
$auth->deleteAuthData($_SESSION['user_ID']);
session_destroy();
?>
<script>
    window.location.href ="index.php";
</script>