<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-sm">
            <form action="{{ route('appeal.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Submit Appeal</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    {{-- Info about violation --}}
                    <div class="d-flex flex-column mb-3  align-items-start">
                        <div class="d-flex p-2 flex-column align-items-start rounded-2 relative bg-dark-tertiary w-100">
                            <small class="text-muted">Case ID:</small>
                            <p class="fw-bold fs-4 mb-0 text-primary">V-{{ $violation->id }}</p>
                        </div>

                        <div class="row w-100 mt-3">
                            <div class="col-12 col-md-6 d-flex flex-column align-items-start">

                                <small class="text-muted">Violation:</small>
                                <p class="fw-bold text-start">{{ $violation->violationSanction->violation->violation_name }}</p>
                            </div>
                            <div class="col-12 col-md-6 d-flex flex-column align-items-start align-items-md-end">

                                <small class="text-muted">Offense Level:</small>
                                <p>
                                    @if($violation->violationSanction->no_of_offense == 1)
                                    <span class="badge bg-info text-uppercase">First Offense</span>
                                    @elseif($violation->violationSanction->no_of_offense == 2)
                                    <span class="badge bg-warning text-dark text-uppercase">Second Offense</span>
                                    @else
                                    <span class="badge bg-danger text-uppercase">Third Offense</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                    </div>

                    {{-- Appeal Textarea --}}
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="appeal_content_{{ $id }}" class="form-label fw-bold text-start">Reason for
                            Appeal</label>
                        <textarea id="appeal_content_{{ $id }}" name="appeal_content"
                            class="form-control @error('appeal_content') is-invalid @enderror" rows="5"
                            placeholder="Please provide a detailed explanation for your appeal. Minimum 20 characters.">{{ old('appeal_content') }}</textarea>
                        @error('appeal_content')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <input type="hidden" name="violation_record_id" value="{{ $violation->id }}">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger rounded-pill fw-bold px-4">
                        Submit Appeal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>