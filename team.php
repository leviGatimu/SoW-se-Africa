<?php 
require_once 'includes/db_connect.php'; // Connect to DB
include 'includes/header.php'; 

// 1. FETCH FOUNDER INFO
$founder_sql = "SELECT * FROM founder_settings WHERE id=1";
$founder_result = $conn->query($founder_sql);
$founder = $founder_result->fetch_assoc();

// 2. FETCH TEAM MEMBERS
$team_sql = "SELECT * FROM team_members ORDER BY display_order ASC";
$team_result = $conn->query($team_sql);
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<main>

    <section class="hero-section page-header">
        <div class="hero-bg" style="background-image: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2000');"></div>
        <div class="hero-overlay"></div>
        <div class="content-container hero-content center-text">
            <span class="hero-badge fade-in">OUR LEADERSHIP</span>
            <h1 class="fade-in">Meet the <span class="text-accent">Visionaries.</span></h1>
            <p class="fade-in">A dedicated team of educators, innovators, and leaders working together to transform the future of Africa.</p>
        </div>
    </section>

    <section class="section-padding">
        <div class="content-container split-layout reverse-desktop">
            
            <div class="image-column reveal-up">
                <img src="<?php echo $founder['image_path']; ?>" alt="<?php echo $founder['name']; ?>">
                <div class="image-accent-box left"></div>
                
                <div class="founder-social-box">
                    <span>Connect with Leadership:</span>
                    <div class="social-icons">
                        <a href="mailto:<?php echo $founder['email']; ?>"><i class="fa-solid fa-envelope"></i></a>
                    </div>
                </div>
            </div>

            <div class="text-column reveal-up">
                <span class="section-label">FOUNDER & MANAGING DIRECTOR</span>
                <h2><?php echo $founder['name']; ?></h2>
                <h3 class="role-title" style="color: #64748b; font-size: 1.1rem; margin-bottom: 20px;"><?php echo $founder['role']; ?></h3>
                
                <div class="bio-intro">
                    <p><?php echo nl2br($founder['bio']); ?></p>
                </div>

                <blockquote class="founder-quote">
                    "<?php echo $founder['quote']; ?>"
                </blockquote>
            </div>

        </div>
    </section>

    <section class="section-padding bg-light">
        <div class="content-container">
            <div class="center-text reveal-up" style="margin-bottom: 60px;">
                <span class="section-label">THE TEAM</span>
                <h2>Executive Leadership</h2>
                <p>The minds driving our operations and programs.</p>
            </div>

            <div class="team-grid">
                <?php if ($team_result->num_rows > 0): ?>
                    <?php while($member = $team_result->fetch_assoc()): ?>
                        
                        <div class="team-card reveal-up">
                            <div class="team-image">
                                <img src="<?php echo $member['image_path']; ?>" alt="<?php echo $member['name']; ?>">
                                <div class="team-overlay">
                                    <div class="team-bio-short">
                                        <?php echo $member['bio']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="team-info">
                                <h3><?php echo $member['name']; ?></h3>
                                <span class="team-role"><?php echo $member['role']; ?></span>
                            </div>
                        </div>

                    <?php endwhile; ?>
                <?php else: ?>
                    <p style="text-align: center; color: #64748b;">No team members added yet.</p>
                <?php endif; ?>
            </div>

        </div>
    </section>

    <style>
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }
        .team-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: 0.3s;
        }
        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .team-image {
            height: 300px;
            width: 100%;
            overflow: hidden;
            position: relative;
        }
        .team-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.5s;
        }
        .team-overlay {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(15, 23, 42, 0.9); /* Dark Blue Overlay */
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            opacity: 0;
            transition: 0.3s;
            text-align: center;
            color: white;
        }
        .team-card:hover .team-overlay {
            opacity: 1;
        }
        .team-info {
            padding: 20px;
            text-align: center;
        }
        .team-info h3 {
            font-size: 1.2rem;
            margin-bottom: 5px;
            color: #0f172a;
        }
        .team-role {
            color: #f59e0b;
            font-weight: 600;
            font-size: 0.9rem;
        }
    </style>

    <section class="cta-section">
        <div class="content-container center-text reveal-up">
            <h2>Join Our Team</h2>
            <p>We are always looking for passionate volunteers and mentors.</p>
            <div class="btn-group centered">
                <a href="contact.php" class="btn-primary">Get Involved</a>
                <a href="donate.php" class="btn-outline-dark">Support Us</a>
            </div>
        </div>
    </section>

</main>

<?php include 'includes/footer.php'; ?>
<script src="assets/js/main.js"></script> 
</body>
</html>