<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">@lang('lang.view_review')</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            @if(isset($review->user->name))
                <p><strong>User:</strong> {{$review->user->name}}</p>
            @endif
            @if(isset($review->exchange->name))
                <p><strong>Exchange:</strong> {{$review->exchange->name}}</p>
                @endif
                @if(isset($review->created_at))
                    <p><strong>Added On:</strong> {{$review->created_at->format('d-M-Y h:i:s')}}</p>
                @endif
            <hr>
            <p class="mb-1"><strong>Review:</strong> </p>
            <p>{{$review->review}}</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
