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
    .leadership-hero {
        position: relative;
        height: 60vh;
        min-height: 450px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        background: linear-gradient(rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.8)), 
                    url('https://images.unsplash.com/photo-1544531586-fde5298cdd40?q=80&w=2000');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
    
    .leadership-hero h1 {
        font-family: 'Outfit', sans-serif;
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 20px;
        line-height: 1.1;
    }

    .hero-badge-lg {
        background: var(--accent-orange);
        color: white;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 0.9rem;
        display: inline-block;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
    }

    /* 2. THE REALITY SECTION (Text Block) */
    .reality-section {
        padding: 80px 0;
        background: white;
    }
    .reality-box {
        max-width: 900px;
        margin: 0 auto;
        text-align: center;
    }
    .reality-text {
        font-size: 1.15rem;
        line-height: 1.8;
        color: var(--text-grey);
        margin-bottom: 30px;
    }
    .highlight-text {
        color: var(--primary-dark);
        font-weight: 700;
    }

    /* 3. DUALITY CARDS (Hindsight vs Foresight) */
    .duality-section {
        padding: 60px 0 100px 0;
        background: var(--bg-light);
    }
    
    .duality-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        max-width: 1100px;
        margin: 0 auto;
    }

    .duality-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 40px -10px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        position: relative;
    }
    
    .duality-card:hover {
        transform: translateY(-10px);
    }

    .duality-header {
        padding: 40px 40px 20px 40px;
    }
    
    .duality-icon {
        width: 70px;
        height: 70px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin-bottom: 25px;
    }
    .icon-hindsight { background: #e0f2fe; color: #0284c7; }
    .icon-foresight { background: #fffbeb; color: #d97706; }

    .duality-card h3 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--primary-dark);
        margin-bottom: 15px;
    }

    .duality-body {
        padding: 0 40px 40px 40px;
    }
    
    .duality-body p {
        color: var(--text-grey);
        font-size: 1.05rem;
        line-height: 1.6;
    }

    /* 4. GOALS GRID */
    .goals-section {
        padding: 100px 0;
        background: var(--primary-dark);
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    /* Background decoration */
    .goals-bg-pattern {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        opacity: 0.05;
        background-image: radial-gradient(#ffffff 1px, transparent 1px);
        background-size: 30px 30px;
    }

    .goals-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        position: relative;
        z-index: 2;
        margin-top: 50px;
    }

    .goal-item {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 25px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 20px;
        transition: 0.3s;
    }

    .goal-item:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateX(10px);
        border-color: var(--accent-orange);
    }

    .goal-check {
        color: var(--accent-orange);
        font-size: 1.2rem;
        background: rgba(245, 158, 11, 0.1);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .goal-text {
        font-size: 1.2rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .leadership-hero h1 { font-size: 2.5rem; }
        .duality-grid { grid-template-columns: 1fr; }
        .reality-text { font-size: 1rem; }
    }
</style>

<main>

    <section class="leadership-hero">
        <div class="content-container">
            <span class="hero-badge-lg fade-in">Core Philosophy</span>
            <h1 class="fade-in" style="color: white;">Review the Past. <br><span style="color: var(--accent-orange);">Innovate the Future.</span></h1>
            <p class="fade-in" style="font-size: 1.2rem; color: #cbd5e1; max-width: 700px; margin: 0 auto;">
                Self-examination from the inside out is practically the best teacher.
            </p>
        </div>
    </section>

    <section class="reality-section">
        <div class="content-container reality-box reveal-up">
            <h2 style="font-family: 'Outfit', sans-serif; font-size: 2.5rem; color: var(--primary-dark); font-weight: 800; margin-bottom: 30px;">The State of Our World</h2>
            
            <p class="reality-text">
                Nobody is born hating. Nobody is born a terrorist, a fraudster, a drug addict, or a racist... But why are these still a cause of anxiety and strife even today? We need to develop a state of dissatisfaction with the status quo. 
            </p>
            <p class="reality-text">
                What is the role of education? What is the role of the society? What is the role of parenting? What is the media doing about it?
            </p>
            
            <div style="background: #fffbeb; padding: 30px; border-radius: 12px; border-left: 5px solid #f59e0b; margin-top: 40px; text-align: left;">
                <p style="margin: 0; color: #78350f; font-weight: 500; font-size: 1.1rem; font-style: italic;">
                    "If leadership is foresight, then we do not have to wait until we are all locked out by a virus or our businesses razed down by Xenophobia, floods, wild forest fires, typhoons, or hackers. Why wait until it hurts to do anything?"
                </p>
            </div>
        </div>
    </section>

    <section class="duality-section">
        <div class="content-container">
            <div style="text-align: center; margin-bottom: 50px;" class="reveal-up">
                <span style="color: var(--accent-orange); font-weight: 700; letter-spacing: 1px;">THE DUAL APPROACH</span>
                <h2 style="font-size: 2.5rem; color: var(--primary-dark); font-weight: 800;">Leadership is...</h2>
            </div>

            <div class="duality-grid">
                
                <div class="duality-card reveal-up">
                    <div class="duality-header">
                        <div class="duality-icon icon-hindsight">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </div>
                        <h3>Hindsight</h3>
                    </div>
                    <div class="duality-body">
                        <p>Leadership hindsight reviews the past to learn at best from the experience of others or even personally through self-evaluation.</p>
                        <p style="margin-top: 15px;"><strong>Self-examination from the inside out is practically the best teacher.</strong></p>
                    </div>
                </div>

                <div class="duality-card reveal-up">
                    <div class="duality-header">
                        <div class="duality-icon icon-foresight">
                            <i class="fa-solid fa-binoculars"></i>
                        </div>
                        <h3>Foresight</h3>
                    </div>
                    <div class="duality-body">
                        <p>Leadership foresight takes action and implements appropriate measures and declares <strong>NEVER AGAIN!</strong></p>
                        <p style="margin-top: 15px;">It is the ability to look to the future to innovate and prepare before the crisis hits.</p>
                    </div>
                </div>

            </div>

            <div style="text-align: center; margin-top: 60px; max-width: 800px; margin-left: auto; margin-right: auto;" class="reveal-up">
                <p style="font-size: 1.2rem; color: var(--text-grey);">
                    SoW!SE AFRICA think tank provides some insight that confirms that we all qualify to be better human beings. <br><strong style="color: var(--primary-dark);">The hour has come!</strong>
                </p>
            </div>
        </div>
    </section>

    <section class="goals-section">
        <div class="goals-bg-pattern"></div>
        <div class="content-container">
            <div class="reveal-up">
                <span style="color: var(--accent-orange); font-weight: 700; letter-spacing: 1px;">OUR OUTCOMES</span>
                <h2 style="font-size: 2.5rem; color: white; font-weight: 800;">Our Main Goals</h2>
            </div>

            <div class="goals-grid">
                
                <div class="goal-item reveal-up">
                    <div class="goal-check"><i class="fa-solid fa-check"></i></div>
                    <div class="goal-text">Youth Leadership</div>
                </div>

                <div class="goal-item reveal-up">
                    <div class="goal-check"><i class="fa-solid fa-check"></i></div>
                    <div class="goal-text">Influence</div>
                </div>

                <div class="goal-item reveal-up">
                    <div class="goal-check"><i class="fa-solid fa-check"></i></div>
                    <div class="goal-text">Direction</div>
                </div>

                <div class="goal-item reveal-up">
                    <div class="goal-check"><i class="fa-solid fa-check"></i></div>
                    <div class="goal-text">Governance</div>
                </div>

                <div class="goal-item reveal-up">
                    <div class="goal-check"><i class="fa-solid fa-check"></i></div>
                    <div class="goal-text">Transparency</div>
                </div>

                <div class="goal-item reveal-up">
                    <div class="goal-check"><i class="fa-solid fa-check"></i></div>
                    <div class="goal-text">Management</div>
                </div>

            </div>
        </div>
    </section>

    <section class="cta-section" style="background: white;">
        <div class="content-container center-text reveal-up">
            <h2>Ready to Lead?</h2>
            <p>Join the movement that is redefining African leadership.</p>
            <div class="btn-group centered">
                <a href="contact.php" class="btn-primary">Enroll Now</a>
                <a href="donate.php" class="btn-outline-dark">Support Us</a>
            </div>
        </div>
    </section>

</main>

<?php include 'includes/footer.php'; ?>