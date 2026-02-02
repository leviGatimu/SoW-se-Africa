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
        
        <?php if(!empty($founder['linkedin'])): ?>
            <a href="<?php echo $founder['linkedin']; ?>" target="_blank" title="LinkedIn">
                <i class="fa-brands fa-linkedin"></i>
            </a>
        <?php endif; ?>

        <?php if(!empty($founder['twitter'])): ?>
            <a href="<?php echo $founder['twitter']; ?>" target="_blank" title="Twitter/X">
                <i class="fa-brands fa-x-twitter"></i>
            </a>
        <?php endif; ?>

        <?php if(!empty($founder['email'])): ?>
            <a href="mailto:<?php echo $founder['email']; ?>" title="Email">
                <i class="fa-solid fa-envelope"></i>
            </a>
        <?php endif; ?>

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
                            <img src="<?php echo $member['image_path']; ?>" alt="<?php echo $member['name']; ?>" class="team-card-image">
                            <div class="team-card-content">
                                <h3 class="team-card-name"><?php echo $member['name']; ?></h3>
                                <p class="team-card-role"><?php echo $member['role']; ?></p>
                            </div>
                        </div>

                    <?php endwhile; ?>
                <?php else: ?>
                    <p style="text-align: center; color: #64748b; width: 100%;">No team members added yet.</p>
                <?php endif; ?>
            </div>

        </div>
    </section>

    <style>
        /* GRID LAYOUT FOR CARDS */
        .team-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        /* YOUR PROVIDED CSS */
        .team-card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 100%;
            max-width: 300px; /* Standard card width */
            margin: 0; /* Margin handled by grid gap */
        }

        .team-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        }

        .team-card-image {
            width: 100%;
            height: 300px; /* Fixed height for consistency */
            object-fit: cover;
            border-bottom: 1px solid #f0f0f0;
        }

        .team-card-content {
            padding: 20px;
            text-align: center;
        }

        .team-card-name {
            font-family: 'Outfit', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .team-card-role {
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            font-weight: 500;
            color: #f59e0b; /* Accent color */
            margin: 0;
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