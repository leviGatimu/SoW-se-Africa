<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SoW!SE AFRICA | Values-Based Leadership</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;700;800&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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

    /* 2. Breathing Animation (2 Seconds per breath) */
    .preloader-logo {
        width: 120px; /* Made it slightly bigger */
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
        // The page has finished loading.
        // NOW, we tell the browser to wait 3000ms (3 seconds) before fading out.
        setTimeout(function() {
            document.body.classList.add("loaded");
        }, 3000);
    });

    // Fallback: If page is stuck loading for 7 seconds, force open anyway
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
                <li><a href="index.php">Home</a></li>
                <li class="dropdown-trigger">
                    <a href="#">Who We Are <i class="fa-solid fa-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="about">Our Story</a></li>
                        <li><a href="team">Leadership Team</a></li>
                        <li><a href="mission">Mission & vision</a></li>
                    </ul>
                </li>
                <li class="dropdown-trigger">
                    <a href="#">Our Work <i class="fa-solid fa-chevron-down"></i></a>
                    <ul class="dropdown-menu wide-menu">
                        <li><a href="leadership">Leadership</a></li>
                        <li><a href="programs.php#skills">Skills</a></li>
                        <li><a href="programs.php#coaching">Coaching</a></li>
                        <li><a href="programs.php#values">Values</a></li>
                    </ul>
                </li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="contact.php">Contact</a></li>
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