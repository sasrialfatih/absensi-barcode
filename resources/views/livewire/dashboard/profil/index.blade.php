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

        @if ($showUpdateNama)
            @livewire('dashboard.profil.update-nama')
            <script>
                $(document).ready(function() {
                    $('#updateNamaModal').modal('show');
                });
            </script>
        @endif
        @if ($showUpdateUsername)
            @livewire('dashboard.profil.update-username')
            <script>
                $(document).ready(function() {
                    $('#updateUsernameModal').modal('show');
                });
            </script>
        @endif
        @if ($showUpdatePassword)
            @livewire('dashboard.profil.update-password')
            <script>
                $(document).ready(function() {
                    $('#updatePasswordModal').modal('show');
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
                    <ol class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Nama Pengguna</div>
                                {{ strtoupper(auth()->user()->nama) }}
                            </div>
                            @if (auth()->user()->level == 0)
                                <button class="badge bg-primary mb-1 border-0" wire:click="updateNama"
                                    style="width: 80px;height: 2rem;">
                                    <span wire:loading.remove wire:target="updateNama">
                                        <i class="bi bi-pencil"></i> Ubah
                                    </span>
                                    <span wire:loading wire:target="updateNama"
                                        class="spinner-border spinner-border-sm text-light" role="status"
                                        aria-hidden="true" style="width: 11px; height: 11px;"></span>
                                </button>
                            @else
                                <button class="badge bg-secondary mb-1 border-0" wire:click=""
                                    style="width: 80px;height: 2rem;">
                                    <span wire:loading.remove wire:target="">
                                        <i class="bi bi-pencil"></i> Ubah
                                    </span>
                                    <span wire:loading wire:target=""
                                        class="spinner-border spinner-border-sm text-light" role="status"
                                        aria-hidden="true" style="width: 11px; height: 11px;"></span>
                                </button>
                            @endif

                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Username</div>
                                {{ auth()->user()->username }}
                            </div>
                            <button class="badge bg-primary mb-1 border-0" wire:click="updateUsername"
                                style="width: 80px;height: 2rem;">
                                <span wire:loading.remove wire:target="updateUsername">
                                    <i class="bi bi-pencil"></i> Ubah
                                </span>
                                <span wire:loading wire:target="updateUsername"
                                    class="spinner-border spinner-border-sm text-light" role="status"
                                    aria-hidden="true" style="width: 11px; height: 11px;"></span>
                            </button>


                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Password</div>
                                {{ '********' }}
                            </div>
                            <button class="badge bg-primary mb-1 border-0" wire:click="updatePassword"
                                style="width: 80px;height: 2rem;">
                                <span wire:loading.remove wire:target="updatePassword">
                                    <i class="bi bi-pencil"></i> Ubah
                                </span>
                                <span wire:loading wire:target="updatePassword"
                                    class="spinner-border spinner-border-sm text-light" role="status"
                                    aria-hidden="true" style="width: 11px; height: 11px;"></span>
                            </button>
                        </li>
                    </ol>


                </div>

            </div>
</div>


</section>

</main>

</div>
