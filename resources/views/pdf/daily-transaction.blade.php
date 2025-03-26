<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Bukti Pengeluaran Barang {{ $transaction->code }}</title>
</head>

<body style="font-family: Arial, sans-serif;">
    <table style="width:100%; border-collapse: collapse; font-family: Arial, sans-serif;font-size:12px">
        <thead>
            <tr>
                <th colspan="9" style="text-align: center; font-weight: bold; font-size: 16px; padding: 10px;">
                    BUKTI PENGELUARAN BARANG / BAHAN</th>
            </tr>
            <tr>
                <th colspan="9" style="text-align: center; font-weight: bold; font-size: 16px; padding: 5px;">
                    GUDANG UMUM</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid black; padding: 5px; font-weight: bold;text-align:center">DIMINTA OLEH</td>
                <td style="border: 1px solid black; padding: 5px; font-weight: bold;text-align:center">TANGGAL</td>
                <td style="border: 1px solid black; padding: 5px; font-weight: bold;text-align:center">SIE/UNIT KERJA
                </td>
                <td colspan="4"
                    style="border: 1px solid black; padding: 5px; font-weight: bold; text-align: center;">
                    DISETUJUI
                    OLEH:</td>
                <td rowspan="4" colspan="2"
                    style="border: 1px solid black; padding: 5px; font-weight: bold; text-align: center;">NO BUKTI
                </td>
            </tr>
            <tr>
                <td rowspan="3"
                    style="border: 1px solid black; padding: 5px;vertical-align: bottom; text-align: center;">
                    {{ $transaction->creator->name }}</td>
                <td rowspan="3"
                    style="border: 1px solid black; padding: 5px;vertical-align: bottom; text-align: center;">
                    {{ $transaction->created_at }}</td>
                <td rowspan="3"
                    style="border: 1px solid black; padding: 5px;vertical-align: bottom; text-align: center;">
                    {{ ucwords(strtolower($transaction->creator->department->name ?? '')) ?? '' }} <br>
                    {{ $transaction->creator->department->departmentDetail->location ?? '' }}</td>
                <td colspan="2" style="border: 1px solid black; padding: 5px; text-align: center; font-weight: bold">
                    PEJABAT
                    UNIT KERJA</td>
                <td colspan="2" style="border: 1px solid black; padding: 5px; text-align: center; font-weight: bold">
                    PPHP</td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 5px; text-align: center; font-weight: bold">Nama</td>
                <td style="border: 1px solid black; padding: 5px; text-align: center; font-weight: bold">Paraf</td>
                <td style="border: 1px solid black; padding: 5px; text-align: center; font-weight: bold">Nama</td>
                <td style="border: 1px solid black; padding: 5px; text-align: center; font-weight: bold">Paraf</td>
            </tr>
            <tr>
                <td style="border: 1px solid black; height: 50px;text-align: center; vertical-align: bottom"><span
                        style="">......</span>
                </td>
                <td style="border: 1px solid black; height: 50px;text-align: center; vertical-align: bottom"><span
                        style="">......</span>
                </td>
                <td style="border: 1px solid black; height: 50px;text-align: center; vertical-align: bottom"><span
                        style="">......</span>
                </td>
                <td style="border: 1px solid black; height: 50px;text-align: center; vertical-align: bottom"><span
                        style="">......</span>
                </td>
            </tr>
            <tr style="text-align: center;">
                <td style="border: 1px solid black; padding: 5px; font-weight: bold;">KODE BARANG</td>
                <td colspan="4"
                    style="text-align: center; border: 1px solid black; padding: 5px; font-weight: bold;">NAMA BARANG /
                    BAHAN
                </td>
                <td style="border: 1px solid black; padding: 5px; font-weight: bold;">SATUAN</td>
                <td style="border: 1px solid black; padding: 5px; font-weight: bold;">JUMLAH</td>
                <td colspan="2" style="border: 1px solid black; padding: 5px; font-weight: bold;">KET.</td>
            </tr>
            @foreach ($transaction->details as $item)
                <tr>
                    <td style="border: 1px solid black; padding: 5px;">{{ $item->good->code }}</td>
                    <td colspan="4" style="border: 1px solid black; padding: 5px;">{{ $item->good->name }}</td>
                    <td style="border: 1px solid black; padding: 5px;text-align: center">{{ $item->total }}</td>
                    <td style="border: 1px solid black; padding: 5px;">{{ $item->unit_name }}</td>
                    <td colspan="2" style="border: 1px solid black; padding: 5px;"></td>
                </tr>
            @endforeach

            <tr>
                <td colspan="9">
                    <table style="width: 100%; border-collapse: collapse">
                        <tr>
                            <td colspan="3"
                                style="border: 1px solid black; padding: 5px; font-weight: bold; text-align: center;">
                                DIKELUARKAN
                                OLEH</td>
                            <td colspan="3"
                                style="border: 1px solid black; padding: 5px; font-weight: bold; text-align: center;">
                                DITERIMA
                                OLEH</td>
                            <td colspan="3"
                                style="border: 1px solid black; padding: 5px; font-weight: bold; text-align: center;">
                                DIBUKUKAN
                                OLEH</td>

                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding: 5px;font-weight:bold; text-align:center">
                                Tanggal</td>
                            <td style="border: 1px solid black; padding: 5px;font-weight:bold; text-align:center">Nama
                            </td>
                            <td style="border: 1px solid black; padding: 5px;font-weight:bold; text-align:center">Paraf
                            </td>

                            <td style="border: 1px solid black; padding: 5px;font-weight:bold; text-align:center">
                                Tanggal</td>
                            <td style="border: 1px solid black; padding: 5px;font-weight:bold; text-align:center">Nama
                            </td>
                            <td style="border: 1px solid black; padding: 5px;font-weight:bold; text-align:center">Paraf
                            </td>

                            <td style="border: 1px solid black; padding: 5px;font-weight:bold; text-align:center">
                                Tanggal</td>
                            <td style="border: 1px solid black; padding: 5px;font-weight:bold; text-align:center">Nama
                            </td>
                            <td style="border: 1px solid black; padding: 5px;font-weight:bold; text-align:center">Paraf
                            </td>
                        </tr>

                        <tr>
                            <td style="border: 1px solid black; padding: 5px;">{{ $transaction->approved_at ?? '' }}
                            </td>
                            <td style="border: 1px solid black; padding: 5px;">{{ $transaction->approver->name ?? '' }}
                            </td>
                            <td style="border: 1px solid black; padding: 5px;"></td>

                            <td style="border: 1px solid black; padding: 5px;">{{ $transaction->approved_at ?? '' }}
                            </td>
                            <td style="border: 1px solid black; padding: 5px;">{{ $transaction->creator->name ?? '' }}
                            </td>
                            <td style="border: 1px solid black; padding: 5px;"></td>

                            <td style="border: 1px solid black; padding: 5px;"></td>
                            <td style="border: 1px solid black; padding: 5px;"></td>
                            <td style="border: 1px solid black; padding: 5px;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
