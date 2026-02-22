<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Karyawan</title>
    <link rel="stylesheet" href="<?= $base_dir ?>style.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    <div class="admin-layout">
        
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-brand">
                <div class="brand-avatar">
                    <i data-lucide="shield-check" style="color: white; width: 24px; height: 24px;"></i>
                </div>
                <div class="brand-info">
                    <div class="brand-title">Admin Panel</div>
                    <div class="brand-subtitle">
                        <span class="brand-user-name"><?= htmlspecialchars($_SESSION['admin_username']) ?></span> &bull; Administrator
                    </div>
                </div>
            </div>
            
            <ul class="sidebar-nav">
                <li class="nav-item">
                    <a href="<?= $base_dir ?>index.php" class="nav-link">
                        <i data-lucide="home" class="nav-icon" style="width: 20px; height: 20px;"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $base_dir ?>karyawan/list.php" class="nav-link">
                        <i data-lucide="users" class="nav-icon" style="width: 20px; height: 20px;"></i> Pegawai
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $base_dir ?>departemen/list.php" class="nav-link">
                        <i data-lucide="building-2" class="nav-icon" style="width: 20px; height: 20px;"></i> Departemen
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $base_dir ?>jabatan/list.php" class="nav-link">
                        <i data-lucide="briefcase" class="nav-icon" style="width: 20px; height: 20px;"></i> Jabatan
                    </a>
                </li>
                <li class="nav-item" style="margin-top: auto; border-top: 1px solid #374151; padding-top: 0.5rem;">
                    <a href="<?= $base_dir ?>logout.php" class="nav-link text-danger">
                        <i data-lucide="log-out" class="nav-icon" style="width: 20px; height: 20px;"></i> Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content Wrapper -->
        <div class="main-content">
            
            <!-- Topbar -->
            <div class="topbar">
                <div class="menu-toggle">
                    <i data-lucide="menu"></i>
                </div>
                <div class="topbar-title">Sistem Informasi Pegawai</div>
                <div class="topbar-right">
                    <a href="<?= $base_dir ?>index.php">Home</a>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content-area">
