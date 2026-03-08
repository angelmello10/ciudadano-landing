<?php
// api/update_status.php
// POST /api/update_status.php  { id: 123, estatus: 'resuelto' }
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/mail_helper.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Método no permitido']);
    exit;
}

$body = json_decode(file_get_contents('php://input'), true) ?? [];
$id = isset($body['id']) ? (int)$body['id'] : 0;
$estatus = isset($body['estatus']) ? trim($body['estatus']) : null;

if ($id < 1 || !$estatus) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'ID o estatus inválido']);
    exit;
}

try {
    $db = getDB();
    $stmt = $db->prepare('UPDATE `' . DB_TABLE . '` SET estatus = :est, updated_at = NOW() WHERE id = :id');
    $stmt->execute([':est' => $estatus, ':id' => $id]);

    $row = $db->prepare('SELECT * FROM `' . DB_TABLE . '` WHERE id = :id LIMIT 1');
    $row->execute([':id' => $id]);
    $inc = $row->fetch();

    $emailSent = false;
    if ($inc && !empty($inc['email'])) {
        try {
            $emailSent = enviarCorreoConfirmacion($inc);
        } catch (Throwable $e) {
            $emailSent = false;
            error_log('Enviar correo error: ' . $e->getMessage());
        }
    }

    echo json_encode(['ok' => true, 'id' => $id, 'row' => $inc, 'email_sent' => $emailSent]);

} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => $e->getMessage()]);
}
