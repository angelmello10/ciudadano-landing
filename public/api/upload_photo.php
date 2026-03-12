<?php
// api/upload_photo.php
// POST /api/upload_photo.php  → recibe foto desde Railway (admin panel)
// Parámetros:
//   - foto: archivo multipart/form-data
//   - incidencia_id: ID de la incidencia
//   - api_key: clave secreta para autenticación
//   - tipo: 'antes' o 'despues' (default: 'despues')

require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Método no permitido']);
    exit;
}

// Validar API key
$apiKey = $_POST['api_key'] ?? $_SERVER['HTTP_X_API_KEY'] ?? '';
if (!defined('API_KEY') || $apiKey !== API_KEY) {
    http_response_code(403);
    echo json_encode(['ok' => false, 'error' => 'API key inválida']);
    exit;
}

$incidenciaId = (int)($_POST['incidencia_id'] ?? 0);
if ($incidenciaId < 1) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'incidencia_id requerido']);
    exit;
}

// Validar que la incidencia existe
try {
    $db = getDB();
    $stmt = $db->prepare('SELECT id FROM `' . DB_TABLE . '` WHERE id = :id LIMIT 1');
    $stmt->execute([':id' => $incidenciaId]);
    $row = $stmt->fetch();
    
    if (!$row) {
        http_response_code(404);
        echo json_encode(['ok' => false, 'error' => 'Incidencia no encontrada']);
        exit;
    }
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'Error al validar incidencia: ' . $e->getMessage()]);
    exit;
}

// Procesar archivo
if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'No se recibió archivo válido']);
    exit;
}

$file = $_FILES['foto'];
$allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mimeType = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);

if (!in_array($mimeType, $allowedTypes)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Tipo de archivo no permitido. Solo JPG/PNG']);
    exit;
}

// Max 5MB
if ($file['size'] > 5 * 1024 * 1024) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Archivo muy grande. Max 5MB']);
    exit;
}

// Crear directorio si no existe
if (!is_dir(UPLOADS_DIR)) {
    mkdir(UPLOADS_DIR, 0755, true);
}

// Generar nombre único
$ext = $mimeType === 'image/png' ? 'png' : 'jpg';
$tipo = $_POST['tipo'] ?? 'despues';
$prefix = $tipo === 'antes' ? 'inc_' : 'inc_desp_';
$fileName = $prefix . time() . '_' . rand(1000, 9999) . '.' . $ext;
$filePath = UPLOADS_DIR . $fileName;

// Guardar archivo
if (!move_uploaded_file($file['tmp_name'], $filePath)) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'Error al guardar archivo']);
    exit;
}

// Actualizar DB
try {
    $column = $tipo === 'antes' ? 'foto' : 'foto_despues';
    $sql = "UPDATE `" . DB_TABLE . "` SET `$column` = :foto, updated_at = NOW() WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':foto' => $fileName,
        ':id' => $incidenciaId
    ]);
    
    echo json_encode([
        'ok' => true,
        'incidencia_id' => $incidenciaId,
        'filename' => $fileName,
        'url' => UPLOADS_URL . $fileName,
        'tipo' => $tipo
    ]);
    
} catch (Throwable $e) {
    // Si falla la actualización en DB, borra el archivo
    if (file_exists($filePath)) {
        unlink($filePath);
    }
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'Error al actualizar DB: ' . $e->getMessage()]);
}
