# 🚀 Guía de Implementación para Railway

**Panel Admin**: https://incidencias-urbanas-production.up.railway.app/

## 📍 Ubicación

Encuentra el archivo en Railway donde el admin o trabajador sube la `foto_despues`. Probablemente esté en:
- `controllers/incidencias.php`
- `api/update_incidencia.php`
- `admin/incidencias/update.php`

## 🔧 Código a Agregar

Después de que la foto se guarde localmente en Railway, agrega esta función:

```php
<?php
/**
 * Sincroniza la foto_despues con el servidor de Hostinger
 * para que aparezca en el carrusel público
 */
function sincronizarFotoConHostinger($incidenciaId, $rutaArchivoLocal) {
    // URL del endpoint receptor en Hostinger
    $url = 'https://reporteurbano.site/public/api/upload_photo.php';
    
    // API Key (debe ser la misma que en config.php de Hostinger)
    $apiKey = 'tu_clave_secreta_aqui_' . md5('landingPage-railway-2026');
    
    // Verificar que el archivo existe
    if (!file_exists($rutaArchivoLocal)) {
        error_log("Foto no encontrada: $rutaArchivoLocal");
        return false;
    }
    
    // Preparar petición cURL
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => [
            'foto' => new CURLFile($rutaArchivoLocal),
            'incidencia_id' => $incidenciaId,
            'api_key' => $apiKey,
            'tipo' => 'despues'
        ],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYPEER => true
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    if ($httpCode === 200) {
        $data = json_decode($response, true);
        if ($data && isset($data['ok']) && $data['ok']) {
            error_log("Foto sincronizada con Hostinger: incidencia #$incidenciaId");
            return true;
        }
    }
    
    error_log("Error sincronizando foto (HTTP $httpCode): $error - $response");
    return false;
}
```

## 📝 Ejemplo de Uso

### Caso 1: Update de Incidencia

```php
// En tu controlador de actualización (ejemplo: update_incidencia.php)

if (isset($_FILES['foto_despues']) && $_FILES['foto_despues']['error'] === UPLOAD_ERR_OK) {
    $incidenciaId = (int)$_POST['id'];
    $uploadDir = __DIR__ . '/uploads/';
    
    // Crear directorio si no existe
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    // Guardar archivo localmente en Railway
    $extension = pathinfo($_FILES['foto_despues']['name'], PATHINFO_EXTENSION);
    $nombreArchivo = 'inc_desp_' . $incidenciaId . '_' . time() . '.' . $extension;
    $rutaLocal = $uploadDir . $nombreArchivo;
    
    if (move_uploaded_file($_FILES['foto_despues']['tmp_name'], $rutaLocal)) {
        // 1. Actualizar DB local (Railway)
        $stmt = $pdo->prepare("UPDATE incidencias SET foto_despues = ? WHERE id = ?");
        $stmt->execute([$nombreArchivo, $incidenciaId]);
        
        // 2. SINCRONIZAR CON HOSTINGER
        $sincronizado = sincronizarFotoConHostinger($incidenciaId, $rutaLocal);
        
        if ($sincronizado) {
            $_SESSION['mensaje'] = 'Foto actualizada y sincronizada con éxito';
        } else {
            $_SESSION['mensaje'] = 'Foto guardada localmente, pero no se pudo sincronizar con el carrusel público';
        }
    }
}
```

### Caso 2: API REST

```php
// En tu API endpoint (ejemplo: api/incidencias.php)

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $incidenciaId = (int)$_POST['id'];
    
    if (isset($_FILES['foto_despues'])) {
        $file = $_FILES['foto_despues'];
        $uploadDir = __DIR__ . '/../uploads/';
        $nombreArchivo = 'inc_desp_' . $incidenciaId . '_' . time() . '.jpg';
        $rutaLocal = $uploadDir . $nombreArchivo;
        
        if (move_uploaded_file($file['tmp_name'], $rutaLocal)) {
            // Actualizar DB
            $stmt = $pdo->prepare("UPDATE incidencias SET foto_despues = ? WHERE id = ?");
            $stmt->execute([$nombreArchivo, $incidenciaId]);
            
            // Sincronizar
            $sincronizado = sincronizarFotoConHostinger($incidenciaId, $rutaLocal);
            
            echo json_encode([
                'success' => true,
                'filename' => $nombreArchivo,
                'sincronizado' => $sincronizado
            ]);
            exit;
        }
    }
}

echo json_encode(['success' => false, 'error' => 'No se recibió archivo']);
```

## 🔑 Configurar API Key

### Opción 1: Variable de Entorno (Recomendada)

En Railway > Variables:
```
API_KEY=tu_clave_secreta_aqui_MD5_HASH
```

Luego en PHP:
```php
$apiKey = getenv('API_KEY') ?: 'fallback_key';
```

### Opción 2: Archivo de Configuración

Crea `config/sync.php`:
```php
<?php
return [
    'hostinger_url' => 'https://reporteurbano.site/public/api/upload_photo.php',
    'api_key' => 'tu_clave_secreta_aqui_' . md5('landingPage-railway-2026')
];
```

Úsalo:
```php
$config = require __DIR__ . '/config/sync.php';
$url = $config['hostinger_url'];
$apiKey = $config['api_key'];
```

## ✅ Lista de Verificación

- [ ] Instalar la función `sincronizarFotoConHostinger()` en Railway
- [ ] Llamar la función después de guardar `foto_despues`
- [ ] Configurar la API_KEY (misma que en Hostinger)
- [ ] Probar con una incidencia real
- [ ] Verificar que la foto aparece en https://reporteurbano.site/#incidencias (carrusel)
- [ ] Verificar logs de error si falla

## 🧪 Probar Conexión

Crea un archivo temporal `test_sync.php` en Railway:

```php
<?php
// test_sync.php - ejecutar desde navegador o CLI

$url = 'https://reporteurbano.site/public/api/upload_photo.php';
$apiKey = 'tu_clave_secreta_aqui_' . md5('landingPage-railway-2026');

// Crear imagen de prueba
$testImage = imagecreatetruecolor(100, 100);
$bgColor = imagecolorallocate($testImage, 255, 0, 0);
imagefill($testImage, 0, 0, $bgColor);
imagejpeg($testImage, '/tmp/test.jpg');
imagedestroy($testImage);

// Enviar
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $url,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => [
        'foto' => new CURLFile('/tmp/test.jpg'),
        'incidencia_id' => 1, // Cambia por un ID real
        'api_key' => $apiKey,
        'tipo' => 'despues'
    ],
    CURLOPT_RETURNTRANSFER => true
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Code: $httpCode\n";
echo "Response: $response\n";

// Borrar archivo temporal
unlink('/tmp/test.jpg');
```

Ejecutar:
```bash
php test_sync.php
```

Resultado esperado:
```
HTTP Code: 200
Response: {"ok":true,"incidencia_id":1,"filename":"inc_desp_1678912345_1234.jpg","url":"/uploads/inc_desp_1678912345_1234.jpg","tipo":"despues"}
```

## 🐛 Troubleshooting

### Error 403 - API Key Inválida
- Verifica que la API_KEY sea exactamente igual en ambos proyectos
- Revisa en Hostinger: `public/api/config.php` línea con `define('API_KEY', ...)`

### Error 404 - Incidencia No Encontrada
- Confirma que el ID existe en la base de datos compartida
- Verifica que ambos proyectos apuntan a la misma DB

### Error 500 - Error Interno
- Revisa logs de Hostinger: `logs/` o panel de hosting
- Verifica permisos de escritura en `/public/uploads/` (755)

### Foto No Se Sincroniza
- Verifica que Railway tenga acceso a internet para hacer cURL
- Confirma que el archivo existe antes de enviarlo
- Revisa `error_log()` en Railway

### Variables de Entorno en Railway

```bash
# Railway > Variables
API_KEY=tu_clave_secreta_MD5
HOSTINGER_URL=https://reporteurbano.site/public/api/upload_photo.php
DB_HOST=database-techti.cd2i6k8ukznv.us-east-2.rds.amazonaws.com
DB_USER=adminAM
DB_PASS=Mexico2026UTN
DB_NAME=proyectoSocial
```

## 📊 Diagrama de Flujo

```
Railway (Admin sube foto_despues)
    ↓
Guarda en /uploads/ local
    ↓
Actualiza DB: foto_despues = "archivo.jpg"
    ↓
sincronizarFotoConHostinger()
    ↓
cURL → Hostinger API
    ↓
Hostinger recibe y guarda en /public/uploads/
    ↓
Actualiza DB: foto_despues = "archivo.jpg"
    ↓
Carrusel carga desde /public/uploads/
```

## ✨ Resultado Final

Cuando todo funcione:
1. Admin sube foto en Railway
2. Se guarda localmente en Railway (para historial)
3. Se sincroniza automáticamente a Hostinger
4. El carrusel en https://reporteurbano.site/#incidencias muestra el antes/después
5. Usuario ve la transformación con el slider interactivo

---

**Soporte**: Si tienes problemas, revisa los logs o comparte el código específico donde subes `foto_despues` en Railway.
