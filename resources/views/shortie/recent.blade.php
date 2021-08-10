@foreach($recentShorties as $feed)
<div class="w3-border" style="margin-top: 50px;">

    @if($feed)
    <div class="w3-border" >

        <header-component 
            user="{{ json_encode($feed->shortie->user) }}" name="{{ $feed->shortie->user->name }}"
            date="{{ $feed->created_at->toFormattedDateString() }}" size="width: 35px">
        </header-component>

        

        @if($feed->shortie->quoted > 0)
        <div class="mb-4 w3-margin-top w3-border" style="width: 80%; margin: auto;">
            <header-component 
                user="{{ json_encode($feed->shortie->quotedShortie->user) }}"
                date="{{ $feed->shortie->quotedShortie->created_at->toFormattedDateString() }}"
                size="width: 25px" fontsize="font-size: 11px;">
            </header-component>

            
        </div>
        @endif
    </div>
    @endif
</div>
@endforeach