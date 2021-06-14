<div class="w3-container">
    <div class="w3-row">
        @if($status === 'Reposted')
        <div class="pl-4 my-2">
            Reposted: Originally by
            <a href="{{ $profileRoute }}">{{ $author }}</a>
        </div>
        @endif
    </div>

    <div class="w3-row">
        <div class="w3-col m8 pl-2">
            <a href="{{ $route }}">
                <h4>{{ $title }}</h4>
            </a>

        </div>

        
        {{ $slot }}

    </div>
</div>

