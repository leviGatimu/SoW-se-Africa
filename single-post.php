<?php 
$path_includes = 'includes/db_connect.php';
$path_parent = '../includes/db_connect.php';
if (file_exists($path_includes)) { include $path_includes; } elseif (file_exists($path_parent)) { include $path_parent; } else { $conn = mysqli_connect("localhost", "root", "", "sowise_db"); }
include 'includes/header.php'; 

// GET POST ID
if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $res = mysqli_query($conn, "SELECT * FROM posts WHERE id='$id'");
    $post = mysqli_fetch_assoc($res);
}
?>

<main style="background: white; min-height: 100vh; font-family: 'Inter', sans-serif;">
    <?php if($post): 
        $cat = !empty($post['category']) ? $post['category'] : 'Update';
        $imgName = $post['image'];
        $hasImage = (!empty($imgName) && file_exists("uploads/" . $imgName));
    ?>
        
        <article style="max-width: 800px; margin: 0 auto; padding: 80px 20px;">
            
            <div style="text-align: center; margin-bottom: 50px;">
                <span style="color: #f59e0b; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; font-size: 0.9rem;">
                    <?php echo $cat; ?>
                </span>
                <h1 style="font-size: 3rem; color: #0f172a; margin: 15px 0 20px 0; line-height: 1.2;">
                    <?php echo $post['title']; ?>
                </h1>
                <span style="color: #94a3b8; font-size: 1rem;">
                    Published on <?php echo date('F j, Y', strtotime($post['created_at'])); ?>
                </span>
            </div>

            <?php if ($hasImage): ?>
                <div style="border-radius: 12px; overflow: hidden; margin-bottom: 50px; box-shadow: 0 10px 40px rgba(0,0,0,0.1);">
                    <img src="uploads/<?php echo $imgName; ?>" style="width: 100%; height: auto; display: block;">
                </div>
            <?php endif; ?>

            <div style="font-size: 1.25rem; line-height: 1.9; color: #334155; font-weight: 400;">
                <?php echo $post['content']; // TinyMCE saves as HTML, so we just echo it ?>
            </div>

            <div style="margin-top: 60px; border-top: 1px solid #f1f5f9; padding-top: 40px; text-align: center;">
                <a href="blog.php" style="background: #0f172a; color: white; padding: 15px 30px; border-radius: 50px; text-decoration: none; font-weight: 600;">
                    &larr; Back to Journal
                </a>
            </div>

        </article>

    <?php else: ?>
        <h1 style="text-align: center; padding: 100px;">Post not found.</h1>
    <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>