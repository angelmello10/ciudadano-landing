<?php
// api/stats.php
// GET /api/stats.php  →  totales por estatus
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Método no permitido']);
    exit;
}

try {
    $db  = getDB();
    $sql = "SELECT
                COUNT(*) AS total,
                SUM(CASE WHEN LOWER(estatus) = 'resuelto'                              THEN 1 ELSE 0 END) AS resueltos,
                SUM(CASE WHEN LOWER(estatus) IN ('en proceso','activo','proceso')      THEN 1 ELSE 0 END) AS en_proceso,
                SUM(CASE WHEN LOWER(estatus) = 'pendiente'                             THEN 1 ELSE 0 END) AS pendientes
            FROM `" . DB_TABLE . "`";

    $row = $db->query($sql)->fetch();

    echo json_encode([
        'ok' => true,
        'stats' => [
            'total'      => (int)$row['total'],
            'resueltos'  => (int)$row['resueltos'],
            'en_proceso' => (int)$row['en_proceso'],
            'pendientes' => (int)$row['pendientes'],
        ]
    ]);

} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => $e->getMessage()]);
}
