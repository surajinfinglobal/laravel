document.addEventListener('DOMContentLoaded', function () {

  /* ---------- Sticky navbar shrink on scroll ---------- */
  const navbar = document.querySelector('.navbar');
  const onScroll = () => {
    if (window.scrollY > 20) navbar.classList.add('is-scrolled');
    else navbar.classList.remove('is-scrolled');
  };
  document.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  /* ---------- Mobile nav toggle ---------- */
  const mobileToggle = document.querySelector('.mobile-toggle');
  const navLinks = document.querySelector('.nav-links');
  if (mobileToggle && navLinks) {
    mobileToggle.addEventListener('click', () => {
      navLinks.classList.toggle('open');
      const icon = mobileToggle.querySelector('i');
      icon.classList.toggle('fa-bars');
      icon.classList.toggle('fa-xmark');
    });
    navLinks.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        navLinks.classList.remove('open');
        mobileToggle.querySelector('i').classList.add('fa-bars');
        mobileToggle.querySelector('i').classList.remove('fa-xmark');
      });
    });
  }

  /* ---------- Profile dropdown ---------- */
  const profileDd = document.querySelector('.profile-dd');
  if (profileDd) {
    const trigger = profileDd.querySelector('.profile-trigger');
    trigger.addEventListener('click', (e) => {
      e.stopPropagation();
      profileDd.classList.toggle('open');
    });
    document.addEventListener('click', () => profileDd.classList.remove('open'));
  }

  /* ---------- Scroll reveal (fade-in on scroll) ---------- */
  const revealEls = document.querySelectorAll('.reveal');
  const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('in-view');
        revealObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15 });
  revealEls.forEach(el => revealObserver.observe(el));

  /* ---------- Animated stat counters ---------- */
  const counters = document.querySelectorAll('[data-counter]');
  const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      const el = entry.target;
      const target = parseInt(el.dataset.counter, 10);
      const duration = 1600;
      const start = performance.now();

      const tick = (now) => {
        const progress = Math.min((now - start) / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3);
        el.textContent = Math.floor(eased * target).toLocaleString();
        if (progress < 1) requestAnimationFrame(tick);
        else el.textContent = target.toLocaleString() + (el.dataset.suffix || '');
      };
      requestAnimationFrame(tick);
      counterObserver.unobserve(el);
    });
  }, { threshold: 0.5 });
  counters.forEach(el => counterObserver.observe(el));

  /* ---------- Button ripple effect ---------- */
  document.querySelectorAll('.btn').forEach(btn => {
    btn.addEventListener('click', function (e) {
      const rect = this.getBoundingClientRect();
      const ripple = document.createElement('span');
      const size = Math.max(rect.width, rect.height);
      ripple.className = 'ripple';
      ripple.style.width = ripple.style.height = size + 'px';
      ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
      ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';
      this.appendChild(ripple);
      setTimeout(() => ripple.remove(), 600);
    });
  });

});

document.addEventListener('DOMContentLoaded', function () {

  /* ---------- Password show/hide toggle ---------- */
  document.querySelectorAll('.toggle-password').forEach(btn => {
    btn.addEventListener('click', () => {
      const targetId = btn.getAttribute('data-target');
      const input = document.getElementById(targetId);
      if (!input) return;
      const icon = btn.querySelector('i');
      const isHidden = input.type === 'password';
      input.type = isHidden ? 'text' : 'password';
      icon.classList.toggle('fa-eye', !isHidden);
      icon.classList.toggle('fa-eye-slash', isHidden);
    });
  });

  /* ---------- Simple password strength meter (register page) ---------- */
  const passwordInput = document.getElementById('password');
  const strengthBars = document.querySelectorAll('.password-strength span');
  if (passwordInput && strengthBars.length) {
    passwordInput.addEventListener('input', () => {
      const value = passwordInput.value;
      let score = 0;
      if (value.length >= 8) score++;
      if (/[A-Z]/.test(value)) score++;
      if (/[0-9]/.test(value)) score++;
      if (/[^A-Za-z0-9]/.test(value)) score++;

      const colors = ['#ef4444', '#f97316', '#eab308', '#22c55e'];
      strengthBars.forEach((bar, i) => {
        bar.style.background = i < score ? colors[score - 1] : 'var(--surface-strong)';
      });
    });
  }

});
document.addEventListener('DOMContentLoaded', function () {

  const imageInput = document.getElementById('image');
  const fileDrop = document.getElementById('fileDrop');
  const fileName = document.getElementById('fileName');
  const fileNameText = document.getElementById('fileNameText');

  if (imageInput && fileDrop && fileName && fileNameText) {
    imageInput.addEventListener('change', () => {
      if (imageInput.files && imageInput.files.length > 0) {
        fileNameText.textContent = imageInput.files[0].name;
        fileName.classList.add('show');
        fileDrop.classList.add('has-file');
      } else {
        fileName.classList.remove('show');
        fileDrop.classList.remove('has-file');
      }
    });

    ['dragover', 'dragleave', 'drop'].forEach(evt => {
      fileDrop.addEventListener(evt, (e) => e.preventDefault());
    });
  }

});