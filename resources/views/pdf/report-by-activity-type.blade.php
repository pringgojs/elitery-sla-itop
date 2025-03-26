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
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            font-weight: bold;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <div class="table-container">
        <h2>DATA GERAKAN PENANAMAN POHON <br> PEMERINTAH KABUPATEN PONOROGO <br> TAHUN: {{ $year }}
        </h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Luas Lahan (Ha)</th>
                    <th>Jumlah Bibit (Batang)</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total_land_area = 0;
                    $total_seed = 0;
                @endphp
                @foreach ($items as $item)
                    @php
                        $totalSeed = \App\Models\PlantingActivity::getTotalSeed($item->id, $year);
                        $totalLandArea = \App\Models\PlantingActivity::getTotalLandArea($item->id, $year);
                        $total_seed += $totalSeed;
                        $total_land_area += $totalLandArea;
                    @endphp
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $totalLandArea }}</td>
                        <td>{{ $totalSeed }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2" align="right">Total Luas Lahan (Ha)</td>
                    <td colspan="2">{{ $total_land_area }}</td>
                </tr>
                <tr>
                    <td colspan="2" align="right">Total Jumlah Bibit (Batang)</td>
                    <td colspan="2">{{ $total_seed }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
