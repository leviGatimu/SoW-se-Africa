document.addEventListener("DOMContentLoaded", () => {
    const menuBtn = document.querySelector('.mobile-menu-toggle');
    const closeBtn = document.querySelector('.mobile-menu-close');
    const overlay = document.querySelector('.mobile-menu-overlay');

    // Helper to lock scrolling
    function toggleMenu(show) {
        if (show) {
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden'; // Freeze background
        } else {
            overlay.classList.remove('active');
            document.body.style.overflow = ''; // Unfreeze
        }
    }

    if (menuBtn) {
        menuBtn.addEventListener('click', (e) => {
            e.preventDefault();
            toggleMenu(true);
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', (e) => {
            e.preventDefault();
            toggleMenu(false);
        });
    }

    // Close when clicking a link
    document.querySelectorAll('.mobile-links a').forEach(link => {
        link.addEventListener('click', () => toggleMenu(false));
    });
});