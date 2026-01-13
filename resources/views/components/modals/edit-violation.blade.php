<div class="modal fade" id="{{ $id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header bg-warning">
                <h5 class="modal-title fw-bold text-white">Edit Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('admin.violations-management.update', $record) }}" method="POST"> @csrf @method('PATCH')
                    <div class="mb-3"><label class="fw-bold">Student ID</label><input type="text" class="form-control"
                            placeholder="{{ $record->user->school_id }}" disabled></div>
                    <div class="mb-3"><label class="fw-bold">Student Name</label><input type="text" class="form-control"
                            placeholder="{{ $record->user->first_name.' '.$record->user->last_name }}" disabled></div>

                    <div class="mb-3">
                        <label class="fw-bold">Violation Type</label>
                        <select class="form-select" name="violation_id">    
                            <option selected disabled>Select Violation Type</option>
                            @foreach ($violations as $violation)
                            <option value="{{ $violation->id }}">{{ $violation->violation_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4 border-top pt-3">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn text-white px-4" style="background-color: #800000;">Save
                            Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>