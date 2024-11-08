<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">
        {{ __('Logout') }} </button>
</form>
