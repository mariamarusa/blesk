<?php 
require_once __DIR__ . '/partials/header.php'; 
require_once __DIR__ . '/../backend/classes/Database.php';
require_once __DIR__ . '/../backend/classes/Auth.php';
require_once __DIR__ . '/../backend/classes/Application.php';
require_once __DIR__ . '/../backend/classes/Review.php';

Auth::requireAdmin();
$statusId = isset($_GET['status']) ? (int)$_GET['status'] : null;
$apps = Application::all($statusId);
?>
<div class="container">
    <h2 class="page-title">Панель администратора</h2>
    <div class="admin-tabs">
        <a href="/frontend/admin.php" class="<?= !$statusId ? 'active' : '' ?>">Все заявки</a>
        <a href="/frontend/admin.php?status=1" class="<?= $statusId == 1 ? 'active' : '' ?>">Новые заявки</a>
        <a href="/frontend/admin.php?status=2" class="<?= $statusId == 2 ? 'active' : '' ?>">Текущие</a>
        <a href="/frontend/admin.php?status=3" class="<?= $statusId == 3 ? 'active' : '' ?>">Завершенные</a>
    </div>
    <div class="applications-list">
        <?php foreach ($apps as $app): ?>
            <div class="app-card">
                <div class="app-top-row">
                    <h3><?= htmlspecialchars($app['service_name']) ?></h3>
                    <div class="status-badge <?php 
                        if($app['status_id']==1) echo 'status-new';
                        elseif($app['status_id']==2) echo 'status-work';
                        elseif($app['status_id']==3) echo 'status-done';
                        else echo 'status-cancel';
                    ?>">
                        <?= htmlspecialchars($app['status_name']) ?>
                    </div>
                </div>
                <div class="app-card-info">
                    <p class="client-name"><?= htmlspecialchars($app['user_name']) ?></p>
                    <p>Адрес: <?= htmlspecialchars($app['address']) ?></p>
                    <p>Дата: <?= htmlspecialchars($app['desired_date']) ?> <?= htmlspecialchars($app['desired_time']) ?></p>
                    <p><?= htmlspecialchars($app['phone']) ?></p>
                    <?php if (!empty($app['cancel_reason'])): ?>
                        <div class="review-block review-cancel">
                            <h4 class="review-cancel-title">Причина отмены:</h4>
                            <p class="review-cancel-text">"<?= htmlspecialchars($app['cancel_reason']) ?>"</p>
                        </div>
                    <?php endif; ?>
                    <?php $review = Review::getByApplicationId($app['id']); if ($review): ?>
                        <div class="review-block">
                            <h4>Отзыв клиента (Оценка: <?= $review['rating'] ?>/5)</h4>
                            <p>"<?= htmlspecialchars($review['comment'] ?? 'Без комментария') ?>"</p>
                        </div>
                    <?php endif; ?>
                    <?php if($app['status_id'] == 1 || $app['status_id'] == 2): ?>
                        <div class="admin-actions-row">
                            <form action="/backend/actions/admin_status.php" method="POST">
                                <input type="hidden" name="app_id" value="<?= $app['id'] ?>">
                                <?php if($app['status_id'] == 1): ?>
                                    <input type="hidden" name="status_id" value="2">
                                    <button type="submit" class="review-btn">Подтвердить</button>
                                <?php elseif($app['status_id'] == 2): ?>
                                    <input type="hidden" name="status_id" value="3">
                                    <button type="submit" class="review-btn">Завершить</button>
                                <?php endif; ?>
                            </form>
                            <form action="/backend/actions/admin_status.php" method="POST" onsubmit="return checkReason(this)" class="cancel-form">
                                <input type="hidden" name="app_id" value="<?= $app['id'] ?>">
                                <input type="hidden" name="status_id" value="4">
                                <input type="text" name="cancel_reason" class="form-control cancel-reason-input" placeholder="Причина отмены" style="display: none;">
                                <button type="button" class="review-btn" onclick="showCancelField(this)">Отменить</button>
                                <button type="submit" class="review-btn submit-cancel-btn" style="display: none;">Сохранить</button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php require_once __DIR__ . '/partials/footer.php'; ?>