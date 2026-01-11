<div class="modal fade" id="{{ $id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header bg-warning">
                <h5 class="modal-title fw-bold text-white">Edit Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form>
                    <div class="mb-3"><label class="fw-bold">Student ID</label><input type="text" class="form-control"
                            placeholder="e.g. 2021-12345-MN-0"></div>
                    <div class="mb-3"><label class="fw-bold">Student Name</label><input type="text" class="form-control"
                            placeholder="e.g. John Doe"></div>

                    <div class="mb-3">
                        <label class="fw-bold">Violation Type</label>
                        <select class="form-select">
                            <option selected disabled>Select Violation Type</option>
                            @foreach ($violations as $violation)
                            <option value="{{ $violation->id }}">{{ $violation->violation_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3"><label class="fw-bold">Sanction</label>
                        <select class="form-select">
                            <option selected>Written Warning</option>
                            <option>Failing grade in exam/quiz</option>
                            <option>Failing grade in course</option>
                            <option>One-week suspensio</option>
                            <option>One-month suspension</option>
                            <option>One-semester suspension</option>
                            <option>Dismissal</option>
                            <option>Expulsion</option>
                        </select>
                    </div>
                    <div class="mb-3"><label class="fw-bold">Offense</label>
                        <select class="form-select">
                            <option>First Offense</option>
                            <option>Second Offense</option>
                            <option>Third Offense</option>
                            <option>Fourth Offense</option>
                        </select>
                    </div>

                    <div class="mb-3"><label class="fw-bold">Status</label>
                        <select class="form-select">
                            <option>Pending</option>
                            <option>Under Review</option>
                            <option>Resolved</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4 border-top pt-3">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn text-white px-4" style="background-color: #800000;">Save
                            Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>