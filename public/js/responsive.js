// ROTO Tattoo Studio - Responsive JavaScript Enhancements

document.addEventListener('DOMContentLoaded', function() {
    
    // Navbar responsivo mejorado
    const navbar = document.querySelector('.navbar');
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    // Cerrar navbar al hacer click en un enlace (móvil)
    if (navbarCollapse) {
        const navLinks = navbarCollapse.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 992) {
                    const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                        toggle: false
                    });
                    bsCollapse.hide();
                }
            });
        });
    }
    
    // Smooth scrolling mejorado
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const offsetTop = target.offsetTop - (navbar ? navbar.offsetHeight : 0);
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Gallery filter functionality mejorada
    const categoryButtons = document.querySelectorAll('#categories .list-item');
    const galleryItems = document.querySelectorAll('#photos .item');
    
    if (categoryButtons.length > 0) {
        categoryButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                categoryButtons.forEach(btn => btn.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');
                
                const category = this.getAttribute('data-category');
                
                galleryItems.forEach(item => {
                    const img = item.querySelector('img');
                    if (img) {
                        const shouldShow = img.getAttribute(`data-category-${category}`) === 'true';
                        
                        if (shouldShow) {
                            item.style.display = 'block';
                            // Animate in
                            setTimeout(() => {
                                item.style.opacity = '1';
                                item.style.transform = 'scale(1)';
                            }, 50);
                        } else {
                            item.style.opacity = '0';
                            item.style.transform = 'scale(0.8)';
                            setTimeout(() => {
                                item.style.display = 'none';
                            }, 300);
                        }
                    }
                });
            });
        });
        
        // Set first button as active
        if (categoryButtons[0]) {
            categoryButtons[0].classList.add('active');
        }
    }
    
    // Form validation enhancements
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                    field.classList.add('is-valid');
                }
            });
            
            // Email validation
            const emailField = this.querySelector('[type="email"]');
            if (emailField && emailField.value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailField.value)) {
                    isValid = false;
                    emailField.classList.add('is-invalid');
                }
            }
            
            if (!isValid) {
                e.preventDefault();
                // Show error message
                showNotification('Por favor, completa todos los campos correctamente.', 'error');
            } else {
                showNotification('Mensaje enviado correctamente!', 'success');
            }
        });
        
        // Real-time validation
        const inputs = contactForm.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.hasAttribute('required') && !this.value.trim()) {
                    this.classList.add('is-invalid');
                    this.classList.remove('is-valid');
                } else if (this.value.trim()) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                }
            });
        });
    }
    
    // Carousel touch/swipe support for mobile
    const carousel = document.querySelector('#carouselExampleFade');
    if (carousel && 'ontouchstart' in window) {
        let startX = 0;
        let endX = 0;
        
        carousel.addEventListener('touchstart', e => {
            startX = e.touches[0].clientX;
        });
        
        carousel.addEventListener('touchend', e => {
            endX = e.changedTouches[0].clientX;
            handleSwipe();
        });
        
        function handleSwipe() {
            const threshold = 50;
            const diff = startX - endX;
            
            if (Math.abs(diff) > threshold) {
                const carouselInstance = bootstrap.Carousel.getInstance(carousel);
                if (diff > 0) {
                    carouselInstance.next();
                } else {
                    carouselInstance.prev();
                }
            }
        }
    }
    
    // Lazy loading for images (if Intersection Observer is supported)
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src || img.src;
                    img.classList.remove('lazy');
                    observer.unobserve(img);
                }
            });
        });
        
        const lazyImages = document.querySelectorAll('img[loading="lazy"]');
        lazyImages.forEach(img => imageObserver.observe(img));
    }
    
    // Responsive text sizing
    function adjustTextSizes() {
        const viewportWidth = window.innerWidth;
        const heroTitle = document.querySelector('#blacklinetext');
        
        if (heroTitle) {
            if (viewportWidth < 576) {
                heroTitle.style.fontSize = '2.5rem';
            } else if (viewportWidth < 768) {
                heroTitle.style.fontSize = '3rem';
            } else if (viewportWidth < 992) {
                heroTitle.style.fontSize = '3.5rem';
            } else {
                heroTitle.style.fontSize = '4rem';
            }
        }
    }
    
    // Call on load and resize
    adjustTextSizes();
    window.addEventListener('resize', adjustTextSizes);
    
    // Preloader timeout fallback
    setTimeout(() => {
        const preloader = document.getElementById('deleted');
        if (preloader && preloader.style.display !== 'none') {
            document.body.classList.remove('loading');
            preloader.style.display = 'none';
        }
    }, 6000); // Fallback after 6 seconds
});

// Notification system
function showNotification(message, type = 'info') {
    // Remove existing notification
    const existingNotification = document.querySelector('.custom-notification');
    if (existingNotification) {
        existingNotification.remove();
    }
    
    // Create notification
    const notification = document.createElement('div');
    notification.className = `custom-notification alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show`;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 10000;
        min-width: 300px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    `;
    
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.classList.remove('show');
            setTimeout(() => notification.remove(), 150);
        }
    }, 5000);
}

// Viewport height fix for mobile browsers
function setVH() {
    const vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
}

setVH();
window.addEventListener('resize', setVH);
window.addEventListener('orientationchange', setVH);
