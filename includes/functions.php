<?php
function calculateCertaintyFactor($rules, $userInputs) {
    $cfCombine = [];
    
    foreach ($rules as $rule) {
        $idPenyakit = $rule['id_penyakit'];
        $cfPakar = min(1.0, $rule['cf_pakar']); 
        $cfUser = $userInputs[$rule['id_gejala']] ?? 0;
        
        $cfHE = $cfPakar * $cfUser;
        
        if (!isset($cfCombine[$idPenyakit])) {
            $cfCombine[$idPenyakit] = $cfHE;
        } else {
            $cfCombine[$idPenyakit] = min(1.0, $cfCombine[$idPenyakit] + ($cfHE * (1 - $cfCombine[$idPenyakit])));
        }
    }
    foreach ($cfCombine as $key => $value) {
        $cfCombine[$key] = min(1.0, $value);
    }
    
    return $cfCombine;
}

function getPenyakitInfo($pdo, $idPenyakit) {
    $stmt = $pdo->prepare("
        SELECT p.id_penyakit, p.nama_penyakit, GROUP_CONCAT(s.solusi SEPARATOR '||') as solusi_list
        FROM penyakit p
        LEFT JOIN solusi s ON p.id_penyakit = s.id_penyakit
        WHERE p.id_penyakit = ?
        GROUP BY p.id_penyakit, p.nama_penyakit
    ");
    $stmt->execute([$idPenyakit]);
    return $stmt->fetch();
}

function getGejalaById($pdo, $idGejala) {
    $stmt = $pdo->prepare("SELECT * FROM gejala WHERE id_gejala = ?");
    $stmt->execute([$idGejala]);
    return $stmt->fetch();
}
?>