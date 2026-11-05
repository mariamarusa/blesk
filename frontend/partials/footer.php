<?php 
$currentPage = basename($_SERVER['PHP_SELF']);
$isAuthPage = ($currentPage === 'login.php' || $currentPage === 'register.php');
?>
    </main>
    
    <?php if (!$isAuthPage): ?>
    <footer class="footer">
        <div class="container footer__inner">
            <div class="footer-block">
                <h4>Социальные сети</h4>
                <p>VK: blesk23</p>
                <p>Inst: blesk333</p>
                <a href="mailto:blesk23@gmail.com">Email: blesk23@gmail.com</a>
            </div>
            <div class="footer-block">
                <h4>Навигация</h4>
                <a href="/frontend/applications.php">Мои заявки</a>
                <a href="/frontend/application_create.php">Создать заявку</a>
                <a href="/backend/actions/logout.php">Выход</a>
            </div>
            <div class="footer-logo">
                <img src="/frontend/assets/img/bl2.png" alt="Блеск">
            </div>
        </div>
    </footer>
    <?php endif; ?>
</body>
</html>