<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tamu - <?= htmlspecialchars($event['title']) ?> - PENDAR LOKA</title>
    
    <!-- Favicon -->
    <?php $favUrl = site_favicon_url(); ?>
    <link rel="icon" href="<?= !empty($favUrl) ? htmlspecialchars($favUrl) : 'https://cdn-icons-png.flaticon.com/512/833/833472.png' ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            color: #1e293b;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            font-size: 13px;
            line-height: 1.5;
        }

        /* Top Action Bar (Screen Only) */
        .print-toolbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 12px 24px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }
        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 18px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.2s ease;
        }
        .btn-print {
            background-color: #D4AA7B;
            color: #ffffff;
            border-color: #D4AA7B;
        }
        .btn-print:hover {
            background-color: #c4996a;
            border-color: #c4996a;
            box-shadow: 0 4px 12px rgba(212, 170, 123, 0.4);
        }
        .btn-close-tab {
            background-color: #f1f5f9;
            color: #475569;
            border-color: #cbd5e1;
        }
        .btn-close-tab:hover {
            background-color: #e2e8f0;
            color: #0f172a;
        }

        /* Printable Document Sheet */
        .print-sheet {
            background-color: #ffffff;
            max-width: 960px;
            margin: 30px auto;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
        }

        /* Header Document */
        .doc-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding-bottom: 20px;
            border-bottom: 2px solid #e2e8f0;
            margin-bottom: 24px;
        }
        .brand-title {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #0f172a;
            margin: 0 0 4px 0;
        }
        .event-subtitle {
            font-size: 14px;
            color: #64748b;
            margin: 0;
        }
        .doc-meta {
            text-align: right;
            font-size: 11px;
            color: #64748b;
        }
        .doc-meta strong {
            color: #0f172a;
            font-size: 12px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 24px;
        }
        .stat-item {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px 14px;
            text-align: center;
        }
        .stat-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            display: block;
            margin-bottom: 2px;
            font-weight: 600;
        }
        .stat-val {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
        }

        /* Guest Table */
        .guest-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .guest-table th {
            background-color: #f1f5f9;
            color: #334155;
            font-weight: 700;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            text-align: left;
        }
        .guest-table td {
            padding: 9px 12px;
            border: 1px solid #e2e8f0;
            font-size: 12px;
            vertical-align: middle;
        }
        .guest-table tbody tr:nth-child(even) {
            background-color: #fafbfc;
        }
        .col-center {
            text-align: center;
        }
        .col-right {
            text-align: right;
        }

        /* Status Pills */
        .status-pill {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 50px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .status-attending {
            background-color: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        .status-pending {
            background-color: #fef9c3;
            color: #854d0e;
            border: 1px solid #fef08a;
        }
        .status-not-attending {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .check-box-line {
            display: inline-block;
            width: 18px;
            height: 18px;
            border: 1.5px solid #94a3b8;
            border-radius: 4px;
        }

        /* Footer Notes */
        .doc-footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            font-size: 11px;
            color: #64748b;
        }
        .signature-box {
            text-align: center;
            width: 180px;
        }
        .signature-line {
            margin-top: 50px;
            border-bottom: 1px solid #0f172a;
        }

        /* PRINT MEDIA STYLES */
        @media print {
            body {
                background: #ffffff !important;
                color: #000000 !important;
                font-size: 11px !important;
            }
            .no-print {
                display: none !important;
            }
            .print-sheet {
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                border: none !important;
                box-shadow: none !important;
            }
            .guest-table th {
                background-color: #f1f5f9 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .status-pill {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .stat-item {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            tr {
                page-break-inside: avoid !important;
            }
            @page {
                size: A4 portrait;
                margin: 12mm 15mm;
            }
        }
    </style>
</head>
<body>

    <!-- Screen Toolbar (Hidden when printing) -->
    <div class="print-toolbar no-print">
        <div style="display: flex; align-items: center; gap: 8px;">
            <span style="background-color: rgba(212, 170, 123, 0.2); color: #936B36; padding: 6px 12px; border-radius: 50px; font-size: 12px; font-weight: bold;">
                <i class="bi bi-file-earmark-pdf-fill me-1"></i> Format Cetak & PDF
            </span>
            <span style="font-size: 12px; color: #64748b;">
                Pilih tujuan <b>"Save as PDF"</b> pada jendela cetak untuk menyimpan sebagai file PDF, atau pilih printer Anda.
            </span>
        </div>
        <div style="display: flex; gap: 8px;">
            <button onclick="window.print()" class="btn-action btn-print">
                <i class="bi bi-printer-fill"></i> Cetak / Simpan PDF
            </button>
            <button onclick="window.close()" class="btn-action btn-close-tab">
                <i class="bi bi-x-lg"></i> Tutup Tab
            </button>
        </div>
    </div>

    <!-- Printable Sheet Document -->
    <div class="print-sheet">
        
        <!-- Header -->
        <div class="doc-header">
            <div>
                <h1 class="brand-title">DAFTAR BUKU TAMU & RSVP UNDANGAN</h1>
                <p class="event-subtitle">Acara: <b><?= htmlspecialchars($event['title']) ?></b></p>
                <?php if (!empty($event['event_date'])): ?>
                    <p style="margin: 2px 0 0 0; font-size: 12px; color: #64748b;">
                        Tanggal Acara: <b><?= date('d F Y', strtotime($event['event_date'])) ?></b>
                    </p>
                <?php endif; ?>
            </div>
            <div class="doc-meta">
                <strong><?= site_name() ?></strong><br>
                <span>Dicetak pada: <?= date('d/m/Y H:i') ?> WIB</span><br>
                <span>Master Link: <?= base_url('u/' . $event['slug']) ?></span>
            </div>
        </div>

        <!-- Ringkasan Statistik -->
        <div class="stats-grid">
            <div class="stat-item">
                <span class="stat-label">Total Tamu</span>
                <span class="stat-val"><?= $stats['total'] ?? count($guests) ?></span>
            </div>
            <div class="stat-item" style="border-left: 3px solid #22c55e;">
                <span class="stat-label" style="color: #166534;">Pasti Hadir</span>
                <span class="stat-val" style="color: #166534;"><?= $stats['attending'] ?? 0 ?> <small style="font-size: 11px; font-weight: normal; color: #64748b;">(<?= $stats['total_attendance_pax'] ?? 0 ?> pax)</small></span>
            </div>
            <div class="stat-item" style="border-left: 3px solid #eab308;">
                <span class="stat-label" style="color: #854d0e;">Belum Konfirmasi</span>
                <span class="stat-val" style="color: #854d0e;"><?= $stats['pending'] ?? 0 ?></span>
            </div>
            <div class="stat-item" style="border-left: 3px solid #ef4444;">
                <span class="stat-label" style="color: #991b1b;">Berhalangan</span>
                <span class="stat-val" style="color: #991b1b;"><?= $stats['not_attending'] ?? 0 ?></span>
            </div>
        </div>

        <!-- Tabel Tamu -->
        <table class="guest-table">
            <thead>
                <tr>
                    <th style="width: 35px;" class="col-center">No</th>
                    <th>Nama Tamu / Penerima</th>
                    <th style="width: 130px;">Kontak WhatsApp</th>
                    <th style="width: 120px;" class="col-center">Status RSVP</th>
                    <th style="width: 70px;" class="col-center">Pax</th>
                    <th>Tautan Personal Undangan</th>
                    <th style="width: 80px;" class="col-center">Hadir Fisik</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($guests)): ?>
                    <tr>
                        <td colspan="7" class="col-center" style="padding: 30px; color: #64748b;">
                            Belum ada daftar tamu undangan yang ditambahkan.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php 
                    $no = 1;
                    foreach ($guests as $g): 
                        $personalUrl = base_url('u/' . $event['slug'] . '?kpd=' . urlencode($g['name']));
                    ?>
                        <tr>
                            <td class="col-center"><?= $no++ ?></td>
                            <td>
                                <b><?= htmlspecialchars($g['name']) ?></b>
                            </td>
                            <td>
                                <?= htmlspecialchars($g['phone'] ?: '-') ?>
                            </td>
                            <td class="col-center">
                                <?php if ($g['rsvp_status'] === 'attending'): ?>
                                    <span class="status-pill status-attending">Hadir</span>
                                <?php elseif ($g['rsvp_status'] === 'not_attending'): ?>
                                    <span class="status-pill status-not-attending">Berhalangan</span>
                                <?php else: ?>
                                    <span class="status-pill status-pending">Menunggu</span>
                                <?php endif; ?>
                            </td>
                            <td class="col-center">
                                <?= ($g['rsvp_status'] === 'attending' && !empty($g['attendance_count'])) ? $g['attendance_count'] : '-' ?>
                            </td>
                            <td style="word-break: break-all; font-family: monospace; font-size: 10px; color: #475569;">
                                <?= $personalUrl ?>
                            </td>
                            <td class="col-center">
                                <span class="check-box-line"></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Document Footer -->
        <div class="doc-footer">
            <div>
                <p style="margin: 0; font-weight: 600; color: #0f172a;">Catatan Meja Tamu / Penerima:</p>
                <p style="margin: 2px 0 0 0;">Centang kolom [Hadir Fisik] saat tamu tiba di lokasi resepsi.</p>
                <p style="margin: 2px 0 0 0; color: #94a3b8; font-size: 10px;">Platform: <?= site_name() ?> &bull; <?= base_url() ?></p>
            </div>
            <div class="signature-box">
                <span>Penerima Tamu / PIC,</span>
                <div class="signature-line"></div>
                <span style="font-size: 10px; color: #94a3b8;">( Nama & Tanda Tangan )</span>
            </div>
        </div>

    </div>

    <!-- Script Auto Print on Open -->
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            // Berikan jeda sejenak agar font dan layout selesai dimuat sempurna
            setTimeout(function() {
                window.print();
            }, 600);
        });
    </script>
</body>
</html>
