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
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5> <i class="bi bi-plus-lg"></i> Tambah Divisi</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('nama_divisi')
                                                            is-invalid
                                                        @enderror"
                                            placeholder="Nama Divisi" name="nama_divisi" id="nama_divisi"
                                            wire:model.defer="nama_divisi">
                                        <label for="nama_divisi">Nama Divisi</label>
                                        @error('nama_divisi')
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
