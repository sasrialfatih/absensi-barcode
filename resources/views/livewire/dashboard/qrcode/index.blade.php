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

                    <div class="container-fluid">

                        <div class="card">
                            <div class="card-body" style="height: 60vh;">
                                <div class="d-flex justify-content-center mt-5">
                                    @if ($pengaturan)
                                        <span type="button" class="text-primary" wire:click="generate_qrcode"
                                            style="text-decoration: underline;">
                                            <i class="bi bi-arrow-counterclockwise"></i> Generate
                                        </span>
                                    @endif
                                </div>

                                @if ($generate)
                                    @php
                                        $qrcode = \App\Models\Qrcode::first();
                                        \App\Models\Qrcode::where('id', $qrcode->id)->update([
                                            'code' => Str::random(20),
                                        ]);

                                        $qrcode = \App\Models\Qrcode::first();
                                    @endphp
                                @else
                                    @php
                                        $qrcode = \App\Models\Qrcode::first();
                                    @endphp
                                @endif

                                <div class="d-flex justify-content-center mt-3">
                                    @if ($pengaturan)
                                        {!! QrCode::size(200)->generate($pengaturan->url . '/presensi/qrcode/' . $qrcode->code) !!}
                                    @else
                                        <span class="text-danger text-center">Pengaturan belum diatur</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>


        </section>

    </main>


</div>
