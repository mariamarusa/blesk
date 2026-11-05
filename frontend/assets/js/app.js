document.addEventListener('DOMContentLoaded', function() {
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav');
    if (burger && nav) {
        burger.addEventListener('click', function() {
            nav.classList.toggle('nav--active');
        });
    }

    window.openReviewModal = function(appId) {
        const modal = document.getElementById('reviewModal');
        const input = document.getElementById('modal_app_id');
        if (modal && input) {
            input.value = appId;
            modal.style.display = 'flex';
        }
    };

    window.closeReviewModal = function() {
        const modal = document.getElementById('reviewModal');
        if (modal) {
            modal.style.display = 'none';
        }
    };

    window.showCancelField = function(btn) {
        const form = btn.closest('form');
        const input = form.querySelector('.cancel-reason-input');
        const submitBtn = form.querySelector('.submit-cancel-btn');
        input.style.display = 'inline-block';
        submitBtn.style.display = 'inline-block';
        btn.style.display = 'none';
        input.focus();
    };

    window.checkReason = function(form) {
        const reason = form.querySelector('input[name="cancel_reason"]');
        if (reason && reason.value.trim() === '') {
            alert('Пожалуйста, укажите причину отмены!');
            return false;
        }
        return true;
    };

    const images = [
        "/frontend/assets/img/do.png",
        "/frontend/assets/img/za_ub.png",
        "/frontend/assets/img/interer.png",
        "/frontend/assets/img/hz.png"
    ];
    let currentIndex = 0;
    const imgElement = document.getElementById('slider-img');
    
    if (imgElement) {
        window.showSlide = function(index) { imgElement.src = images[index]; };
        window.nextSlide = function() {
            currentIndex = (currentIndex + 1) % images.length;
            window.showSlide(currentIndex);
        };
        window.prevSlide = function() {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            window.showSlide(currentIndex);
        };
        setInterval(window.nextSlide, 3000);
    }
});