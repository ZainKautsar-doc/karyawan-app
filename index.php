<?php
$base_dir = '';
require $base_dir . 'auth.php';
require $base_dir . 'koneksi.php';

# hitung statistik
$totalKaryawan = $pdo->query("SELECT COUNT(*) FROM karyawan")->fetchColumn();
$totalDepartemen = $pdo->query("SELECT COUNT(*) FROM departemen")->fetchColumn();
$totalJabatan = $pdo->query("SELECT COUNT(*) FROM jabatan")->fetchColumn();

require $base_dir . 'layout_header.php';
?>

<div class="card">
    <h3 class="section-title">Dashboard Overview</h3>
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-value"><?= $totalKaryawan ?></div>
            <div class="stat-label">Total Karyawan</div>
        </div>
        <div class="stat-card">
            <div class="stat-value"><?= $totalDepartemen ?></div>
            <div class="stat-label">Total Departemen</div>
        </div>
        <div class="stat-card">
            <div class="stat-value"><?= $totalJabatan ?></div>
            <div class="stat-label">Total Jabatan</div>
        </div>
    </div>
</div>

<div class="card">
    <h3 class="section-title">Menu Utama</h3>
    <div class="menu-grid">
        <a href="karyawan/list.php" class="menu-card">
            <i data-lucide="users" style="width: 24px; height: 24px; margin-right: 0.5rem;"></i> Data Karyawan
        </a>
        <a href="departemen/list.php" class="menu-card">
            <i data-lucide="building-2" style="width: 24px; height: 24px; margin-right: 0.5rem;"></i> Departemen
        </a>
        <a href="jabatan/list.php" class="menu-card">
            <i data-lucide="briefcase" style="width: 24px; height: 24px; margin-right: 0.5rem;"></i> Jabatan
        </a>
    </div>
</div>

<script>
    // Set active link in sidebar
    document.querySelectorAll('.nav-link').forEach(link => {
        if (link.getAttribute('href').endsWith('index.php') && !link.classList.contains('text-danger')) {
            link.classList.add('active');
        }
    });
</script>

<?php require $base_dir . 'layout_footer.php'; ?>