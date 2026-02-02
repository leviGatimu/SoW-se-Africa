<?php
ob_start(); // Fix header errors
session_start();

// Security Check
// if(!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }

include '../includes/db_connect.php';

// 1. GET THE POST DATA
if(isset($_GET['id'])) {
    $id = intval($_GET['id']); // Secure integer
    $sql = "SELECT * FROM posts WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $post = mysqli_fetch_assoc($result);

    if(!$post) {
        header("Location: dashboard.php");
        exit();
    }
} else {
    header("Location: dashboard.php");
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
        $image = time() . '_' . $_FILES['image']['name']; // Unique name
        $target = "../uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }

    $update_sql = "UPDATE posts SET title='$title', category='$category', image='$image', content='$content' WHERE id='$id'";
    
    if(mysqli_query($conn, $update_sql)) {
        header("Location: dashboard.php?msg=updated");
        exit();
    } else {
        $error = "Error updating: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Post | SoW!SE Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>
    <script>
      tinymce.init({
        selector: '#content-editor',
        height: 500,
        menubar: false,
        plugins: 'lists link image code table wordcount',
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | link image',
        content_style: 'body { font-family:Inter,sans-serif; font-size:16px }'
      });
    </script>

    <style>
        /* Editor Specific Styles */
        .editor-container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            max-width: 900px;
            margin: 0 auto;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
            font-size: 0.95rem;
        }

        .form-control, .form-select {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 1rem;
            font-family: inherit;
            margin-bottom: 20px;
            transition: border-color 0.2s;
        }

        .form-control:focus, .form-select:focus {
            outline: none;
            border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        }

        .current-img-preview {
            display: flex;
            align-items: center;
            gap: 15px;
            background: #f8fafc;
            padding: 15px;
            border-radius: 8px;
            border: 1px dashed #cbd5e1;
            margin-bottom: 15px;
        }

        .current-img-preview img {
            height: 60px;
            width: 80px;
            object-fit: cover;
            border-radius: 6px;
        }

        .btn-update {
            background-color: #0f172a;
            color: white;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            width: 100%;
            transition: background 0.2s;
        }

        .btn-update:hover {
            background-color: #1e293b;
        }

        .btn-cancel {
            display: inline-block;
            text-decoration: none;
            color: #64748b;
            font-weight: 500;
            margin-top: 15px;
            text-align: center;
            width: 100%;
        }
        .btn-cancel:hover { color: #f59e0b; }
    </style>
</head>
<body style="background-color: #f1f5f9;">

    <nav class="admin-navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <i class="fa-solid fa-feather-pointed"></i> SoW!SE <span>Admin</span>
            </div>
            <div class="nav-links">
                <a href="dashboard.php"><i class="fa-solid fa-layer-group"></i> Dashboard</a>
                <a href="add_post.php"><i class="fa-solid fa-pen-to-square"></i> Write New</a>
                <a href="manage_team.php"><i class="fa-solid fa-users"></i> Team</a>
                <a href="../index.php" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square"></i> View Site</a>
            </div>
            <div class="nav-user">
                <span class="admin-badge">Admin</span>
                <a href="../logout.php" class="btn-logout"><i class="fa-solid fa-power-off"></i> Logout</a>
            </div>
        </div>
    </nav>

    <div class="main-container">

        <header class="page-header" style="text-align: center; margin-bottom: 40px;">
            <h1 style="margin-bottom: 10px;">Edit Article</h1>
            <p style="color: #64748b;">Refine your content and keep your audience updated.</p>
        </header>

        <div class="editor-container">
            <form method="POST" enctype="multipart/form-data">
                
                <div class="row" style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
                    <div>
                        <label class="form-label">Article Title</label>
                        <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($post['title']); ?>" required>
                    </div>
                    <div>
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select">
                            <option value="News & Updates" <?php if($post['category'] == 'News & Updates') echo 'selected'; ?>>News & Updates</option>
                            <option value="Success Story" <?php if($post['category'] == 'Success Story') echo 'selected'; ?>>Success Story</option>
                            <option value="Event" <?php if($post['category'] == 'Event') echo 'selected'; ?>>Event / Workshop</option>
                            <option value="Announcement" <?php if($post['category'] == 'Announcement') echo 'selected'; ?>>Announcement</option>
                        </select>
                    </div>
                </div>

                <div style="margin-bottom: 25px;">
                    <label class="form-label">Featured Image</label>
                    
                    <?php if(!empty($post['image'])): ?>
                        <div class="current-img-preview">
                            <img src="../uploads/<?php echo $post['image']; ?>" alt="Current Image">
                            <div>
                                <span style="display:block; font-weight:600; font-size:0.9rem;">Current Image</span>
                                <span style="font-size:0.8rem; color:#64748b;">Upload a new file to replace this.</span>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <input type="file" name="image" class="form-control" style="padding: 10px;">
                </div>

                <div style="margin-bottom: 30px;">
                    <label class="form-label">Content</label>
                    <textarea id="content-editor" name="content"><?php echo $post['content']; ?></textarea>
                </div>

                <button type="submit" name="update" class="btn-update">Update Article</button>
                <a href="dashboard.php" class="btn-cancel">Cancel and Go Back</a>

            </form>
        </div>

    </div>

</body>
</html>