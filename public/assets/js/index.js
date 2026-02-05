// Mobile Menu Toggle
const mobileMenuToggle = document.getElementById('mobileMenuToggle');
const navMenu = document.getElementById('navMenu');

if (mobileMenuToggle && navMenu) {
  mobileMenuToggle.addEventListener('click', () => {
    navMenu.classList.toggle('active');
  });

  // Close menu when clicking on a link
  const navItems = navMenu.querySelectorAll('.nav-item a');
  navItems.forEach(item => {
    item.addEventListener('click', () => {
      navMenu.classList.remove('active');
    });
  });

  // Close menu when clicking outside
  document.addEventListener('click', (e) => {
    if (!navMenu.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
      navMenu.classList.remove('active');
    }
  });
}

// Smooth Scroll for Navigation Links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      target.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
    }
  });
});

// Contact Form Submission
const contactForm = document.getElementById('contactForm');
if (contactForm) {
  contactForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const submitButton = contactForm.querySelector('.btn-submit');
    const originalButtonText = submitButton.querySelector('span').textContent;
    
    // Disable button and show loading
    submitButton.disabled = true;
    submitButton.querySelector('span').textContent = 'جاري الإرسال...';
    
    try {
      const formData = new FormData(contactForm);
      
      const response = await fetch(contactForm.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
        }
      });
      
      const data = await response.json();
      
      if (response.ok && data.success) {
        // Show success message
        alert(data.message || 'شكراً لك! تم إرسال رسالتك بنجاح. سنتواصل معك قريباً.');
        // Reset form
        contactForm.reset();
      } else {
        // Show error message
        const errorMessage = data.message || 'حدث خطأ أثناء إرسال الرسالة. الرجاء المحاولة مرة أخرى.';
        alert(errorMessage);
      }
    } catch (error) {
      console.error('Error:', error);
      alert('حدث خطأ أثناء إرسال الرسالة. الرجاء المحاولة مرة أخرى.');
    } finally {
      // Re-enable button
      submitButton.disabled = false;
      submitButton.querySelector('span').textContent = originalButtonText;
    }
  });
}

// Testimonials Slider using Owl Carousel

// Scroll Animation (Fade in on scroll)
const observerOptions = {
  threshold: 0.1,
  rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.style.opacity = '1';
      entry.target.style.transform = 'translateY(0)';
    }
  });
}, observerOptions);

// Observe elements for animation
document.addEventListener('DOMContentLoaded', () => {
  const animatedElements = document.querySelectorAll('.feature-card, .testimonial-card, .who-section');
  animatedElements.forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(20px)';
    el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(el);
  });
});

// Header Scroll Effect - Removed since header is not fixed
// let lastScroll = 0;
// const header = document.querySelector('.header');

// window.addEventListener('scroll', () => {
//   const currentScroll = window.pageYOffset;
  
//   if (currentScroll > 100) {
//     header.style.background = 'rgba(255, 255, 255, 0.95)';
//     header.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
//   } else {
//     header.style.background = 'transparent';
//     header.style.boxShadow = 'none';
//   }
  
//   lastScroll = currentScroll;
// });

// Button Click Effects
document.querySelectorAll('.btn-primary, .btn-white').forEach(button => {
  button.addEventListener('click', function(e) {
    // Create ripple effect
    const ripple = document.createElement('span');
    const rect = this.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = e.clientX - rect.left - size / 2;
    const y = e.clientY - rect.top - size / 2;
    
    ripple.style.width = ripple.style.height = size + 'px';
    ripple.style.left = x + 'px';
    ripple.style.top = y + 'px';
    ripple.classList.add('ripple');
    
    this.appendChild(ripple);
    
    setTimeout(() => {
      ripple.remove();
    }, 600);
  });
});

// Add ripple effect CSS dynamically
const style = document.createElement('style');
style.textContent = `
  .btn-primary, .btn-white {
    position: relative;
    overflow: hidden;
  }
  
  .ripple {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.6);
    transform: scale(0);
    animation: ripple-animation 0.6s ease-out;
    pointer-events: none;
  }
  
  @keyframes ripple-animation {
    to {
      transform: scale(4);
      opacity: 0;
    }
  }
`;
document.head.appendChild(style);

// Owl Carousel Initialization for Client Logos
$(document).ready(function() {
  $('.client-logos-carousel').owlCarousel({
    rtl: true,
    loop: true,
    margin: 18,
    nav: false,
    dots: false,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    responsive: {
      0: {
        items: 2
      },
      480: {
        items: 3
      },
      768: {
        items: 4
      },
      1024: {
        items: 5
      },
      1200: {
        items: 5
      }
    }
  });
});
// Custom Testimonials Slider (No Library)
document.addEventListener('DOMContentLoaded', function() {
  const sliderTrack = document.getElementById('testimonialsSliderTrack');
  const prevBtn = document.getElementById('testimonialsPrevBtn');
  const nextBtn = document.getElementById('testimonialsNextBtn');
  const dotsContainer = document.getElementById('testimonialsDots');
  
  if (!sliderTrack || !prevBtn || !nextBtn || !dotsContainer) return;
  
  const slides = sliderTrack.querySelectorAll('.slide');
  const totalSlides = slides.length;
  let currentIndex = 0;
  
  // Get items per view based on screen size
  function getItemsPerView() {
    if (window.innerWidth >= 1441) return 3;
    if (window.innerWidth >= 768) return 2;
    return 1;
  }
  
  // Create dots
  function createDots() {
    dotsContainer.innerHTML = '';
    const itemsPerView = getItemsPerView();
    const totalDots = Math.ceil(totalSlides / itemsPerView);
    
    for (let i = 0; i < totalDots; i++) {
      const dot = document.createElement('div');
      dot.className = 'dot';
      if (i === 0) dot.classList.add('active');
      dot.addEventListener('click', () => goToSlide(i * itemsPerView));
      dotsContainer.appendChild(dot);
    }
  }
  
  // Update slider position
  function updateSlider() {
    const itemsPerView = getItemsPerView();
    const maxIndex = Math.max(0, totalSlides - itemsPerView);
    const clampedIndex = Math.min(currentIndex, maxIndex);
    
    // Calculate transform based on card width and margin
    if (sliderTrack.offsetWidth > 0) {
      const cardWidth = sliderTrack.querySelector('.testimonial-card').offsetWidth;
      const cardMargin = 24; // margin-left + margin-right
      const totalCardWidth = cardWidth + cardMargin;
      const translateX = clampedIndex * totalCardWidth;
      
      sliderTrack.style.transform = `translateX(-${translateX}px)`;
    }
    
    // Update dots
    const dots = dotsContainer.querySelectorAll('.dot');
    const activeDotIndex = Math.floor(clampedIndex / itemsPerView);
    dots.forEach((dot, index) => {
      dot.classList.toggle('active', index === activeDotIndex);
    });
    
    // Update buttons
    prevBtn.disabled = clampedIndex === 0;
    nextBtn.disabled = clampedIndex >= maxIndex;
  }
  
  // Go to specific slide
  function goToSlide(index) {
    currentIndex = index;
    updateSlider();
  }
  
  // Next slide
  function nextSlide() {
    const itemsPerView = getItemsPerView();
    const maxIndex = Math.max(0, totalSlides - itemsPerView);
    if (currentIndex < maxIndex) {
      currentIndex += itemsPerView;
      updateSlider();
    }
  }
  
  // Previous slide
  function prevSlide() {
    const itemsPerView = getItemsPerView();
    if (currentIndex > 0) {
      currentIndex = Math.max(0, currentIndex - itemsPerView);
      updateSlider();
    }
  }
  
  // Event listeners
  nextBtn.addEventListener('click', nextSlide);
  prevBtn.addEventListener('click', prevSlide);
  
  // Handle window resize
  let resizeTimeout;
  window.addEventListener('resize', function() {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(function() {
      createDots();
      currentIndex = 0;
      updateSlider();
    }, 250);
  });
  
  // Touch/swipe support
  let touchStartX = 0;
  let touchEndX = 0;
  
  sliderTrack.addEventListener('touchstart', function(e) {
    touchStartX = e.changedTouches[0].screenX;
  });
  
  sliderTrack.addEventListener('touchend', function(e) {
    touchEndX = e.changedTouches[0].screenX;
    handleSwipe();
  });
  
  function handleSwipe() {
    const swipeThreshold = 50;
    const diff = touchStartX - touchEndX;
    
    if (Math.abs(diff) > swipeThreshold) {
      if (diff > 0) {
        nextSlide();
      } else {
        prevSlide();
      }
    }
  }
  
  // Initialize
  createDots();
  updateSlider();
});

