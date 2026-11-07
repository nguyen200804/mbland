document.addEventListener('DOMContentLoaded', function() {
  // Toggle menu khi click hamburger button
  var hamburgerBtn = document.getElementById('hamburger-btn');
  var popup = document.getElementById('menu-popup');
  var overlay = document.getElementById('menu-overlay');
  var closeBtn = document.getElementById('close-btn');

  if (hamburgerBtn) {
    hamburgerBtn.addEventListener('click', function() {
      popup.classList.toggle('active');
      overlay.classList.toggle('active');
    });
  }

  if (closeBtn) {
    closeBtn.addEventListener('click', function() {
      popup.classList.remove('active');
      overlay.classList.remove('active');
    });
  }

  if (overlay) {
    overlay.addEventListener('click', function() {
      popup.classList.remove('active');
      overlay.classList.remove('active');
    });
  }

  // Toggle sub-menu trên mobile
  if (popup) {
    var subToggles = popup.querySelectorAll('.mbland-header__nav-item-has-children .menu-item-block');
    subToggles.forEach(function(toggle) {
      toggle.addEventListener('click', function(e) {
        e.preventDefault();
        var parentLi = toggle.closest('.mbland-header__nav-item-has-children');
        if (parentLi) {
          parentLi.classList.toggle('active');
        }
      });
    });
  }

  // Đóng menu khi resize lên desktop (khớp với breakpoint CSS: 1200px)
  window.addEventListener('resize', function() {
    if (window.innerWidth > 1200) {
      if (popup) popup.classList.remove('active');
      if (overlay) overlay.classList.remove('active');
    }
  });
});
					
					
// ===============Polylang=================
document.addEventListener('DOMContentLoaded', function() {
  const langDropdown = document.querySelector('.custom-lang-dropdown');
  const toggle = langDropdown?.querySelector('.lang-toggle');
  if (toggle) {
    toggle.addEventListener('click', function(e) {
      e.stopPropagation();
      langDropdown.classList.toggle('active');
    });
    document.addEventListener('click', function() {
      langDropdown.classList.remove('active');
    });
  }
});