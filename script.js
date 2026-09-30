/* =======================================================
   EUROMEDSTDY — SHARED JAVASCRIPT
   ======================================================= */

'use strict';

// ─── Navbar ─────────────────────────────────────────────────
const navbar = document.getElementById('navbar');
const hamburger = document.getElementById('hamburger');
const navLinks = document.getElementById('navLinks');

window.addEventListener('scroll', () => {
  if (window.scrollY > 40) {
    navbar?.classList.add('scrolled');
  } else {
    navbar?.classList.remove('scrolled');
  }
  updateBackToTop();
});

hamburger?.addEventListener('click', () => {
  hamburger.classList.toggle('active');
  navLinks?.classList.toggle('open');
});

// Close mobile menu on link click
navLinks?.querySelectorAll('a').forEach(link => {
  link.addEventListener('click', () => {
    hamburger?.classList.remove('active');
    navLinks?.classList.remove('open');
  });
});

// Set active nav link based on current page
(function setActiveNav() {
  const current = window.location.pathname.split('/').pop() || 'index.html';
  document.querySelectorAll('.nav-link').forEach(link => {
    const href = link.getAttribute('href') || '';
    const page = href.split('/').pop();
    if (page === current || (current === '' && page === 'index.html')) {
      link.classList.add('active');
    }
  });
})();

// ─── Scroll Animations ──────────────────────────────────────
const observerOptions = {
  threshold: 0.12,
  rootMargin: '0px 0px -40px 0px',
};

const scrollObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
      scrollObserver.unobserve(entry.target);
    }
  });
}, observerOptions);

document.querySelectorAll('.animate-on-scroll').forEach(el => {
  scrollObserver.observe(el);
});

// ─── Back To Top ────────────────────────────────────────────
const backToTop = document.getElementById('backToTop');

function updateBackToTop() {
  if (window.scrollY > 400) {
    backToTop?.classList.add('visible');
  } else {
    backToTop?.classList.remove('visible');
  }
}

backToTop?.addEventListener('click', () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
});

// ─── FAQ Accordion ──────────────────────────────────────────
document.querySelectorAll('.faq-item').forEach(item => {
  const question = item.querySelector('.faq-question');
  question?.addEventListener('click', () => {
    const isOpen = item.classList.contains('open');
    // Close all others
    document.querySelectorAll('.faq-item.open').forEach(other => {
      if (other !== item) other.classList.remove('open');
    });
    item.classList.toggle('open', !isOpen);
    question.setAttribute('aria-expanded', String(!isOpen));
  });
});

// ─── Contact Form Submission ─────────────────────────────────
const contactForm = document.getElementById('contactForm');
const successModal = document.getElementById('successModal');
const closeModal = document.getElementById('closeModal');

contactForm?.addEventListener('submit', (e) => {
  e.preventDefault();
  // Simulate form submission
  const btn = contactForm.querySelector('[type="submit"]');
  btn.textContent = 'Submitting…';
  btn.disabled = true;
  setTimeout(() => {
    btn.textContent = 'Submit Free Application →';
    btn.disabled = false;
    successModal?.classList.add('active');
    contactForm.reset();
  }, 1200);
});

closeModal?.addEventListener('click', () => {
  successModal?.classList.remove('active');
});

successModal?.addEventListener('click', (e) => {
  if (e.target === successModal) successModal.classList.remove('active');
});

// ─── Newsletter Form ─────────────────────────────────────────
document.querySelectorAll('.newsletter-form').forEach(form => {
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const input = form.querySelector('input');
    const btn = form.querySelector('button');
    btn.textContent = '✓ Subscribed!';
    btn.style.background = 'var(--clr-success)';
    if (input) input.value = '';
    setTimeout(() => {
      btn.textContent = 'Subscribe';
      btn.style.background = '';
    }, 3000);
  });
});

// ─── Smooth Scroll for anchor links ─────────────────────────
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', (e) => {
    const target = document.querySelector(anchor.getAttribute('href'));
    if (target) {
      e.preventDefault();
      const top = target.getBoundingClientRect().top + window.scrollY - 80;
      window.scrollTo({ top, behavior: 'smooth' });
    }
  });
});

// ─── Counter Animation ───────────────────────────────────────
function animateCounter(el, target, duration = 1800) {
  let start = 0;
  const step = target / (duration / 16);
  const timer = setInterval(() => {
    start += step;
    if (start >= target) {
      clearInterval(timer);
      el.textContent = el.dataset.suffix
        ? target + el.dataset.suffix
        : target.toLocaleString();
    } else {
      el.textContent = el.dataset.suffix
        ? Math.floor(start) + el.dataset.suffix
        : Math.floor(start).toLocaleString();
    }
  }, 16);
}

const counterObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const el = entry.target;
      const target = parseInt(el.dataset.count || '0', 10);
      animateCounter(el, target);
      counterObserver.unobserve(el);
    }
  });
}, { threshold: 0.5 });

document.querySelectorAll('[data-count]').forEach(el => {
  counterObserver.observe(el);
});

// ─── Testimonial Carousel (Home) ─────────────────────────────
(function initCarousel() {
  const track = document.getElementById('testimonialsTrack');
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  const dotsWrap = document.getElementById('carouselDots');

  if (!track) return;

  const cards = track.querySelectorAll('.testimonial-card');
  let current = 0;
  let autoInterval;

  function getVisible() {
    return window.innerWidth < 768 ? 1 : window.innerWidth < 1024 ? 2 : 3;
  }

  function buildDots() {
    if (!dotsWrap) return;
    dotsWrap.innerHTML = '';
    const count = Math.ceil(cards.length / getVisible());
    for (let i = 0; i < count; i++) {
      const dot = document.createElement('button');
      dot.setAttribute('aria-label', `Testimonial ${i + 1}`);
      dot.className = 'carousel-dot' + (i === current ? ' active' : '');
      dot.addEventListener('click', () => goTo(i));
      dotsWrap.appendChild(dot);
    }
  }

  function goTo(index) {
    const total = Math.ceil(cards.length / getVisible());
    current = (index + total) % total;
    const offset = current * (100 / getVisible()) * getVisible();
    track.style.transform = `translateX(-${current * 100}%)`;
    dotsWrap?.querySelectorAll('.carousel-dot').forEach((d, i) => {
      d.classList.toggle('active', i === current);
    });
  }

  prevBtn?.addEventListener('click', () => goTo(current - 1));
  nextBtn?.addEventListener('click', () => goTo(current + 1));

  function startAuto() {
    autoInterval = setInterval(() => goTo(current + 1), 4500);
  }

  track.addEventListener('mouseenter', () => clearInterval(autoInterval));
  track.addEventListener('mouseleave', startAuto);

  buildDots();
  startAuto();
  window.addEventListener('resize', buildDots);
})();

// Add CSS for carousel dots dynamically
(function addCarouselStyles() {
  const style = document.createElement('style');
  style.textContent = `
    .testimonials-carousel { overflow: hidden; position: relative; }
    .testimonials-track {
      display: flex;
      transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
      align-items: stretch;
    }
    .testimonials-track .testimonial-card {
      flex: 0 0 calc(100% / 3);
      min-width: calc(100% / 3);
      max-width: calc(100% / 3);
      box-sizing: border-box;
      padding: 0 10px;
      overflow: hidden;
      word-break: break-word;
      overflow-wrap: break-word;
    }
    .testimonials-track .testimonial-card > div,
    .testimonials-track .testimonial-card > p {
      overflow-wrap: break-word;
      word-break: break-word;
    }
    @media (max-width: 1024px) {
      .testimonials-track .testimonial-card { flex: 0 0 50%; min-width: 50%; max-width: 50%; }
    }
    @media (max-width: 768px) {
      .testimonials-track .testimonial-card { flex: 0 0 100%; min-width: 100%; max-width: 100%; }
    }
    .carousel-controls {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 16px;
      margin-top: 32px;
    }
    .carousel-btn {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      border: 1.5px solid var(--clr-border);
      color: var(--clr-text-muted);
      font-size: 1.1rem;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.25s ease;
      background: var(--clr-bg-card);
      cursor: pointer;
      flex-shrink: 0;
    }
    .carousel-btn:hover {
      border-color: var(--clr-primary);
      color: var(--clr-primary);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(29,110,245,0.15);
    }
    .carousel-dots { display: flex; gap: 8px; align-items: center; }
    .carousel-dot {
      width: 8px;
      height: 8px;
      border-radius: 4px;
      background: var(--clr-text-faint);
      cursor: pointer;
      transition: all 0.3s ease;
      border: none;
    }
    .carousel-dot.active {
      background: var(--clr-primary);
      width: 24px;
    }
  `;
  document.head.appendChild(style);
})();
