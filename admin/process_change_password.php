<?php
session_start();
require_once('../config/database.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    $stmt = $pdo->prepare("SELECT password FROM admin WHERE username = ?");
    $stmt->execute([$_SESSION['username']]);
    $user = $stmt->fetch();
    
    if (!$user || $user['password'] != $old_password) {
        $_SESSION['error'] = "Password lama tidak sesuai!";
        header("Location: change_password.php");
        exit();
    }
    
    if ($new_password != $confirm_password) {
        $_SESSION['error'] = "Password baru tidak cocok!";
        header("Location: change_password.php");
        exit();
    }
    
    $stmt = $pdo->prepare("UPDATE admin SET password = ? WHERE username = ?");
    $stmt->execute([$new_password, $_SESSION['username']]);
    
    $_SESSION['success'] = "Password berhasil diubah!";
    header("Location: dashboard.php");
    exit();
}