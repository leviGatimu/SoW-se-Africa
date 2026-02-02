<?php 
// 1. Database Connection (Robust Check)
$path_includes = 'includes/db_connect.php';
$path_parent = '../includes/db_connect.php';
if (file_exists($path_includes)) { include $path_includes; } elseif (file_exists($path_parent)) { include $path_parent; } else { $conn = mysqli_connect("localhost", "root", "", "sowise_db"); }

include 'includes/header.php'; 
?>

<style>
    :root {
        --primary: #0f172a;
        --accent: #f59e0b;
        --text-body: #64748b;
        --text-head: #1e293b;
        --bg-light: #f8fafc;
    }

    body { background-color: var(--bg-light); font-family: 'Inter', sans-serif; }

    /* 1. HERO SECTION */
    .journal-hero {
        background: var(--primary);
        padding: 80px 0 100px;
        position: relative;
        overflow: hidden;
        text-align: center;
        color: white;
    }
    .journal-hero::after {
        content: ''; position: absolute; bottom: -50px; left: 0; width: 100%; height: 100px;
        background: var(--bg-light);
        border-radius: 50% 50% 0 0 / 100% 100% 0 0;
        transform: scaleX(1.5);
    }

    /* 2. BLOG LIST LAYOUT (The "No Card" Look) */
    .blog-item {
        display: flex;
        gap: 30px;
        background: transparent;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 40px;
        margin-bottom: 40px;
        transition: 0.3s ease;
    }
    
    .blog-item:last-child { border-bottom: none; }

    /* Image Wrapper */
    .blog-thumb {
        flex: 0 0 280px; /* Fixed width for image */
        height: 200px;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
    }
    
    .blog-thumb img {
        width: 100%; height: 100%; object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .blog-item:hover .blog-thumb img { transform: scale(1.05); }

    /* Content Wrapper */
    .blog-details { flex: 1; display: flex; flex-direction: column; justify-content: center; }

    .blog-meta {
        font-size: 0.85rem;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        margin-bottom: 10px;
        display: flex; align-items: center; gap: 10px;
    }

    .blog-cat { color: var(--accent); }

    .blog-title {
        font-family: 'Outfit', sans-serif;
        font-size: 1.75rem;
        font-weight: 800;
        line-height: 1.3;
        margin-bottom: 12px;
        color: var(--text-head);
    }
    
    .blog-title a { text-decoration: none; color: inherit; transition: 0.2s; }
    .blog-title a:hover { color: var(--accent); }

    .blog-excerpt {
        color: var(--text-body);
        font-size: 1.05rem;
        line-height: 1.6;
        margin-bottom: 20px;
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Limit to 2 lines */
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .read-more-link {
        font-weight: 700;
        color: var(--primary);
        text-decoration: none;
        display: inline-flex; align-items: center; gap: 8px;
        transition: 0.2s;
    }
    .read-more-link:hover { gap: 12px; color: var(--accent); }

    /* 3. SIDEBAR WIDGETS */
    .sidebar-widget {
        background: white;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 4px 20px -5px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        border: 1px solid #f1f5f9;
    }
    
    .widget-title {
        font-size: 1.1rem; font-weight: 800; color: var(--primary);
        margin-bottom: 20px; letter-spacing: -0.5px;
    }

    .search-form { position: relative; }
    .search-input {
        width: 100%; padding: 12px 15px; border-radius: 8px; border: 1px solid #e2e8f0; background: #f8fafc;
    }
    .search-btn {
        position: absolute; right: 10px; top: 50%; transform: translateY(-50%);
        background: none; border: none; color: #94a3b8; cursor: pointer;
    }

    .cat-list { list-style: none; padding: 0; margin: 0; }
    .cat-list li { margin-bottom: 10px; }
    .cat-list a {
        display: flex; justify-content: space-between;
        text-decoration: none; color: var(--text-body); font-weight: 500;
        transition: 0.2s;
    }
    .cat-list a:hover { color: var(--accent); padding-left: 5px; }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .blog-item { flex-direction: column; gap: 20px; }
        .blog-thumb { flex: auto; height: 220px; }
    }
</style>

<main>

    <section class="journal-hero">
        <div class="content-container" style="position: relative; z-index: 2;">
            <span style="color: var(--accent); font-weight: 700; letter-spacing: 2px; font-size: 0.9rem; text-transform: uppercase; display: block; margin-bottom: 10px; margin-top: 60px;">Our Journal</span>
            <h1 style="font-size: 3.5rem; font-weight: 800; margin: 0; letter-spacing: -1px; color:white;">Stories & Insights</h1>
        </div>
    </section>

    <div class="content-container" style="display: flex; flex-wrap: wrap; gap: 60px; max-width: 1150px; margin: 0 auto; position: relative; z-index: 5; margin-top: -40px;">

        <div class="blog-feed" style="flex: 2; min-width: 300px;">
            
            <?php
            if ($conn) {
                // Determine Page for Pagination (Optional feature for later)
                $sql = "SELECT * FROM posts ORDER BY created_at DESC";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        
                        // Data Prep
                        $id = $row['id'];
                        $title = $row['title'];
                        $date = date('M d, Y', strtotime($row['created_at']));
                        $category = !empty($row['category']) ? $row['category'] : 'Insights';
                        
                        // Clean excerpt (first 160 chars)
                        $clean_content = strip_tags(html_entity_decode($row['content']));
                        $excerpt = substr($clean_content, 0, 160) . '...';

                        // Image Check
                        $imgName = $row['image'];
                        $imgSrc = (!empty($imgName) && file_exists("uploads/" . $imgName)) 
                                  ? "uploads/" . $imgName 
                                  : "https://via.placeholder.com/600x400?text=SoW!SE+Africa"; // Fallback

                        echo '
                        <article class="blog-item">
                            <a href="single-post.php?id='.$id.'" class="blog-thumb">
                                <img src="'.$imgSrc.'" alt="'.$title.'">
                            </a>
                            
                            <div class="blog-details">
                                <div class="blog-meta">
                                    <span class="blog-cat">'.$category.'</span>
                                    <span>•</span>
                                    <span>'.$date.'</span>
                                </div>
                                <h2 class="blog-title">
                                    <a href="single-post.php?id='.$id.'">'.$title.'</a>
                                </h2>
                                <p class="blog-excerpt">'.$excerpt.'</p>
                                <a href="single-post.php?id='.$id.'" class="read-more-link">
                                    Read Full Story <i class="fa-solid fa-arrow-right-long"></i>
                                </a>
                            </div>
                        </article>
                        ';
                    }
                } else {
                    echo '
                    <div style="text-align: center; padding: 60px; background: white; border-radius: 12px; border: 1px dashed #cbd5e1;">
                        <i class="fa-solid fa-pen-nib" style="font-size: 3rem; color: #e2e8f0; margin-bottom: 20px;"></i>
                        <h3 style="color: #64748b;">No stories published yet.</h3>
                        <p style="color: #94a3b8;">Check back soon for updates from our team.</p>
                    </div>';
                }
            }
            ?>

            <div style="margin-top: 20px; display: flex; gap: 10px;">
                <button disabled style="padding: 10px 20px; border: 1px solid #e2e8f0; background: white; border-radius: 8px; color: #cbd5e1;">&larr; Previous</button>
                <button style="padding: 10px 20px; border: 1px solid #0f172a; background: #0f172a; border-radius: 8px; color: white;">1</button>
                <button style="padding: 10px 20px; border: 1px solid #e2e8f0; background: white; border-radius: 8px; color: #0f172a;">2</button>
                <button style="padding: 10px 20px; border: 1px solid #e2e8f0; background: white; border-radius: 8px; color: #0f172a;">Next &rarr;</button>
            </div>

        </div>

        <aside style="flex: 1; min-width: 280px;">
            
            <div class="sidebar-widget">
                <h3 class="widget-title">Search Journal</h3>
                <form class="search-form" action="" method="GET">
                    <input type="text" class="search-input" placeholder="Type keyword...">
                    <button type="submit" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>

            <div class="sidebar-widget">
                <h3 class="widget-title">Categories</h3>
                <ul class="cat-list">
                    <li><a href="#">Leadership <span>(0)</span></a></li>
                    <li><a href="#">Youth Empowerment <span>(0)</span></a></li>
                    <li><a href="#">Events & Workshops <span>(0)</span></a></li>
                    <li><a href="#">Success Stories <span>(0)</span></a></li>
                </ul>
            </div>

            <div class="sidebar-widget" style="background: #0f172a; color: white; border: none;">
                <h3 class="widget-title" style="color: white;">Join Our Newsletter</h3>
                <p style="font-size: 0.9rem; color: #94a3b8; margin-bottom: 20px;">Get the latest updates on leadership and youth programs directly to your inbox.</p>
                <form action="#" style="display: flex; flex-direction: column; gap: 10px;">
                    <input type="email" placeholder="Your email address" style="padding: 12px; border-radius: 8px; border: none;">
                    <button type="submit" style="background: var(--accent); color: white; border: none; padding: 12px; border-radius: 8px; font-weight: 700; cursor: pointer;">Subscribe</button>
                </form>
            </div>

        </aside>

    </div>
</main>

<?php include 'includes/footer.php'; ?>