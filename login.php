<?php
session_start();
require 'koneksi.php';

if (isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];
        header("Location: index.php");
        exit;
    } else {
        $error = 'Username atau password salah!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Sistem Informasi Karyawan</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: var(--bg-color);
            margin: 0;
            padding: 1rem;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            background: var(--card-bg);
            padding: 2.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            text-align: center;
        }
        .login-logo {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }
        .login-subtitle {
            color: var(--text-secondary);
            margin-bottom: 2rem;
            font-size: 0.875rem;
        }
        .login-form {
            text-align: left;
        }
        .btn-block {
            width: 100%;
            justify-content: center;
            padding: 0.75rem;
            font-size: 1rem;
            margin-top: 1rem;
        }
        .alert-error {
            background-color: #fee2e2;
            color: #b91c1c;
            padding: 0.75rem;
            border-radius: var(--radius);
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            border: 1px solid #f87171;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-logo">ADMIN</div>
        <div class="login-subtitle">Sign in to your account</div>
        
        <?php if ($error): ?>
            <div class="alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" class="login-form">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required autofocus>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
    </div>
</body>
</html>
