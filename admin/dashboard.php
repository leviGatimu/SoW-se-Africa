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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | SoW!SE</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #0f172a;
            --accent: #f59e0b;
            --bg: #f1f5f9;
            --text: #334155;
        }
        
        * { box-sizing: border-box; }
        body { background-color: var(--bg); font-family: 'Inter', sans-serif; margin: 0; padding: 0; color: var(--text); }
        a { text-decoration: none; }

        /* --- NAVBAR --- */
        .admin-navbar { background: white; border-bottom: 1px solid #e2e8f0; position: sticky; top: 0; z-index: 100; }
        .nav-container { 
            max-width: 1200px; margin: 0 auto; padding: 0 20px; height: 70px; 
            display: flex; align-items: center; justify-content: space-between; 
            position: relative;
        }
        .nav-brand { font-weight: 800; font-size: 1.2rem; color: var(--primary); display: flex; align-items: center; gap: 8px; }
        .nav-brand span { color: var(--accent); }
        
        .nav-menu-wrapper { display: flex; align-items: center; gap: 30px; } /* Wraps links & user */

        .nav-links { display: flex; gap: 20px; }
        .nav-links a { color: #64748b; font-weight: 500; font-size: 0.95rem; transition: 0.2s; display: flex; align-items: center; gap: 6px; }
        .nav-links a:hover, .nav-links a.active { color: var(--primary); }
        .nav-user { display: flex; align-items: center; gap: 15px; }
        
        .admin-badge { background: #e0f2fe; color: #0284c7; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }
        .btn-logout { color: #ef4444; font-weight: 600; font-size: 0.9rem; }

        /* Hamburger Button (Hidden on Desktop) */
        .mobile-toggle { display: none; background: none; border: none; font-size: 1.5rem; color: var(--primary); cursor: pointer; }

        /* --- MAIN LAYOUT --- */
        .main-container { max-width: 1200px; margin: 30px auto; padding: 0 20px; }

        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .page-header h1 { margin: 0; font-size: 1.8rem; color: var(--primary); }
        .page-header p { margin: 5px 0 0; color: #64748b; font-size: 0.95rem; }
        
        .btn-primary { 
            background: var(--primary); color: white; padding: 12px 20px; border-radius: 8px; 
            font-weight: 600; display: inline-flex; align-items: center; gap: 8px; transition: 0.2s; white-space: nowrap;
        }
        .btn-primary:hover { background: #1e293b; }

        /* Stats Grid */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { 
            background: white; padding: 25px; border-radius: 12px; border: 1px solid #e2e8f0; 
            display: flex; justify-content: space-between; align-items: flex-start; box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }
        .stat-label { display: block; color: #64748b; font-size: 0.9rem; font-weight: 500; margin-bottom: 5px; }
        .stat-number { margin: 0; font-size: 1.8rem; font-weight: 700; color: var(--primary); line-height: 1; }
        .stat-icon { width: 45px; height: 45px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
        .icon-blue { background: #eff6ff; color: #3b82f6; }
        .icon-green { background: #f0fdf4; color: #10b981; }
        .icon-orange { background: #fff7ed; color: #f97316; }

        /* Table Card */
        .table-card { background: white; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; }
        .card-header { padding: 20px 25px; border-bottom: 1px solid #f1f5f9; background: white; }
        .card-header h3 { margin: 0; font-size: 1.1rem; color: var(--primary); }

        .table-responsive { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 600px; }
        th { text-align: left; padding: 15px 25px; background: #f8fafc; color: #64748b; font-size: 0.8rem; text-transform: uppercase; font-weight: 600; letter-spacing: 0.5px; }
        td { padding: 15px 25px; border-bottom: 1px solid #f1f5f9; color: #334155; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        
        .img-box { width: 50px; height: 50px; border-radius: 8px; overflow: hidden; background: #f1f5f9; }
        .img-box img { width: 100%; height: 100%; object-fit: cover; }
        .title { font-weight: 600; margin-bottom: 4px; color: var(--primary); }
        .badge { background: #f1f5f9; color: #64748b; padding: 4px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 600; display: inline-block; }
        
        .btn-icon { width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px; transition: 0.2s; margin-left: 5px; }
        .btn-icon.edit { background: #eff6ff; color: #3b82f6; }
        .btn-icon.delete { background: #fef2f2; color: #ef4444; }
        .text-right { text-align: right; }
        .empty-state { text-align: center; padding: 40px; color: #94a3b8; }

        /* --- MOBILE HAMBURGER LOGIC --- */
        @media (max-width: 992px) {
            .mobile-toggle { display: block; }
            
            .nav-menu-wrapper {
                position: absolute;
                top: 70px;
                left: 0;
                width: 100%;
                background: white;
                flex-direction: column;
                align-items: flex-start;
                padding: 0;
                border-bottom: 1px solid #e2e8f0;
                max-height: 0; /* Hidden by default */
                overflow: hidden;
                transition: max-height 0.3s ease-in-out;
                gap: 0;
                box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            }

            .nav-menu-wrapper.active {
                max-height: 400px; /* Expand on click */
            }

            .nav-links {
                flex-direction: column;
                width: 100%;
                gap: 0;
            }

            .nav-links a {
                padding: 15px 25px;
                width: 100%;
                border-bottom: 1px solid #f8fafc;
            }

            .nav-user {
                padding: 15px 25px;
                width: 100%;
                justify-content: space-between;
                background: #f8fafc;
            }
            
            /* Page Layout adjustments */
            .page-header { flex-direction: column; align-items: flex-start; gap: 15px; }
            .btn-primary { width: 100%; justify-content: center; }
            .stats-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <nav class="admin-navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <img src="../assets/img/logo.png" alt="" width="50px"></i> SoW!SE <span>Admin</span>
            </div>

            <button class="mobile-toggle" onclick="toggleMenu()">
                <i class="fa-solid fa-bars"></i>
            </button>

            <div class="nav-menu-wrapper" id="navMenu">
                <div class="nav-links">
                    <a href="dashboard.php" class="active"><i class="fa-solid fa-layer-group"></i> Dashboard</a>
                    <a href="add_post.php"><i class="fa-solid fa-pen-to-square"></i> Write New</a>
                    <a href="manage_team.php"><i class="fa-solid fa-users"></i> Team</a>
                    <a href="../index.php" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square"></i> View Site</a>
                </div>

                <div class="nav-user">
                    <span class="admin-badge">Admin Logged In</span>
                    <a href="../logout.php" class="btn-logout"><i class="fa-solid fa-power-off"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <div class="main-container">

        <?php if(isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
            <div style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #bbf7d0;">
                <i class="fa-solid fa-check-circle"></i> Post deleted successfully.
            </div>
        <?php endif; ?>

        <header class="page-header">
            <div>
                <h1>Dashboard</h1>
                <p>Overview of your content and stats.</p>
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
                    <h2 class="stat-number" style="font-size: 1.2rem; color: #10b981;">Online</h2>
                </div>
                <div class="stat-icon icon-green">
                    <i class="fa-solid fa-server"></i>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <span class="stat-label">Team Members</span>
                    <h2 class="stat-number">
                        <?php
                        // Optional count query if table exists
                        $team_check = mysqli_query($conn, "SHOW TABLES LIKE 'team_members'");
                        if(mysqli_num_rows($team_check) > 0){
                            $team_count = mysqli_query($conn, "SELECT COUNT(*) as total FROM team_members");
                            $t_data = mysqli_fetch_assoc($team_count);
                            echo $t_data['total'];
                        } else { echo "0"; }
                        ?>
                    </h2>
                </div>
                <div class="stat-icon icon-orange">
                    <i class="fa-solid fa-users"></i>
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
                            <th width="60">Img</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $res = mysqli_query($conn, "SELECT * FROM posts ORDER BY created_at DESC");
                        if (mysqli_num_rows($res) > 0) {
                            while($row = mysqli_fetch_assoc($res)) {
                                $img = !empty($row['image']) ? '../uploads/'.$row['image'] : 'assets/img/placeholder.png';
                                $cat = !empty($row['category']) ? $row['category'] : 'General';
                                
                                echo "<tr>
                                    <td>
                                        <div class='img-box'><img src='$img' onerror=\"this.src='../assets/img/logo.png'\"></div>
                                    </td>
                                    <td>
                                        <div class='title'>{$row['title']}</div>
                                        <span class='badge'>$cat</span>
                                    </td>
                                    <td style='color:#64748b; font-size:0.9rem;'>".date('M d', strtotime($row['created_at']))."</td>
                                    <td class='text-right'>
                                        <a href='edit_post.php?id={$row['id']}' class='btn-icon edit'><i class='fa-solid fa-pen'></i></a>
                                        <a href='dashboard.php?delete={$row['id']}' class='btn-icon delete' onclick='return confirm(\"Delete this post?\")'><i class='fa-solid fa-trash'></i></a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='empty-state'>No posts yet. <a href='add_post.php'>Write one!</a></td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        function toggleMenu() {
            const menu = document.getElementById('navMenu');
            menu.classList.toggle('active');
        }
    </script>

</body>
</html>