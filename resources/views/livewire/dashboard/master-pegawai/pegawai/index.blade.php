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

        @if ($showLivewireCreate)
            @livewire('dashboard.master-pegawai.pegawai.create')
            <script>
                $(document).ready(function() {
                    $('#createModal').modal('show');
                });
            </script>
        @endif
        @if ($showLivewireUpdate)
            @livewire('dashboard.master-pegawai.pegawai.update', ['pegawai' => $getPegawai])
            <script>
                $(document).ready(function() {
                    $('#editModal').modal('show');
                });
            </script>
        @endif
        @if ($showLivewireDelete)
            @livewire('dashboard.master-pegawai.pegawai.delete', ['pegawai' => $getPegawai])
            <script>
                $(document).ready(function() {
                    $('#deleteModal').modal('show');
                });
            </script>
        @endif
        @if ($showLivewireShow)
            @livewire('dashboard.master-pegawai.pegawai.show', ['pegawai' => $getPegawai])
            <script>
                $(document).ready(function() {
                    $('#showModal').modal('show');
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
                            {{-- <button class="badge bg-primary border-0 px-3 py-2 mt-1"
                                style="font-size: 8pt;font-weight: normal;width: 90px;height: 2.6rem;"
                                data-bs-toggle="modal" data-bs-target="#importData">
                                <span><i class="bi bi-download"></i> Impor</span>
                            </button> --}}
                            <button wire:click="create" class="badge bg-primary border-0 px-3 py-2 mt-1"
                                style="font-size: 8pt;font-weight: normal;width: 115px;height: 2.6rem;">
                                <span wire:loading.remove wire:target="create"><i class="bi bi-plus-lg"></i> Tambah
                                    Data</span>
                                <span wire:loading wire:target="create"
                                    class="spinner-border spinner-border-sm text-light" role="status"
                                    aria-hidden="true" style="width: 13px; height: 13px;"></span>
                            </button>
                            {{-- <button wire:click="exporData" class="badge bg-primary border-0 px-3 py-2 mt-1"
                                style="font-size: 8pt;font-weight: normal;width: 90px;height: 2.6rem;">
                                <span wire:loading.remove wire:target="exporData"><i
                                        class="bi bi-upload text-light"></i>
                                    Export</span>
                                <span wire:loading wire:target="exporData"
                                    class="spinner-border spinner-border-sm text-light" role="status"
                                    aria-hidden="true" style="width: 13px; height: 13px;"></span>
                            </button> --}}
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
                    @if ($pegawai->count())
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="vertical-align: middle;text-align: center;">No</th>
                                        <th style="vertical-align: middle;text-align: left;">No Karyawan</th>
                                        <th style="vertical-align: middle;text-align: left;">Nama Pegawai</th>
                                        <th style="vertical-align: middle;text-align: left;">L/P</th>
                                        <th style="vertical-align: middle;text-align: left;">No. Handphone</th>
                                        <th style="vertical-align: middle;text-align: left;">Akun</th>
                                        <th style="width: 150px;text-align: center; vertical-align: middle;">Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pegawai as $data)
                                        <tr>
                                            <td style="vertical-align: middle;text-align: center;">
                                                {{ $loop->iteration }}</td>
                                            <td style="vertical-align: middle;text-align: left;">{{ $data->no_karyawan }}
                                            </td>
                                            <td style="vertical-align: middle;text-align: left;">{{ $data->nama }}
                                                <br><small class="text-secondary">{{ $data->jabatan->nama_jabatan }}</small>
                                            </td>
                                            <td style="vertical-align: middle;text-align: left;">
                                                @if ($data->jenis_kelamin == 'Perempuan')
                                                    P
                                                @else
                                                    L
                                                @endif
                                            </td>
                                            <td style="vertical-align: middle;text-align: left;">
                                                {{ $data->nomor_telepon }}
                                            </td>
                                            <td style="vertical-align: middle;text-align: left;">
                                                @if ($data->akun)
                                                    <i class="bi bi-check-lg text-success"></i>
                                                @else
                                                    <i class="bi bi-x-lg text-danger"></i>
                                                @endif
                                            </td>
                                            <td style="vertical-align: middle;text-align: center;">

                                                <div class="btn-group" role="group"
                                                    aria-label="Basic mixed styles example">

                                                    @if ($data->akun)
                                                        <button type="button" class="btn btn-danger"
                                                            wire:click="akunNonAktif({{ $data->id_pegawai }})"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="Matikan Akun" style="font-size: 10pt;width: 120px;">
                                                            <span wire:loading.remove
                                                                wire:target="akunNonAktif({{ $data->id_pegawai }})">
                                                                Matikan Akun
                                                            </span>
                                                            <span wire:loading
                                                                wire:target="akunNonAktif({{ $data->id_pegawai }})"
                                                                class="spinner-border spinner-border-sm text-light"
                                                                role="status" aria-hidden="true"
                                                                style="width: 11px; height: 11px;"></span>
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-primary"
                                                            wire:click="akunAktif({{ $data->id_pegawai }})"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="Aktifkan Akun" style="font-size: 10pt;width: 120px;">
                                                            <span wire:loading.remove
                                                                wire:target="akunAktif({{ $data->id_pegawai }})">
                                                                Aktifkan Akun
                                                            </span>
                                                            <span wire:loading
                                                                wire:target="akunAktif({{ $data->id_pegawai }})"
                                                                class="spinner-border spinner-border-sm text-light"
                                                                role="status" aria-hidden="true"
                                                                style="width: 11px; height: 11px;"></span>
                                                        </button>
                                                    @endif

                                                    <button type="button" class="btn btn-success"
                                                        wire:click="edit({{ $data->id_pegawai }})"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="Ubah" style="font-size: 10pt;">
                                                        <span wire:loading.remove
                                                            wire:target="edit({{ $data->id_pegawai }})">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </span>
                                                        <span wire:loading wire:target="edit({{ $data->id_pegawai }})"
                                                            class="spinner-border spinner-border-sm text-light"
                                                            role="status" aria-hidden="true"
                                                            style="width: 11px; height: 11px;"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-danger"
                                                        wire:click="delete({{ $data->id_pegawai }})"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="Hapus" style="font-size: 10pt;">
                                                        <span wire:loading.remove
                                                            wire:target="delete({{ $data->id_pegawai }})">
                                                            <i class="bi  bi-trash"></i>
                                                        </span>
                                                        <span wire:loading
                                                            wire:target="delete({{ $data->id_pegawai }})"
                                                            class="spinner-border spinner-border-sm text-light"
                                                            role="status" aria-hidden="true"
                                                            style="width: 11px; height: 11px;"></span>
                                                    </button>
                                                </div>
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
