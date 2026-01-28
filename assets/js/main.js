document.addEventListener("DOMContentLoaded", (event) => {
    
    // --- 1. GSAP ANIMATIONS ---
    gsap.registerPlugin(ScrollTrigger);

    gsap.to(".fade-in", {
        opacity: 1, y: 0, duration: 1, stagger: 0.2, ease: "power2.out"
    });

    const revealElements = document.querySelectorAll(".reveal-up");
    revealElements.forEach((element) => {
        ScrollTrigger.create({
            trigger: element,
            start: "top 85%", 
            onEnter: () => element.classList.add("active"),
            once: true
        });
    });

    // --- 2. MOBILE MENU LOGIC (THE FIX) ---
    const menuBtn = document.querySelector('.mobile-menu-toggle');
    const closeBtn = document.querySelector('.mobile-menu-close');
    const overlay = document.querySelector('.mobile-menu-overlay');
    const mobileLinks = document.querySelectorAll('.mobile-links a');

    function openMenu() {
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden'; // Stop background scrolling
    }

    function closeMenu() {
        overlay.classList.remove('active');
        document.body.style.overflow = ''; // Resume scrolling
    }

    if(menuBtn) {
        menuBtn.addEventListener('click', openMenu);
    }

    if(closeBtn) {
        closeBtn.addEventListener('click', closeMenu);
    }

    // Close menu when clicking outside (on the dark overlay)
    if(overlay) {
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) {
                closeMenu();
            }
        });
    }

    // Close menu when a link is clicked
    mobileLinks.forEach(link => {
        link.addEventListener('click', closeMenu);
    });

});