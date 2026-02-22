<?php
require '../koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) die("ID tidak ditemukan");

$stmt = $pdo->prepare("DELETE FROM departemen WHERE id=?");
$stmt->execute([$id]);

header("Location: list.php");
exit;