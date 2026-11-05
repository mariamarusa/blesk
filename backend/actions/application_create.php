<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/Auth.php';
require_once '../classes/Application.php';
Auth::requireUser();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    Application::create($_SESSION['user']['id'], $_POST);
    $_SESSION['success'] = "Заявка создана!"; header('Location: /frontend/applications.php'); exit;
}