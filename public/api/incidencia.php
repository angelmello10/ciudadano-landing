<?php
// api/incidencia.php
// GET /api/incidencia.php?id=4  → detalle de una incidencia por ID
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Método no permitido']);
    exit;
}

$id = (int)($_GET['id'] ?? 0);
if ($id < 1) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'ID inválido']);
    exit;
}

try {
    $db   = getDB();
    $stmt = $db->prepare('SELECT * FROM `' . DB_TABLE . '` WHERE id = :id LIMIT 1');
    $stmt->execute([':id' => $id]);
    $row  = $stmt->fetch();

    if (!$row) {
        http_response_code(404);
        echo json_encode(['ok' => false, 'error' => 'Incidencia no encontrada']);
        exit;
    }

    echo json_encode(['ok' => true, 'row' => $row]);

} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => $e->getMessage()]);
}
