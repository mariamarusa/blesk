<?php 
if (session_status() === PHP_SESSION_NONE) session_start(); 
$currentPage = basename($_SERVER['PHP_SELF']);
$isAuthPage = ($currentPage === 'login.php' || $currentPage === 'register.php');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Блеск</title>
    <link rel="stylesheet" href="/frontend/assets/css/style.css">
    <script src="/frontend/assets/js/app.js" defer></script>
</head>
<body>
    <header class="header <?= $isAuthPage ? 'header--auth' : '' ?>">
        <div class="container header__inner">
            <?php if ($isAuthPage): ?>
                <a href="/frontend/index.php" class="logo"><img src="/frontend/assets/img/bl1.png" alt="Блеск"></a>
            <?php else: ?>
                <a href="/frontend/index.php" class="logo"><img src="/frontend/assets/img/bl1.png" alt="Блеск"></a>
                <nav class="nav">
                    <a href="/frontend/index.php">Главная</a>
                    <?php if (isset($_SESSION['user'])): ?>
                        <?php if($_SESSION['user']['role_name'] === 'admin'): ?>
                            <a href="/frontend/admin.php" class="nav-admin-link">Все заявки</a>
                        <?php else: ?>
                            <a href="/frontend/applications.php">Мои заявки</a>
                            <a href="/frontend/application_create.php">Создать заявку</a>
                        <?php endif; ?>
                        <a href="/backend/actions/logout.php">Выход</a>
                    <?php else: ?>
                        <a href="/frontend/login.php">Вход</a>
                        <a href="/frontend/register.php">Регистрация</a>
                    <?php endif; ?>
                </nav>
                <button class="burger">☰</button>
            <?php endif; ?>
        </div>
    </header>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-error"><?= htmlspecialchars($_SESSION['error']) ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    
    <main style="flex: 1; display: flex; flex-direction: column;">