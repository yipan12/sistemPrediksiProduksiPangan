<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Produksi</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
            position: relative;
            color: #333;
        }

        .bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .bg img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.08; /* transparansi agar konten tetap terlihat */
        }

        .content {
            padding: 40px;
            position: relative;
            z-index: 1;
        }

        .logo {
            width: 100px;
        }

        .header {
            text-align: center;
            margin-top: -80px;
        }

        h2 {
            margin: 0;
            color: #2e7d32;
        }

        .date {
            text-align: center;
            font-size: 13px;
            color: #555;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ccc;
            margin-top: 20px;
        }

        thead {
            background: linear-gradient(135deg, #b8e5b7, #a3e7c1);
        }

        th, td {
            padding: 10px 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tfoot td {
            padding-top: 15px;
            font-style: italic;
            text-align: center;
            color: #777;
        }

        .footer-note {
            margin-top: 40px;
            font-size: 12px;
            text-align: center;
            color: #888;
        }
    </style>
</head>
<body>

    <!-- Background -->
    <div class="bg">
        <img src="{{ public_path('/asset/backgroundMainPage.png') }}" alt="Background">
    </div>

    <!-- Konten -->
    <div class="content">
        
        <div class="header">
            <!-- Logo -->
            <img src="{{ public_path('/asset/logoSistemPrediksi.png') }}" alt="Logo" class="logo">
            <!-- Header -->
            <h2>Laporan Produksi</h2>
            <div class="date">Tanggal Cetak: {{ date('d M Y') }}</div>
        </div>

        <!-- Tabel data -->
        <table>
            <thead>
                <tr style="background-color: #b8e5b7">
                    <th>Produk</th>
                    <th>Jumlah (Kg)</th>
                    <th>Tanggal</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->produk }}</td>
                        <td>{{ $item->jumlah }} Kg</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Footer -->
        <div class="footer-note">
            Dicetak secara otomatis oleh sistem • Produksi Prediksi Pangan
        </div>
    </div>

</body>
</html>
