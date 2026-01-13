<div class="d-flex justify-content-center gap-2 align-items-center">
    @if(!$record->canBeAppealed())
    @if($record->appeal?->is_accepted === true)
    <span class="badge bg-green-shade text-uppercase text-black " style="font-size: 12px;">
        Accepted
    </span>
    @elseif($record->appeal?->is_accepted === false)
    <span class="badge bg-red-shade text-uppercase text-black " style="font-size: 12px;">
        Rejected
    </span>
    @else
    <span class="badge bg-blue-shade text-uppercase text-black " style="font-size: 12px;">
        Appeal In Progress
    </span>
    @endif
    @endif
</div>