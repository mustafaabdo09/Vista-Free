document.addEventListener('DOMContentLoaded', function () {
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    const totalSlides = slides.length;
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');

    // Function to show the selected slide
    function showSlide(index) {
        if (index >= totalSlides) {
            currentSlide = 0;
        } else if (index < 0) {
            currentSlide = totalSlides - 1;
        } else {
            currentSlide = index;
        }

        // Remove active class from all slides
        slides.forEach(slide => {
            slide.classList.remove('active');
        });

        // Add active class to current slide
        slides[currentSlide].classList.add('active');
    }

    // Move to the next slide
    function nextSlide() {
        showSlide(currentSlide + 1);
    }

    // Move to the previous slide
    function prevSlide() {
        showSlide(currentSlide - 1);
    }

    // Automatic slide transition
    let autoSlide = setInterval(nextSlide, 10000);

    // Stop automatic transition when clicking on arrows
    prevButton.addEventListener('click', () => {
        clearInterval(autoSlide);
        prevSlide();
        autoSlide = setInterval(nextSlide, 10000);
    });

    nextButton.addEventListener('click', () => {
        clearInterval(autoSlide);
        nextSlide();
        autoSlide = setInterval(nextSlide, 10000);
    });

    // Show the first slide on load
    showSlide(currentSlide);
});





document.addEventListener('DOMContentLoaded', function () {
    // الحصول على الزر وأيقونة البحث وقسم البحث
    const searchButton = document.getElementById('clic-search-btn');
    const searchIcon = document.getElementById('clic-search');
    const searchSection = document.querySelector('.Search-section');

    // عند النقر على الزر (الذي يحتوي على الأيقونة)
    searchButton.addEventListener('click', function () {
        // التبديل بين عرض وإخفاء قسم البحث
        if (searchSection.style.display === 'none' || searchSection.style.display === '') {
            // إظهار القسم
            searchSection.style.display = 'block';
            // تغيير الأيقونة إلى أيقونة الإغلاق
            searchIcon.classList.remove('fa-search');
            searchIcon.classList.add('fa-times');
        } else {
            // إخفاء القسم
            searchSection.style.display = 'none';
            // إعادة الأيقونة إلى البحث
            searchIcon.classList.remove('fa-times');
            searchIcon.classList.add('fa-search');
        }
    });
});




  // Animation function for counting up numbers Social Media Widgit
  function animateValue(obj, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
      if (!startTimestamp) startTimestamp = timestamp;
      const progress = Math.min((timestamp - startTimestamp) / duration, 1);
      obj.innerHTML = Math.floor(progress * (end - start) + start);
      if (progress < 1) {
        window.requestAnimationFrame(step);
      }
    };
    window.requestAnimationFrame(step);
  }

  // Start counting when the page loads
  document.addEventListener("DOMContentLoaded", function () {
    const counts = document.querySelectorAll('.social-box strong[data-count]');
    counts.forEach(count => {
      const endValue = parseInt(count.getAttribute('data-count'));
      animateValue(count, 0, endValue, 2000);
    });
  });




//   فتح روابط المشاركة في نافذة مصغرة عند الضغط عليها
function openPopup(url) {
    const width = 600; // عرض النافذة
    const height = 400; // ارتفاع النافذة
    const left = (window.innerWidth - width) / 2; // لتوسيط النافذة أفقياً
    const top = (window.innerHeight - height) / 2; // لتوسيط النافذة عمودياً

    window.open(url, 'popupWindow', `width=${width},height=${height},top=${top},left=${left}`);
}



///----------------- Mune -------------------------

document.querySelector('.bar').addEventListener('click', function(e) {
    e.preventDefault(); // منع إعادة تحميل الصفحة عند النقر
    const menu = document.getElementById('menu-bottom-menu'); // استهداف القائمة باستخدام ID
    const overlay = document.querySelector('.overlay');

    // إظهار القائمة وطبقة التغطية عند النقر على أيقونة bar
    menu.classList.add('active');
    overlay.classList.add('active');
});

document.querySelector('.overlay').addEventListener('click', function() {
    const menu = document.getElementById('menu-bottom-menu');
    const overlay = document.querySelector('.overlay');

    // إخفاء القائمة وطبقة التغطية عند النقر على الطبقة الخارجية
    menu.classList.remove('active');
    overlay.classList.remove('active');
});