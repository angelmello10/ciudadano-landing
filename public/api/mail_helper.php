<?php
/**
 * mail_helper.php — Envía correos de notificación al ciudadano
 * Usa mail() nativo de PHP (funciona directo en Hostinger).
 */

define('MAIL_FROM_NAME',  'Reportes Ciudadanos');
define('MAIL_FROM_EMAIL', 'sigiu@reporteurbano.com'); // El hosting inyecta su dominio real

/**
 * Envía email de confirmación cuando se crea un reporte.
 */
function enviarCorreoConfirmacion(array $inc): bool {
    $to = $inc['email'] ?? null;
    if (!$to || !filter_var($to, FILTER_VALIDATE_EMAIL)) return false;

    $nombre = htmlspecialchars($inc['nombre_ciudadano'] ?? 'Ciudadano');
    $folio  = (int)($inc['id'] ?? 0);
    $tipo   = htmlspecialchars($inc['tipo_incidencia'] ?? 'No especificado');
    $dir    = htmlspecialchars($inc['direccion'] ?? 'No especificada');
    $desc   = htmlspecialchars($inc['descripcion'] ?? 'Sin descripción');
    $status = htmlspecialchars($inc['estatus'] ?? 'pendiente');
    $fecha  = date('d/m/Y H:i');

    $statusColor = '#f59e0b'; // amarillo por defecto (pendiente)
    $statusLabel = ucfirst($status);
    if (stripos($status, 'proceso') !== false || stripos($status, 'activo') !== false) {
        $statusColor = '#3b82f6';
    } elseif (stripos($status, 'resuelto') !== false) {
        $statusColor = '#22c55e';
    } elseif (stripos($status, 'rechaz') !== false) {
        $statusColor = '#ef4444';
    }

    // Determina asunto, cabecera y mensaje según estatus
    $statusLower = strtolower($status);
    if (stripos($statusLower, 'resuelto') !== false) {
        $subject = "Reporte #{$folio} — Resuelto";
        $headerGradient = 'linear-gradient(135deg,#16a34a 0%,#34d399 100%)';
        $title = 'Reporte Resuelto';
        $lead  = 'Tu reporte ha sido marcado como resuelto.';
    } elseif (stripos($statusLower, 'proceso') !== false || stripos($statusLower, 'activo') !== false) {
        $subject = "Reporte #{$folio} — En proceso";
        $headerGradient = 'linear-gradient(135deg,#0ea5e9 0%,#60a5fa 100%)';
        $title = 'En Proceso';
        $lead  = 'Tu reporte está siendo atendido por el equipo responsable.';
    } elseif (stripos($statusLower, 'rechaz') !== false) {
        $subject = "Reporte #{$folio} — Rechazado";
        $headerGradient = 'linear-gradient(135deg,#ef4444 0%,#f97316 100%)';
        $title = 'Reporte Rechazado';
        $lead  = 'Lamentablemente tu reporte fue rechazado. Revisa los detalles.';
    } else {
        $subject = "Reporte #{$folio} registrado — Reportes Ciudadanos";
        $headerGradient = 'linear-gradient(135deg,#9D1B32 0%,#c42845 100%)';
        $title = 'Reporte Registrado';
        $lead  = 'Tu incidencia ha sido recibida exitosamente.';
    }

    $html = <<<HTML
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"></head>
<body style="margin:0;padding:0;background:#f0f3f8;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f0f3f8;padding:32px 16px;">
<tr><td align="center">
<table width="560" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.08);">

    <!-- Header -->
    <tr>
        <td style="background:{$headerGradient};padding:28px 32px;text-align:center;">
            <div style="font-size:28px;margin-bottom:6px;">🛡️</div>
            <h1 style="margin:0;color:#ffffff;font-size:20px;font-weight:700;">{$title}</h1>
            <p style="margin:6px 0 0;color:rgba(255,255,255,0.8);font-size:13px;">{$lead}</p>
        </td>
    </tr>

    <!-- Body -->
    <tr>
        <td style="padding:28px 32px;">
            <p style="margin:0 0 18px;color:#334155;font-size:15px;line-height:1.5;">
                Hola <strong>{$nombre}</strong>,<br>
                Aquí están los detalles del reporte:
            </p>

            <!-- Folio badge -->
            <div style="text-align:center;margin:20px 0;">
                <span style="display:inline-block;background:#f8fafc;border:2px solid #e2e8f0;border-radius:12px;padding:12px 28px;font-size:26px;font-weight:800;color:#9D1B32;letter-spacing:1px;">
                    #{$folio}
                </span>
            </div>

            <!-- Info card -->
            <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8fafc;border-radius:12px;border:1px solid #e2e8f0;margin:20px 0;">
                <tr>
                    <td style="padding:18px 20px;">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="padding:6px 0;color:#64748b;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Tipo de falla</td>
                                <td style="padding:6px 0;color:#0f172a;font-size:14px;font-weight:600;text-align:right;">{$tipo}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="border-bottom:1px solid #e2e8f0;padding:0;height:1px;"></td>
                            </tr>
                            <tr>
                                <td style="padding:6px 0;color:#64748b;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Ubicación</td>
                                <td style="padding:6px 0;color:#0f172a;font-size:14px;text-align:right;">{$dir}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="border-bottom:1px solid #e2e8f0;padding:0;height:1px;"></td>
                            </tr>
                            <tr>
                                <td style="padding:6px 0;color:#64748b;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Descripción</td>
                                <td style="padding:6px 0;color:#0f172a;font-size:14px;text-align:right;">{$desc}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="border-bottom:1px solid #e2e8f0;padding:0;height:1px;"></td>
                            </tr>
                            <tr>
                                <td style="padding:6px 0;color:#64748b;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Fecha</td>
                                <td style="padding:6px 0;color:#0f172a;font-size:14px;text-align:right;">{$fecha}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="border-bottom:1px solid #e2e8f0;padding:0;height:1px;"></td>
                            </tr>
                            <tr>
                                <td style="padding:8px 0;color:#64748b;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Estatus</td>
                                <td style="padding:8px 0;text-align:right;">
                                    <span style="display:inline-block;background:{$statusColor};color:#fff;padding:4px 14px;border-radius:20px;font-size:12px;font-weight:700;">
                                        {$statusLabel}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <p style="margin:18px 0 0;color:#64748b;font-size:13px;line-height:1.5;text-align:center;">
                Guarda tu número de folio <strong>#{$folio}</strong> para consultar el avance de tu reporte en cualquier momento.
            </p>
        </td>
    </tr>

    <!-- Footer -->
    <tr>
        <td style="background:#f8fafc;border-top:1px solid #e2e8f0;padding:18px 32px;text-align:center;">
            <p style="margin:0;color:#94a3b8;font-size:11px;">
                Este es un correo automático de Reportes Ciudadanos.<br>
                No responder a este correo.
            </p>
        </td>
    </tr>

</table>
</td></tr>
</table>
</body>
</html>
HTML;

    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "From: " . MAIL_FROM_NAME . " <" . MAIL_FROM_EMAIL . ">\r\n";
    $headers .= "Reply-To: " . MAIL_FROM_EMAIL . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

    $sent = false;
    try {
        $sent = (bool) @mail($to, $subject, $html, $headers);
    } catch (Throwable $e) {
        $sent = false;
    }

    // Logging simple send attempts for debugging (no sensitive data)
    $logDir = __DIR__ . '/../../logs';
    if (!is_dir($logDir)) @mkdir($logDir, 0755, true);
    $logFile = $logDir . '/mail.log';
    $now = date('Y-m-d H:i:s');
    $entry = sprintf("%s\tID:%s\tTO:%s\tSUBJECT:%s\tSENT:%s\n", $now, $folio, $to, str_replace("\n", ' ', $subject), $sent ? 'OK' : 'FAIL');
    @file_put_contents($logFile, $entry, FILE_APPEND | LOCK_EX);

    return $sent;
}
