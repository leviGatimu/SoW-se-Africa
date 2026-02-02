<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background-color: #f8fafc; font-family: 'Inter', sans-serif; }
        .dashboard-card {
            background: #fff; border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0; overflow: hidden; margin-bottom: 20px;
        }
        .card-header-modern {
            padding: 15px 20px; background: #fff; border-bottom: 1px solid #f1f5f9;
            font-weight: 700; color: #0f172a; display: flex; justify-content: space-between; align-items: center;
        }
        .form-control { border-radius: 8px; padding: 10px; border: 1px solid #cbd5e1; }
        .form-control:focus { border-color: #f59e0b; box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1); }
        .btn-primary { background: #0f172a; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; }
        .btn-primary:hover { background: #1e293b; }
        .table img { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; }
    </style>
</head>
<body>
<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">SoW!SE Admin</a>
        <a href="../index.php" target="_blank" class="btn btn-sm btn-outline-light">View Site</a>
    </div>
</nav>
<div class="container">