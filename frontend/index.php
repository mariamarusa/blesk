<?php require_once __DIR__ . '/partials/header.php'; ?>
<div class="container">
    <div class="hero">
        <div class="slider-wrapper">
            <button class="slider-btn prev" onclick="prevSlide()">&#10094;</button>
            <div class="slider-container">
                <img id="slider-img" src="/frontend/assets/img/do.png" alt="Слайд">
            </div>
            <button class="slider-btn next" onclick="nextSlide()">&#10095;</button>
        </div>
        <h2>Блеск — чистота, в которую приятно возвращаться</h2>
        <p>Клининговая компания «Блеск» — это профессиональная уборка квартир, домов и офисов. 
Мы помогаем поддерживать чистоту, свежесть и уют в каждом помещении, уделяя внимание даже мелочам. Наша цель — сделать вашу жизнь комфортнее, освободить время для важных дел и избавить от повседневных хлопот. </p>
        <p class="accent-text">Доверьте уборку компании «Блеск» и наслаждайтесь чистотой, в которую приятно возвращаться!</p>
        <a href="/frontend/application_create.php" class="btn-outline">+ Создать заявку</a>
    </div>
</div>
<?php require_once __DIR__ . '/partials/footer.php'; ?>