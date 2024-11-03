<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #000;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .table-title {
            text-align: center;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .total-row {
            font-weight: bold;
            background-color: #e0e0e0;
        }
    </style>
</head>

<body>
    <div class="table-title">Laporan Pembayaran</div>
    <table>
        <thead>
            <tr>
                <th>Dojo Asal</th>
                <th>Nama</th>
                <th>Tanggal Bukti Diunggah</th>
                <th>Pembayaran Bulan</th>
                <th>Foto Bukti</th>
                <th>Catatan Admin</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody>
            @php
            $totalNominal = 0;
            @endphp

            @foreach ($pembayaran as $items)
            <tr>
                <td>{{ $items->anggota->dojo->nama }}</td>
                <td>{{ $items->anggota->nama }}</td>
                <td>{{ \Carbon\Carbon::parse($items->created_at)->format('d-m-Y') }}</td>
                <td>{{ $items->bulan }}</td>
                <td>
                    @php
                    $path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $items->bukti_pembayaran;
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    @endphp
                    <img src="{{ $base64 }}" width="50" alt="Bukti Pembayaran">
                </td>
                <td>{{ $items->catatan }}</td>
                <td>Rp {{ number_format($items->nominal, 0, ',', '.') }}</td>
            </tr>

            @php
            $totalNominal += $items->nominal;
            @endphp
            @endforeach

            <!-- Total Row -->
            <tr class="total-row">
                <td colspan="6">Total</td>
                <td>Rp {{ number_format($totalNominal, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
