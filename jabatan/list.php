<?php
$base_dir = '../';
require $base_dir . 'auth.php';
require $base_dir . 'koneksi.php';

$data = $pdo->query("SELECT * FROM jabatan ORDER BY nama_jabatan")->fetchAll();

require $base_dir . 'layout_header.php';
?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2 class="page-title" style="margin-bottom: 0;">Data Jabatan</h2>
        <a href="tambah.php" class="btn btn-primary"><i data-lucide="plus"></i> Tambah Jabatan</a>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Jabatan</th>
                    <th>Gaji Pokok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($data as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['nama_jabatan']) ?></td>
                    <td>Rp <?= number_format($row['gaji_pokok']) ?></td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-success">
                                <i data-lucide="edit-2"></i> Edit
                            </a>
                            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus jabatan?')">
                                <i data-lucide="trash-2"></i> Hapus
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if(count($data) === 0): ?>
                <tr>
                    <td colspan="4" style="text-align: center;">Tidak ada data jabatan.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.querySelectorAll('.nav-link').forEach(link => {
        if (link.getAttribute('href').includes('jabatan/list.php')) {
            link.classList.add('active');
        }
    });
</script>

<?php require $base_dir . 'layout_footer.php'; ?>