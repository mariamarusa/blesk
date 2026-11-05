<?php
session_start();
require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/../classes/Auth.php';
require_once __DIR__ . '/../classes/Review.php';

Auth::requireUser();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appId = (int)$_POST['app_id'];
    $rating = (int)$_POST['rating'];
    $comment = trim($_POST['comment']);

    if ($rating >= 1 && $rating <= 5) {
        Review::create($appId, $rating, $comment);
        $_SESSION['success'] = "Спасибо за ваш отзыв!";
    } else {
        $_SESSION['error'] = "Пожалуйста, выберите оценку.";
    }
    
    header('Location: /frontend/applications.php');
    exit;
}