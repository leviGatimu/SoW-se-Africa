<?php include 'includes/header.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<main>

    <section class="page-hero empowerment-hero">
        <div class="hero-overlay"></div>
        <div class="container hero-container">
            <span class="pill-label fade-in">YOUTH EMPOWERMENT</span>
            <h1 class="fade-in">Unleashing <span class="text-gradient">Potential.</span></h1>
            <p class="fade-in">We don't just give handouts; we provide the mindset, tools, and opportunities for young Africans to build their own future through practical life skills.</p>
        </div>
    </section>

    <section class="section-padding">
        <div class="container split-layout">
            <div class="empower-content reveal-up">
                <span class="section-tag">OUR APPROACH</span>
                <h2>From Dependency to Independence.</h2>
                <p class="lead-text">
                    Empowerment is not an event; it is a process. At So W!se Africa, we move youth from a mindset of "waiting for aid" to "creating value."
                </p>
                <p>
                    We target young people aged 15-30, providing them with a safe space to discover their talents. Our goal is to help them monetize their abilities—whether in business, agriculture, or the arts—and become self-reliant contributors to the economy.
                </p>
                
                <div class="stat-row">
                    <div class="stat-mini">
                        <strong>85%</strong>
                        <span>Self-Reliance Rate</span>
                    </div>
                    <div class="stat-mini">
                        <strong>40+</strong>
                        <span>Businesses Started</span>
                    </div>
                </div>
            </div>
            <div class="empower-image reveal-up">
                <img src="https://images.unsplash.com/photo-1531545514256-b1400bc00f31?q=80&w=1000&auto=format&fit=crop" class="rounded-img" alt="Youth Workshop">
                <div class="floating-card">
                    <i class="fa-solid fa-users-gear"></i>
                    <span>Capacity Building</span>
                </div>
            </div>
        </div>
    </section>

    <section class="toolkit-section section-padding bg-light">
        <div class="container">
            <div class="section-header center-text reveal-up">
                <span class="section-tag">HOW WE DO IT</span>
                <h2>The Empowerment Toolkit</h2>
                <p>Our practical approach to building a complete leader.</p>
            </div>

            <div class="toolkit-grid">
                <div class="tool-card reveal-up">
                    <div class="tool-icon"><i class="fa-solid fa-briefcase"></i></div>
                    <h3>Entrepreneurship</h3>
                    <p>Teaching youth how to identify market gaps, create business plans, and launch sustainable ventures to generate wealth.</p>
                </div>

                <div class="tool-card reveal-up">
                    <div class="tool-icon"><i class="fa-solid fa-money-bill-trend-up"></i></div>
                    <h3>Financial Literacy</h3>
                    <p>Understanding the fundamentals of saving, investing, and managing resources to break the cycle of poverty.</p>
                </div>

                <div class="tool-card reveal-up">
                    <div class="tool-icon"><i class="fa-solid fa-hand-holding-hand"></i></div>
                    <h3>Mentorship</h3>
                    <p>Connecting youth with established industry professionals for guidance, networking, and career advice.</p>
                </div>

                <div class="tool-card reveal-up">
                    <div class="tool-icon"><i class="fa-solid fa-gavel"></i></div>
                    <h3>Civic Responsibility</h3>
                    <p>Empowering youth to understand their rights and responsibilities, fostering a generation of ethical voters and leaders.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="tech-hub-section section-padding">
        <div class="container">
            <div class="tech-layout">
                <div class="tech-text reveal-up">
                    <span class="pill-label">OUR FACILITY</span>
                    <h2>The Resource Center</h2>
                    <p>A dedicated space for young minds to learn, collaborate, and grow their ventures.</p>
                    <ul class="tech-list">
                        <li><i class="fa-solid fa-book-open"></i> Business Library & Guides</li>
                        <li><i class="fa-solid fa-chalkboard-user"></i> Training Workshops</li>
                        <li><i class="fa-solid fa-people-group"></i> Co-working Space</li>
                    </ul>
                    <a href="contact.php" class="btn-primary">Visit Us</a>
                </div>
                <div class="tech-visual reveal-up">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1000&auto=format&fit=crop" alt="Resource Center">
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="reveal-up">
            <h2>Spark a Change</h2>
            <p>Sponsor a student's education or join as a mentor.</p>
            <div class="btn-group">
                <a href="donate.php" class="btn-white">Sponsor a Youth</a>
                <a href="contact.php" class="btn-outline">Become a Mentor</a>
            </div>
        </div>
    </section>

</main>

<script>
    gsap.registerPlugin(ScrollTrigger);
    
    gsap.from(".fade-in", { y: 30, opacity: 0, duration: 1, stagger: 0.2 });

    document.querySelectorAll(".reveal-up").forEach((el) => {
        ScrollTrigger.create({
            trigger: el,
            start: "top 85%",
            onEnter: () => el.classList.add("active")
        });
    });
</script>

<?php include 'includes/footer.php'; ?>