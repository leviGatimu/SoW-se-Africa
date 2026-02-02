<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// SECURITY CHECK (Uncomment this line when you have a login system working!)
// if(!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | SoW!SE</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background-color: #f3f4f6; font-family: 'Inter', sans-serif; }
        
        /* Modern Card Styling */
        .admin-card {
            background: white;
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            margin-bottom: 30px;
        }
        .card-header-custom {
            background: #ffffff;
            padding: 20px 30px;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-header-custom h5 { margin: 0; font-weight: 700; color: #111827; }
        
        /* Form Elements */
        .form-label { font-weight: 600; font-size: 0.9rem; color: #374151; margin-bottom: 8px; }
        .form-control {
            border-radius: 8px;
            border: 1px solid #d1d5db;
            padding: 10px 15px;
            font-size: 0.95rem;
        }
        .form-control:focus { border-color: #f59e0b; box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1); }
        
        .btn-primary {
            background-color: #0f172a;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
        }
        .btn-primary:hover { background-color: #1e293b; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark" style="background: #0f172a; padding: 15px 0;">
    <div class="container">
        <a class="navbar-brand fw-bold" href="manage_team.php">
            <i class="fa-solid fa-feather-pointed text-warning me-2"></i> SoW!SE <span class="text-warning">Admin</span>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="adminNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-white" href="manage_team.php">Team</a>
                </li>
                </ul>
            
            <div class="d-flex gap-2">
                <a href="../index.php" target="_blank" class="btn btn-sm btn-outline-light">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i> View Website
                </a>
                <a href="logout.php" class="btn btn-sm btn-danger">
                    <i class="fa-solid fa-power-off"></i> Logout
                </a>
            </div>
        </div>
    </div>
</nav>

<div class="container py-5"></div>