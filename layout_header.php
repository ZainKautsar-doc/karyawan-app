<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Karyawan</title>
    <link rel="stylesheet" href="<?= $base_dir ?>style.css">
</head>
<body>
    <div class="admin-layout">
        
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <span class="logo-icon">A</span> ADMIN
                </div>
                <div class="sidebar-user">
                    <div class="user-avatar">
                        <img src="<?= $base_dir ?>uploads/default_avatar.png" alt="Admin" onerror="this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'%23a1a1aa\'><path d=\'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z\'/></svg>'">
                    </div>
                    <div class="user-info">
                        <div class="user-name"><?= htmlspecialchars($_SESSION['admin_username']) ?></div>
                    </div>
                </div>
            </div>
            
            <ul class="sidebar-nav">
                <li class="nav-item">
                    <a href="<?= $base_dir ?>index.php" class="nav-link">
                        <span class="nav-icon">📊</span> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $base_dir ?>karyawan/list.php" class="nav-link">
                        <span class="nav-icon">👥</span> Pegawai
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $base_dir ?>departemen/list.php" class="nav-link">
                        <span class="nav-icon">🏢</span> Departemen
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $base_dir ?>jabatan/list.php" class="nav-link">
                        <span class="nav-icon">⭐</span> Jabatan
                    </a>
                </li>
                <li class="nav-item" style="margin-top: auto; border-top: 1px solid #374151; padding-top: 0.5rem;">
                    <a href="<?= $base_dir ?>logout.php" class="nav-link text-danger">
                        <span class="nav-icon">🚪</span> Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content Wrapper -->
        <div class="main-content">
            
            <!-- Topbar -->
            <div class="topbar">
                <div class="menu-toggle">
                    <span>☰</span>
                </div>
                <div class="topbar-title">Sistem Informasi Pegawai</div>
                <div class="topbar-right">
                    <a href="<?= $base_dir ?>index.php">Home</a>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content-area">
