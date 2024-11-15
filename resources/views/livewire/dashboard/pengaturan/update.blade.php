<div>
    @if (session()->has('message'))
        <div>
            <script>
                Swal.fire({
                    icon: 'success',
                    text: 'Data berhasil diubah',
                    allowOutsideClick: false
                })
            </script>
        </div>
    @endif

    <form wire:submit.prevent="update({{ $idEdit }})">
        @csrf
        <div wire:ignore.self class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5><i class="bi bi-gear"></i> Pengaturan</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('jam_masuk')
                                                            is-invalid
                                                        @enderror"
                                            placeholder="Jam Masuk" name="jam_masuk" id="jam_masuk"
                                            wire:model.defer="jam_masuk">
                                        <label for="jam_masuk">Jam Masuk</label>
                                        @error('jam_masuk')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <small class="text-secondary">Cara penulisan jam yang benar <b> 01:30:00(jam:menit:detik)</b></small>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('jam_pulang')
                                                            is-invalid
                                                        @enderror"
                                            placeholder="Jam Pulang" name="jam_pulang" id="jam_pulang"
                                            wire:model.defer="jam_pulang">
                                        <label for="jam_pulang">Jam Pulang</label>
                                        @error('jam_pulang')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <small class="text-secondary">Cara penulisan jam yang benar <b> 01:30:00(jam:menit:detik)</b></small>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('url')
                                                            is-invalid
                                                        @enderror"
                                            placeholder="URL" name="url" id="url"
                                            wire:model.defer="url">
                                        <label for="url">URL</label>
                                        @error('url')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <span class="fw-bold">Pengesahan Laporan</span>
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('nama')
                                                            is-invalid
                                                        @enderror"
                                            placeholder="Nama" name="nama" id="nama"
                                            wire:model.defer="nama">
                                        <label for="nama">Nama</label>
                                        @error('nama')
                                            <div class="invalid-feedback d-flex justify-content-star">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('jabatan')
                                                            is-invalid
                                                        @enderror"
                                            placeholder="Nama Jabatan" name="jabatan" id="jabatan"
                                            wire:model.defer="jabatan">
                                        <label for="jabatan">Nama Jabatan</label>
                                        @error('jabatan')
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
                            <span wire:loading.remove wire:target="update">Simpan</span>
                            <span wire:loading wire:target="update" class="spinner-border spinner-border-sm text-light"
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
                $('#editModal').modal('hide');
            })
        </script>
    @endif


</div>
