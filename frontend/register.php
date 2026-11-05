<?php require_once __DIR__ . '/partials/header.php'; ?>
<div class="auth-wrapper">
    <div class="auth-card">
        <h2>Регистрация</h2>
        <form action="/backend/actions/register.php" method="POST">
            <div class="form-group"><input type="text" name="login" class="form-control" placeholder="Логин" required></div>
            <div class="form-group"><input type="password" name="password" class="form-control" placeholder="Пароль" required></div>
            <div class="form-group"><input type="text" name="full_name" class="form-control" placeholder="ФИО" required></div>
            <div class="form-group"><input type="text" name="phone" class="form-control" placeholder="8 (XXX) XXX-XX-XX" required></div>
            <div class="form-group"><input type="email" name="email" class="form-control" placeholder="Email" required></div>
            <button type="submit" class="btn">Зарегистрироваться</button>
            <div class="auth-links">У вас уже есть аккаунт? <a href="/frontend/login.php">Войти</a></div>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/partials/footer.php'; ?>