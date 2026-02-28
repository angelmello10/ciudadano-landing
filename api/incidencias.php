<?php
// api/incidencias.php
// GET  /api/incidencias.php          → lista paginada
// GET  /api/incidencias.php?limit=10 → con límite
// POST /api/incidencias.php          → crear nueva incidencia
require_once __DIR__ . '/config.php';

try {
    $db = getDB();

    // ── GET ──────────────────────────────────────────────
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $limit  = min(100, max(1, (int)($_GET['limit']  ?? 100)));
        $offset = max(0,            (int)($_GET['offset'] ?? 0));

        $stmt = $db->prepare(
            'SELECT * FROM `' . DB_TABLE . '` ORDER BY id DESC LIMIT :lim OFFSET :off'
        );
        $stmt->bindValue(':lim',  $limit,  PDO::PARAM_INT);
        $stmt->bindValue(':off',  $offset, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll();

        echo json_encode(['ok' => true, 'count' => count($rows), 'rows' => $rows]);
        exit;
    }

    // ── POST ─────────────────────────────────────────────
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $body = json_decode(file_get_contents('php://input'), true) ?? [];

        $nombre_ciudadano = $body['nombre_ciudadano'] ?? null;
        $email            = $body['email']            ?? null;
        $direccion        = $body['direccion']        ?? null;
        $latitud          = isset($body['latitud'])  && $body['latitud']  !== null ? (float)$body['latitud']  : null;
        $longitud         = isset($body['longitud']) && $body['longitud'] !== null ? (float)$body['longitud'] : null;
        $tipo_incidencia  = $body['tipo_incidencia'] ?? null;
        $descripcion      = $body['descripcion']     ?? null;
        $estatus          = $body['estatus']         ?? 'pendiente';

        // ── Guardar foto si viene en base64 ─────────────
        $fotoFileName = null;
        $foto = $body['foto'] ?? null;
        if ($foto && str_starts_with($foto, 'data:')) {
            if (!is_dir(UPLOADS_DIR)) mkdir(UPLOADS_DIR, 0755, true);

            preg_match('/^data:(image\/(png|jpe?g));base64,(.+)$/', $foto, $m);
            $ext      = ($m[2] ?? 'jpg') === 'jpeg' ? 'jpg' : ($m[2] ?? 'jpg');
            $b64data  = $m[3] ?? explode(',', $foto)[1] ?? '';
            $binary   = base64_decode($b64data);
            $fotoFileName = 'inc_' . time() . '_' . rand(1000,9999) . '.' . $ext;
            file_put_contents(UPLOADS_DIR . $fotoFileName, $binary);
        }

        $sql = 'INSERT INTO `' . DB_TABLE . '`
                    (nombre_ciudadano, email, direccion, latitud, longitud,
                     tipo_incidencia, descripcion, estatus, foto, created_at, updated_at)
                VALUES
                    (:nom, :email, :dir, :lat, :lng,
                     :tipo, :desc, :est, :foto, NOW(), NOW())';

        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':nom'   => $nombre_ciudadano,
            ':email' => $email,
            ':dir'   => $direccion,
            ':lat'   => $latitud,
            ':lng'   => $longitud,
            ':tipo'  => $tipo_incidencia,
            ':desc'  => $descripcion,
            ':est'   => $estatus,
            ':foto'  => $fotoFileName,
        ]);

        $id = (int)$db->lastInsertId();
        $row = $db->query('SELECT * FROM `' . DB_TABLE . '` WHERE id = ' . $id)->fetch();

        echo json_encode(['ok' => true, 'id' => $id, 'row' => $row]);
        exit;
    }

    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Método no permitido']);

} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => $e->getMessage()]);
}
