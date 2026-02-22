<?php
$base_dir = '../';
require $base_dir . 'auth.php';
require $base_dir . 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $gaji = $_POST['gaji'];

    $stmt = $pdo->prepare("INSERT INTO jabatan (nama_jabatan, gaji_pokok) VALUES (?,?)");
    $stmt->execute([$nama,$gaji]);

    header("Location: list.php");
    exit;
}

require $base_dir . 'layout_header.php';
?>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h2 class="page-title" style="text-align: left; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem;">Tambah Jabatan</h2>
    
    <form method="post" style="margin-top: 1.5rem;">
        <div class="form-group">
            <label>Nama Jabatan</label>
            <input type="text" name="nama" class="form-control" required autofocus>
        </div>
        
        <div class="form-group">
            <label>Gaji Pokok</label>
            <input type="number" name="gaji" class="form-control" required>
        </div>
        
        <div class="d-flex gap-2" style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="list.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<script>
    document.querySelectorAll('.nav-link').forEach(link => {
        if (link.getAttribute('href').includes('jabatan/list.php')) {
            link.classList.add('active');
        }
    });
</script>

<?php require $base_dir . 'layout_footer.php'; ?>