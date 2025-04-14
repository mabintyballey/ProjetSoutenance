<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<!-- Ces bibliothèques sont utilisées pour des animations et des galeries d'images (owl-carousel) ou des mises en page dynamiques (isotope). -->
<script src="{{ asset('lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('lib/isotope/isotope.pkgd.min.js') }}"></script>

<!-- Fichiers JS du fournisseur (vendor) -->
<!-- Ces scripts sont utilisés pour des fonctionnalités spécifiques, comme la validation des formulaires, des animations, ou l'interactivité avec les images (glightbox, swiper, etc.). -->
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

<!-- Fichier JS principal -->
<!-- Ton fichier JavaScript principal, où tu définis des fonctions ou des comportements spécifiques à l’application. -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Plugin DataTables JS -->
<script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/isotope/isotope.pkgd.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/isotope/isotope.pkgd.min.js"></script>
<!-- JS d'Owl Carousel -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/owl.carousel/dist/owl.carousel.min.js"></script>
        <!-- Template Javascript -->
        <script src="js/main.js"></script>
<!-- Initialisation d'AOS (Animate On Scroll) -->
<!-- Si tu utilises des animations lorsque l'utilisateur fait défiler la page, initialise AOS ici. -->
<script>
  AOS.init();  // Active l'animation au défilement
</script>

<!-- Initialisation des plugins JavaScript (par exemple, Owl Carousel, etc.) -->
<!-- Si tu utilises des bibliothèques comme Owl Carousel, tu peux ajouter ici une initialisation JavaScript pour qu'elles fonctionnent. -->
<script>
  $(document).ready(function() {
    // Exemple pour initialiser Owl Carousel
    $('.owl-carousel').owlCarousel({
      items: 1,  
      loop: true, 
      autoplay: true,  
    });
  });

 window.addEventListener('load', function() {
        // Attendre que la page soit complètement chargée
        const preloader = document.getElementById('preloader-active');
        preloader.style.display = 'none'; // Masquer le préchargeur
    });

    $(document).ready(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 90) {
            $('.nav-bar').addClass('nav-sticky');
            $('.carousel, .page-header').css("margin-top", "73px");
        } else {
            $('.nav-bar').removeClass('nav-sticky');
            $('.carousel, .page-header').css("margin-top", "0");
        }
    });
});
$(document).ready(function () {
    // Sélectionne l'élément avec la classe 'number'
    $('.number').each(function () {
        var $this = $(this);  
        var targetNumber = $this.data('number'); 
        var currentNumber = 0;  
        var increment = targetNumber / 100; 

        // Fonction qui met à jour le nombre progressivement
        var counter = setInterval(function () {
            currentNumber += increment;  
            if (currentNumber >= targetNumber) {
                currentNumber = targetNumber;  
                clearInterval(counter); 
            }
            $this.text(Math.floor(currentNumber));  
        }, 30); 
    });
});
 $(".testimonials-carousel").owlCarousel({
        autoplay: true,
        nav: false,
        dots: true, 
        loop: true,
        autoplayTimeout: 5000,
        smartSpeed: 800,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            }
        }
    });   
    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });
// information fourni par le client
let currentStep = 0;
    const steps = document.querySelectorAll('.step');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const submitBtn = document.getElementById('submitBtn');

    function showStep(stepIndex) {
        steps.forEach((step, i) => {
            step.classList.toggle('active', i === stepIndex);
        });
        prevBtn.style.display = stepIndex > 0 ? 'inline-block' : 'none';
        nextBtn.classList.toggle('d-none', stepIndex === steps.length - 1);
        submitBtn.classList.toggle('d-none', stepIndex !== steps.length - 1);
    }

    function nextStep(n) {
        if (n === 1 && !validateStep()) return;
        currentStep += n;
        if (currentStep >= steps.length) currentStep = steps.length - 1;
        if (currentStep < 0) currentStep = 0;
        showStep(currentStep);
    }

    function validateStep() {
        const inputs = steps[currentStep].querySelectorAll('input, textarea, select');
        for (const input of inputs) {
            if (!input.checkValidity()) {
                input.reportValidity();
                return false;
            }
        }
        return true;
    }

    showStep(currentStep);
    //avis client
    $(document).ready(function(){
    $(".testimonials-carousel").owlCarousel({
        items: 3,  
        dots: true,
        loop: true,  
        margin: 15,  
        autoplay: true, 
        autoplayTimeout: 3000,  
        autoplayHoverPause: true,  
        // nav: true,  
        // navText: ["<", ">"], 
        responsive: {
            0: {
                items: 1  
            },
            768: {
                items: 2 
            },
            1024: {
                items: 4  
            }
        }
    });
});
 
</script>
 