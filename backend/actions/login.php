<?php
session_start();

require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/../classes/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $password = $_POST['password'];

  
    if ($login === 'Admin' && $password === 'Chisto2026') {
        $user = User::findByLogin('Admin');
        if ($user) {
            $_SESSION['user'] = $user;
            $_SESSION['user']['role_name'] = 'admin'; 
            header('Location: /frontend/admin.php');
            exit;
        }
    }

    
    $user = User::findByLogin($login);
    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user'] = $user;
        header('Location: /frontend/index.php');
        exit;
    } else {
        $_SESSION['error'] = "Неверный логин или пароль";
        header('Location: /frontend/login.php');
        exit;
    }
}