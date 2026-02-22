<?php
$base_dir = '../';
require $base_dir . 'auth.php';
require $base_dir . 'koneksi.php';

$data = $pdo->query("SELECT * FROM departemen ORDER BY nama_departemen")->fetchAll();

require $base_dir . 'layout_header.php';
?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2 class="page-title" style="margin-bottom: 0;">Data Departemen</h2>
        <a href="tambah.php" class="btn btn-primary"><i data-lucide="plus"></i> Tambah Departemen</a>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Departemen</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($data as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['nama_departemen']) ?></td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-success">
                                <i data-lucide="edit-2"></i> Edit
                            </a>
                            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus departemen?')">
                                <i data-lucide="trash-2"></i> Hapus
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if(count($data) === 0): ?>
                <tr>
                    <td colspan="3" style="text-align: center;">Tidak ada data departemen.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.querySelectorAll('.nav-link').forEach(link => {
        if (link.getAttribute('href').includes('departemen/list.php')) {
            link.classList.add('active');
        }
    });
</script>

<?php require $base_dir . 'layout_footer.php'; ?>