document.addEventListener('DOMContentLoaded', function() {
  // Back to top button functionality
  const backToTopButton = document.querySelector('.back-to-top');
  if (backToTopButton) {
    backToTopButton.addEventListener('click', (e) => {
      e.preventDefault();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }


  const sidebarLinks = document.querySelectorAll('#sidebar-links li a');
  const currentPath = window.location.href;

  sidebarLinks.forEach(link => {
    if (link.href === currentPath) {
      link.parentElement.classList.add('active');
    }
  });


  const sidebar = document.querySelector('.sidebar');
  const mainContent = document.querySelector('.main');
  const sidebarToggle = document.querySelector('.sidebar-toggle');

  if (sidebar && mainContent && sidebarToggle) {
    sidebarToggle.addEventListener('click', () => {
      if (window.innerWidth <= 768) {
        sidebar.classList.toggle('sidebar-mobile-open');
      } else {
        sidebar.classList.toggle('sidebar-hidden');
      }
    });
  }
});
