<?php
session_start();
require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/../classes/Auth.php';
require_once __DIR__ . '/../classes/Application.php';

Auth::requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appId = (int)$_POST['app_id'];
    $statusId = (int)$_POST['status_id'];
    $reason = $_POST['cancel_reason'] ?? null;

    if ($statusId === 4 && empty(trim($reason))) {
        $_SESSION['error'] = "Пожалуйста, укажите причину отмены!";
        header('Location: /frontend/admin.php');
        exit;
    }

    Application::updateStatus($appId, $statusId, $statusId === 4 ? $reason : null);
    $_SESSION['success'] = "Статус обновлен";
    header('Location: /frontend/admin.php');
    exit;
}