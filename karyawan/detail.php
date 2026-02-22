<?php
$base_dir = '../';
require $base_dir . 'auth.php';
require $base_dir . 'koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) die("ID tidak ditemukan");

$sql = "
SELECT 
    k.*,
    d.nama_departemen,
    j.nama_jabatan,
    j.gaji_pokok
FROM karyawan k
LEFT JOIN departemen d ON k.departemen_id = d.id
LEFT JOIN jabatan j ON k.jabatan_id = j.id
WHERE k.id = ?
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$data = $stmt->fetch();

if (!$data) die("Data tidak ditemukan");

# hitung umur
$umur = '-';
if (!empty($data['tanggal_lahir'])) {
    $lahir = new DateTime($data['tanggal_lahir']);
    $sekarang = new DateTime();
    $umur = $sekarang->diff($lahir)->y . " tahun";
}

require $base_dir . 'layout_header.php';
?>

<div class="card" style="max-width: 900px; margin: 0 auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem;">
        <h2 class="page-title" style="margin-bottom: 0; text-align: left;">Profil Karyawan</h2>
        <div class="d-flex gap-2">
            <a href="edit.php?id=<?= $data['id'] ?>" class="btn btn-success">
                <i data-lucide="edit-2"></i> Edit
            </a>
            <a href="list.php" class="btn btn-outline"><i data-lucide="arrow-left"></i> Kembali</a>
        </div>
    </div>
    
    <div class="profile-header">
        <?php if($data['foto']): ?>
            <img src="../uploads/<?= htmlspecialchars($data['foto']) ?>" class="profile-avatar" alt="Foto Profil">
        <?php else: ?>
            <div class="profile-avatar" style="background-color: var(--bg-color); display: flex; align-items: center; justify-content: center; color: var(--text-secondary);">No Image</div>
        <?php endif; ?>
        
        <div class="profile-info">
            <h2><?= htmlspecialchars($data['nama']) ?></h2>
            <p><?= htmlspecialchars($data['nama_jabatan'] ?? 'Belum ada jabatan') ?> &bull; <?= htmlspecialchars($data['nama_departemen'] ?? 'Belum ada departemen') ?></p>
            <div style="margin-top: 0.5rem;">
                <?php
                $badgeClass = 'badge-secondary';
                if ($data['status_kerja'] == 'Tetap') $badgeClass = 'badge-success';
                elseif ($data['status_kerja'] == 'Kontrak') $badgeClass = 'badge-primary';
                ?>
                <span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($data['status_kerja']) ?></span>
            </div>
        </div>
    </div>

    <div class="detail-grid">
        <div class="detail-section">
            <h3>Data Pribadi</h3>
            <div class="detail-row">
                <div class="detail-label">NIK</div>
                <div class="detail-value"><?= htmlspecialchars($data['nik'] ?? '-') ?></div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Jenis Kelamin</div>
                <div class="detail-value"><?= !empty($data['jenis_kelamin']) ? ($data['jenis_kelamin']=='L'?'Laki-laki':'Perempuan') : '-' ?></div>
            </div>
            <div class="detail-row">
                <div class="detail-label">TTL</div>
                <div class="detail-value">
                    <?= htmlspecialchars($data['tempat_lahir'] ?? '-') ?><?= !empty($data['tanggal_lahir']) ? ', ' . htmlspecialchars($data['tanggal_lahir']) : '' ?>
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Umur</div>
                <div class="detail-value"><?= $umur ?></div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Telepon</div>
                <div class="detail-value"><?= htmlspecialchars($data['no_hp'] ?? '-') ?></div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Email</div>
                <div class="detail-value"><?= htmlspecialchars($data['email'] ?? '-') ?></div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Alamat</div>
                <div class="detail-value"><?= nl2br(htmlspecialchars($data['alamat'] ?? '-')) ?></div>
            </div>
        </div>

        <div class="detail-section">
            <h3>Data Pekerjaan</h3>
            <div class="detail-row">
                <div class="detail-label">Departemen</div>
                <div class="detail-value"><?= htmlspecialchars($data['nama_departemen'] ?? '-') ?></div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Jabatan</div>
                <div class="detail-value"><?= htmlspecialchars($data['nama_jabatan'] ?? '-') ?></div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Gaji Pokok</div>
                <div class="detail-value"><?= !empty($data['gaji_pokok']) ? 'Rp ' . number_format($data['gaji_pokok'], 0, ',', '.') : '-' ?></div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Status Kerja</div>
                <div class="detail-value"><?= htmlspecialchars($data['status_kerja'] ?? '-') ?></div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Tanggal Masuk</div>
                <div class="detail-value"><?= htmlspecialchars($data['tanggal_masuk'] ?? '-') ?></div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.nav-link').forEach(link => {
        if (link.getAttribute('href').includes('karyawan/list.php')) {
            link.classList.add('active');
        }
    });
</script>

<?php require $base_dir . 'layout_footer.php'; ?>