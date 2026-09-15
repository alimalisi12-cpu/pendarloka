<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Theme Initialization (Anti-Flicker) -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('pendar_theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);
        })();
    </script>

    <title><?= site_title($pageTitle ?? '') ?></title>
    <meta name="description" content="<?= htmlspecialchars(site_description()) ?>">

    <!-- Dynamic Favicon -->
    <?php $favUrl = site_favicon_url(); ?>
    <?php if (!empty($favUrl)): ?>
        <link rel="icon" href="<?= htmlspecialchars($favUrl) ?>">
        <link rel="apple-touch-icon" href="<?= htmlspecialchars($favUrl) ?>">
    <?php else: ?>
        <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/833/833472.png" type="image/png">
    <?php endif; ?>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom CSS (Theme Mode Terang & Gelap Berdasarkan Swatch Pendar Loka) -->
    <style>
        /* -------------------------------------------------------------
           COLOR SWATCH PENDAR LOKA (MODE TERANG & GELAP)
           Mode Terang:
           - Background Web: #F7F5F0
           - Tulisan (DEEP PENDAR): #17242A
           - Button (GOLD PENDAR): #D5A84A
           Mode Gelap:
           - Background Web: #17242A
           - Tulisan (DEEP PENDAR): #F7F5F0
           - Button (GOLD PENDAR): #D5A84A
        ------------------------------------------------------------- */
        :root, [data-theme="light"] {
            --pendar-bg: #F7F5F0;
            --pendar-text: #17242A;
            --pendar-gold: #D5A84A;
            --pendar-gold-hover: #BF9438;
            --pendar-card-bg: #FFFFFF;
            --pendar-card-border: rgba(23, 36, 42, 0.08);
            --pendar-nav-bg: rgba(247, 245, 240, 0.95);
            --pendar-muted: #5A6A72;
            --pendar-input-bg: #FFFFFF;
            --pendar-input-border: #DDE2E5;
            --pendar-placeholder: #8C9BA2;
            --pendar-badge-bg: #EDE9E1;
            --pendar-switch-bg: #E8E4DA;
            --pendar-shadow: 0 10px 25px rgba(23, 36, 42, 0.05);

            --primary-color: #D5A84A;
            --primary-hover: #BF9438;
            --secondary-color: #03BB16;
            --dark-color: #17242A;
            --light-bg: #F7F5F0;
        }

        [data-theme="dark"] {
            --pendar-bg: #17242A;
            --pendar-text: #F7F5F0;
            --pendar-gold: #D5A84A;
            --pendar-gold-hover: #E5B85A;
            --pendar-card-bg: #1F2E35;
            --pendar-card-border: rgba(247, 245, 240, 0.12);
            --pendar-nav-bg: rgba(23, 36, 42, 0.95);
            --pendar-muted: #A0B2BA;
            --pendar-input-bg: #19272E;
            --pendar-input-border: #2D414B;
            --pendar-placeholder: rgba(247, 245, 240, 0.65);
            --pendar-badge-bg: #273842;
            --pendar-switch-bg: #131D22;
            --pendar-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);

            --primary-color: #D5A84A;
            --primary-hover: #E5B85A;
            --secondary-color: #03BB16;
            --dark-color: #F7F5F0;
            --light-bg: #17242A;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--pendar-text) !important;
            background-color: var(--pendar-bg) !important;
            overflow-x: hidden;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .navbar-custom {
            backdrop-filter: blur(10px);
            background-color: var(--pendar-nav-bg) !important;
            border-bottom: 1px solid var(--pendar-card-border) !important;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .nav-link {
            font-weight: 500;
            color: var(--pendar-text) !important;
            padding: 8px 16px !important;
            transition: color 0.2s ease;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--pendar-gold) !important;
        }

        /* Tombol Emas Pendar (GOLD PENDAR) */
        .btn-primary-custom, .btn-primary, .btn-gold-pendar {
            background-color: var(--pendar-gold) !important;
            border-color: var(--pendar-gold) !important;
            color: #17242A !important;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover, .btn-primary:hover, .btn-gold-pendar:hover {
            background-color: var(--pendar-gold-hover) !important;
            border-color: var(--pendar-gold-hover) !important;
            color: #17242A !important;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(213, 168, 74, 0.3) !important;
        }

        /* -------------------------------------------------------------
           SELECTED BUTTON COLOR (#D4AA7B) SESUAI GAMBAR USER
           Tombol radio/toggle saat aktif/terpilih (selected button)
        ------------------------------------------------------------- */
        .btn-check:checked + .btn-outline-primary,
        .btn-check:checked + .btn-primary,
        .btn-check:checked + .btn {
            background-color: #D4AA7B !important;
            border-color: #D4AA7B !important;
            color: #FFFFFF !important;
            box-shadow: 0 4px 14px rgba(212, 170, 123, 0.45) !important;
        }

        .btn-outline-primary {
            border-color: #D4AA7B !important;
            color: #D4AA7B !important;
            font-weight: 600;
        }

        .btn-outline-primary:hover {
            background-color: #D4AA7B !important;
            border-color: #D4AA7B !important;
            color: #FFFFFF !important;
        }

        .btn-outline-primary:focus, .btn-outline-primary:active {
            background-color: #D4AA7B !important;
            border-color: #D4AA7B !important;
            color: #FFFFFF !important;
            box-shadow: 0 0 0 0.25rem rgba(212, 170, 123, 0.35) !important;
        }

        .btn-outline-dark {
            border-color: var(--pendar-card-border) !important;
            color: var(--pendar-text) !important;
        }

        .btn-outline-dark:hover {
            background-color: var(--pendar-gold) !important;
            border-color: var(--pendar-gold) !important;
            color: #17242A !important;
        }

        /* DUAL LOGO AUTOMATIC SWITCHER (MODE TERANG & GELAP) */
        .brand-logo-light, .brand-logo-dark {
            height: 76px;
            max-width: 340px;
            width: auto;
            object-fit: contain;
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .brand-logo-light, .brand-logo-dark {
                height: 52px;
                max-width: 230px;
            }
        }

        @media (max-width: 480px) {
            .brand-logo-light, .brand-logo-dark {
                height: 44px;
                max-width: 190px;
            }
        }

        html[data-theme="light"] .brand-logo-dark,
        html:not([data-theme="dark"]) .brand-logo-dark {
            display: none !important;
        }

        html[data-theme="light"] .brand-logo-light,
        html:not([data-theme="dark"]) .brand-logo-light {
            display: inline-block !important;
        }

        html[data-theme="dark"] .brand-logo-light {
            display: none !important;
        }

        html[data-theme="dark"] .brand-logo-dark {
            display: inline-block !important;
        }

        /* Fallback jika hanya 1 logo yang terpasang */
        html[data-theme="dark"] .brand-logo-light.only-one-logo {
            display: inline-block !important;
        }
        html[data-theme="light"] .brand-logo-dark.only-one-logo,
        html:not([data-theme="dark"]) .brand-logo-dark.only-one-logo {
            display: inline-block !important;
        }

        .brand-name-text {
            letter-spacing: -0.5px;
            color: var(--pendar-text) !important;
        }

        .btn-secondary-cta {
            background-color: var(--pendar-card-bg) !important;
            color: var(--pendar-text) !important;
            border: 1px solid var(--pendar-card-border) !important;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary-cta:hover {
            background-color: rgba(213, 168, 74, 0.15) !important;
            color: var(--pendar-gold) !important;
            border-color: var(--pendar-gold) !important;
        }

        /* Card & Kontainer */
        .card, .card-template, .comment-card, .wa-tooltip-box {
            background-color: var(--pendar-card-bg) !important;
            border-color: var(--pendar-card-border) !important;
            color: var(--pendar-text) !important;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .bg-light {
            background-color: var(--pendar-bg) !important;
            transition: background-color 0.3s ease;
        }

        .bg-white {
            background-color: var(--pendar-card-bg) !important;
            color: var(--pendar-text) !important;
            transition: background-color 0.3s ease;
        }

        h1, h2, h3, h4, h5, h6, .text-dark {
            color: var(--pendar-text) !important;
        }

        .text-muted {
            color: var(--pendar-muted) !important;
        }

        .form-control, .form-select {
            background-color: var(--pendar-input-bg) !important;
            border-color: var(--pendar-input-border) !important;
            color: var(--pendar-text) !important;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--pendar-gold) !important;
            box-shadow: 0 0 0 0.25rem rgba(213, 168, 74, 0.25) !important;
            color: var(--pendar-text) !important;
        }

        /* -------------------------------------------------------------
           HINT ISIAN / PLACEHOLDER STYLING (MODE TERANG & GELAP)
        ------------------------------------------------------------- */
        .form-control::placeholder,
        input::placeholder,
        textarea::placeholder {
            color: var(--pendar-placeholder) !important;
            opacity: 1 !important;
        }

        .form-control::-webkit-input-placeholder,
        input::-webkit-input-placeholder,
        textarea::-webkit-input-placeholder {
            color: var(--pendar-placeholder) !important;
            opacity: 1 !important;
        }

        .form-control::-moz-placeholder,
        input::-moz-placeholder,
        textarea::-moz-placeholder {
            color: var(--pendar-placeholder) !important;
            opacity: 1 !important;
        }

        .form-control:-ms-input-placeholder,
        input:-ms-input-placeholder,
        textarea:-ms-input-placeholder {
            color: var(--pendar-placeholder) !important;
            opacity: 1 !important;
        }

        .form-control:focus::placeholder,
        input:focus::placeholder,
        textarea:focus::placeholder {
            opacity: 0.55 !important;
        }

        .form-label, label {
            color: var(--pendar-text) !important;
        }

        .form-text {
            color: var(--pendar-muted) !important;
        }

        .input-group-text {
            background-color: var(--pendar-input-bg) !important;
            border-color: var(--pendar-input-border) !important;
            color: var(--pendar-muted) !important;
        }

        .form-select option {
            background-color: var(--pendar-card-bg) !important;
            color: var(--pendar-text) !important;
        }

        .form-check-input {
            background-color: var(--pendar-input-bg) !important;
            border-color: var(--pendar-input-border) !important;
        }

        .form-check-input:checked {
            background-color: var(--pendar-gold) !important;
            border-color: var(--pendar-gold) !important;
        }

        .badge.bg-light {
            background-color: var(--pendar-badge-bg) !important;
            color: var(--pendar-muted) !important;
            border-color: var(--pendar-card-border) !important;
        }

        .dropdown-menu {
            background-color: var(--pendar-card-bg) !important;
            border: 1px solid var(--pendar-card-border) !important;
            box-shadow: var(--pendar-shadow) !important;
        }

        .dropdown-item {
            color: var(--pendar-text) !important;
        }

        .dropdown-item:hover {
            background-color: rgba(213, 168, 74, 0.15) !important;
            color: var(--pendar-gold) !important;
        }

        .dropdown-divider {
            border-color: var(--pendar-card-border) !important;
        }

        [data-theme="dark"] .btn-light {
            background-color: rgba(247, 245, 240, 0.08) !important;
            border-color: var(--pendar-card-border) !important;
            color: var(--pendar-text) !important;
        }

        [data-theme="dark"] .hero-section-home {
            background: linear-gradient(180deg, #17242A 0%, #1F2E35 100%) !important;
        }

        /* -------------------------------------------------------------
           MODAL & TABS STYLING (MODE TERANG & GELAP)
        ------------------------------------------------------------- */
        .modal-content {
            background-color: var(--pendar-card-bg) !important;
            border: 1px solid var(--pendar-card-border) !important;
            color: var(--pendar-text) !important;
            box-shadow: var(--pendar-shadow) !important;
        }

        .modal-header, .modal-footer {
            border-color: var(--pendar-card-border) !important;
        }

        [data-theme="dark"] .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
            opacity: 0.8;
        }
        [data-theme="dark"] .btn-close:hover {
            opacity: 1;
        }

        /* Nav Tabs in Modals and Pages */
        .nav-tabs {
            border-color: var(--pendar-card-border) !important;
        }

        .nav-tabs .nav-link {
            color: var(--pendar-muted) !important;
            background-color: transparent !important;
            border: 1px solid transparent !important;
            transition: all 0.2s ease;
        }

        .nav-tabs .nav-link:hover {
            color: var(--pendar-gold) !important;
            border-color: var(--pendar-card-border) var(--pendar-card-border) transparent !important;
        }

        .nav-tabs .nav-link.active {
            color: var(--pendar-gold) !important;
            background-color: var(--pendar-input-bg) !important;
            border-color: var(--pendar-card-border) var(--pendar-card-border) transparent !important;
            font-weight: 600;
        }

        [data-theme="dark"] .border-bottom,
        [data-theme="dark"] .border-top,
        [data-theme="dark"] .border {
            border-color: var(--pendar-card-border) !important;
        }

        [data-theme="dark"] .alert-info {
            background-color: rgba(51, 178, 239, 0.12) !important;
            color: #7dd3fc !important;
            border-color: rgba(51, 178, 239, 0.25) !important;
        }

        [data-theme="dark"] .alert-success {
            background-color: rgba(3, 187, 22, 0.12) !important;
            color: #86efac !important;
            border-color: rgba(3, 187, 22, 0.25) !important;
        }

        [data-theme="dark"] .alert-danger {
            background-color: rgba(239, 68, 68, 0.12) !important;
            color: #fca5a5 !important;
            border-color: rgba(239, 68, 68, 0.25) !important;
        }

        /* Inner container cards in modals */
        .modal-body .bg-white,
        .modal-body .p-3.border.rounded-3 {
            background-color: var(--pendar-card-bg) !important;
            border-color: var(--pendar-card-border) !important;
            color: var(--pendar-text) !important;
        }

        /* -------------------------------------------------------------
           TABLE STYLING FOR LIGHT & DARK MODES
        ------------------------------------------------------------- */
        .table {
            --bs-table-bg: transparent !important;
            --bs-table-accent-bg: transparent !important;
            --bs-table-striped-bg: transparent !important;
            --bs-table-hover-bg: rgba(213, 168, 74, 0.08) !important;
            --bs-table-color: var(--pendar-text) !important;
            --bs-table-border-color: var(--pendar-card-border) !important;
            color: var(--pendar-text) !important;
            border-color: var(--pendar-card-border) !important;
        }

        .table > :not(caption) > * > * {
            background-color: transparent !important;
            color: var(--pendar-text) !important;
            border-bottom-color: var(--pendar-card-border) !important;
        }

        .table-hover > tbody > tr:hover > * {
            background-color: rgba(213, 168, 74, 0.08) !important;
            color: var(--pendar-text) !important;
        }

        .table-light, thead.table-light, thead.table-light th {
            background-color: rgba(23, 36, 42, 0.04) !important;
            color: var(--pendar-muted) !important;
            border-bottom-color: var(--pendar-card-border) !important;
        }

        [data-theme="dark"] .table {
            --bs-table-bg: transparent !important;
            --bs-table-accent-bg: transparent !important;
            --bs-table-striped-bg: transparent !important;
            --bs-table-hover-bg: rgba(255, 255, 255, 0.04) !important;
            --bs-table-color: var(--pendar-text) !important;
            --bs-table-border-color: var(--pendar-card-border) !important;
            color: var(--pendar-text) !important;
        }

        [data-theme="dark"] .table > :not(caption) > * > * {
            background-color: transparent !important;
            color: var(--pendar-text) !important;
            border-bottom-color: var(--pendar-card-border) !important;
        }

        [data-theme="dark"] .table-light,
        [data-theme="dark"] thead.table-light,
        [data-theme="dark"] thead.table-light th {
            background-color: rgba(255, 255, 255, 0.04) !important;
            color: var(--pendar-muted) !important;
            border-bottom-color: var(--pendar-card-border) !important;
        }

        [data-theme="dark"] .input-group .form-control {
            background-color: var(--pendar-input-bg) !important;
            border-color: var(--pendar-input-border) !important;
            color: var(--pendar-text) !important;
        }

        [data-theme="dark"] .input-group .btn-outline-secondary {
            border-color: var(--pendar-input-border) !important;
            color: var(--pendar-muted) !important;
        }

        [data-theme="dark"] .input-group .btn-outline-secondary:hover {
            background-color: var(--pendar-gold) !important;
            border-color: var(--pendar-gold) !important;
            color: #17242A !important;
        }

        /* RSVP Badges in Dark Mode */
        [data-theme="dark"] .bg-success-subtle {
            background-color: rgba(37, 211, 102, 0.15) !important;
            color: #2ecc71 !important;
            border-color: rgba(37, 211, 102, 0.25) !important;
        }
        [data-theme="dark"] .bg-warning-subtle {
            background-color: rgba(213, 168, 74, 0.15) !important;
            color: #E5B85A !important;
            border-color: rgba(213, 168, 74, 0.25) !important;
        }
        [data-theme="dark"] .bg-danger-subtle {
            background-color: rgba(239, 68, 68, 0.15) !important;
            color: #f87171 !important;
            border-color: rgba(239, 68, 68, 0.25) !important;
        }

        /* -------------------------------------------------------------
           WIDGET THEME SWITCH (PILL TOGGLE SWITCH)
        ------------------------------------------------------------- */
        .btn-theme-switch {
            background: transparent;
            border: none;
            padding: 0;
            cursor: pointer;
            outline: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 4px;
            vertical-align: middle;
            user-select: none;
        }

        .theme-switch-pill {
            position: relative;
            width: 58px;
            height: 32px;
            background: var(--pendar-switch-bg);
            border: 2px solid var(--pendar-gold);
            border-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 7px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.12);
        }

        .theme-switch-pill .icon-sun {
            font-size: 13px;
            color: var(--pendar-gold);
            transition: all 0.3s ease;
            z-index: 1;
            opacity: 0.9;
        }

        .theme-switch-pill .icon-moon {
            font-size: 12px;
            color: var(--pendar-gold);
            transition: all 0.3s ease;
            z-index: 1;
            opacity: 0.9;
        }

        .theme-switch-slider {
            position: absolute;
            top: 3px;
            left: 3px;
            width: 22px;
            height: 22px;
            background: var(--pendar-gold);
            border-radius: 50%;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            z-index: 2;
        }

        [data-theme="dark"] .theme-switch-slider {
            transform: translateX(26px);
        }

        .theme-switch-pill:hover {
            transform: scale(1.05);
            box-shadow: 0 0 10px rgba(213, 168, 74, 0.35);
        }

        /* Floating WA */
        .wa-floating-btn {
            position: fixed;
            bottom: 25px;
            right: 25px;
            z-index: 1050;
            display: flex;
            align-items: center;
        }

        .wa-floating-btn .wa-circle {
            width: 58px;
            height: 58px;
            background-color: #25D366;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            box-shadow: 0 10px 25px rgba(37, 211, 102, 0.4);
            cursor: pointer;
            transition: transform 0.3s;
            text-decoration: none;
        }

        .wa-floating-btn .wa-circle:hover {
            transform: scale(1.1);
        }

        .wa-tooltip-box {
            background-color: var(--pendar-card-bg) !important;
            border: 1px solid var(--pendar-card-border) !important;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
            padding: 10px 15px;
            margin-right: 14px;
            max-width: 250px;
            font-size: 13px;
            position: relative;
            color: var(--pendar-text) !important;
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease;
        }

        .wa-tooltip-box p,
        .wa-tooltip-box .wa-title {
            color: var(--pendar-text) !important;
        }

        .wa-tooltip-box span,
        .wa-tooltip-box .wa-desc,
        .wa-tooltip-box .text-muted {
            color: var(--pendar-muted) !important;
        }

        .wa-tooltip-box b,
        .wa-tooltip-box strong,
        .wa-tooltip-box .wa-bold {
            color: var(--pendar-gold) !important;
        }

        .card-template {
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: #ffffff;
        }

        .card-template:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.08);
            border-color: #cbd5e1;
        }

        .template-thumb {
            height: 280px;
            background-size: cover;
            background-position: center;
            position: relative;
        }
    </style>
    <?php do_action('site_head'); ?>
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-custom sticky-top py-2">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4 d-flex align-items-center py-0" href="<?= base_url() ?>">
            <?php 
            $logoType = site_setting('site_logo_type', 'icon');
            $logoLight = site_logo_url('light');
            $logoDark = site_logo_url('dark');
            $hasLight = !empty($logoLight);
            $hasDark = !empty($logoDark);
            ?>
            <?php if ($logoType === 'image' && ($hasLight || $hasDark)): ?>
                <?php if ($hasLight): ?>
                    <img src="<?= $logoLight ?>" alt="<?= site_name() ?>" class="brand-logo-light <?= !$hasDark ? 'only-one-logo' : '' ?>">
                <?php endif; ?>
                <?php if ($hasDark): ?>
                    <img src="<?= $logoDark ?>" alt="<?= site_name() ?>" class="brand-logo-dark <?= !$hasLight ? 'only-one-logo' : '' ?>">
                <?php endif; ?>
            <?php else: ?>
                <span class="p-2 rounded-3 text-white me-2 d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: #D4AA7B;">
                    <i class="bi bi-envelope-paper-heart-fill fs-5"></i>
                </span>
                <span class="fw-extrabold brand-name-text"><?= site_name() ?></span>
            <?php endif; ?>
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= empty($baseRoute) ? 'active' : '' ?>" href="<?= base_url() ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($baseRoute ?? '') === 'tema' ? 'active' : '' ?>" href="<?= base_url('tema') ?>">Template</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($baseRoute ?? '') === 'harga' ? 'active' : '' ?>" href="<?= base_url('harga') ?>">Harga</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($baseRoute ?? '') === 'tutorial' ? 'active' : '' ?>" href="<?= base_url('tutorial') ?>">Tutorial</a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-2">
                <?php if (is_logged_in()): ?>
                    <?php if (is_admin()): ?>
                        <div class="dropdown">
                            <button class="btn btn-dark rounded-pill px-3 py-2 fw-semibold dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="bi bi-shield-lock me-1"></i> Admin Panel
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 mt-2">
                                <li><a class="dropdown-item py-2 small fw-semibold" href="<?= base_url('admin') ?>"><i class="bi bi-speedometer2 me-2"></i> Dashboard Admin</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item py-2 small fw-semibold text-primary" href="<?= base_url('admin/settings') ?>"><i class="bi bi-gear-wide-connected me-2"></i> Identitas & Branding Web</a></li>
                                <li><a class="dropdown-item py-2 small" href="<?= base_url('admin/templates') ?>"><i class="bi bi-palette me-2 text-warning"></i> Pengaturan Template</a></li>
                                <li><a class="dropdown-item py-2 small fw-semibold text-info" href="<?= base_url('admin/plugins') ?>"><i class="bi bi-puzzle-fill me-2 text-info"></i> Plugin & Ekstensi</a></li>
                                <li><a class="dropdown-item py-2 small" href="<?= base_url('admin/users') ?>"><i class="bi bi-people me-2 text-primary"></i> Kelola User</a></li>
                                <li><a class="dropdown-item py-2 small" href="<?= base_url('admin/events') ?>"><i class="bi bi-card-checklist me-2 text-success"></i> Seluruh Undangan</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-primary rounded-pill px-3 py-2 fw-semibold">
                            <i class="bi bi-grid me-1"></i> Dashboard
                        </a>
                    <?php endif; ?>

                    <!-- Widget Theme Switch Mode (Terang / Gelap) diantara Tombol Dashboard & Exit -->
                    <button type="button" class="btn-theme-switch" onclick="toggleThemeMode()" title="Ganti Mode Gelap / Terang" aria-label="Ganti Tema">
                        <span class="theme-switch-pill">
                            <i class="bi bi-sun-fill icon-sun" title="Mode Terang"></i>
                            <i class="bi bi-moon-stars-fill icon-moon" title="Mode Gelap"></i>
                            <span class="theme-switch-slider"></span>
                        </span>
                    </button>

                    <a href="<?= base_url('logout') ?>" class="btn btn-light text-danger rounded-pill px-3 py-2" title="Keluar">
                        <i class="bi bi-box-arrow-right"></i>
                    </a>
                <?php else: ?>
                    <!-- Widget Theme Switch Mode untuk Tamu -->
                    <button type="button" class="btn-theme-switch me-1" onclick="toggleThemeMode()" title="Ganti Mode Gelap / Terang" aria-label="Ganti Tema">
                        <span class="theme-switch-pill">
                            <i class="bi bi-sun-fill icon-sun" title="Mode Terang"></i>
                            <i class="bi bi-moon-stars-fill icon-moon" title="Mode Gelap"></i>
                            <span class="theme-switch-slider"></span>
                        </span>
                    </button>

                    <a href="<?= base_url('login') ?>" class="btn btn-link text-decoration-none fw-semibold px-3">
                        Masuk
                    </a>
                    <a href="<?= base_url('register') ?>" class="btn btn-primary-custom rounded-pill px-4 py-2">
                        Mulai Gratis
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<!-- Flash Messages -->
<div class="container mt-3">
    <?php if ($successMsg = get_flash('success')): ?>
        <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm border-0" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> <?= $successMsg ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if ($errorMsg = get_flash('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm border-0" role="alert">
            <i class="bi bi-exclamation-circle-fill me-2"></i> <?= $errorMsg ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
</div>
