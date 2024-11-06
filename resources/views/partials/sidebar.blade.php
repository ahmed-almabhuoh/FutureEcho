<div class="col-md-2 sidebar" style="height: 100vh !important;">

    <a href="{{ route('dashboard') }}" @if (getCurrentRouteName() == 'dashboard') class="active" @endif><i
            class="bi bi-house-door"></i>{{ __('Dashboard') }}</a>

    <a href="{{ route('memories') }}" @if (getCurrentRouteName() == 'memories') class="active" @endif><i
            class="bi bi-collection"></i>{{ __('Memories') }}</a>

    <a href="#"><i class="bi bi-file-earmark-image"></i>Add Image</a>
    <a href="#"><i class="bi bi-camera-video"></i>Add Video</a>
    <a href="#"><i class="bi bi-chat-dots"></i>Add Message</a>

    <a href="{{ route('capsules') }}" @if (getCurrentRouteName() == 'capsules') class="active" @endif><i class="bi bi-box"></i>
        {{ __('Capsules') }} </a>

    <a href="{{ route('contributors') }}" @if (getCurrentRouteName() == 'contributors') class="active" @endif><i
            class="bi bi-people"></i>
        {{ __('Contributors') }}
    </a>

    <a href="#"><i class="bi bi-gear"></i>Settings</a>

    {{-- <a href="#"><i class="bi bi-heart"></i>Favorite</a>
    <a href="#"><i class="bi bi-question-circle"></i>Help</a> --}}

    <a href="{{ route('legacy') }}" @if (getCurrentRouteName() == 'legacy') class="active" @endif><i
            class="bi bi-question-circle"></i>
        {{ __('Legacy') }} </a>
</div>
