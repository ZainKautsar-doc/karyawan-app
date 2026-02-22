<?php
$base_dir = '../';
require $base_dir . 'auth.php';
require $base_dir . 'koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) die("ID tidak ditemukan");

$stmt = $pdo->prepare("SELECT * FROM departemen WHERE id=?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if (!$data) die("Data tidak ada");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];

    $stmt = $pdo->prepare("UPDATE departemen SET nama_departemen=? WHERE id=?");
    $stmt->execute([$nama,$id]);

    header("Location: list.php");
    exit;
}

require $base_dir . 'layout_header.php';
?>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h2 class="page-title" style="text-align: left; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem;">Edit Departemen</h2>
    
    <form method="post" style="margin-top: 1.5rem;">
        <div class="form-group">
            <label>Nama Departemen</label>
            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama_departemen']) ?>" required autofocus>
        </div>
        
        <div class="d-flex gap-2" style="margin-top: 2rem;">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="list.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<script>
    document.querySelectorAll('.nav-link').forEach(link => {
        if (link.getAttribute('href').includes('departemen/list.php')) {
            link.classList.add('active');
        }
    });
</script>

<?php require $base_dir . 'layout_footer.php'; ?>