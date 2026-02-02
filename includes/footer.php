<footer class="site-footer" style="background: #0f172a; color: white; border-top: 4px solid #f59e0b; padding-top: 80px; padding-bottom: 20px;">
    <div class="content-container">
        
        <div style="display: flex; flex-wrap: wrap; gap: 40px; margin-bottom: 60px;">

            <div style="flex: 1; min-width: 250px;">
                <a href="index.php" style="text-decoration: none; display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                    <img src="assets/img/logo.png" alt="Logo" style="height: 40px;">
                    <span style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.4rem; color: white; letter-spacing: -1px;">
                        SoW!SE <span style="color: #f59e0b;">AFRICA</span>
                    </span>
                </a>
                <p style="color: #94a3b8; line-height: 1.6; font-size: 0.95rem; margin-bottom: 25px;">
                    Champions of values-based leadership. A registered NGO in Rwanda dedicated to empowering the next generation.
                </p>
                <div style="display: flex; gap: 15px;">
                    <a href="#" class="social-btn"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="social-btn"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="#" class="social-btn"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="#" class="social-btn"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>

            <div style="flex: 1; min-width: 180px;">
                <h4 style="color: white; font-family: 'Outfit', sans-serif; font-weight: 700; margin-bottom: 25px;">Quick Links</h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: 12px;"><a href="index.php" class="footer-link">Home</a></li>
                    <li style="margin-bottom: 12px;"><a href="about.php" class="footer-link">Who We Are</a></li>
                    <li style="margin-bottom: 12px;"><a href="programs.php" class="footer-link">Our Programs</a></li>
                    <li style="margin-bottom: 12px;"><a href="blog.php" class="footer-link">Latest News</a></li>
                    <li style="margin-bottom: 12px;"><a href="contact.php" class="footer-link">Contact Us</a></li>
                </ul>
            </div>

            <div style="flex: 1; min-width: 250px;">
                <h4 style="color: white; font-family: 'Outfit', sans-serif; font-weight: 700; margin-bottom: 25px;">Find Us</h4>
                <div style="border-radius: 12px; overflow: hidden; height: 150px; border: 2px solid rgba(255,255,255,0.1);">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15949.999999999999!2d30.0!3d-1.9!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMsKwNTQnMDAuMCJTIDMwwrAwMCwwMC4wIkU!5e0!3m2!1sen!2srw!4v1600000000000!5m2!1sen!2srw" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>

            <div style="flex: 1; min-width: 250px;">
                <h4 style="color: white; font-family: 'Outfit', sans-serif; font-weight: 700; margin-bottom: 25px;">Contact</h4>
                <div class="contact-item"><i class="fa-solid fa-location-dot"></i> <span>Kigali, Rwanda</span></div>
                <div class="contact-item"><i class="fa-solid fa-phone"></i> <span>+250 782 117 222</span></div>
                <div class="contact-item"><i class="fa-solid fa-envelope"></i> <span>info@sowiseafrica.org</span></div>
            </div>

        </div>

        <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 30px; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 20px;">
            <div style="color: #64748b; font-size: 0.9rem;">
                © <?php echo date("Y"); ?> SoW!SE Africa. All Rights Reserved.
            </div>
            <div style="display: flex; gap: 20px;">
                <a href="#" class="footer-link-sm">Privacy Policy</a>
                <a href="admin/login.php" class="footer-link-sm">Admin Login</a>
            </div>
        </div>
    </div>
</footer>

<style>
    /* Footer & General CSS Tweaks */
    .social-btn { width: 35px; height: 35px; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; border-radius: 50%; color: white; transition: 0.3s; text-decoration: none; }
    .social-btn:hover { background: #f59e0b; transform: translateY(-3px); }
    .footer-link { color: #cbd5e1; text-decoration: none; transition: 0.3s; }
    .footer-link:hover { color: #f59e0b; padding-left: 5px; }
    .footer-link-sm { color: #64748b; text-decoration: none; font-size: 0.9rem; transition: 0.3s; }
    .footer-link-sm:hover { color: white; }
    .contact-item { display: flex; gap: 15px; margin-bottom: 20px; color: #cbd5e1; font-size: 0.95rem; }
    .contact-item i { color: #f59e0b; margin-top: 3px; }

    /* SIDEBAR STYLES */
    #drawer-backdrop { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 9999990; opacity: 0; visibility: hidden; transition: 0.3s ease; backdrop-filter: blur(3px); }
    #drawer-backdrop.active { opacity: 1; visibility: visible; }

    #mobile-drawer { position: fixed; top: 0; right: 0; width: 85%; max-width: 320px; height: 100vh; background: #ffffff; z-index: 9999999; transform: translateX(100%); transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1); display: flex; flex-direction: column; box-shadow: -10px 0 40px rgba(0,0,0,0.1); }
    #mobile-drawer.active { transform: translateX(0); }

    .drawer-header { padding: 20px 25px; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #f1f5f9; background: #fff; }
    .drawer-logo { font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.3rem; color: #0f172a; text-decoration: none; }
    .drawer-close { background: #f8fafc; border: none; color: #64748b; width: 35px; height: 35px; border-radius: 50%; font-size: 1.1rem; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: 0.2s; }
    .drawer-close:hover { background: #fee2e2; color: #ef4444; }

    .drawer-body { flex: 1; padding: 10px 20px; overflow-y: auto; }
    .drawer-links { list-style: none; padding: 0; margin: 0; }
    
    /* Main Link Styles */
    .drawer-link-item { border-bottom: 1px solid #f1f5f9; }
    .drawer-a { display: flex; align-items: center; justify-content: space-between; padding: 15px 5px; color: #334155; font-size: 1rem; font-weight: 600; text-decoration: none; transition: 0.2s; cursor: pointer; }
    .drawer-a i.icon-left { color: #f59e0b; width: 25px; text-align: center; margin-right: 10px; font-size: 0.9rem; }
    .drawer-a i.icon-arrow { color: #cbd5e1; font-size: 0.8rem; transition: 0.3s; }
    .drawer-a:hover { color: #f59e0b; }

    /* Submenu Styling */
    .drawer-submenu { max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background: #f8fafc; border-radius: 8px; margin: 0 5px; }
    .drawer-submenu a { display: block; padding: 12px 15px 12px 45px; color: #64748b; font-size: 0.95rem; text-decoration: none; border-bottom: 1px dashed #e2e8f0; }
    .drawer-submenu a:last-child { border-bottom: none; }
    .drawer-submenu a:hover { color: #0f172a; background: #f1f5f9; padding-left: 50px; transition: 0.2s; }

    /* Open State for Submenu */
    .drawer-link-item.open .drawer-submenu { max-height: 300px; margin-bottom: 10px; }
    .drawer-link-item.open .icon-arrow { transform: rotate(180deg); color: #f59e0b; }

    .drawer-footer { padding: 25px; background: #fffbeb; border-top: 1px solid #fef3c7; }
    .drawer-btn { display: block; background: #f59e0b; color: white; text-align: center; padding: 14px; border-radius: 8px; font-weight: 700; text-decoration: none; box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3); margin-bottom: 20px; transition: 0.2s; }
    .drawer-btn:active { transform: scale(0.98); }
    .drawer-socials { display: flex; justify-content: center; gap: 25px; }
    .drawer-socials a { color: #d97706; font-size: 1.3rem; transition: 0.3s; }
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
            
            <li class="drawer-link-item">
                <a href="index.php" class="drawer-a">
                    <span><i class="fa-solid fa-house icon-left"></i> Home</span>
                </a>
            </li>

            <li class="drawer-link-item">
                <div class="drawer-a" onclick="toggleSubmenu(this)">
                    <span><i class="fa-solid fa-users icon-left"></i> Who We Are</span>
                    <i class="fa-solid fa-chevron-down icon-arrow"></i>
                </div>
                <div class="drawer-submenu">
                    <a href="about.php">Our Story</a>
                    <a href="team.php">Leadership Team</a>
                    <a href="mission.php">Mission & Vision</a>
                </div>
            </li>

            <li class="drawer-link-item">
                <div class="drawer-a" onclick="toggleSubmenu(this)">
                    <span><i class="fa-solid fa-briefcase icon-left"></i> Our Work</span>
                    <i class="fa-solid fa-chevron-down icon-arrow"></i>
                </div>
                <div class="drawer-submenu">
                    <a href="leadership.php">Leadership</a>
                    <a href="skills.php">Skills</a>
                    <a href="coaching.php">Coaching</a>
                    <a href="values.php">Values</a>
                </div>
            </li>

            <li class="drawer-link-item">
                <a href="blog.php" class="drawer-a">
                    <span><i class="fa-solid fa-newspaper icon-left"></i> Blog</span>
                </a>
            </li>

            <li class="drawer-link-item">
                <a href="contact.php" class="drawer-a">
                    <span><i class="fa-solid fa-envelope icon-left"></i> Contact</span>
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
    // Toggle Entire Drawer
    function toggleDrawer(show) {
        const drawer = document.getElementById('mobile-drawer');
        const backdrop = document.getElementById('drawer-backdrop');
        
        if(show) {
            drawer.classList.add('active');
            backdrop.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent scrolling bg
        } else {
            drawer.classList.remove('active');
            backdrop.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    // Toggle Submenus (Accordion)
    function toggleSubmenu(element) {
        const parentItem = element.parentElement;
        parentItem.classList.toggle('open');
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

<script src="assets/js/main.js"></script>
</body>
</html>