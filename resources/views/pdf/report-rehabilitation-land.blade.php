<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Table to PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .table-container {
            width: 100%;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            word-wrap: break-word;
            /* Khusus untuk membungkus teks */
            word-break: break-word;
            /* Membungkus kata panjang */
            overflow-wrap: break-word;
            /* Membungkus kata panjang */
            text-overflow: ellipsis;
            /* Opsi untuk menambahkan ellipsis jika diperlukan */

        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
            word-wrap: break-word;
            /* Khusus untuk membungkus teks */
            word-break: break-word;
            /* Membungkus kata panjang */
            overflow-wrap: break-word;
            /* Membungkus kata panjang */
            text-overflow: ellipsis;
            /* Opsi untuk menambahkan ellipsis jika diperlukan */


        }

        th {
            font-weight: bold;
            text-align: center;
            font-size: 12px
        }

        td {
            font-size: 12px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <div class="table-container">
        <h2>REHABILITASI HUTAN DAN LAHAN <br> PEMERINTAH KABUPATEN PONOROGO <br> TAHUN: {{ $year }}
        </h2>
        <table style="width: 100%" style='table-layout: fixed'>
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th colspan="3">PELAKSANAAN</th>
                    <th colspan="3">LOKASI</th>
                    <th colspan="2">KOORDINAT</th>
                    <th rowspan="2">LUAS (Ha)</th>
                    <th rowspan="2">JUMLAH BIBIT (BATANG)</th>
                    <th rowspan="2">JENIS TANAMAN</th>
                    <th rowspan="2">SUMBER ANGGARAN</th>
                </tr>
                <tr>
                    <th>TANGGAL</th>
                    <th>PELAKSANA KEGIATAN</th>
                    <th>JENIS KEGIATAN</th>
                    <th>KAB/KOTA</th>
                    <th>KEC.</th>
                    <th>DESA/KEL</th>
                    <th>LS</th>
                    <th>BT</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    @php
                        $sum_seed = $item->seeds->sum('amount');
                    @endphp
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ date_format_human($item->date_of_activity) }}</td>
                        <td>{{ $item->activity_organizer }}</td>
                        <td>{{ $activityType->name ?? '-' }}</td>
                        <td>{{ $item->regency->name ?? '' }}</td>
                        <td>{{ $item->district->name ?? '' }}</td>
                        <td>{{ $item->village->name ?? '' }}</td>
                        <td>{{ $item->latitude }}</td>
                        <td>{{ $item->longitude }}</td>
                        <td style="text-align: center">{{ $item->land_area }}</td>
                        <td style="text-align: center">
                            @foreach ($item->seeds as $seed)
                                <p>{{ $seed->amount }}</p>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($item->seeds as $seed)
                                <p>{{ $seed->seed->name ?? '-' }}</p>
                            @endforeach
                        </td>
                        <td>{{ $item->budgetSource->name ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
