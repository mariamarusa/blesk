<?php 
require_once __DIR__ . '/partials/header.php'; 
require_once __DIR__ . '/../backend/classes/Database.php';
require_once __DIR__ . '/../backend/classes/Auth.php';
require_once __DIR__ . '/../backend/classes/Application.php';
require_once __DIR__ . '/../backend/classes/Review.php';

Auth::requireUser();
$filter = $_GET['filter'] ?? 'all';
$apps = Application::forUser($_SESSION['user']['id']);

if ($filter === 'active') {
    $apps = array_filter($apps, fn($a) => in_array($a['status_name'], ['Новая', 'В работе']));
} elseif ($filter === 'done') {
    $apps = array_filter($apps, fn($a) => $a['status_name'] === 'Выполнено');
}
?>
<div class="container">
    <h2 class="page-title">Мои заявки</h2>
    <div class="admin-tabs">
        <a href="?filter=all" class="<?= $filter === 'all' ? 'active' : '' ?>">Все</a>
        <a href="?filter=active" class="<?= $filter === 'active' ? 'active' : '' ?>">Активные</a>
        <a href="?filter=done" class="<?= $filter === 'done' ? 'active' : '' ?>">Завершённые</a>
    </div>
    <div class="applications-list">
        <?php if(empty($apps)): ?>
            <p>Заявок нет.</p>
        <?php else: ?>
            <?php foreach ($apps as $app): ?>
                <div class="app-card">
                    <div class="app-top-row">
                        <h3><?= htmlspecialchars($app['service_name']) ?></h3>
                        <div class="status-badge <?php 
                            if($app['status_name'] == 'Новая') echo 'status-new';
                            elseif($app['status_name'] == 'В работе') echo 'status-work';
                            elseif($app['status_name'] == 'Выполнено') echo 'status-done';
                            else echo 'status-cancel';
                        ?>">
                            <?= htmlspecialchars($app['status_name']) ?>
                        </div>
                    </div>
                    <div class="app-card-info">
                        <p>Адрес: <?= htmlspecialchars($app['address']) ?></p>
                        <p><?= htmlspecialchars($app['phone']) ?></p>
                        <?php if ($app['status_name'] === 'Отменено'): ?>
                            <div class="review-block review-cancel">
                                <h4 class="review-cancel-title">Заявка отменена</h4>
                                <?php if (!empty($app['cancel_reason'])): ?>
                                    <p class="review-cancel-text">"<?= htmlspecialchars($app['cancel_reason']) ?>"</p>
                                <?php else: ?>
                                    <p class="review-cancel-text">Причина не указана.</p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($app['status_name'] === 'Выполнено'): ?>
                            <?php $myReview = Review::getByApplicationId($app['id']); ?>
                            <?php if ($myReview): ?>
                                <div class="review-block">
                                    <h4>Ваш отзыв (Оценка: <?= $myReview['rating'] ?>/5)</h4>
                                    <p>"<?= htmlspecialchars($myReview['comment'] ?? 'Без комментария') ?>"</p>
                                    <button type="button" class="review-btn" onclick="openReviewModal(<?= $app['id'] ?>)">Изменить отзыв</button>
                                </div>
                            <?php else: ?>
                                <button type="button" class="review-btn" onclick="openReviewModal(<?= $app['id'] ?>)">Оставить отзыв</button>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<div id="reviewModal" class="modal-overlay">
    <div class="modal-content">
        <span class="close-modal" onclick="closeReviewModal()">&times;</span>
        <h3>Ваш отзыв</h3>
        <form action="/backend/actions/review_create.php" method="POST">
            <input type="hidden" name="app_id" id="modal_app_id">
            <div class="form-group">
                <label>Оценка:</label>
                <select name="rating" id="modal_rating" class="form-control" required>
                    <option value="5">5 - Отлично</option>
                    <option value="4">4 - Хорошо</option>
                    <option value="3">3 - Нормально</option>
                    <option value="2">2 - Плохо</option>
                    <option value="1">1 - Ужасно</option>
                </select>
            </div>
            <div class="form-group">
                <label>Комментарий:</label>
                <textarea name="comment" id="modal_comment" class="form-control" rows="4" placeholder="Расскажите, как прошла уборка..."></textarea>
            </div>
            <button type="submit" class="btn">Отправить отзыв</button>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/partials/footer.php'; ?>