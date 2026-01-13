<div class="d-flex justify-content-center gap-2 align-items-center">
    @if(!$record->canBeAppealed())
    @if($record->appeal?->is_accepted === true)
    <span class="badge text-uppercase" style="font-size: 12px; background-color: #99e1b3; color: #16863f;">
        Accepted
    </span>
    @elseif($record->appeal?->is_accepted === false)
    <span class="badge text-uppercase" style="font-size: 12px; background-color: #fbd6d6; color: #a12b2b;">
        Rejected
    </span>
    @else
    <span class="badge text-uppercase" style="font-size: 12px; background-color: #e2eefa; color: #4f5e6f;">
        Appeal In Progress
    </span>
    @endif
    @endif
</div>