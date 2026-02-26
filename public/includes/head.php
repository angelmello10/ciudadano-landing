<!DOCTYPE html>
<html lang="es" class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Reporte Ciudadano</title>
    <meta name="description"
        content="Plataforma de reporte ciudadano para registrar incidencias, consultar estatus y visualizar reportes en mapa en tiempo real.">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        /* ===== DESIGN SYSTEM ===== */
        :root {
            --primary: #9D1B32;
            --primary-dark: #7d1528;
            --primary-glow: rgba(157, 27, 50, 0.35);
            --dark: #0b0b0b;
            --dark-soft: #161616;
            --dark-card: #1c1c1e;
            --gray: #64748b;
            --gray-light: #94a3b8;
            --bg: #f8fafc;
            --bg-card: #ffffff;
            --border: #e2e8f0;
            --white: #ffffff;
            --status-pending: #f59e0b;
            --status-pending-bg: rgba(245, 158, 11, 0.12);
            --status-rejected: #ef4444;
            --status-rejected-bg: rgba(239, 68, 68, 0.12);
            --status-resolved: #10b981;
            --status-resolved-bg: rgba(16, 185, 129, 0.12);
            --status-inprogress: #3b82f6;
            --status-inprogress-bg: rgba(59, 130, 246, 0.12);
            --shadow-xs: 0 1px 2px rgba(0,0,0,0.06);
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.08);
            --shadow-md: 0 8px 24px rgba(0,0,0,0.10);
            --shadow-lg: 0 20px 48px rgba(0,0,0,0.14);
            --shadow-xl: 0 32px 64px rgba(0,0,0,0.18);
            --r-sm: 8px; --r-md: 12px; --r-lg: 18px; --r-xl: 24px; --r-full: 9999px;
        }
        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: var(--dark); background: var(--bg);
            -webkit-font-smoothing: antialiased;
            background-image:
                radial-gradient(circle at 20% 0%, rgba(157,27,50,0.06), transparent 28%),
                radial-gradient(circle at 80% 20%, rgba(157,27,50,0.04), transparent 30%);
        }
        /* HEADER */
        .site-header { background: rgba(11,11,11,0.92)!important; backdrop-filter: blur(20px) saturate(180%)!important; -webkit-backdrop-filter: blur(20px) saturate(180%)!important; border-bottom: 1px solid rgba(157,27,50,0.4)!important; box-shadow: 0 1px 0 rgba(255,255,255,0.04),0 4px 24px rgba(0,0,0,0.3); position: sticky; top: 0; z-index: 100; }
        .site-header .brand a { color: var(--white); font-weight: 800; }
        .site-header .brand img { border-radius: 8px; }
        .header-nav-inner { display: flex; align-items: center; justify-content: flex-end; gap: 10px; width: 100%; }
        .header-link { color: #cbd5e1; font-size: 0.83rem; font-weight: 600; text-decoration: none; padding: 8px 12px; border-radius: var(--r-full); border: 1px solid transparent; transition: all 0.2s ease; }
        .header-link:hover { color: var(--white); background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.14); }
        .header-cta { background: linear-gradient(135deg,var(--primary) 0%,#b52040 100%); color: #fff!important; border: 1px solid rgba(255,255,255,0.12); box-shadow: 0 8px 22px rgba(157,27,50,0.35); }
        .hamburger-inner, .hamburger-inner::before, .hamburger-inner::after { background: var(--white)!important; }
        /* HERO */
        .hero.has-bg-color { position: relative; overflow: hidden; }
        .hero.has-bg-color::before { background: linear-gradient(135deg,#080808 0%,#130207 50%,#0d0d0d 100%)!important; }
        .hero.has-bg-color::after { content:''; position:absolute; inset:0; background: radial-gradient(ellipse 60% 50% at 20% 50%,rgba(157,27,50,0.18) 0%,transparent 60%), radial-gradient(ellipse 40% 60% at 80% 20%,rgba(157,27,50,0.12) 0%,transparent 60%), radial-gradient(ellipse 30% 40% at 60% 80%,rgba(100,10,30,0.15) 0%,transparent 60%); animation: pulse-glow 8s infinite alternate ease-in-out; pointer-events: none; z-index: 0; }
        @keyframes pulse-glow { 0%{opacity:.6;transform:scale(1)} 100%{opacity:1;transform:scale(1.1)} }
        .hero-inner { position: relative; z-index: 1; }
        .hero-content h1 { color:var(--white); font-weight:900; letter-spacing:-0.04em; line-height:1.1; background:linear-gradient(135deg,#fff 30%,#fca5a5 100%); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
        .hero-content p { color:#94a3b8; font-size:1.15rem; line-height:1.7; }
        .hero-eyebrow { display:inline-flex; align-items:center; gap:8px; font-size:0.72rem; text-transform:uppercase; letter-spacing:0.12em; font-weight:700; color:#f8d1d8; background:rgba(157,27,50,0.2); border:1px solid rgba(255,255,255,0.22); border-radius:var(--r-full); padding:8px 14px; margin-bottom:1rem; }
        .hero-eyebrow::before { content:''; width:8px; height:8px; border-radius:50%; background:#fb7185; box-shadow:0 0 0 5px rgba(251,113,133,0.2); }
        .hero-content .button-group { margin-bottom:1.25rem; }
        .hero-trust { display:flex; flex-wrap:wrap; gap:10px; }
        .hero-trust-item { display:inline-flex; align-items:center; gap:7px; color:#dbeafe; font-size:0.8rem; font-weight:600; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.12); border-radius:var(--r-full); padding:7px 12px; }
        .hero-figure { position:relative; }
        .hero-figure img { border-radius:var(--r-lg); box-shadow:var(--shadow-xl); border:1px solid rgba(255,255,255,0.12); }
        .hero-figure-badge { position:absolute; right:18px; bottom:18px; background:rgba(15,23,42,0.86); color:#fff; font-size:0.76rem; font-weight:700; letter-spacing:0.03em; border-radius:var(--r-md); padding:9px 12px; border:1px solid rgba(255,255,255,0.15); backdrop-filter:blur(10px); }
        /* BUTTONS */
        .button { border-radius:var(--r-full)!important; font-weight:700; font-size:0.9rem; letter-spacing:0.01em; transition:all 0.22s cubic-bezier(0.4,0,0.2,1); position:relative; overflow:hidden; }
        .button::after { content:''; position:absolute; inset:0; background:rgba(255,255,255,0); transition:background 0.2s; border-radius:inherit; }
        .button:hover::after { background:rgba(255,255,255,0.08); }
        .button-primary { background:linear-gradient(135deg,var(--primary) 0%,#b52040 100%)!important; border-color:transparent!important; box-shadow:0 4px 18px var(--primary-glow),0 1px 0 rgba(255,255,255,0.1) inset; }
        .button-primary:hover { transform:translateY(-2px); box-shadow:0 8px 28px var(--primary-glow); }
        .button-dark { background:rgba(255,255,255,0.1)!important; color:var(--white)!important; border:1px solid rgba(255,255,255,0.2)!important; backdrop-filter:blur(10px); }
        .button-dark:hover { background:rgba(255,255,255,0.18)!important; transform:translateY(-2px); }
        /* FEATURES */
        .features-tiles { background:linear-gradient(180deg,#fff 0%,#f8fafc 100%); }
        .features-tiles .section-header { margin-bottom:2.5rem; }
        .quick-steps { padding:4.5rem 0; background:linear-gradient(180deg,#f8fafc 0%,#f1f5f9 100%); }
        .quick-steps-grid { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:16px; }
        .quick-step { background:var(--white); border:1px solid var(--border); border-radius:var(--r-lg); padding:20px; box-shadow:var(--shadow-sm); }
        .quick-step-index { width:34px; height:34px; display:inline-flex; align-items:center; justify-content:center; background:rgba(157,27,50,0.12); color:var(--primary); border-radius:10px; font-weight:800; font-size:0.9rem; margin-bottom:10px; }
        .quick-step h4 { margin:0 0 8px; font-size:1.08rem; font-weight:800; color:#0f172a; }
        .quick-step p { margin:0; color:#64748b; font-size:0.92rem; line-height:1.65; }
        .section-header h2 { font-weight:800; letter-spacing:-0.03em; color:var(--dark); font-size:clamp(1.8rem,4vw,2.8rem); }
        .section-header p { color:var(--gray); font-size:1.05rem; }
        .features-tiles .tiles-item-inner { background:var(--white); border-radius:var(--r-lg); padding:2rem; box-shadow:var(--shadow-sm); border:1px solid var(--border); border-top:3px solid var(--primary); transition:all 0.3s cubic-bezier(0.4,0,0.2,1); position:relative; overflow:hidden; }
        .features-tiles .tiles-item-inner::before { content:''; position:absolute; top:0; left:0; right:0; height:3px; background:linear-gradient(90deg,var(--primary),#e05070); }
        .features-tiles .tiles-item-inner:hover { transform:translateY(-6px); box-shadow:var(--shadow-lg); border-color:transparent; }
        .features-tiles-item-image { background:linear-gradient(135deg,var(--primary) 0%,#7d1528 100%)!important; border-radius:var(--r-md); box-shadow:0 6px 16px var(--primary-glow); }
        .features-tiles h4 { font-weight:800; color:var(--dark); letter-spacing:-0.03em; font-size:1.35rem; margin-bottom:0.75rem; }
        .features-tiles p.text-sm { color:var(--gray); line-height:1.7; font-size:0.95rem; }
        /* DASHBOARD */
        .dashboard { background:linear-gradient(180deg,#f8fafc 0%,#f1f5f9 100%); padding-bottom:6rem; }
        .dashboard-inner .split-wrap { display:flex; gap:48px; align-items:flex-start; }
        .stats-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; }
        .stat-card { background:var(--white); padding:18px 16px; border-radius:var(--r-md); box-shadow:var(--shadow-sm); text-align:center; border:1px solid var(--border); border-top:3px solid transparent; transition:all 0.25s ease; }
        .stat-card:hover { transform:translateY(-3px); box-shadow:var(--shadow-md); }
        .stat-card--total{border-top-color:var(--dark)} .stat-card--resolved{border-top-color:var(--status-resolved)} .stat-card--inprogress{border-top-color:var(--status-inprogress)} .stat-card--pending{border-top-color:var(--status-pending)}
        .stat-value { font-size:2.2rem; font-weight:900; color:var(--dark); line-height:1; margin-bottom:6px; letter-spacing:-0.04em; }
        .stat-label { font-size:0.68rem; font-weight:700; color:var(--gray); letter-spacing:0.07em; text-transform:uppercase; }
        .text-color-success{color:var(--status-resolved)!important} .text-color-primary{color:var(--status-inprogress)!important} .text-color-error{color:var(--status-rejected)!important} .text-color-pending{color:var(--status-pending)!important}
        .legend { display:flex; gap:14px; flex-wrap:wrap; font-size:13px; font-weight:500; color:#475569; }
        .legend-item { display:flex; align-items:center; gap:7px; }
        .dot { width:10px; height:10px; border-radius:50%; display:inline-block; flex-shrink:0; }
        .bg-success{background:var(--status-resolved)} .bg-primary{background:var(--status-inprogress)} .bg-error{background:var(--status-rejected)} .bg-pending{background:var(--status-pending)}
        .map-mockup { width:100%; height:420px; border-radius:var(--r-xl); overflow:hidden; position:relative; box-shadow:var(--shadow-xl); border:3px solid rgba(255,255,255,0.8); }
        .pin-details-card { position:absolute; bottom:16px; left:16px; right:16px; background:rgba(255,255,255,0.96); backdrop-filter:blur(16px); padding:16px 18px; border-radius:var(--r-lg); box-shadow:var(--shadow-lg); opacity:0; transform:translateY(12px); pointer-events:none; transition:all 0.3s cubic-bezier(0.4,0,0.2,1); z-index:20; border:1px solid rgba(255,255,255,0.6); }
        .pin-details-card.is-active { opacity:1; transform:translateY(0); pointer-events:auto; }
        .status-pill { display:inline-flex; align-items:center; padding:3px 10px; border-radius:var(--r-full); font-size:0.68rem; font-weight:800; text-transform:uppercase; letter-spacing:0.06em; color:#fff; gap:4px; }
        .status-pill.pill-pendiente,.status-pill[data-status="pendiente"]{background:var(--status-pending);color:#451a03}
        .status-pill.pill-pendiente::before,.status-pill[data-status="pendiente"]::before{content:'⏳';font-size:10px}
        .status-pill.pill-rechazado,.status-pill[data-status="rechazado"]{background:var(--status-rejected);color:#fff}
        .status-pill.pill-rechazado::before,.status-pill[data-status="rechazado"]::before{content:'✕';font-size:10px}
        .status-pill.pill-resuelto,.status-pill[data-status="resuelto"]{background:var(--status-resolved);color:#fff}
        .status-pill.pill-resuelto::before,.status-pill[data-status="resuelto"]::before{content:'✓';font-size:10px}
        .status-pill.pill-en-proceso,.status-pill[data-status="en proceso"]{background:var(--status-inprogress);color:#fff}
        .status-pill.pill-en-proceso::before,.status-pill[data-status="en proceso"]::before{content:'◑';font-size:10px}
        .status-pill.pill-activo{background:var(--status-inprogress);color:#fff}
        /* TABLE */
        .incidents-table-section { background:#f1f5f9; padding:5rem 0; }
        .incidents-table-section h2 { color:var(--dark); font-weight:800; letter-spacing:-0.03em; }
        .incidents-table-wrap { overflow-x:auto; background:var(--white); border-radius:var(--r-xl); box-shadow:var(--shadow-lg); border:1px solid var(--border); }
        .incidents-table { width:100%; border-collapse:separate; border-spacing:0; margin-bottom:0; }
        .incidents-table th,.incidents-table td { white-space:nowrap; vertical-align:middle; }
        .incidents-table thead tr { background:linear-gradient(135deg,#0f0f0f 0%,#1a1a1a 100%)!important; }
        .incidents-table th { color:#e2e8f0; font-weight:700; letter-spacing:0.06em; padding:16px 20px; text-transform:uppercase; font-size:0.7rem; border-bottom:2px solid rgba(157,27,50,0.6); }
        .incidents-table th:first-child{border-radius:var(--r-xl) 0 0 0} .incidents-table th:last-child{border-radius:0 var(--r-xl) 0 0}
        .incidents-table tbody tr{background:var(--white);transition:background .15s} .incidents-table tbody tr:nth-child(even){background:#fafbfc} .incidents-table tbody tr:hover{background:#f0f4ff!important}
        .incidents-table td { padding:14px 20px; font-size:0.875rem; color:#334155; border-bottom:1px solid #f1f5f9; }
        .incidents-table tbody tr:last-child td{border-bottom:none}
        .incidents-table .status-pill{font-size:0.65rem;padding:4px 10px}
        .incidents-table .button-sm{padding:6px 14px;font-size:0.75rem;border-radius:var(--r-sm);background:linear-gradient(135deg,var(--primary) 0%,#b52040 100%);color:white;border:none;font-weight:600;box-shadow:0 2px 8px var(--primary-glow);cursor:pointer;transition:all 0.2s}
        .incidents-table .button-sm:hover{transform:translateY(-1px);box-shadow:0 4px 14px var(--primary-glow)}
        .incidents-table-wrap::-webkit-scrollbar{height:8px} .incidents-table-wrap::-webkit-scrollbar-thumb{background:#cbd5e1;border-radius:999px} .incidents-table-wrap::-webkit-scrollbar-track{background:#eef2f7;border-radius:999px}
        /* MISC */
        .btn-my-location{background:linear-gradient(135deg,var(--primary) 0%,#b52040 100%);border-radius:var(--r-full);padding:9px 18px;box-shadow:0 4px 12px var(--primary-glow);font-weight:700;transition:all .2s}
        .btn-my-location:hover{transform:translateY(-2px);box-shadow:0 6px 18px var(--primary-glow)}
        .has-top-divider::before,.has-bottom-divider::after{background:var(--border)!important;opacity:.7}
        /* FOOTER */
        .site-footer{background:linear-gradient(135deg,#080808 0%,#111111 100%)!important;border-top:2px solid rgba(157,27,50,0.5);padding:3rem 0}
        .site-footer,.site-footer a,.site-footer .invert-color{color:#94a3b8!important}
        .site-footer a:hover{color:var(--white)!important}
        /* FINAL CTA */
        .final-cta{padding:4.5rem 0;background:linear-gradient(120deg,#120308 0%,#260710 35%,#13030a 100%);position:relative;overflow:hidden}
        .final-cta::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 15% 30%,rgba(157,27,50,0.35),transparent 55%),radial-gradient(ellipse at 85% 70%,rgba(157,27,50,0.22),transparent 55%);pointer-events:none}
        .final-cta-card{position:relative;z-index:1;background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.18);border-radius:var(--r-xl);padding:2.2rem;backdrop-filter:blur(12px);text-align:center;box-shadow:var(--shadow-xl)}
        .final-cta-card h2{color:#fff;margin:0 0 12px;font-size:clamp(1.6rem,3vw,2.4rem);letter-spacing:-0.03em}
        .final-cta-card p{color:#cbd5e1;margin:0 auto 1.4rem;max-width:700px}
        .tab.is-active{border-bottom:3px solid var(--primary)}
        @keyframes pulse{0%{box-shadow:0 0 0 0 rgba(157,27,50,0.5)}70%{box-shadow:0 0 0 10px rgba(157,27,50,0)}100%{box-shadow:0 0 0 0 rgba(157,27,50,0)}}
        @keyframes fadeInUp{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}
        @media(max-width:640px){
            .header-link{display:none}
            .dashboard-inner .split-wrap{flex-direction:column}
            .stats-grid{grid-template-columns:repeat(3,1fr);gap:10px}
            .hero-trust{gap:8px} .hero-trust-item{font-size:0.72rem;padding:6px 10px}
            .hero-figure-badge{right:10px;bottom:10px;font-size:0.7rem}
            .quick-steps-grid{grid-template-columns:1fr}
        }
    </style>
</head>
