<div>
    <title>{{ $title }}</title>

    <div class="container" data-aos="fade-up" wire:ignore.self>
        <section style="height: 100vh;" wire:ignore.self>

            <style>
                .image-login {
                    width: 80%;
                }

                @media only screen and (max-width:480px) {
                    .image-login {
                        width: 50%;
                    }
                }
            </style>

            <div class="row">
                <div class="col-md-6 d-flex justify-content-center align-items-center mb-4">
                    <img src="/assets/img/image1.png" class="img-fluid image-login">
                </div>
                <div class="col-md-6">
                    @if (session()->has('message'))
                        <script>
                            Swal.fire({
                                position: 'center-center',
                                icon: 'error',
                                title: 'Login gagal !',
                                text: 'Username atau password tidak diketahui',
                                showConfirmButton: false,
                                timer: 1000
                            })
                        </script>
                    @endif
                    <h3 class="text-center mb-4"><i class="bi bi-qr-code-scan"></i> <strong>E-PRESENSI</strong>
                    </h3>
                    <form wire:submit.prevent="auth" class="">
                        @csrf
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text" wire:model.defer="username"
                                    class="form-control @error('username') is-invalid @enderror" placeholder="Username"
                                    value="{{ old('username') }}" name="username" id="username" autofocus>
                                <label for="username">Username</label>
                                @error('username')
                                    <div class="invalid-feedback d-flex justify-content-star">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <input wire:ignore.self type="password" wire:model.defer="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                    value="{{ old('password') }}" name="password" id="password" autofocus>
                                <label for="password">Password</label>
                                @error('password')
                                    <div class="invalid-feedback d-flex justify-content-star">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="icheck-primary d-flex justify-content-star align-items-center"
                            style="margin-top:-10px;">
                            <input type="checkbox" id="lihatPassword" wire:ignore.self>
                            <label wire:ignore.self for="lihatPassword"
                                style="font-weight: normal;margin-top:0px;margin-left: 5px;">
                                <small class="text-dark">Lihat Password</small>
                            </label>
                        </div>

                        <button type="submit" class="w-100 btn border-0 btn-primary mt-3 btn-get-started py-3"
                            name="login">
                            <span wire:loading.remove wire:target="auth">
                                <i class="bi bi-box-arrow-in-up"></i> LOGIN
                            </span>
                            <span wire:loading wire:target="auth" class="spinner-border spinner-border-sm text-light"
                                role="status" aria-hidden="true" style="width: ; height: ;"></span>
                        </button>

                        <div class="icheck-primary d-flex align-items-center justify-content-beetwen"
                            style="margin-top:10px;">
                            <input type="checkbox" id="remember_me" wire:model.defer="remember_me">
                            <label for="remember_me" style="font-weight: normal;margin-top:0px;margin-left: 5px;">
                                <small class="text-dark">Ingat Saya !</small>
                            </label>

                        </div>

                    </form>
                </div>
            </div>

        </section>
    </div>

    <script>
        $(document).on('click', '#lihatPassword', function() {

            const password = document.querySelector('#password');

            if (password.type == 'password') {
                password.type = 'text'
            } else {
                password.type = 'password';
            }

        })
    </script>

</div>
