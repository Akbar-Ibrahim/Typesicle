@foreach($feed->thread->shorties as $shortie)
@if($loop->index >= 2)
<header-component user="{{ json_encode($feed->user) }}" user-id="{{ $feed->user_id }}"
    date="{{ $feed->created_at->toFormattedDateString() }}" size="width: 35px">
</header-component>
<shortie-component shortie="{{ json_encode($shortie) }}"
    route="{{ route('shortie.url', [$feed->user->username, $shortie->thread->feed->id])  }}"
    height="{{ count($shortie->shortiePhoto) == 1 ? '500px' : '250px' }}"
    smallscreen-height="{{ count($shortie->shortiePhoto) == 1 ? '300px' : '150px' }}">
</shortie-component>

@if($shortie->quoted > 0)
<div class="mb-4 w3-margin-top w3-border" style="width: 80%; margin: auto;">
    <header-component user="{{ json_encode($shortie->quotedS->user) }}"
        date="{{ $shortie->quotedS->created_at->toFormattedDateString() }}" size="width: 25px"
        fontsize="font-size: 11px;">
    </header-component>

    <shortie-component
        route="{{ route('shortie.url', [$shortie->quotedS->user->username, $feed->thread->shorties[0]->quotedS->feed->id]) }}"
        shortie="{{ json_encode($shortie->quotedS) }}"
        height="{{ count($shortie->quotedS->shortiePhoto) == 1 ? '500px' : '250px' }}"
        smallscreen-height="{{ count($shortie->quotedS->shortiePhoto) == 1 ? '250px' : '100px' }}">
    </shortie-component>
</div>
@endif

<shortieoptions-component quoted="{{ $shortie->id }}"
    shortie-id="{{ $shortie->id }}">
    @csrf
</shortieoptions-component>
@endif
@endforeach