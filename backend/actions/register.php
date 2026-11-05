<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/User.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (User::findByLogin($_POST['login'])) {
        $_SESSION['error'] = "Логин занят"; header('Location: /frontend/register.php'); exit;
    }
    User::create($_POST);
    $_SESSION['success'] = "Успешная регистрация!"; header('Location: /frontend/login.php'); exit;
}