<div>
    <title>{{ $title }}</title>

    @php
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

        <div class="card">
            <div class="card-body pt-3 pb-4">
                @php
                    include_once 'function/time.php';
                @endphp
                <small>Riwayat Absensi Bulan {{ get_angka_bulan(date('m')) }} Tahun {{ date('Y') }}</small>

                @if ($riwayat->count() > 0)
                    <ol class="list-group mb-3 mt-3">
                        @foreach ($riwayat as $data)
                            <li class="list-group-item d-flex justify-content-between align-items-start"
                                style="border-left: 3px solid rgb(0, 204, 255);">
                                <div class="mt-2 me-auto d-flex">
                                    @php
                                        $tanggal = explode(':', $data->tanggal);
                                    @endphp
                                    <small class="">{{ $tanggal[2] . '/' . $tanggal[1] . '/' . $tanggal[0] }}</small>
                                </div>
                                <small class="text-secondary">
                                    @if ($data->masuk)
                                        @php
                                            $masuk = explode(' ', $data->masuk);
                                        @endphp
                                        @if ($data->terlambat <= 0)
                                            <span class="text-primary"><i class="bi bi-arrow-right"></i> {{ $masuk[1] }}</span>
                                        @else
                                            <span class="text-danger"><i class="bi bi-arrow-right"></i> {{ $masuk[1] }}</span>
                                        @endif
                                    @endif
                                    <br>
                                    @if ($data->pulang)
                                        @php
                                            $pulang = explode(' ', $data->pulang);
                                        @endphp
                                        <i class="bi bi-arrow-left"></i> {{ $pulang[1] }}
                                    @endif
                                </small>
                            </li>
                        @endforeach
                    </ol>
                @else
                    <hr>
                    <small class="text-secondary">Tidak ada riwayat</small>
                @endif

            </div>
        </div>

    </main>


</div>
