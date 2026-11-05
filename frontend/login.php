<?php require_once __DIR__ . '/partials/header.php'; ?>
<div class="auth-wrapper">
    <div class="auth-card">
        <h2>Вход</h2>
        <form action="/backend/actions/login.php" method="POST">
            <div class="form-group"><input type="text" name="login" class="form-control" placeholder="Логин" required></div>
            <div class="form-group"><input type="password" name="password" class="form-control" placeholder="Пароль" required></div>
            <button type="submit" class="btn">Войти</button>
            <div class="auth-links">Еще не зарегистрированы? <a href="/frontend/register.php">Зарегистрироваться</a></div>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/partials/footer.php'; ?>