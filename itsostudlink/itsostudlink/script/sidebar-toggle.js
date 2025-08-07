document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.querySelector('.overlay');

    if (sidebarToggle && sidebar && overlay) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('sidebar-open');
            overlay.classList.toggle('active');
        });

        overlay.addEventListener('click', function() {
            sidebar.classList.remove('sidebar-open');
            overlay.classList.remove('active');
        });
    }
});