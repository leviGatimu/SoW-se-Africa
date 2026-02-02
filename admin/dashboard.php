<?php
session_start();
// Security Check
if(!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }

include '../includes/db_connect.php';

// Handle Delete Logic
if(isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM posts WHERE id=$id");
    header("Location: dashboard.php?msg=deleted");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard | SoW!SE</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
</head>
<body style="background-color: #f1f5f9;">

    <nav class="admin-navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <i class="fa-solid fa-feather-pointed"></i> SoW!SE <span>Admin</span>
            </div>

            <div class="nav-links">
                <a href="dashboard.php" class="active"><i class="fa-solid fa-layer-group"></i> Dashboard</a>
                <a href="add_post.php"><i class="fa-solid fa-pen-to-square"></i> Write New</a>
                <a href="manage_team.php"></i> Team</a>
                <a href="../index.php" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square"></i> View Site</a>
            </div>

            <div class="nav-user">
                <span class="admin-badge">Admin</span>
                <a href="../logout.php" class="btn-logout"><i class="fa-solid fa-power-off"></i> Logout</a>
            </div>
        </div>
    </nav>

    <div class="main-container">

        <header class="page-header">
            <div>
                <h1>Dashboard Overview</h1>
                <p>Welcome back, here is what's happening with your blog.</p>
            </div>
            <a href="add_post.php" class="btn-primary"><i class="fa-solid fa-plus"></i> New Article</a>
        </header>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-info">
                    <span class="stat-label">Total Stories</span>
                    <h2 class="stat-number">
                        <?php
                        $count_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM posts");
                        $data = mysqli_fetch_assoc($count_query);
                        echo $data['total'];
                        ?>
                    </h2>
                </div>
                <div class="stat-icon icon-blue">
                    <i class="fa-solid fa-newspaper"></i>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <span class="stat-label">System Status</span>
                    <h2 class="stat-number" style="font-size: 1.2rem; color: #10b981;">Active</h2>
                </div>
                <div class="stat-icon icon-green">
                    <i class="fa-solid fa-server"></i>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <span class="stat-label">Admin User</span>
                    <h2 class="stat-number" style="font-size: 1.2rem;">Logged In</h2>
                </div>
                <div class="stat-icon icon-orange">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
            </div>
        </div>

        <div class="table-card">
            <div class="card-header">
                <h3>Recent Articles</h3>
            </div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th width="80">Image</th>
                            <th>Title & Category</th>
                            <th>Published Date</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $res = mysqli_query($conn, "SELECT * FROM posts ORDER BY created_at DESC");
                        if (mysqli_num_rows($res) > 0) {
                            while($row = mysqli_fetch_assoc($res)) {
                                $img = !empty($row['image']) ? '../uploads/'.$row['image'] : 'https://via.placeholder.com/50';
                                $cat = !empty($row['category']) ? $row['category'] : 'Uncategorized';
                                
                                echo "<tr>
                                    <td>
                                        <div class='img-box'><img src='$img'></div>
                                    </td>
                                    <td>
                                        <div class='title'>{$row['title']}</div>
                                        <span class='badge'>$cat</span>
                                    </td>
                                    <td style='color:#64748b;'>".date('M j, Y', strtotime($row['created_at']))."</td>
                                    <td class='text-right'>
                                        <a href='edit_post.php?id={$row['id']}' class='btn-icon edit'><i class='fa-solid fa-pen'></i></a>
                                        <a href='dashboard.php?delete={$row['id']}' class='btn-icon delete' onclick='return confirm(\"Delete this post?\")'><i class='fa-solid fa-trash'></i></a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='empty-state'>No posts yet. <a href='add_post.php'>Write one now!</a></td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>