<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengaduan #{{ $putra_pengaduan->id_pengaduan }}</title>
    <style>
        @media print {
            @page {
                size: A4;
                margin: 0;
            }
            body {
                margin: 0;
                padding: 10mm;
                font-size: 10pt;
                line-height: 1.3;
            }
            .print-hidden {
                display: none;
            }
        }
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .logo {
            width: 60px;
            height: auto;
            float: left;
            margin-right: 10px;
        }
        .header-text {
            text-align: left;
        }
        .content {
            clear: both;
        }
        .section {
            margin-bottom: 15px;
        }
        .section-title {
            font-weight: bold;
            border-bottom: 1px solid black;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .label {
            font-weight: bold;
            width: 120px;
            display: inline-block;
        }
        .status {
            display: inline-block;
            padding: 2px 5px;
            border-radius: 10px;
            font-size: 0.9em;
        }
        .status-waiting { background-color: #FEF3C7; color: #92400E; }
        .status-process { background-color: #DBEAFE; color: #1E40AF; }
        .status-done { background-color: #D1FAE5; color: #065F46; }
        .evidence-image {
            width: 100px;
            height: auto;
        }
        .response {
            background-color: #F3F4F6;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .footer {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('asset/images/images-removebg-preview.png') }}" alt="Logo" class="logo">
        <div class="header-text">
            <h1 style="font-size: 14pt; margin: 0;">PEMERINTAH KABUPATEN BANDUNG</h1>
            <h2 style="font-size: 12pt; margin: 0;">DINAS KOMUNIKASI, INFORMATIKA DAN STATISTIK</h2>
            <h3 style="font-size: 12pt; margin: 0;">LAPOR MAS</h3>
            <p style="font-size: 10pt; margin: 0;">LAYANAN PENGADUAN MASYARAKAT</p>
            <p style="font-size: 8pt; margin: 0;">Jl. Raya Soreang KM.17, Pamekaran, Kec. Soreang, Kabupaten Bandung</p>
            <p style="font-size: 8pt; margin: 0;">Telepon: (022) 5897237 | Email: diskominfo@bandungkab.go.id</p>
        </div>
    </div>

    <div class="content">
        <div class="section">
            <h3 class="section-title">A. Profil Pelapor</h3>
            <div class="grid">
                <div><span class="label">Nama Pelapor</span>: {{ $putra_pengaduan->putra_masyarakat->nama ?? 'Anonim' }}</div>
                <div><span class="label">NIK</span>: {{ $putra_pengaduan->nik }}</div>
                <div><span class="label">No Hp</span>: {{ $putra_pengaduan->putra_masyarakat->telp ?? '-' }}</div>
            </div>
        </div>

        <div class="section">
            <h3 class="section-title">B. Informasi Pengaduan</h3>
            <div class="grid">
                <div><span class="label">Nomor Pengaduan</span>: {{ $putra_pengaduan->id_pengaduan }}</div>
                <div><span class="label">Tanggal Pengaduan</span>: {{ \Carbon\Carbon::parse($putra_pengaduan->tgl_pengaduan)->translatedFormat('d F Y') }}</div>
                <div>
                    <span class="label">Status Pengaduan</span>:
                    <span class="status {{ $putra_pengaduan->status == '0' ? 'status-waiting' : ($putra_pengaduan->status == 'proses' ? 'status-process' : 'status-done') }}">
                        {{ $putra_pengaduan->status == '0' ? 'Menunggu' : ($putra_pengaduan->status == 'proses' ? 'Proses' : 'Selesai') }}
                    </span>
                </div>
            </div>
        </div>

        <div class="section">
            <h3 class="section-title">C. Isi Laporan</h3>
            <p>{{ $putra_pengaduan->isi_laporan }}</p>
        </div>

        @if($putra_pengaduan->foto)
        <div class="section">
            <h3 class="section-title">D. Bukti Laporan</h3>
            <img src="{{ asset('storage/'.$putra_pengaduan->foto) }}" alt="Bukti foto pengaduan" class="evidence-image">
            <p style="font-size: 8pt;">Bukti foto pengaduan - {{ \Carbon\Carbon::parse($putra_pengaduan->tgl_pengaduan)->translatedFormat('d F Y') }}</p>
        </div>
        @endif

        @if($putra_pengaduan->putra_tanggapan->isNotEmpty())
        <div class="section">
            <h3 class="section-title">E. Tanggapan</h3>
            @foreach($putra_pengaduan->putra_tanggapan as $tanggapan)
            <div class="response">
                <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                    <span style="font-weight: bold;">{{ $tanggapan->putra_petugas->nama_petugas }}</span>
                    <span style="font-size: 8pt;">{{ \Carbon\Carbon::parse($tanggapan->tgl_tanggapan)->translatedFormat('d F Y') }}</span>
                </div>
                <p style="margin: 0;">{{ $tanggapan->tanggapan }}</p>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <div class="footer">
        <p>Bandung, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p>Pelapor,</p>
        <div style="height: 40px;"></div>
        <p style="font-weight: bold;">{{ $putra_pengaduan->putra_masyarakat->nama ?? 'Anonim' }}</p>
    </div>

    <div class="print-hidden" style="margin-top: 20px; text-align: center;">
        <button onclick="window.print()" style="padding: 10px 20px; background-color: #10B981; color: white; border: none; border-radius: 5px; cursor: pointer; margin-right: 10px;">
            Cetak Laporan
        </button>
        <button onclick="window.close()" style="padding: 10px 20px; background-color: #EF4444; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Tutup
        </button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.print();
        });
    </script>
</body>
</html>

