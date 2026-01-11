<div class="modal fade" id="logViolationModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content border-0">
            <div class="modal-header modal-header-maroon">
                <h5 class="modal-title fw-bold">Log New Violation</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="student_id" class="fw-bold">
                            Student ID / User ID
                        </label>
                        <input id="student_id" name="student_id" type="text" class="form-control"
                            placeholder="e.g. 2021-12345-MN-0">
                    </div>

                    <div class="mb-3">
                        <label for="violation_type" class="form-label fw-bold">
                            Violation Type
                        </label>

                        <select id="violation_type" name="violation_id" class="form-select">
                            @foreach ($violations as $violation)
                            <option value="{{ $violation->id }}">
                                {{ $violation->violation_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">
                            Notes
                        </label>
                        <textarea class="form-control" rows="5"></textarea>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn text-white" style="background-color: #800000;">
                            Log Violation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>