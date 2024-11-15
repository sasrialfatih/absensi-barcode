<div>
    @if (session()->has('message'))
        <div>
            <script>
                Swal.fire({
                    icon: 'success',
                    text: 'Data berhasil ditambahkan',
                    allowOutsideClick: false
                })
            </script>
        </div>
    @endif

    <form wire:submit.prevent="store">
        @csrf
        <div wire:ignore.self class="modal fade" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5> <i class="bi bi-plus-lg"></i> Tambah Pegawai</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <select
                                            class="form-select form-select-md @error('devisi')
                                            is-invalid
                                            @enderror"
                                            id="devisi" name="devisi" wire:model="devisi" style="height: 58px;">
                                            <option value=" ">-- Devisi --</option>
                                            @foreach ($dataJabatan as $data)
                                                <option value="{{ $data->id_jabatan }}">{{ $data->nama_jabatan }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('devisi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('no_karyawan')
                                                            is-invalid
                                                        @enderror"
                                            placeholder="No. Karyawan" name="no_karyawan" id="no_karyawan" wire:model.defer="no_karyawan">
                                        <label for="no_karyawan">No. Karyawan</label>
                                        @error('no_karyawan')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('nama')
                                                            is-invalid
                                                        @enderror"
                                            placeholder="Nama Pegawai" name="nama" id="nama"
                                            wire:model.defer="nama">
                                        <label for="nama">Nama Pegawai</label>
                                        @error('nama')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <select
                                            class="form-select form-select-md @error('jenis_kelamin')
                                            is-invalid
                                            @enderror"
                                            id="jenis_kelamin" name="jenis_kelamin" wire:model="jenis_kelamin"
                                            style="height: 58px;">
                                            <option value=" ">-- Jenis Kelamin --</option>
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('nomor_telepon')
                                                            is-invalid
                                                        @enderror"
                                            placeholder="Nomor Telepon" name="nomor_telepon" id="nomor_telepon"
                                            wire:model.defer="nomor_telepon">
                                        <label for="nomor_telepon">Nomor Telepon</label>
                                        @error('nomor_telepon')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" id="closeModal" class="btn btn-secondary px-4" data-bs-dismiss="modal"
                            style="width: 140px; height: 3rem;">Batal</button>
                        <button class="btn btn-primary px-4" style="width: 140px; height: 3rem;">
                            <span wire:loading.remove wire:target="store">Simpan</span>
                            <span wire:loading wire:target="store" class="spinner-border spinner-border-sm text-light"
                                role="status" aria-hidden="true" style="width: 12px; height: 12px;">
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if ($closeModal)
        <script>
            $(document).ready(function() {
                $('#createModal').modal('hide');
            })
        </script>
    @endif


</div>
