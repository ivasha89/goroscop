<div aria-live="polite" aria-atomic="true" style="position: relative; z-index: 1;">
    <div style="backdrop-filter: opacity(90%) ;  position: absolute; right: 0;">
        @foreach ($errors->all() as $error)
            <div class="toast" data-autohide="true" data-delay="12000" data-animation="true" role="alert" aria-live="assertive">
                <div class="toast-header">
                    <img src="{{ url('svg/m12.jpg') }}" width="30" class="rounded mr-2" alt="">
                    <strong class="mr-auto">Алексей лучше всех</strong>
                    <small>Только что</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    {{ $error }}
                </div>
            </div>
        @endforeach
    </div>
</div>