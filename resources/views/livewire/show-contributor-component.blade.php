<div>
    {{-- Success is as dangerous as failure. --}}

    @foreach ($contributors as $c)
        <h1>
            {{ $c->email . ' - ' . $c->name }}
        </h1>
    @endforeach
</div>
