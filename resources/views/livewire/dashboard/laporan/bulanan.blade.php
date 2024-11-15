<div>

    <title>{{ $title }}</title>

    @php
        include_once 'function/time.php';

        $message = explode('/', session('message'));
    @endphp
    @if (session()->has('message'))
        <div>
            <script>
                Swal.fire({
                    icon: '{{ $message[0] }}',
                    text: '{{ $message[1] }}',
                    allowOutsideClick: false
                }).then(() => {
                    // window.location.reload();
                })
            </script>
        </div>
    @endif


    <main id="main" class="main">

        <section class="section" style="padding-top: 20px;">

            <div class="card main-content-card">
                <div class="card-body">
                    {{-- title page --}}
                    <div class="card" style="margin-top: -35px;border-radius: 10px;opacity: 1;">
                        <div class="card-body title-header-app pt-3 pb-0 pb-3" style="border-radius: 10px;">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="m-0 h5-title">
                                        <table>
                                            <tr>
                                                <td style="vertical-align:-webkit-baseline-middle;">
                                                    {!! $icon !!}</td>
                                                <td style="vertical-align:-webkit-baseline-middle;padding-left: 5px;">
                                                    {{ $title_page }}</td>
                                            </tr>
                                        </table>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- content --}}

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <form action="/dashboard/laporan/bulanan/export?bulan={{ $tahun . ':' . $bulan }}"
                                method="POST" target="blank">
                                @csrf
                                <button type="submit" class="text-decoration-underline text-primary"
                                    style="font-size: 10pt;border: 0px;background-color: white;">
                                    <i class="bi bi-file-spreadsheet"></i> Export Laporan
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-10">
                            <div wire:ignore.self>
                                <div class="input-group mb-3">
                                    <input wire:model="search" type="text" placeholder="Cari"
                                        class="form-control sm">
                                    <span class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <span>Show :</span>
                            <select class="form-select md w-auto d-inline" wire:model="paginate">
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <select class="form-select d-inline-block" style="width: 135px;"
                                aria-label="Default select example" wire:model="bulan" id="bulan"
                                wire:change="render">
                                @for ($i = 1; $i <= 12; $i++)
                                    @if ($i <= 9)
                                        <option value="{{ '0' . $i }}">{{ get_angka_bulan($i) }}
                                        </option>
                                    @else
                                        <option value="{{ $i }}">{{ get_angka_bulan($i) }}
                                        </option>
                                    @endif
                                @endfor
                            </select>
                            <input type="text" onkeypress ="return event.charCode >= 48 && event.charCode <=57"
                                class="form-control d-inline-block" wire:model="tahun" style="width: 60px;"
                                wire:keydown="render" id="tahun">
                        </div>
                    </div>

                    @if ($pegawai->count())
                        <style>
                            .table-data tr th {
                                border: 3px double rgb(126, 126, 126);
                                font-size: 10pt;
                            }

                            .table-data tr td {
                                border: 3px double rgb(126, 126, 126);
                                font-size: 9pt;
                            }
                        </style>
                        <div class="table-responsive">
                            <table class="table table-striped table-data" style="width: 100%;">
                                <thead>
                                    @php
                                        $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                                    @endphp
                                    <tr>
                                        <th rowspan="3" style="vertical-align: middle;text-align: center;">No</th>
                                        {{-- <th rowspan="3" style="vertical-align: middle;text-align: left;">NIP</th> --}}
                                        <th rowspan="3" style="vertical-align: middle;text-align: left;width: ;">Nama
                                            Pegawai
                                        </th>
                                        <th rowspan="3" style="vertical-align: middle;text-align: center;">L/P</th>
                                        <th rowspan="" colspan="{{ $jumlah_hari }}"
                                            style="vertical-align: middle;text-align: center;">Tanggal</th>
                                        <th colspan="3" rowspan="2"
                                            style="vertical-align: middle;text-align: center;">Jumlah</th>
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
                                        <th style="vertical-align: middle;text-align: center;">H</th>
                                        <th style="vertical-align: middle;text-align: center;">A</th>
                                        <th style="vertical-align: middle;text-align: center;">Terlambat
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pegawai as $data)
                                        <tr>
                                            <td style="vertical-align: middle;text-align: center;">
                                                {{ $loop->iteration }}</td>
                                            {{-- <td style="vertical-align: middle;text-align: left;">{{ $data->nip }}
                                            </td> --}}
                                            <td style="vertical-align: middle;text-align: left;">{{ $data->nama }}
                                            </td>
                                            <td style="vertical-align: middle;text-align: center;">
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
                                                        $get_minggu = $tahun . '/' . $bulan . '/' . $i;
                                                        $hari_minggu = date('l', strtotime($get_minggu));

                                                        $absensi = \App\Models\Absensi::where(
                                                            'id_pegawai',
                                                            $data->id_pegawai,
                                                        )
                                                            ->where('tanggal', $tahun . ':' . $bulan . ':' . '0' . $i)
                                                            ->first();
                                                    @endphp
                                                @else
                                                    @php
                                                        $get_minggu = $tahun . '/' . $bulan . '/' . $i;
                                                        $hari_minggu = date('l', strtotime($get_minggu));

                                                        $absensi = \App\Models\Absensi::where(
                                                            'id_pegawai',
                                                            $data->id_pegawai,
                                                        )
                                                            ->where('tanggal', $tahun . ':' . $bulan . ':' . $i)
                                                            ->first();
                                                    @endphp
                                                @endif

                                                @if ($hari_minggu == 'Sunday' || $hari_minggu == 'Minggu')
                                                    <td style="font-size:8pt;vertical-align: middle;text-align: center;background-color: rgb(207, 171, 160);"
                                                        class="">
                                                        @if ($absensi)
                                                            @if ($absensi->status != 2)
                                                                <i class="bi bi-x-lg fw-bolder text-danger"></i>
                                                            @else
                                                                <i class="bi bi-check-lg fw-bolder text-primary"></i>
                                                            @endif
                                                        @else
                                                            <i class="bi bi-x-lg fw-bolder text-danger"></i>
                                                        @endif
                                                    </td>
                                                @else
                                                    <td
                                                        style="font-size:8pt;vertical-align: middle;text-align: center;">
                                                        @if ($absensi)
                                                            @if ($absensi->status != 2)
                                                                <i class="bi bi-x-lg fw-bolder text-danger"></i>
                                                            @else
                                                                <i class="bi bi-check-lg fw-bolder text-primary"></i>
                                                            @endif
                                                        @else
                                                            <i class="bi bi-x-lg fw-bolder text-danger"></i>
                                                        @endif
                                                    </td>
                                                @endif

                                                @php
                                                    if ($absensi) {
                                                        $hadir++;

                                                        $terlambat += $absensi->terlambat;
                                                        // dd($absensi->terlambat);
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
                        </div>
                        <div class="d-flex justify-content-end mt-4">{{ $pegawai->links() }}</div>
                    @else
                        <hr>
                        <p class="text-center text-secondary mt-5">Data tidak ditemukan !</p>
                    @endif

                </div>
            </div>


        </section>

    </main>


</div>
