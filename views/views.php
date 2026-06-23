<?php
require_once '../Koneksi.php';
require_once '../Karyawan.php';
require_once '../KaryawanKontrak.php';
require_once '../KaryawanTetap.php';
require_once '../KaryawanMagang.php';

class Dashboard extends Koneksi {
    protected $tabel = "tabel_karyawan";

    public function dataKaryawanKontrak() {
        $query = "SELECT * FROM " . $this->tabel . " " . KaryawanKontrak::getData();
        $result = mysqli_query($this->koneksi, $query);
        $daftar = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $daftar[] = new KaryawanKontrak(
                    $row['id_karyawan'], $row['nama_karyawan'], $row['departemen'],
                    $row['hari_kerja_masuk'], $row['gaji_dasar_per_hari'],
                    $row['durasi_kontrak_bulan'], $row['agensi_penyalur']
                );
            }
            mysqli_free_result($result);
        } else {
            die("Query Karyawan Kontrak Gagal: " . mysqli_error($this->koneksi));
        }
        return $daftar;
    }

    public function dataKaryawanTetap() {
        $query = "SELECT * FROM " . $this->tabel . " " . KaryawanTetap::getData();
        $result = mysqli_query($this->koneksi, $query);
        $daftar = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $daftar[] = new KaryawanTetap(
                    $row['id_karyawan'], $row['nama_karyawan'], $row['departemen'],
                    $row['hari_kerja_masuk'], $row['gaji_dasar_per_hari'],
                    $row['tunjangan_kesehatan'], $row['opsi_saham_id']
                );
            }
            mysqli_free_result($result);
        } else {
            die("Query Karyawan Tetap Gagal: " . mysqli_error($this->koneksi));
        }
        return $daftar;
    }

    public function dataKaryawanMagang() {
        $query = "SELECT * FROM " . $this->tabel . " " . KaryawanMagang::getData();
        $result = mysqli_query($this->koneksi, $query);
        $daftar = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $daftar[] = new KaryawanMagang(
                    $row['id_karyawan'], $row['nama_karyawan'], $row['departemen'],
                    $row['hari_kerja_masuk'], $row['gaji_dasar_per_hari'],
                    $row['uang_saku_bulanan'], $row['sertifikat_kampus_merdeka']
                );
            }
            mysqli_free_result($result);
        } else {
            die("Query Karyawan Magang Gagal: " . mysqli_error($this->koneksi));
        }
        return $daftar;
    }
}

$dashboard  = new Dashboard();
$dataKontrak = $dashboard->dataKaryawanKontrak();
$dataTetap   = $dashboard->dataKaryawanTetap();
$dataMagang  = $dashboard->dataKaryawanMagang();

$totalSemua   = count($dataKontrak) + count($dataTetap) + count($dataMagang);
$totalKontrak = count($dataKontrak);
$totalTetap   = count($dataTetap);
$totalMagang  = count($dataMagang);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Payroll Karyawan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #f4f5f7;
            --surface:   #ffffff;
            --surface2:  #f0f2f5;
            --border:    rgba(0,0,0,.10);
            --border2:   rgba(0,0,0,.18);
            --text:      #1a1d23;
            --muted:     #6b7280;
            --hint:      #9ca3af;
            --blue:      #2563eb;
            --blue-bg:   #eff6ff;
            --blue-txt:  #1d4ed8;
            --green:     #16a34a;
            --green-bg:  #f0fdf4;
            --green-txt: #15803d;
            --amber:     #d97706;
            --amber-bg:  #fffbeb;
            --amber-txt: #b45309;
            --danger:    #dc2626;
            --danger-bg: #fef2f2;
            --radius-md: 8px;
            --radius-lg: 12px;
        }

        [data-theme="dark"] {
            --bg:        #0d1117;
            --surface:   #161b22;
            --surface2:  #1c2128;
            --border:    rgba(255,255,255,.08);
            --border2:   rgba(255,255,255,.15);
            --text:      #e6edf3;
            --muted:     #8b949e;
            --hint:      #6e7681;
            --blue-bg:   rgba(37,99,235,.15);
            --blue-txt:  #60a5fa;
            --green-bg:  rgba(22,163,74,.15);
            --green-txt: #4ade80;
            --amber-bg:  rgba(217,119,6,.15);
            --amber-txt: #fbbf24;
            --danger-bg: rgba(220,38,38,.15);
        }

        body {
            font-family: system-ui, -apple-system, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: 260px;
            background: var(--surface);
            border-right: 0.5px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 50;
        }
        .sidebar-brand {
            padding: 24px 20px 20px;
            font-size: 16px;
            font-weight: 600;
            border-bottom: 0.5px solid var(--border);
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text);
        }
        .sidebar-brand i { font-size: 20px; color: var(--blue); }
        .sidebar-nav { list-style: none; padding: 12px 10px; flex: 1; }
        .sidebar-nav li { margin-bottom: 2px; }
        .sidebar-nav li a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: var(--radius-md);
            font-size: 13px;
            font-weight: 500;
            color: var(--muted);
            text-decoration: none;
            cursor: pointer;
            transition: background .1s, color .1s;
            border: none;
            background: none;
            width: 100%;
        }
        .sidebar-nav li a i { font-size: 16px; }
        .sidebar-nav li a:hover,
        .sidebar-nav li.active a {
            background: var(--surface2);
            color: var(--text);
        }
        .sidebar-nav li.active a { font-weight: 600; }
        .sidebar-nav li.active.k a { color: var(--blue-txt); }
        .sidebar-nav li.active.t a { color: var(--green-txt); }
        .sidebar-nav li.active.m a { color: var(--amber-txt); }
        .sidebar-footer {
            padding: 16px 20px;
            border-top: 0.5px solid var(--border);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: var(--blue-bg);
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 600;
            color: var(--blue-txt);
            flex-shrink: 0;
        }
        .sidebar-footer-info p { font-size: 13px; font-weight: 600; }
        .sidebar-footer-info span { font-size: 11px; color: var(--muted); }

        /* ── Main ── */
        .main {
            margin-left: 260px;
            flex: 1;
            padding: 32px 36px;
            min-width: 0;
        }

        /* ── Topbar ── */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 28px;
            flex-wrap: wrap;
        }
        .search-wrap { position: relative; }
        .search-wrap i {
            position: absolute;
            left: 12px; top: 50%;
            transform: translateY(-50%);
            color: var(--hint);
            font-size: 16px;
            pointer-events: none;
        }
        .search-wrap input {
            padding: 9px 14px 9px 36px;
            width: 320px;
            border: 0.5px solid var(--border2);
            border-radius: 30px;
            background: var(--surface);
            color: var(--text);
            font-size: 13px;
            outline: none;
            transition: border-color .15s;
        }
        .search-wrap input:focus { border-color: var(--blue); }

        .theme-toggle {
            display: flex; align-items: center; gap: 8px;
            font-size: 12px; color: var(--muted);
        }
        .toggle-track {
            width: 42px; height: 22px;
            background: var(--surface2);
            border: 0.5px solid var(--border2);
            border-radius: 11px;
            position: relative;
            cursor: pointer;
            transition: background .2s;
        }
        .toggle-track.on { background: var(--blue); border-color: var(--blue); }
        .toggle-thumb {
            position: absolute;
            top: 3px; left: 3px;
            width: 16px; height: 16px;
            border-radius: 50%;
            background: #fff;
            transition: transform .2s;
        }
        .toggle-track.on .toggle-thumb { transform: translateX(20px); }

        /* ── Summary cards ── */
        .summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
            gap: 12px;
            margin-bottom: 28px;
        }
        .sum-card {
            background: var(--surface);
            border: 0.5px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 16px 18px;
        }
        .sum-label { font-size: 12px; color: var(--muted); margin-bottom: 8px; }
        .sum-val { font-size: 26px; font-weight: 600; }
        .sum-val.blue { color: var(--blue-txt); }
        .sum-val.green { color: var(--green-txt); }
        .sum-val.amber { color: var(--amber-txt); }

        /* ── Section heading ── */
        .sec-head {
            display: flex; align-items: center; gap: 8px;
            font-size: 13px; font-weight: 600;
            color: var(--muted);
            margin: 28px 0 14px;
            padding-bottom: 8px;
            border-bottom: 0.5px solid var(--border);
            text-transform: uppercase; letter-spacing: .5px;
        }
        .sec-head i { font-size: 16px; }
        .sec-head.blue { color: var(--blue-txt); }
        .sec-head.green { color: var(--green-txt); }
        .sec-head.amber { color: var(--amber-txt); }

        /* ── Card grid ── */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 14px;
        }
        .emp-card {
            background: var(--surface);
            border: 0.5px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 18px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            transition: border-color .15s, transform .15s;
        }
        .emp-card:hover {
            border-color: var(--border2);
            transform: translateY(-2px);
        }
        .card-toprow {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .emp-id {
            font-size: 11px;
            font-family: monospace;
            color: var(--hint);
            background: var(--surface2);
            padding: 3px 8px;
            border-radius: var(--radius-md);
        }
        .badge {
            font-size: 10px; font-weight: 700;
            padding: 3px 10px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: .4px;
        }
        .badge.kontrak { background: var(--blue-bg); color: var(--blue-txt); }
        .badge.tetap   { background: var(--green-bg); color: var(--green-txt); }
        .badge.magang  { background: var(--amber-bg); color: var(--amber-txt); }

        .emp-name { font-size: 15px; font-weight: 600; }
        .emp-dept {
            font-size: 12px; color: var(--muted);
            display: flex; align-items: center; gap: 5px;
        }
        .emp-dept i { font-size: 13px; }

        hr.divider { border: none; border-top: 0.5px solid var(--border); }

        .info-row {
            display: flex; justify-content: space-between;
            font-size: 12px; gap: 8px;
        }
        .info-row .lbl { color: var(--muted); }
        .info-row .val { font-weight: 600; text-align: right; }

        .extra-box {
            background: var(--surface2);
            border: 0.5px dashed var(--border2);
            border-radius: var(--radius-md);
            padding: 10px 12px;
            font-size: 11px;
            color: var(--muted);
            line-height: 1.7;
        }
        .extra-box strong { color: var(--text); font-weight: 600; }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 10px;
            border-top: 0.5px solid var(--border);
            margin-top: auto;
        }
        .footer-lbl {
            font-size: 10px; font-weight: 700;
            color: var(--hint); letter-spacing: .4px;
            text-transform: uppercase;
        }
        .footer-val { font-size: 16px; font-weight: 700; }
        .footer-val.blue  { color: var(--blue-txt); }
        .footer-val.green { color: var(--green-txt); }
        .footer-val.amber { color: var(--amber-txt); }

        /* ── No result ── */
        #no-result {
            display: none;
            background: var(--danger-bg);
            border: 0.5px solid rgba(220,38,38,.25);
            border-radius: var(--radius-md);
            padding: 12px 16px;
            font-size: 13px;
            color: var(--danger);
            margin-bottom: 20px;
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main { margin-left: 0; padding: 20px 16px; }
            .search-wrap input { width: 100%; }
        }
    </style>
</head>
<body>

<nav class="sidebar">
    <div class="sidebar-brand">
        <i class="ti ti-report-money"></i>
        Dashboard Payroll
    </div>
    <ul class="sidebar-nav">
        <li class="active nav-all" onclick="switchTab('all', this)">
            <a><i class="ti ti-users"></i> Semua Karyawan</a>
        </li>
        <li class="nav-k k" onclick="switchTab('kontrak', this)">
            <a><i class="ti ti-file-text"></i> Karyawan Kontrak</a>
        </li>
        <li class="nav-t t" onclick="switchTab('tetap', this)">
            <a><i class="ti ti-briefcase"></i> Karyawan Tetap</a>
        </li>
        <li class="nav-m m" onclick="switchTab('magang', this)">
            <a><i class="ti ti-school"></i> Karyawan Magang</a>
        </li>
    </ul>
    <div class="sidebar-footer">
        <div class="avatar">MZ</div>
        <div class="sidebar-footer-info">
            <p>Muhammad Zaki</p>
            <span>Payroll Administrator</span>
        </div>
    </div>
</nav>

<main class="main">
    <header class="topbar">
        <div class="search-wrap">
            <i class="ti ti-search"></i>
            <input type="text" id="searchInput" oninput="filterData()"
                   placeholder="Cari nama, departemen, ID...">
        </div>
        <div class="theme-toggle">
            <span><i class="ti ti-sun"></i></span>
            <div class="toggle-track" id="themeToggle" onclick="toggleTheme()">
                <div class="toggle-thumb"></div>
            </div>
            <span><i class="ti ti-moon"></i></span>
        </div>
    </header>

    <!-- Summary -->
    <div class="summary">
        <div class="sum-card">
            <div class="sum-label">Total Karyawan</div>
            <div class="sum-val"><?= $totalSemua ?></div>
        </div>
        <div class="sum-card">
            <div class="sum-label">Karyawan Kontrak</div>
            <div class="sum-val blue"><?= $totalKontrak ?></div>
        </div>
        <div class="sum-card">
            <div class="sum-label">Karyawan Tetap</div>
            <div class="sum-val green"><?= $totalTetap ?></div>
        </div>
        <div class="sum-card">
            <div class="sum-label">Karyawan Magang</div>
            <div class="sum-val amber"><?= $totalMagang ?></div>
        </div>
    </div>

    <div id="no-result">
        <i class="ti ti-search-off"></i>
        Data karyawan tidak ditemukan.
    </div>

    <!-- Kontrak -->
    <section id="section-kontrak">
        <div class="sec-head blue">
            <i class="ti ti-file-text"></i> Karyawan Kontrak
        </div>
        <div class="card-grid">
            <?php if (empty($dataKontrak)): ?>
                <p style="color:var(--muted);font-size:13px">Tidak ada data karyawan kontrak.</p>
            <?php else: ?>
                <?php foreach ($dataKontrak as $k): ?>
                <div class="emp-card searchable-row" data-jenis="kontrak">
                    <div class="card-toprow">
                        <span class="emp-id">#EMP-<?= $k->getIdKaryawan() ?></span>
                        <span class="badge kontrak">Kontrak</span>
                    </div>
                    <div>
                        <div class="emp-name"><?= htmlspecialchars($k->getNamaKaryawan()) ?></div>
                        <div class="emp-dept">
                            <i class="ti ti-building"></i>
                            <?= htmlspecialchars($k->getDepartemen()) ?>
                        </div>
                    </div>
                    <hr class="divider">
                    <div class="info-row">
                        <span class="lbl">Kehadiran kerja</span>
                        <span class="val"><?= $k->getHariKerjaMasuk() ?> hari</span>
                    </div>
                    <div class="info-row">
                        <span class="lbl">Gaji dasar harian</span>
                        <span class="val">Rp <?= number_format($k->getGajiDasarPerHari(), 0, ',', '.') ?></span>
                    </div>
                    <div class="extra-box">
                        <strong>Profil:</strong><br>
                        <?= htmlspecialchars($k->tampilkanProfilKaryawan()) ?>
                    </div>
                    <div class="card-footer">
                        <span class="footer-lbl">Gaji Bersih</span>
                        <span class="footer-val blue">Rp <?= number_format($k->hitungGajiBersih(), 0, ',', '.') ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <!-- Tetap -->
    <section id="section-tetap">
        <div class="sec-head green">
            <i class="ti ti-briefcase"></i> Karyawan Tetap
        </div>
        <div class="card-grid">
            <?php if (empty($dataTetap)): ?>
                <p style="color:var(--muted);font-size:13px">Tidak ada data karyawan tetap.</p>
            <?php else: ?>
                <?php foreach ($dataTetap as $k): ?>
                <div class="emp-card searchable-row" data-jenis="tetap">
                    <div class="card-toprow">
                        <span class="emp-id">#EMP-<?= $k->getIdKaryawan() ?></span>
                        <span class="badge tetap">Tetap</span>
                    </div>
                    <div>
                        <div class="emp-name"><?= htmlspecialchars($k->getNamaKaryawan()) ?></div>
                        <div class="emp-dept">
                            <i class="ti ti-building"></i>
                            <?= htmlspecialchars($k->getDepartemen()) ?>
                        </div>
                    </div>
                    <hr class="divider">
                    <div class="info-row">
                        <span class="lbl">Kehadiran kerja</span>
                        <span class="val"><?= $k->getHariKerjaMasuk() ?> hari</span>
                    </div>
                    <div class="info-row">
                        <span class="lbl">Gaji dasar harian</span>
                        <span class="val">Rp <?= number_format($k->getGajiDasarPerHari(), 0, ',', '.') ?></span>
                    </div>
                    <div class="extra-box">
                        <strong>Profil:</strong><br>
                        <?= htmlspecialchars($k->tampilkanProfilKaryawan()) ?>
                    </div>
                    <div class="card-footer">
                        <span class="footer-lbl">Gaji Bersih + Tunjangan</span>
                        <span class="footer-val green">Rp <?= number_format($k->hitungGajiBersih(), 0, ',', '.') ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <!-- Magang -->
    <section id="section-magang">
        <div class="sec-head amber">
            <i class="ti ti-school"></i> Karyawan Magang
        </div>
        <div class="card-grid">
            <?php if (empty($dataMagang)): ?>
                <p style="color:var(--muted);font-size:13px">Tidak ada data karyawan magang.</p>
            <?php else: ?>
                <?php foreach ($dataMagang as $k): ?>
                <div class="emp-card searchable-row" data-jenis="magang">
                    <div class="card-toprow">
                        <span class="emp-id">#EMP-<?= $k->getIdKaryawan() ?></span>
                        <span class="badge magang">Magang</span>
                    </div>
                    <div>
                        <div class="emp-name"><?= htmlspecialchars($k->getNamaKaryawan()) ?></div>
                        <div class="emp-dept">
                            <i class="ti ti-building"></i>
                            <?= htmlspecialchars($k->getDepartemen()) ?>
                        </div>
                    </div>
                    <hr class="divider">
                    <div class="info-row">
                        <span class="lbl">Kehadiran kerja</span>
                        <span class="val"><?= $k->getHariKerjaMasuk() ?> hari</span>
                    </div>
                    <div class="info-row">
                        <span class="lbl">Uang harian pokok</span>
                        <span class="val">Rp <?= number_format($k->getGajiDasarPerHari(), 0, ',', '.') ?></span>
                    </div>
                    <div class="extra-box">
                        <strong>Profil:</strong><br>
                        <?= htmlspecialchars($k->tampilkanProfilKaryawan()) ?>
                    </div>
                    <div class="card-footer">
                        <span class="footer-lbl">Gaji Bersih (Potongan 20%)</span>
                        <span class="footer-val amber">Rp <?= number_format($k->hitungGajiBersih(), 0, ',', '.') ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
</main>

<script>
    let curTab = 'all';

    function switchTab(tab, el) {
        curTab = tab;
        document.querySelectorAll('.sidebar-nav li').forEach(li => li.classList.remove('active'));
        el.classList.add('active');
        document.getElementById('searchInput').value = '';
        filterData();
    }

    function filterData() {
        const q = document.getElementById('searchInput').value.toLowerCase().trim();
        const sections = {
            kontrak: document.getElementById('section-kontrak'),
            tetap:   document.getElementById('section-tetap'),
            magang:  document.getElementById('section-magang'),
        };
        let totalVisible = 0;

        for (const [jenis, sec] of Object.entries(sections)) {
            const showSec = (curTab === 'all' || curTab === jenis);
            if (!showSec) { sec.style.display = 'none'; continue; }

            const cards = sec.querySelectorAll('.searchable-row');
            let vis = 0;
            cards.forEach(card => {
                const match = !q || card.textContent.toLowerCase().includes(q);
                card.style.display = match ? '' : 'none';
                if (match) vis++;
            });

            sec.style.display = (vis === 0 && q) ? 'none' : 'block';
            totalVisible += vis;
        }

        document.getElementById('no-result').style.display =
            (totalVisible === 0 && q) ? 'block' : 'none';
    }

    function toggleTheme() {
        const track = document.getElementById('themeToggle');
        const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
        if (isDark) {
            document.documentElement.removeAttribute('data-theme');
            track.classList.remove('on');
        } else {
            document.documentElement.setAttribute('data-theme', 'dark');
            track.classList.add('on');
        }
    }
</script>
</body>
</html>