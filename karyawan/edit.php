<?php
$base_dir = '../';
require $base_dir . 'auth.php';
require $base_dir . 'koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) die("ID tidak ditemukan");

# ambil data karyawan
$stmt = $pdo->prepare("SELECT * FROM karyawan WHERE id=?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if (!$data) die("Data tidak ada");

# proses update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $jk = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $departemen = $_POST['departemen'];
    $jabatan = $_POST['jabatan'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $status = $_POST['status'];

    $foto = $data['foto'];

    # jika upload foto baru
    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], "../uploads/" . $foto);
    }

    $sql = "UPDATE karyawan SET
        nik=?,
        nama=?,
        jenis_kelamin=?,
        tempat_lahir=?,
        tanggal_lahir=?,
        alamat=?,
        no_hp=?,
        email=?,
        departemen_id=?,
        jabatan_id=?,
        tanggal_masuk=?,
        status_kerja=?,
        foto=?
        WHERE id=?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $nik,
        $nama,
        $jk,
        $tempat_lahir,
        $tanggal_lahir,
        $alamat,
        $no_hp,
        $email,
        $departemen,
        $jabatan,
        $tanggal_masuk,
        $status,
        $foto,
        $id
    ]);

    header("Location: list.php");
    exit;
}

# ambil dropdown
$departemen = $pdo->query("SELECT * FROM departemen")->fetchAll();
$jabatan = $pdo->query("SELECT * FROM jabatan")->fetchAll();

require $base_dir . 'layout_header.php';
?>

<div class="card" style="max-width: 900px; margin: 0 auto;">
    <h2 class="page-title" style="text-align: left; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem; margin-bottom: 1.5rem;">Edit Karyawan</h2>

    <form method="post" enctype="multipart/form-data">

        <div class="detail-grid">

            <!-- KOLOM KIRI -->
            <div>

                <div class="form-group">
                    <label>NIK</label>
                    <input type="text" name="nik" class="form-control"
                           value="<?= htmlspecialchars($data['nik']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control"
                           value="<?= htmlspecialchars($data['nama']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                        <option value="">-</option>
                        <option value="L" <?= $data['jenis_kelamin']=='L'?'selected':'' ?>>Laki-laki</option>
                        <option value="P" <?= $data['jenis_kelamin']=='P'?'selected':'' ?>>Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control"
                           value="<?= htmlspecialchars($data['tempat_lahir']) ?>">
                </div>

                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control"
                           value="<?= $data['tanggal_lahir'] ?>">
                </div>

                <div class="form-group">
                    <label>No HP</label>
                    <input type="text" name="no_hp" class="form-control"
                           value="<?= htmlspecialchars($data['no_hp']) ?>">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control"
                           value="<?= htmlspecialchars($data['email']) ?>">
                </div>

            </div>

            <!-- KOLOM KANAN -->
            <div>

                <div class="form-group">
                    <label>Departemen</label>
                    <select name="departemen" class="form-control" required>
                    <?php foreach($departemen as $d): ?>
                    <option value="<?= $d['id'] ?>"
                        <?= $d['id']==$data['departemen_id']?'selected':'' ?>>
                        <?= htmlspecialchars($d['nama_departemen']) ?>
                    </option>
                    <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Jabatan</label>
                    <select name="jabatan" class="form-control" required>
                    <?php foreach($jabatan as $j): ?>
                    <option value="<?= $j['id'] ?>"
                        <?= $j['id']==$data['jabatan_id']?'selected':'' ?>>
                        <?= htmlspecialchars($j['nama_jabatan']) ?>
                    </option>
                    <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" class="form-control"
                           value="<?= $data['tanggal_masuk'] ?>">
                </div>

                <div class="form-group">
                    <label>Status Kerja</label>
                    <select name="status" class="form-control" required>
                        <option <?= $data['status_kerja']=='Tetap'?'selected':'' ?>>Tetap</option>
                        <option <?= $data['status_kerja']=='Kontrak'?'selected':'' ?>>Kontrak</option>
                        <option <?= $data['status_kerja']=='Magang'?'selected':'' ?>>Magang</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Foto Saat Ini</label>
                    <div style="margin-bottom: 0.5rem;">
                        <?php if($data['foto']): ?>
                            <img src="../uploads/<?= htmlspecialchars($data['foto']) ?>"
                                 width="80"
                                 style="border-radius: var(--radius);
                                        border: 1px solid var(--border-color);">
                        <?php else: ?>
                            <div style="width:80px;height:80px;
                                        background:var(--bg-color);
                                        border-radius:var(--radius);
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                        font-size:.75rem;
                                        color:var(--text-secondary);">
                                No Img
                            </div>
                        <?php endif; ?>
                    </div>

                    <label>Ganti Foto (Opsional)</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" rows="4"><?= htmlspecialchars($data['alamat']) ?></textarea>
                </div>

            </div>

        </div>

        <div class="d-flex gap-2"
             style="margin-top:1.5rem;padding-top:1rem;border-top:1px solid var(--border-color);">
            <button type="submit" class="btn btn-success">Update Data</button>
            <a href="list.php" class="btn btn-secondary">Batal</a>
        </div>

    </form>
</div>

<script>
    document.querySelectorAll('.nav-link').forEach(link => {
        if (link.getAttribute('href').includes('karyawan/list.php')) {
            link.classList.add('active');
        }
    });
</script>

<?php require $base_dir . 'layout_footer.php'; ?>