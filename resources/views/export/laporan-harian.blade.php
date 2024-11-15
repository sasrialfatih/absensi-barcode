<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Laporan Harian Absensi Pegawai</title>

    <style>
        body {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: 12.5pt;
        }
    </style>


</head>

<body>

    @php
        include_once 'function/time.php';
        $array_tanggal = explode(':', $tanggal);
    @endphp

    <h3>Laporan Harian Absensi Pegawai Tanggal
        {{ $array_tanggal[2] . ' ' . get_angka_bulan($array_tanggal[1]) . ' ' . $array_tanggal[0] }}</h3>
    <h1>{{ env('NAMA_INSTANSI') }}</h1>

    @if ($pegawai->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="vertical-align: middle;text-align: center;">No</th>
                    <th style="vertical-align: middle;text-align: left;">No. Karyawan</th>
                    <th style="vertical-align: middle;text-align: left;">Nama Pegawai</th>
                    <th style="vertical-align: middle;text-align: center;">L/P</th>
                    <th style="vertical-align: middle;text-align: center;">Jam Masuk</th>
                    <th style="vertical-align: middle;text-align: center;">Jam Pulang</th>
                    <th style="vertical-align: middle;text-align: center;">Terlambat</th>
                    <th style="vertical-align: middle;text-align: center;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pegawai as $data)
                    @php
                        $absensi = \App\Models\Absensi::where('id_pegawai', $data->id_pegawai)
                            ->where('tanggal', $array_tanggal[0] . ':' . $array_tanggal[1] . ':' . $array_tanggal[2])
                            ->first();
                    @endphp
                    <tr>
                        <td style="vertical-align: middle;text-align: center;">
                            {{ $loop->iteration }}</td>
                        <td style="vertical-align: middle;text-align: left;">{{ $data->no_karyawan }}
                        </td>
                        <td style="vertical-align: middle;text-align: left;">{{ $data->nama }}
                        </td>
                        <td style="vertical-align: middle;text-align: center;">
                            @if ($data->jenis_kelamin == 'Perempuan')
                                P
                            @else
                                L
                            @endif
                        </td>
                        <td style="vertical-align: middle;text-align: center;">
                            @if ($absensi)
                                @if ($absensi->masuk)
                                    @php
                                        $masuk = explode(' ', $absensi->masuk);
                                    @endphp
                                    @if ($absensi->terlambat > 0)
                                        <span class="text-danger">{{ $masuk[1] }}</span>
                                    @else
                                        <span class="text-primary">{{ $masuk[1] }}</span>
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td style="vertical-align: middle;text-align: center;">
                            @if ($absensi)
                                @if ($absensi->pulang)
                                    @php
                                        $pulang = explode(' ', $absensi->pulang);
                                    @endphp
                                    {{ $pulang[1] }}
                                @endif
                            @endif
                        </td>
                        <td style="vertical-align: middle;text-align: center;">
                            @if ($absensi)
                                @if ($absensi->terlambat <= 0)
                                    0 menit
                                @else
                                    {{ $absensi->terlambat }} menit
                                @endif
                            @endif
                        </td>
                        <td style="vertical-align: middle;text-align: center;">
                            @if ($absensi)
                                @if ($absensi->status != 2)
                                    0
                                @else
                                    1
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <hr>
        <p class="text-center text-secondary mt-5">Data tidak ditemukan !</p>
    @endif


</body>

</html>
