<?php include 'includes/header.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<main>

    <section class="page-hero mission-hero">
        <div class="hero-overlay"></div>
        <div class="container hero-container">
            <span class="pill-label fade-in">OUR PURPOSE</span>
            <h1 class="fade-in">Guided by <span class="text-gradient">Values.</span></h1>
            <p class="fade-in">Our roadmap to creating a generation of ethical leaders and sustainable wealth creators in Africa.</p>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            <div class="mv-grid">
                <div class="mv-card reveal-up">
                    <span class="mv-label">OUR MISSION</span>
                    <h2>To Champion Values-Based Leadership</h2>
                    <p>We exist to empower youth through entrepreneurship and digital innovation, advocating for practical education that produces ethical leaders ready to create wealth.</p>
                    <div class="mv-icon"><i class="fa-solid fa-bullseye"></i></div>
                </div>

                <div class="mv-card dark reveal-up">
                    <span class="mv-label">OUR VISION</span>
                    <h2>A Synergized Generation</h2>
                    <p>We envision an Africa where the spiritual and physical worlds are harmonized, creating leaders who are balanced, healthy, and innovative problem solvers.</p>
                    <div class="mv-icon"><i class="fa-solid fa-eye"></i></div>
                </div>
            </div>
        </div>
    </section>

    <section class="values-section section-padding bg-light">
        <div class="container">
            <div class="section-header center-text reveal-up">
                <span class="section-tag">WHAT WE STAND FOR</span>
                <h2>Our Core Values</h2>
                <p>The principles that guide every decision we make.</p>
            </div>

            <div class="values-grid">
                <div class="value-item reveal-up">
                    <div class="v-icon-box"><i class="fa-solid fa-scale-balanced"></i></div>
                    <h3>Integrity</h3>
                    <p>We believe in doing the right thing, even when no one is watching. Ethical governance is the bedrock of our leadership training.</p>
                </div>

                <div class="value-item reveal-up">
                    <div class="v-icon-box"><i class="fa-solid fa-hand-holding-heart"></i></div>
                    <h3>Service</h3>
                    <p>True leadership is service. We teach our students that their skills should primarily be used to uplift their communities.</p>
                </div>

                <div class="value-item reveal-up">
                    <div class="v-icon-box"><i class="fa-solid fa-lightbulb"></i></div>
                    <h3>Innovation</h3>
                    <p>We embrace technology and creative thinking to solve age-old problems. We are not afraid to disrupt the status quo.</p>
                </div>

                <div class="value-item reveal-up">
                    <div class="v-icon-box"><i class="fa-solid fa-users"></i></div>
                    <h3>Inclusivity</h3>
                    <p>We advocate for the reconciliation of all people, believing that every youth deserves a chance regardless of their past.</p>
                </div>

                <div class="value-item reveal-up">
                    <div class="v-icon-box"><i class="fa-solid fa-leaf"></i></div>
                    <h3>Sustainability</h3>
                    <p>We are committed to creating solutions that last, respecting our environment and ensuring long-term economic growth.</p>
                </div>

                <div class="value-item reveal-up">
                    <div class="v-icon-box"><i class="fa-solid fa-person-praying"></i></div>
                    <h3>Harmony</h3>
                    <p>We strive for a balance between the spiritual and the physical, ensuring mental and emotional well-being.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="philosophy-section section-padding">
        <div class="container split-layout">
            <div class="philosophy-image reveal-up">
                <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=1000&auto=format&fit=crop" alt="Philosophy">
                <div class="quote-overlay">
                    "Leadership is both hindsight and foresight."
                </div>
            </div>
            <div class="philosophy-content reveal-up">
                <span class="section-tag">OUR PHILOSOPHY</span>
                <h2>The So W!se Way</h2>
                <p>We believe that education is not just about acquiring facts; it is about learning how to live. Our philosophy is rooted in the idea that <strong>nobody is born a failure</strong>.</p>
                <p>Whether it is through our "Life-Learning" curriculum or our coding bootcamps, our goal is to reconcile young people with their potential. We help them review their past (hindsight) to build a better future (foresight).</p>
                
                <ul class="check-list">
                    <li><i class="fa-solid fa-check"></i> Practical Skill Acquisition</li>
                    <li><i class="fa-solid fa-check"></i> Mental & Physical Wellness</li>
                    <li><i class="fa-solid fa-check"></i> Community Reconciliation</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="reveal-up">
            <h2>Support Our Mission</h2>
            <p>Your contribution helps us train more leaders.</p>
            <div class="btn-group">
                <a href="donate.php" class="btn-white">Make a Donation</a>
                <a href="contact.php" class="btn-outline">Partner With Us</a>
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