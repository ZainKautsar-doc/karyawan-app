<?php
$base_dir = '../';
require $base_dir . 'auth.php';
require $base_dir . 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect specific inputs ...
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

    $foto = $_FILES['foto']['name'];
    if ($foto) {
        $tmp = $_FILES['foto']['tmp_name'];
        move_uploaded_file($tmp, "../uploads/" . $foto);
    } else {
        $foto = "";
    }

    $sql = "INSERT INTO karyawan 
    (nik,nama,jenis_kelamin,tempat_lahir,tanggal_lahir,alamat,no_hp,email,
     departemen_id,jabatan_id,tanggal_masuk,status_kerja,foto)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";

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
        $foto
    ]);

    header("Location: list.php");
    exit;
}

require $base_dir . 'layout_header.php';
?>

<div class="card">
    <h2 class="page-title" style="text-align: left; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem; margin-bottom: 1.5rem;">Tambah Karyawan</h2>

    <form method="post" enctype="multipart/form-data">

        <div class="detail-grid">

            <!-- KOLOM KIRI -->
            <div>

                <div class="form-group">
                    <label>NIK</label>
                    <input type="text" name="nik" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                        <option value="">-</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control">
                </div>

                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control">
                </div>

                <div class="form-group">
                    <label>No HP</label>
                    <input type="text" name="no_hp" class="form-control">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                </div>

            </div>

            <!-- KOLOM KANAN -->
            <div>

                <div class="form-group">
                    <label>Departemen</label>
                    <select name="departemen" class="form-control" required>
                    <?php
                    $d = $pdo->query("SELECT * FROM departemen")->fetchAll();
                    foreach($d as $row){
                        echo "<option value='{$row['id']}'>".htmlspecialchars($row['nama_departemen'])."</option>";
                    }
                    ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Jabatan</label>
                    <select name="jabatan" class="form-control" required>
                    <?php
                    $j = $pdo->query("SELECT * FROM jabatan")->fetchAll();
                    foreach($j as $row){
                        echo "<option value='{$row['id']}'>".htmlspecialchars($row['nama_jabatan'])."</option>";
                    }
                    ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" class="form-control">
                </div>

                <div class="form-group">
                    <label>Status Kerja</label>
                    <select name="status" class="form-control" required>
                        <option>Tetap</option>
                        <option>Kontrak</option>
                        <option>Magang</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Foto Profil (Opsional)</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" rows="4"></textarea>
                </div>

            </div>

        </div>

        <div class="d-flex gap-2" style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--border-color);">
            <button type="submit" class="btn btn-primary">Simpan Data</button>
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