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

    @php
        $message_index = explode('/', session('message_index'));
    @endphp
    @if (session()->has('message_index'))
        <div>
            <script>
                Swal.fire({
                    icon: '{{ $message_index[0] }}',
                    title: '{{ $message_index[1] }}',
                    text: '{{ $message_index[2] }}',
                    allowOutsideClick: false
                }).then(() => {
                    window.location.reload();
                })
            </script>
        </div>
    @endif

    <main id="main" class="main">

        <div class="card">
            <div class="card-body pt-3 pb-4">
                <script src="/vendor/qrCode/html5-qrcode.min.js"></script>

                <small class="">Absensi Terakhir Tanggal {{ date('d/m/Y') }}</small>
                <ol class="list-group mb-3 mt-3">
                    <li class="list-group-item d-flex justify-content-between align-items-start"
                        style="border-left: 3px solid rgb(0, 204, 255);">
                        <div class="ms-2 me-auto">
                            <small class="">Jam Masuk</small>
                        </div>
                        <small class="text-secondary">
                            @if ($absensi_hari_ini)
                                @if ($absensi_hari_ini->masuk)
                                    @php
                                        $masuk = explode(' ', $absensi_hari_ini->masuk);
                                    @endphp
                                    {{ $masuk[1] }}
                                @else
                                    -
                                @endif
                            @else
                                -
                            @endif
                        </small>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start"
                        style="border-left: 3px solid rgb(0, 204, 255);">
                        <div class="ms-2 me-auto">
                            <small class="">Jam Pulang</small>
                        </div>
                        <small class="text-secondary">
                            @if ($absensi_hari_ini)
                                @if ($absensi_hari_ini->pulang)
                                    @php
                                        $pulang = explode(' ', $absensi_hari_ini->pulang);
                                    @endphp
                                    {{ $pulang[1] }}
                                @else
                                    -
                                @endif
                            @else
                                -
                            @endif
                        </small>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start"
                        style="border-left: 3px solid rgb(0, 204, 255);">
                        <div class="ms-2 me-auto">
                            <small class="">Status</small>
                        </div>
                        <small class="text-secondary fw-bolder">
                            @if ($absensi_hari_ini)
                                @if ($absensi_hari_ini->status != 2)
                                    <i class="bi bi-x-lg text-danger"></i>
                                @else
                                    <i class="bi bi-check-lg text-success"></i>
                                @endif
                            @else
                                <i class="bi bi-x-lg text-danger"></i>
                            @endif
                        </small>
                    </li>
                </ol>

                <div wire:ignore.self id="reader"></div>

                <script>
                    let html5QRCodeScanner = new Html5QrcodeScanner(
                        "reader", {
                            fps: 10,
                            qrbox: {
                                width: 200,
                                height: 200,
                            },
                        }
                    );

                    function onScanSuccess(decodedText, decodedResult) {
                        // redirect ke link hasil scan

                        // window.location.href = decodedResult.decodedText;
                        // alert(decodedResult.decodedText);

                        Livewire.emit('presensi', decodedResult.decodedText);

                        // membersihkan scan area ketika sudah menjalankan 
                        // action diatas
                        html5QRCodeScanner.clear();
                    }

                    // render qr code scannernya
                    html5QRCodeScanner.render(onScanSuccess);
                </script>


            </div>
        </div>

    </main>


</div>
