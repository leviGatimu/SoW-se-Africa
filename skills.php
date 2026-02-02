<?php include 'includes/header.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<style>
    :root {
        --primary-dark: #0f172a;
        --accent-orange: #f59e0b;
        --text-grey: #64748b;
        --bg-light: #f8fafc;
    }

    /* 1. HERO SECTION */
    .skills-hero {
        background: linear-gradient(rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.85)), 
                    url('https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=2000');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        height: 60vh;
        min-height: 450px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
    }

    .hero-badge-pill {
        background: rgba(245, 158, 11, 0.15);
        color: var(--accent-orange);
        border: 1px solid var(--accent-orange);
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 2px;
        display: inline-block;
        margin-bottom: 20px;
        backdrop-filter: blur(5px);
    }

    /* 2. PHILOSOPHY SECTION */
    .philosophy-section {
        padding: 100px 0;
        background: white;
    }
    
    .quote-modern {
        font-family: 'Outfit', sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-dark);
        line-height: 1.4;
        border-left: 5px solid var(--accent-orange);
        padding-left: 30px;
        margin: 30px 0;
    }

    /* 3. SKILLS GRID */
    .skills-section {
        padding: 100px 0;
        background: var(--bg-light);
    }

    .skill-card-modern {
        background: white;
        padding: 40px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .skill-card-modern::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 4px; height: 0;
        background: var(--accent-orange);
        transition: height 0.3s ease;
    }

    .skill-card-modern:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.1);
        border-color: transparent;
    }

    .skill-card-modern:hover::before {
        height: 100%;
    }

    .skill-icon-box {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        margin-bottom: 25px;
        transition: 0.3s;
    }

    /* Icon Colors */
    .icon-orange { background: #fffbeb; color: #f59e0b; }
    .icon-blue { background: #eff6ff; color: #2563eb; }
    .icon-green { background: #f0fdf4; color: #16a34a; }
    .icon-purple { background: #faf5ff; color: #9333ea; }
    .icon-red { background: #fff1f2; color: #e11d48; }
    .icon-cyan { background: #ecfeff; color: #0891b2; }

    .skill-card-modern h3 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--primary-dark);
        margin-bottom: 12px;
    }

    .skill-card-modern p {
        color: var(--text-grey);
        font-size: 0.95rem;
        line-height: 1.6;
        flex-grow: 1; /* Pushes content to fill height */
    }

    /* 4. AUDIENCE SECTION */
    .audience-section {
        background: var(--primary-dark);
        color: white;
        padding: 100px 0;
        position: relative;
        overflow: hidden;
    }

    .audience-bg-pattern {
        position: absolute;
        top: 0; right: 0; width: 50%; height: 100%;
        background-image: radial-gradient(rgba(255,255,255,0.1) 1px, transparent 1px);
        background-size: 30px 30px;
        opacity: 0.3;
    }

    .audience-btn {
        background: var(--accent-orange);
        color: white;
        padding: 15px 35px;
        border-radius: 8px;
        font-weight: 700;
        text-decoration: none;
        display: inline-block;
        margin-top: 30px;
        transition: 0.3s;
        border: 2px solid var(--accent-orange);
    }

    .audience-btn:hover {
        background: transparent;
        color: var(--accent-orange);
    }
</style>

<main>

    <section class="skills-hero">
        <div class="content-container reveal-up">
            <span class="hero-badge-pill">Practical Life Learning</span>
            <h1 style="font-size: 3.5rem; font-weight: 800; line-height: 1.1; margin-bottom: 20px; color:white;">
                Skills That <br><span style="color: var(--accent-orange);">Liberate the Mind.</span>
            </h1>
            <p style="font-size: 1.2rem; color: #cbd5e1; max-width: 650px; margin: 0 auto;">
                True freedom is not given; it is unlocked from the inside. We develop the whole person—mind, body, and spirit.
            </p>
        </div>
    </section>

    <section class="philosophy-section">
        <div class="content-container split-layout">
            
            <div class="text-column reveal-up">
                <span class="section-label" style="color: var(--accent-orange);">THE CORE BELIEF</span>
                <h2 style="font-size: 2.5rem; color: var(--primary-dark); margin-bottom: 25px;">From the Inside Out</h2>
                
                <p style="color: var(--text-grey); line-height: 1.8; font-size: 1.05rem;">
                    So W!SE AFRICA is about practical, value-adding solutions. We believe that skills that liberate the mind and the world at large are <strong>developed from within that mind</strong>.
                </p>
                
                <div class="quote-modern">
                    "This is our definition of Practical Life Learning. It begins within the individual to bring out their original, God-given talent."
                </div>

                <p style="color: var(--text-grey); line-height: 1.8;">
                    It is not just about memorizing facts; it is about an all-inclusive transformation that shifts a young person from a "copycat" mindset to one of original innovation.
                </p>
            </div>

            <div class="image-column reveal-up">
                <div style="position: relative;">
                    <div style="position: absolute; top: 20px; right: -20px; width: 100%; height: 100%; border: 3px solid var(--accent-orange); border-radius: 20px; z-index: 0;"></div>
                    <img src="https://www.sowiseafrica.org/wp-content/uploads/2021/11/Untitled-1-420x300.png" alt="Training Session" style="width: 100%; border-radius: 20px; position: relative; z-index: 1; box-shadow: 0 20px 50px rgba(0,0,0,0.15);">
                </div>
            </div>

        </div>
    </section>

    <section class="skills-section">
        <div class="content-container">
            <div class="center-text reveal-up" style="max-width: 800px; margin: 0 auto 60px auto;">
                <span class="section-label" style="color: var(--accent-orange);">OUR TRAINING MODULES</span>
                <h2 style="font-size: 2.5rem; color: var(--primary-dark);">Holistic Development</h2>
                <p style="color: var(--text-grey); font-size: 1.1rem;">We target the whole person to create agents of change who are effective, efficient, and inclusive.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px;">
                
                <div class="skill-card-modern reveal-up">
                    <div class="skill-icon-box icon-orange"><i class="fa-solid fa-brain"></i></div>
                    <h3>Mindset Transformation</h3>
                    <p>Shifting from a "copycat" mentality to original thinking. We unlock the fresh, unpolluted potential of the mind to embrace innovation.</p>
                </div>

                <div class="skill-card-modern reveal-up">
                    <div class="skill-icon-box icon-blue"><i class="fa-solid fa-scale-balanced"></i></div>
                    <h3>Values-Based Leadership</h3>
                    <p>Leadership that stands the test of time. We teach ethics, integrity, and the responsibility of leading by example in a complex world.</p>
                </div>

                <div class="skill-card-modern reveal-up">
                    <div class="skill-icon-box icon-green"><i class="fa-solid fa-hands-holding-circle"></i></div>
                    <h3>Inclusivity & Harmony</h3>
                    <p>A healthy dose of inclusivity. We train youth to be fitting members of society who build bridges, foster reconciliation, and promote unity.</p>
                </div>

                <div class="skill-card-modern reveal-up">
                    <div class="skill-icon-box icon-purple"><i class="fa-solid fa-rocket"></i></div>
                    <h3>Entrepreneurship</h3>
                    <p>Moving from job-seeking to job-creating. We equip fresh graduates with the practical tools to turn ideas into wealth-creating ventures.</p>
                </div>

                <div class="skill-card-modern reveal-up">
                    <div class="skill-icon-box icon-red"><i class="fa-solid fa-user-group"></i></div>
                    <h3>Coaching & Mentorship</h3>
                    <p>Guidance for the journey. We pair emerging leaders with experienced mentors to navigate the challenges of professional and personal growth.</p>
                </div>

                <div class="skill-card-modern reveal-up">
                    <div class="skill-icon-box icon-cyan"><i class="fa-solid fa-laptop-code"></i></div>
                    <h3>Modern Adaptation</h3>
                    <p>Embracing latest trends. We ensure our youth are excited about technology and development, making them relevant in the modern marketplace.</p>
                </div>

            </div>
        </div>
    </section>

    <section class="audience-section">
        <div class="audience-bg-pattern"></div>
        <div class="content-container split-layout reverse-desktop">
            
            <div class="image-column reveal-up" style="position: relative; z-index: 2;">
                <img src="https://www.sowiseafrica.org/wp-content/uploads/2021/10/IMG-20211022-WA0004-420x300.jpg" alt="Youth Group" style="border-radius: 20px; width: 100%; border: 4px solid rgba(255,255,255,0.1);">
            </div>

            <div class="text-column reveal-up" style="position: relative; z-index: 2;">
                <span class="section-label" style="color: var(--accent-orange);">OUR TARGET AUDIENCE</span>
                <h2 style="color: white; font-size: 2.5rem;">Why Fresh Graduates?</h2>
                <p style="color: #94a3b8; font-size: 1.1rem; line-height: 1.7; margin-bottom: 20px;">
                    So W!SE AFRICA mainly targets pupils, youth, and in particular, <strong>fresh graduates</strong>.
                </p>
                <p style="color: #94a3b8; font-size: 1.1rem; line-height: 1.7;">
                    Why? Because they possess flexible, fresh, and unpolluted minds. They are the best true agents of change. By instilling values in them now, we shape the future of the entire society.
                </p>
                <a href="contact.php" class="audience-btn">Enroll in Training</a>
            </div>

        </div>
    </section>

</main>

<?php include 'includes/footer.php'; ?>