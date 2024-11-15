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
            @livewire('dashboard.user.create')
            <script>
                $(document).ready(function() {
                    $('#createModal').modal('show');
                });
            </script>
        @endif
        @if ($showLivewireDelete)
            @livewire('dashboard.user.delete', ['user' => $getUser])
            <script>
                $(document).ready(function() {
                    $('#deleteModal').modal('show');
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

                    <div class="container-fluid">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <button wire:click="create" class="badge bg-primary border-0 px-3 py-2 mt-1"
                                    style="font-size: 10pt;font-weight: normal;width: 170px;height: 2.6rem;">
                                    <span wire:loading.remove wire:target="create"><i class="bi bi-plus-lg"></i> Tambah
                                        Admin</span>
                                    <span wire:loading wire:target="create"
                                        class="spinner-border spinner-border-sm text-light" role="status"
                                        aria-hidden="true" style="width: 13px; height: 13px;"></span>
                                </button>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-10">
                                <div wire:ignore.self>
                                    <div class="input-group mb-3">
                                        <input wire:model="search" type="text" placeholder="Cari"
                                            class="form-control sm">
                                        <span class="input-group-text" id="basic-addon2"><i
                                                class="bi bi-search"></i></span>
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
                        @if ($user->count())
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align: middle;text-align: center;">#</th>
                                            <th style="vertical-align: middle;">Nama Pengguna</th>
                                            <th style="vertical-align: middle;">Username</th>
                                            <th style="vertical-align: middle;">Level</th>
                                            <th style="width: 200px;vertical-align: middle;text-align: left;">Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $data)
                                            <tr>
                                                <td style="vertical-align: middle;text-align: center;">
                                                    {{ $loop->iteration }}</td>
                                                <td style="vertical-align: middle;">{{ $data->nama }}
                                                </td>
                                                <td style="vertical-align: middle;">{{ $data->username }}</td>
                                                <td style="vertical-align: middle;">
                                                    @if ($data->level == 0)
                                                        <span>Admin</span>
                                                    @else
                                                        <span>Pegawai</span>
                                                    @endif
                                                </td>
                                                <td style="text-align: left;">
                                                    @if ($auth->id == $data->id)
                                                        <button id="noHapus"
                                                            class="badge bg-danger mb-1 border-0 py-2"
                                                            style="height: 2rem;width: 2rem;"><i
                                                                class="bi bi-trash"></i></button>
                                                    @elseif($data->level == 0 || $data->level == 1)
                                                        <button class="badge bg-danger mb-1 border-0 py-2"
                                                            wire:click="delete({{ $data->id }})"
                                                            ata-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="Hapus" style="height: 2rem;width: 2rem;">
                                                            <span wire:loading.remove
                                                                wire:target="delete({{ $data->id }})">
                                                                <i class="bi  bi-trash"></i>
                                                            </span>
                                                            <span wire:loading wire:target="delete({{ $data->id }})"
                                                                class="spinner-border spinner-border-sm text-light"
                                                                role="status" aria-hidden="true"
                                                                style="width: 11px; height: 11px;"></span>
                                                        </button>
                                                    @endif

                                                    @if ($data->id != auth()->user()->id)
                                                        <button class="badge bg-warning mb-1 border-0 py-2"
                                                            wire:click="resetAkun({{ $data->id }})"
                                                            ata-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="Hapus"
                                                            style="font-size: 10pt;font-weight: normal;width: 100px;height: 2rem;">
                                                            <span wire:loading.remove
                                                                wire:target="resetAkun({{ $data->id }})">
                                                                Reset
                                                            </span>
                                                            <span wire:loading
                                                                wire:target="resetAkun({{ $data->id }})"
                                                                class="spinner-border spinner-border-sm text-light"
                                                                role="status" aria-hidden="true"
                                                                style="width: 11px; height: 11px;"></span>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end">{{ $user->links() }}</div>
                        @else
                            <hr>
                            <p class="text-center text-secondary mt-5">Data tidak ditemukan !</p>
                        @endif


                    </div>

                </div>
            </div>


        </section>

    </main>

    <script>
        $(document).on('click', '#noHapus', function() {
            Swal.fire({
                icon: 'error',
                'title': 'Sorry !',
                text: 'Tombol hapus tidak berfungsi saat anda sedang login',
                allowOutsideClick: false
            })
        })
    </script>


</div>
