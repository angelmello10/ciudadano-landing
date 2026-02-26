require('dotenv').config();
const express = require('express');
const mysql = require('mysql2/promise');
const path = require('path');
const fs = require('fs');

const app = express();

// Parse JSON bodies (limit increased to allow image data URLs)
app.use(express.json({ limit: '12mb' }));

// Allow Live Server (5500) and any localhost origin during development
app.use((req, res, next) => {
  const origin = req.headers.origin;
  if (!origin || origin.startsWith('http://localhost') || origin.startsWith('http://127.0.0.1')) {
    res.setHeader('Access-Control-Allow-Origin', origin || '*');
  }
  res.setHeader('Access-Control-Allow-Methods', 'GET,OPTIONS');
  res.setHeader('Access-Control-Allow-Headers', 'Content-Type');
  if (req.method === 'OPTIONS') return res.sendStatus(204);
  next();
});

// Serve static site
app.use(express.static(path.join(__dirname, 'public')));

// Create MySQL pool using env vars
const pool = mysql.createPool({
  host: process.env.DB_HOST,
  port: process.env.DB_PORT ? Number(process.env.DB_PORT) : 3306,
  user: process.env.DB_USERNAME,
  password: process.env.DB_PASSWORD,
  database: process.env.DB_DATABASE,
  waitForConnections: true,
  connectionLimit: 10,
  queueLimit: 0
});

app.get('/db-test', async (req, res) => {
  try {
    const [rows] = await pool.query('SELECT 1+1 AS result');
    res.json({ ok: true, result: rows[0].result });
  } catch (err) {
    res.status(500).json({ ok: false, error: err.message });
  }
});

// Endpoint to fetch incidents from the DB
app.get('/incidencias', async (req, res) => {
  // Table name can be overridden by env var, default to 'incidencias'
  const table = process.env.DB_INCIDENTS_TABLE || 'incidencias';
  if (!/^[\w]+$/.test(table)) {
    return res.status(500).json({ ok: false, error: 'Invalid incidents table name' });
  }

  try {
    // Basic pagination support
    const limit = Math.min(100, Math.max(1, Number(req.query.limit) || 100));
    const offset = Math.max(0, Number(req.query.offset) || 0);

    // Use backticks for identifier (safe because we validate the name above)
    const sql = `SELECT * FROM \`${table}\` ORDER BY id DESC LIMIT ? OFFSET ?`;
    const [rows] = await pool.query(sql, [limit, offset]);
    res.json({ ok: true, count: rows.length, rows });
  } catch (err) {
    res.status(500).json({ ok: false, error: err.message });
  }
});

// Endpoint to fetch a single incident by ID
app.get('/incidencias/:id', async (req, res) => {
  const table = process.env.DB_INCIDENTS_TABLE || 'incidencias';
  if (!/^[\w]+$/.test(table)) {
    return res.status(500).json({ ok: false, error: 'Invalid incidents table name' });
  }
  const id = Number(req.params.id);
  if (!Number.isInteger(id) || id < 1) {
    return res.status(400).json({ ok: false, error: 'ID inválido' });
  }
  try {
    const [rows] = await pool.query(`SELECT * FROM \`${table}\` WHERE id = ? LIMIT 1`, [id]);
    if (rows.length === 0) {
      return res.status(404).json({ ok: false, error: 'Incidencia no encontrada' });
    }
    res.json({ ok: true, row: rows[0] });
  } catch (err) {
    res.status(500).json({ ok: false, error: err.message });
  }
});

// Create new incident (accepts JSON, foto can be a data URL)
app.post('/incidencias', async (req, res) => {
  const table = process.env.DB_INCIDENTS_TABLE || 'incidencias';
  if (!/^[\w]+$/.test(table)) {
    return res.status(500).json({ ok: false, error: 'Invalid incidents table name' });
  }

  try {
    const body = req.body || {};
    const nombre_ciudadano = body.nombre_ciudadano || null;
    const email = body.email || null;
    const direccion = body.direccion || null;
    const latitud = body.latitud ? Number(body.latitud) : null;
    const longitud = body.longitud ? Number(body.longitud) : null;
    const tipo_incidencia = body.tipo_incidencia || null;
    const descripcion = body.descripcion || null;
    const estatus = body.estatus || 'pendiente';

    // Handle foto: if it's a data URL, decode and save into public/uploads
    let fotoFileName = null;
    if (body.foto && typeof body.foto === 'string' && body.foto.startsWith('data:')) {
      const uploadsDir = path.join(__dirname, 'public', 'uploads');
      if (!fs.existsSync(uploadsDir)) fs.mkdirSync(uploadsDir, { recursive: true });

      const match = body.foto.match(/^data:(image\/(png|jpeg|jpg));base64,(.+)$/);
      const mime = match ? match[1] : 'image/jpeg';
      const ext = match && match[2] ? (match[2] === 'jpeg' ? 'jpg' : match[2]) : 'jpg';
      const base64Data = match ? match[3] : body.foto.split(',')[1];
      const buf = Buffer.from(base64Data, 'base64');
      fotoFileName = `inc_${Date.now()}_${Math.floor(Math.random()*9000)+1000}.${ext}`;
      const savePath = path.join(uploadsDir, fotoFileName);
      fs.writeFileSync(savePath, buf);
    }

    const sql = `INSERT INTO \`${table}\` (nombre_ciudadano, email, direccion, latitud, longitud, tipo_incidencia, descripcion, estatus, foto, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())`;
    const params = [nombre_ciudadano, email, direccion, latitud, longitud, tipo_incidencia, descripcion, estatus, fotoFileName];

    const [result] = await pool.query(sql, params);

    // Return created id and a fresh copy
    const insertId = result.insertId;
    const [rows] = await pool.query(`SELECT * FROM \`${table}\` WHERE id = ? LIMIT 1`, [insertId]);
    return res.json({ ok: true, id: insertId, row: rows[0] });
  } catch (err) {
    console.error('Error creating incidencia:', err);
    return res.status(500).json({ ok: false, error: err.message });
  }
});

// Stats endpoint: totals by status
app.get('/stats', async (req, res) => {
  const table = process.env.DB_INCIDENTS_TABLE || 'incidencias';
  if (!/^[\w]+$/.test(table)) {
    return res.status(500).json({ ok: false, error: 'Invalid table name' });
  }
  try {
    const [rows] = await pool.query(`
      SELECT
        COUNT(*) AS total,
        SUM(CASE WHEN LOWER(estatus) = 'resuelto'                         THEN 1 ELSE 0 END) AS resueltos,
        SUM(CASE WHEN LOWER(estatus) IN ('en proceso','activo','proceso')  THEN 1 ELSE 0 END) AS en_proceso,
        SUM(CASE WHEN LOWER(estatus) = 'pendiente'                        THEN 1 ELSE 0 END) AS pendientes
      FROM \`${table}\`
    `);
    const s = rows[0];
    res.json({
      ok: true,
      stats: {
        total:       Number(s.total),
        resueltos:   Number(s.resueltos),
        en_proceso:  Number(s.en_proceso),
        pendientes:  Number(s.pendientes)
      }
    });
  } catch (err) {
    res.status(500).json({ ok: false, error: err.message });
  }
});

const port = process.env.PORT || 3000;
app.listen(port, () => {
  console.log(`Server listening on http://localhost:${port}`);
});

module.exports = app;
