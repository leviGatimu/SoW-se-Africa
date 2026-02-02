<?php
ob_start(); // Prevent header errors
session_start();

// Security Check
// if(!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }

include '../includes/db_connect.php';

// --- HELPER: Auto-Create Directories ---
$base_upload_dir = "../uploads/team/";
if (!file_exists($base_upload_dir)) { mkdir($base_upload_dir, 0777, true); }

// 1. UPDATE FOUNDER
if(isset($_POST['update_founder'])) {
    $name = $_POST['name'];
    $role = $_POST['role'];
    $bio = $_POST['bio'];
    $quote = $_POST['quote'];
    $linkedin = $_POST['linkedin'];
    $twitter = $_POST['twitter'];
    $email = $_POST['email'];
    
    $db_image_path = $_POST['current_image'];
    if(!empty($_FILES['image']['name'])) {
        $filename = time() . "_" . basename($_FILES['image']['name']);
        if(move_uploaded_file($_FILES['image']['tmp_name'], $base_upload_dir . $filename)) {
            $db_image_path = "uploads/team/" . $filename;
        }
    }

    $stmt = $conn->prepare("UPDATE founder_settings SET name=?, role=?, bio=?, quote=?, image_path=?, linkedin=?, twitter=?, email=? WHERE id=1");
    $stmt->bind_param("ssssssss", $name, $role, $bio, $quote, $db_image_path, $linkedin, $twitter, $email);
    
    if($stmt->execute()) {
        header("Location: manage_team.php?msg=updated");
        exit();
    }
}

// 2. ADD TEAM MEMBER
if(isset($_POST['add_member'])) {
    $name = $_POST['t_name'];
    $role = $_POST['t_role'];
    $t_image_path = "assets/img/default-user.png"; 

    if(!empty($_FILES['t_image']['name'])) {
        $filename = time() . "_" . basename($_FILES['t_image']['name']);
        if(move_uploaded_file($_FILES['t_image']['tmp_name'], $base_upload_dir . $filename)) {
            $t_image_path = "uploads/team/" . $filename;
        }
    }

    $stmt = $conn->prepare("INSERT INTO team_members (name, role, image_path) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $role, $t_image_path);
    
    if($stmt->execute()) {
        header("Location: manage_team.php?msg=added");
        exit();
    }
}

// 3. DELETE MEMBER
if(isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM team_members WHERE id=$id");
    header("Location: manage_team.php?msg=deleted");
    exit();
}

// FETCH DATA
$founder = $conn->query("SELECT * FROM founder_settings WHERE id=1")->fetch_assoc();
$team = $conn->query("SELECT * FROM team_members ORDER BY display_order ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Team | SoW!SE Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    
    <style>
        /* Custom tweaks to match your dashboard grid */
        .settings-grid {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 30px;
            margin-top: 20px;
        }
        @media (max-width: 992px) { .settings-grid { grid-template-columns: 1fr; } }
        
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: 500; margin-bottom: 8px; color: #374151; }
        .form-control {
            width: 100%; padding: 10px 15px; border: 1px solid #e2e8f0; border-radius: 8px;
            font-family: inherit; font-size: 0.95rem;
        }
        .form-control:focus { outline: 2px solid #f59e0b; border-color: transparent; }
        
        .profile-preview {
            width: 100px; height: 100px; border-radius: 50%; object-fit: cover;
            border: 3px solid #fff; box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin: 0 auto 15px; display: block;
        }
        
        /* Modal Styles since we aren't using Bootstrap JS */
        .modal {
            display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%;
            background-color: rgba(0,0,0,0.5); align-items: center; justify-content: center;
        }
        .modal.active { display: flex; }
        .modal-content {
            background: white; padding: 30px; border-radius: 12px; width: 100%; max-width: 500px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .modal-header { display: flex; justify-content: space-between; margin-bottom: 20px; }
        .close-modal { background: none; border: none; font-size: 1.5rem; cursor: pointer; }
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
                <a href="manage_team.php" class="active"><i class="fa-solid fa-users"></i> Team</a>
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
                <h1>Team Management</h1>
                <p>Manage the founder profile and add team members.</p>
            </div>
            <button onclick="openModal()" class="btn-primary"><i class="fa-solid fa-plus"></i> Add Member</button>
        </header>

        <div class="settings-grid">
            
            <div class="table-card">
                <div class="card-header">
                    <h3>Founder Profile</h3>
                </div>
                <div style="padding: 25px;">
                    <form method="POST" enctype="multipart/form-data">
                        
                        <div class="form-group" style="text-align: center;">
                            <img src="../<?php echo $founder['image_path']; ?>" class="profile-preview">
                            <input type="file" name="image" style="font-size: 0.9rem;">
                            <input type="hidden" name="current_image" value="<?php echo $founder['image_path']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($founder['name']); ?>">
                        </div>

                        <div class="form-group">
                            <label>Role / Title</label>
                            <input type="text" name="role" class="form-control" value="<?php echo htmlspecialchars($founder['role']); ?>">
                        </div>

                        <div style="background: #f8fafc; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #e2e8f0;">
                            <label style="font-size: 0.8rem; text-transform: uppercase; color: #64748b; font-weight: 700;">Social Links</label>
                            <input type="text" name="linkedin" class="form-control" placeholder="LinkedIn URL" value="<?php echo htmlspecialchars($founder['linkedin'] ?? ''); ?>" style="margin-top: 10px;">
                            <input type="text" name="twitter" class="form-control" placeholder="Twitter URL" value="<?php echo htmlspecialchars($founder['twitter'] ?? ''); ?>" style="margin-top: 10px;">
                            <input type="email" name="email" class="form-control" placeholder="Email Address" value="<?php echo htmlspecialchars($founder['email'] ?? ''); ?>" style="margin-top: 10px;">
                        </div>

                        <div class="form-group">
                            <label>Biography</label>
                            <textarea name="bio" class="form-control" rows="5"><?php echo htmlspecialchars($founder['bio']); ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Key Quote</label>
                            <textarea name="quote" class="form-control" rows="2"><?php echo htmlspecialchars($founder['quote']); ?></textarea>
                        </div>

                        <button type="submit" name="update_founder" class="btn-primary" style="width: 100%;">Save Changes</button>
                    </form>
                </div>
            </div>

            <div class="table-card">
                <div class="card-header">
                    <h3>Team Directory</h3>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th width="60">Photo</th>
                                <th>Name & Role</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($team->num_rows > 0): ?>
                                <?php while($row = $team->fetch_assoc()): ?>
                                <tr>
                                    <td>
                                        <img src="../<?php echo $row['image_path']; ?>" style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover;" onerror="this.src='../assets/img/default-user.png'">
                                    </td>
                                    <td>
                                        <div style="font-weight: 600; color: #1e293b;"><?php echo $row['name']; ?></div>
                                        <span class="badge"><?php echo $row['role']; ?></span>
                                    </td>
                                    <td class="text-right">
                                        <a href="manage_team.php?delete=<?php echo $row['id']; ?>" class="btn-icon delete" onclick="return confirm('Remove this member?')">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="3" style="text-align: center; padding: 30px; color: #64748b;">No team members found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div id="memberModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add Team Member</h3>
                <button onclick="closeModal()" class="close-modal">&times;</button>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="t_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <input type="text" name="t_role" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Photo</label>
                    <input type="file" name="t_image" class="form-control">
                </div>
                <button type="submit" name="add_member" class="btn-primary" style="width: 100%;">Add Member</button>
            </form>
        </div>
    </div>

    <script>
        function openModal() { document.getElementById('memberModal').classList.add('active'); }
        function closeModal() { document.getElementById('memberModal').classList.remove('active'); }
        
        // Close modal if clicking outside
        window.onclick = function(event) {
            if (event.target == document.getElementById('memberModal')) {
                closeModal();
            }
        }
    </script>
</body>
</html>