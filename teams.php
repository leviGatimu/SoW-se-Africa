<?php
include 'includes/admin_header.php'; 
require_once '../includes/db_connect.php'; 

// --- HELPER: Auto-Create Directories ---
$base_upload_dir = "../uploads/team/";
if (!file_exists($base_upload_dir)) { mkdir($base_upload_dir, 0777, true); }

// 1. HANDLE FOUNDER UPDATE
if(isset($_POST['update_founder'])) {
    $name = $_POST['name'];
    $role = $_POST['role'];
    $bio = $_POST['bio'];
    $quote = $_POST['quote'];
    
    // Social Links
    $linkedin = $_POST['linkedin'];
    $twitter = $_POST['twitter'];
    $email = $_POST['email'];
    
    // Image Logic
    $db_image_path = $_POST['current_image'];
    if(!empty($_FILES['image']['name'])) {
        $filename = time() . "_" . basename($_FILES['image']['name']);
        if(move_uploaded_file($_FILES['image']['tmp_name'], $base_upload_dir . $filename)) {
            $db_image_path = "uploads/team/" . $filename;
        }
    }

    // Update Query
    $stmt = $conn->prepare("UPDATE founder_settings SET name=?, role=?, bio=?, quote=?, image_path=?, linkedin=?, twitter=?, email=? WHERE id=1");
    $stmt->bind_param("ssssssss", $name, $role, $bio, $quote, $db_image_path, $linkedin, $twitter, $email);
    
    if($stmt->execute()) {
        $success_msg = "Founder profile & socials updated!";
    }
}

// 2. HANDLE ADD TEAM MEMBER
if(isset($_POST['add_member'])) {
    $name = $_POST['t_name'];
    $role = $_POST['t_role'];
    // $bio = $_POST['t_bio']; // Optional if you want bios for team members
    
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
        $success_msg = "New team member added!";
    }
}

// 3. HANDLE DELETE MEMBER
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

<div class="container py-5">
    
    <?php if(isset($success_msg)): ?>
        <div class="alert alert-success"><?php echo $success_msg; ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-5">
            <div class="admin-card">
                <div class="card-header-custom">
                    <h5><i class="fa-solid fa-user-tie me-2" style="color: #f59e0b;"></i> Founder Profile</h5>
                </div>
                <div class="p-4">
                    <form method="POST" enctype="multipart/form-data">
                        
                        <div class="mb-3">
                            <label class="form-label">Profile Photo</label>
                            <div class="d-flex align-items-center gap-3">
                                <img src="../<?php echo $founder['image_path']; ?>" class="rounded-circle shadow-sm" style="width:60px; height:60px; object-fit:cover;">
                                <input type="file" name="image" class="form-control form-control-sm">
                                <input type="hidden" name="current_image" value="<?php echo $founder['image_path']; ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($founder['name']); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <input type="text" name="role" class="form-control" value="<?php echo htmlspecialchars($founder['role']); ?>">
                        </div>

                        <div class="mb-3 p-3 bg-light rounded border">
                            <label class="form-label text-muted small text-uppercase fw-bold mb-3">Social Connections</label>
                            
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fa-brands fa-linkedin"></i></span>
                                <input type="text" name="linkedin" class="form-control" placeholder="LinkedIn URL" value="<?php echo htmlspecialchars($founder['linkedin'] ?? ''); ?>">
                            </div>

                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fa-brands fa-x-twitter"></i></span>
                                <input type="text" name="twitter" class="form-control" placeholder="Twitter URL" value="<?php echo htmlspecialchars($founder['twitter'] ?? ''); ?>">
                            </div>

                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="Email Address" value="<?php echo htmlspecialchars($founder['email'] ?? ''); ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Biography</label>
                            <textarea name="bio" class="form-control" rows="5"><?php echo htmlspecialchars($founder['bio']); ?></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Key Quote</label>
                            <textarea name="quote" class="form-control" rows="2"><?php echo htmlspecialchars($founder['quote']); ?></textarea>
                        </div>

                        <button type="submit" name="update_founder" class="btn btn-primary w-100">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="admin-card">
                <div class="card-header-custom">
                    <h5><i class="fa-solid fa-users me-2" style="color: #f59e0b;"></i> Team Members</h5>
                    <button class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#addMemberModal">
                        <i class="fa-solid fa-plus me-1"></i> Add Member
                    </button>
                </div>
                <div class="p-0">
                    <table class="table table-hover team-table mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Profile</th>
                                <th>Name & Role</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($team->num_rows > 0): ?>
                                <?php while($row = $team->fetch_assoc()): ?>
                                <tr class="align-middle">
                                    <td class="ps-4">
                                        <img src="../<?php echo $row['image_path']; ?>" class="rounded-circle shadow-sm" style="width:40px; height:40px; object-fit:cover;" onerror="this.src='../assets/img/default-user.png'">
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark"><?php echo $row['name']; ?></div>
                                        <div class="text-muted small"><?php echo $row['role']; ?></div>
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-outline-danger btn-sm rounded-pill px-3" onclick="return confirm('Delete this member?')">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="3" class="text-center py-5 text-muted">No team members found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addMemberModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Add Team Member</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="t_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <input type="text" name="t_role" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Photo</label>
                    <input type="file" name="t_image" class="form-control">
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="submit" name="add_member" class="btn btn-primary px-4">Add Member</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>