<?php
session_start();
// Adjust path if your file is in a different folder
include '../includes/db_connect.php';

$error = "";

if(isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    // Note: In a real production app, use password_verify() and hash passwords
    $password = md5($_POST['password']); 

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1) {
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Incorrect username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SoW!SE Admin | Sign In</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="../assets/css/admin-style.css">
</head>
<body class="login-page">

    <div class="login-wrapper">
        <div class="login-card">
            
            <div class="login-header">
                <a href="../index.php" class="brand-logo">
                    SoW!SE <span class="text-accent">Manager</span>
                </a>
                <p>Welcome back. Please sign in to your dashboard.</p>
            </div>

            <?php if($error): ?>
                <div class="error-banner">
                    <i class="fa-solid fa-circle-exclamation"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="login-form">
                <div class="input-group">
                    <label>Username</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-user input-icon"></i>
                        <input type="text" name="username" placeholder="Enter username" required autofocus>
                    </div>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" name="password" placeholder="Enter password" required>
                    </div>
                </div>

                <button type="submit" name="login" class="btn-login">
                    Sign In <i class="fa-solid fa-arrow-right"></i>
                </button>
            </form>

            <div class="login-footer">
                <a href="../index.php" class="back-link">&larr; Back to SoW!SE Africa</a>
            </div>

        </div>
    </div>

</body>
</html>