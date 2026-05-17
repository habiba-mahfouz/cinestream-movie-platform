document.addEventListener('DOMContentLoaded', function () {
  applyTheme();

  const searchInput = document.getElementById('main-search');
  if (searchInput) {
    searchInput.addEventListener('focus', function () {
      if (window.location.pathname.indexOf('search.php') === -1) {
        window.location.href = 'search.php';
      }
    });
    searchInput.addEventListener('keydown', handleSearchKeydown);
  }

  setupFormValidation('login-form', validateLogin);
  setupFormValidation('signup-form', validateSignup);
});

function setupFormValidation(formId, validationFn) {
  const form = document.getElementById(formId);
  if (form) {
    form.addEventListener('submit', function (e) {
    if (!validationFn()) e.preventDefault();
});
  }
}

function isValidEmail(emailStr) {
  return emailStr.includes('@') && emailStr.includes('.');
}

function validateLogin() {
  const email = document.getElementById('login-email');
  const password = document.getElementById('login-password');
  let valid = true;
  clearErrors();
  
  if (!email || !isValidEmail(email.value)) {
    if (email) showError(email, 'Please enter a valid email address');
    valid = false;
  }
  if (!password || password.value.length < 1) {
    if (password) showError(password, 'Password is required');
    valid = false;
  }
  return valid;
}

function validateSignup() {
  const email = document.getElementById('signup-email');
  const password = document.getElementById('signup-password');
  let valid = true;
  clearErrors();
  
  if (!email || !isValidEmail(email.value)) {
    if (email) showError(email, 'Please enter a valid email address');
    valid = false;
  }
  if (!password || password.value.length < 6) {
    if (password) showError(password, 'Password must be at least 6 characters');
    valid = false;
  }
  return valid;
}

function showError(input, msg) {
  input.classList.add('field-error-input');
  const err = document.createElement('div');
  err.className = 'field-error-msg';
  err.textContent = msg;
  input.parentNode.appendChild(err);
}

function clearErrors() {
  document.querySelectorAll('.field-error-msg').forEach(el => el.remove());
  document.querySelectorAll('.form-input').forEach(el => el.classList.remove('field-error-input'));
}

function switchTab(tab) {
  document.querySelectorAll('.auth-tab').forEach(t => t.classList.remove('active'));
  document.querySelectorAll('.auth-form').forEach(f => f.classList.remove('active'));
  const targetTab = document.querySelector(`.auth-tab[data-tab="${tab}"]`);
  const targetForm = document.getElementById(`form-${tab}`);
  if (targetTab) targetTab.classList.add('active');
  if (targetForm) targetForm.classList.add('active');
}

document.addEventListener('click', function (e) {

  const listBtn = e.target.closest('.js-list-btn');
  if (listBtn) {
    const id = listBtn.dataset.id;
    toggleMyList(listBtn, id);
    return;
  }

  const themeBtn = e.target.closest('.js-theme-toggle');
  if (themeBtn) {
    toggleDarkMode();
    return;
  }

  const profBtn = e.target.closest('.js-profile-btn');
  if (profBtn) {
    toggleProfileMenu();
    return;
  }

  const authTab = e.target.closest('.auth-tab');
  if (authTab) {
    const tab = authTab.dataset.tab;
    switchTab(tab);
    return;
  }

  const profWrapper = document.querySelector('.profile-wrapper');
  if (profWrapper && !profWrapper.contains(e.target)) {
    const dropdown = document.getElementById('profile-dropdown');
    if (dropdown) dropdown.classList.remove('open');
  }

  if (window.location.pathname.includes('search.php')) {
    const isSearchForm = e.target.closest('.search-form');
    const isResults = e.target.closest('.cards-grid');
    const isLogo = e.target.closest('.logo');
    const isProfile = e.target.closest('.profile-wrapper');
    if (!isSearchForm && !isResults && !isLogo && !isProfile) {
      window.location.href = 'movies.php';
    }
  }
});

function toggleDarkMode() {
  document.body.classList.toggle('light-mode');
  const isLight = document.body.classList.contains('light-mode');
  localStorage.setItem('cinestream-theme', isLight ? 'light' : 'dark');
  updateThemeIcon(isLight);
}

function updateThemeIcon(isLight) {
  const btn = document.getElementById('theme-toggle');
  if (!btn) return;
  btn.innerHTML = isLight
    ? '<span class="default-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg></span>'
    : '<span class="default-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg></span>';
}

function applyTheme() {
  const saved = localStorage.getItem('cinestream-theme');
  if (saved === 'light') {
    document.body.classList.add('light-mode');
    updateThemeIcon(true);
  } else {
    updateThemeIcon(false);
  }
}

function toggleMyList(btn, contentId) {
  const isAdded = btn.classList.contains('added');
  const isLarge = btn.classList.contains('btn-list-large');
  const action = isAdded ? 'remove' : 'add';

  fetch('handle_list.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `action=${action}&content_id=${contentId}`
  })
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        if (action === 'add') {
          btn.classList.add('added');
          btn.title = 'Remove from list';
          btn.innerHTML = isLarge ? '✓ In My List' : '✓';
        } else {
          btn.classList.remove('added');
          btn.title = 'Add to list';
          btn.innerHTML = isLarge ? '+ Add to My List' : '+';

          if (window.location.pathname.indexOf('mylist.php') !== -1) {
            const card = btn.closest('.content-card');
            if (card) {
              card.style.opacity = '0';
              card.style.transform = 'scale(0.9)';
              card.style.transition = 'all 0.3s ease';
              setTimeout(() => card.remove(), 300);
            }
          }
        }
      } else if (data.guest) {
        window.location.href = 'register.php';
      }
    })
    .catch(err => console.error('Error toggling list:', err));
}

function handleSearchKeydown(e) {
  if (e.key === 'Enter' && e.target.value.trim() !== '') {
    e.preventDefault();
    window.location.href = 'search.php?q=' + e.target.value.trim();
  }
}

function toggleProfileMenu() {
  const dropdown = document.getElementById('profile-dropdown');
  if (dropdown) dropdown.classList.toggle('open');
}
