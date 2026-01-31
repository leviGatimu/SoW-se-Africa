<?php 
$path_includes = 'includes/db_connect.php';
$path_parent = '../includes/db_connect.php';
if (file_exists($path_includes)) { include $path_includes; } elseif (file_exists($path_parent)) { include $path_parent; } else { $conn = mysqli_connect("localhost", "root", "", "sowise_db"); }
include 'includes/header.php'; 
?>

<main style="background: #f8fafc; min-height: 100vh; font-family: 'Inter', sans-serif;">

    <section style="background: #0f172a; padding: 80px 0; position: relative; overflow: hidden;">
        <div class="content-container" style="position: relative; z-index: 2; text-align: center;">
            <div style="font-size: 3rem; color: #f59e0b; margin-bottom: 20px;"><i class="fa-solid fa-feather-pointed"></i></div>
            <h1 style="color: white; font-size: 3.5rem; font-weight: 800; margin: 0;">The Journal</h1>
            <p style="color: #cbd5e1; font-size: 1.2rem; margin-top: 15px; max-width: 600px; margin-left: auto; margin-right: auto;">
                Explore the stories shaping the future of African leadership.
            </p>
        </div>
        <div style="position: absolute; top: -50%; right: -10%; width: 600px; height: 600px; background: radial-gradient(circle, rgba(245,158,11,0.1) 0%, rgba(0,0,0,0) 70%); border-radius: 50%;"></div>
    </section>

    <div class="content-container" style="display: flex; flex-wrap: wrap; gap: 60px; max-width: 1100px; margin: -50px auto 60px; position: relative; z-index: 5;">

        <div class="blog-feed" style="flex: 2; min-width: 300px;">
            <?php
            if ($conn) {
                $result = mysqli_query($conn, "SELECT * FROM posts ORDER BY created_at DESC");
                if ($result && mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        
                        $cat = !empty($row['category']) ? $row['category'] : 'Update';
                        $title = $row['title'];
                        $date = date('M d, Y', strtotime($row['created_at']));
                        $preview = substr(strip_tags(html_entity_decode($row['content'])), 0, 250) . '...';
                        
                        // Image Logic
                        $imgName = $row['image'];
                        $showImage = (!empty($imgName) && file_exists("uploads/" . $imgName));

                        // DYNAMIC COLOR for Category
                        $badgeColor = '#f59e0b'; // Default Orange
                        if($cat == 'Event') $badgeColor = '#3b82f6'; // Blue
                        if($cat == 'Success Story') $badgeColor = '#10b981'; // Green

                        echo '
                        <article style="
                            background: white; 
                            border-radius: 16px; 
                            overflow: hidden; 
                            margin-bottom: 40px; 
                            box-shadow: 0 10px 40px -10px rgba(0,0,0,0.1);
                            transition: transform 0.3s ease;
                            opacity: 1 !important; visibility: visible !important;">
                            
                            <div style="padding: 40px 40px 0 40px;">
                                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                                    <span style="
                                        background: '.$badgeColor.'; 
                                        color: white; 
                                        padding: 6px 14px; 
                                        border-radius: 50px; 
                                        font-size: 0.75rem; 
                                        font-weight: 700; 
                                        text-transform: uppercase; 
                                        letter-spacing: 1px;">
                                        '.$cat.'
                                    </span>
                                    <span style="color: #94a3b8; font-size: 0.9rem; font-weight: 500;">'.$date.'</span>
                                </div>
                                <h2 style="margin: 0; font-size: 2.2rem; font-weight: 800; line-height: 1.2;">
                                    <a href="single-post.php?id='.$row['id'].'" style="text-decoration: none; color: #0f172a;">
                                        '.$title.'
                                    </a>
                                </h2>
                            </div>';

                            if ($showImage) {
                                echo '
                                <div style="margin: 30px 40px; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                                    <a href="single-post.php?id='.$row['id'].'">
                                        <img src="uploads/'.$imgName.'" style="width: 100%; height: auto; display: block;" alt="Post">
                                    </a>
                                </div>';
                            }

                        echo '
                            <div style="padding: 0 40px 40px 40px;">
                                <p style="color: #475569; font-size: 1.1rem; line-height: 1.8; margin-bottom: 25px;">
                                    '.$preview.'
                                </p>
                                <a href="single-post.php?id='.$row['id'].'" style="
                                    color: #0f172a; 
                                    font-weight: 700; 
                                    text-decoration: none; 
                                    border-bottom: 2px solid #cbd5e1; 
                                    padding-bottom: 4px; 
                                    transition: 0.3s;">
                                    Read Full Story
                                </a>
                            </div>
                        </article>';
                    }
                } else { echo "<div style='text-align:center; padding:50px;'>No posts yet.</div>"; }
            }
            ?>
        </div>

        <aside style="flex: 1; min-width: 280px;">
            <div style="background: white; padding: 40px; border-radius: 16px; box-shadow: 0 10px 40px -10px rgba(0,0,0,0.1); position: sticky; top: 20px;">
                <div style="width: 60px; height: 60px; background: #0f172a; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem; margin-bottom: 20px;">
                    <i class="fa-solid fa-quote-left"></i>
                </div>
                <h3 style="margin: 0 0 15px 0; font-size: 1.4rem;">SoW!SE Voices</h3>
                <p style="color: #64748b; line-height: 1.7; margin-bottom: 30px;">
                    We believe that stories have the power to change mindsets. Follow our journey as we empower the next generation.
                </p>
                <div style="border-top: 1px solid #f1f5f9; padding-top: 20px;">
                    <span style="display: block; font-size: 0.8rem; color: #94a3b8; font-weight: 700; margin-bottom: 10px;">FOLLOW US</span>
                    <div style="display: flex; gap: 15px; font-size: 1.2rem; color: #0f172a;">
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </aside>

    </div>
</main>
<?php include 'includes/footer.php'; ?>