<?php include 'includes/header.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<style>
    :root {
        --primary-dark: #0f172a;
        --accent-gold: #f59e0b;
        --accent-teal: #0d9488;
        --text-grey: #64748b;
        --bg-soft: #f0fdfa; /* Teal Tint */
    }

    /* 1. HERO SECTION */
    .coaching-hero {
        position: relative;
        height: 65vh;
        min-height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        /* Updated image to reflect mentorship/guidance */
        background: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.9)), 
                    url('https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=2000');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    .hero-quote-box {
        border-left: 4px solid var(--accent-gold);
        padding-left: 20px;
        display: inline-block;
        text-align: left;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(5px);
        padding: 20px;
        border-radius: 0 12px 12px 0;
        max-width: 700px;
        margin-bottom: 30px;
    }

    .hero-quote-text {
        font-family: 'Outfit', sans-serif;
        font-size: 1.4rem;
        font-weight: 300;
        font-style: italic;
        line-height: 1.6;
        color: #f8fafc;
    }

    .hero-quote-author {
        display: block;
        margin-top: 15px;
        color: var(--accent-gold);
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    /* 2. THE PHILOSOPHY (Split Layout) */
    .philosophy-section {
        padding: 100px 0;
        background: white;
    }

    .text-highlight {
        color: var(--primary-dark);
        font-weight: 700;
        font-size: 1.2rem;
        margin-bottom: 20px;
        display: block;
    }

    /* 3. TRANSFORMATION GRID */
    .transform-section {
        padding: 100px 0;
        background: var(--bg-soft);
        position: relative;
    }

    .process-card {
        background: white;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 10px 30px -5px rgba(0,0,0,0.05);
        transition: 0.3s;
        height: 100%;
        border-top: 4px solid transparent;
    }

    .process-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px -10px rgba(0,0,0,0.1);
        border-top-color: var(--accent-teal);
    }

    .process-number {
        font-size: 4rem;
        font-weight: 900;
        color: #e0f2fe; /* Very light blue */
        line-height: 1;
        margin-bottom: -20px;
        position: relative;
        z-index: 0;
    }

    .process-content {
        position: relative;
        z-index: 1;
    }

    .process-title {
        font-family: 'Outfit', sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-dark);
        margin-bottom: 15px;
    }

    /* 4. RESTORATION STORY (Image Side-by-Side) */
    .restore-section {
        padding: 100px 0;
        background: white;
    }

    .restore-img-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    
    .restore-img-grid img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 12px;
        transition: 0.5s;
    }
    
    /* Make one image lower for a collage effect */
    .restore-img-grid img:nth-child(2) {
        margin-top: 40px;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .hero-quote-text { font-size: 1.1rem; }
        .restore-img-grid { grid-template-columns: 1fr; }
        .restore-img-grid img:nth-child(2) { margin-top: 0; }
    }
</style>

<main>

    <section class="coaching-hero">
        <div class="content-container reveal-up">
            <div class="hero-quote-box">
                <span class="hero-quote-text">
                    "The two most important days in your life are the day you are born and the day you find out why."
                </span>
                <span class="hero-quote-author">— Mark Twain</span>
            </div>
            
            <div style="margin-top: 30px;">
                <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 10px; color: white;">Discover Your "Why"</h1>
                <p style="font-size: 1.1rem; color: #cbd5e1;">We guide you back to your original purpose.</p>
            </div>
        </div>
    </section>

    <section class="philosophy-section">
        <div class="content-container split-layout">
            
            <div class="text-column reveal-up">
                <span class="section-label" style="color: var(--accent-teal);">OUR PROMISE</span>
                <h2 style="font-size: 2.5rem; color: var(--primary-dark); margin-bottom: 25px;">Uncovering the Real You</h2>
                
                <span class="text-highlight">
                    SoW!SE AFRICA will proudly and inclusively Coach and Mentor all to discover that original person within them.
                </span>

                <p style="color: var(--text-grey); line-height: 1.8; margin-bottom: 20px;">
                    Life often buries our potential under layers of doubt, bad habits, and societal pressure. Our coaching isn't about changing who you are; it's about <strong>revealing</strong> who you were meant to be.
                </p>
                
                <p style="color: var(--text-grey); line-height: 1.8;">
                    We believe in second chances. Whether you are a student finding your path, or someone looking to rebuild after failure, our doors are open.
                </p>
            </div>

            <div class="image-column reveal-up">
                <img src="https://www.sowiseafrica.org/wp-content/uploads/2021/11/SoWse-Coaching.jpg" alt="Coaching Session" style="border-radius: 20px; width: 100%; box-shadow: 0 20px 50px rgba(0,0,0,0.15);">
                <div class="image-accent-box" style="border-color: var(--accent-teal);"></div>
            </div>

        </div>
    </section>

    <section class="transform-section">
        <div class="content-container">
            <div class="center-text reveal-up" style="margin-bottom: 60px;">
                <span class="section-label" style="color: var(--accent-teal);">THE JOURNEY</span>
                <h2 style="font-size: 2.5rem; color: var(--primary-dark);">Restoration is Possible</h2>
                <p style="color: var(--text-grey);">No matter the starting point, we believe in a better finish.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
                
                <div class="process-card reveal-up">
                    <div class="process-number">01</div>
                    <div class="process-content">
                        <h3 class="process-title">Identify</h3>
                        <p style="color: var(--text-grey); line-height: 1.6;">
                            We help you identify the root causes of stagnation. From drug addiction to lost passion, we face the reality honestly without judgment.
                        </p>
                    </div>
                </div>

                <div class="process-card reveal-up">
                    <div class="process-number">02</div>
                    <div class="process-content">
                        <h3 class="process-title">Reform</h3>
                        <p style="color: var(--text-grey); line-height: 1.6;">
                            "Even the drug addicts can reform." We provide practical tools, accountability, and mentorship to break negative cycles.
                        </p>
                    </div>
                </div>

                <div class="process-card reveal-up">
                    <div class="process-number">03</div>
                    <div class="process-content">
                        <h3 class="process-title">Restore</h3>
                        <p style="color: var(--text-grey); line-height: 1.6;">
                            "Failed family and business relationships can be restored." We focus on rebuilding trust and reconciling you with your community.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="restore-section">
        <div class="content-container split-layout reverse-desktop">
            
            <div class="image-column reveal-up">
                <div class="restore-img-grid">
                    <img src="https://www.sowiseafrica.org/wp-content/uploads/2021/11/Mentorship-1-420x300.png" alt="Mentorship Group">
                    <img src="https://www.sowiseafrica.org/wp-content/uploads/2021/11/Mentorship-420x300.png" alt="One on One Coaching">
                </div>
            </div>

            <div class="text-column reveal-up" style="padding-top: 40px;">
                <span class="section-label" style="color: var(--accent-gold);">INCLUSIVE GROWTH</span>
                <h2 style="font-size: 2.5rem; color: var(--primary-dark); margin-bottom: 25px;">For Everyone.</h2>
                
                <p style="font-size: 1.1rem; line-height: 1.8; color: var(--text-grey); margin-bottom: 20px;">
                    Our coaching is not reserved for the elite. It is for the broken, the searching, and the hopeful.
                </p>
                <p style="font-size: 1.1rem; line-height: 1.8; color: var(--text-grey); margin-bottom: 30px;">
                    We believe that when one person discovers their purpose ("Finds out why"), the ripple effect heals families, businesses, and eventually, the nation.
                </p>

                <a href="contact.php" class="btn-primary">Book a Session</a>
            </div>

        </div>
    </section>

</main>

<?php include 'includes/footer.php'; ?>