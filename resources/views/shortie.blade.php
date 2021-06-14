

<div style="margin-top: 50px;">
    @foreach($feeds as $feed)

@if($feed->status == 'Shortie')
    <div class="" style="margin-top: 50px;">
        <header-component user="{{ json_encode($feed->shortie->user) }}"
            date="{{ $feed->shortie->created_at->toFormattedDateString() }}" size="width: 35px">
        </header-component>

        <shortie-component shortie-id="{{ $feed->shortie_id }}" user-id="{{ Auth::user()->id }}"
            shortie="{{ json_encode($feed->shortie) }}" @if($feed->shortie->thread)
            route="{{ route('shortie.url', [$feed->user->username, $feed->shortie->thread->feed->id])  }}#{{ $feed->shortie_id }}"
            @else
            route="{{ route('shortie.url', [$feed->user->username, $feed->id])  }}"
            @endif
            height="{{ count($feed->shortie->shortiePhoto) == 1 ? '500px' : '250px' }}"
            smallscreen-height="{{ count($feed->shortie->shortiePhoto) == 1 ? '300px' : '150px' }}">

        </shortie-component>

        @if($feed->shortie->quoted > 0)
        <div class="mb-4 w3-margin-top " style="width: 80%; margin: auto;">
            <header-component user="{{ json_encode($feed->shortie->quoted($feed->shortie->quoted)->user) }}"
                date="{{ $feed->shortie->quoted($feed->shortie->quoted)->created_at->toFormattedDateString() }}"
                size="width: 25px" fontsize="font-size: 11px;">
            </header-component>

            <shortie-component shortie-id="{{ $feed->shortie->quoted($feed->shortie->quoted)->id }}"
                route="{{ route('shortie.url', [$feed->shortie->quoted($feed->shortie->quoted)->user->username, $feed->shortie->quoted($feed->shortie->quoted)->feed->id]) }}"
                user-id="{{ $feed->shortie->quoted($feed->shortie->quoted)->user->id }}"
                shortie="{{ json_encode($feed->shortie->quoted($feed->shortie->quoted)) }}"
                height="{{ count($feed->shortie->quoted($feed->shortie->quoted)->shortiePhoto) == 1 ? '450px' : '200px' }}"
                smallscreen-height="{{ count($feed->shortie->quoted($feed->shortie->quoted)->shortiePhoto) == 1 ? '250px' : '100px' }}">

            </shortie-component>
        </div>
        @endif
        @if($feed->shortie->thread)
        <div class="w3-padding"
            route="{{ route('shortie.url', [$feed->shortie->user->username, $feed->shortie->thread->feed->id]) }}"
            onclick="location.href=this.getAttribute('route')" style="cursor: pointer;">
            Read Thread
        </div>
        @endif

        <div class="w3-margin">
            <shortieoptions-component quoted="{{ $feed->shortie_id }}" shortie-id="{{ $feed->shortie_id }}">
                @csrf
            </shortieoptions-component>
        </div>
    </div>

    @elseif($feed->thread)
    <thread-component thread-id="{{ $feed->thread->id }}">


        <template v-slot:initial>
            @foreach($feed->thread->shorties as $shortie)

            @if($loop->index < 2) <header-component user="{{ json_encode($feed->user) }}" user-id="{{ $feed->user_id }}"
                date="{{ $feed->created_at->toFormattedDateString() }}" size="width: 35px">
                </header-component>
                <shortie-component shortie="{{ json_encode($shortie) }}"
                    route="{{ route('shortie.url', [$feed->user->username, $shortie->thread->feed->id])  }}"
                    height="{{ count($shortie->shortiePhoto) == 1 ? '500px' : '250px' }}"
                    smallscreen-height="{{ count($shortie->shortiePhoto) == 1 ? '300px' : '150px' }}">
                </shortie-component>

                @if($shortie->quoted > 0)
                <div class="mb-4 w3-margin-top w3-border" style="width: 80%; margin: auto;">
                    <header-component user="{{ json_encode($shortie->quoted($shortie->quoted)->user) }}"
                        date="{{ $shortie->quoted($shortie->quoted)->created_at->toFormattedDateString() }}"
                        size="width: 25px" fontsize="font-size: 11px;">
                    </header-component>

                    <shortie-component
                        route="{{ route('shortie.url', [$shortie->quoted($shortie->quoted)->user->username, $feed->thread->shorties[0]->quoted($shortie->quoted)->feed->id]) }}"
                        shortie="{{ json_encode($shortie->quoted($shortie->quoted)) }}"
                        height="{{ count($shortie->quoted($shortie->quoted)->shortiePhoto) == 1 ? '500px' : '250px' }}"
                        smallscreen-height="{{ count($shortie->quoted($shortie->quoted)->shortiePhoto) == 1 ? '250px' : '100px' }}">
                    </shortie-component>
                </div>
                @endif

                <shortieoptions-component quoted="{{ $shortie->id }}" shortie-id="{{ $shortie->id }}">
                    @csrf
                </shortieoptions-component>
                @endif
                @endforeach
        </template>


        <template v-slot:rest>

            @include('includes.thread')

        </template>

    </thread-component>
    @endif

    @endforeach
    </div>
    