# 🏙️ Reporte Urbano - Landing Page

Sistema de reportes ciudadanos para incidencias urbanas con integración de panel administrativo.

**🌐 Sitio en vivo**: https://reporteurbano.site/  
**⚙️ Panel Admin**: https://incidencias-urbanas-production.up.railway.app/

* [Características](#características)
* [Arquitectura](#arquitectura)
* [Getting started](#getting-started)
* [Sincronización de Fotos](#sincronización-de-fotos)
* [Deploy](#deploy)

## Características

- 📍 **Mapa Interactivo**: Visualización de incidencias con Google Maps
- 📸 **Reporte con Foto**: Captura desde cámara o galería
- 🎠 **Carrusel Antes/Después**: Comparador interactivo de fotos resueltas
- 📊 **Estadísticas en Tiempo Real**: Contadores de incidencias
- 🔍 **Consulta de Reportes**: Seguimiento por ID
- 📧 **Notificaciones Email**: Confirmación automática al ciudadano
- 🌙 **Dark Mode**: Tema claro/oscuro
- 📱 **Responsive**: Compatible con móviles y tablets

## Arquitectura

### Frontend (Hostinger)
- **PHP 8+**: APIs REST para CRUD de incidencias
- **JavaScript ES6+**: Interacciones, modales, mapas
- **CSS3**: Estilos responsive, animaciones
- **Google Maps API**: Geolocalización y visualización

### Backend (Railway + Hostinger)
- **Base de Datos Compartida**: AWS RDS MySQL
- **Sincronización de Fotos**: cURL entre servidores
- **Almacenamiento Centralizado**: Todas las fotos en Hostinger

### Estructura del Proyecto
```
landingPage/
├── public/
│   ├── api/                    # Endpoints PHP
│   │   ├── config.php          # Configuración DB y API Key
│   │   ├── incidencias.php     # CRUD incidencias
│   │   ├── upload_photo.php    # Receptor de fotos desde Railway
│   │   └── stats.php           # Estadísticas
│   ├── css/                    # Estilos
│   ├── js/                     # Scripts
│   │   ├── modal-report.js     # Formulario reporte
│   │   ├── modal-consult.js    # Consulta de reportes
│   │   ├── carrusel.js         # Comparador antes/después
│   │   └── mapa.js             # Google Maps
│   ├── includes/               # Componentes HTML
│   └── uploads/                # Fotos subidas
├── SYNC_FOTOS.md              # Guía sincronización
├── RAILWAY_SETUP.md           # Setup panel admin
└── test_upload.html           # Tester API
```

## Getting started

### 1. Requisitos

* First, ensure that node.js & npm are both installed. If not, choose your OS and installation method from [this page](https://nodejs.org/en/download/package-manager/) and follow the instructions.
* Next, use your command line to enter your project directory.
* This template comes with a ready-to-use package file called `package.json`. You just need to run `npm install` to install all of the dependencies into your project.
* When `npm` has finished with the install, run `npm run build` to generate the output files into the `public` folder.

You're ready to go! Run any task by typing `npm run task` (where "task" is the name of the task in the `"scripts"` object). The most useful task for rapid development is `npm run serve`. It will start a new server, open up a browser and watch for any SCSS or JS changes; once it compiles those changes, the browser will automatically inject the changed file(s)!

### Compiles and hot-reloads for development
```
npm run serve
```

### Compiles and minifies for production
```
npm run build
```

### 2. Servidor PHP Local
```bash
php -S localhost:8000
```

Navega a `http://localhost:8000/public/index.php`

### 3. Configurar Base de Datos

Edita `public/api/config.php` con tus credenciales:
```php
define('DB_HOST', 'tu-host.rds.amazonaws.com');
define('DB_USER', 'tu_usuario');
define('DB_PASS', 'tu_password');
define('DB_NAME', 'proyectoSocial');
define('API_KEY', 'tu_clave_secreta_unica');
```

### 4. Google Maps API

Crea una API Key en [Google Cloud Console](https://console.cloud.google.com/) y activa:
- Maps JavaScript API
- Geocoding API
- Places API

Agrega la key en `public/includes/head.php`:
```html
<script src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY&libraries=places"></script>
```

## Sincronización de Fotos

El sistema sincroniza automáticamente las fotos entre Railway (panel admin) y Hostinger (landing).

### Flujo:
1. **Ciudadano reporta** → `foto` (antes) se guarda en Hostinger
2. **Admin actualiza** → `foto_despues` se envía desde Railway a Hostinger
3. **Carrusel muestra** → Ambas fotos desde un solo servidor

### Setup en Railway:

Ver guía completa: **[RAILWAY_SETUP.md](RAILWAY_SETUP.md)**

```php
// En tu controlador de Railway:
function sincronizarFotoConHostinger($incidenciaId, $rutaArchivoLocal) {
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => 'https://reporteurbano.site/public/api/upload_photo.php',
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => [
            'foto' => new CURLFile($rutaArchivoLocal),
            'incidencia_id' => $incidenciaId,
            'api_key' => getenv('API_KEY'),
            'tipo' => 'despues'
        ],
        CURLOPT_RETURNTRANSFER => true
    ]);
    return curl_exec($ch);
}
```

### Probar Endpoint:

Abre `test_upload.html` en tu navegador o ejecuta:
```bash
curl -X POST https://reporteurbano.site/public/api/upload_photo.php \
  -F "foto=@imagen.jpg" \
  -F "incidencia_id=1" \
  -F "api_key=tu_clave" \
  -F "tipo=despues"
```

## Deploy

### Hostinger (Producción)
1. Sube el contenido de `public/` vía FTP/SFTP
2. Configura `public/api/config.php` con credenciales de producción
3. Asegura permisos 755 en `/public/uploads/`
4. Configura certificado SSL (Let's Encrypt)

### Railway (Panel Admin)
1. Conecta el repositorio del panel admin
2. Configura variables de entorno:
   ```
   API_KEY=tu_clave_secreta
   HOSTINGER_URL=https://reporteurbano.site/public/api/upload_photo.php
   ```
3. Implementa la función `sincronizarFotoConHostinger()`

## Documentación Adicional

- **[SYNC_FOTOS.md](SYNC_FOTOS.md)**: Guía técnica de sincronización
- **[RAILWAY_SETUP.md](RAILWAY_SETUP.md)**: Setup completo para Railway
- **[test_upload.html](test_upload.html)**: Tester visual del endpoint

## Estructura de Base de Datos

Tabla `incidencias`:
```sql
CREATE TABLE incidencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_ciudadano VARCHAR(100),
    email VARCHAR(100),
    direccion VARCHAR(255),
    latitud DECIMAL(10,6),
    longitud DECIMAL(10,6),
    tipo_incidencia VARCHAR(255),
    descripcion TEXT,
    estatus VARCHAR(255) DEFAULT 'pendiente',
    foto VARCHAR(255),              -- Foto "antes" del ciudadano
    foto_despues VARCHAR(255),      -- Foto "después" del admin
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

## Soporte

Para problemas o preguntas:
1. Revisa los logs de error en `logs/` (Hostinger) o Railway dashboard
2. Verifica conectividad a la base de datos compartida
3. Comprueba que las API keys coincidan en ambos proyectos

---

**Desarrollado con ❤️ para mejorar la gestión municipal**

## Deploy with Netlify
Premium HTML templates come with a ready-made `netlify.toml` file to allow you deploying with Netlify and go live in a few clicks. You just need to create a repository and copy the whole content of the `HTML`folder. Then, create a new site from Git in Netlify and deploy the app.