<?php
session_start();
// if(!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit(); }
require_once '../includes/db_connect.php'; // Make sure this points to your DB connection

// 1. HANDLE FOUNDER UPDATE
if(isset($_POST['update_founder'])) {
    $name = $_POST['name'];
    $role = $_POST['role'];
    $bio = $_POST['bio'];
    $quote = $_POST['quote'];
    
    // Image Upload Logic (Simplified)
    $image = $_POST['current_image'];
    if(!empty($_FILES['image']['name'])) {
        $target = "../uploads/team/" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $image = "uploads/team/" . basename($_FILES['image']['name']);
    }

    $stmt = $conn->prepare("UPDATE founder_settings SET name=?, role=?, bio=?, quote=?, image_path=? WHERE id=1");
    $stmt->bind_param("sssss", $name, $role, $bio, $quote, $image);
    $stmt->execute();
    $success_msg = "Founder details updated!";
}

// 2. HANDLE ADD TEAM MEMBER
if(isset($_POST['add_member'])) {
    $name = $_POST['t_name'];
    $role = $_POST['t_role'];
    $bio = $_POST['t_bio'];
    
    // Default image if none uploaded
    $t_image = "assets/img/default-user.png";
    if(!empty($_FILES['t_image']['name'])) {
        $target = "../uploads/team/" . basename($_FILES['t_image']['name']);
        move_uploaded_file($_FILES['t_image']['tmp_name'], $target);
        $t_image = "uploads/team/" . basename($_FILES['t_image']['name']);
    }

    $stmt = $conn->prepare("INSERT INTO team_members (name, role, bio, image_path) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $role, $bio, $t_image);
    $stmt->execute();
    $success_msg = "Team member added!";
}

// 3. HANDLE DELETE MEMBER
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM team_members WHERE id=$id");
    header("Location: manage_team.php");
}

// FETCH DATA
$founder = $conn->query("SELECT * FROM founder_settings WHERE id=1")->fetch_assoc();
$team = $conn->query("SELECT * FROM team_members ORDER BY display_order ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Team - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h1 class="mb-4">Team Management</h1>
    
    <?php if(isset($success_msg)) echo "<div class='alert alert-success'>$success_msg</div>"; ?>

    <div class="card mb-5 shadow-sm">
        <div class="card-header bg-primary text-white">Edit Founder (CEO) Info</div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="../<?php echo $founder['image_path']; ?>" class="img-fluid rounded mb-2" style="max-height: 200px;">
                        <input type="hidden" name="current_image" value="<?php echo $founder['image_path']; ?>">
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $founder['name']; ?>">
                        </div>
                        <div class="mb-3">
                            <label>Role</label>
                            <input type="text" name="role" class="form-control" value="<?php echo $founder['role']; ?>">
                        </div>
                        <div class="mb-3">
                            <label>Bio</label>
                            <textarea name="bio" class="form-control" rows="4"><?php echo $founder['bio']; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Quote</label>
                            <textarea name="quote" class="form-control" rows="2"><?php echo $founder['quote']; ?></textarea>
                        </div>
                        <button type="submit" name="update_founder" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <span>Team Members</span>
            <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#addMemberModal">+ Add New</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $team->fetch_assoc()): ?>
                    <tr>
                        <td><img src="../<?php echo $row['image_path']; ?>" style="height: 50px;"></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['role']; ?></td>
                        <td>
                            <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="addMemberModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Team Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="t_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Role</label>
                    <input type="text" name="t_role" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Bio</label>
                    <textarea name="t_bio" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label>Photo</label>
                    <input type="file" name="t_image" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="add_member" class="btn btn-success">Add Member</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>