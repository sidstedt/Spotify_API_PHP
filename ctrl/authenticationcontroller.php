<?php
require_once 'models/authentication.php';

class AuthenticationController {
    public function login() {
        // Visa inloggningsformuläret
        require 'views/auth/login.php';
    }

    public function logout() {
        // Logga ut användaren (kan behöva sessionshantering)
        // Omdirigera till inloggningssidan eller startsidan
        header('Location: index.php');
    }
}
?>
