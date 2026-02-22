<?php
require '../koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) die("ID tidak ditemukan");

# ambil foto untuk dihapus dari folder
$stmt = $pdo->prepare("SELECT foto FROM karyawan WHERE id=?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if ($data && file_exists("../uploads/".$data['foto'])) {
    unlink("../uploads/".$data['foto']);
}

# hapus dari DB
$stmt = $pdo->prepare("DELETE FROM karyawan WHERE id=?");
$stmt->execute([$id]);

header("Location: list.php");
exit;