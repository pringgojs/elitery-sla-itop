<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Permohonan Pengadaan Barang {{ $transaction->code }}</title>
</head>

<body style="font-family: Arial, sans-serif;">
    <table style="width:100%; border-collapse: collapse; font-family: Arial, sans-serif;font-size:12px">
        <thead>
            <tr>
                <th colspan="7" style="text-align: center; font-weight: bold; font-size: 16px; padding: 10px;">
                    FORMULIR PERMOHONAN PENGADAAN BARANG</th>
            </tr>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2" style="padding: 5px; font-weight: bold;text-align:left">
                    Nomor Referensi</td>
                <td style="padding: 5px; font-weight: bold;text-align:left">:</td>
                <td colspan="4" style="width:500px; padding: 5px; font-weight: bold;text-align:left">
                    {{ $transaction->code }}</td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 5px; font-weight: bold;text-align:left">
                    Tanggal Permohonan</td>
                <td style="padding: 5px; font-weight: bold;text-align:left">:</td>
                <td colspan="4" style="width:500px; padding: 5px; font-weight: bold;text-align:left">
                    {{ $transaction->created_at }}</td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 5px; font-weight: bold;text-align:left">
                    Divisi yang Membutuhkan</td>
                <td style="padding: 5px; font-weight: bold;text-align:left">:</td>
                <td colspan="4" style="width:500px; padding: 5px; font-weight: bold;text-align:left">
                    {{ ucwords(strtolower($transaction->creator->department->name ?? '')) }} -
                    {{ $transaction->creator->department->departmentDetail->location ?? '' }}</td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 5px; font-weight: bold;text-align:left">
                    Dibutuhkan Tanggal</td>
                <td style="padding: 5px; font-weight: bold;text-align:left">:</td>
                <td colspan="4" style="width:500px; padding: 5px; font-weight: bold;text-align:left">
                    {{ date_format_human($transaction->date_required) }}</td>
            </tr>
            <tr>
                <td colspan="7" style="height: 10px"></td>
            </tr>
        </tbody>
    </table>
    <table style="width:100%; border-collapse: collapse; font-family: Arial, sans-serif;font-size:12px">
        <thead>
            <tr style="text-align: center;">
                <td style="border: 1px solid black; padding: 5px; font-weight: bold;">KODE BARANG</td>
                <td colspan="4"
                    style="text-align: center; border: 1px solid black; padding: 5px; font-weight: bold;">
                    NAMA BARANG /
                    BAHAN
                </td>
                <td style="border: 1px solid black; padding: 5px; font-weight: bold;">JUMLAH</td>
                <td style="border: 1px solid black; padding: 5px; font-weight: bold;">SATUAN</td>
                <td style="border: 1px solid black; padding: 5px; font-weight: bold;">PERKIRAAN HARGA
                </td>
            </tr>
        </thead>
        @foreach ($transaction->details as $item)
            <tr>
                <td style="border: 1px solid black; padding: 5px;">{{ $item->good->code ?? '-' }}</td>
                <td colspan="4" style="border: 1px solid black; padding: 5px;">
                    {{ $item->good->name ?? $item->good_name }}</td>
                <td style="border: 1px solid black; padding: 5px;text-align: center">{{ $item->total }}</td>
                <td style="border: 1px solid black; padding: 5px;">{{ $item->unit_name }}</td>
                <td style="border: 1px solid black; padding: 5px; text-align: right">
                    {{ format_rupiah($item->price_estimate) }}</td>
            </tr>
        @endforeach

        <tr>
            <td colspan="8">
                <table style="width: 100%; border-collapse: collapse">
                    <tr>
                        <td style="padding: 5px; font-weight: bold; text-align: center;">
                            Divisi Pemohon</td>
                        <td style="padding: 5px; font-weight: bold; text-align: center;">
                            Manager HRD & GA</td>

                    </tr>
                    <tr>
                        <td style="padding: 5px;font-weight:bold; text-align:center">
                            <br><br><br><br>
                            {{ $transaction->creator->name ?? '' }} <br>
                            {{ ucwords(strtolower($transaction->creator->department->name ?? '')) }} <br>
                            {{ $transaction->creator->department->departmentDetail->location ?? '' }}
                        </td>
                        <td style="padding: 5px;font-weight:bold; text-align:center">
                            <br><br><br><br>
                            ...............
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</body>

</html>
