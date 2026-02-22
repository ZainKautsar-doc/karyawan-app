<?php
require 'koneksi.php';

try {
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS admin (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL
        )
    ");
    
    // Check if admin user exists
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM admin WHERE username = 'admin'");
    $stmt->execute();
    if ($stmt->fetchColumn() == 0) {
        $hash = password_hash('admin123', PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO admin (username, password) VALUES ('admin', ?)");
        $stmt->execute([$hash]);
        echo "Tabel admin berhasil dibuat dan user default (admin / admin123) berhasil ditambahkan.";
    } else {
        echo "Tabel admin sudah ada.";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
