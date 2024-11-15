<div>
    @if (session()->has('message'))
        <div>
            <script>
                Swal.fire({
                    icon: 'success',
                    text: 'Data berhasil dihapus',
                    allowOutsideClick: false
                })
            </script>
        </div>
    @endif


    <div wire:ignore.self class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-center mt-3 mb-3">
                        <i class="bi bi-trash-fill text-danger fs-1"></i>
                    </div>
                    <p class="text-center">Hapus Pengguna {{ $nama }} ?</p>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button id="closeModal" class="btn btn-secondary" data-bs-dismiss="modal"
                        style="width: 100px;height: 3rem;">Batal</button>
                    <button wire:click="destroy({{ $idDelete }})" class="btn btn-danger"
                        style="width: 100px;height: 3rem;">
                        <span wire:loading.remove wire:target="destroy">Hapus</span>
                        <span wire:loading wire:target="destroy" class="spinner-border spinner-border-sm text-light"
                            role="status" aria-hidden="true" style="width: 12px; height: 12px;">
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    @if ($closeModal)
        <script>
            $(document).ready(function() {
                $('#deleteModal').modal('hide');
            })
        </script>
    @endif

</div>
