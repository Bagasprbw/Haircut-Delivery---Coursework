document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('scroll', function () {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 10) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    const desktopSidebar = document.getElementById('desktopSidebar');
    const desktopToggleBtn = document.getElementById('desktopSidebarToggle');
    const closeSidebarBtn = document.getElementById('closeSidebar');
    const overlay = document.getElementById('sidebarOverlay');

    // Toggle sidebar
    function toggleSidebar() {
        desktopSidebar.classList.toggle('show');
        overlay.classList.toggle('show');

        // Rotasi ikon
        const icon = desktopToggleBtn.querySelector('i');
        icon.classList.toggle('fa-times');
        icon.classList.toggle('fa-bars');
    }

    // Event listeners
    desktopToggleBtn.addEventListener('click', toggleSidebar);

    closeSidebarBtn.addEventListener('click', function () {
        desktopSidebar.classList.remove('show');
        overlay.classList.remove('show');
        desktopToggleBtn.querySelector('i').classList.add('fa-bars');
        desktopToggleBtn.querySelector('i').classList.remove('fa-times');
    });

    overlay.addEventListener('click', function () {
        desktopSidebar.classList.remove('show');
        overlay.classList.remove('show');
        desktopToggleBtn.querySelector('i').classList.add('fa-bars');
        desktopToggleBtn.querySelector('i').classList.remove('fa-times');
    });
});

