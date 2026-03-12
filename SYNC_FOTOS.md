# Sincronización de Fotos: Railway ↔ Hostinger

## Resumen
Este documento explica cómo sincronizar las fotos entre:
- **Hostinger (landing)**: Recibe `foto` (antes) del ciudadano
- **Railway (panel admin)**: Recibe `foto_despues` del admin/trabajador

## 🎯 Objetivo
Centralizar todas las fotos en Hostinger para que el carrusel pueda mostrarlas sin problemas de CORS ni latencia.

---

## 📥 Endpoint Creado en Hostinger

**URL**: `https://reporteurbano.site/public/api/upload_photo.php`

### Parámetros (POST multipart/form-data):
- `foto` (file): El archivo de imagen
- `incidencia_id` (int): ID de la incidencia
- `api_key` (string): Clave secreta definida en `config.php`
- `tipo` (string, opcional): 'antes' o 'despues' (default: 'despues')

### Respuesta exitosa:
```json
{
  "ok": true,
  "incidencia_id": 123,
  "filename": "inc_desp_1678912345_1234.jpg",
  "url": "/uploads/inc_desp_1678912345_1234.jpg",
  "tipo": "despues"
}
```

---

## 🚀 Código para Railway (Panel Admin)

Agrega este código en tu proyecto de Railway donde el admin sube `foto_despues`:

### Opción 1: Usando cURL (PHP)

```php
<?php
// Después de que el admin suba la foto localmente en Railway,
// envíala también a Hostinger

function sincronizarFotoAHostinger($incidenciaId, $rutaArchivoLocal) {
    $url = 'https://reporteurbano.site/public/api/upload_photo.php';
    $apiKey = 'tu_clave_secreta_aqui_' . md5('landingPage-railway-2026'); // Misma que en config.php
    
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
        CURLOPT_TIMEOUT => 30
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode === 200) {
        $data = json_decode($response, true);
        return $data['ok'] ?? false;
    }
    
    return false;
}

// Uso:
// Después de guardar la foto localmente:
$uploaded = $_FILES['foto_despues'];
move_uploaded_file($uploaded['tmp_name'], '/ruta/local/foto.jpg');

// Sincronizar con Hostinger:
$sincronizado = sincronizarFotoAHostinger($incidenciaId, '/ruta/local/foto.jpg');
if ($sincronizado) {
    // Foto sincronizada exitosamente
} else {
    // Error al sincronizar (pero la foto ya está guardada localmente)
}
```

### Opción 2: Usando Guzzle (PHP moderno)

```php
<?php
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

function sincronizarFotoAHostinger($incidenciaId, $rutaArchivoLocal) {
    $client = new Client();
    $url = 'https://reporteurbano.site/public/api/upload_photo.php';
    $apiKey = 'tu_clave_secreta_aqui_' . md5('landingPage-railway-2026');
    
    try {
        $response = $client->post($url, [
            'multipart' => [
                [
                    'name' => 'foto',
                    'contents' => fopen($rutaArchivoLocal, 'r'),
                    'filename' => basename($rutaArchivoLocal)
                ],
                [
                    'name' => 'incidencia_id',
                    'contents' => $incidenciaId
                ],
                [
                    'name' => 'api_key',
                    'contents' => $apiKey
                ],
                [
                    'name' => 'tipo',
                    'contents' => 'despues'
                ]
            ],
            'timeout' => 30
        ]);
        
        $data = json_decode($response->getBody(), true);
        return $data['ok'] ?? false;
        
    } catch (\Exception $e) {
        error_log('Error sincronizando foto: ' . $e->getMessage());
        return false;
    }
}
```

### Opción 3: JavaScript/Node.js (si usas backend JS)

```javascript
const FormData = require('form-data');
const fs = require('fs');
const fetch = require('node-fetch');

async function sincronizarFotoAHostinger(incidenciaId, rutaArchivoLocal) {
  const url = 'https://reporteurbano.site/public/api/upload_photo.php';
  const apiKey = 'tu_clave_secreta_aqui_' + require('crypto').createHash('md5').update('landingPage-railway-2026').digest('hex');
  
  const form = new FormData();
  form.append('foto', fs.createReadStream(rutaArchivoLocal));
  form.append('incidencia_id', incidenciaId);
  form.append('api_key', apiKey);
  form.append('tipo', 'despues');
  
  try {
    const response = await fetch(url, {
      method: 'POST',
      body: form,
      timeout: 30000
    });
    
    const data = await response.json();
    return data.ok || false;
  } catch (error) {
    console.error('Error sincronizando foto:', error);
    return false;
  }
}

// Uso:
// sincronizarFotoAHostinger(123, '/ruta/local/foto.jpg');
```

---

## 🔐 Seguridad

1. **Cambia la API_KEY** en [config.php](public/api/config.php) por un valor único y secreto
2. **No expongas la clave** en tu repositorio público (usa variables de entorno)
3. El endpoint valida:
   - API key correcta
   - ID de incidencia existe
   - Tipo de archivo (solo JPG/PNG)
   - Tamaño máximo 5MB

---

## ✅ Verificación

### Probar el endpoint con cURL:
```bash
curl -X POST https://reporteurbano.site/public/api/upload_photo.php \
  -F "foto=@/ruta/a/tu/imagen.jpg" \
  -F "incidencia_id=1" \
  -F "api_key=tu_clave_secreta_aqui_" \
  -F "tipo=despues"
```

### Respuesta esperada:
```json
{
  "ok": true,
  "incidencia_id": 1,
  "filename": "inc_desp_1678912345_1234.jpg",
  "url": "/uploads/inc_desp_1678912345_1234.jpg",
  "tipo": "despues"
}
```

---

## 📋 Flujo Completo

1. **Ciudadano reporta** (Hostinger):
   - Sube `foto` (antes)
   - Se guarda en `/public/uploads/` de Hostinger
   - Se registra en columna `foto` de la DB

2. **Admin actualiza** (Railway):
   - Sube `foto_despues`
   - Se guarda localmente en Railway (opcional)
   - Se envía a Hostinger con `sincronizarFotoAHostinger()`
   - Hostinger guarda en `/public/uploads/` y actualiza columna `foto_despues`

3. **Carrusel muestra** (Hostinger):
   - Lee `foto` y `foto_despues` de la DB
   - Ambas rutas apuntan a `/public/uploads/` local
   - No hay problemas de CORS ni latencia externa

---

## 🐛 Troubleshooting

### Error 403 (API key inválida)
- Verifica que la API_KEY en Railway sea exactamente igual a la de Hostinger
- Revisa que estés enviando el parámetro `api_key` correctamente

### Error 404 (Incidencia no encontrada)
- Confirma que el ID existe en la base de datos
- Ambos proyectos deben estar conectados a la misma DB

### Foto no se sube
- Revisa permisos de escritura en `/public/uploads/` (755)
- Verifica tamaño del archivo (<5MB)
- Comprueba que sea JPG o PNG

### Variables de entorno (Railway)
```bash
# En Railway, agrega esta variable:
API_KEY=tu_clave_secreta_aqui_[hash_md5]
HOSTINGER_UPLOAD_URL=https://tu-dominio.com/public/api/upload_photo.php
```

---

## 📞 Soporte

Si tienes problemas:
1. Revisa los logs de PHP en Railway y Hostinger
2. Verifica la conectividad con `ping` o cURL
3. Comprueba que la DB esté accesible desde ambos servidores
