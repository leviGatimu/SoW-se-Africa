<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SoW!SE AFRICA | Values-Based Leadership</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;700;800&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="icon" type="image/png" href="assets/img/logo.png">
    
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div id="preloader">
    <div class="preloader-inner">
        <img src="assets/img/logo.png" alt="SoW!SE Loading..." class="preloader-logo">
    </div>
</div>

<style>
    /* 1. Full Screen White Overlay */
    #preloader {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background-color: #ffffff;
        z-index: 9999999999;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: opacity 0.8s ease, visibility 0.8s ease;
    }

    /* 2. Breathing Animation */
    .preloader-logo {
        width: 120px;
        animation: breathe 2s infinite ease-in-out;
    }

    @keyframes breathe {
        0% { transform: scale(0.95); opacity: 0.7; }
        50% { transform: scale(1.1); opacity: 1; }
        100% { transform: scale(0.95); opacity: 0.7; }
    }

    /* 3. Hide Class */
    body.loaded #preloader {
        opacity: 0;
        visibility: hidden;
    }
</style>

<script>
    window.addEventListener("load", function() {
        setTimeout(function() {
            document.body.classList.add("loaded");
        }, 3000);
    });

    // Fallback
    setTimeout(function() {
        document.body.classList.add("loaded");
    }, 7000);
</script>

<header class="main-header">
    <div class="header-container">
        
        <a href="index.php" class="brand-logo" style="display: flex; align-items: center; gap: 12px; text-decoration: none;">
            <img src="assets/img/logo.png" alt="SoW!SE Logo" style="height: 50px; width: auto;">
            <div style="display: flex; flex-direction: column; line-height: 1;">
                <span style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.5rem; color: #0f172a; letter-spacing: -1px;">
                    SoW!SE
                </span>
                <span style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.85rem; color: #f59e0b; letter-spacing: 2px;">
                    AFRICA
                </span>
            </div>
        </a>

        <nav class="desktop-nav">
            <ul class="nav-links">
                <li>
                    <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
                </li>
                
                <li class="dropdown-trigger">
                    <a href="#"><i class="fa-solid fa-users"></i> Who We Are <i class="fa-solid fa-chevron-down" style="font-size: 0.8em; margin-left: 5px;"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="about"><i class="fa-solid fa-book-open"></i> Our Story</a></li>
                        <li><a href="team"><i class="fa-solid fa-user-tie"></i> Leadership Team</a></li>
                        <li><a href="mission"><i class="fa-solid fa-compass"></i> Mission & Vision</a></li>
                    </ul>
                </li>
                
                <li class="dropdown-trigger">
                    <a href="#"><i class="fa-solid fa-briefcase"></i> Our Work <i class="fa-solid fa-chevron-down" style="font-size: 0.8em; margin-left: 5px;"></i></a>
                    <ul class="dropdown-menu wide-menu">
                        <li><a href="leadership"><i class="fa-solid fa-scale-balanced"></i> Leadership</a></li>
                        <li><a href="skills.php"><i class="fa-solid fa-brain"></i> Skills</a></li>
                        <li><a href="programs.php#coaching"><i class="fa-solid fa-user-group"></i> Coaching</a></li>
                        <li><a href="programs.php#values"><i class="fa-solid fa-heart"></i> Values</a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="blog.php"><i class="fa-solid fa-newspaper"></i> Blog</a>
                </li>
                
                <li>
                    <a href="contact.php"><i class="fa-solid fa-envelope"></i> Contact</a>
                </li>
            </ul>
        </nav>

        <div class="header-actions">
            <a href="donate.php" class="btn-donate">Donate Now</a>
            
            <button class="mobile-menu-toggle" aria-label="Open Menu">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

    </div>
</header>