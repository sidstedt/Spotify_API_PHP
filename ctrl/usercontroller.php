<?php
require_once 'models/User.php';

class UserController {
    public function index() {
        // Visa en lista över användare
        $userModel = new User();
        $users = $userModel->getAllUsers();
        // Visa vyn
        require 'views/user/index.php';
    }
    public function store() {
        // Lägg till en ny användare baserat på POST-data
        $user_ID = $_POST['username'];
        $userModel = new User();
        $userModel->addUser($user_ID);
        // Omdirigera till användarlistan
        header('Location: index.php');
    }
    public function delete($userID) {
        // Ta bort en användare
        $userModel = new User();
        $userModel->deleteUser($userID);
        // Omdirigera till användarlistan
        header('Location: index.php');
    }
}
?>