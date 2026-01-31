<?php
session_start();
if(!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }
include '../includes/db_connect.php';

// 1. GET THE POST DATA
if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM posts WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $post = mysqli_fetch_assoc($result);

    if(!$post) {
        header("Location: dashboard.php"); // Redirect if ID invalid
        exit();
    }
} else {
    header("Location: dashboard.php"); // Redirect if no ID
    exit();
}

// 2. HANDLE UPDATE
if(isset($_POST['update'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $image = $post['image']; // Default to old image

    // If new image uploaded
    if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        $image = $_FILES['image']['name'];
        $target = "../uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }

    $update_sql = "UPDATE posts SET title='$title', category='$category', image='$image', content='$content' WHERE id='$id'";
    
    if(mysqli_query($conn, $update_sql)) {
        header("Location: dashboard.php?msg=updated");
    } else {
        $error = "Error updating: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Post | SoW!SE Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>
    <script>
      tinymce.init({
        selector: '#content-editor',
        height: 400,
        plugins: 'lists link image code table',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link'
      });
    </script>
</head>
<body>

<div class="admin-wrapper">
    <aside class="sidebar">
        <div class="brand">SoW!SE <span>Admin</span></div>
        <nav class="menu">
            <a href="dashboard.php"><i class="fa-solid fa-grid-2"></i> Dashboard</a>
            <a href="add_post.php"><i class="fa-solid fa-pen-nib"></i> Write New Post</a>
            <a href="../index.php" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square"></i> View Website</a>
        </nav>
    </aside>

    <main class="main-content">
        <header class="top-header">
            <h1>Edit Article</h1>
            <a href="dashboard.php" class="back-link">Cancel</a>
        </header>

        <div class="content-container">
            <div class="card editor-card">
                <form method="POST" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" class="form-control" style="background:#f8fafc;">
                            <option value="News & Updates" <?php if($post['category'] == 'News & Updates') echo 'selected'; ?>>News & Updates</option>
                            <option value="Success Story" <?php if($post['category'] == 'Success Story') echo 'selected'; ?>>Success Story</option>
                            <option value="Event" <?php if($post['category'] == 'Event') echo 'selected'; ?>>Event / Workshop</option>
                            <option value="Announcement" <?php if($post['category'] == 'Announcement') echo 'selected'; ?>>Announcement</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Post Title</label>
                        <input type="text" name="title" class="form-control lg" value="<?php echo $post['title']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Featured Image</label>
                        <?php if(!empty($post['image'])): ?>
                            <div style="margin-bottom: 10px;">
                                <img src="../uploads/<?php echo $post['image']; ?>" style="width: 100px; height: 60px; object-fit: cover; border-radius: 4px;">
                                <span style="font-size: 0.8rem; color: #888;">Current Image</span>
                            </div>
                        <?php endif; ?>
                        <div class="file-upload-wrapper">
                            <input type="file" name="image" class="form-control-file">
                            <small>Leave blank to keep current image.</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Content</label>
                        <textarea id="content-editor" name="content"><?php echo $post['content']; ?></textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="update" class="btn-primary-lg">Update Post</button>
                    </div>

                </form>
            </div>
        </div>
    </main>
</div>

</body>
</html>