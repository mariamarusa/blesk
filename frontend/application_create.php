<?php require_once __DIR__ . '/partials/header.php'; ?>
<div class="container">
    <div class="form-card">
        <h2>Создание заявки</h2>
        <form action="/backend/actions/application_create.php" method="POST">
            <div class="form-group"><input type="text" name="address" class="form-control" placeholder="Адрес" required></div>
            <div class="form-group"><input type="text" name="phone" class="form-control" placeholder="8 (XXX) XXX-XX-XX" value="<?= htmlspecialchars($_SESSION['user']['phone'] ?? '') ?>" required></div>
            <div class="form-group"><input type="date" name="desired_date" class="form-control" required></div>
            <div class="form-group"><input type="time" name="desired_time" class="form-control" required></div>
            <div class="form-group">
                <select name="service_id" class="form-control" required>
                    <option value="">Вид услуги</option>
                    <option value="1">Общий клининг</option>
                    <option value="2">Генеральная уборка</option>
                    <option value="3">Послестроительная уборка</option>
                    <option value="4">Химчистка ковров и мебели</option>
                </select>
            </div>
            <div class="form-group">
                <select name="payment_method_id" class="form-control" required>
                    <option value="">Оплата</option>
                    <option value="1">Наличными</option>
                    <option value="2">Банковской картой</option>
                </select>
            </div>
            <button type="submit" class="btn" style="margin-top: 15px;">Создать</button>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/partials/footer.php'; ?>