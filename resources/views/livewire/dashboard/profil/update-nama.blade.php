<div>
    @if (session()->has('message'))
        <div>
            <script>
                Swal.fire({
                    icon: 'success',
                    text: 'Data berhasil diubah',
                    allowOutsideClick: false
                }).then(() => {
                    location.reload();
                })
            </script>
        </div>
    @endif

    <form wire:submit.prevent="update">
        @csrf
        <div wire:ignore.self class="modal fade" id="updateNamaModal" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5><i class="bi bi-pencil"></i> Ubah Nama Pengguna</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control @error('nama')
                                                    is-invalid
                                                @enderror"
                                            placeholder="Nama" value="{{ old('nama') }}" name="nama" id="nama"
                                            wire:model="nama">
                                        <label for="nama">Nama</label>
                                        @error('nama')
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
                        <button type="button" id="closeModal" class="btn bg-secondary px-4 text-light"
                            data-bs-dismiss="modal">Batal</button>
                            <button class="btn bg-primary px-4 text-light" style="width: 100px;">
                                <span wire:loading.remove wire:target="update">Simpan</span>
                                <span wire:loading wire:target="update"
                                    class="spinner-border spinner-border-sm text-light" role="status"
                                    aria-hidden="true"></span>
                            </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if ($closeModal)
        <script>
            $(document).ready(function() {
                $('#updateNamaModal').modal('hide');
            })
        </script>
    @endif

</div>
