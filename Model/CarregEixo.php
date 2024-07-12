<?php

include_once '../Configuracao/connect.php';

try {
    // Fetch categories
    $stmt = $pdo->query("SELECT id, nome FROM eixo WHERE status_eixo = 1");
    $eixoFetch = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($eixoFetch);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}