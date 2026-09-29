/* =====================================================
   EuroMedStudy – Interactive JavaScript (Laravel Version)
   ===================================================== */

document.addEventListener('DOMContentLoaded', () => {

  // ===== NAVBAR SCROLL =====
  const navbar = document.getElementById('navbar');
  window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > 50);
  });

  // ===== HAMBURGER MENU =====
  const hamburger = document.getElementById('hamburger');
  const navLinks  = document.getElementById('navLinks');
  hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('open');
    navLinks.classList.toggle('open');
  });
  navLinks.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', () => {
      hamburger.classList.remove('open');
      navLinks.classList.remove('open');
    });
  });

  // ===== BACK TO TOP =====
  const backToTop = document.getElementById('backToTop');
  window.addEventListener('scroll', () => {
    backToTop.classList.toggle('visible', window.scrollY > 400);
  });
  backToTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

  // ===== TESTIMONIALS CAROUSEL =====
  const track = document.getElementById('testimonialsTrack');
  const dotsContainer = document.getElementById('carouselDots');
  const cards = track ? track.querySelectorAll('.testimonial-card') : [];
  let currentIndex = 0;
  let autoPlayTimer = null;

  if (cards.length > 0) {
    cards.forEach((_, i) => {
      const dot = document.createElement('button');
      dot.className = 'dot' + (i === 0 ? ' active' : '');
      dot.setAttribute('aria-label', `Go to testimonial ${i + 1}`);
      dot.addEventListener('click', () => { stopAutoPlay(); goToSlide(i); startAutoPlay(); });
      dotsContainer.appendChild(dot);
    });

    function goToSlide(index) {
      currentIndex = (index + cards.length) % cards.length;
      track.style.transform = `translateX(-${currentIndex * 100}%)`;
      dotsContainer.querySelectorAll('.dot').forEach((d, i) => d.classList.toggle('active', i === currentIndex));
    }
    function startAutoPlay() { autoPlayTimer = setInterval(() => goToSlide(currentIndex + 1), 5000); }
    function stopAutoPlay()  { clearInterval(autoPlayTimer); }

    document.getElementById('prevBtn').addEventListener('click', () => { stopAutoPlay(); goToSlide(currentIndex - 1); startAutoPlay(); });
    document.getElementById('nextBtn').addEventListener('click', () => { stopAutoPlay(); goToSlide(currentIndex + 1); startAutoPlay(); });

    let touchStartX = 0;
    track.addEventListener('touchstart', e => { touchStartX = e.changedTouches[0].clientX; });
    track.addEventListener('touchend',   e => {
      const diff = touchStartX - e.changedTouches[0].clientX;
      if (Math.abs(diff) > 50) { stopAutoPlay(); goToSlide(diff > 0 ? currentIndex + 1 : currentIndex - 1); startAutoPlay(); }
    });
    startAutoPlay();
  }

  // ===== FAQ ACCORDION =====
  document.querySelectorAll('.faq-item').forEach(item => {
    const question = item.querySelector('.faq-question');
    const answer   = item.querySelector('.faq-answer');
    question.addEventListener('click', () => {
      const isOpen = item.classList.contains('open');
      document.querySelectorAll('.faq-item').forEach(i => {
        i.classList.remove('open');
        i.querySelector('.faq-answer').style.maxHeight = null;
        i.querySelector('.faq-question').setAttribute('aria-expanded', 'false');
      });
      if (!isOpen) {
        item.classList.add('open');
        answer.style.maxHeight = answer.scrollHeight + 'px';
        question.setAttribute('aria-expanded', 'true');
      }
    });
  });

  // ===== CONTACT FORM (AJAX with Laravel CSRF) =====
  const contactForm   = document.getElementById('contactForm');
  const successModal  = document.getElementById('successModal');
  const closeModal    = document.getElementById('closeModal');

  if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const btn    = document.getElementById('submitForm');
      const action = contactForm.getAttribute('action');
      const token  = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const data   = new FormData(contactForm);

      btn.textContent = 'Submitting...';
      btn.disabled    = true;

      fetch(action, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': token, 'Accept': 'application/json' },
        body: data,
      })
      .then(res => res.json())
      .then(json => {
        if (json.success) {
          contactForm.reset();
          successModal.classList.add('active');
        } else {
          // Show validation errors
          let msg = 'Please check the form and try again.';
          if (json.errors) {
            msg = Object.values(json.errors).flat().join('\n');
          }
          alert(msg);
        }
      })
      .catch(() => {
        // Fallback: submit normally
        contactForm.submit();
      })
      .finally(() => {
        btn.textContent = 'Submit Free Application →';
        btn.disabled    = false;
      });
    });
  }

  if (closeModal) closeModal.addEventListener('click', () => successModal.classList.remove('active'));
  if (successModal) successModal.addEventListener('click', e => { if (e.target === successModal) successModal.classList.remove('active'); });

  // ===== SCROLL REVEAL =====
  const revealEls = document.querySelectorAll('.why-card, .country-card, .process-step, .elig-card, .uni-card, .contact-item, .faq-item');
  revealEls.forEach(el => el.classList.add('reveal'));
  const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) { entry.target.classList.add('visible'); revealObserver.unobserve(entry.target); }
    });
  }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
  revealEls.forEach(el => revealObserver.observe(el));

  // ===== ACTIVE NAV LINK =====
  const sections    = document.querySelectorAll('section[id]');
  const navLinksAll = document.querySelectorAll('.nav-link:not(.nav-cta)');
  new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const id = entry.target.getAttribute('id');
        navLinksAll.forEach(link => {
          link.style.color = '';
          if (link.getAttribute('href') === `#${id}`) link.style.color = 'var(--primary-light, #3b7af8)';
        });
      }
    });
  }, { threshold: 0.35 }).observe;
  sections.forEach(s => new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const id = entry.target.getAttribute('id');
        navLinksAll.forEach(link => {
          link.style.color = '';
          if (link.getAttribute('href') === `#${id}`) link.style.color = 'var(--primary)';
        });
      }
    });
  }, { threshold: 0.35 }).observe(s));

  // ===== SMOOTH SCROLL =====
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      const href = this.getAttribute('href');
      if (href === '#') return;
      const target = document.querySelector(href);
      if (target) {
        e.preventDefault();
        const navH = 80;
        window.scrollTo({ top: target.getBoundingClientRect().top + window.scrollY - navH, behavior: 'smooth' });
      }
    });
  });

  // ===== PARALLAX HERO =====
  const heroImg = document.querySelector('.hero-img');
  if (heroImg) {
    window.addEventListener('scroll', () => {
      if (window.scrollY < window.innerHeight) {
        heroImg.style.transform = `translateY(${window.scrollY * 0.25}px) scale(1.05)`;
      }
    });
  }

  console.log('✅ EuroMedStudy – Laravel version loaded');
});
