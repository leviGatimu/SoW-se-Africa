<footer class="site-footer">
    <div class="content-container">
        <div class="footer-top">
            <div class="footer-widget brand-widget">
                <a href="index.php" class="footer-logo">
                    <span class="text-white">SoW!SE</span><span class="text-accent">AFRICA</span>
                </a>
                <p>Champions of values-based leadership. Registered NGO in Rwanda.</p>
                <div class="social-row">
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
            <div class="footer-widget">
                <h4>Quick Links</h4>
                <ul class="footer-list">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">Our Story</a></li>
                    <li><a href="programs.php">Our Programs</a></li>
                    <li><a href="blog.php">Latest News</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                </ul>
            </div>
            <div class="footer-widget newsletter-widget">
                <h4>Stay Updated</h4>
                <form action="#" class="newsletter-form">
                    <input type="email" placeholder="Email Address" required>
                    <button type="submit"><i class="fa-solid fa-arrow-right"></i></button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="copyright">&copy; <?php echo date("Y"); ?> SoW!SE Africa. All Rights Reserved.</div>
            <div class="legal-links">
                <a href="admin/login.php" style="opacity: 0.5;">Admin</a>
            </div>
        </div>
    </div>
</footer>

<style>
    /* 1. THE BACKDROP (Darkens the site behind the menu) */
    #drawer-backdrop {
        position: fixed !important;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.6); /* Semi-transparent black */
        z-index: 9999990;
        opacity: 0;
        visibility: hidden;
        transition: 0.3s ease;
        backdrop-filter: blur(2px); /* Blur effect */
    }
    #drawer-backdrop.active {
        opacity: 1;
        visibility: visible;
    }

    /* 2. THE DRAWER (The actual menu sidebar) */
    #mobile-drawer {
        position: fixed !important;
        top: 0; right: 0; /* Slides from RIGHT */
        width: 85%; /* Covers 85% of mobile screen, not 100% */
        max-width: 320px;
        height: 100vh;
        background: #0f172a; /* Dark Blue Theme */
        z-index: 9999999;
        transform: translateX(100%); /* Hidden to the right */
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        box-shadow: -5px 0 25px rgba(0,0,0,0.5);
    }
    #mobile-drawer.active {
        transform: translateX(0); /* Slide in */
    }

    /* 3. DRAWER HEADER (Logo + Close) */
    .drawer-header {
        padding: 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    .drawer-logo {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        font-size: 1.4rem;
        color: white;
        text-decoration: none;
    }
    .drawer-close {
        background: rgba(255,255,255,0.1);
        border: none;
        color: white;
        width: 40px; height: 40px;
        border-radius: 50%;
        font-size: 1.2rem;
        cursor: pointer;
        display: flex; align-items: center; justify-content: center;
    }

    /* 4. DRAWER LINKS */
    .drawer-body {
        flex: 1;
        overflow-y: auto;
        padding: 20px 25px;
    }
    .drawer-links {
        list-style: none; padding: 0; margin: 0;
    }
    .drawer-links li {
        margin-bottom: 5px;
        opacity: 0; 
        transform: translateX(20px);
        transition: 0.3s ease;
    }
    /* Staggered animation for links */
    #mobile-drawer.active .drawer-links li {
        opacity: 1; transform: translateX(0);
    }
    /* Delay each link slightly */
    #mobile-drawer.active .drawer-links li:nth-child(1) { transition-delay: 0.1s; }
    #mobile-drawer.active .drawer-links li:nth-child(2) { transition-delay: 0.15s; }
    #mobile-drawer.active .drawer-links li:nth-child(3) { transition-delay: 0.2s; }
    #mobile-drawer.active .drawer-links li:nth-child(4) { transition-delay: 0.25s; }
    #mobile-drawer.active .drawer-links li:nth-child(5) { transition-delay: 0.3s; }

    .drawer-links a {
        display: block;
        padding: 12px 0;
        color: #cbd5e1;
        font-size: 1.1rem;
        font-weight: 500;
        text-decoration: none;
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }
    .drawer-links a:hover {
        color: #f59e0b;
        padding-left: 10px; /* Slide effect */
    }

    /* 5. DRAWER FOOTER (Donate + Socials) */
    .drawer-footer {
        padding: 25px;
        background: rgba(0,0,0,0.2);
    }
    .drawer-btn {
        display: block;
        background: #f59e0b;
        color: white;
        text-align: center;
        padding: 15px;
        border-radius: 8px;
        font-weight: 700;
        text-decoration: none;
        margin-bottom: 20px;
    }
    .drawer-socials {
        display: flex; justify-content: center; gap: 20px;
    }
    .drawer-socials a {
        color: #94a3b8; font-size: 1.2rem; transition: 0.3s;
    }
    .drawer-socials a:hover { color: white; }
</style>

<div id="drawer-backdrop" onclick="toggleDrawer(false)"></div>

<div id="mobile-drawer">
    
    <div class="drawer-header">
        <a href="index.php" class="drawer-logo">
            SoW!SE <span style="color: #f59e0b;">AFRICA</span>
        </a>
        <button class="drawer-close" onclick="toggleDrawer(false)">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <div class="drawer-body">
        <ul class="drawer-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">Who We Are</a></li>
            <li><a href="programs.php">Our Programs</a></li>
            <li><a href="blog.php">Our Journal</a></li>
            <li><a href="contact.php">Contact Us</a></li>
        </ul>
    </div>

    <div class="drawer-footer">
        <a href="donate.php" class="drawer-btn">Donate Now</a>
        <div class="drawer-socials">
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
            <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
        </div>
    </div>

</div>

<script>
    function toggleDrawer(show) {
        const drawer = document.getElementById('mobile-drawer');
        const backdrop = document.getElementById('drawer-backdrop');
        
        if(show) {
            drawer.classList.add('active');
            backdrop.classList.add('active');
            document.body.style.overflow = 'hidden'; // Lock scroll
        } else {
            drawer.classList.remove('active');
            backdrop.classList.remove('active');
            document.body.style.overflow = ''; // Unlock scroll
        }
    }

    // Connect to your existing header button
    document.addEventListener("DOMContentLoaded", () => {
        const headerBtn = document.querySelector('.mobile-menu-toggle');
        if(headerBtn) {
            // Clone to remove old listeners
            const newBtn = headerBtn.cloneNode(true);
            headerBtn.parentNode.replaceChild(newBtn, headerBtn);
            
            newBtn.addEventListener('click', (e) => {
                e.preventDefault();
                toggleDrawer(true);
            });
        }
    });
</script>
<style>
    /* 1. BACKDROP */
    #drawer-backdrop {
        position: fixed !important;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.5); /* Dimmed background */
        z-index: 9999990;
        opacity: 0;
        visibility: hidden;
        transition: 0.3s ease;
    }
    #drawer-backdrop.active {
        opacity: 1;
        visibility: visible;
    }

    /* 2. THE WHITE DRAWER */
    #mobile-drawer {
        position: fixed !important;
        top: 0; right: 0;
        width: 85%;
        max-width: 300px;
        height: 100vh;
        background: #ffffff; /* WHITE BACKGROUND */
        z-index: 9999999;
        transform: translateX(100%);
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        box-shadow: -5px 0 30px rgba(0,0,0,0.15);
    }
    #mobile-drawer.active {
        transform: translateX(0);
    }

    /* 3. HEADER (Logo + Close) */
    .drawer-header {
        padding: 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #f1f5f9;
    }
    .drawer-logo {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        font-size: 1.4rem;
        color: #0f172a; /* Dark Blue Text */
        text-decoration: none;
    }
    .drawer-close {
        background: #f8fafc;
        border: none;
        color: #64748b;
        width: 35px; height: 35px;
        border-radius: 50%;
        font-size: 1.2rem;
        cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        transition: 0.2s;
    }
    .drawer-close:hover {
        background: #fee2e2;
        color: #ef4444;
    }

    /* 4. LINKS WITH ICONS */
    .drawer-body {
        flex: 1;
        padding: 20px 25px;
        overflow-y: auto;
    }
    .drawer-links {
        list-style: none; padding: 0; margin: 0;
    }
    .drawer-links li {
        margin-bottom: 15px;
    }
    .drawer-links a {
        display: flex;
        align-items: center;
        gap: 15px; /* Space between icon and text */
        padding: 10px 0;
        color: #334155; /* Dark Grey Text */
        font-size: 1.05rem;
        font-weight: 600;
        text-decoration: none;
        border-bottom: 1px solid #f8fafc;
        transition: 0.2s;
    }
    .drawer-links i {
        color: #f59e0b; /* ORANGE ICONS */
        width: 25px;
        text-align: center;
    }
    .drawer-links a:hover {
        color: #f59e0b; /* Orange text on hover */
        padding-left: 8px;
    }

    /* 5. DRAWER FOOTER */
    .drawer-footer {
        padding: 25px;
        background: #fffbeb; /* Very light orange bg */
        border-top: 1px solid #fef3c7;
    }
    .drawer-btn {
        display: block;
        background: #f59e0b;
        color: white;
        text-align: center;
        padding: 15px;
        border-radius: 8px;
        font-weight: 700;
        text-decoration: none;
        box-shadow: 0 4px 10px rgba(245, 158, 11, 0.3);
        margin-bottom: 20px;
    }
    .drawer-socials {
        display: flex; justify-content: center; gap: 20px;
    }
    .drawer-socials a {
        color: #d97706; /* Darker Orange */
        font-size: 1.2rem; 
        transition: 0.3s;
    }
</style>

<div id="drawer-backdrop" onclick="toggleDrawer(false)"></div>

<div id="mobile-drawer">
    
    <div class="drawer-header">
        <a href="index.php" class="drawer-logo">
            SoW!SE <span style="color: #f59e0b;">AFRICA</span>
        </a>
        <button class="drawer-close" onclick="toggleDrawer(false)">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <div class="drawer-body">
        <ul class="drawer-links">
            <li>
                <a href="index.php">
                    <i class="fa-solid fa-house"></i> Home
                </a>
            </li>
            <li>
                <a href="about.php">
                    <i class="fa-solid fa-users"></i> Who We Are
                </a>
            </li>
            <li>
                <a href="programs.php">
                    <i class="fa-solid fa-hand-holding-heart"></i> Our Programs
                </a>
            </li>
            <li>
                <a href="blog.php">
                    <i class="fa-solid fa-newspaper"></i> Our Journal
                </a>
            </li>
            <li>
                <a href="contact.php">
                    <i class="fa-solid fa-envelope"></i> Contact Us
                </a>
            </li>
        </ul>
    </div>

    <div class="drawer-footer">
        <a href="donate.php" class="drawer-btn">
            <i class="fa-solid fa-heart"></i> Donate Now
        </a>
        <div class="drawer-socials">
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
            <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
        </div>
    </div>

</div>

<script>
    function toggleDrawer(show) {
        const drawer = document.getElementById('mobile-drawer');
        const backdrop = document.getElementById('drawer-backdrop');
        
        if(show) {
            drawer.classList.add('active');
            backdrop.classList.add('active');
            document.body.style.overflow = 'hidden';
        } else {
            drawer.classList.remove('active');
            backdrop.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    // Connect to header button
    document.addEventListener("DOMContentLoaded", () => {
        const headerBtn = document.querySelector('.mobile-menu-toggle');
        if(headerBtn) {
            const newBtn = headerBtn.cloneNode(true);
            headerBtn.parentNode.replaceChild(newBtn, headerBtn);
            newBtn.addEventListener('click', (e) => {
                e.preventDefault();
                toggleDrawer(true);
            });
        }
    });
</script>

</body>
</html>