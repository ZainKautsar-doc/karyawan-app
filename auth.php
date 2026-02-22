<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: " . $base_dir . "login.php");
    exit;
}
?>
