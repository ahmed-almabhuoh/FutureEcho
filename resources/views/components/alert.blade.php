@if (session()->has('message'))
    <div class="alert alert-custom
        @if (session()->has('status') && session('status') == 200) alert-light-success
        @else alert-light-primary @endif fade show mb-5"
        role="alert">

        <div class="alert-icon">
            <i
                class="
                @if (session()->has('status') && session('status') == 200) flaticon-check-mark
                @else flaticon-warning @endif
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
