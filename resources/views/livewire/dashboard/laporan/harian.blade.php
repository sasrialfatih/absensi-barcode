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
                            <div type="button" wire:click="export" class="text-decoration-underline text-primary"
                                style="font-size: 10pt;">
                                <i class="bi bi-file-spreadsheet"></i> Export Laporan </span>
                                <span wire:loading wire:target="export"
                                    class="spinner-border spinner-border-sm text-primary" role="status"
                                    aria-hidden="true" style="width: 13px; height: 13px;"></span>
                            </div>
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
                            <select class="form-select d-inline-block" style="width: 70px;"
                                aria-label="Default select example" wire:model="tanggal" id="tanggal"
                                wire:change="render">
                                @for ($i = 1; $i <= 31; $i++)
                                    @if ($i <= 9)
                                        <option value="{{ '0' . $i }}">{{ $i }}
                                        </option>
                                    @else
                                        <option value="{{ $i }}">{{ $i }}
                                        </option>
                                    @endif
                                @endfor
                            </select>
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
                        <div class="table-responsive">
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
                                                ->where('tanggal', $tahun . ':' . $bulan . ':' . $tanggal)
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
                                                        <i class="bi bi-x-lg fw-bolder text-danger"></i>
                                                    @else
                                                        <i class="bi bi-check-lg fw-bolder text-primary"></i>
                                                    @endif
                                                @endif
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
