<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $title }}</title>

    <link href="css/cetak.css" rel="stylesheet">

    <style>
        @page {
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: 40px;
            margin-right: 40px;
        }

        body {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: 12.5pt;
        }
    </style>


</head>

<body>

    @php
        include_once 'function/time.php';
        $array_bulan = explode(':', $bulan);
    @endphp

    <style>
        #kop tr td {
            border: 0px solid black;
            "

        }
    </style>
    <div style="position: ;">
        <table cellspacing="0" id="kop">
            <tr>
                <td style="padding: 0px;">
                    <img src="assets/img/logo.png" alt="" style="width: 40px;display: inline;margin-top: px;">
                </td>
                <td style="padding: 0px;text-align: left;">
                    <h3 style="font-weight: bolder;display: inline-block;">{{ env('NAMA_INSTANSI') }}
                        <span style="display: block;font-size: 9pt;font-weight: normal;">Desa
                            {{ env('NAMA_DESA') . ' Kecamatan ' . env('NAMA_KECAMATAN') }}</span>
                        <span style="display: block;font-size: 9pt;font-weight: normal;font-style: ;">E-Mail :
                            {{ env('EMAIL') }}</span>
                        <span style="display: block;font-size: 9pt;font-weight: normal;font-style: ;">Kode Pos :
                            {{ env('NAMA_KECAMATAN') }}</span>
                    </h3>
                </td>
            </tr>
        </table>
        <div style="position: absolute;top: 0px;right: 0px;">
            <h5>Laporan Absensi Pegawai Bulan
                {{ get_angka_bulan($array_bulan[1]) . ' ' . $array_bulan[0] }}</h5>
        </div>
    </div>

    <div class="line" style="margin-bottom: 10px; border: 3px double black;"></div>


    @if ($pegawai->count())
        <table width="100%" cellspacing="0" class="data" style="font-size: 8pt;width: 100%;">
            @php
                $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $array_bulan[1], $array_bulan[0]);
            @endphp
            <thead>
                <tr>
                    <th rowspan="3">No</th>
                    <th rowspan="3" style="vertical-align: middle;text-align: left;width: ;">Nama
                        Pegawai
                    </th>
                    <th rowspan="3">L/P</th>
                    <th rowspan="" colspan="{{ $jumlah_hari }}">
                        Tanggal</th>
                    <th colspan="3" rowspan="2">Jumlah</th>
                </tr>

                <tr>
                    @for ($i = 1; $i <= $jumlah_hari; $i++)
                        <th rowspan="2" style="font-size:8pt;">
                            @if ($i <= 9)
                                {{ '0' . $i }}
                            @else
                                {{ $i }}
                            @endif
                        </th>
                    @endfor
                </tr>

                <tr>
                    <th>H</th>
                    <th>A</th>
                    <th>Terlambat
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pegawai as $data)
                    <tr>
                        <td>
                            {{ $loop->iteration }}</td>
                        <td>{{ $data->nama }}
                        </td>
                        <td>
                            @if ($data->jenis_kelamin == 'Perempuan')
                                P
                            @else
                                L
                            @endif
                        </td>
                        @php
                            $hadir = 0;
                            $terlambat = 0;
                        @endphp
                        @for ($i = 1; $i <= $jumlah_hari; $i++)
                            @if ($i <= 9)
                                @php
                                    $get_minggu = $array_bulan[0] . '/' . $array_bulan[1] . '/' . $i;
                                    $hari_minggu = date('l', strtotime($get_minggu));

                                    $absensi = \App\Models\Absensi::where('id_pegawai', $data->id_pegawai)
                                        ->where('tanggal', $array_bulan[0] . ':' . $array_bulan[1] . ':' . '0' . $i)
                                        ->first();
                                @endphp
                            @else
                                @php
                                    $get_minggu = $array_bulan[0] . '/' . $array_bulan[1] . '/' . $i;
                                    $hari_minggu = date('l', strtotime($get_minggu));

                                    $absensi = \App\Models\Absensi::where('id_pegawai', $data->id_pegawai)
                                        ->where('tanggal', $array_bulan[0] . ':' . $array_bulan[1] . ':' . $i)
                                        ->first();
                                @endphp
                            @endif

                            @if ($hari_minggu == 'Sunday' || $hari_minggu == 'Minggu')
                                <td style="font-size:8pt;vertical-align: middle;text-align: center;background-color: rgb(207, 171, 160);"
                                    class="">
                                    @if ($absensi)
                                        @if ($absensi->status != 2)
                                            <img src="assets/img/x.png" alt="" style="width: 7pt;">
                                        @else
                                            <img src="assets/img/centang_hijau.png" alt="" style="width: 7pt;">
                                        @endif
                                    @else
                                        <img src="assets/img/x.png" alt="" style="width: 7pt;">
                                    @endif
                                </td>
                            @else
                                <td style="font-size:8pt;vertical-align: middle;text-align: center;">
                                    @if ($absensi)
                                        @if ($absensi->status != 2)
                                            <img src="assets/img/x.png" alt="" style="width: 7pt;">
                                        @else
                                            <img src="assets/img/centang_hijau.png" alt="" style="width: 7pt;">
                                        @endif
                                    @else
                                        <img src="assets/img/x.png" alt="" style="width: 7pt;">
                                    @endif
                                </td>
                            @endif

                            @php
                                if ($absensi) {
                                    $hadir++;

                                    $terlambat += $absensi->terlambat;
                                }
                            @endphp
                        @endfor
                        <td style="text-align: center;vertical-align: middle;">
                            {{ $hadir }}
                        </td>
                        <td style="text-align: center;vertical-align: middle;">
                            {{ $jumlah_hari - $hadir }}</td>
                        <td style="text-align: center;vertical-align: middle;">
                            {{ $terlambat . ' menit' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <hr>
        <p class="text-center text-secondary mt-5">Data tidak ditemukan !</p>
    @endif

    <div style="position: relative; margin-top: 50px;">
        <div style="position: absolute;margin-left: 700px;top: -30px;width: 100%;">
            <table class="table-ttd-pengesahan" style="width: 100%;border: 0;border: 0px solid black;">
                <tr>
                    <td style="font-size: 10pt;text-align: left;border: 0;padding: 0px;">{{ env('NAMA_DESA') }},
                        {{ date('d') . ' ' . get_angka_bulan(date('m')) . ' ' . date('Y') }}</td>
                </tr>
                <tr>
                    @if ($pengaturan)
                        @if ($pengaturan->jabatan)
                            <td style="text-align: left;border: 0px solid black;padding: 0px;font-size: 10pt;">
                                <b>{{ $pengaturan->jabatan }}</b>
                            </td>
                        @else
                            <td style="text-align: left;border: 0px solid black;padding: 0px;font-size: 10pt;">
                                <b>Jabatan Belum di atur</b>
                            </td>
                        @endif
                    @else
                        <td style="text-align: left;border: 0px solid black;padding: 0px;font-size: 10pt;">
                            <b>Jabatan Belum di atur</b>
                        </td>
                    @endif
                </tr>
                <tr>
                    <td style="text-align: left;font-size: 10pt;border: 0px solid black;">
                        <br><br><br>
                        @if ($pengaturan)
                            @if ($pengaturan->pimpinan)
                                <b>{{ $pengaturan->pimpinan }}</b>
                            @else
                                <b>Nama Belum di atur</b>
                            @endif
                        @else
                            <b>Nama Belum di atur</b>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>


</body>

</html>
