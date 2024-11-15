<div>
    <title>{{ $title }}</title>

    <main id="main" class="main">

        <div class="card">
            <div class="card-body pt-5 pb-5">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <style>
                            @media only screen and (max-width:480px) {
                                .h2 {
                                    font-size: 10pt;
                                }

                                .h1 {
                                    font-size: 12pt;
                                }

                                .h4 {
                                    font-size: 9pt;
                                }
                            }
                        </style>
                        <div class="d-flex justify-content-center mb-3">
                            <img src="/assets/img/logo.png" alt="" class="img-fluid" style="width: 100px;">
                        </div>
                        <h2 class="h2 text-center">SELAMAT DATANG DI WEBSITE</h2>
                        <h1 class="h1 text-center fw-bolder"><i class="bi bi-qr-code-scan"></i> {{ env('APP_NAME') }}
                        </h1>
                        <h2 class="h2 text-center mb-5">{{ env('NAMA_INSTANSI') }}</h2>
                    </div>
                </div>
            </div>
        </div>

    </main>


</div>
