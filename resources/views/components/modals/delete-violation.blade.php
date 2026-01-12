<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 justify-content-center">
                <div class="text-danger fs-1"> <i class="bi bi-exclamation-triangle-fill"></i> </div>
            </div>
            <div class="modal-body text-center px-4">
                <h5 class="fw-bold mb-2" id="{{ $id }}Label">Confirm Delete</h5>
                <p class="text-muted mb-0"> This action <strong>cannot be undone</strong>. Are you sure you want to
                    delete record <span class="text-primary fw-bold"> V-{{ date('Y') }}-{{ $record->id }}</span>? </p>
                <input type="hidden" id="delete_id_storage">
            </div>
            <form action="{{ route('admin.violations-management.destroy', $record)}}" method="POST"> @csrf @method('DELETE')
                <div class="modal-footer justify-content-center border-0 pt-0 pb-4"> <button type="button"
                        class="btn btn-light px-4" data-bs-dismiss="modal"> Cancel </button> <button type="submit"
                        class="btn btn-danger px-4" id="confirmDeleteBtn"> <i class="bi bi-trash me-1"></i> Delete
                    </button> </div>
            </form>
        </div>
    </div>
</div>