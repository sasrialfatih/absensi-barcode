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

        @if ($showLivewireUpdate)
            @livewire('dashboard.pengaturan.update', ['pengaturan' => $getPengaturan])
            <script>
                $(document).ready(function() {
                    $('#editModal').modal('show');
                });
            </script>
        @endif
        <script>
            $(document).on('click', '#closeModal', function() {
                Livewire.emit('closeLivewire');
            });
        </script>

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
                            @if ($pengaturan)
                                <button wire:click="edit({{ $pengaturan->id }})"
                                    class="badge bg-primary border-0 px-3 py-2 mt-1"
                                    style="font-size: 8pt;font-weight: normal;width: 130px;height: 2.6rem;">
                                    <span wire:loading.remove wire:target="edit({{ $pengaturan->id }})"><i
                                            class="bi bi-pencil"></i>
                                        Update Data</span>
                                    <span wire:loading wire:target="edit({{ $pengaturan->id }})"
                                        class="spinner-border spinner-border-sm text-light" role="status"
                                        aria-hidden="true" style="width: 13px; height: 13px;"></span>
                                </button>
                            @else
                                <button wire:click="create" class="badge bg-primary border-0 px-3 py-2 mt-1"
                                    style="font-size: 8pt;font-weight: normal;width: 130px;height: 2.6rem;">
                                    <span wire:loading.remove wire:target="create"><i class="bi bi-arrow-clockwise"></i>
                                        Generate Data</span>
                                    <span wire:loading wire:target="create"
                                        class="spinner-border spinner-border-sm text-light" role="status"
                                        aria-hidden="true" style="width: 13px; height: 13px;"></span>
                                </button>
                            @endif

                        </div>
                    </div>

                    @if ($pengaturan)
                        <div class="row">
                            <div class="col-md-12">
                                <ol class="list-group mb-3 mt-3">
                                    <li class="list-group-item d-flex justify-content-between align-items-start"
                                        style="border-left: 3px solid rgb(0, 204, 255);">
                                        <div class="mt-2 me-auto d-flex">
                                            Jam Masuk
                                        </div>
                                        <small class="text-secondary">
                                            {{ $pengaturan->jam_masuk }}
                                        </small>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start"
                                        style="border-left: 3px solid rgb(0, 204, 255);">
                                        <div class="mt-2 me-auto d-flex">
                                            Jam Pulang
                                        </div>
                                        <small class="text-secondary">
                                            {{ $pengaturan->jam_pulang }}
                                        </small>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start"
                                        style="border-left: 3px solid rgb(0, 204, 255);">
                                        <div class="mt-2 me-auto d-flex">
                                            URL
                                        </div>
                                        <small class="text-secondary">
                                            {{ $pengaturan->url }}
                                        </small>
                                    </li>
                                </ol>
                                <span class="fw-bold">Pengesah Laporan</span>
                                <ol class="list-group mb-3 mt-3">
                                    <li class="list-group-item d-flex justify-content-between align-items-start"
                                        style="border-left: 3px solid rgb(0, 204, 255);">
                                        <div class="mt-2 me-auto d-flex">
                                           Nama
                                        </div>
                                        <small class="text-secondary">
                                            {{ $pengaturan->pimpinan }}
                                        </small>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start"
                                        style="border-left: 3px solid rgb(0, 204, 255);">
                                        <div class="mt-2 me-auto d-flex">
                                            Jabatan
                                        </div>
                                        <small class="text-secondary">
                                            {{ $pengaturan->jabatan }}
                                        </small>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    @endif

                </div>
            </div>


        </section>

    </main>


</div>
