<?php
/**
 * mail_helper.php — Envía correos de notificación al ciudadano
 * Usa PHPMailer con SMTP para máxima fiabilidad (funciona en localhost y Hostinger).
 */

require_once __DIR__ . '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

define('MAIL_FROM_NAME', 'Reportes Ciudadanos');
define('MAIL_FROM_EMAIL', 'soporte@reporteurbano.site');

// --- Configuración SMTP (HOSTINGER) ---
define('SMTP_HOST', 'smtp.hostinger.com');
define('SMTP_USER', 'soporte@reporteurbano.site');
define('SMTP_PASS', 'V0mDCeU2vD+');
define('SMTP_PORT', 465);

/**
 * Envía email de confirmación usando PHPMailer (SMTP)
 */
function enviarCorreoConfirmacion(array $inc): bool
{
    $to = $inc['email'] ?? null;
    if (!$to || !filter_var($to, FILTER_VALIDATE_EMAIL))
        return false;

    $folio = (int)($inc['id'] ?? 0);
    $nombre = htmlspecialchars($inc['nombre_ciudadano'] ?? 'Ciudadano');
    $tipo = htmlspecialchars($inc['tipo_incidencia'] ?? 'No especificado');
    $dir = htmlspecialchars($inc['direccion'] ?? 'No especificada');
    $desc = htmlspecialchars($inc['descripcion'] ?? 'Sin descripción');
    $status = htmlspecialchars($inc['estatus'] ?? 'pendiente');
    $fecha = date('d/m/Y H:i');

    $statusColor = '#f59e0b';
    $statusLabel = ucfirst($status);
    if (stripos($status, 'proceso') !== false || stripos($status, 'activo') !== false) {
        $statusColor = '#3b82f6';
    }
    elseif (stripos($status, 'resuelto') !== false) {
        $statusColor = '#22c55e';
    }
    elseif (stripos($status, 'rechaz') !== false) {
        $statusColor = '#ef4444';
    }

    // Determina asunto y textos según estatus
    $statusLower = strtolower($status);
    if (stripos($statusLower, 'resuelto') !== false) {
        $subject = "Reporte #{$folio} — Resuelto";
        $headerGradient = 'linear-gradient(135deg,#16a34a 0%,#34d399 100%)';
        $title = 'Reporte Resuelto';
        $lead = 'Tu reporte ha sido marcado como resuelto.';
    }
    elseif (stripos($statusLower, 'proceso') !== false || stripos($statusLower, 'activo') !== false) {
        $subject = "Reporte #{$folio} — En proceso";
        $headerGradient = 'linear-gradient(135deg,#0ea5e9 0%,#60a5fa 100%)';
        $title = 'En Proceso';
        $lead = 'Tu reporte está siendo atendido por el equipo responsable.';
    }
    elseif (stripos($statusLower, 'rechaz') !== false) {
        $subject = "Reporte #{$folio} — Rechazado";
        $headerGradient = 'linear-gradient(135deg,#ef4444 0%,#f97316 100%)';
        $title = 'Reporte Rechazado';
        $lead = 'Lamentablemente tu reporte fue rechazado.';
    }
    else {
        $subject = "Reporte #{$folio} registrado — Reportes Ciudadanos";
        $headerGradient = 'linear-gradient(135deg,#9D1B32 0%,#c42845 100%)';
        $title = 'Reporte Registrado';
        $lead = 'Tu incidencia ha sido recibida exitosamente.';
    }

    $mail = new PHPMailer(true);

    try {
        // Configuraciones de Servidor SMTP
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USER;
        $mail->Password = SMTP_PASS;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = SMTP_PORT;
        $mail->CharSet = 'UTF-8';

        // Remitente y Destinatario
        $mail->setFrom(MAIL_FROM_EMAIL, MAIL_FROM_NAME);
        $mail->addAddress($to, $nombre);
        $mail->addReplyTo(MAIL_FROM_EMAIL, MAIL_FROM_NAME);

        // Contenido del Email
        $mail->isHTML(true);
        $mail->Subject = $subject;

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
            <p style="margin:0 0 18px;color:#334155;font-size:15px;line-height:1.5;">Hola <strong>{$nombre}</strong>,<br>Aquí los detalles del reporte:</p>
            <div style="text-align:center;margin:20px 0;"><span style="display:inline-block;background:#f8fafc;border:2px solid #e2e8f0;border-radius:12px;padding:12px 28px;font-size:26px;font-weight:800;color:#9D1B32;letter-spacing:1px;">#{$folio}</span></div>
            
            <table width="100%" style="background:#f8fafc;border-radius:12px;border:1px solid #e2e8f0;margin:20px 0;">
                <tr>
                    <td style="padding:18px 20px;">
                        <table width="100%">
                            <tr><td style="color:#64748b;font-size:12px;font-weight:600;text-transform:uppercase;">Tipo</td><td style="color:#0f172a;font-size:14px;font-weight:600;text-align:right;">{$tipo}</td></tr>
                            <tr><td style="color:#64748b;font-size:12px;font-weight:600;text-transform:uppercase;">Ubicación</td><td style="color:#0f172a;font-size:14px;text-align:right;">{$dir}</td></tr>
                            <tr><td style="color:#64748b;font-size:12px;font-weight:600;text-transform:uppercase;">Descripción</td><td style="color:#0f172a;font-size:14px;text-align:right;">{$desc}</td></tr>
                            <tr><td style="color:#64748b;font-size:12px;font-weight:600;text-transform:uppercase;">Fecha</td><td style="color:#0f172a;font-size:14px;text-align:right;">{$fecha}</td></tr>
                            <tr><td style="color:#64748b;font-size:12px;font-weight:600;text-transform:uppercase;">Estatus</td><td style="text-align:right;"><span style="background:{$statusColor};color:#fff;padding:4px 14px;border-radius:20px;font-size:11px;font-weight:700;">{$statusLabel}</span></td></tr>
                        </table>
                    </td>
                </tr>
            </table>
            <p style="margin:18px 0 0;color:#64748b;font-size:11px;text-align:center;">Guarda tu número de folio para consultas futuras.</p>
        </td>
    </tr>

    <!-- Footer -->
    <tr><td style="background:#f8fafc;padding:18px;text-align:center;font-size:10px;color:#94a3b8;">Sistema de Reportes Ciudadanos - noreply@reporteurbano.site</td></tr>
</table>
</td></tr>
</table>
</body>
</html>
HTML;

        $mail->Body = $html;
        $mail->AltBody = "Reporte #{$folio} Registrado. Tipo: {$tipo}, Estatus: {$statusLabel}, Ubicación: {$dir}";

        $sent = $mail->send();
    }
    catch (Exception $e) {
        $sent = false;
        error_log("PHPMailer Error: " . $mail->ErrorInfo);
    }

    // Logging detallado
    $logDir = __DIR__ . '/../../logs';
    if (!is_dir($logDir))
        @mkdir($logDir, 0755, true);
    $logFile = $logDir . '/mail.log';
    $now = date('Y-m-d H:i:s');
    $statusMsg = $sent ? 'OK' : 'FAIL';
    $errorInfo = !$sent ? ' | Error: ' . ($mail->ErrorInfo ?? 'Unknown') : '';
    $entry = sprintf("[%s] Folio:#%s | To:%s | Result:%s | Env:SMTP%s\n", $now, $folio, $to, $statusMsg, $errorInfo);
    @file_put_contents($logFile, $entry, FILE_APPEND | LOCK_EX);

    return $sent;
}
