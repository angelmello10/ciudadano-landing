<?php
// =============================================
//  CONFIGURACIÓN DE BASE DE DATOS — HOSTINGER
//  Cambia estos valores con los de tu panel de
//  Hostinger > Bases de datos > Detalles
// =============================================
define('DB_HOST',     'database-techti.cd2i6k8ukznv.us-east-2.rds.amazonaws.com');
define('DB_PORT',     3306);
define('DB_USER',     'adminAM');
define('DB_PASS',     'Mexico2026UTN');
define('DB_NAME',     'proyectoSocial');
define('DB_TABLE',    'incidencias');
define('UPLOADS_DIR', __DIR__ . '/../uploads/');
define('UPLOADS_URL', '/uploads/');

// =============================================
//  CABECERAS CORS — permite llamadas desde tu dominio
// =============================================
header('Content-Type: application/json; charset=utf-8');
$origin = $_SERVER['HTTP_ORIGIN'] ?? '*';
header("Access-Control-Allow-Origin: $origin");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// =============================================
//  FUNCIÓN: devuelve conexión PDO
// =============================================
function getDB(): PDO {
    static $pdo = null;
    if ($pdo) return $pdo;
    $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8mb4';
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    return $pdo;
}
