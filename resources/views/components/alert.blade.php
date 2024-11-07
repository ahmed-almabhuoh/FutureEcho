@if (session()->has('message'))
    <div class="alert alert-custom alert-notice
        @if (session()->has('status') == 200) alert-light-primary
        @else
        alert-light-danger @endif
    fade show"
        role="alert">
        <div class="alert-icon"><i
                class="
            @if (session()->has('status') == 200) alert-light-primary
            @else
            flaticon-warning @endif
            "></i>
        </div>
        <div class="alert-text"> {{ __(session('message')) }} </div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
@endif
