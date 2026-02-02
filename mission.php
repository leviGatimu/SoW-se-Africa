<?php include 'includes/header.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<style>
    :root {
        --primary-dark: #0f172a;
        --accent-orange: #f59e0b;
        --accent-light: #fffbeb;
        --text-grey: #64748b;
        --bg-light: #f8fafc;
    }

    /* 1. HERO SECTION */
    .mission-hero {
        position: relative;
        height: 60vh;
        min-height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        background: linear-gradient(rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.9)), 
                    url('https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=2000');
        background-size: cover;
        background-position: center;
        background-attachment: fixed; /* Parallax effect */
    }
    
    .mission-hero h1 {
        font-family: 'Outfit', sans-serif;
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 15px;
        line-height: 1.1;
    }

    .mission-hero p {
        font-size: 1.25rem;
        color: #cbd5e1;
        max-width: 700px;
        margin: 0 auto;
        font-weight: 300;
    }

    .hero-tag {
        display: inline-block;
        background: rgba(245, 158, 11, 0.2);
        color: var(--accent-orange);
        padding: 8px 16px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.85rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 20px;
        backdrop-filter: blur(5px);
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    /* 2. CONTENT SECTIONS (Vision & Mission) */
    .split-section {
        padding: 100px 0;
        position: relative;
    }

    .split-wrapper {
        display: flex;
        align-items: center;
        gap: 60px;
    }

    .split-content {
        flex: 1;
    }

    .split-image {
        flex: 1;
        position: relative;
    }

    .split-image img {
        width: 100%;
        border-radius: 20px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        transition: transform 0.5s ease;
    }

    .split-image:hover img {
        transform: scale(1.02);
    }

    /* Decorative Elements behind images */
    .blob-bg {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 20px;
        left: 20px;
        border-radius: 20px;
        z-index: -1;
    }
    .blob-blue { background: #e0f2fe; }
    .blob-orange { background: #fef3c7; }

    /* Typography for sections */
    .section-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 25px;
    }

    .bg-icon-blue { background: #e0f2fe; color: #0284c7; }
    .bg-icon-orange { background: #fef3c7; color: #d97706; }

    .quote-box {
        border-left: 5px solid;
        padding-left: 25px;
        margin: 25px 0;
        font-family: 'Outfit', sans-serif;
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--primary-dark);
        line-height: 1.4;
    }
    .quote-blue { border-color: #0284c7; }
    .quote-orange { border-color: #f59e0b; }

    /* 3. STRATEGIC CARDS */
    .strategy-section {
        background: white;
        padding: 100px 0;
        text-align: center;
    }

    .strategy-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        margin-top: 50px;
    }

    .strategy-card {
        background: white;
        padding: 40px 30px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }

    .strategy-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px -5px rgba(0, 0, 0, 0.1);
        border-color: var(--accent-orange);
    }

    .card-icon {
        font-size: 2.5rem;
        color: var(--accent-orange);
        margin-bottom: 20px;
        transition: transform 0.4s ease;
    }

    .strategy-card:hover .card-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .strategy-card h3 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: var(--primary-dark);
    }

    .strategy-card p {
        color: var(--text-grey);
        font-size: 0.95rem;
        line-height: 1.6;
    }

    /* Responsive Tweaks */
    @media (max-width: 992px) {
        .mission-hero h1 { font-size: 2.5rem; }
        .split-wrapper { flex-direction: column; gap: 40px; }
        .reverse-mobile { flex-direction: column-reverse; }
        .split-image { width: 100%; }
        .blob-bg { display: none; } /* Simplify on mobile */
    }
</style>

<main>

    <section class="mission-hero">
        <div class="content-container" style="margin-top: 60px;">
            <span class="hero-tag fade-in">About SoW!SE Africa</span>
            <h1 class="fade-in">Purpose Driven. <br><span style="color: var(--accent-orange);">Future Focused.</span></h1>
            <p class="fade-in">We are more than an organization; we are a movement dedicated to restoring identity, fostering integrity, and building wealth for the next generation.</p>
        </div>
    </section>

    <section class="split-section">
        <div class="content-container split-wrapper">
            
            <div class="split-content reveal-up">
                <div class="section-icon bg-icon-blue">
                    <i class="fa-solid fa-eye"></i>
                </div>
                <span style="color: #0284c7; font-weight: 700; letter-spacing: 1px; font-size: 0.9rem;">OUR VISION</span>
                <h2 style="font-size: 2.5rem; font-weight: 800; color: var(--primary-dark); margin: 10px 0;">A Transformed Society</h2>
                
                <div class="quote-box quote-blue">
                    "A transformed, healthy, wealthy and inclusive society that embraces values."
                </div>

                <p style="color: var(--text-grey); line-height: 1.7; font-size: 1.05rem;">
                    We envision an Africa where integrity is the norm, not the exception. By fostering a culture of inclusivity and health, we aim to build a society that thrives on shared prosperity. It starts with the mind, flows through the heart, and results in action.
                </p>
            </div>

            <div class="split-image reveal-up">
                <div class="blob-bg blob-blue"></div>
                <img src="https://images.unsplash.com/photo-1531206715517-5c0ba140840f?q=80&w=800&auto=format&fit=crop" alt="Vision of Future Africa">
            </div>

        </div>
    </section>

    <section class="split-section" style="background-color: #f8fafc;">
        <div class="content-container split-wrapper reverse-mobile">
            
            <div class="split-image reveal-up">
                <div class="blob-bg blob-orange"></div>
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=800&auto=format&fit=crop" alt="Mission in Action">
            </div>

            <div class="split-content reveal-up">
                <div class="section-icon bg-icon-orange">
                    <i class="fa-solid fa-rocket"></i>
                </div>
                <span style="color: #d97706; font-weight: 700; letter-spacing: 1px; font-size: 0.9rem;">OUR MISSION</span>
                <h2 style="font-size: 2.5rem; font-weight: 800; color: var(--primary-dark); margin: 10px 0;">Empower & Equip</h2>
                
                <div class="quote-box quote-orange">
                    "Educate, human capital development on governance and entrepreneurship through facilitation, internships and mentorship programs."
                </div>

                <p style="color: var(--text-grey); line-height: 1.7; font-size: 1.05rem;">
                    We are action-oriented. We don't just talk about change; we facilitate it. Through practical mentorship and hands-on training, we bridge the gap between academic theory and the real-world skills needed to lead and create wealth in a modern African economy.
                </p>
            </div>

        </div>
    </section>

    <section class="strategy-section">
        <div class="content-container">
            
            <div class="reveal-up" style="max-width: 600px; margin: 0 auto;">
                <span style="color: var(--accent-orange); font-weight: 700; letter-spacing: 1px;">WHAT WE FOCUS ON</span>
                <h2 style="font-size: 2.5rem; color: var(--primary-dark); font-weight: 800; margin-top: 10px;">Our Strategic Pillars</h2>
                <p style="color: var(--text-grey);">We build our programs around four key pillars designed to create holistic leaders.</p>
            </div>

            <div class="strategy-grid">
                
                <div class="strategy-card reveal-up">
                    <div class="card-icon"><i class="fa-solid fa-scale-balanced"></i></div>
                    <h3>Governance</h3>
                    <p>Instilling ethical leadership, accountability, and integrity in decision-making processes for public and private sectors.</p>
                </div>

                <div class="strategy-card reveal-up">
                    <div class="card-icon"><i class="fa-solid fa-briefcase"></i></div>
                    <h3>Entrepreneurship</h3>
                    <p>Moving from job-seeking to job-creating. Empowering youth with the skills to turn innovative ideas into wealth.</p>
                </div>

                <div class="strategy-card reveal-up">
                    <div class="card-icon"><i class="fa-solid fa-heart-pulse"></i></div>
                    <h3>Healthy Living</h3>
                    <p>Promoting mental, physical, and spiritual well-being as the foundation for sustainable personal success.</p>
                </div>

                <div class="strategy-card reveal-up">
                    <div class="card-icon"><i class="fa-solid fa-users-viewfinder"></i></div>
                    <h3>Inclusivity</h3>
                    <p>Creating spaces where every voice is heard, bridging social gaps, and fostering reconciliation and unity.</p>
                </div>

            </div>
        </div>
    </section>

</main>

<?php include 'includes/footer.php'; ?>