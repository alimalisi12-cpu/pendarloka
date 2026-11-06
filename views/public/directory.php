<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pendar Loka &mdash; Temukan yang Berpendar</title>

  <!-- Favicon -->
  <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>✨</text></svg>">

  <!-- Google Fonts: Playfair Display & Montserrat -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&display=swap" rel="stylesheet">

  <!-- Firebase App & Services (Compat SDK for CDN usage) -->
  <script src="https://www.gstatic.com/firebasejs/10.8.0/firebase-app-compat.js"></script>
  <script src="https://www.gstatic.com/firebasejs/10.8.0/firebase-auth-compat.js"></script>
  <script src="https://www.gstatic.com/firebasejs/10.8.0/firebase-firestore-compat.js"></script>

  <style>
    /* ==========================================================================
       BRAND VARIABLES & BASE CONFIGURATION
       ========================================================================= */
    :root {
      --bg-warm: #F7F5F0;
      --primary-deep: #17242A;
      --gold-accent: #D5A84A;
      --secondary-beige: #E8D8BE;
      --text-dark: #252525;

      /* Editorial UI Tokens */
      --text-muted: #5A6267;
      --surface-white: #FFFFFF;
      --card-border: rgba(232, 216, 190, 0.45);
      --card-border-hover: rgba(213, 168, 74, 0.65);
      --shadow-subtle: 0 4px 20px -2px rgba(23, 36, 42, 0.04), 0 2px 6px -1px rgba(23, 36, 42, 0.02);
      --shadow-hover: 0 12px 28px -4px rgba(23, 36, 42, 0.08), 0 4px 10px -2px rgba(23, 36, 42, 0.04);
      --radius-sm: 8px;
      --radius-md: 16px;
      --radius-pill: 9999px;
      --transition: all 0.28s cubic-bezier(0.16, 1, 0.3, 1);
    }

    /* CSS Reset */
    *, *::before, *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html {
      font-size: 16px;
      scroll-behavior: smooth;
      -webkit-tap-highlight-color: transparent;
    }

    body {
      background-color: var(--bg-warm);
      color: var(--text-dark);
      font-family: 'Montserrat', sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      line-height: 1.6;
      padding: 3.5rem 1.25rem 2.5rem;
      position: relative;
      overflow-x: hidden;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    /* Subtle ambient warmth glow */
    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background: radial-gradient(circle at 50% 0%, rgba(213, 168, 74, 0.06) 0%, transparent 60%);
      pointer-events: none;
      z-index: 0;
    }

    /* Page Container (Mobile-first, constrained editorial width) */
    .page-wrapper {
      width: 100%;
      max-width: 580px;
      position: relative;
      z-index: 1;
      display: flex;
      flex-direction: column;
      gap: 2.25rem;
    }

    /* ==========================================================================
       HEADER SECTION
       ========================================================================== */
    .brand-header {
      text-align: center;
      padding-bottom: 0.5rem;
      cursor: pointer;
      user-select: none;
    }

    .brand-mark {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 44px;
      height: 44px;
      margin-bottom: 1rem;
      background: rgba(232, 216, 190, 0.35);
      border: 1px solid var(--secondary-beige);
      border-radius: var(--radius-pill);
      color: var(--gold-accent);
      transition: var(--transition);
    }

    .brand-mark svg {
      width: 20px;
      height: 20px;
      fill: currentColor;
    }

    .brand-name {
      font-family: 'Playfair Display', Georgia, serif;
      font-size: clamp(2rem, 5vw, 2.5rem);
      font-weight: 700;
      color: var(--primary-deep);
      letter-spacing: -0.5px;
      line-height: 1.15;
      margin-bottom: 0.5rem;
      transition: var(--transition);
    }

    .brand-tagline {
      font-family: 'Montserrat', sans-serif;
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 2.5px;
      color: var(--text-dark);
      opacity: 0.85;
    }

    /* ==========================================================================
       HIGHLIGHT CARD (LATEST FIND)
       ========================================================================== */
    .highlight-card-wrapper {
      position: relative;
    }

    .highlight-card {
      display: block;
      text-decoration: none;
      background: var(--surface-white);
      border: 1px solid rgba(213, 168, 74, 0.45);
      border-radius: var(--radius-md);
      padding: 1.25rem 1.5rem;
      box-shadow: var(--shadow-subtle), 0 0 0 1px rgba(213, 168, 74, 0.1);
      transition: var(--transition);
      position: relative;
      overflow: hidden;
    }

    .highlight-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 3.5px;
      height: 100%;
      background-color: var(--gold-accent);
      border-top-left-radius: var(--radius-md);
      border-bottom-left-radius: var(--radius-md);
    }

    .highlight-card:hover,
    .highlight-card:focus-visible {
      transform: translateY(-2px);
      box-shadow: var(--shadow-hover), 0 0 0 1px var(--gold-accent);
      border-color: var(--gold-accent);
      outline: none;
    }

    .highlight-content {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 1rem;
    }

    .highlight-badge-row {
      display: flex;
      align-items: center;
      gap: 0.65rem;
    }

    .highlight-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.35rem;
      font-size: 0.6875rem;
      font-weight: 700;
      letter-spacing: 0.75px;
      text-transform: uppercase;
      padding: 0.25rem 0.65rem;
      border-radius: var(--radius-pill);
      background-color: rgba(213, 168, 74, 0.14);
      color: var(--primary-deep);
      border: 1px solid rgba(213, 168, 74, 0.3);
    }

    .highlight-text {
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 1.0625rem;
      font-weight: 600;
      color: var(--primary-deep);
      line-height: 1.35;
      margin-top: 0.35rem;
    }

    .highlight-arrow {
      color: var(--gold-accent);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      transition: var(--transition);
    }

    .highlight-card:hover .highlight-arrow {
      transform: translateX(4px);
      color: var(--primary-deep);
    }

    /* ==========================================================================
       DIRECTORY SECTIONS & MODULAR CARDS
       ========================================================================== */
    .directory-group {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .section-title {
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 1.35rem;
      font-weight: 700;
      color: var(--primary-deep);
      display: flex;
      align-items: center;
      gap: 0.75rem;
      letter-spacing: -0.2px;
    }

    .section-title::after {
      content: '';
      flex: 1;
      height: 1px;
      background-color: var(--secondary-beige);
      opacity: 0.75;
    }

    /* Container for dynamic menu cards (auto-flow stack) */
    .link-list {
      display: flex;
      flex-direction: column;
      gap: 0.75rem;
    }

    /* Card Wrapper (for Admin Controls overlay) */
    .menu-card-wrapper {
      position: relative;
      display: flex;
      flex-direction: column;
    }

    /* Individual Menu Link Card */
    .menu-card {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 1rem;
      background-color: var(--surface-white);
      border: 1px solid var(--card-border);
      border-radius: var(--radius-md);
      padding: 1.125rem 1.35rem;
      text-decoration: none;
      color: inherit;
      box-shadow: var(--shadow-subtle);
      transition: var(--transition);
      cursor: pointer;
      position: relative;
      width: 100%;
    }

    .menu-card:hover,
    .menu-card:focus-visible {
      transform: translateY(-2px);
      border-color: var(--card-border-hover);
      box-shadow: var(--shadow-hover);
      outline: none;
    }

    .menu-card-left {
      display: flex;
      align-items: center;
      gap: 1rem;
      min-width: 0;
    }

    .menu-icon-wrapper {
      width: 44px;
      height: 44px;
      border-radius: 12px;
      background-color: var(--bg-warm);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.35rem;
      flex-shrink: 0;
      border: 1px solid rgba(232, 216, 190, 0.4);
      transition: var(--transition);
    }

    .menu-card:hover .menu-icon-wrapper {
      background-color: rgba(232, 216, 190, 0.35);
      border-color: var(--gold-accent);
      transform: scale(1.04);
    }

    .menu-text-content {
      display: flex;
      flex-direction: column;
      min-width: 0;
    }

    .menu-title {
      font-family: 'Montserrat', sans-serif;
      font-size: 0.9375rem;
      font-weight: 600;
      color: var(--primary-deep);
      line-height: 1.3;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      transition: var(--transition);
    }

    .menu-desc {
      font-size: 0.78125rem;
      color: var(--text-muted);
      margin-top: 0.15rem;
      line-height: 1.35;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .menu-arrow {
      color: var(--secondary-beige);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      width: 24px;
      height: 24px;
      transition: var(--transition);
    }

    .menu-card:hover .menu-arrow {
      color: var(--gold-accent);
      transform: translateX(4px);
    }

    /* ==========================================================================
       ADMIN CONTROLS & EDIT MODE (INJECTED)
       ========================================================================== */
    .admin-bar {
      display: none;
      align-items: center;
      justify-content: space-between;
      gap: 0.75rem;
      background: var(--primary-deep);
      color: var(--bg-warm);
      padding: 0.65rem 1.15rem;
      border-radius: var(--radius-pill);
      border: 1px solid rgba(213, 168, 74, 0.4);
      box-shadow: var(--shadow-hover);
      margin-bottom: -0.5rem;
      font-size: 0.8125rem;
    }

    .admin-bar.active {
      display: flex;
    }

    .admin-bar-user {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-weight: 500;
    }

    .admin-bar-badge {
      display: inline-flex;
      align-items: center;
      padding: 0.15rem 0.5rem;
      font-size: 0.6875rem;
      font-weight: 700;
      background: var(--gold-accent);
      color: var(--primary-deep);
      border-radius: var(--radius-pill);
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .btn-admin-logout {
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.15);
      color: var(--bg-warm);
      padding: 0.35rem 0.85rem;
      font-size: 0.75rem;
      font-weight: 600;
      font-family: 'Montserrat', sans-serif;
      border-radius: var(--radius-pill);
      cursor: pointer;
      transition: var(--transition);
    }

    .btn-admin-logout:hover {
      background: rgba(213, 168, 74, 0.2);
      border-color: var(--gold-accent);
      color: var(--gold-accent);
    }

    .admin-card-actions {
      display: none;
      position: absolute;
      top: -10px;
      right: 12px;
      gap: 6px;
      z-index: 10;
    }

    body.admin-mode .admin-card-actions {
      display: flex;
    }

    .btn-action-icon {
      width: 28px;
      height: 28px;
      border-radius: var(--radius-pill);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border: 1px solid var(--secondary-beige);
      background: var(--surface-white);
      color: var(--primary-deep);
      cursor: pointer;
      font-size: 0.75rem;
      box-shadow: 0 2px 6px rgba(0,0,0,0.08);
      transition: var(--transition);
    }

    .btn-action-icon:hover {
      border-color: var(--gold-accent);
      background: var(--gold-accent);
      color: var(--primary-deep);
      transform: scale(1.1);
    }

    .btn-action-icon.btn-delete:hover {
      border-color: #C24141;
      background: #C24141;
      color: #FFFFFF;
    }

    .btn-add-link {
      display: none;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      width: 100%;
      padding: 0.875rem 1.25rem;
      background: transparent;
      border: 1.5px dashed var(--gold-accent);
      border-radius: var(--radius-md);
      color: var(--primary-deep);
      font-family: 'Montserrat', sans-serif;
      font-size: 0.8125rem;
      font-weight: 600;
      cursor: pointer;
      transition: var(--transition);
      margin-top: 0.25rem;
    }

    body.admin-mode .btn-add-link {
      display: flex;
    }

    .btn-add-link:hover {
      background: rgba(213, 168, 74, 0.1);
      border-style: solid;
      transform: translateY(-1px);
    }

    /* ==========================================================================
       MODAL STYLING (LOGIN & LINK CRUD)
       ========================================================================== */
    .modal-backdrop {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(23, 36, 42, 0.55);
      backdrop-filter: blur(5px);
      z-index: 1000;
      align-items: center;
      justify-content: center;
      padding: 1.25rem;
      opacity: 0;
      transition: opacity 0.25s ease;
    }

    .modal-backdrop.show {
      display: flex;
      opacity: 1;
    }

    .modal-sheet {
      width: 100%;
      max-width: 440px;
      background: var(--surface-white);
      border: 1px solid var(--secondary-beige);
      border-radius: 20px;
      box-shadow: 0 20px 45px -10px rgba(23, 36, 42, 0.25);
      padding: 2rem;
      position: relative;
      transform: translateY(12px);
      transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .modal-backdrop.show .modal-sheet {
      transform: translateY(0);
    }

    .modal-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 1.5rem;
    }

    .modal-title {
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 1.35rem;
      font-weight: 700;
      color: var(--primary-deep);
    }

    .btn-close-modal {
      background: transparent;
      border: none;
      color: var(--text-muted);
      cursor: pointer;
      font-size: 1.25rem;
      width: 32px;
      height: 32px;
      border-radius: var(--radius-pill);
      display: flex;
      align-items: center;
      justify-content: center;
      transition: var(--transition);
    }

    .btn-close-modal:hover {
      background: var(--bg-warm);
      color: var(--primary-deep);
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 0.35rem;
      margin-bottom: 1.15rem;
    }

    .form-label {
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: var(--primary-deep);
    }

    .form-input, .form-select {
      font-family: 'Montserrat', sans-serif;
      font-size: 0.875rem;
      padding: 0.75rem 1rem;
      border: 1px solid var(--secondary-beige);
      border-radius: var(--radius-sm);
      background-color: var(--bg-warm);
      color: var(--text-dark);
      transition: var(--transition);
      width: 100%;
    }

    .form-input:focus, .form-select:focus {
      outline: none;
      border-color: var(--gold-accent);
      background-color: var(--surface-white);
      box-shadow: 0 0 0 3px rgba(213, 168, 74, 0.15);
    }

    .btn-primary-action {
      width: 100%;
      padding: 0.85rem;
      background-color: var(--primary-deep);
      color: var(--bg-warm);
      border: 1px solid var(--primary-deep);
      border-radius: var(--radius-pill);
      font-family: 'Montserrat', sans-serif;
      font-size: 0.875rem;
      font-weight: 600;
      letter-spacing: 0.5px;
      cursor: pointer;
      transition: var(--transition);
      margin-top: 0.5rem;
    }

    .btn-primary-action:hover {
      background-color: var(--gold-accent);
      border-color: var(--gold-accent);
      color: var(--primary-deep);
    }

    .form-error {
      color: #C24141;
      font-size: 0.75rem;
      margin-top: 0.5rem;
      display: none;
      line-height: 1.4;
    }

    /* ==========================================================================
       FOOTER
       ========================================================================== */
    .brand-footer {
      text-align: center;
      padding-top: 1.5rem;
      padding-bottom: 1rem;
      border-top: 1px solid rgba(232, 216, 190, 0.45);
      margin-top: 0.5rem;
      position: relative;
    }

    .footer-text {
      font-size: 0.75rem;
      font-weight: 500;
      color: var(--text-muted);
      letter-spacing: 0.3px;
    }

    .secret-admin-trigger {
      position: absolute;
      bottom: 0;
      right: 0;
      width: 18px;
      height: 18px;
      opacity: 0.05;
      background: transparent;
      border: none;
      cursor: pointer;
    }

    .secret-admin-trigger:hover {
      opacity: 0.4;
    }

    a:focus-visible, button:focus-visible {
      outline: 2px solid var(--gold-accent);
      outline-offset: 3px;
    }

    /* ==========================================================================
       RESPONSIVE ADJUSTMENTS
       ========================================================================== */
    @media (min-width: 640px) {
      body {
        padding-top: 4.5rem;
        padding-bottom: 3.5rem;
      }

      .page-wrapper {
        gap: 2.5rem;
      }

      .highlight-card {
        padding: 1.35rem 1.75rem;
      }

      .menu-card {
        padding: 1.25rem 1.5rem;
      }
    }
  </style>
</head>
<body>

  <div class="page-wrapper">

    <!-- ADMIN STATUS BAR (ACTIVE WHEN AUTHENTICATED) -->
    <aside class="admin-bar" id="adminBar">
      <div class="admin-bar-user">
        <span class="admin-bar-badge">Admin Mode</span>
        <span id="adminUserEmail" style="font-size:0.75rem; opacity:0.85;"></span>
      </div>
      <button type="button" class="btn-admin-logout" onclick="handleAdminLogout()">Logout</button>
    </aside>

    <!-- HEADER (Click 3x quickly to open secret login) -->
    <header class="brand-header" id="brandHeader" title="Pendar Loka">
      <div class="brand-mark" aria-hidden="true">
        <svg viewBox="0 0 24 24">
          <path d="M12 0L14.7 9.3L24 12L14.7 14.7L12 24L9.3 14.7L0 12L9.3 9.3L12 0Z"/>
        </svg>
      </div>
      <h1 class="brand-name">PENDAR LOKA</h1>
      <p class="brand-tagline">TEMUKAN YANG BERPENDAR.</p>
    </header>

    <main style="display: flex; flex-direction: column; gap: 2rem;">

      <!-- HIGHLIGHT SECTION (LATEST FIND) -->
      <section aria-label="Temuan Terbaru" class="highlight-card-wrapper" id="highlightWrapper">
        <a href="#" class="highlight-card" id="highlightAnchor">
          <div class="highlight-content">
            <div>
              <div class="highlight-badge-row">
                <span class="highlight-badge">
                  <span>✨</span> <span id="highlightBadge">Temuan Terbaru</span>
                </span>
              </div>
              <div class="highlight-text" id="highlightTitle">
                7-in-1 Cleaning Kit
              </div>
            </div>
            <div class="highlight-arrow" aria-hidden="true">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
              </svg>
            </div>
          </div>
        </a>

        <div class="admin-card-actions">
          <button type="button" class="btn-action-icon" onclick="openEditHighlightModal()" title="Edit Highlight">✏️</button>
        </div>
      </section>

      <!-- SECTION A: KURASI PILIHAN (SUBDOMAIN DIRECTORY) -->
      <section class="directory-group" aria-labelledby="section-a-heading">
        <h2 id="section-a-heading" class="section-title">Kurasi Pilihan</h2>

        <nav class="link-list" id="listKurasi" aria-label="Navigasi Kurasi Pilihan">
          <!-- ADMIN: DUPLICATE THIS BLOCK TO ADD NEW SUBDOMAIN MENUS -->
          <div class="menu-card-wrapper">
            <a href="https://tech.pendarloka.biz.id" target="_blank" rel="noopener noreferrer" class="menu-card">
              <div class="menu-card-left">
                <div class="menu-icon-wrapper" aria-hidden="true">📦</div>
                <div class="menu-text-content">
                  <span class="menu-title">Pendar Tech</span>
                  <span class="menu-desc">Gadget &amp; Setup</span>
                </div>
              </div>
              <div class="menu-arrow" aria-hidden="true">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
              </div>
            </a>
          </div>

          <div class="menu-card-wrapper">
            <a href="https://home.pendarloka.biz.id" target="_blank" rel="noopener noreferrer" class="menu-card">
              <div class="menu-card-left">
                <div class="menu-icon-wrapper" aria-hidden="true">🛋️</div>
                <div class="menu-text-content">
                  <span class="menu-title">Pendar Home</span>
                  <span class="menu-desc">Dekorasi &amp; Rumah</span>
                </div>
              </div>
              <div class="menu-arrow" aria-hidden="true">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
              </div>
            </a>
          </div>

          <div class="menu-card-wrapper">
            <a href="https://daily.pendarloka.biz.id" target="_blank" rel="noopener noreferrer" class="menu-card">
              <div class="menu-card-left">
                <div class="menu-icon-wrapper" aria-hidden="true">🎒</div>
                <div class="menu-text-content">
                  <span class="menu-title">Pendar Daily</span>
                  <span class="menu-desc">Solusi Harian</span>
                </div>
              </div>
              <div class="menu-arrow" aria-hidden="true">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
              </div>
            </a>
          </div>
          <!-- /END SUBDOMAIN MENU BLOCK -->
        </nav>

        <button type="button" class="btn-add-link" onclick="openAddLinkModal('kurasi')">
          <span>+</span> Tambah Menu Kurasi Pilihan
        </button>
      </section>

      <!-- SECTION B: LAYANAN KREATIF -->
      <section class="directory-group" aria-labelledby="section-b-heading">
        <h2 id="section-b-heading" class="section-title">Layanan Kreatif</h2>

        <nav class="link-list" id="listLayanan" aria-label="Navigasi Layanan Kreatif">
          <!-- ADMIN: DUPLICATE THIS BLOCK TO ADD NEW SUBDOMAIN MENUS -->
          <div class="menu-card-wrapper">
            <a href="https://invite.pendarloka.biz.id" target="_blank" rel="noopener noreferrer" class="menu-card">
              <div class="menu-card-left">
                <div class="menu-icon-wrapper" aria-hidden="true">💌</div>
                <div class="menu-text-content">
                  <span class="menu-title">Pendar Studio</span>
                  <span class="menu-desc">Undangan Digital Premium</span>
                </div>
              </div>
              <div class="menu-arrow" aria-hidden="true">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
              </div>
            </a>
          </div>
          <!-- /END SUBDOMAIN MENU BLOCK -->
        </nav>

        <button type="button" class="btn-add-link" onclick="openAddLinkModal('layanan')">
          <span>+</span> Tambah Menu Layanan Kreatif
        </button>
      </section>

    </main>

    <!-- FOOTER -->
    <footer class="brand-footer">
      <p class="footer-text">&copy; 2026 Pendar Loka. All rights reserved.</p>
      <button type="button" class="secret-admin-trigger" onclick="openLoginModal()" aria-label="Admin Access">🔑</button>
    </footer>

  </div>

  <!-- MODAL 1: HIDDEN ADMIN LOGIN -->
  <div class="modal-backdrop" id="loginModal">
    <div class="modal-sheet" role="dialog" aria-modal="true" aria-labelledby="loginTitle">
      <div class="modal-header">
        <h3 class="modal-title" id="loginTitle">Admin Pendar Loka</h3>
        <button type="button" class="btn-close-modal" onclick="closeLoginModal()">&times;</button>
      </div>

      <form id="adminLoginForm" onsubmit="handleAdminLogin(event)">
        <div class="form-group">
          <label class="form-label" for="loginEmail">Email Admin</label>
          <input type="email" id="loginEmail" class="form-input" placeholder="admin@pendarloka.com" required autocomplete="username">
        </div>

        <div class="form-group">
          <label class="form-label" for="loginPassword">Password</label>
          <input type="password" id="loginPassword" class="form-input" placeholder="••••••••" required autocomplete="current-password">
        </div>

        <div class="form-error" id="loginError"></div>

        <button type="submit" class="btn-primary-action" id="btnLoginSubmit">Masuk ke Edit Mode</button>
      </form>
    </div>
  </div>

  <!-- MODAL 2: LINK CRUD (TAMBAH / EDIT LINK) -->
  <div class="modal-backdrop" id="linkModal">
    <div class="modal-sheet" role="dialog" aria-modal="true" aria-labelledby="linkModalTitle">
      <div class="modal-header">
        <h3 class="modal-title" id="linkModalTitle">Edit Menu Link</h3>
        <button type="button" class="btn-close-modal" onclick="closeLinkModal()">&times;</button>
      </div>

      <form id="linkForm" onsubmit="handleSaveLink(event)">
        <input type="hidden" id="formLinkId">

        <div class="form-group">
          <label class="form-label" for="formSection">Kategori Bagian</label>
          <select id="formSection" class="form-select" required>
            <option value="kurasi">Kurasi Pilihan (Section A)</option>
            <option value="layanan">Layanan Kreatif (Section B)</option>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label" for="formTitle">Judul Menu</label>
          <input type="text" id="formTitle" class="form-input" placeholder="Pendar Tech" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="formDesc">Deskripsi / Subtitle</label>
          <input type="text" id="formDesc" class="form-input" placeholder="Gadget & Setup" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="formIcon">Ikon (Emoji atau Karakter)</label>
          <input type="text" id="formIcon" class="form-input" placeholder="📦" style="max-width: 120px;" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="formUrl">Tautan Target (URL)</label>
          <input type="url" id="formUrl" class="form-input" placeholder="https://tech.pendarloka.biz.id" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="formOrder">Urutan Posisi (Angka)</label>
          <input type="number" id="formOrder" class="form-input" value="1" style="max-width: 120px;" required>
        </div>

        <div class="form-error" id="linkFormError"></div>

        <button type="submit" class="btn-primary-action" id="btnSaveLinkSubmit">Simpan Perubahan</button>
      </form>
    </div>
  </div>

  <!-- MODAL 3: EDIT HIGHLIGHT CARD (TEMUAN TERBARU) -->
  <div class="modal-backdrop" id="highlightModal">
    <div class="modal-sheet" role="dialog" aria-modal="true" aria-labelledby="hlModalTitle">
      <div class="modal-header">
        <h3 class="modal-title" id="hlModalTitle">Edit Temuan Terbaru</h3>
        <button type="button" class="btn-close-modal" onclick="closeHighlightModal()">&times;</button>
      </div>

      <form id="highlightForm" onsubmit="handleSaveHighlight(event)">
        <div class="form-group">
          <label class="form-label" for="hlBadge">Label Badge</label>
          <input type="text" id="hlBadge" class="form-input" value="Temuan Terbaru" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="hlTitle">Judul Produk / Konten</label>
          <input type="text" id="hlTitle" class="form-input" value="7-in-1 Cleaning Kit" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="hlUrl">Tautan Target (URL)</label>
          <input type="text" id="hlUrl" class="form-input" value="#" required>
        </div>

        <div class="form-error" id="hlFormError"></div>

        <button type="submit" class="btn-primary-action" id="btnSaveHighlightSubmit">Simpan Highlight</button>
      </form>
    </div>
  </div>

  <!-- FIREBASE INTEGRATION & APPLICATION LOGIC -->
  <script>
    const firebaseConfig = {
      apiKey: "AIzaSyCRla9ygZYzeCc67AeijhGWSSeQoLBSTDY",
      authDomain: "pendar-loka.firebaseapp.com",
      projectId: "pendar-loka",
      storageBucket: "pendar-loka.firebasestorage.app",
      messagingSenderId: "1089223768151",
      appId: "1:1089223768151:web:6e8754e4277e2107248b12",
      measurementId: "G-BZ7YYETJHH"
    };

    firebase.initializeApp(firebaseConfig);
    const auth = firebase.auth();
    const db = firebase.firestore();

    let linksCache = [];
    let highlightData = {
      badge: 'Temuan Terbaru',
      title: '7-in-1 Cleaning Kit',
      url: '#'
    };

    const defaultSeedLinks = [
      {
        section: 'kurasi',
        title: 'Pendar Tech',
        desc: 'Gadget & Setup',
        icon: '📦',
        url: 'https://tech.pendarloka.biz.id',
        order: 1
      },
      {
        section: 'kurasi',
        title: 'Pendar Home',
        desc: 'Dekorasi & Rumah',
        icon: '🛋️',
        url: 'https://home.pendarloka.biz.id',
        order: 2
      },
      {
        section: 'kurasi',
        title: 'Pendar Daily',
        desc: 'Solusi Harian',
        icon: '🎒',
        url: 'https://daily.pendarloka.biz.id',
        order: 3
      },
      {
        section: 'layanan',
        title: 'Pendar Studio',
        desc: 'Undangan Digital Premium',
        icon: '💌',
        url: 'https://invite.pendarloka.biz.id',
        order: 1
      }
    ];

    function initRealtimeListener() {
      db.collection('links').onSnapshot((snapshot) => {
        if (!snapshot.empty) {
          const links = [];
          snapshot.forEach((doc) => {
            const data = doc.data();
            if (doc.id === 'highlight_latest' || data.is_highlight) {
              highlightData = {
                id: doc.id,
                badge: data.badge || 'Temuan Terbaru',
                title: data.title || '7-in-1 Cleaning Kit',
                url: data.url || '#'
              };
              renderHighlightUI();
            } else {
              links.push({
                id: doc.id,
                ...data
              });
            }
          });

          links.sort((a, b) => (Number(a.order) || 99) - (Number(b.order) || 99));
          linksCache = links;
          renderDirectoryUI(links);
        } else {
          if (auth.currentUser) {
            seedInitialData();
          }
        }
      }, (error) => {
        console.warn('Firestore snapshot error or offline, fallback to initial state:', error);
      });
    }

    async function seedInitialData() {
      try {
        const batch = db.batch();
        defaultSeedLinks.forEach((item) => {
          const docRef = db.collection('links').doc();
          batch.set(docRef, item);
        });
        const hlRef = db.collection('links').doc('highlight_latest');
        batch.set(hlRef, {
          is_highlight: true,
          badge: 'Temuan Terbaru',
          title: '7-in-1 Cleaning Kit',
          url: '#'
        });
        await batch.commit();
        console.log('Default Firestore links successfully seeded.');
      } catch (err) {
        console.error('Error seeding initial Firestore data:', err);
      }
    }

    function renderHighlightUI() {
      const badgeEl = document.getElementById('highlightBadge');
      const titleEl = document.getElementById('highlightTitle');
      const anchorEl = document.getElementById('highlightAnchor');

      if (badgeEl) badgeEl.textContent = highlightData.badge || 'Temuan Terbaru';
      if (titleEl) titleEl.textContent = highlightData.title || '7-in-1 Cleaning Kit';
      if (anchorEl) anchorEl.href = highlightData.url || '#';
    }

    function renderDirectoryUI(links) {
      const listKurasi = document.getElementById('listKurasi');
      const listLayanan = document.getElementById('listLayanan');

      if (!listKurasi || !listLayanan) return;

      const kurasiItems = links.filter(l => l.section === 'kurasi');
      const layananItems = links.filter(l => l.section === 'layanan');

      listKurasi.innerHTML = kurasiItems.map(item => generateCardHtml(item)).join('');
      listLayanan.innerHTML = layananItems.map(item => generateCardHtml(item)).join('');
    }

    function generateCardHtml(item) {
      const safeId = escapeHtml(item.id);
      const safeTitle = escapeHtml(item.title);
      const safeDesc = escapeHtml(item.desc || '');
      const safeIcon = escapeHtml(item.icon || '✨');
      const safeUrl = escapeHtml(item.url || '#');

      return `
        <!-- ADMIN: DUPLICATE THIS BLOCK TO ADD NEW SUBDOMAIN MENUS -->
        <div class="menu-card-wrapper" data-id="${safeId}">
          <a href="${safeUrl}" target="_blank" rel="noopener noreferrer" class="menu-card">
            <div class="menu-card-left">
              <div class="menu-icon-wrapper" aria-hidden="true">${safeIcon}</div>
              <div class="menu-text-content">
                <span class="menu-title">${safeTitle}</span>
                <span class="menu-desc">${safeDesc}</span>
              </div>
            </div>
            <div class="menu-arrow" aria-hidden="true">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="9 18 15 12 9 6"></polyline>
              </svg>
            </div>
          </a>
          <div class="admin-card-actions">
            <button type="button" class="btn-action-icon" onclick="openEditLinkModal('${safeId}')" title="Edit Link">✏️</button>
            <button type="button" class="btn-action-icon btn-delete" onclick="handleDeleteLink('${safeId}', '${safeTitle}')" title="Hapus Link">🗑️</button>
          </div>
        </div>
        <!-- /END SUBDOMAIN MENU BLOCK -->
      `;
    }

    let headerClickCount = 0;
    let headerClickTimer = null;

    document.getElementById('brandHeader').addEventListener('click', () => {
      headerClickCount++;
      clearTimeout(headerClickTimer);

      if (headerClickCount >= 3) {
        headerClickCount = 0;
        if (!auth.currentUser) {
          openLoginModal();
        }
      } else {
        headerClickTimer = setTimeout(() => {
          headerClickCount = 0;
        }, 900);
      }
    });

    auth.onAuthStateChanged((user) => {
      const adminBar = document.getElementById('adminBar');
      const adminUserEmail = document.getElementById('adminUserEmail');

      if (user) {
        document.body.classList.add('admin-mode');
        adminBar.classList.add('active');
        adminUserEmail.textContent = user.email;
        closeLoginModal();
      } else {
        document.body.classList.remove('admin-mode');
        adminBar.classList.remove('active');
      }
    });

    async function handleAdminLogin(event) {
      event.preventDefault();
      const email = document.getElementById('loginEmail').value.trim();
      const password = document.getElementById('loginPassword').value;
      const errorEl = document.getElementById('loginError');
      const submitBtn = document.getElementById('btnLoginSubmit');

      errorEl.style.display = 'none';
      submitBtn.disabled = true;
      submitBtn.textContent = 'Memverifikasi...';

      try {
        await auth.signInWithEmailAndPassword(email, password);
        submitBtn.textContent = 'Berhasil Masuk!';
        setTimeout(() => {
          closeLoginModal();
        }, 500);
      } catch (err) {
        console.error('Firebase Auth error:', err);
        errorEl.textContent = getFirebaseAuthErrorMessage(err.code);
        errorEl.style.display = 'block';
      } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Masuk ke Edit Mode';
      }
    }

    async function handleAdminLogout() {
      try {
        await auth.signOut();
      } catch (err) {
        console.error('Logout error:', err);
      }
    }

    function openAddLinkModal(section = 'kurasi') {
      if (!auth.currentUser) return;
      document.getElementById('linkModalTitle').textContent = 'Tambah Menu Link';
      document.getElementById('formLinkId').value = '';
      document.getElementById('formSection').value = section;
      document.getElementById('formTitle').value = '';
      document.getElementById('formDesc').value = '';
      document.getElementById('formIcon').value = section === 'kurasi' ? '📦' : '💌';
      document.getElementById('formUrl').value = 'https://';
      document.getElementById('formOrder').value = linksCache.length + 1;
      document.getElementById('linkFormError').style.display = 'none';

      openModal('linkModal');
    }

    function openEditLinkModal(id) {
      if (!auth.currentUser) return;
      const item = linksCache.find(l => l.id === id);
      if (!item) return;

      document.getElementById('linkModalTitle').textContent = 'Edit Menu Link';
      document.getElementById('formLinkId').value = item.id;
      document.getElementById('formSection').value = item.section || 'kurasi';
      document.getElementById('formTitle').value = item.title || '';
      document.getElementById('formDesc').value = item.desc || '';
      document.getElementById('formIcon').value = item.icon || '✨';
      document.getElementById('formUrl').value = item.url || '';
      document.getElementById('formOrder').value = item.order || 1;
      document.getElementById('linkFormError').style.display = 'none';

      openModal('linkModal');
    }

    async function handleSaveLink(event) {
      event.preventDefault();
      if (!auth.currentUser) {
        alert('Akses ditolak: Anda harus login sebagai admin!');
        return;
      }

      const id = document.getElementById('formLinkId').value;
      const section = document.getElementById('formSection').value;
      const title = document.getElementById('formTitle').value.trim();
      const desc = document.getElementById('formDesc').value.trim();
      const icon = document.getElementById('formIcon').value.trim();
      const url = document.getElementById('formUrl').value.trim();
      const order = Number(document.getElementById('formOrder').value) || 1;
      const submitBtn = document.getElementById('btnSaveLinkSubmit');
      const errorEl = document.getElementById('linkFormError');

      submitBtn.disabled = true;
      submitBtn.textContent = 'Menyimpan...';
      errorEl.style.display = 'none';

      const payload = {
        section,
        title,
        desc,
        icon,
        url,
        order,
        updated_at: firebase.firestore.FieldValue.serverTimestamp()
      };

      try {
        if (id) {
          await db.collection('links').doc(id).update(payload);
        } else {
          payload.created_at = firebase.firestore.FieldValue.serverTimestamp();
          await db.collection('links').add(payload);
        }
        closeLinkModal();
      } catch (err) {
        console.error('Error saving link:', err);
        errorEl.textContent = 'Gagal menyimpan: ' + err.message;
        errorEl.style.display = 'block';
      } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Simpan Perubahan';
      }
    }

    async function handleDeleteLink(id, title) {
      if (!auth.currentUser) return;
      if (!confirm(`Hapus link "${title}" secara permanen dari Pendar Loka?`)) return;

      try {
        await db.collection('links').doc(id).delete();
      } catch (err) {
        console.error('Error deleting link:', err);
        alert('Gagal menghapus link: ' + err.message);
      }
    }

    function openEditHighlightModal() {
      if (!auth.currentUser) return;
      document.getElementById('hlBadge').value = highlightData.badge || 'Temuan Terbaru';
      document.getElementById('hlTitle').value = highlightData.title || '7-in-1 Cleaning Kit';
      document.getElementById('hlUrl').value = highlightData.url || '#';
      document.getElementById('hlFormError').style.display = 'none';

      openModal('highlightModal');
    }

    async function handleSaveHighlight(event) {
      event.preventDefault();
      if (!auth.currentUser) return;

      const badge = document.getElementById('hlBadge').value.trim();
      const title = document.getElementById('hlTitle').value.trim();
      const url = document.getElementById('hlUrl').value.trim();
      const submitBtn = document.getElementById('btnSaveHighlightSubmit');

      submitBtn.disabled = true;
      submitBtn.textContent = 'Menyimpan...';

      try {
        await db.collection('links').doc('highlight_latest').set({
          is_highlight: true,
          badge,
          title,
          url,
          updated_at: firebase.firestore.FieldValue.serverTimestamp()
        }, { merge: true });

        highlightData.badge = badge;
        highlightData.title = title;
        highlightData.url = url;
        renderHighlightUI();
        closeHighlightModal();
      } catch (err) {
        console.error('Error saving highlight:', err);
        document.getElementById('hlFormError').textContent = err.message;
        document.getElementById('hlFormError').style.display = 'block';
      } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Simpan Highlight';
      }
    }

    function openModal(modalId) {
      const el = document.getElementById(modalId);
      if (el) el.classList.add('show');
    }

    function closeModal(modalId) {
      const el = document.getElementById(modalId);
      if (el) el.classList.remove('show');
    }

    function openLoginModal() { openModal('loginModal'); }
    function closeLoginModal() { closeModal('loginModal'); }
    function closeLinkModal() { closeModal('linkModal'); }
    function closeHighlightModal() { closeModal('highlightModal'); }

    document.querySelectorAll('.modal-backdrop').forEach((backdrop) => {
      backdrop.addEventListener('click', (e) => {
        if (e.target === backdrop) {
          backdrop.classList.remove('show');
        }
      });
    });

    function escapeHtml(str) {
      if (!str) return '';
      return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
    }

    function getFirebaseAuthErrorMessage(code) {
      switch (code) {
        case 'auth/invalid-credential':
        case 'auth/wrong-password':
        case 'auth/user-not-found':
          return 'Email atau password yang Anda masukkan salah.';
        case 'auth/invalid-email':
          return 'Format alamat email tidak valid.';
        case 'auth/too-many-requests':
          return 'Terlalu banyak percobaan gagal. Silakan coba lagi beberapa saat.';
        default:
          return 'Gagal masuk: Periksa kembali kredensial Anda.';
      }
    }

    initRealtimeListener();
  </script>
</body>
</html>
