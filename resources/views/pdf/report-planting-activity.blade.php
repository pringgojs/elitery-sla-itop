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
        <h2>DATA GERAKAN PENANAMAN POHON <br> PEMERINTAH KABUPATEN PONOROGO <br>TAHUN : {{ $year }}
        </h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kegiatan</th>
                    <th>Pelaksana Kegiatan</th>
                    <th>Wilayah</th>
                    <th>Luas Lahan (Ha)</th>
                    <th>Jumlah Bibit</th>
                    <th>Sumber Dana</th>
                    <th>Sumber Bibit</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total_land_area = 0;
                    $total_seed = 0;
                @endphp
                @foreach ($items as $item)
                    @php
                        $sum_seed = $item->seeds->sum('amount');
                        $total_seed += $sum_seed;
                        $total_land_area += $item->land_area;
                    @endphp
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->date_of_activity }}</td>
                        <td>{{ $item->activityType->name ?? '-' }}</td>
                        <td>{{ $item->activity_organizer }}</td>
                        <td>{{ $item->village->name ?? '' }} - {{ $item->district->name ?? '' }} -
                            {{ $item->regency->name ?? '' }}</td>
                        <td>{{ $item->land_area }}</td>
                        <td>{{ $sum_seed }}</td>
                        <td>{{ $item->budgetSource->name ?? '-' }}</td>
                        <td>{{ $item->seedSource->name ?? '-' }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" align="right">Total Luas Lahan (Ha)</td>
                    <td colspan="4">{{ $total_land_area }}</td>
                </tr>
                <tr>
                    <td colspan="5" align="right">Total Jumlah Bibit (Batang)</td>
                    <td colspan="4">{{ $total_seed }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
