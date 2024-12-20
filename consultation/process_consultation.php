<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once('../config/database.php');
require_once('../includes/functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $selectedGejala = $_POST['gejala'] ?? [];
    $activeGejala = array_filter($selectedGejala, function($value) {
        return $value > 0;
    });
    
    if (empty($activeGejala)) {
        $_SESSION['error'] = "Silakan pilih minimal satu gejala!";
        header("Location: index.php");
        exit();
    }
    
    $placeholders = str_repeat('?,', count(array_keys($activeGejala)) - 1) . '?';
    $stmt = $pdo->prepare("
        SELECT a.*, p.nama_penyakit 
        FROM aturan a
        JOIN penyakit p ON a.id_penyakit = p.id_penyakit
        WHERE a.id_gejala IN ($placeholders)
    ");
    $stmt->execute(array_keys($activeGejala));
    $rules = $stmt->fetchAll();
    
    $cfResults = calculateCertaintyFactor($rules, $activeGejala);
    
    if (empty($cfResults)) {
        $_SESSION['error'] = "Tidak dapat menentukan penyakit berdasarkan gejala yang dipilih.";
        header("Location: index.php");
        exit();
    }
    
    arsort($cfResults);
    $topDiseaseId = key($cfResults);
    $cfFinal = current($cfResults);
    
    try {
        $stmt = $pdo->prepare("
            INSERT INTO hasil_konsultasi (tanggal, id_penyakit, cf_hasil) 
            VALUES (NOW(), ?, ?)
        ");
        $stmt->execute([$topDiseaseId, $cfFinal]);
        $consultationId = $pdo->lastInsertId();
        
        foreach ($activeGejala as $gejalaId => $cfUser) {
            $stmt = $pdo->prepare("
                INSERT INTO input_gejala_user (id_konsultasi, id_gejala, cf_user) 
                VALUES (?, ?, ?)
            ");
            $stmt->execute([$consultationId, $gejalaId, $cfUser]);
        }
        
        $disease = getPenyakitInfo($pdo, $topDiseaseId);
        
        $_SESSION['consultation_result'] = [
            'id_penyakit' => $topDiseaseId,
            'nama_penyakit' => $disease['nama_penyakit'],
            'cf_hasil' => $cfFinal,
            'selected_gejala' => $activeGejala
        ];
        
        header("Location: result.php");
        exit();
        
    } catch (PDOException $e) {
        $_SESSION['error'] = "Terjadi kesalahan: " . $e->getMessage();
        header("Location: index.php");
        exit();
    }
}