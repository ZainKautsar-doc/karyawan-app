<?php
$base_dir = '../';
require $base_dir . 'auth.php';
require $base_dir . 'koneksi.php';

$q = $_GET['q'] ?? '';
$status = $_GET['status'] ?? '';

$sql = "
SELECT 
    k.*, 
    d.nama_departemen, 
    j.nama_jabatan
FROM karyawan k
LEFT JOIN departemen d ON k.departemen_id = d.id
LEFT JOIN jabatan j ON k.jabatan_id = j.id
WHERE 1=1
";

$params = [];

if (!empty($q)) {
    $sql .= " AND (
        k.nama LIKE ? OR
        k.nik LIKE ? OR
        d.nama_departemen LIKE ? OR
        j.nama_jabatan LIKE ?
    )";
    $params = array_merge($params, ["%$q%","%$q%","%$q%","%$q%"]);
}

if (!empty($status)) {
    $sql .= " AND k.status_kerja = ?";
    $params[] = $status;
}

$sql .= " ORDER BY k.nama";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$data = $stmt->fetchAll();

require $base_dir . 'layout_header.php';
?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2 class="page-title" style="margin-bottom: 0;">Data Karyawan</h2>
        <a href="tambah.php" class="btn btn-primary"><i data-lucide="plus"></i> Tambah Karyawan</a>
    </div>

    <div class="search-bar-container">
        <form method="get" class="search-form-centered">
            <select name="status" class="form-control status-select">
                <option value="">Semua Status</option>
                <option value="Tetap" <?= $status === 'Tetap' ? 'selected' : '' ?>>Tetap</option>
                <option value="Kontrak" <?= $status === 'Kontrak' ? 'selected' : '' ?>>Kontrak</option>
                <option value="Magang" <?= $status === 'Magang' ? 'selected' : '' ?>>Magang</option>
            </select>
            <input type="text" name="q" class="form-control search-input" placeholder="Cari nama / NIK / departemen / jabatan" value="<?= htmlspecialchars($q) ?>">
            <button type="submit" class="btn btn-primary btn-search"><i data-lucide="search"></i> Cari</button>
            <?php if($q || $status): ?>
                <a href="list.php" class="btn btn-outline btn-reset" title="Reset Pencarian"><i data-lucide="rotate-ccw"></i></a>
            <?php endif; ?>
        </form>
    </div>
    
    <p style="margin-bottom: 1rem; color: var(--text-secondary); font-size: 0.875rem;">Ditemukan: <?= count($data) ?> data</p>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Departemen</th>
                    <th>Jabatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data as $row): ?>
                <tr>
                    <td>
                        <?php if($row['foto']): ?>
                            <img src="../uploads/<?= htmlspecialchars($row['foto']) ?>" class="avatar-sm" alt="Foto">
                        <?php else: ?>
                            <div class="avatar-sm" style="background-color: var(--border-color); display: flex; align-items: center; justify-content: center; color: var(--text-secondary); font-size: 0.75rem;">No Img</div>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($row['nik']) ?></td>
                    <td style="font-weight: 500; color: var(--text-primary);"><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= htmlspecialchars($row['nama_departemen']) ?></td>
                    <td><?= htmlspecialchars($row['nama_jabatan']) ?></td>
                    <td>
                        <?php
                        $badgeClass = 'badge-secondary';
                        if ($row['status_kerja'] == 'Tetap') $badgeClass = 'badge-success';
                        elseif ($row['status_kerja'] == 'Kontrak') $badgeClass = 'badge-primary';
                        ?>
                        <span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($row['status_kerja']) ?></span>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="detail.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-secondary">
                                <i data-lucide="eye"></i> Detail
                            </a>
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-success">
                                <i data-lucide="edit-2"></i> Edit
                            </a>
                            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus karyawan ini?')">
                                <i data-lucide="trash-2"></i> Hapus
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if(count($data) === 0): ?>
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data karyawan.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
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